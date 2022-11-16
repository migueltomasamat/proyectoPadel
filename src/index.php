<?php


//    use \App\Persona;

    namespace App;

    use App\Personas\Persona;
    use Controlador\Personas\PersonaControlador;
    use Modelo\Personas\PersonaDAOMySQL;
    use Vistas\Personas\PersonaVista;
    use Vistas\Plantillas\Plantilla;

    include __DIR__."/autoload.php";

    $router = new Router();
    $router->guardarRuta('/',function(){
        echo "Estoy en el index";
    });
    $router->guardarRuta('/persona',[PersonaControlador::class,"login"]);

    $router->resolverRuta($_SERVER['REQUEST_URI']);

