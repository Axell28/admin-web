<?php

require_once DIROOT . '/models/ArchivosModel.php';
require_once DIROOT . '/models/ModalModel.php';

class Modal extends Controller
{
    public $model;

    public function __construct()
    {
        parent::validarSesion();
        $this->model = new ModalModel();
        $this->nameView = strtolower(get_class($this));
    }

    public function index()
    {
        $filesModel = new ArchivosModel();
        $this->listFiles = array();
        $this->listFiles['fotos'] = $filesModel->listarArchivos('/img/galeria/');
        $this->listFiles['video'] = $filesModel->listarArchivos('/video/');
        $this->listFiles['files'] = $filesModel->listarArchivos('/files/');
        $this->arrModal = $this->model->obtenerModal();
        parent::renderView($this->nameView);
    }

    public function actualizar()
    {
        if (!empty($_POST)) {
            $titulo = parent::getPost("titulo");
            $cuerpo = parent::getPost("cuerpo");
            $visible = parent::getPost("visible");
            $result = $this->model->actualizarModal([$titulo, trim($cuerpo), $visible]);
            if ($result) echo "OK";
        } else {
            die('Error: No se pudo realizar la operación ' . __METHOD__);
        }
    }
}
