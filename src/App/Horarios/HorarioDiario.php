<?php

namespace App\Horarios;
use App\Excepciones\HoraNoValidaException;
use DateTime;

require_once __DIR__."/../../autoload.php";

/**
 *
 */
class HorarioDiario
{
    /**
     * @var DateTime
     */
    private DateTime $fecha;
    /**
     * @var float
     */
    private float $horaApertura;
    /**
     * @var float
     */
    private float $horaCierre;
    /**
     * @var int
     */
    private int $duracionIntervalos;
    /**
     * @var array
     */
    private array $intervalosDelDia;


    /**
     * @param DateTime $fecha
     * @param float $horaApertura
     * @param float $horaCierre
     * @param int $duracionIntervalos
     * @throws HoraNoValidaException
     */
    public function __construct(DateTime $fecha, float $horaApertura, float $horaCierre, int $duracionIntervalos)
    {
        if ($horaApertura>23){
            throw new HoraNoValidaException("Hora mayor que 23");
        }
        if ($horaApertura-intval($horaApertura)>0.5){
            throw new HoraNoValidaException("Parte decimal de la hora incorrecta");
        }
        $this->fecha = $fecha;
        $this->horaApertura = $horaApertura;
        $this->horaCierre = $horaCierre;
        $this->duracionIntervalos = $duracionIntervalos;
    }

    /**
     * @return mixed
     */
    public function getFecha():DateTime
    {
        return $this->fecha;
    }

    /**
     * @param mixed $fecha
     * @return HorarioDiario
     */
    public function setFecha(DateTime $fecha):HorarioDiario
    {
        $this->fecha = $fecha;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getHoraApertura():float
    {
        return $this->horaApertura;
    }

    /**
     * @param mixed $horaApertura
     * @return HorarioDiario
     */
    public function setHoraApertura(float $horaApertura):HorarioDiario
    {
        $this->horaApertura = $horaApertura;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getHoraCierre():float
    {
        return $this->horaCierre;
    }

    /**
     * @param mixed $horaCierre
     * @return HorarioDiario
     */
    public function setHoraCierre(float $horaCierre):HorarioDiario
    {
        $this->horaCierre = $horaCierre;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDuracionIntervalos():int
    {
        return $this->duracionIntervalos;
    }

    /**
     * @param mixed $duracionIntervalos
     * @return HorarioDiario
     */
    public function setDuracionIntervalos(int $duracionIntervalos):HorarioDiario
    {
        $this->duracionIntervalos = $duracionIntervalos;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getIntervalosDelDia():array
    {
        return $this->intervalosDelDia;
    }

    /**
     * @param mixed $intervalosDelDia
     * @return HorarioDiario
     */
    public function setIntervalosDelDia(array $intervalosDelDia):self
    {
        $this->intervalosDelDia = $intervalosDelDia;
        return $this;
    }

    /**
     * @return $this|null
     */
    public function generarIntervalos():?HorarioDiario{

        $totalHoras =  $this->getHoraCierre()-$this->getHoraApertura();
        $intevaloEnHoras = $this->getDuracionIntervalos()/60;
        $totalIntervalos = $totalHoras/$intevaloEnHoras;

        $horaInicioIntervalo = $this->getHoraApertura();

        for ($i=0;$i<$totalIntervalos;$i++){
                $horaFinIntervalo = Intervalo::calcularHoraFinalIntervalo($horaInicioIntervalo,$this->getDuracionIntervalos());
            $this->intervalosDelDia[]=new Intervalo(number_format($horaInicioIntervalo, 2), number_format($horaFinIntervalo,2));
            $horaInicioIntervalo=$horaFinIntervalo;
        }

        return $this;
    }

    /**
     * @return string
     */
    public function imprimirHorarioDiario():string{
        $salida="";
        if (isset($this->intervalosDelDia)) {
            $salida = implode('<br>', $this->intervalosDelDia);
        }
        return $salida;
    }

    public function __toString(): string
    {

        $salida =  "El día: ".$this->getFecha()->format('d/m/Y')
            ." con apertura $this->horaApertura y cierre $this->horaCierre<br>";
        $salida .= $this->imprimirHorarioDiario();
        return $salida;
    }


}