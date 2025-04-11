<?php 

require_once 'app/model/tarea.model.php';
require_once 'app/view/home.view.php';

class tareaController {
    private $model;
    private $view;

    function __construct(){
        $this->model = new tareaModel();
        $this->view = new homeView();
    }

    function agregarTarea(){
        session_start();
        $userId = $_SESSION['USER_ID'];
        $nombreTarea = $_POST['nombreTarea'];
        $descripcionTarea = $_POST['descripcionTarea'];
        $booleanTarea = false;

        $this->model->agregarTarea($userId, $nombreTarea, $descripcionTarea, $booleanTarea);
        $tareas = $this->model->todaLasTareas($userId);
        $this->view->showHome($tareas);
        header('Location: ' . BASE_URL);
    }

    function borrarTarea($idTarea){
        session_start();
        $this->model->borrarTareaPorId($idTarea);
        
        $userId = $_SESSION['USER_ID'];
        $tareas = $this->model->todaLasTareas($userId);
        header('Location: ' . BASE_URL);

    }

}