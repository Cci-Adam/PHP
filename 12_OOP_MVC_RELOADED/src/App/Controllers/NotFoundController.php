<?php
namespace App\Controllers;

use App\Controllers\Controller;

class NotFoundController extends Controller
{
    public function index()
    {
        $template = './views/template_notfound.phtml';
        $this->render($template,[]);
    }
}