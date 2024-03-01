<?php
namespace App\Controllers;
use App\Services\Utils;
class AdminController{
    public function index(){
        $utilsObj = new Utils();
        $utilsObj->verifAdmin();
        $template = './views/template_admin.phtml';
        $this->render($template,[]);
    }
    public function render($templatePath, $data){
        ob_start();
        include $templatePath;

        $template = ob_get_clean();
        include './views/base.phtml';
    }
}