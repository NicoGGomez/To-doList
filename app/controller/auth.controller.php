<?php

require 'app/view/auth.view.php';
require 'app/model/auth.model.php';

class authController {
    private $view;
    private $model;

    function __construct(){
        $this->view = new authView();
        $this->model = new authModel();
    }

    function showLogin(){
        $this->view->showLogin();
    }

    function showRegistro(){
        $this->view->showRegistro();
    }

}