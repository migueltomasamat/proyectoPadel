<?php

namespace App\Personas;

use App\Log\LogFactory;
use Monolog\Logger;

class Persona implements \JsonSerializable
{
    private string $dni;
    private string $nombre;
    private string $apellidos;
    private ?string $telefono;

    private Logger $log;

    public function __construct(string $dni, string $nombre="Sin nombre", string $apellidos="Sin apellidos", string $telefono=''){
        $this->dni=$dni;
        $this->nombre=$nombre;
        $this->apellidos=$apellidos;
        $this->telefono=$telefono;

        $this->log= LogFactory::getLogger();
        $this->log->debug("Se ha creado la persona: \n".$this->__toString());
    }

    public function setDNI(string $dni):Persona{
        $this->dni=$dni;
        return $this;
    }

    public function getDNI():string{
        return $this->dni;
    }

    /**
     * @return string
     */
    public function getNombre(): string
    {
        return $this->nombre;
    }

    /**
     * @param string $nombre
     * @return Persona
     */
    public function setNombre(string $nombre): Persona
    {
        $this->nombre = $nombre;
        return $this;
    }

    /**
     * @return string
     */
    public function getApellidos(): string
    {
        return $this->apellidos;
    }

    /**
     * @param string $apellidos
     * @return Persona
     */
    public function setApellidos(string $apellidos): Persona
    {
        $this->apellidos = $apellidos;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTelefono():string
    {
        return $this->telefono;
    }

    /**
     * @param mixed $telefono
     * @return Persona
     */
    public function setTelefono($telefono):Persona
    {
        $this->telefono = $telefono;
        return $this;
    }

    public function __serialize(): array
    {
        return [
           "dni"=>$this->dni,
           "nombre" => $this->nombre,
           "apellidos" => $this->apellidos,
           "telefono" => $this->telefono
        ];
    }

    public function __unserialize(array $data): void
    {
        $this->dni=$data['dni'];
        $this->nombre=$data['nombre'];
        $this->apellidos=$data['apellidos'];
        $this->telefono=$data['telefono'];

    }

    public function jsonSerialize(): mixed
    {
        return [
            "dni"=>$this->dni,
            "nombre" => $this->nombre,
            "apellidos" => $this->apellidos,
            "telefono" => $this->telefono
        ];
    }

    public function __toString(): string
    {
        return
        "dni: ".$this->dni.
        " - nombre: ".$this->nombre.
        " - apellidos: ". $this->apellidos.
        " - telefono: ". $this->telefono;
    }

    public function _de_creacion_una_persona()
    {
    }
}