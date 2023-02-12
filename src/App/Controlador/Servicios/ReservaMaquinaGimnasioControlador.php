<?php

namespace App\Controlador\Servicios;

use App\Modelo\Personas\PersonasDAOMySQL;
use App\Modelo\Servicios\MaquinaGimnasioModelo;
use App\Servicios\ReservaMaquinaGimnasio;
use App\Vista\MaquinaGimnasioVista;

class ReservaMaquinaGimnasioControlador
{
    private MaquinaGimnasioModelo $modelo;
    private MaquinaGimnasioVista $vista;

    public function __construct()
    {
        $this->modelo = new MaquinaGimnasioModelo();
        $this->vista = new MaquinaGimnasioVista();
    }

    public function index(){
        echo json_encode($this->modelo->mostrarTodos());
    }

    public function store(){
        //Creación de la instancia de la reserva con los datos obtenidos
        $reservaMaquina = new ReservaMaquinaGimnasio();
        $fecha = \DateTime::createFromFormat('Y-m-d-H:i:s',$_POST['fecha']);
        $reservaMaquina->setFecha($fecha);
        $reservaMaquina->setNumHoras($_POST['num_horas']);
        $reservaMaquina->setCosteHora($_POST['coste_hora']);
        $modeloPersona = new PersonasDAOMySQL();
        $reservaMaquina->setCliente($modeloPersona->obtenerPersona($_POST['cliente']));

        $this->modelo->insertarReservaMaquinaGimnasio($reservaMaquina);

    }

    public function destroy(string $fecha){
        $fecha = \DateTime::createFromFormat('Y-m-d-H:i:s',$fecha);
        $this->modelo->borrarReservaPorFecha($fecha);
    }

    public function calcularOcupacionMaquina(array $reservaMaquinaGimanasio):float{
        $gradoUtilizacion=0;
        foreach ($reservaMaquinaGimanasio as $reserva){
            $gradoUtilizacion+=$reserva['num_horas'];
        }
        return (($gradoUtilizacion/12)/30)*100;

    }

    public function mostrarGradoOcupacion(){
        $this->vista->mostrarPlantillaCompleta($this->calcularOcupacionMaquina($this->modelo->mostrarTodos()));
    }

}