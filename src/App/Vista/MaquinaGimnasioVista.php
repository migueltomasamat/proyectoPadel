<?php

namespace App\Vista;

use App\Vista\Plantilla\Plantilla;

class MaquinaGimnasioVista
{
    private Plantilla $plantilla;

    public function __construct()
    {
        $this->plantilla= new Plantilla('Maquina de Gimnasio',encabezadoPrincipal: "Estadísticas de reservas",descripcionPrincipal: "Este es el porcentaje de utilización de la máquina");
    }

    public function mostrarPlantillaCompleta(float $gradoUtilizacion){

        $string = $this->plantilla->getEncabezado();
        $string .= $this->plantilla->getNav();
        $string .= $this->plantilla->getBloquePresentacion();
        $string .= "El grado de utilización es: ".$gradoUtilizacion ." %";
        $string .=$this->plantilla->getFooter();

        echo $string;

    }
}