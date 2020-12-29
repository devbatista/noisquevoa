<?php

namespace src\controllers;

use \core\Controller;
use \src\handlers\LoginHandler;

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

                if ($login['aprovado'] == 0) {
                    $return = [
                        'code' => 3,
                        'msg' => 'Aguarde a aprovação do cadastro'
                    ];
                } else if($login['ativo'] == 0){
                    $return = [
                        'code' => 4,
                        'msg' => 'Usuário inativo, entre em contato com a diretoria'
                    ];
                } else {
                    $_SESSION['logado'] = $login;

                    if($_SESSION['logado']['presidencia'] == 1) {
                        $_SESSION['logado']['cargo'] = 'Presidência';
                    } else if($_SESSION['logado']['diretoria'] == 1) {
                        $_SESSION['logado']['cargo'] = 'Diretoria';
                    } else if($_SESSION['logado']['comissao_tecnica'] == 1) {
                        $_SESSION['logado']['cargo'] = 'Comissão Técnica';
                    } else if($_SESSION['logado']['jogador'] == 1) {
                        $_SESSION['logado']['cargo'] = 'Jogador';
                    } 
                    
                    $return = [
                        'code' => 0,
                        'msg' => 'Acesso liberado'
                    ];
                }
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
