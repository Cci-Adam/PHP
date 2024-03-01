<?php
namespace App\Controllers;
use App\Models\Monstre;
use App\Services\Utils;

class AdminMonstreTabController
{
    public function index()
    {
        $utilsObj = new Utils();
        $utilsObj->verifAdmin();
        $monstreObj = new Monstre();
        $monstres = $monstreObj->getAll();
        $template = './views/template_admin_monstre_tab.phtml';
        $this->render($template,['monstres' => $monstres]);
    }

    public function render($templatePath, $data)
    {
        ob_start();
        include $templatePath;

        $template = ob_get_clean();
        include './views/base.phtml';
    }
}