<?php

namespace Controlador;

use App\Personas\Persona;
use Controlador\Exception\BorrarPersonaException;
use Modelo\Personas\PersonasDAO;
use Modelo\Personas\PersonasDAOMySQL;
use Vista\PersonaVista;

class PersonaControlador
{
    private ?PersonasDAO $modelo = null;
    private ?PersonaVista $vista = null;

    public function __construct()
    {
        $this->modelo=new PersonasDAOMySQL();
        $this->vista= new PersonaVista();
    }

    public function create(){
        $persona = new Persona($_POST['dni'],$_POST['nombre'],$_POST['apellidos']);
        $this->modelo->guardarPersona($persona);

    }

    public function todasLasPersonas(){
        $arrayPersonas = $this->modelo->obtenerTodasLasPersonas();
        header('Content-type:application/json;charset=utf-8');

        $salida='';
        foreach ($arrayPersonas as $persona){
            $salida.= json_encode($persona,JSON_PRETTY_PRINT);
        }
        echo $salida;
    }

    public function borrar($idPersona){

        if ($this->modelo->existePersona($idPersona)) {
            if ($this->modelo->borrarPersonaPorDNI($idPersona)) {
                //$this->vista->mostrarPagina();
            } else {
                throw new BorrarPersonaException();
            }
        }else{
            echo "Persona no encontrada";
        }

    }

    public function index(){
        $this->vista->mostrarPagina();
    }

    public function actualizar($idPersona){
        parse_str(file_get_contents("php://input"),$put_vars);
        echo "<pre>";

        var_dump($_SESSION);

        echo "<pre>";

        if ($this->modelo->existePersona($idPersona)) {
            $persona = $this->modelo->obtenerPersona($idPersona);

            if (isset($put_vars['nombre'])){
                $persona->setNombre($put_vars['nombre']);
            }
            if (isset($put_vars['apellidos'])){
                $persona->setApellidos($put_vars['apellidos']);
            }
            if (isset($put_vars['telefono'])){
                $persona->setTelefono();
            }

            $this->modelo->modificarPersona($persona);
        }else{
            throw new PersonaNoEncontradaException();
        }



    }
}