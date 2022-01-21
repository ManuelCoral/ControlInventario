<?php

namespace App\Service;

use App\Entity\motocicleta;
use App\Repository\vehiculosRepository;
use App\Service\classInterface\vehiculoInterface;

class moticicletaServices implements vehiculoInterface
{
    public function getVehiculosBD($tipoVehiculo): array
    {
        $moto = new motocicleta();
        $datosBD = new vehiculosRepository();

        $result = $datosBD->getVehiculosBy_Tipo($tipoVehiculo);

        return $result;
    }

    public function setVehiculosBD($objVehiculo)
    {
        $datos = new vehiculosRepository();

        $result = $datos->saveMotocicleta($objVehiculo);

        return $result;
    }

    public function editVehiculosBD($objVehiculo)
    {
        $datos = new vehiculosRepository();

        $result = $datos->editMotocicleta($objVehiculo);

        return $result;
    }

    public function deleteVehiculosBD($id)
    {
        $datos = new vehiculosRepository();

        $result = $datos->eliminaVehiculo($id);

        return $result;
    }
}