<?php

namespace Modelo\Personas;


abstract class PersonasDAO implements interfazPersonas
{
    private $conexion;

    public function __construct()
    {

    }


    public function getConexion()
    {
        return $this->conexion;
    }


    public function setConexion($conexion): void
    {
        $this->conexion = $conexion;
    }


}