<?php

namespace App\Controlador\Servicios;

use App\Modelo\Personas\PersonasDAOMySQL;
use App\Modelo\Servicios\ParqueBolasModelo;
use App\Servicios\ParqueBolas;
use App\Vista\ParqueBolasVista;
use App\Personas\Persona;

class ParqueBolasControlador
{
    private ParqueBolasModelo $modelo;
    private ParqueBolasVista $vista;

    public function __construct()
    {
        $this->modelo = new ParqueBolasModelo();
        $this->vista = new ParqueBolasVista();
    }

    public function index(){
        $resultado= $this->modelo->mostrarTodos();
        echo json_encode($resultado);
    }

    public function mostrar(){
        //var_dump($this->calcularCostePorPersona());
        $this->vista->mostrarPlantillaCompleta($this->calcularCostePorPersona());
    }

    public function store(){
        foreach ($_POST['clientes'] as $idCliente){
            $modeloPersona= new PersonasDAOMySQL();
            $arrayClientes[] = $modeloPersona->obtenerPersona($idCliente);
        }

        $parqueBolas = new ParqueBolas(\DateTime::createFromFormat("Y-m-d H:i:s",$_POST['fecha']),$_POST['num_horas'],$arrayClientes,$_POST['coste_hora']);

        $this->modelo->insertarParqueBolas($parqueBolas);

    }

    public function delete(string $fecha){
        $this->modelo->borrarParquePorFecha(\DateTime::createFromFormat('Y-m-d-H:i:s',$fecha));
    }

    public function calcularCostePorPersona():array{

        $clientes = [
            [new Persona( '44111444A', 'Inmaculada', "Climent Villaescusa"),30],
            [new Persona( '44111555B', 'Silvia', "Verdú Pina"),70]
        ];
        $parqueBolas = new ParqueBolas(\DateTime::createFromFormat("Y-m-d H:i:s",'2024-05-05 09:00:00'),4,$clientes,4);

        $totalCoste = $parqueBolas->getCosteHora()*$parqueBolas->getNumHoras();

        foreach ($parqueBolas->getClientes() as $arrayCliente){
            $arrayResultado[]=[$arrayCliente[0],($totalCoste*($arrayCliente[1]/100))];
        }
        return $arrayResultado;
    }
}