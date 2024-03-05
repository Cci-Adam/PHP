<?php
namespace App\Controllers;
use App\Models\MonstreManager;
use App\Services\Utils;
use App\Controllers\Controller;

class AdminMonstreTabController extends Controller
{
    public function index()
    {
        $utilsObj = new Utils();
        $utilsObj->verifAdmin();
        $monstreObj = new MonstreManager();
        $monstres = $monstreObj->getAll();
        $template = './views/template_admin_monstre_tab.phtml';
        $this->render($template,['monstres' => $monstres]);
    }
}