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
        
        if($user && password_verify($password, $user->contrasenia_user)){
            authHelper::login($user);
        } else {
            $this->view->showLogin('usuario invalido!!');
        }

    }

    function addUser(){
        $username = $_POST['nombre'];
        $password = $_POST['password'];
        $passwordHashed = password_hash($password, PASSWORD_DEFAULT);
        $mail = $_POST['mail'];

        if (empty($username) || empty($password) || empty($mail)) {
            $this->view->showRegistro('faltan completar datos');
            return;
        }

        if ($this->userExistente($username)) {
            $this->model->addUser($username, $passwordHashed, $mail);
            $this->view->showHome($username->id_tarea_fk);
            $this->auth();
        } else {
            $this->view->showRegistro('usuario ya registrado');
        }
    }

    function deleteAccount($userId){
        session_start();
        $this->model->deleteAccountById($userId);
        authHelper::logout();
        $this->view->showLogin();
        header("Location: " . BASE_URL . "login");
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