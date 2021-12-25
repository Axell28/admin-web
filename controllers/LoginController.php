<?php 

class Login {

    private $model;

    public function __construct()
    {
        
    }

    public function index()
    {
        require_once DIROOT . '/views/admin/login.php';
    }

    public function validarAcceso()
    {
        if(!empty($_POST)) {
            $user = $_POST['name'];
            $pass = $_POST['pass'];
            print_r($_POST);
        }
    }

}
