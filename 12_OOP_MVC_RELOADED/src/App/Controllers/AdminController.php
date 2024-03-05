<?php
namespace App\Controllers;
use App\Services\Authenticator;
use App\Controllers\Controller;
class AdminController extends Controller{
    public function __construct(){
        if(!Authenticator::isRole('ROLE_ADMIN')){
            header('Location: ?page=home');
            die();
        }
    }
    public function index(){
        $template = './views/template_admin.phtml';
        $this->render($template,[]);
    }
}