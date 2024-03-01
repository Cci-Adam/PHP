<?php
namespace App\Services;
class Router
{
    private $page;

    public function __construct()
    {
        $this->setPage();
    }
    public function setPage(){
        $this->page = isset($_GET['page']) ? strtolower($_GET['page']) : 'home';
    }

    public function getPage(){
        return $this->page;
    }
    
}