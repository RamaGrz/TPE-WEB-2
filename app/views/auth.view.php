<?php

class AuthView {
    
    
    public function showLogin(){
        require 'templates/login.phtml';
    }

    public function showError($error) {
        require 'templates/error.phtml';
    }
    public function showErrorCredenciales($error) {
        require 'templates/errorCredencial.phtml';
    }
    public function showErrorFaltanCampos($error) {
        require 'templates/errorFaltan.phtml';
    }

   
}