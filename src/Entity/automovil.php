<?php

namespace App\Entity;

use App\Entity\classPadre\vehiculoAbstract;

class automovil extends vehiculoAbstract
{
    public $ruedas = 4;
    public $numPuertas;

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

    public function setPuertas($numPuertas)
    {
        $this->potnumPuertasencia = $numPuertas;
    }

    public function getPuertas()
    {
        return $this->numPuertas;
    }

    public function setTipoVehiculo()
    {

        $this->tipoVehiculo = 'AUTOMOVIL';
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