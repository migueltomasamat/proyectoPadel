<?php

namespace App\Test\Unit;

use App\Personas\Persona;

class PersonaTest extends \PHPUnit\Framework\TestCase
{

    /**
     * @return void
     * @covers App\Personas\Personas\
     */
    public function test_de_creacion_una_persona():void{
        $persona = new Persona('44771766N',"Miguel Ángel", "Tomás Amat",'96371506');

        $salida = "dni: "."44771766N".
        " - nombre: "."Miguel Ángel".
        " - apellidos: ". "Tomás Amat".
        " - telefono: ". "96371506";
        $this->assertEquals($salida, $persona);
    }

    /**
     * @return void
     * @covers App\Personas\Persona
     */
    public function test_de_conversion_a_json():void{
        $persona = new Persona('44771766N',"Miguel Ángel", "Tomás Amat",'96371506');

        $this->assertArrayNotHasKey("telefono",$persona->jsonSerialize());
    }

}