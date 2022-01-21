<?php

namespace App\libs;

use SQLite3;

class MyDB extends SQLite3
{
    function __construct()
    {
        $this->open('database.sqlite');
    }

    public function execQuery($connection, $query)
    {
        $rs = [];
        $ret = $connection->query($query);

        while ($row = $ret->fetchArray(SQLITE3_ASSOC)) {
            $rs[] = $row;
        }

        return $rs;
    }

    public function execQuery_insert($connection, $query): bool
    {

        $sentencia = $connection->prepare($query);

        $resultado = $sentencia->execute();

        if ($resultado === true) {
            return true;
        } else {
            return false;
        }
    }
}