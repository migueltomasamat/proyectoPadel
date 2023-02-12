<?php

namespace App\Controlador;

use App\Controlador\Exception\BorrarPersonaException;
use App\Personas\Persona;
use App\Controlador\PersonaNoEncontradaException;
use App\Modelo\Excepciones\PersonaNoInsertadaException;
use App\Modelo\Personas\PersonasDAO;
use App\Modelo\Personas\PersonasDAOMySQL;
use App\Vista\PersonaVista;

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
        $parametros = array_change_key_case($_POST,CASE_LOWER);
        $persona = new Persona($parametros['dni'],$parametros['nombre'],$parametros['apellidos']);
        try{
            $this->modelo->guardarPersona($persona);
        }catch (PersonaNoInsertadaException $e){
            header($e->getMessage(),true,500);
            die;
        }
        header("Persona creada correctamente",true,201);

    }

    public function mostrarPersona($dni){
        echo  json_encode($this->modelo->obtenerPersona($dni),JSON_PRETTY_PRINT);
    }

    public function apiPersonas($dni){

        if (isset($dni)){
            $this->mostrarPersona($dni);
        }else{
            $this->todasLasPersonas();
        }

    }

    public function todasLasPersonas(){
        $arrayPersonas = $this->modelo->obtenerTodasLasPersonas();
        header('Content-type:application/json;charset=utf-8');




        echo json_encode($arrayPersonas,JSON_PRETTY_PRINT);
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