<?php

class Controller
{

    private $gt;

    public function __construct()
    {
        $this->gt = new GoogleTranslate();
    }

    public function renderView(string $view)
    {
        $file = DIROOT . "/views/admin/{$view}.php";
        if (is_file($file)) {
            require_once DIROOT . "/views/admin/{$view}.php";
        }
    }

    public function translate(string $str, string $convert = 'en')
    {
        $str = $this->gt->translate(LANG_DEFAULT, $convert, $str);
        return $str;
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
