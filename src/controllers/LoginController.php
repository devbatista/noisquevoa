<?php

namespace src\controllers;

use \core\Controller;
use \src\Handlers;
use \src\models\Usuario;

class LoginController extends Controller
{
    public $usuario;

    public function index()
    {
        $this->loadView('login/login');
    }

    public function autentica()
    {
        $this->usuario = new Usuario();

        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $senha = ($_POST['senha'] != '') ? filter_input(INPUT_POST, 'senha') : false;

        if ($email && $senha) {
            $dados = [
                'email' => $email,
                'senha' => $senha
            ];
            $login = $this->usuario->login($dados);
            
            if($login) {
                echo '<pre>';
                print_r($login);
                echo '</pre>';
                if (password_verify($dados['senha'], $login['senha'])) {
                    echo 'Dados corretos';
                } else {
                    echo "Dados inválidos";
                }
            } else {
                echo "não trouxe nada";
            }
        } else {
            echo "Dados não enviados";
        }
    }
}
