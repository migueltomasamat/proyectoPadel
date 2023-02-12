<?php
declare(strict_types=1);

namespace App\Modelo\Personas;

use App\Personas\Persona;
use App\Modelo\Excepciones\PersonaNoInsertadaException;
use PDO;

require_once __DIR__ . "/../parametrosDB.php";

class PersonasDAOMySQL extends PersonasDAO
{
    public function __construct(){
        $this->setConexion(new PDO("mysql:dbname=" . NOMBREBD . ";host=" . SERVIDOR, USUARIO, PASS));
        $this->getConexion()->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    }

    /**
     * @throws PersonaNoInsertadaException
     */
    public function guardarPersona(Persona $persona): self
    {
        if ($this->existePersona($persona->getDNI())){
            throw new PersonaNoInsertadaException("La persona ya existe");
        }else {
            $query = "INSERT INTO persona (DNI, nombre, apellidos, telefono) VALUES(?,?,?,?)";

            $sentenciaPreparada = $this->getConexion()->prepare($query);



            if ($persona->getTelefono() == '') {
                $isOK = $sentenciaPreparada->execute(
                    [$persona->getDNI(), $persona->getNombre(), $persona->getApellidos(), 'null']
                );
            } else {
                $isOK = $sentenciaPreparada->execute(
                    [$persona->getDNI(), $persona->getNombre(), $persona->getApellidos(), $persona->getTelefono()]
                );
            }

            if (!$isOK) {
                throw new PersonaNoInsertadaException();
            }
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
        $query = "DELETE FROM persona WHERE DNI= :dni";
        $sentenciaPreparada = $this->getConexion()->prepare($query);

       $sentenciaPreparada->bindParam("dni",$dni,PDO::PARAM_STR);

       echo  $sentenciaPreparada->execute();

        if ($sentenciaPreparada->fetch()){
            echo "Se ha borrado correctamente el elemento";
        }else{
            echo "No se puede borrar el elemento";
        }
        return $this;
    }

    public function obtenerPersona(string $dni): Persona
    {
        $sentencia = $this->getConexion()->prepare("SELECT * FROM persona WHERE  DNI=:dni");

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

        $personas=[];
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

        $sentenciaPreparada->bindValue(1,$persona->getNombre());
        $sentenciaPreparada->bindValue(2,$persona->getApellidos());
        $sentenciaPreparada->bindValue(3,$persona->getTelefono());
        $sentenciaPreparada->bindValue(4,$persona->getDNI());

        echo $sentenciaPreparada->execute();


        if ($sentenciaPreparada->fetch()){
            echo "Se ha modificado correctamente el elemento";
        }else{
            echo "No se puede modificar el elemento";
        }
        return $this;
    }

    public function existePersona($dniPersona):bool{
        $query = "SELECT * FROM persona WHERE DNI=?";
        $sentencia = $this->getConexion()->prepare($query);
        $sentencia->bindParam(1,$dniPersona);
        $sentencia->execute();
        if (is_array($sentencia->fetch())){
            return true;
        }
        return false;


    }
}