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
                $return = [
                    'code' => 0,
                    'msg' => 'Acesso liberado'
                ];
            } else {
                $return = [
                    'code' => 1,
                    'msg' => 'Dados inválidos'
                ];
            }
        } else {
            $return = [
                'code' => 2,
                'msg' => 'Dados não enviados'
            ];
        }

        echo json_encode($return);
    }

    public function logout()
    {
        unset($_SESSION['logado']);
        $this->redirect('/login');
    }
}
