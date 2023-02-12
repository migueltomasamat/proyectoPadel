<?php

namespace App\Controlador\Exception;

use Controlador\Exception\Throwable;

class PersonaNoEncontradaException extends \Exception
{
    public function __construct(string $message = "", int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}