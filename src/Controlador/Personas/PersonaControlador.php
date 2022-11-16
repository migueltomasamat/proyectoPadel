<?php

namespace Controlador\Personas;

use Modelo\Personas\PersonaDAO;
use Modelo\Personas\PersonaDAOMySQL;
use App\Personas\Persona;



class PersonaControlador
{
    private personaDAO $modelo;
    private personaVista $vista;

    /**
     * @param personaDAO $modelo
     * @param personaVista $vista
     */
    public function __construct()
    {
        $this->modelo = new personaDAOMySQL();
        //$this->vista = new personaVista();
    }
    public function comprobarUsuarioWeb($correoUsuario, $pass){
        $persona=$this->modelo->leerPersonaPorCorreoElectronico($correoUsuario);
        if(password_verify($pass,$persona->getContrasenya())){
            echo "yupiiiii";
        }else{
            echo "contraseña incorrecta";
        }

    }

    public function crear(){

        $passCifrado = password_hash("1234",PASSWORD_DEFAULT);
        $persona = new Persona('44111555H','Javier','Azpeleta',
            'javieraz@gmail.com',$passCifrado,"987653421");
        $this->modelo->insertarPersona($persona);
    }

    public function login(){
        echo "Esta es la página de login";
    }




}