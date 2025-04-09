<?php 

class authHelper {

    public static function init(){
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public static function login($user){
        self::init();
        $_SESSION['USER_NAME'] = $user->nombre_user;
        $_SESSION['USER_ID'] = $user->id_user;
        $_SESSION['USER_MAIL'] = $user->mail_user;
        // var_dump($_SESSION);
        header('location: ' . BASE_URL);
        exit();
    }

    public static function logout() {
        self::init();
        session_unset();  
        session_destroy();  
        header('Location: ' . BASE_URL);
    }

}