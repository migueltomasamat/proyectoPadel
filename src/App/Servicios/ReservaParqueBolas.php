<?php

namespace App\Servicios;

class ReservaParqueBolas
{
    private \DateTime $fecha;
    private int $numHoras;
    private array $clientes;
    private float $costeHora;

    /**
     * @param \DateTime $fecha
     * @param int $numHoras
     * @param array $clientes
     * @param float $costeHora
     */
    public function __construct(\DateTime $fecha, int $numHoras, array $clientes, float $costeHora)
    {
        $this->fecha = $fecha;
        $this->numHoras = $numHoras;
        $this->clientes = $clientes;
        $this->costeHora = $costeHora;
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
     * @return ReservaParqueBolas
     */
    public function setFecha(\DateTime $fecha): ReservaParqueBolas
    {
        $this->fecha = $fecha;
        return $this;
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
     * @return ReservaParqueBolas
     */
    public function setNumHoras(int $numHoras): ReservaParqueBolas
    {
        $this->numHoras = $numHoras;
        return $this;
    }

    /**
     * @return array
     */
    public function getClientes(): array
    {
        return $this->clientes;
    }

    /**
     * @param array $clientes
     * @return ReservaParqueBolas
     */
    public function setClientes(array $clientes): ReservaParqueBolas
    {
        $this->clientes = $clientes;
        return $this;
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
     * @return ReservaParqueBolas
     */
    public function setCosteHora(float $costeHora): ReservaParqueBolas
    {
        $this->costeHora = $costeHora;
        return $this;
    }




}