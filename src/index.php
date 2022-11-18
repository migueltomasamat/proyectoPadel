<?php


//    use \App\Persona;

    namespace App;

    require "autoload.php";

    use App\Horarios\HorarioDiario;
    use App\Horarios\HorarioMensual;
    use App\Horarios\Intervalo;
    use App\Personas\Entrenador;
    use App\Personas\Enums\LadoPreferido;
    use App\Personas\Enums\ManoHabil;
    use App\Personas\Jugador;
    use App\Personas\Persona;
    use Controlador\PersonaControlador;
    use Modelo\Personas\PersonasDAOMySQL;
    use Vista\Landing;
    use Vista\Plantilla\Plantilla;
    use App\Router;


    $router = new Router();
    $router->get("get",'/',[Landing::class,"mostrarPagina"]);
    $router->get('get','/persona/login',[PersonaControlador::class,"index"]);
    $router->get("get",'/api/personas',[PersonaControlador::class,"apiPersonas"]);
    $router->get('get','/api/persona',[PersonaControlador::class,'mostrarPersona']);
    $router->post('post','/api/persona',[PersonaControlador::class,"create"]);
    $router->delete("delete",'/api/persona',[PersonaControlador::class,"borrar"]);
    $router->put("put",'/api/persona',[PersonaControlador::class,"actualizar"]);

    $router->get("get",'/pista',function(){
        echo "Estás en pista";
    });

   echo  $router->resolver($_SERVER['REQUEST_URI'],$_SERVER['REQUEST_METHOD']);



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

