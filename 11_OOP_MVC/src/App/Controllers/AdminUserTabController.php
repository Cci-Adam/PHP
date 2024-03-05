<?php
namespace App\Controllers;
use App\Models\User;
use App\Services\Utils;

class AdminUserTabController
{
    public function index()
    {
        $utilsObj = new Utils();
        $utilsObj->verifAdmin();
        $userObj = new User();
        $users = $userObj->getAll();
        $template = './views/template_admin_user_tab.phtml';
        $this->render($template, ['users' => $users]);
    }

    public function render($templatePath, $data)
    {
        ob_start();
        include $templatePath;

        $template = ob_get_clean();
        include './views/base.phtml';
    }
}