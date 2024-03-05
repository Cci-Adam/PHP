<?php
namespace App;
use App\Services\Router;
session_start();
require_once('config.php');
require_once('autoload.php');


$router = new Router();
$page = $router->getPage();
$router->run();

