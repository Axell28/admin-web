<?php

class Empresa extends Controller
{

    public $model;

    public function __construct()
    {
        parent::__construct();
        parent::validarSesion();
        $this->model = new EmpresaModel();
        $this->nameView = strtolower(get_class($this));
    }

    public function index()
    {
        $this->dataEmp = $this->model->getDatosEmpresa();
        parent::renderView($this->nameView);
    }

    public function actualizar()
    {
        if (!empty($_POST)) {
            $params = array();
            $params[] = parent::getPost('nombre');
            $params[] = parent::getPost('telefono');
            $params[] = parent::getPost('celular');
            $params[] = parent::getPost('direction');
            $params[] = parent::getPost('correo');
            $params[] = parent::getPost('metades');
            $params[] = parent::getPost('facebook');
            $params[] = parent::getPost('instagram');
            $params[] = parent::getPost('whatsapp');
            $params[] = parent::getPost('youtube');
            $params[] = parent::getPost('twitter');
            $params[] = parent::getPost('intranet');
            $params[] = parent::getPost('liblink');
            $params[] = parent::getPost('libmail');
            $params[] = parent::getPost('idemp');
            $result = $this->model->editarDataEmpresa($params);
            if ($result) echo 'OK';
        } else {
            die('Error: No se pudo actualizar los datos');
        }
    }
}
