<?php

namespace App\Horarios;
require_once __DIR__."/../../autoload.php";

/**
 *
 */
class HorarioMensual
{
    public static array $ENTRESEMANA= array('Mon','Tue','Wed','Thu','Fri');
    public static array $FINDESEMANA= array('Sat','Sun');
    /**
     * @var int
     */
    private int $mes;
    /**
     * @var int
     */
    private int $anyo;
    /**
     * @var array
     */
    private array $horariosDiarios=array();

    /**
     * @param $mes
     * @param $anyo
     * @param $horariosDiarios
     */
    public function __construct(int $mes, int $anyo)
    {
        $this->mes = $mes;
        $this->anyo = $anyo;
    }

    /**
     * @return mixed
     */
    public function getMes():int
    {
        return $this->mes;
    }

    /**
     * @param mixed $mes
     * @return HorarioMensual
     */
    public function setMes(int $mes):HorarioMensual
    {
        $this->mes = $mes;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAnyo():int
    {
        return $this->anyo;
    }

    /**
     * @param mixed $anyo
     * @return HorarioMensual
     */
    public function setAnyo(int $anyo)
    {
        $this->anyo = $anyo;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getHorariosDiarios():array
    {
        return $this->horariosDiarios;
    }

    /**
     * @return $this|null
     */
    public function generarHorarios(): ?HorarioMensual{

        $diasDelMes = cal_days_in_month(CAL_GREGORIAN,$this->getMes(),$this->getAnyo());

        for ($i=1;$i<$diasDelMes;$i++){
            $dia = \DateTime::createFromFormat('d/m/Y', "$i/$this->mes/$this->anyo");
            $horarioDiario= null;

            if (in_array($dia->format('D'),self::$ENTRESEMANA)){
                $horarioDiario= new HorarioDiario($dia,8.00,22.00,90);
                $horarioDiario->generarIntervalos();

            }else{
                $horarioDiario= new HorarioDiario($dia,8.00,14.00,90);
                $horarioDiario->generarIntervalos();
            }

            $this->horariosDiarios[]=$horarioDiario;

        }

        return $this;
    }

    /**
     * @return int
     */
    public function calcularNumHoras():int{
        //TODO implementar calcular horas para calcular salario empleado
        return 0;
    }

    public function __toString():string
    {
        $salida = "Para el mes: $this->mes del año $this->anyo se ha generado los siguientes horarios:";
        foreach ($this->getHorariosDiarios() as $horarioDiario){
            $salida .= "<br>$horarioDiario<br>";
        }

        return $salida;
    }
}