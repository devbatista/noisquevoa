<?php

namespace src\controllers\admin;

use \core\Controller;
use \src\models\Usuario;
use \src\handlers\ValidadorHandler;

class DiretoriaController extends Controller
{
    public $diretoria;

    public function __construct()
    {
        $this->detectarLogin();
        $this->diretoria = new Usuario();
    }

    public function index()
    {
        $this->loadView('admin/header');
        $this->loadView('admin/diretoria');
        $this->loadView('admin/footer');
    }

    public function getDiretoria()
    {
        $dados = [];

        $elenco = $this->diretoria->getAllDiretoria();

        foreach ($elenco as $key => $value) {
            $dados[$key] = [
                'id' => $value['id_usuario'],
                'nome' => $value['nome'],
                'apelido' => $value['apelido'],
                'email' => $value['email'],
                'celular' => ($value['celular']) ? $value['celular'] : '',
                'foto' => $value['foto'],
                'dt_nascimento' => date('d/m/Y', strtotime($value['dt_nascimento'])),
            ];
        }

        echo json_encode($dados);
    }

    public function getDiretoriaById($id)
    {
        $dados = [];

        $elenco = $this->diretoria->getDiretoriaById($id['id']);

        foreach ($elenco as $key => $value) {
            $dados[$key] = [
                'id' => $value['id_usuario'],
                'nome' => $value['nome'],
                'apelido' => $value['apelido'],
                'email' => $value['email'],
                'cpf' => $value['cpf'],
                'celular' => $value['celular'],
                'dt_nascimento' => $value['dt_nascimento'],
            ];
        }

        echo json_encode($dados);
    }

    public function getAprovarCadastros()
    {
        $dados = [];

        $aprovarCadastro = $this->diretoria->getDiretoriaAprovar();

        foreach ($aprovarCadastro as $key => $value) {
            $dados[$key] = [
                'id' => $value['id_usuario'],
                'nome' => $value['nome'],
                'foto' => $value['foto'],
                'apelido' => $value['apelido'],
                'celular' => ($value['celular']) ? $value['celular'] : '',
                'email' => ($value['email']) ? $value['email'] : '',
            ];
        }

        echo json_encode($dados);
    }

    public function aprovarCadastro($id)
    {
        $this->diretoria->approveRegistration($id['id']);
    }

    public function inserirUsuario()
    {
        if ($_POST) {
            $retorno = '';

            $dados = [
                'nome' => $this->retirarAcentos(filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING)),
                'apelido' => $this->retirarAcentos(filter_input(INPUT_POST, 'apelido')),
                'email' => $this->retirarAcentos(filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL)),
                'senha' => password_hash('NoisQueVoa@2021', PASSWORD_DEFAULT),
                'cpf' => filter_input(INPUT_POST, 'cpf'),
            ];

            $validador = [
                'nome' => ValidadorHandler::validarNome($dados['nome']),
                'apelido' => ValidadorHandler::validarApelido($dados['apelido']),
                'email' => ValidadorHandler::validarEmail($dados['email']),
                'cpf' => ValidadorHandler::validarCPF($dados['cpf']),
            ];

            $falseKey = [];

            foreach ($validador as $key => $value) {
                if ($value == null) {
                    array_push($falseKey, $key);
                }
            }

            if (empty($falseKey)) {
                $usuario = new Usuario();
                $retorno = $usuario->insertDiretoriaByPresidente($dados);
            }

            echo json_encode($retorno);
        } else {
            return false;
        }
    }

    public function alterarUsuario($id)
    {
        if ($_POST) {
            $retorno = '';

            $dados = [
                'id' => $id['id'],
                'nome' => filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING),
                'apelido' => filter_input(INPUT_POST, 'apelido'),
                'celular' => filter_input(INPUT_POST, 'whatsapp'), 
            ];

            $validador = [
                'nome' => ValidadorHandler::validarNome($dados['nome']),
                'apelido' => ValidadorHandler::validarApelido($dados['apelido']),
            ];

            if ($dados['celular'] != '') {
                $validador['celular'] = ValidadorHandler::validarCelular($dados['celular']);
            }

            $falseKey = [];

            foreach ($validador as $key => $value) {
                if ($value == null) {
                    array_push($falseKey, $key);
                }
            }

            if (empty($falseKey)) {
                $retorno = $this->diretoria->alterDiretoria($dados);

                echo json_encode($retorno);
            } else {
                return false;
            }
        }
    }

    public function desativarUsuario($id)
    {
        $this->diretoria->disableUser($id['id']);
    }
}
