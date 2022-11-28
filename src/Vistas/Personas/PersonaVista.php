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
        $this->html->generarDosColumnasConFondoBlanco("Formulario de registro", $this->formularioRegistro(),$this->formularioLogin());
    }

    private function formularioRegistro():string{

        return "
            <h3>Registrate en nuestro club</h3>
            <form action=/persona/create method=post>
            <div class='mb-3'>
                <label for='inputDNI' class='form-label'>DNI</label>  
                <input type='text' class='form-control' name='dni' id='inputDNI' placeholder='Introduce el dni'>
            </div>
            <div class='mb-3'>
                <label for='inputNombre' class='form-label'>Nombre</label> 
                <input type='text' class='form-control' name='nombre' id='inputNombre' placeholder='Introduce el nombre'>
            </div>
            <div class='mb-3'>
                <label for='inputApellido' class='form-label'>Apellidos</label>
                <input type='text' class='form-control' name='apellidos' id='inputApellido' placeholder='Introduce los apellidos'>
            </div>
            <div class='mb-3'>
                <label for='inputTelefono' class='form-label'>Teléfono</label>
                <input type=tel class='form-control' name='apellidos' id='inputTelefono' placeholder='Introduce tu teléfono'>
            </div>
                <button type='submit' class='btn btn-primary'>Enviar Datos</button>
            </form>
        ";
    }

    private function formularioLogin():string{

        return "
            <h3>Entra con tu usuario y contraseña</h3>
            <form action=/persona/create method=post>
            <div class='mb-3'>
                <label for='inputCorreo' class='form-label'>Correo Electrónico</label>  
                <input type='text' class='form-control' name='correo' id='inputCorreo' placeholder='Introduce tu correo'>
            </div>
            <div class='mb-3'>
                <label for='inputPass' class='form-label'>Nombre</label> 
                <input type='password' class='form-control' name='pass' id='inputPass' placeholder='Introduce tu contraseña'>
            </div> 
            <button type='submit' class='btn btn-primary'>Log-In</button>
            </form>
        ";
    }

    public function mostrarPagina():void{
        echo $this->html->generarWebCompleta();
    }
}