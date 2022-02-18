<?php

class Banner extends Controller
{
    public $model;
    public $estruct;

    public function __construct()
    {
        parent::__construct();
        parent::validarSesion();
        $this->model = new BannerModel();
        $this->estruct = $this->model->obtenerBanner();
        $this->nameView = strtolower(get_class($this));
    }

    public function index()
    {
        header("Location: /admin/banner/{$this->estruct['tipo']}");
    }

    // no añaden esta función todavía
    public function editor($params)
    {
        if(!empty($params) && is_numeric($params[0])) {
            $index = $params[0];
            $arrCuerpo = json_decode($this->estruct['cuerpo'], true);
            $this->imgBanner = $arrCuerpo[$index]['imagen'];
            parent::renderView('banner.editor');
        }
    }

    public function slider()
    {
        $this->tipoBanner = 'slider';
        $this->jsonData = $this->estruct['tipo'] == $this->tipoBanner ? $this->estruct['cuerpo'] : '[]';
        $filesModel = new ArchivosModel();
        $this->listFiles = $filesModel->listarArchivos('/img/banner/');
        parent::renderView($this->nameView);
    }

    public function video()
    {
        $this->tipoBanner = 'video';
        $this->jsonData = array('video' => '', 'control' => false, 'muted' => true, 'repeat' => false);
        if ($this->estruct['tipo'] == $this->tipoBanner) :
            $this->jsonData = (array) json_decode($this->estruct['cuerpo']);
        endif;
        $filesModel = new ArchivosModel();
        $this->listFiles = $filesModel->listarArchivos('/video/');
        parent::renderView($this->nameView);
    }

    public function actualizar()
    {
        if (!empty($_POST)) {
            $params = array();
            $params[] = parent::getPost('tipo');
            $params[] = parent::getPost('cuerpo');
            $result = $this->model->editarBanner($params);
            if ($result) echo "OK";
        } else {
            die('Error en la solicitud => ' . __METHOD__);
        }
    }
}
