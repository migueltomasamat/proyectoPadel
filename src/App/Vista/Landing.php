<?php

namespace App\Vista;

use App\Vista\Plantilla\Plantilla;

class Landing
{
    private Plantilla $html;

    public function __construct()
    {
        $this->html = new Plantilla("Cobra Padel",encabezadoPrincipal: "Cobra Pádel",
            descripcionPrincipal: "Si amas el pádel este es tu lugar, bienvenido",
            menu: ['Inicio'=>'/','Log-In'=>'/persona/login','Pistas'=>'/pistas']);
        $this->html->generarTestimonio();
        $this->html->generarServicios();
        $this->html->generarPrecios();
        $this->html->generarEmpleados();
    }

    public function mostrarPagina():void{
        echo $this->html->generarWebCompleta();
    }


}