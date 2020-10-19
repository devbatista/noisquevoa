<?php

namespace src\handlers;

use \src\models\Usuario;

class LoginHandler
{
    public static function checkLogin()
    {
        $user = new Usuario();
        if (!empty($_SESSION['token'])) {
            $token = $_SESSION['token'];
            $user = $user->getByToken($token);
            if (count($user) > 0) {
            }
        }

        return false;
    }
}
