<?php

namespace src\controllers;

use \core\Controller;
use \src\models\Posicao;
use \src\models\Usuario;
use \src\handlers\ValidadorHandler;

class CadastroController extends Controller
{

    public function index()
    {
        $this->loadView('cadastro/cadastro');
    }

    public function getPosicoes()
    {
        $posicoes = new Posicao();
        $posicoes = $posicoes->getPosicoes();

        echo json_encode($posicoes);
    }

    public function cadastrar()
    {
        if ($_POST) {
            $retorno = '';
            $jogador = filter_input(INPUT_POST, 'jogador', FILTER_VALIDATE_INT);
            $diretoria = filter_input(INPUT_POST, 'diretoria', FILTER_VALIDATE_INT);
            $comissao = filter_input(INPUT_POST, 'comissao_tecnica', FILTER_VALIDATE_INT);
            $posicao = filter_input(INPUT_POST, 'posicao', FILTER_VALIDATE_INT);

            $dados = [
                'nome' => filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING),
                'apelido' => filter_input(INPUT_POST, 'apelido'),
                'email' => $this->retirarAcentos(filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL)),
                'senha' => password_hash(filter_input(INPUT_POST, 'senha'), PASSWORD_DEFAULT),
                'confirma' => filter_input(INPUT_POST, 'confirmarSenha'),
                'cpf' => filter_input(INPUT_POST, 'cpf'),
                'celular' => filter_input(INPUT_POST, 'whatsapp'),
                'jogador' => ($jogador) ? $jogador : 0,
                'diretoria' => ($diretoria) ? $diretoria : 0,
                'comissao_tecnica' => ($comissao) ? $comissao : 0,
                'dt_nascimento' => date("Y-m-d", strtotime(filter_input(INPUT_POST, 'nascimento'))),
                'posicao' => ($posicao) ? $posicao : null
            ];

            $validador = [
                'nome' => ValidadorHandler::validarNome($dados['nome']),
                'apelido' => ValidadorHandler::validarApelido($dados['apelido']),
                'email' => ValidadorHandler::validarEmail($dados['email']),
                'senha' => ValidadorHandler::validarSenha($dados['senha'], $dados['confirma']),
                'cpf' => ValidadorHandler::validarCPF($dados['cpf']),
                'celular' => ValidadorHandler::validarCelular($dados['celular']),
                'tipo_usuario' => ValidadorHandler::validarTipo($dados['jogador'], $dados['diretoria'], $dados['posicao'], $dados['comissao_tecnica']),
                'dt_nascimento' => ValidadorHandler::validarNascimento($dados['dt_nascimento'])
            ];

            $falseKey = [];

            foreach ($validador as $key => $value) {
                if ($value == null) {
                    array_push($falseKey, $key);
                }
            }

            unset($dados['confirma']);

            if (empty($falseKey)) {
                $usuario = new Usuario();
                $retorno = $usuario->insertUser($dados);
            }

            echo json_encode($retorno);
        } else {
            return false;
        }
    }
}
