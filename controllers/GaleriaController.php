<?php

class Galeria extends Controller
{

    public $model;

    public function __construct()
    {
        parent::validarSesion();
        $this->model = new GaleriaModel();
        $this->nameView = strtolower(get_class($this));
    }

    public function index()
    {
        $this->listGaleria = $this->model->listarGalerias();
        parent::renderView($this->nameView);
    }

    public function vista($params)
    {
        $this->action = 'guardar';
        $this->galeriaInfo = array();
        if (empty($params)) {
            $this->galeriaInfo['idgal'] = null;
            $this->galeriaInfo['titulo'] = '';
            $this->galeriaInfo['detalle'] = '';
            $this->galeriaInfo['portada'] = '';
            $this->galeriaInfo['ncolum'] = '3';
            $this->galeriaInfo['cuerpo'] = '[]';
            $this->galeriaInfo['modo'] = 'A';
        } else {
            $this->action = 'editar';
            $this->galeriaInfo = $this->model->buscarGaleria($params[0]);
        }
        $filesModel = new ArchivosModel();
        $this->listFiles = $filesModel->listarArchivos('/img/galeria/');
        parent::renderView('galeria-editor');
    }

    public function guardar()
    {
        if (!empty($_POST)) {
            $params = array();
            $params[] = parent::getPost("titulo");
            $params[] = parent::getPost("detalle");
            $params[] = parent::getPost("colum");
            $params[] = parent::getPost("cuerpo");
            $params[] = parent::getPost("modo");
            $params[] = parent::getPost("portada");
            $resp = $this->model->guardarGaleria($params);
            if ($resp) echo "OK";
        } else {
            die('Error: No se pudo realizar la operación');
        }
    }

    public function editar()
    {
        if (!empty($_POST)) {
            $params = array();
            $params[] = parent::getPost("titulo");
            $params[] = parent::getPost("detalle");
            $params[] = parent::getPost("colum");
            $params[] = parent::getPost("cuerpo");
            $params[] = parent::getPost("modo");
            $params[] = parent::getPost("portada");
            $params[] = parent::getPost("idgal");
            $resp = $this->model->editarGaleria($params);
            if ($resp) echo "OK";
        } else {
            die('Error: No se pudo realizar la operación');
        }
    }

    public function eliminar($params)
    {
        if(!empty($params) && is_numeric($params[0])) {
            $idgal = $params[0];
            $resp = $this->model->eliminarGaleria($idgal);
            if($resp) echo "OK";
        } else {
            die('Error: No se pudo realizar la operación');
        }
    }
}
