<?php
namespace App\Controllers;
use App\Models\UserManager;
use App\Services\Utils;
use App\Controllers\Controller;

class AdminUserTabController extends Controller
{
    public function index()
    {
        $utilsObj = new Utils();
        $utilsObj->verifAdmin();
        $userObj = new UserManager();
        $users = $userObj->getAll(null,"SELECT *,user.id as id FROM user join user_details on user.id = user_details.user_id");
        $template = './views/template_admin_user_tab.phtml';
        $this->render($template, ['users' => $users]);
    }

    public function delete()
    {
        
    }
}