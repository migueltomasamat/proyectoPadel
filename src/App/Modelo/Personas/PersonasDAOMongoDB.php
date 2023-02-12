<?php

namespace App\Modelo\Personas;

use App\Controlador\Exception\PersonaNoEncontradaException;
use App\Personas\Persona;
use MongoDB\Client;

use MongoDB\Database;
use MongoDB\Collection;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidFactory;

use function MongoDB\BSON\toJSON;

class PersonasDAOMongoDB extends PersonasDAO implements interfazPersonas
{
    private Database $db;
    private Collection $coleccion;



    public function __construct()
    {
        $this->setConexion(new Client("mongodb://root:example@mongo:27017"));
        $this->setDb($this->getConexion()->padel);
        $this->setColeccion($this->getDb()->persona);
        //$this->coleccion->createIndex(["DNI"=>1],["unique"=>true]);

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
        //$factory = new UuidFactory();

        $id = Uuid::uuid4()->toString();

        $documento = array("_id"=>$id,"DNI"=>$persona->getDNI(),"Nombre"=>$persona->getNombre(),"Apellidos"=>$persona->getApellidos(),"Telefono"=>$persona->getTelefono());


        $isOk = $this->getColeccion()->insertOne($documento);

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
        var_dump ($this->coleccion->deleteOne(['DNI'=>$dni]));
    }

    public function obtenerPersona(string $dni): Persona
    {
        $documento=$this->coleccion->findOne(['DNI'=>$dni]);
        var_dump($documento);




    }

    public function obtenerTodasLasPersonas(): array
    {
        $cursor = $this->coleccion->find();
        $arrayDevolucion =[];

        foreach ($cursor as $document) {

            echo json_encode($document->getArrayCopy());
        }
        return $arrayDevolucion;
    }

    public function obtenerPersonasConLimite(int $resultadoInicial, int $resultadoFinal): array
    {
        $cursor = $this->coleccion->find(
            [],
            [
                'limit'=>$resultadoFinal,
                'skip'=>$resultadoInicial
            ]
        );
        return $cursor->toArray();

    }

    public function modificarPersona(Persona $persona): PersonasDAO
    {
        var_dump ($this->coleccion->updateOne(
            ['DNI'=>$persona->getDNI()],
            ['$set'=>['nombre'=>$persona->getNombre(),
                    'apellidos'=>$persona->getApellidos(),
                    'telefono'=>$persona->getApellidos()
                ]]
        ));
        return $this;

    }
}