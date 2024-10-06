<?php
require_once './app/views/home.view.php';

class HomeController{
    
    private $view;
    
    public function __construct() {
        AuthHelper::initialize();
        $this->view = new HomeView();
    }

    function showHome(){
        $this->view->showHome();
    }
}

