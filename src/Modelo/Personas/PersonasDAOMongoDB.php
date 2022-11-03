<?php

namespace Modelo\Personas;

use App\Personas\Persona;

class PersonasDAOMongoDB extends PersonasDAO
{
    private $db;
    private $coleccion;



    public function __construct()
    {
        $this->setConexion(new MongoClient());
        $this->setDb($this->getConexion()->padel);
        $this->setConexion($this->getDb()->persona);
    }

    /**
     * @return mixed
     */
    public function getDb()
    {
        return $this->db;
    }

    /**
     * @param mixed $db
     */
    public function setDb($db): void
    {
        $this->db = $db;
    }

    /**
     * @return mixed
     */
    public function getColeccion()
    {
        return $this->coleccion;
    }

    /**
     * @param mixed $coleccion
     */
    public function setColeccion($coleccion): void
    {
        $this->coleccion = $coleccion;
    }

    public function guardarPersona(Persona $persona): PersonasDAO
    {
        $documento = array("DNI"=>$persona->getDNI(),"Nombre"=>$persona->getNombre(),"Apellidos"=>$persona->getApellidos(),"Telefono"=>$persona->getTelefono());

        $isOk = $this->getColeccion()->insert($documento);

        if ($isOk){
            echo "La persona se ha insertado correctamente en MondoDB";
        }else{
            echo "Ha habido un error insertando la persona en MongoDB";
        }
        return $this;
    }

    public function borrarPersona(Persona $persona): PersonasDAO
    {
        // TODO: Implement borrarPersona() method.
    }

    public function borrarPersonaPorDNI(string $dni): PersonasDAO
    {
        // TODO: Implement borrarPersonaPorDNI() method.
    }

    public function obtenerPersona(string $dni): Persona
    {
        // TODO: Implement obtenerPersona() method.
    }

    public function obtenerTodasLasPersonas(): array
    {
        // TODO: Implement obtenerTodasLasPersonas() method.
    }

    public function obtenerPersonasConLimite(int $resultadoInicial, int $resultadoFinal): array
    {
        // TODO: Implement obtenerPersonasConLimite() method.
    }

    public function modificarPersona(Persona $persona): PersonasDAO
    {
        // TODO: Implement modificarPersona() method.
    }
}