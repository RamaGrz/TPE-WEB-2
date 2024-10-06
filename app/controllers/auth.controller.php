<?php
require_once './app/models/user.model.php';
require_once './app/views/auth.view.php';
require_once './app/helpers/AuthHelper.php';

class AuthController{
    private $model;
    private $view;
    
    public function __construct() {
        $this->model = new UserModel();
        $this->view = new AuthView();
    }

    function showLogin(){
        $this->view->showLogin();
    }
    public function logout() {
        AuthHelper::logout();
        header('Location: ' . BASE_URL . 'home');    
    }

    public function login() {
       
        if (!isset($_POST['usuario']) || empty($_POST['usuario'])) {
            return $this->view->showErrorFaltanCampos('Falta completar el nombre de usuario');
        }
    
        if (!isset($_POST['contrasenia']) || empty($_POST['contrasenia'])) {
            return $this->view->showErrorFaltanCampos('Falta completar la contraseña');
        }
    
        $usuario = $_POST['usuario'];
        $contrasenia = $_POST['contrasenia'];
    
        // Verificar que el usuario está en la base de datos
        $user= $this->model->getUserByUser($usuario);

        // password: 123456
        // $userFromDB->password: $2y$10$xQop0wF1YJ/dKhZcWDqHceUM96S04u73zGeJtU80a1GmM.H5H0EHC
        if($user && password_verify($contrasenia, $user->contrasenia)){
            // Guardo en la sesión el ID del usuario
            AuthHelper::login($user);
           
            
            header('Location: ' . BASE_URL);
        } else {
            return $this->view->showErrorCredenciales('Credenciales incorrectas');
        }
    }
}