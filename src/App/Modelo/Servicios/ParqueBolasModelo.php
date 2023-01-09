<?php

namespace App\Modelo\Servicios;

use App\Modelo\Personas\PersonaDAOMySQL;
use App\Servicios\ReservaParqueBolas;

class ParqueBolasModelo
{
    private PDO $conexion;

    public function __construct()
    {
        $this->conexion(
            new PDO(
                "mysql:host=" . HOSTBD .
                ";dbname=" . NOMBREBD, USUARIOBD, PASSBD
            )
        );

        $this->getConexion()->setAttribute(
            \PDO::ATTR_ERRMODE,
            \PDO::ERRMODE_EXCEPTION
        );
    }

    public function borrarTodasLasReservas(){

        $query = "Truncate reservaParqueBolas";
        $sentencia = $this->conexion->prepare($query);

        $this->conexion->execute($sentencia);

    }

    public function borrarReserva($fecha){
        $fechaenstring = $fecha->format('d/m/Y H:i:s');

        $query = "DELETE FROM reservaParqueBolas WHERE fecha=?";
        $sentencia = $this->conexion->prepare($query);

        $sentencia->bindValue("fecha",$fechaenstring);

        $this->conexion->execute($sentencia);

    }

    public function leerTodasLasReservas(){

        $query = "SELECT fecha FROM reservaParqueBolas";
        $sentencia = $this->conexion->prepare($query);

        $sentencia->execute($sentencia);

        $resultado = $sentencia->fetchAll();

        foreach($resultado as $fechaReserva){
            $arrayReservas[]=$this->leerReserva($fechaReserva);
        }
    }

    public function leerReserva($fecha):ReservaParqueBolas{
        $fechaenstring = $fecha->format('d/m/Y H:i:s');

        $query = "SELECT *  FROM reservaParqueBolas WHERE fecha=?";
        $sentencia = $this->conexion->prepare($query);

        $sentencia->bindValue("fecha",$fechaenstring);

        $this->conexion->execute($sentencia);

        $fila= $sentencia->fetch();

        $fecha = \DateTime::createFromFormat('d/m/Y H:i:s', $fila['fecha']);

        $modeloPersonas = new PersonaDAOMySQL();

        $arrayPersonas= $modeloPersonas->leerPersona($fila['dni_persona']);

        return new ReservaParqueBolas($fecha,$fila['numHoras'],$arrayPersonas,$fila['costeHora']);

    }

    public function insertarReserva(ReservaParqueBolas $reserva){
        $fechaenstring = $reserva->getFecha()->format('d/m/Y H:i:s');
        $query = "insert into reservaParqueBolas 
    VALUES (STR_TO_DATE(:fecha,'%d/%m/%Y %H:%i:%s'),:horas,:coste)";

        $sentencia = $this->conexion->prepare($query);
        $sentencia->bindValue("fecha",$fechaenstring);
        $sentencia->bindValue("horas",$reserva->getNumHoras());
        $sentencia->bindValue("coste",$reserva->getCosteHora());

        $sentencia->execute();
    }

}