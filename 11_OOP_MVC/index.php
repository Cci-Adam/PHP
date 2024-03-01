<?php
namespace App;
use App\Services\Router;
session_start();
require('config.php');
require_once('autoload.php');
$router = new Router();
$page = $router->getPage();
$controllerName = "App\Controllers\\".ucfirst($page)."Controller";
$controller = new $controllerName();
$controller->index();