<?php

namespace App\Modelo\Horarios;
use App\Horarios\HorarioDiario;
use App\Modelo\Excepciones\HorarioDiarioException;
use DateTime;
use PDO;
use Ramsey\Uuid\Type\Integer;

class HorarioDiarioDAOMySQL
{
    private DAO $conexion;

    public function __construct()
    {
        $this->setConexion(new PDO("mysql:dbname=" . NOMBREBD . ";host=" . SERVIDOR, USUARIO, PASS));
        $this->getConexion()->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    }

    public function obtenerHorarioDiario(DateTime $fecha):HorarioDiario{
        $query = "SELECT * FROM horario_diario where fecha=:fecha";
        $sentencia = $this->conexion->prepare($query);
        $sentencia->execute("fecha",$fecha->format('d/m/Y'));

        if(mysqli_affected_rows($sentencia)){
            $fila= $sentencia->fetch();
            $intervalo = new IntervaloDAOMySQL();
            $arrayIntervalos= $intervalo->obtenerIntervalosDeUnDia($fecha->format('d/m/Y'));
            $horario = new HorarioDiario(new DateTime($fila['fecha']),$fila['hora_apertura'],$fila['hora_cierre'],$fila['duracion_intervalos'],$arrayIntervalos);
            return $horario;
        }else{
            throw new HorarioDiarioException("No se ha podido recuperar el horario diario");
        }
    }

}