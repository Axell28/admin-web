<?php

class EmpresaModel extends Conexion
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = parent::connect();
    }

    public function editarDataEmpresa($params)
    {
        try {
            $sql = "UPDATE empresa SET nombre = ?, telefono = ?, celular = ?, direction = ?, correo = ?, metades = ?, facebook = ?, instagram = ?, whatsapp = ?, youtube = ?, twitter = ?,  intranet = ?, liblink = ?, libmail = ? WHERE idemp = 1";
            $stm = $this->pdo->prepare($sql);
            $res = $stm->execute($params);
            return $res;
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function getDatosEmpresa()
    {
        try {
            $sql = "SELECT * FROM empresa LIMIT 1";
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            $res = array();
            if ($stm->rowCount() > 0) {
                $res = $stm->fetchAll(PDO::FETCH_ASSOC)[0];
            }
            return $res;
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
}
