<?php

namespace Modelo\Personas;

use App\Personas\Persona;
use PDO;

require_once __DIR__."/../parametrosDB.php";

class PersonasDAOMySQL extends PersonasDAO
{
    public function __construct(){
        $this->setConexion(new PDO("mysql:dbname=" . NOMBREBD . ";host=" . SERVIDOR, USUARIO, PASS));
        $this->getConexion()->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    }

    public function guardarPersona(Persona $persona): self
    {
        $query = "INSERT INTO persona (DNI, nombre, apellidos, telefono) VALUES(?,?,?,?)";

        $sentenciaPreparada = $this->getConexion()->prepare($query);

        $isOK=$sentenciaPreparada->execute([$persona->getDNI(),$persona->getNombre(),$persona->getApellidos(),$persona->getTelefono()]);

        if ($isOK){
            echo "sentencia ejecutada correctamente";
        }else{
            echo "sentencia no ejecutada";
        }

        return $this;

    }


    public function borrarPersona(Persona $persona): PersonasDAO
    {
        $this->borrarPersonaPorDNI($persona->getDNI());
        return $this;
    }

    public function borrarPersonaPorDNI(string $dni): self
    {
        $query = "DELETE FROM persona WHERE DNI=?";

        $sentenciaPreparada = $this->getConexion()->prepare($query);

       $sentenciaPreparada->bindParam(1,$dni);

        $isOk = $sentenciaPreparada->execute();


        if ($isOk){
            echo "Se ha borrado correctamente el elemento";
        }else{
            echo "No se puede borrar el elemento";
        }
        return $this;
    }

    public function obtenerPersona(string $dni): Persona
    {
        $sentencia = $this->getConexion()->prepare("SELECT * FROM persona WHERE DNI=:dni");

        $sentencia->bindParam(":dni",$dni);

        $sentencia->execute();

        $fila = $sentencia->fetch();

        $persona = new Persona($fila['DNI'],$fila['NOMBRE'],$fila['APELLIDOS']);

        $persona->setTelefono($fila['TELEFONO']);

        return $persona;
    }

    public function obtenerTodasLasPersonas(): array
    {
        $sentencia = $this->getConexion()->query("SELECT * FROM persona");

        $sentencia->execute();

        $resultado = $sentencia->fetchAll();

        $personas[]= null;
        foreach($resultado as $fila){
            $personas[]=new Persona($fila["DNI"],$fila["NOMBRE"],$fila["APELLIDOS"]);
        }

        return $personas;
    }

    public function obtenerPersonasConLimite(int $resultadoInicial=0, int $resultadoFinal=20): array
    {
        $sentencia = $this->getConexion()->query("SELECT * FROM persona LIMIT $resultadoInicial, $resultadoFinal");

        $sentencia->execute();

        $resultado = $sentencia->fetchAll();

        $personas[]= null;
        foreach($resultado as $fila){
            $personas[]=new Persona($fila["DNI"],$fila["NOMBRE"],$fila["APELLIDOS"]);
        }

        return $personas;
    }

    public function modificarPersona(Persona $persona): PersonasDAO
    {
        $query = "UPDATE persona SET nombre=?, apellidos=?, telefono=? WHERE dni=?";

        $sentenciaPreparada = $this->getConexion()->prepare($query);

        $sentenciaPreparada->bindParam(1,$persona->getNombre());
        $sentenciaPreparada->bindParam(2,$persona->getApellidos());
        $sentenciaPreparada->bindParam(3,$persona->getTelefono());
        $sentenciaPreparada->bindParam(4,$persona->getDNI());

        $isOk = $sentenciaPreparada->execute();


        if ($isOk){
            echo "Se ha modificado correctamente el elemento";
        }else{
            echo "No se puede modificar el elemento";
        }
        return $this;
    }
}