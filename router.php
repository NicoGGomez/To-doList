<?php 

require 'app/controller/home.controller.php';
require 'app/controller/auth.controller.php';
require 'app/controller/tarea.controller.php';

define('BASE_URL', '//' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']) . '/');

$action = 'home';

if(!empty($_GET['action'])){
    $action = $_GET['action'];
}

$params = explode('/', $action);

switch($params[0]){

    case 'home' : 
        $homeController = new homeController();
        $homeController->showHome();
        break;

    case 'agregarTarea' :
        $tareaController = new tareaController();
        $tareaController->agregarTarea();
        break;

    case 'delete' :
        $tareaController = new tareaController();
        if (isset($params[1])) {
            $tareaController->borrarTarea($params[1]);
        }
        break;
        
    case 'sesionIniciada':
        $authController = new authController();
        $authController->auth();
        break;

    case 'sesionTerminada':
        $authController = new authController();
        $authController->showLogout();
        break;

    case 'login' : 
        $authController = new authController();
        $authController->showLogin();
        break;

    case 'perfil':
        $authController = new authController();
        $authController->showPerfil();
        break;

    case 'borrarCuenta':
        $authController = new authController();
        if (isset($params[1])) {
            $authController->deleteAccount($params[1]);
        }
        break;

    case 'sesionRegistrada':
        $authController = new authController();
        $authController->addUser();
        break;

    case 'registro' :
        $authController = new authController();
        $authController->showRegistro();
        break;

    default:
    echo 'ERROR 404';
        break;

}