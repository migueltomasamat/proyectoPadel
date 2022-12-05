<?php

namespace App\Modelo\Personas;

use App\Modelo\Excepciones\MongoDBConexionIncorrectaException;
use App\Modelo\Excepciones\PersonaNoEncontradaException;
use App\Personas\Persona;
use MongoDB\Client;
use MongoDB\Database;
use MongoDB\Collection;
use Ramsey\Uuid\Uuid;

class PersonaDAOMongoDB extends PersonaDAO implements InterfazPersonas
{
    private Database $db;
    private Collection $coleccion;

    public function __construct()
    {
          if(!$this->setConexion(
            new Client("mongodb://root:example@mongo:27017"))){
              throw new MongoDBConexionIncorrectaException();
          }
          $this->db = $this->getConexion()->padel;
            $this->coleccion= $this->db->selectCollection("persona");
            //$this->coleccion->createIndex(["dni"=>1],["unique"=>true]);
            //$this->coleccion->createIndex(["correoelectronico"=>1],["unique"=>true]);

    }

    public function insertarPersona(Persona $persona):?Persona{
        //var_dump($persona->__serialize());

        $id = Uuid::uuid4()->toString();
        //var_dump($id);

        $this->coleccion->insertOne($persona->convertirPersonaAArrayParaMongoDB());
        /*$insertOneResult=$this->coleccion->insertOne(
            [
                "_id"=>"Hola",
                "dni"=>$persona->getDNI(),
              "nombre"=>$persona->getNombre(),
              "apellidos"=>$persona->getApellidos(),
              "telefono"=>$persona->getTelefono(),
              "correoelectronico"=>$persona->getCorreoElectronico(),
              "contasenya"=>$persona->getContrasenya()
                ],["safe"=>"true"]);*/
        //var_dump($insertOneResult);
        return $persona;

    }
    public function modificarPersona(Persona $persona):?Persona{
        $resultado=$this->coleccion->updateOne(["dni"=>$persona->getDNI()],
            ['$set'=>[
                "nombre"=>$persona->getNombre(),
                "apellidos"=>$persona->getApellidos(),
                "telefono"=>$persona->getTelefono(),
                "correoelectronico"=>$persona->getCorreoElectronico(),
                "contrasenya"=>$persona->getContrasenya()
            ]]
        );
        //var_dump($resultado);
        if ($resultado->getModifiedCount()){
            return $persona;
        }else{
            return null;
        }

    }

    public function modificarTodasLasPersonas(array $elementosAModificar){


        $resultado=$this->coleccion->updateMany([],
            ['$set'=>$elementosAModificar]
        );


    }
    public function borrarPersona(Persona $persona):?Persona{

    }
    public function borrarPersonaPorDNI(string $dni):?Persona{

    }
    public function leerPersona(string $dni):?Persona{

    }
    public function leerPersonaPorCorreoElectronico(string $correoElectronico):?Persona{

    }

    public function leerTodasLasPersonas():array{

        $retorno= $this->coleccion->find();
        //var_dump($retorno);
        foreach ($retorno as $documento){
            $arrayRetorno[]=$this->convertirArrayAPersona($documento->getArrayCopy());
        }
        return $arrayRetorno;

    }
    public function obtenerPersonasSinTelefono():?array{

    }
    public function obtenerPersonasPorNombre(string $nombre):?array{

    }
    public function obtenerPersonasPorApellidos(string $apellidos):?array{

    }
    public function obtenerRangoPersonas(int $inicio, int $numeroResultados=NUMERODERESULTADOSPORPAGINA):array{

        $consulta= $this->coleccion->find([],[
            'skip'=>$inicio,
            'limit'=>$numeroResultados
        ]);
        if ($consulta->valid()){
            $consulta->toArray();
        }else{
           throw new PersonaNoEncontradaException("No se puede encontrar el rango");
        }

    }
}