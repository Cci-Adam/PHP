<?php

namespace App\Controllers;
use App\Models\ContactManager;
use App\Services\Utils;
use App\Controllers\Controller;

class ContactController extends Controller
{
    public function index()
    {
        $utilsObj = new Utils();
        $contactObj = new ContactManager();
        $template = './views/template_contact.phtml';
        $success=false;
        $errors=[];
        if(isset($_POST['sujet']) && isset($_POST['message']) && !empty($_POST['sujet']) && !empty($_POST['message'])){
            $sujet = htmlentities(strip_tags($_POST['sujet']));
            $message = htmlentities(strip_tags($_POST['message']));
            if (!($utilsObj->isUserConnected())) {
                $errors[] = "Veuillez vous connecter";
            }
            if(empty($errors)){
                $user_Id = $_SESSION['user']['id'];
                $contactObj->insert([$user_Id,$sujet,$message]);
                $success = true;
            }
        }
        $this->render($template,['success'=>$success,'errors'=>$errors]);
    }
}