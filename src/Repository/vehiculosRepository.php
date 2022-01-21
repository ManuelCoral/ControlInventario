<?php

namespace App\Repository;

use App\libs\MyDB;

class vehiculosRepository
{
    public static function getVehiculosBy_Tipo($tipoVehiculo)
    {
        $db = new MyDB();
        $where = ($tipoVehiculo != 'TODO' ? " WHERE TIPOVEHICULO = '" . $tipoVehiculo . "' " : '');

        $sql = "
                SELECT * FROM vehiculos ".$where."
            ";

        $ret = $db->execQuery($db, $sql);

        return $ret;
    }

    public static function saveMotocicleta($objMoto)
    {
        $db = new MyDB();
        $sql = "
                INSERT INTO vehiculos (TIPOVEHICULO, POTENCIA, MATRICULA)
                VALUES ('" . $objMoto->tipoVehiculo . "', '" . $objMoto->potencia . "', '" . $objMoto->matricula . "');
            ";

        $ret = $db->execQuery_insert($db, $sql);

        return $ret;
    }

    public static function saveAutomovil($objAutomovil)
    {
        $db = new MyDB();
        $sql = "
                INSERT INTO vehiculos (TIPOVEHICULO, POTENCIA, NUMPUERTAS, MATRICULA)
                VALUES ('" . $objAutomovil->tipoVehiculo . "', '" . $objAutomovil->potencia . "', '" . $objAutomovil->numPuertas . "', '" . $objAutomovil->matricula . "');
            ";

        $ret = $db->execQuery_insert($db, $sql);

        return $ret;
    }

    public static function editMotocicleta($objMoto)
    {
        $db = new MyDB();
        $sql = "UPDATE vehiculos
                SET TIPOVEHICULO = '" . $objMoto->tipoVehiculo . "', POTENCIA = " . $objMoto->potencia . ", MATRICULA = '" . $objMoto->matricula . "'
                WHERE ID = " . $objMoto->id;

        $ret = $db->execQuery_insert($db, $sql);

        return $ret;
    }

    public static function editAutomovil($objAutomovil)
    {
        $db = new MyDB();
        $sql = "UPDATE vehiculos
                SET TIPOVEHICULO = '" . $objAutomovil->tipoVehiculo . "', POTENCIA = " . $objAutomovil->potencia . ", NUMPUERTAS = " . $objAutomovil->numPuertas . ", MATRICULA = '" . $objAutomovil->matricula . "'
                WHERE ID = " . $objAutomovil->id;

        $ret = $db->execQuery_insert($db, $sql);

        return $ret;
    }

    public static function eliminaVehiculo($id)
    {
        $db = new MyDB();
        $sql = "DELETE FROM vehiculos
                WHERE ID = " . $id;

        $ret = $db->execQuery_insert($db, $sql);

        return $ret;
    }
}