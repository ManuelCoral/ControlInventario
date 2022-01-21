<?php

namespace App\Entity;

use App\Entity\classPadre\vehiculoAbstract;

class motocicleta extends vehiculoAbstract
{
    public $ruedas = 2;

    public function getRuedas()
    {
        return $this->ruedas;
    }

    public function setPotencia($potencia)
    {
        $this->potencia = $potencia;
    }

    public function getPotencia()
    {
        return $this->potencia;
    }

    public function setTipoVehiculo()
    {
        $this->tipoVehiculo = 'MOTOCICLETA';
    }

    public function getTipoVehiculo()
    {
        return $this->tipoVehiculo;
    }

    public function setMatricula($matricula)
    {
        $this->matricula = $matricula;
    }

    public function getMatricula()
    {
        return $this->matricula;
    }
}