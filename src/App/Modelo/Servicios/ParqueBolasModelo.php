<?php

namespace App\Modelo\Servicios;
use App\Servicios\ParqueBolas;
use Cassandra\Date;
use DateTime;
use PDO;

require_once __DIR__."/../parametrosDB.php";

class ParqueBolasModelo
{
    private PDO $conexion;

    public function __construct()
    {
        $this->setConexion(new PDO("mysql:dbname=" . NOMBREBD . ";host=" . SERVIDOR, USUARIO, PASS));
        $this->getConexion()->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    }

    public function insertarParqueBolas(ParqueBolas $pb)
    {
        $query = "INSERT INTO parquebolas (fecha, num_horas,coste_hora) VALUES (STR_TO_DATE(:fecha, '%d-%m-%Y %H:%i:%s'),:horas,:precio)";


        $sentencia = $this->conexion->prepare($query);

        $sentencia->bindValue("fecha", $pb->getFecha()->format('d-m-Y H:i:s'));
        $sentencia->bindValue("horas", $pb->getNumHoras());
        $sentencia->bindValue("precio", $pb->getCosteHora());
        //$sentencia->bindValue("cliente",$pb->getClientes()[0]->getDNI());

        $sentencia->execute();
        $clientes = $pb->getClientes();
        var_dump($clientes);
        $query2 = "INSERT INTO cliente_parque (parque_bolas,dni_cliente) VALUES (STR_TO_DATE(:fecha, '%d/%m/%Y %H:%i:%s'),:dni_cliente)";

        $sentencia2 = $this->conexion->prepare($query2);
        $sentencia2->bindValue("fecha", $pb->getFecha()->format('d/m/Y H:i:s'));
        foreach ($clientes as $cliente) {
            $sentencia2->bindValue("dni_cliente", $cliente->getDNI());
            $sentencia2->execute();
        }
    }

        public function mostrarTodos(){
            $query = "SELECT * FROM parquebolas";

            $sentencia = $this->conexion->prepare($query);

            $sentencia->execute();

            $resultado = $sentencia->fetchAll();

            return $resultado;
        }

        public function borrarParquePorFecha(DateTime $fecha){

            //var_dump($fecha);
            $query = "DELETE FROM parquebolas WHERE fecha=STR_TO_DATE(:fecha, '%d-%m-%Y %H:%i:%s')";

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