<?php
require_once './app/models/club.model.php';
require_once './app/views/club.view.php';

class ClubController {
    private $model;
    private $view;

    public function __construct() {
        $this->model = new ClubModel();
        $this->view = new ClubView();
    }

    public function showClubs() {
        // obtengo las tareas de la DB
        $clubs = $this->model->getClubs();

        // mando las tareas a la vista
        return $this->view->showClubs($clubs);
    }
    public function showClub($id) {
        // obtengo las tareas de la DB
        $club = $this->model->getClub($id);

        // mando las tareas a la vista
        return $this->view->showClub($club);
    }

    public function addClub() {
        if (!isset($_POST['title']) || empty($_POST['title'])) {
            return $this->view->showError('Falta completar el título');
        }
    
        if (!isset($_POST['priority']) || empty($_POST['priority'])) {
            return $this->view->showError('Falta completar la prioridad');
        }
    
        $title = $_POST['title'];
        $description = $_POST['description'];
        $priority = $_POST['priority'];
    
        $id = $this->model->insertClub($title, $description, $priority);
    
        // redirijo al home (también podriamos usar un método de una vista para motrar un mensaje de éxito)
        header('Location: ' . BASE_URL);
    }

    
    public function deleteClub($id) {
        // obtengo la tarea por id
        $club = $this->model->getClub($id);

        if (!$club) {
            return $this->view->showError("No existe la tarea con el id=$id");
        }

        // borro la tarea y redirijo
        $this->model->eraseClub($id);

        header('Location: ' . BASE_URL);
    }

    public function editClub($id) {
        $club = $this->model->getClub($id);

        if (!$club) {
            return $this->view->showError("No existe la tarea con el id=$id");
        }

        // actualiza la tarea
        $this->model->updateClub($id);

        header('Location: ' . BASE_URL);
    }
}