<?php

namespace App\Modelo\Excepciones;

class IntervaloException extends \Exception
{
    public function __construct(string $message = "Error de operación con la base de datos de la clase intervalo", int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}