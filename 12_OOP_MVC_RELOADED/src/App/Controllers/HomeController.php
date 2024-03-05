<?php
namespace App\Controllers;
use App\Models\MonstreManager;
use App\Controllers\Controller;
class HomeController extends Controller
{
    public function index()
    {
        $template = './views/template_home.phtml';
        $monstreObj = new MonstreManager();
        $monstres = $monstreObj->getAll(5);
        $x  = 1; //Utile
        $this->render($template,["monstres"=>$monstres,"x"=>$x]);
    }

    
}
