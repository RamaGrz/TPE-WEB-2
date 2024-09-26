<?php
require_once './app/models/player.model.php';
require_once './app/views/task.view.php';

class PlayerController {
    private $model;
    private $view;

    public function __construct() {
        $this->model = new PlayerModel();
        $this->view = new PlayerView();
    }

    public function showPlayers() {
        // obtengo las tareas de la DB
        $tasks = $this->model->getPlayers();

        // mando las tareas a la vista
        return $this->view->showPlayers($tasks);
    }

    public function addPlayer() {
        if (!isset($_POST['title']) || empty($_POST['title'])) {
            return $this->view->showError('Falta completar el título');
        }
    
        if (!isset($_POST['priority']) || empty($_POST['priority'])) {
            return $this->view->showError('Falta completar la prioridad');
        }
    
        $title = $_POST['title'];
        $description = $_POST['description'];
        $priority = $_POST['priority'];
    
        $id = $this->model->insertPlayer($title, $description, $priority);
    
        // redirijo al home (también podriamos usar un método de una vista para motrar un mensaje de éxito)
        header('Location: ' . BASE_URL);
    }

    
    public function deletePlayer($id) {
        // obtengo la tarea por id
        $task = $this->model->getPlayer($id);

        if (!$task) {
            return $this->view->showError("No existe la tarea con el id=$id");
        }

        // borro la tarea y redirijo
        $this->model->erasePlayer($id);

        header('Location: ' . BASE_URL);
    }

    public function editPlayer($id) {
        $task = $this->model->getPlayer($id);

        if (!$task) {
            return $this->view->showError("No existe la tarea con el id=$id");
        }

        // actualiza la tarea
        $this->model->updatePlayer($id);

        header('Location: ' . BASE_URL);
    }
}

