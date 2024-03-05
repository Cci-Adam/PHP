<?php
namespace App\Controllers;
use App\Models\User;
use App\Services\Utils;
use App\Controllers\Controller;

class AdminUserTabController extends Controller
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
}