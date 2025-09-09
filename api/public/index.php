<?php

require_once dirname(__DIR__)  . "/config/bootstrap.php";

use Core\Router;
use Throwable;

$router = new Router();

try {
    $router->init();
} catch (Throwable $err) {
    echo json_encode("Erreur". $err->getMessage());
}

