<?php

namespace Vista;

use Vista\Plantilla\Plantilla;

class PersonaVista
{
    private Plantilla $html;

    public function __construct()
    {
        $this->html= new Plantilla("Personas",encabezadoPrincipal: "Gestión de Personas",
            descripcionPrincipal: "Bienvenido al apartado para la gestión de personas");

        //$this->html->setBody($this->formularioRegistro());
        $this->html->generarDosColumnasConFondoBlanco("Formulario de registro", $this->formularioRegistro(),'');
    }

    private function formularioRegistro():string{

        return "
            <form action=/persona/create method=post>
                <input type='text' name='dni' placeholder='Introduce el dni'>
                <input type='text' name='nombre' placeholder='Introduce el nombre'> 
                <input type='text' name='apellidos' placeholder='Introduce los apellidos'>
                <button type='submit'>Enviar Datos</button>
            </form>
        ";
    }
    public function mostrarPagina():void{
        echo $this->html->generarWebCompleta();
    }
}