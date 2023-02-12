<?php

namespace App\Controlador\Exception;

class BorrarPersonaException extends \Exception
{

    public function __construct(string $message = "Error al borrar persona", int $code = 0, ?\Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}