<?php
namespace App\Controllers;
class LogoutController
{
    public function index()
    {
        unset($_SESSION['user']);
        session_destroy();
        $prevPage = $_SERVER['HTTP_REFERER'];
        $prevPage = explode("?", $prevPage);
        $prevPage = '?'.$prevPage[1];
        header('Location: ./'.$prevPage);
    }
}