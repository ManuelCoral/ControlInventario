<?php

namespace App\Service;

use App\Entity\automovil;
use App\Repository\vehiculosRepository;
use App\Service\classInterface\vehiculoInterface;

class automovilServices implements vehiculoInterface
{
    public function getVehiculosBD($tipoVehiculo): array
    {
        $auto = new automovil();
        $datosBD = new vehiculosRepository($tipoVehiculo);

        $result = $datosBD->getVehiculosBy_Tipo($tipoVehiculo);

        return $result;
    }

    public function setVehiculosBD($objVehiculo)
    {
        $datos = new vehiculosRepository();

        $result = $datos->saveAutomovil($objVehiculo);

        return $result;
    }

    public function editVehiculosBD($objVehiculo)
    {
        $datos = new vehiculosRepository();

        $result = $datos->editAutomovil($objVehiculo);

        return $result;
    }

    public function deleteVehiculosBD($id)
    {
        $datos = new vehiculosRepository();

        $result = $datos->eliminaVehiculo($id);

        return $result;
    }
}