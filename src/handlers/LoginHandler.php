<?php

namespace src\handlers;

use \src\models\Usuario;

class LoginHandler
{
    public static function checkLogin()
    {
        $user = new Usuario();
        if (!empty($_SESSION['logado'])) {
            $token = $_SESSION['logado']['token'];
            $user = $user->getByToken($token);
            $count = (is_array($user) ? $user : 0);
            if ($count != 0) {
                return true;
            }
        }
        return false;
    }

    public static function verifyLogin($data)
    {
        $user = new Usuario();
        $login = $user->login($data);
        if ($login) {
            if (password_verify($data['senha'], $login['senha'])) {
                $token = md5(time().rand(0,9999));
                $user->updateToken($token, $data['email']);
                $login = $user->login($data);
                return $login;
            }
        }
        return false;
    }
}
