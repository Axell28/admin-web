<?php

class LoginModel extends Conexion
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = parent::connect();
    }

    public function validarLogueo(string $user, string $pass)
    {
        $hash = $this->checkUser($user);
        if (empty($hash)) {
            return 'El nombre de usuario no esta registrado';
        } else if (!$this->checkPass($pass, $hash)) {
            return 'La contraseña ingresada no es la correcta';
        }
        return 'OK';
    }

    private function checkUser($name)
    {
        try {
            $sql = "SELECT * FROM usuario WHERE nomb = ?";
            $stm = $this->pdo->prepare($sql);
            $stm->bindParam(1, $name, PDO::PARAM_STR);
            $stm->execute();
            $res = $stm->fetchAll(PDO::FETCH_ASSOC);
            return !empty($res) ? $res[0]['pass'] : null;
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    private function checkPass(string $pass, string $hash)
    {
        return password_verify($pass, $hash);
    }
}
