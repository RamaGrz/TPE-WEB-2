<?php
require_once 'app/controllers/player.controller.php';
require_once 'app/controllers/home.controller.php';
require_once 'app/controllers/club.controller.php';
require_once 'app/controllers/auth.controller.php';


// base_url para redirecciones y base tag
define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');

$action = 'home'; // accion por defecto si no se envia ninguna
if (!empty( $_GET['action'])) {
    $action = $_GET['action'];
}


$params = explode('/', $action);

switch ($params[0]) {
    case 'home':
        $controller = new HomeController();
        $controller->showHome();
        break;
    case 'players':
        $controller = new PlayerController();
        $controller->showPlayers();
        break;
    case 'viewPlayer':
        $controller = new PlayerController;
        $controller->showPlayer($params[1]);
        break;
    case 'newPlayer':
        
        $controller = new PlayerController();
        $controller->addPlayer();
        break;
    case 'deletePlayer':
        
        $controller = new PlayerController();
        $controller->deletePlayer($params[1]);
        break;
    case 'editPlayer':
        $controller = new PlayerController();
        $controller->editPlayer($params[1]);
        break;
    case 'showEditPlayer':    
        $controller = new PlayerController();
        $controller->showEdit($params[1]);
           break;
    case 'clubs':
         $controller = new ClubController();
         $controller->showClubs();
         break;
    case 'viewClub':
        $controller = new ClubController;
        $controller->showClub($params[1]);
        break;
     case 'newClub':
        
        $controller = new ClubController();
        $controller->addClub();
        break;
    case 'deleteClub':
        
        $controller = new ClubController();
        $controller->deleteClub($params[1]);
         break;
    case 'showEditClub':
       
        $controller = new ClubController();
        $controller->showEdit($params[1]);
         break;     
    case 'editClub':
        
        $controller = new ClubController();
        $controller->editClub($params[1]);
        break;    
     case 'showLogin':
            $controller = new AuthController();
            $controller->showLogin();
            break;
    case 'login':
                $controller = new AuthController();
                $controller->login();
                break;
    case 'logout':
                $controller = new AuthController();
                $controller->logout();
                break;

    default: 
        echo "404 Page Not Found"; 
        break;
}