<?php
require_once './app/models/player.model.php';
require_once './app/views/player.view.php';
require_once './app/models/club.model.php';

class PlayerController {
    private $model;
    private $view;

    public function __construct() {
        $this->model = new PlayerModel();
        $this->modelClub = new ClubModel();
        $this->view = new PlayerView();
    }

    public function showPlayers() {
        // obtengo las tareas de la DB
        $players = $this->model->getPlayers();
        $clubs = $this->modelClub->getClubs();

        // mando las tareas a la vista
        return $this->view->showPlayers($players,$clubs);
    }
    public function showPlayer($id) {
        // obtengo las tareas de la DB
        $player = $this->model->getPlayer($id);

        // mando las tareas a la vista
        return $this->view->showPlayer($player);
    }

    public function addPlayer() {
       if (!isset($_POST['nombre']) || empty($_POST['nombre'])) {
            return $this->view->showError('Falta completar el nombre');
        }
    
        if (!isset($_POST['nacionalidad']) || empty($_POST['nacionalidad'])) {
            return $this->view->showError('Falta completar la nacionalidad');
        }
        if (!isset($_POST['posicion']) || empty($_POST['posicion'])) {
            return $this->view->showError('Falta completar la posicion');
        }
        if (!isset($_POST['edad']) || empty($_POST['edad'])) {
            return $this->view->showError('Falta completar la nacionalidad');
        }
        if (!isset($_POST['id_club']) || empty($_POST['id_club'])) {
            return $this->view->showError('Falta completar el club');
        }
       
            
    
        $nombre = $_POST['nombre'];
        $nacionalidad = $_POST['nacionalidad'];
        $posicion = $_POST['posicion'];
        $edad = $_POST['edad'];
        $id_club = $_POST['id_club'];
        
    
        $id = $this->model->insertPlayer($nombre, $nacionalidad, $posicion, $edad,$id_club);
    
        // redirijo al home (también podriamos usar un método de una vista para motrar un mensaje de éxito)
        header('Location: ' . BASE_URL);
    }

    
    public function deletePlayer($id) {
        // obtengo el club por id
        $player = $this->model->getPlayer($id);
        
        // si el jugador no existe, redirijo a la lista de jugadores
        if (empty($player)) {
            header('Location: ' . BASE_URL);
            return; // retorno para salir de la función
        }
    
        // borro el jugador
        $this->model->erasePlayer($id);
    
        // redirijo a la lista de jugadores
        header('Location: ' . BASE_URL);
        return; // retorno para finalizar la ejecución de la función
    }
    

   /* public function editPlayer($id) {
        $player = $this->model->getPlayer($id);

        if (!$player) {
            return $this->view->showError("No existe jugador con el id=$id");
        }

        // actualiza la tarea
        $this->model->updatePlayer($id);

        header('Location: ' . BASE_URL);
    }*/
}

