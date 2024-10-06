<?php

class UserModel {
    private $db;

    public function __construct() {
       $this->db = new PDO('mysql:host=localhost;dbname=futbol-db;charset=utf8', 'root', '');
    }

    public function getUserByUser($usuario) {    
        $query = $this->db->prepare("SELECT * FROM usuarios WHERE usuario = ?");
        $query->execute([$usuario]);
    
        return $query->fetch(PDO::FETCH_OBJ);
    
    }
}