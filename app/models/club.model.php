<?php

class ClubModel {
    private $db;

    public function __construct() {
       $this->db = new PDO('mysql:host=localhost;dbname=futbol-db;charset=utf8', 'root', '');
    }
 
    public function getClubs() {
        // 2. Ejecuto la consulta
        $query = $this->db->prepare('SELECT * FROM clubes');
        $query->execute();
    
        // 3. Obtengo los datos en un arreglo de objetos
        $clubs = $query->fetchAll(PDO::FETCH_OBJ); 
    
        return $clubs;
    }
 
    public function getClub($id) {    
        $query = $this->db->prepare('SELECT * FROM clubes WHERE id_club = ?');
        $query->execute([$id]);   
    
        $club = $query->fetch(PDO::FETCH_OBJ);
    
        return $club;
    }
 
    public function insertClub($title, $description, $priority, $finished = false) { 
        $query = $this->db->prepare('INSERT INTO tareas(titulo, descripcion, prioridad, finalizada) VALUES (?, ?, ?, ?)');
        $query->execute([$title, $description, $priority, $finished]);
    
        $id = $this->db->lastInsertId();
    
        return $id;
    }
 
    public function eraseClub($id) {
        $query = $this->db->prepare('DELETE FROM tareas WHERE id = ?');
        $query->execute([$id]);
    }

    public function updateClub($id) {        
        $query = $this->db->prepare('UPDATE tareas SET finalizada = 1 WHERE id = ?');
        $query->execute([$id]);
    }
}