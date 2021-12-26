<?php 

class Controller {

    public function renderView($view)
    {
        require_once DIROOT . "/views/admin/{$view}.php";
    }

    public function getPost($name)
    {
        return isset($_POST[$name]) ? $_POST[$name] : null;
    }

    public function getFile($name)
    {
        return isset($_FILES[$name]) ? $_FILES[$name] : null;
    }

}