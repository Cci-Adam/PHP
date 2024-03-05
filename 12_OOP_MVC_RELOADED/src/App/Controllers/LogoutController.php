<?php
namespace App\Controllers;
use App\Services\Authenticator;
class LogoutController
{
    public function index()
    {
        $authenticator = new Authenticator();
        $authenticator->logout();
    }
}