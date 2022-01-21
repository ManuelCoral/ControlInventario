<?php

namespace App\Entity\classPadre;

abstract class vehiculoAbstract
{
    public $id;
    public $ruedas;
    public $tipoVehiculo;
    public $potencia;
    public $matricula;

    public function setRuedas($ruedas)
    {
        $this->ruedas = $ruedas;
    }
    abstract public function getRuedas();
    abstract public function setPotencia($potencia);
    abstract public function getPotencia();
    abstract public function setTipoVehiculo();
    abstract public function getTipoVehiculo();
    abstract public function setMatricula($matricula);
    abstract public function getMatricula();
}