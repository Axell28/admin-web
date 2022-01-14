<?php

class BannerModel extends Conexion
{

    private $pdo;

    public function __construct()
    {
        $this->pdo = parent::connect();
    }

    public function editarBanner(array $params)
    {
        try {
            $sql = "UPDATE banner SET tipo = ?, cuerpo = ? WHERE idban = 1";
            $stm = $this->pdo->prepare($sql);
            $stm->bindParam(1, $params[0], PDO::PARAM_STR);
            $stm->bindParam(2, $params[1], PDO::PARAM_STR);
            $res = $stm->execute();
            return $res;
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function obtenerBanner()
    {
        try {
            $sql = "SELECT * FROM banner LIMIT 1";
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
