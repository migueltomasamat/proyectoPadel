<?php

namespace App\Servicios;
use App\Personas\Persona;
use DateTime;

class ParqueBolas
{
    private DateTime $fecha;
    private int $numHoras;
    private ?array $clientes;
    private float $costeHora;

    /**
     * @param DateTime $fecha
     * @param int $numHoras
     * @param array $clientes
     * @param float $costeHora
     */
    public function __construct(DateTime $fecha, int $numHoras, array $clientes, float $costeHora)
    {
        $this->fecha = $fecha;
        $this->numHoras = $numHoras;
        $this->clientes = $clientes;
        $this->costeHora = $costeHora;
    }

    /**
     * @return DateTime
     */
    public function getFecha(): DateTime
    {
        return $this->fecha;
    }

    /**
     * @param DateTime $fecha
     */
    public function setFecha(DateTime $fecha): void
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
     * @return array
     */
    public function getClientes(): array
    {
        return $this->clientes;
    }

    /**
     * @param array $clientes
     */
    public function setClientes(array $clientes): void
    {
        $this->clientes = $clientes;
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

    public function devolverPersonasReserva():array{
        foreach ($this->getClientes() as $clientePorcentaje){
            foreach($clientePorcentaje as $cliente => $porcentaje){
                $clientes[]=$cliente;
            }
        }
        return $clientes;
    }




}