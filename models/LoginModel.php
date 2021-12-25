<?php

class LoginModel extends Conexion {

    private $pdo;

    public function __construct()
    {
        $this->pdo = parent::connect();
    }
    
}