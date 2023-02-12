<?php

namespace App\Modelo\Servicios;

interface InterfazPistaDAO
{
    public function obtenerPista(int $idPista):?Pista;
    public function borrarPista(Pista $pista):?Pista;
    public function borrarPistaPorId(int $idPista):?Pista;
    public function modificarPista(Pista $pista):?Pista;
    public function insertarPista(Pista $pista):?Pista;
    public function obtenerTodasLasPistas():array;
    public function obtenerPistasDisponibles():array;
    public function obtenerPistasCubiertas():array;

    /*
     *  public function cambiarPrecioLuz(); ¿Dónde estaría esta función?
     */
}