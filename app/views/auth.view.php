<?php

class AuthView {
    private $user = null;
    
    public function showLogin(){
        require 'templates/login.phtml';
    }

    public function showError($error) {
        require 'templates/error.phtml';
    }

   
}