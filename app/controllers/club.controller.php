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
        if (!isset($_POST['nombre']) || empty($_POST['nombre'])) {
            return $this->view->showError('Falta completar el título');
        }
       
    
        $nombre = $_POST['nombre'];
        $pais = $_POST['pais'];
        $fecha= $_POST['fecha'];
        $titulos=$_POST['titulos'];
    
        $id = $this->model->insertClub($nombre, $pais, $fecha, $titulos);
    
        // redirijo al home (también podriamos usar un método de una vista para motrar un mensaje de éxito)
        header('Location: ' . BASE_URL );
    }

    
    public function deleteClub($id) {
        // obtengo el club por id
        $club = $this->model->getClub($id);
        
        // si el club no existe, redirijo a la lista de clubes
        if (empty($club)) {
            header('Location: ' . BASE_URL);
            return; // retorno para salir de la función
        }
    
        // borro el club
        $this->model->eraseClub($id);
    
        // redirijo a la lista de clubes
        header('Location: ' . BASE_URL . "lista_clubes");
        return; // retorno para finalizar la ejecución de la función
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