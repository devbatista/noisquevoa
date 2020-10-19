<?php

namespace src\controllers;

use \core\Controller;
use \src\Handlers\LoginHandler;

class LoginController extends Controller
{
    public $usuario;

    public function index()
    {
        if (!isset($_SESSION['logado'])) {
            $this->loadView('login/login');
        } else {
            $this->redirect('/admin');
        }
    }

    public function autentica()
    {
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $senha = ($_POST['senha'] != '') ? filter_input(INPUT_POST, 'senha') : false;

        if ($email && $senha) {
            $dados = [
                'email' => $email,
                'senha' => $senha
            ];
            $login = LoginHandler::verifyLogin($dados);

            if ($login) {
                $_SESSION['logado'] = $login;
                $this->redirect('/admin');
            } else {
                echo "Dados inválidos";
            }
        } else {
            echo "Dados não enviados";
        }
    }

    public function logout()
    {
        unset($_SESSION['logado']);
        $this->redirect('/login');
    }
}
