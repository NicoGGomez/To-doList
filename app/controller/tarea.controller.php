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
        $nombreTarea = $_POST['nombreTarea'];
        $descripcionTarea = $_POST['descripcionTarea'];
        $booleanTarea = false;

        $this->model->agregarTarea($nombreTarea, $descripcionTarea, $booleanTarea);
        $this->view->showHome();
    }

}