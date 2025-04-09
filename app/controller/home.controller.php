<?php 
require_once __DIR__ . '/../helper/auth.helper.php';
// AuthHelper::init();
require_once 'app/view/home.view.php';
require_once 'app/model/tarea.model.php';
require_once 'app/model/auth.model.php';

class homeController {
    private $view;
    private $tareaModel;
    private $authModel;
    private $authHelper;

    function __construct(){
        $this->view = new homeView();
        $this->tareaModel = new tareaModel();
        $this->authModel = new authModel();
        $this->authHelper = new authHelper();
    }

    function showHome(){
        session_start();
        $userId = $_SESSION['USER_ID'];
        $tareas = $this->tareaModel->todaLasTareas($userId);
        $this->view->showHome($tareas);
    }

}