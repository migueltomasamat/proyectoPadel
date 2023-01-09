<?php

namespace App\Controlador\Servicios;

use App\Servicios\ReservaParqueBolas;
use DateTime;

class ParqueBolasControlador
{
    private ParqueBolasModelo $modelo;
    private ParqueBolasVista $vista;

    /**
     * @param ParqueBolasModelo $modelo
     * @param ParqueBolasVista $vista
     */
    public function __construct()
    {
        $this->modelo = new ParqueBolasModelo();
        $this->vista = new ParqueBolasVista();
    }

    public function mostrarResultadoPagos():array{


    }

    public function mostrar(DateTime $fecha){

        if(isset($fecha)){
            $this->modelo->leerReserva($fecha);
        }else{
            $this->modelo->leerTodasLasReservas();
        }

    }

    public function borrar(DateTime $fecha){

        if(isset($fecha)){
            $this->modelo->borrarReserva($fecha);
        }else{
            $this->modelo->borrarTodasLasReservas();
        }

    }

    public function guardar(){
        DateTime::createFromFormat();
        $fecha = DateTime::createFromFormat('d/m/Y H:i:s',$_POST['fecha']);

        $reserva = new ReservaParqueBolas($fecha,$_POST['numHoras'],array(),$_POST['costeHora']);

        $this->modelo->insertarReserva($reserva);
    }




}