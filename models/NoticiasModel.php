<?php

class NoticiasModel extends Conexion
{
    private $pdo;
    private $total = 0;

    public function __construct()
    {
        $this->pdo = parent::connect();
    }

    public function guardarNoticia($params)
    {
        try {
            $sql = "INSERT INTO noticias (idcat, titulo, tagname, portada, detalle, cuerpo, fecpub) VALUES (?,?,?,?,?,?,?)";
            $stm = $this->pdo->prepare($sql);
            $res = $stm->execute($params);
            return $res;
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function editarNoticia($params)
    {
        try {
            $sql = "UPDATE noticias SET idcat = ?, titulo = ?, tagname = ?, portada = ?, detalle = ?, cuerpo = ?, fecpub = ? WHERE idnot = ?";
            $stm = $this->pdo->prepare($sql);
            $res = $stm->execute($params);
            return $res;
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function eliminarNoticia(int $id)
    {
        try {
            $sql = "DELETE FROM noticias WHERE idnot = ?";
            $stm = $this->pdo->prepare($sql);
            $stm->bindParam(1, $id, PDO::PARAM_INT);
            $res = $stm->execute();
            return $res;
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function buscarNoticia(int $id)
    {
        try {
            $sql = "SELECT * FROM noticias WHERE idnot = ?";
            $stm = $this->pdo->prepare($sql);
            $stm->bindParam(1, $id, PDO::PARAM_INT);
            $stm->execute();
            $res = $stm->fetchAll(PDO::FETCH_ASSOC)[0];
            return $res;
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function listarCategorias()
    {
        try {
            $sql = "SELECT * FROM categoria ORDER BY idcat ASC";
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            $res = $stm->fetchAll(PDO::FETCH_UNIQUE | PDO::FETCH_ASSOC);
            return $res;
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function listarNoticias(int $ini, string $catg)
    {
        try {
            $sql = "SELECT (SELECT COUNT(*) FROM noticias WHERE idcat LIKE '$catg') as total, n.idnot, n.titulo, n.tagname, n.idcat, UPPER(c.nombre) as catname, n.portada, n.fecpub, n.visible FROM noticias n INNER JOIN categoria c ON n.idcat = c.idcat WHERE n.idcat LIKE '$catg' ORDER BY fecpub DESC LIMIT 12 OFFSET $ini;";
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            $res = $stm->fetchAll(PDO::FETCH_ASSOC);
            $this->total = ($stm->rowCount() > 0) ? $res[0]['total'] : 0;
            return $res;
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function listarNoticiasWeb(int $ini, int $limit, string $catg)
    {
        $catg = ($catg == 'all') ? '%' : $catg;
        try {
            $sql = "SELECT (SELECT COUNT(*) FROM noticias WHERE idcat LIKE '$catg' AND fecpub <= NOW() AND visible = 'S') as total, n.idnot, n.titulo, n.tagname, n.idcat, c.nombre as catdes, n.portada, n.detalle, n.fecpub, n.visible FROM noticias n INNER JOIN categoria c ON n.idcat = c.idcat WHERE n.idcat LIKE '$catg' AND n.fecpub <= NOW() AND n.visible = 'S' ORDER BY fecpub DESC LIMIT $limit OFFSET $ini";
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            $res = $stm->fetchAll(PDO::FETCH_ASSOC);
            $this->total = ($stm->rowCount() > 0) ? $res[0]['total'] : 0;
            return $res;
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function buscarNoticiaxTag(string $tagname)
    {
        try {
            $sql = "SELECT idnot, titulo, tagname, idcat as categoria, fecpub, cuerpo FROM noticias WHERE tagname = ?";
            $stm = $this->pdo->prepare($sql);
            $stm->bindParam(1, $tagname, PDO::PARAM_STR);
            $stm->execute();
            $res = ($stm->rowCount() > 0) ? $stm->fetchAll(PDO::FETCH_ASSOC)[0] : array();
            return $res;
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function cambiarEstado(int $id, string $estado)
    {
        try {
            $sql = "UPDATE noticias SET visible = ? WHERE idnot = ?";
            $stm = $this->pdo->prepare($sql);
            $stm->bindParam(1, $estado, PDO::PARAM_STR);
            $stm->bindParam(2, $id, PDO::PARAM_INT);
            $res = $stm->execute();
            return $res;
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function totalRows()
    {
        return $this->total;
    }

    public function paginationWeb($categ, $pag)
    {
        $html = '';
        $categ = $categ == '%' ? 'all' : $categ;
        if ($pag == 1) {
            $html .= '<li class="page-item disabled"><a class="page-link" href="#"><span aria-hidden="true">&laquo;</span></a></li>';
        } else {
            $html .= '<li class="page-item"><a class="page-link" href="/noticias/' . $categ . '/' . ($pag - 1) . '"><span aria-hidden="true">&laquo;</span></a></li>';
        }
        $npag = ceil($this->totalRows() / LIMXPAG);
        for ($item = 1; $item <= $npag; $item++) :
            $active = ($item == $pag) ? 'active' : '';
            $html .= '<li class="page-item ' . $active . '"><a class="page-link" href="/noticias/' . $categ . '/' . $item . '">' . $item . '</a></li>';
        endfor;
        if ($pag == $npag) {
            $html .= '<li class="page-item disabled"><a class="page-link" href="#"><span aria-hidden="true">&raquo;</span></a></li>';
        } else {
            $html .= '<li class="page-item"><a class="page-link" href="/noticias/' . $categ . '/' . ($pag + 1) . '"><span aria-hidden="true">&raquo;</span></a></li>';
        }
        return $html;
    }
}
