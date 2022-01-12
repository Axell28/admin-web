<?php

require_once DIROOT . '/models/NoticiasModel.php';
require_once DIROOT . '/models/ArchivosModel.php';

class Editor extends Controller
{
    public $model;

    public function __construct()
    {
        $this->model = new NoticiasModel();
        $this->nameView = strtolower(get_class($this));
    }

    public function index()
    {
        $filesModel = new ArchivosModel();
        $this->action = 'guardar';
        $this->noticiaInfo = array();
        $this->noticiaInfo['idnot'] = null;
        $this->noticiaInfo['idcat'] = '1';
        $this->noticiaInfo['fecpub'] = date("Y-m-d");
        $this->noticiaInfo['titulo'] = null;
        $this->noticiaInfo['cuerpo'] = null;
        $this->noticiaInfo['portada'] = null;
        $this->noticiaInfo['detalle'] = null;
        $this->listCategs = $this->model->listarCategorias();
        $this->listFiles = array();
        $this->listFiles['fotos'] = $filesModel->listarArchivos('/img/galeria/');
        $this->listFiles['video'] = $filesModel->listarArchivos('/video/');
        $this->listFiles['files'] = $filesModel->listarArchivos('/files/');
        parent::renderView($this->nameView);
    }

    public function vista($param)
    {
        $idnoticia = $param[0];
        if (is_numeric($idnoticia)) {
            $filesModel = new ArchivosModel();
            $this->action = 'editar';
            $this->noticiaInfo = $this->model->buscarNoticia($idnoticia);
            $this->listCategs = $this->model->listarCategorias();
            $this->listFiles = array();
            $this->listFiles['fotos'] = $filesModel->listarArchivos('/img/galeria/');
            $this->listFiles['video'] = $filesModel->listarArchivos('/video/');
            $this->listFiles['files'] = $filesModel->listarArchivos('/files/');
            parent::renderView($this->nameView);
        }
    }

    public function guardar()
    {
        if (!empty($_POST)) {
            $datos = array();
            $datos[] = parent::getPost("categ");
            $datos[] = parent::getPost("titulo");
            $datos[] = Funciones::formatURL(parent::getPost("titulo"));
            $datos[] = parent::getPost("portada");
            $datos[] = parent::getPost("detalle");
            $datos[] = parent::getPost("cuerpo");
            $datos[] = parent::getPost("fecpub");
            $result = $this->model->guardarNoticia($datos);
            if ($result) echo "OK";
        } else {
            die('Error en la solicitud => ' . __METHOD__);
        }
    }

    public function editar()
    {
        if (!empty($_POST)) {
            $datos = array();
            $datos[] = parent::getPost("categ");
            $datos[] = parent::getPost("titulo");
            $datos[] = Funciones::formatURL(parent::getPost("titulo"));
            $datos[] = parent::getPost("portada");
            $datos[] = parent::getPost("detalle");
            $datos[] = parent::getPost("cuerpo");
            $datos[] = parent::getPost("fecpub");
            $datos[] = parent::getPost("idnot");
            $result = $this->model->editarNoticia($datos);
            if ($result) echo "OK";
        } else {
            die('Error en la solicitud => ' . __METHOD__);
        }
    }
}
