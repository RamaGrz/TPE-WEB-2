<?php

class PlayerModel {
    private $db;

    public function __construct() {
       $this->db = new PDO('mysql:host=localhost;dbname=futbol-db;charset=utf8', 'root', '');
    }
 
    public function getPlayers() {
        // 2. Ejecuto la consulta
        $query = $this->db->prepare('SELECT * FROM jugadores');
        $query->execute();
    
        // 3. Obtengo los datos en un arreglo de objetos
        $players = $query->fetchAll(PDO::FETCH_OBJ); 
    
        return $players;
    }
 
    public function getPlayer($id) {    
        $query = $this->db->prepare('SELECT * FROM jugadores WHERE id_jugador = ?');
        $query->execute([$id]);   
    
        $player = $query->fetch(PDO::FETCH_OBJ);
    
        return $player;
    }
 
    public function insertPlayer($nombre, $nacionalidad, $posicion, $edad,$id_club) { 
        $query = $this->db->prepare('INSERT INTO jugadores(nombre, nacionalidad, posicion, edad, id_club) VALUES (?, ?, ?, ?, ?)');
        $query->execute([$nombre, $nacionalidad, $posicion, $edad, $id_club]);
    
        $id = $this->db->lastInsertId();
    
        return $id;
    }
 
    public function erasePlayer($id) {
        $query = $this->db->prepare('DELETE FROM jugadores WHERE id_jugador = ?');
        $query->execute([$id]);
    }

    function updatePlayer($id, $nombre, $nacionalidad, $posicion, $edad, $id_jugador){
        $query = $this->db->prepare('UPDATE jugadores SET nombre = ?, nacionalidad = ?, posicion = ?,edad = ? WHERE id_jugador = ?');
        $query->execute([$nombre,  $nacionalidad, $posicion, $edad,$id]);
    }
} 