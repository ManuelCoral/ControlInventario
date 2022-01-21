<?php

namespace App\Service\classInterface;

use App\Model\motocicleta;

interface vehiculoInterface
{
    public function getVehiculosBD($tipoVehiculo): array;
    public function setVehiculosBD($objVehiculo);
}