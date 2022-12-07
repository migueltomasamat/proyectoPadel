<?php


//    use \App\Persona;

    namespace App;

    use App\Controlador\Personas\PersonaControlador;
    use App\Modelo\Personas\PersonaDAOMongoDB;
    use App\Vistas\LandingVista;
    use App\Vistas\LoginVista;
    use App\Personas\Persona;
    use App\Controlador\Servicios\PistaControlador;
    session_start();

    include __DIR__."/vendor/autoload.php";


    /*$mongodb= new PersonaDAOMongoDB();
    $persona = new Persona('44111444B','Carlos','Martinez',
        'carlos@gmail.com','1234',"987653421");

    //$persona->setCorreoElectronico("");


    //$mongodb->insertarPersona($persona);
    $mongodb->modificarPersona($persona);



    //ar_dump($mongodb->leerTodasLasPersonas());*/




    $router = new Router();
    $router->guardarRuta('get','/',[LandingVista::class,"mostrarPagina"]);
    $router->guardarRuta('get','/login',[LoginVista::class,"mostrarLogin"]);
    $router->guardarRuta('post','/logear',[PersonaControlador::class,"recibirDatosLogin"]);
    $router->guardarRuta('get','/api/persona',[PersonaControlador::class,"mostrar"]);
    $router->guardarRuta('post','/api/persona',[PersonaControlador::class,"guardar"]);
    $router->guardarRuta('delete','/api/persona',[PersonaControlador::class,"borrar"]);
    $router->guardarRuta('put','/api/persona',[PistaControlador::class,"modificar"]);
    $router->guardarRuta('get','/api/pista',[PistaControlador::class,"mostrar"]);
    $router->guardarRuta('post','/api/pista',[PistaControlador::class,"guardar"]);
    $router->guardarRuta('delete','/api/pista',[PistaControlador::class,"borrar"]);
    $router->guardarRuta('put','/api/pista',[PistaControlador::class,"modificar"]);

    $router->resolverRuta($_SERVER['REQUEST_URI'],$_SERVER['REQUEST_METHOD']);

