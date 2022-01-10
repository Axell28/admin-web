<?php

require_once DIROOT . '/models/ArchivosModel.php';

class Archivos extends Controller
{

    public $model;
    public $nameView;

    public function __construct()
    {
        $this->model = new ArchivosModel();
        $this->nameView = strtolower(get_class($this));
    }

    public function index()
    {
        parent::renderView($this->nameView);
    }

    public function guardar()
    {
        if (!empty($_POST) && !empty($_FILES)) {
            $path = parent::getPost('path');
            $file = parent::getFile('file');
            $resp = $this->model->guardarArchivo($file, $path);
            if ($resp) {
                echo "OK";
            } else {
                die("No se pudo guardar el archivo");
            }
        } else {
            die('Error en la solicitud => ' . __METHOD__);
        }
    }
    
    public function listar($params)
    {
        if (!empty($_POST)) {
            $pivotFiles = $this->model->listarArchivos(parent::getPost("path"));
            echo json_encode($pivotFiles, JSON_UNESCAPED_UNICODE);
        } else {
            die('Error en la solicitud => ' . __METHOD__);
        }
    }
}
