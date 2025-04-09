<?php

require_once 'app/view/auth.view.php';
require_once 'app/model/auth.model.php';
require_once 'app/helper/auth.helper.php';

class authController {
    private $view;
    private $model;

    function __construct(){
        $this->view = new authView();
        $this->model = new authModel();
    }

    function auth(){
        $username = $_POST['nombre'];
        $password = $_POST['password'];

        if(empty($username) || empty($password)){
            $this->view->showLogin('faltan completar datos!!');
            return;
        }

        $user = $this->model->getUserByName($username);

        if($user && $user->contrasenia_user === $password){
            authHelper::login($user);
        } else {
            $this->view->showLogin('usuario invalido!!');
        }

    }

    function addUser(){
        $username = $_POST['nombre'];
        $password = $_POST['password'];
        $mail = $_POST['mail'];

        if (empty($username) || empty($password) || empty($mail)) {
            $this->view->showRegistro('faltan completar datos');
            return;
        }

        if ($this->userExistente($username)) {
            $this->model->addUser($username, $password, $mail);
            $this->view->showHome();
            $this->auth();
        } else {
            $this->view->showRegistro('usuario ya registrado');
        }
    }

    function userExistente($nombre){
        $user = $this->model->getUserByName($nombre);
        if(empty($user)){
            return true;
        }
        return false;
    }

    function showLogin(){
        $this->view->showLogin();
    }

    function showLogout(){
        authHelper::logout();
        $this->view->showLogout();
    }

    function showRegistro(){
        $this->view->showRegistro();
    }

    function showPerfil(){
        $this->view->showPerfil();
    }

}