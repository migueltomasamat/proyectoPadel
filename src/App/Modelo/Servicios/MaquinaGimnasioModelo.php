<?php

namespace App\Modelo\Servicios;
use App\Servicios\ParqueBolas;
use App\Servicios\ReservaMaquinaGimnasio;
use Cassandra\Date;
use DateTime;
use PDO;

require_once __DIR__."/../parametrosDB.php";

class MaquinaGimnasioModelo
{
    private PDO $conexion;

    public function __construct()
    {
        $this->setConexion(new PDO("mysql:dbname=" . NOMBREBD . ";host=" . SERVIDOR, USUARIO, PASS));
        $this->getConexion()->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    }

    public function insertarReservaMaquinaGimnasio(ReservaMaquinaGimnasio $mg)
    {
        $query = "INSERT INTO maquina_gimnasio (fecha, num_horas,coste_hora,dni_persona) VALUES (STR_TO_DATE(:fecha, '%d-%m-%Y %H:%i:%s'),:horas,:precio,:persona)";


        $sentencia = $this->conexion->prepare($query);

        $sentencia->bindValue("fecha", $mg->getFecha()->format('d-m-Y H:i:s'));
        $sentencia->bindValue("horas", $mg->getNumHoras());
        $sentencia->bindValue("precio", $mg->getCosteHora());
        $sentencia->bindValue("persona",$mg->getCliente()->getDNI());

        $sentencia->execute();
    }

        public function mostrarTodos(){
            $query = "SELECT * FROM maquina_gimnasio";

            $sentencia = $this->conexion->prepare($query);

            $sentencia->execute();

            $resultado = $sentencia->fetchAll();

            return $resultado;
        }

        public function borrarReservaPorFecha(DateTime $fecha){

            //var_dump($fecha);
            $query = "DELETE FROM maquina_gimnasio WHERE fecha=STR_TO_DATE(:fecha, '%d-%m-%Y %H:%i:%s')";

            $sentencia = $this->conexion->prepare($query);

            $sentencia->bindValue("fecha",$fecha->format('d-m-Y H:i:s'));

            $sentencia->execute();
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

}