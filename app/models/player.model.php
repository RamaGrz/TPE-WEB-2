<?php

class PlayerModel {
    private $db;

    public function __construct() {
       $this->db = new PDO('mysql:host=localhost;dbname=futbol_db;charset=utf8', 'root', '');
    }
 
    public function getPlayers() {
        // 2. Ejecuto la consulta
        $query = $this->db->prepare('SELECT * FROM tareas');
        $query->execute();
    
        // 3. Obtengo los datos en un arreglo de objetos
        $tasks = $query->fetchAll(PDO::FETCH_OBJ); 
    
        return $tasks;
    }
 
    public function getPlayer($id) {    
        $query = $this->db->prepare('SELECT * FROM tareas WHERE id = ?');
        $query->execute([$id]);   
    
        $task = $query->fetch(PDO::FETCH_OBJ);
    
        return $task;
    }
 
    public function insertPlayer($title, $description, $priority, $finished = false) { 
        $query = $this->db->prepare('INSERT INTO tareas(titulo, descripcion, prioridad, finalizada) VALUES (?, ?, ?, ?)');
        $query->execute([$title, $description, $priority, $finished]);
    
        $id = $this->db->lastInsertId();
    
        return $id;
    }
 
    public function erasePlayer($id) {
        $query = $this->db->prepare('DELETE FROM tareas WHERE id = ?');
        $query->execute([$id]);
    }

    public function updatePlayer($id) {        
        $query = $this->db->prepare('UPDATE tareas SET finalizada = 1 WHERE id = ?');
        $query->execute([$id]);
    }
}