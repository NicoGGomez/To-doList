<?php 

class homeView {
    
    function showHome($tar = null){
        $tareas = $tar;
        require 'templates/home.phtml';
    }

}