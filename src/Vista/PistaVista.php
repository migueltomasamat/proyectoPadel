<?php

namespace Vista;
use Vista\Plantilla\Plantilla;

class PistaVista
{
    private Plantilla $html;

    public function __construct()
    {
        $this->html= new Plantilla("Pista");
    }
}