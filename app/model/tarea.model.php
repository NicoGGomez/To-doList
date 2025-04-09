<?php 

class tareaModel {
    private $db;
    
    function __construct(){
        $this->db = new PDO('mysql:host=localhost;'.'dbname=to-dolist;charset=utf8', 'root', '');
    }

    function agregarTarea($userId, $nombreTarea, $descrTarea, $booleanTarea){
        $query = $this->db->prepare('INSERT INTO tarea ( id_user_fk, nombre_tarea, contenido_tarea, tarea_completa) VALUES (?,?,?,?)');
        $query->execute([$userId, $nombreTarea, $descrTarea, $booleanTarea]);

        return $this->db->lastInsertId();
    }

    function todaLasTareas($id){
        $query = $this->db->prepare('SELECT * FROM tarea WHERE id_user_fk = ?');
        $query->execute([$id]);
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    function borrarTareaPorId($id){
        $query = $this->db->prepare('DELETE FROM tarea WHERE id_tarea = ?');
        $query->execute([$id]);
    }

}