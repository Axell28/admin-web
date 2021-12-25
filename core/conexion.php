<?php

class Conexion
{
    private $host = BD_HOST;
    private $user = BD_USER;
    private $pass = BD_PASS;
    private $name = BD_NAME;

    protected function connect()
    {
        try {
            $con = "";
            if (BD_DRIVER == 'psql') {
                $con = "pgsql:dbname=$this->name;host=$this->host;port=5432;options='--client_encoding=UTF8'";
            } else {
                $con = "mysql:host=$this->host;dbname=$this->name;charset=utf8";
            }
            $pdo = new PDO($con, $this->user, $this->pass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            return $pdo;
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
}
