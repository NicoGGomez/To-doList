<?php 

class tareaModel {
    private $db;
    
    function __construct(){
        $this->db = new PDO('mysql:host=localhost;'.'dbname=to-dolist;charset=utf8', 'root', '');
    }

    function agregarTarea($nombreTarea, $descrTarea, $booleanTarea){
        $query = $this->db->prepare('INSERT INTO tarea (nombre_tarea, contenido_tarea, tarea_completa) VALUES (?,?,?)');
        $query->execute([$nombreTarea, $descrTarea, $booleanTarea]);

        return $this->db->lastInsertId();
    }

    function todaLasTareas($id){
        $query = $this->db->prepare('SELECT * FROM id_tarea_fk WHERE id_user = ?');
        $query->execute([$id]);
        return $query->fetch(PDO::FETCH_OBJ);
    }

}