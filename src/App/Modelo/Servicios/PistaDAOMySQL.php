<?php

namespace App\Modelo\Servicios;

use PDO;

class PistaDAOMySQL
{
    private PDO $conexion;

    public function __construct()
    {
        $this->setConexion(new PDO("mysql:dbname=" . NOMBREBD . ";host=" . SERVIDOR, USUARIO, PASS));
        $this->getConexion()->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    }

    /**
     * @return PDO
     */
    public function getConexion(): PDO
    {
        return $this->conexion;
    }

    /**
     * @param PDO $conexion
     */
    public function setConexion(PDO $conexion): void
    {
        $this->conexion = $conexion;
    }



    public function obtenerTodasLasPistas(){

        $query = "SELECT ";
    }
}