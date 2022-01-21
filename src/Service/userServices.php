<?php

namespace App\Service;

use App\Repository\userRepository;

class userServices
{
    public static function login($objUser)
    {
        $userRepositorie = new userRepository();

        return
            $userRepositorie->login($objUser); //count($ret);
    }
}