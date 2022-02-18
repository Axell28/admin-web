<?php

class Login extends Controller
{

    private $model;

    public function __construct()
    {
        parent::__construct();
        $this->model = new LoginModel();
        $this->nameView = strtolower(get_class($this));
    }

    public function index()
    {
        parent::renderView($this->nameView);
    }

    public function auth()
    {
        if (!empty($_POST)) {
            $name = Funciones::limpString(parent::getPost('name'));
            $pass = Funciones::limpString(parent::getPost('pass'));
            $resp = $this->model->validarLogueo($name, $pass);
            if ($resp == 'OK') {
                session_start();
                session_regenerate_id();
                $_SESSION['auth-name'] = $name;
                $_SESSION['auth-time'] = time();
                echo 'OK';
            } else {
                die($this->translate($resp));
            }
        } else {
            die($this->translate('No se pudo procesar la solicitud'));
        }
    }

    public function logout()
    {
        session_start();
        session_destroy();
        header('Location: ' . WEBURL . '/admin/login');
    }
}
