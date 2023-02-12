<?php

namespace App\Modelo\Horarios;

use App\Horarios\HorarioDiario;
use App\Horarios\Intervalo;
use App\Modelo\Excepciones\IntervaloException;
use DAO;
use DateTime;

class IntervaloDAOMySQL
{
    private DAO $conexion;

    public function __construct()
    {
        $this->setConexion(new PDO("mysql:dbname=" . NOMBREBD . ";host=" . SERVIDOR, USUARIO, PASS));
        $this->getConexion()->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    }

    /**
     * @return DAO
     */
    public function getConexion(): DAO
    {
        return $this->conexion;
    }

    /**
     * @param DAO $conexion
     */
    public function setConexion(DAO $conexion): void
    {
        $this->conexion = $conexion;
    }


    public function insertarIntervalo(Intervalo $intervalo):Intervalo{

        $query = "INSERT INTO intervalo (hora_inicio,hora_fin,disponibilidad,socio_reservado) values (:inicio,:fin,:disponibilidad,:socio,:horarioDiario)";

        $sentencia = $this->getConexion()->prepare($query);

        $sentencia->bindValue("inicio",$intervalo->getHoraInicio());
        $sentencia->bindValue("fin",$intervalo->getHoraFin());
        $sentencia->bindValue("disponibilidad",$intervalo->isDisponible());
        $sentencia->bindValue("socio",$intervalo->getSocioReservado()->getDNI());
        $sentencia->bindValue("horarioDiario",$intervalo->getHorarioDiario()->getFecha()->format('d/m/Y'));

        $sentencia->execute($query);

        if (mysqli_affected_rows($this->getConexion())){
            return $this;
        }else{
            throw new IntervaloException("No se ha podido guardar el intervalo en la base de datos");
        }
    }

    public function borrarIntervalo(Intervalo $intervalo):bool{
        $query = "DELETE FROM intervalo WHERE id_intervalo=:id";

        $sentencia = $this->getConexion()->prepare($query);

        $sentencia->bindValue("id",$intervalo->getId());

        $sentencia->execute();

        if(mysqli_affected_rows($this->getConexion())){
            return true;
        }else{
            throw new IntervaloException("No se ha podido borrar el intervalo");
        }
    }

    public function obtenerIntervalo(int $idIntervalo):Intervalo{
        $query = "SELECT * FROM intervalo where id_intervalo=:id";

        $sentencia = $this->getConexion()->prepare($query);

        $sentencia->execute([$idIntervalo]);

        if(mysqli_affected_rows($this->getConexion())){
            $resultado = $sentencia->fetch();
            $intervalo = new Intervalo($resultado['hora_inicio'],$resultado['hora_fin']);
            $intervalo->setId($resultado['id_intervalo']);
            $intervalo->setDisponible($resultado['disponibilidad']);


            return $intervalo;
        }else{
            throw new IntervaloException("No se ha podido crear el intervalo a partir del array de datos.");
        }

    }
    public function obtenerIntervalosDeUnDia(DateTime $fecha):array{
        $query = "Select * from intervalo where dia_horario_diario=:fecha";

        $sentencia = $this->conexion->prepare($query);

        $sentencia->bindParam("fecha", $fecha->format('d/m/Y'));

        $sentencia->execute();

        if(mysqli_affected_rows($this->conexion)){
            foreach ($sentencia->fetchAll() as $fila){
                $intervalos[]=$this->convertirIntervaloAObjeto($fila);
            }
            return $intervalos;
        }else{
            throw new IntervaloException("No se han podido recuperar los intervalos");
        }

    }
    public function convertirIntervaloAObjeto(array $datosIntervalo):Intervalo{

        $intervalo = new Intervalo($datosIntervalo['hora_inicio'],$datosIntervalo['hora_fin']);

        $intervalo->setDisponible(isset($datosIntervalo['disponible']) ?? null);
        //TODO a rellenar cuando esté creado el DAO de Jugador
        //$intervalo->reservarHorario(new JugadorDAOMySQL()->obtenerJugador($arra)
        $horarioDiario = new HorarioDiarioDAOMySQL();
        $horarioDiario->obtenerHorarioDiario(DateTime::createFromFormat('d/m/Y',$datosIntervalo['dia_horario_diario']));
        $intervalo->setHorarioDiario($horarioDiario);

        return $intervalo;



    }


}