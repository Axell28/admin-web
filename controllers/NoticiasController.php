<?php

require_once DIROOT . '/models/NoticiasModel.php';

class Noticias extends Controller
{

    public $model;

    public function __construct()
    {
        parent::validarSesion();
        $this->model = new NoticiasModel();
        $this->nameView = strtolower(get_class($this));
    }

    public function index()
    {
        header("Location: /admin/noticias/all");
    }

    public function __call($method, $params)
    {
        $params = $params[0];
        $this->listCategs = $this->model->listarCategorias();
        $esCategoria = array_key_exists($method, $this->listCategs) || $method == 'all';
        if ($esCategoria) {
            $this->pagina = !empty($params[0]) ? $params[0] : 1;
            $ini = (24 * $this->pagina) - 24;
            $ini = ($ini < 0) ? 0 : $ini;
            $this->categoria = ($method == 'all') ? '' : $method;
            $this->listNoticias = $this->model->listarNoticias($ini, $this->categoria);
            parent::renderView($this->nameView);
        } else {
            die('Error:: Method does not exist.');
        }
        parent::renderView($this->nameView);
    }

    public function eliminar($param)
    {
        $idnot = $param[0];
        if (is_numeric($idnot)) {
            $result = $this->model->eliminarNoticia($idnot);
            if ($result) echo "OK";
        } else {
            die("Error:: No se está enviando el parámetro correcto");
        }
    }

    public function estado($param)
    {
        $idnot = $param[0];
        $estado = $param[1];
        if (is_numeric($idnot)) {
            $result = $this->model->cambiarEstado($idnot, $estado);
            if ($result) echo "OK";
        } else {
            die("Error:: No se está enviando el parámetro correcto");
        }
    }

    public function pagination($categ, $pag)
    {
        $html = '';
        $categ = empty($categ) ? 'all' : $categ;
        if ($pag == 1) {
            $html .= '<li class="page-item disabled"><a class="page-link" href="#"><span aria-hidden="true">&laquo;</span></a></li>';
        } else {
            $html .= '<li class="page-item"><a class="page-link" href="/admin/noticias/' . $categ . '/' . ($pag - 1) . '"><span aria-hidden="true">&laquo;</span></a></li>';
        }
        $npag = ceil($this->model->totalResultados() / 12);
        for ($item = 1; $item <= $npag; $item++) :
            $active = ($item == $pag) ? 'active' : '';
            $html .= '<li class="page-item ' . $active . '"><a class="page-link" href="/admin/noticias/' . $categ . '/' . $item . '">' . $item . '</a></li>';
        endfor;
        if ($pag == $npag) {
            $html .= '<li class="page-item disabled"><a class="page-link" href="#"><span aria-hidden="true">&raquo;</span></a></li>';
        } else {
            $html .= '<li class="page-item"><a class="page-link" href="/admin/noticias/' . $categ . '/' . ($pag + 1) . '"><span aria-hidden="true">&raquo;</span></a></li>';
        }
        return $html;
    }

    public static function paginationWeb(string $categ, mixed $npag, int $totalRes)
    {
        $html = '';
        return $html;
    }
}
