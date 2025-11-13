<?php
namespace MyAPI;

abstract class DataBase {
    protected $conexion;

    public function __construct($host, $user, $password, $dbname) {
        $this->conexion = new \mysqli($host, $user, $password, $dbname);
        if ($this->conexion->connect_error) {
            die("Error de conexión: " . $this->conexion->connect_error);
        }
    }
}
