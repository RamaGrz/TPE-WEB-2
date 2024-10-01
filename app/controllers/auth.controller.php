<?php
require_once './app/models/user.model.php';
require_once './app/views/login.view.php';
class AuthController{
    
    private $view;
    
    public function __construct() {
        $this->view = new LoginView();
    }

    function showLogin(){
        $this->view->showLogin();
    }
}