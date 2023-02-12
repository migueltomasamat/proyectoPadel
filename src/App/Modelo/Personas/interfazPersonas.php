<?php

namespace App\Modelo\Personas;

use App\Personas\Persona;

interface interfazPersonas
{
    public function guardarPersona (Persona $persona):PersonasDAO;
    public function borrarPersona (Persona $persona):PersonasDAO;
    public function borrarPersonaPorDNI (string $dni):PersonasDAO;
    public function obtenerPersona (string $dni):Persona;
    public function obtenerTodasLasPersonas():array;
    public function obtenerPersonasConLimite(int $resultadoInicial, int $resultadoFinal):array;
    public function modificarPersona(Persona $persona):PersonasDAO;
}