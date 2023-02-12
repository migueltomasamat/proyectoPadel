<?php

namespace App\Servicios;

use App\Personas\Persona;

class ReservaMaquinaGimnasio
{
    private \DateTime $fecha;
    private int $numHoras;
    private Persona $cliente;
    private float $costeHora;

    public function __construct()
    {

    }

    /**
     * @return \DateTime
     */
    public function getFecha(): \DateTime
    {
        return $this->fecha;
    }

    /**
     * @param \DateTime $fecha
     */
    public function setFecha(\DateTime $fecha): void
    {
        $this->fecha = $fecha;
    }

    /**
     * @return int
     */
    public function getNumHoras(): int
    {
        return $this->numHoras;
    }

    /**
     * @param int $numHoras
     */
    public function setNumHoras(int $numHoras): void
    {
        $this->numHoras = $numHoras;
    }

    /**
     * @return Persona
     */
    public function getCliente(): Persona
    {
        return $this->cliente;
    }

    /**
     * @param Persona $cliente
     */
    public function setCliente(Persona $cliente): void
    {
        $this->cliente = $cliente;
    }

    /**
     * @return float
     */
    public function getCosteHora(): float
    {
        return $this->costeHora;
    }

    /**
     * @param float $costeHora
     */
    public function setCosteHora(float $costeHora): void
    {
        $this->costeHora = $costeHora;
    }



}