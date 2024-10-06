<?php

class AuthHelper{

    public static function initialize() {
        if (session_status() != PHP_SESSION_ACTIVE) {
            session_start();
        }
    }

    public static function login($user) {
        AuthHelper::initialize();
        $_SESSION['USER_ID'] = $user->id_usuario;
        $_SESSION['USER_USERNAME'] = $user->usuario; 
    }

    public static function logout() {
        AuthHelper::initialize();
        session_destroy();
    }
    
    public static function verify() {
        AuthHelper::initialize();
        if (!isset($_SESSION['USER_ID'])) {
            header('Location: ' . BASE_URL . 'login');
            die();
        }
    }

}