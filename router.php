<?php
require_once 'app/controllers/task.controller.php';

// base_url para redirecciones y base tag
define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');

$action = 'listar'; // accion por defecto si no se envia ninguna
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
    case 'listar':
        $controller = new TaskController();
        $controller->showTasks();
        break;
    case 'nueva':
        $controller = new TaskController();
        $controller->addTask();
        break;
    case 'eliminar':
        $controller = new TaskController();
        $controller->deleteTask($params[1]);
        break;
    case 'finalizar':
        $controller = new TaskController();
        $controller->finishTask($params[1]);
        break;
    default: 
        echo "404 Page Not Found"; // deberiamos llamar a un controlador que maneje esto
        break;
}