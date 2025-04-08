<?php 

require 'app/view/home.view.php';
require 'app/model/home.model.php';

class homeController {
    private $view;
    private $model;

    function __construct(){
        $this->view = new homeView();
        $this->model = new homeModel();
    }

    function showHome(){
        $this->view->showHome();
    }

}