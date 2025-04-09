<?php 

class authView {

    function showLogin($error = null){
        require 'templates/login.phtml';
    }

    function showRegistro($error = null){
        require 'templates/registro.phtml';
    }

    function showLogout(){
        require 'templates/home.phtml';
    }

    function showPerfil(){
        require 'templates/perfil.phtml';
    }

    function showHome(){
        require 'templates/home.phtml';
    }

}