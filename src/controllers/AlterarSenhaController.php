<?php

namespace src\controllers;

use \core\Controller;
use \src\models\Usuario;
use \src\handlers\ValidadorHandler;

class AlterarSenhaController extends Controller
{
    public $usuario;

    public function __construct()
    {
        $this->usuario = new Usuario();
    }

    public function index()
    {
        if (isset($_GET['email']) && isset($_GET['token'])) {
            $email = $_GET['email'];
            $token = $_GET['token'];

            $this->usuarios = new Usuario();
            $verificar = $this->usuarios->verifyByEmailAndToken($email, $token);

            $dados = $_GET;

            if ($verificar) {
                $this->loadView('login/alterarSenha');
            } else {
                echo "Dados inválidos";
            }
        } else {
            return false;
        }
    }

    public function alteracaoSenha()
    {
        $dados = [];
        $retorno = [];
        if($_POST['novaSenha'] && $_POST['confirmaNovaSenha']) {
            $dados = [
                'email' => $this->retirarAcentos(filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL)),
                'senha' => password_hash(filter_input(INPUT_POST, 'novaSenha'), PASSWORD_DEFAULT),
                'confirma' => filter_input(INPUT_POST, 'confirmaNovaSenha'),
            ];

            if(ValidadorHandler::validarSenha($dados['senha'], $dados['confirma']) == false) {
                $retorno = [
                    'code' => 1,
                    'msg' => 'Senhas não conferem',
                ];

                echo json_encode($retorno);
                return false;
            }
            
            unset($dados['confirma']);
            $this->usuario->updatePassword($dados);

            $retorno = [
                'code' => 0,
                'msg' => 'Senha alterada com sucesso'
            ];

            echo json_encode($retorno);

        } else {
            $retorno = [
                'code' => 2,
                'msg' => 'Dados não enviados',
            ];

            echo json_encode($retorno);
            return false;
        }

        return true;
    }
}
