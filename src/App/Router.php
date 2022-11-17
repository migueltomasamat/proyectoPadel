<?php

namespace App;

class Router
{
    private array $rutas;


    public function get(string $metodo, string $ruta, callable|array $accion):self{

        $this->rutas[$metodo][$ruta]=$accion;
        return $this;
    }
    public function post(string $metodo, string $ruta, callable|array $accion):self{

        $this->rutas[$metodo][$ruta]=$accion;
        return $this;
    }
    public function delete(string $metodo, string $ruta, callable|array $accion):self{

        $this->rutas[$metodo][$ruta]=$accion;
        return $this;
    }
    public function put(string $metodo, string $ruta, callable|array $accion):self{

        $this->rutas[$metodo][$ruta]=$accion;
        return $this;
    }

    public function resolver($requestUri, $requestMethod){

        $ruta= parse_url($requestUri, PHP_URL_PATH);
        //Tengo que separar los ultimos caracteres de la URL
        $parametros = null;
        if(substr_count($ruta,'/')>1){
            $parametros = explode('/',$ruta)[2];
            $ruta="/".explode('/',$ruta)[1];
        }
        $metodo = strtolower($requestMethod);
        echo $ruta."<br>".$parametros;

        //Si la ruta no está registrada
        $accion = $this->rutas[$metodo][$ruta] ?? null;

        if (!$accion){
            echo "No hay ruta";
            return http_response_code(404);
        }else {
            if (is_callable($accion)) {
                return call_user_func($accion);
            }

            if (is_array($accion)) {
                [$clase, $metodo] = $accion;
                if (class_exists($clase)) {
                    $clase = new $clase();
                    if (method_exists($clase, $metodo)) {
                        return call_user_func_array([$clase, $metodo], [$parametros]);
                    }
                }
            }
            throw new \Exception("Ruta no encontrada");
        }
    }

}