<?php




    namespace App;
    use App\Controlador\PistaControlador;
    use App\Controlador\Servicios\ParqueBolasControlador;
    use App\Controlador\Servicios\ReservaMaquinaGimnasioControlador;
    use App\Modelo\Servicios\ParqueBolasModelo;
    use App\Personas\Persona;

    require __DIR__."/vendor/autoload.php";

    use App\Controlador\PersonaControlador;
    use App\Servicios\ParqueBolas;
    use App\Servicios\ReservaMaquinaGimnasio;
    use App\Vista\Landing;
    //$mongodb = new Modelo\Personas\PersonasDAOMongoDB();
    $persona = new Persona('44111222A', "Alba","Garcia Garcia");
    //$persona = new Persona( '44111444A', 'Inmaculada', "Climent Villaescusa");
    //$mongodb->guardarPersona($persona);
    //$mongodb->modificarPersona($persona);

    //$mongodb->obtenerTodasLasPersonas();
    /*echo "<pre>";
    echo json_encode($mongodb->obtenerPersonasConLimite(0,2),JSON_PRETTY_PRINT);
    echo "<pre>";*/
    //$mongodb->obtenerPersona('44111222A');
    //$mongodb->borrarPersonaPorDNI('44111222A');

//    $modelo = new ParqueBolasModelo();
//    $pb = new ParqueBolas(new \DateTime('now'),3,array(), 5.50);
//    $modelo->insertarParqueBolas($pb);








    $router = new Router();
    $router->get("get",'/',[Landing::class,"mostrarPagina"]);
    $router->get("get",'/pistas',[PistaControlador::class,"mostrarPistas"]);
    $router->get('get','/persona/login',[PersonaControlador::class,"index"]);
    $router->get("get",'/api/personas',[PersonaControlador::class,"apiPersonas"]);
    $router->get('get','/api/personas',[PersonaControlador::class,'mostrarPersona']);
    $router->post('post','/api/personas',[PersonaControlador::class,"create"]);
    $router->delete("delete",'/api/personas',[PersonaControlador::class,"borrar"]);
    $router->put("put",'/api/personas',[PersonaControlador::class,"actualizar"]);
    $router->put('get','/api/parquebolas',[ParqueBolasControlador::class,"index"]);
    $router->put('post','/api/parquebolas',[ParqueBolasControlador::class,"store"]);
    $router->put('delete','/api/parquebolas',[ParqueBolasControlador::class,"delete"]);
    $router->put('get','/parquebolas',[ParqueBolasControlador::class,"mostrar"]);
    $router->put('get','/api/maquinagimnasio',[ReservaMaquinaGimnasioControlador::class,"index"]);
    $router->put('post','/api/maquinagimnasio',[ReservaMaquinaGimnasioControlador::class,"store"]);
    $router->put('delete','/api/maquinagimnasio',[ReservaMaquinaGimnasioControlador::class,"destroy"]);
    $router->put('get','/maquinagimnasio',[ReservaMaquinaGimnasioControlador::class,"mostrarGradoOcupacion"]);






    $router->get("get",'/pista',function(){
        echo "Estás en pista";
    });

     $router->resolver($_SERVER['REQUEST_URI'],$_SERVER['REQUEST_METHOD']);



    /*include_once("App/Personas/Persona.php");
    include_once("App/Personas/Jugador.php");
    include_once("App/Personas/Enums/ManoHabil.php");
    include_once("App/Personas/Enums/LadoPreferido.php");
    include_once("App/Horarios/Intervalo.php");*/

    /*$persona = new Persona('12345678A','Javier','Gonzalez');

//    var_dump($persona);
    echo "<br>";
    echo "<br>";

    $jugador = new Jugador("87654321A",
        "Rocio",
        "Carratala",
        1,
        ManoHabil::Izquierda,
        LadoPreferido::Izquierdo);

//    var_dump($jugador);

    $intervalo1 = new Intervalo(8.00,9.00);
    $intervalo2 = new Intervalo(9.00,10.00);
    $intervalo3 = new Intervalo(10.00,11.00);

    var_dump($intervalo1);

    echo "<br>";

    var_dump($intervalo2);

    echo "<br>";

    var_dump($intervalo3);

    echo "<br>";

    $array = [$intervalo1,$intervalo2,$intervalo2];

    print_r($array);

    foreach ($array as $intervalo){

        echo "El intervalo comienza a las ".
            $intervalo->getHoraInicio()." y termina a las ".$intervalo->getHoraFin()."<br>";


    }

    echo "<br> Resultado de la búsqueda: ". array_search($intervalo2,$array);

    $entrenadorDeFiguras = new Entrenador("12345678A", "Toni", "Nadal", "Calle Bosquet", "1234567812345678909", "143528456A", 1, 031524);

    $jugador->setEntrenadorAsociado($entrenadorDeFiguras);

    print_r($jugador);*/

    /*$horario= new HorarioDiario(new \DateTime(),25.00,18.00, 75);
    $horario->generarIntervalos();
    echo $horario->imprimirHorarioDiario();*/

//    $hora = new \DateTime();
//    $hora->setTime(8,0);
//    $intervalo = new \DateInterval("75");
//    $hora->add($intervalo);
//    var_dump ($hora);


    //$persona = new Persona('44111222A', "Alba","Navarro Carbonell");
    //$persona->setTelefono("965431789");

    /*$bd= new PersonasDAOMySQL();
    //$bd->modificarPersona($persona);

    $personaLeida = $bd->obtenerTodasLasPersonas();

    var_dump($personaLeida);*/

//    $horarioMensual = new HorarioMensual(10,2022);
//
//    $horarioMensual->generarHorarios();
//
//    $plantilla = new Plantilla('Cobra Padel');
//
//
//    echo $plantilla->generarWebCompleta($horarioMensual);

