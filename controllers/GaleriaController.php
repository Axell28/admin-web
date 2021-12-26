<?php 

require_once DIROOT . '/models/ArchivosModel.php';

class Galeria extends Controller {

    public $model;
    public $nameView; 

    public function __construct()
    {
        $this->nameView = strtolower(get_class($this));
    }

    public function index()
    {
        $filesModel = new ArchivosModel();
        $this->totalArchivos = $filesModel->totalArchivos('/img/fotos/');
        parent::renderView($this->nameView);
    }

    public function files($params)
    {
        $filesModel = new ArchivosModel();
        $listFotos = $filesModel->listarArchivos("/img/fotos/");
        $ini = $params[0]; 
        $lim = $params[1];
        $nuevaLista = array();
        if($lim <= $filesModel->totalArchivos('/img/fotos/')) {
            for ($i = $ini; $i < $lim ; $i++) { 
                $nuevaLista[] = $listFotos[$i];
            }
        } else {
            $lim = $filesModel->totalArchivos('/img/fotos/');
            for ($i = $ini; $i < $lim ; $i++) { 
                $nuevaLista[] = $listFotos[$i];
            }
        }
        echo json_encode($nuevaLista, JSON_UNESCAPED_UNICODE);
    }

}