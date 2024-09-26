<?php
require_once 'app/controllers/player.controller.php';

// base_url para redirecciones y base tag
define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');

$action = 'players'; // accion por defecto si no se envia ninguna
if (!empty( $_GET['action'])) {
    $action = $_GET['action'];
}

// tabla de ruteo

// listar  -> TaskController->showTask();
// nueva  -> TaskController->addTask();
// eliminar/:ID  -> TaskController->deleteTask($id);
// finalizar/:ID -> TaskController->finishTask($id);
// ver/:ID -> TaskController->view($id); COMPLETAR

// parsea la accion para separar accion real de parametros
$params = explode('/', $action);

switch ($params[0]) {
    case 'players':
        $controller = new PlayerController();
        $controller->showPlayers();
        break;
    case 'new':
        $controller = new PlayerController();
        $controller->addPlayer();
        break;
    case 'delete':
        $controller = new PlayerController();
        $controller->deletePlayer($params[1]);
        break;
    case 'edit':
        $controller = new PlayerController();
        $controller->editPlayer($params[1]);
        break;
    default: 
        echo "404 Page Not Found"; // deberiamos llamar a un controlador que maneje esto
        break;
}