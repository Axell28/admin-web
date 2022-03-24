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
            $sql = "UPDATE empresa SET nombre = ?, telefono = ?, celular = ?, direction = ?, correo = ?, metades = ?, facebook = ?, instagram = ?, whatsapp = ?, youtube = ?, twitter = ?,  intranet = ?, liblink = ?, libmail = ? WHERE idemp = ?";
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
            $sql = "SELECT * FROM empresa order by idemp";
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            $res = array();
            $res = $stm->fetchAll(PDO::FETCH_ASSOC);
            return $res;
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
}
