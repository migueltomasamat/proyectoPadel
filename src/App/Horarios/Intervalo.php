<?php

namespace App\Horarios;

require_once __DIR__."/../../autoload.php";

use App\Excepciones\HoraNoValidaException;
use App\Personas\Jugador;

/**
 *
 */
class Intervalo
{
    /**
     * @var float
     */
    private float $horaInicio;
    /**
     * @var float
     */
    private float $horaFin;
    /**
     * @var bool
     */
    private bool $disponibilidad;
    /**
     * @var Jugador|null
     */
    private ?Jugador $socioReservado=null;


    /**
     * @param float $horaInicio
     * @param float $horaFin
     */
    public function __construct(float $horaInicio, float $horaFin)
    {
        $this->horaInicio = $horaInicio;
        $this->horaFin = $horaFin;
        //Considero que cuando creo el intervalo, este estará disponible
        $this->disponibilidad=true;
    }


    /**
     * @return float
     */
    public function getHoraInicio():float
    {
        return $this->horaInicio;
    }


    /**
     * @param float $horaInicio
     * @return $this
     */
    public function setHoraInicio(float $horaInicio):Intervalo
    {
        $this->horaInicio = $horaInicio;
        return $this;
    }


    /**
     * @return float
     */
    public function getHoraFin():float
    {
        return $this->horaFin;
    }


    /**
     * @param float $horaFin
     * @return $this
     */
    public function setHoraFin(float $horaFin):Intervalo
    {
        $this->horaFin = $horaFin;
        return $this;
    }

    /**
     * @return bool
     */
    public function isDisponible(): bool
    {
        return $this->disponibilidad;
    }

    /**
     * @param bool $disponibilidad
     * @return Intervalo
     */
    public function setDisponible(bool $disponibilidad): Intervalo
    {
        $this->disponibilidad = $disponibilidad;
        return $this;
    }


    /**
     * @return Jugador
     */
    public function getSocioReservado():Jugador
    {
        return $this->socioReservado;
    }

    /**
     * @param Jugador $jugador
     * @return $this
     */
    public function reservarHorario(Jugador $jugador):Intervalo
    {
        $this->socioReservado=$jugador;
        return $this;
    }

    /**
     * @param float $horaInicioIntervalo
     * @param int $duracionEnMinutos
     * @return float
     */
    public static function calcularHoraFinalIntervalo(float $horaInicioIntervalo, int $duracionEnMinutos):float{

        $horasAdd= intval($duracionEnMinutos/60);

        $minutosAdd=$duracionEnMinutos%60;

        $horaFinalIntervalo=$horaInicioIntervalo+$horasAdd+($minutosAdd/100);

        $parteDecimal= $horaFinalIntervalo-intval($horaFinalIntervalo);

        if ($parteDecimal>0.5){
            $horaFinalIntervalo = (intval($horaFinalIntervalo)+1)+$parteDecimal-0.6;
        }



        return $horaFinalIntervalo;

    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        $retorno="El intervalo tiene las siguientes características:<br>";
        $retorno.= "Hora de inicio: ". number_format($this->horaInicio,2)."<br>";
        $retorno.= "Hora de fin: ".number_format($this->horaFin,2)."<br>";
        if($this->isDisponible())
            $retorno.= "Disponibilidad: pista disponible<br>";
        else{
            $retorno.= "Disponibilidad: pista no disponible <br>";
        }
        if (isset($this->socioReservado)){
            $retorno.="Socio que tiene reservada la pista: ".$this->getSocioReservado()->getNombre()." ". $this->getSocioReservado()->getApellidos();
        }
        return $retorno;
    }
}