<?php

class LoginView {
    
    public function showLogin(){
        require 'templates/login.phtml';
    }

    public function showError($error) {
        require 'templates/error.phtml';
    }

   
}