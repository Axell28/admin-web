<?php

class GaleriaModel extends Conexion
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = parent::connect();
    }

    public function guardarGaleria($params)
    {
        try {
            $sql = "INSERT INTO galeria (titulo, detalle, ncols, cuerpo) VALUES (?, ?, ?, ?)";
            $stm = $this->pdo->prepare($sql);
            $res = $stm->execute($params);
            return $res;
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function editarGaleria($params)
    {
        try {
            $sql = "UPDATE galeria SET titulo = ?, detalle = ?, ncols = ?, cuerpo = ? WHERE idgal = ?";
            $stm = $this->pdo->prepare($sql);
            $res = $stm->execute($params);
            return $res;
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function listarGalerias()
    {
        try {
            $sql = "SELECT * FROM galeria ORDER BY fecpub";
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            $res = $stm->fetchAll(PDO::FETCH_ASSOC);
            return $res;
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function buscarGaleria(int $idgal)
    {
        try {
            $sql = "SELECT * FROM galeria WHERE idgal = ?";
            $stm = $this->pdo->prepare($sql);
            $stm->bindParam(1, $idgal, PDO::PARAM_INT);
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

    public function eliminarGaleria(int $idgal)
    {
        try {
            $sql = "DELETE FROM galeria WHERE idgal = ?";
            $stm = $this->pdo->prepare($sql);
            $stm->bindParam(1, $idgal, PDO::PARAM_INT);
            $res = $stm->execute();
            return $res;
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
}
