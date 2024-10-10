<?php
require_once './app/models/Model.php';
class ClubModel  extends Model{
  
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
 
    public function insertClub($nombre, $pais, $fecha, $titulos) { 
        $query = $this->db->prepare('INSERT INTO clubes(nombre, pais, fecha_fundacion, titulos) VALUES (?, ?, ?, ?)');
        $query->execute([$nombre, $pais, $fecha, $titulos]);
    
        $id = $this->db->lastInsertId();
    
        return $id;
    }
 
    public function eraseClub($id) {
        $query = $this->db->prepare('DELETE FROM clubes WHERE id_club = ?');
        $query->execute([$id]);
    }

    function updateClub($id, $nombre, $pais, $fecha_fundacion, $titulos){
        $query = $this->db->prepare('UPDATE clubes SET nombre = ?, pais = ?, fecha_fundacion = ?,titulos = ? WHERE id_club = ?');
        $query->execute([$nombre,  $pais, $fecha_fundacion, $titulos,$id]);
    }
}