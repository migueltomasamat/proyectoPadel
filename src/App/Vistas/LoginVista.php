<?php

namespace App\Vistas;

use App\Vistas\Plantillas\Plantilla;

class LoginVista
{
    private Plantilla $html;

    public function __construct()
    {
        $this->html= new Plantilla("Login de usuarios",encabezadoPrincipal: "Cobra Padel",
            descripcionPrincipal:"Inicia sesión para acceder a tu cuenta");
        $this->html->generarDosColumnasConFondoBlanco
        ("Introduce tus datos",
            $this->generarFormularioLogin(),
            $this->generarFormularioRegistro());
    }

    public function generarFormularioLogin():string{

        $salida="
            
            <h3>Entra con tu usuario y contraseña</h3>
           <form action='/logear' method='post'>
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
        return $salida;
    }

    public function generarFormularioRegistro():string{
        $salida="
            
            <h3>Registrate en nuestro club</h3>
            <form action='/api/persona' method='post'>
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
            
            </form>
        ";
        return $salida;

    }
    public function mostrarLogin():void{
        echo $this->html->generarWebCompleta();
    }


}