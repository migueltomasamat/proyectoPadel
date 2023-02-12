<?php

namespace App\Vista;

use App\Vista\Plantilla\Plantilla;

class ParqueBolasVista
{
    private $plantilla;

    public function __construct(){
        $this->plantilla= new Plantilla();
    }

    public function mostrarPlantillaCompleta(array $arrayResultado){

        $string = $this->plantilla->getEncabezado();
        $string .= $this->plantilla->getNav();
        $string .= $this->plantilla->getBloquePresentacion();
        $string .= "<table class='table'>
                    <thead>
                        <tr>
                            <td scope='col'>Persona</td>
                            <td scope='col'>Pago</td>
                        <tr>
                    </thead>
                    <tbody>";
        foreach ($arrayResultado as $fila){
            $string .= "<tr>
                    <td>".$fila[0]->getNombre()." ". $fila[0]->getApellidos() ."</td>
                    <td>".$fila[1]."</td>
                    </tr>";
        }
        $string.="</tbody>
                    </table>";
        $string.=$this->plantilla->getFooter();

        echo $string;

    }
}