<?php


//    use \App\Persona;

    namespace App;

    use App\Controlador\Personas\PersonaControlador;
    use App\Vistas\LandingVista;
    use App\Vistas\LoginVista;


    include __DIR__."/vendor/autoload.php";

//    echo "<pre>";
//    var_dump($_SERVER);
//    echo "<pre>";

    $router = new Router();
    $router->guardarRuta('get','/',[LandingVista::class,"mostrarPagina"]);
    $router->guardarRuta('get','/login',[LoginVista::class,"mostrarLogin"]);
    $router->guardarRuta('post','/logear',[PersonaControlador::class,"recibirDatosLogin"]);
    $router->guardarRuta('get','/api/persona',[PersonaControlador::class,"mostrar"]);
    $router->guardarRuta('post','/api/persona',[PersonaControlador::class,"guardar"]);
    $router->guardarRuta('delete','/api/persona',[PersonaControlador::class,"borrar"]);
    $router->guardarRuta('put','/api/persona',[PersonaControlador::class,"modificar"]);

    $router->resolverRuta($_SERVER['REQUEST_URI'],$_SERVER['REQUEST_METHOD']);

