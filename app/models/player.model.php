<?php

class PlayerModel {
    private $db;

    public function __construct() {
       $this->db = new PDO('mysql:host=localhost;dbname=futbol-db;charset=utf8', 'root', '');
    }
 
    function getPlayers(){
        $query = $this->db->prepare('SELECT jugadores.*, clubes.nombre AS nombre_club FROM jugadores INNER JOIN clubes ON jugadores.id_club = clubes.id_club');
        $query->execute();

        $players = $query->fetchAll(PDO::FETCH_OBJ);
        return $players;
    }



    function getPlayer($id){
        $query = $this->db->prepare('SELECT jugadores.*, clubes.nombre AS nombre_club FROM jugadores INNER JOIN clubes ON jugadores.id_club = clubes.id_club WHERE id_jugador = ?');
        $query->execute([$id]);

        $jugador = $query->fetch(PDO::FETCH_OBJ);
        return $jugador;
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

    function updatePlayer($id, $nombre, $nacionalidad, $posicion, $edad, $id_club){
        $query = $this->db->prepare('UPDATE jugadores SET nombre = ?, nacionalidad = ?, posicion = ?,edad = ?, id_club = ? WHERE id_jugador = ?');
        $query->execute([$nombre,  $nacionalidad, $posicion, $edad,$id_club,$id]);
    }
    function getJugadoresConNombreDeClubByClubId($id){
        $query = $this->db->prepare('SELECT jugadores.*, clubes.nombre AS nombre_club FROM jugadores INNER JOIN clubes ON jugadores.id_club = clubes.id_club WHERE jugadores.id_club = ?');
        $query->execute([$id]);

        $players = $query->fetchAll(PDO::FETCH_OBJ);
        return $players;
    }
} 