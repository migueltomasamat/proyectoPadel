<?php

spl_autoload_register(function ($class) {
    $fichero = __DIR__."/".$class . ".php";
    $fichero = str_replace("\\", "/", $fichero);
//    echo "<br>" . $fichero;
    if (file_exists($fichero)){
        require_once($fichero);
    }
}
);
