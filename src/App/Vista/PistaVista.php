<?php

namespace App\Vista;
use App\Vista\Plantilla\Plantilla;

class PistaVista
{
    private Plantilla $html;

    public function __construct()
    {
        $this->html= new Plantilla("Pista");
    }
}