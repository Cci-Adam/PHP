<?php
namespace App;
use App\Services\Router;


require_once('config.php');
require_once('autoload.php');

use App\Services\Authenticator;
$auth = new Authenticator();

$router = new Router();
$page = $router->getPage();
$router->run();

