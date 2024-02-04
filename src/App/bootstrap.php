<?php

declare(strict_types=1);

include __DIR__ . "/../../vendor/autoload.php";

use Framework\App;
use App\Config\Paths;
use Dotenv\Dotenv;


use function App\Config\{
    registerRoutes,
    registerMiddlewares
};

$dotenv = Dotenv::createImmutable(Paths::ROOT);

//$dotenv = Dotenv::createImmutable(Paths::ROOT);

$dotenv->load();

$app = new App(Paths::SOURCE . "App/container-definitions.php");

registerRoutes($app);
registerMiddlewares($app);

return $app;
