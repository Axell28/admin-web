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
            $arrDataEmp = parent::getPost("data");
            $arrDataEmp = json_decode($arrDataEmp, true);
            foreach ($arrDataEmp as $value) :
                $params = array();
                $params[] = $value['nombre'];
                $params[] = $value['telefono'];
                $params[] = $value['celular'];
                $params[] = $value['direction'];
                $params[] = $value['correo'];
                $params[] = $value['metades'];
                $params[] = $value['facebook'];
                $params[] = $value['instagram'];
                $params[] = $value['whatsapp'];
                $params[] = $value['youtube'];
                $params[] = $value['twitter'];
                $params[] = $value['intranet'];
                $params[] = $value['liblink'];
                $params[] = $value['libmail'];
                $params[] = $value['idemp'];
                $result = $this->model->editarDataEmpresa($params);
            endforeach;
            if ($result) echo 'OK';
        } else {
            die('Error: No se pudo actualizar los datos');
        }
    }
}
