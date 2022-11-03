<?php

namespace Controlador;

use App\Horarios\HorarioMensual;
use App\Horarios\Intervalo;
use App\Servicios\Pista;
use Modelo\Servicios\PistaDAOMySQL;
use Vista\PistaVista;

class PistaControlador
{
    private Pista $pista;
    private PistaDAOMySQL $modelo;
    private PistaVista $vista;


    public function __construct()
    {
        $modelo = new PistaDAOMySQL();
        $vista = new PistaVista();
    }

    public function reservarPista(Pista $pista, Intervalo $intervalo, Jugador $jugador, \DateTime $fecha){

         $this->pista = $this->modelo->obtenerPista($pista);
         $intervaloEncontrado = $this->obtenerIntervalo($intervalo,$fecha);
         $intervaloEncontrado-> reservarHorario($jugador);
         $this->modelo->modificarPista($this->pista);


    }

    public function buscarIntervalo(Intervalo $intervalo,\DateTime $fecha): Intervalo{
        $horarioMensual = $this->seleccionarHorarioMensual($fecha);
        $horarioDiario = $horarioMensual->getHorariosDiarios();

        $intervaloEncontrado = array_search($intervalo,$horarioDiario);

        return $intervaloEncontrado;

    }

    public function seleccionarHorarioMensual(\DateTime $fecha):HorarioMensual{
        $mes = $fecha->format('m');
        $horarioDelMes = null;
        foreach ($this->pista->getReservaPistaMenual() as $horarioMensual){
            if ($horarioMensual->getMes()==$mes){
                $horarioDelMes = $horarioMensual;
            }
        }
        return $horarioDelMes;
    }
}