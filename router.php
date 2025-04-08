<?php 

require 'app/controller/home.controller.php';
require 'app/view/home.view.php';
require 'app/model/home.model.php';

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

}