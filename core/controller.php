<?php

class Controller
{

    public function renderView($view)
    {
        $file = DIROOT . "/views/admin/{$view}.php";
        if (is_file($file)) {
            require_once DIROOT . "/views/admin/{$view}.php";
        }
    }

    public function getPost($name)
    {
        return isset($_POST[$name]) ? $_POST[$name] : null;
    }

    public function getFile($name)
    {
        return isset($_FILES[$name]) ? $_FILES[$name] : null;
    }

    public function validarSesion()
    {
        session_start();
        if (!isset($_SESSION['auth-name'])) {
            header("Location: /admin/login");
        }
    }
}
