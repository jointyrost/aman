<?php

declare(strict_types=1);

namespace App\Config;

use App\Middlewares\{AuthRequiredMiddleware, GuestOnlyMiddleware};
use Framework\App;
use App\Controllers\{
    HomeController,
    AboutController,
    AuthController,
    ErrorController
};


function registerRoutes(App $app)
{
    $app->get('/', [HomeController::class, 'home'])->add(AuthRequiredMiddleware::class);
    $app->get('/about', [AboutController::class, 'about']);
    $app->get('/register', [AuthController::class, 'registerView'])->add(GuestOnlyMiddleware::class);
    $app->post('/register', [AuthController::class, 'register'])->add(GuestOnlyMiddleware::class);
    $app->get('/login', [AuthController::class, 'loginView'])->add(GuestOnlyMiddleware::class);
    $app->post('/login', [AuthController::class, 'login'])->add(GuestOnlyMiddleware::class);
    $app->get('/logout', [AuthController::class, 'logout'])->add(AuthRequiredMiddleware::class);
    $app->get('/edit/{employe}', [HomeController::class, 'editView'])->add(AuthRequiredMiddleware::class);
    $app->post('/edit/{employe}', [HomeController::class, 'edit'])->add(AuthRequiredMiddleware::class);
    $app->delete('/edit/{employe}', [HomeController::class, 'delete'])->add(AuthRequiredMiddleware::class);

    $app->setErrorHandler([ErrorController::class, 'notFound']);
}
