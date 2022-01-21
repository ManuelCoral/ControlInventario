<?php

namespace App\Repository;

use App\libs\MyDB;

class userRepository
{
    public static function login($objUser)
    {
        $db = new MyDB();
        $sql = "
                SELECT USUARIO, CLAVE FROM usuarios WHERE USUARIO = '" . $objUser->userName . "' AND CLAVE = '" . $objUser->password . "'
            ";

        $ret = $db->execQuery($db, $sql);

        return count($ret);
    }
}