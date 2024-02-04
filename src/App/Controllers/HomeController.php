<?php

declare(strict_types=1);

namespace App\Controllers;

use Framework\TemplateEngine;
use App\Config\Paths;
use App\Services\{EmployeService, ValidatorService};


class HomeController
{

    public function __construct(
        private TemplateEngine $view,
        private EmployeService $employeService,
        private ValidatorService $validatorService
    ) {
    }
    public function home()
    {
        $page = $_GET['p'] ?? 1;
        $page = (int) $page;
        $length = 3;
        $offset = ($page - 1) * $length;
        $searchTerm = $_GET['s'] ?? '';


        [$employes, $count] = $this->employeService->getEmployes($length, $offset);

        $lastPage = ceil($count / $length);

        $pages = $lastPage ? range(1, $lastPage) : [];

        $pageLinks = array_map(
            fn ($pageNum) => http_build_query([
                'p' => $pageNum,
                's' => $searchTerm
            ]),
            $pages
        );


        $previousPageQuery = http_build_query([
            'p' => $page - 1,
            's' => $searchTerm
        ]);

        $nextPageQuery = http_build_query([
            'p' => $page + 1,
            's' => $searchTerm
        ]);

        echo $this->view->render('/index.php', [
            'employes' => $employes,
            'previousPageQuery' => $previousPageQuery,
            'currentPage' => $page,
            'searchTerm' => $searchTerm,
            'nextPageQuery' => $nextPageQuery,
            'lastPage' => $lastPage,
            'pageLinks' => $pageLinks
        ]);
    }

    public function editView(array $params)
    {
        $employe = $this->employeService->getEmploye($params['employe']);

        $excludeFields = ['password'];

        $employe = array_diff_key($employe, array_flip($excludeFields));

        echo $this->view->render("edit.php", [
            'employe' => $employe
        ]);
    }

    public function edit(array $params)
    {

        $this->validatorService->validateEdit($_POST);

        if ((int) $params['employe'] !== $_SESSION['user']) {
            redirectTo('/');
        }

        $this->employeService->update($_POST, $params['employe']);

        redirectTo('/');
    }

    public function delete(array $params)
    {
        if ((int) $params['employe'] !== $_SESSION['user']) {
            redirectTo('/');
        }
        $this->employeService->delete($params['employe']);

        unset($_SESSION['user']);

        redirectTo('/');
    }
}
