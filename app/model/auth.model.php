<?php 

class authModel {
    private $db;
    
    function __construct(){
        $this->db = new PDO('mysql:host=localhost;'.'dbname=to-dolist;charset=utf8', 'root', '');
    }

    function getUserByName($username){
        $query = $this->db->prepare('SELECT * FROM user WHERE nombre_user = ?');
        $query->execute([$username]);

        return $query->fetch(PDO::FETCH_OBJ);
    }

    function addUser($username, $password, $mail){
        $query = $this->db->prepare('INSERT INTO user (nombre_user, contrasenia_user, mail_user) VALUES (?,?,?) ');
        $query->execute([$username, $password, $mail]);

        return $this->db->lastInsertId();
    }

}