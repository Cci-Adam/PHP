<?php
namespace App\Controllers;
use App\Models\Monstre;
class HomeController
{
    public function index()
    {
        $template = './views/template_home.phtml';
        $monstreObj = new Monstre();
        $monstres = $monstreObj->getAll(5);
        $x  = 1; //Utile
        $this->render($template,["monstres"=>$monstres,"x"=>$x]);
    }

    public function render($templatePath, $data){
        ob_start();
        include $templatePath;

        $template = ob_get_clean();
        include './views/base.phtml';
    }
}
