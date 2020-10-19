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
        $dados = [
            'nome' => strtoupper(filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING)),
            'apelido' => strtoupper(filter_input(INPUT_POST, 'apelido')),
            'email' => $this->retirarAcentos(filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL)),
            'senha' => filter_input(INPUT_POST, 'senha'),
            'confirma' => filter_input(INPUT_POST, 'confirmarSenha'),
            'cpf' => filter_input(INPUT_POST, 'cpf'),
            'celular' => filter_input(INPUT_POST, 'whatsapp'),
            'jogador' => filter_input(INPUT_POST, 'jogador', FILTER_VALIDATE_INT),
            'diretoria' => filter_input(INPUT_POST, 'diretoria', FILTER_VALIDATE_INT),
            'dt_nascimento' => date("Y-m-d", strtotime(filter_input(INPUT_POST, 'nascimento'))),
            'posicao' => filter_input(INPUT_POST, 'posicao', FILTER_VALIDATE_INT)
        ];

        $validador = [
            'nome' => ValidadorHandler::validarNome($dados['nome']),
            'apelido' => ValidadorHandler::validarApelido($dados['apelido']),
            'email' => ValidadorHandler::validarEmail($dados['email']),
            'senha' => ValidadorHandler::validarSenha($dados['senha'], $dados['confirma']),
            'cpf' => ValidadorHandler::validarCPF($dados['cpf']),
            'celular' => ValidadorHandler::validarCelular($dados['celular']),
            'tipo_usuario' => ValidadorHandler::validarTipo($dados['jogador'], $dados['diretoria'], $dados['posicao']),
            'dt_nascimento' => ValidadorHandler::validarNascimento($dados['dt_nascimento'])
        ];

        $falseKey = [];

        foreach ($validador as $key => $value) {
            if($value == null) {
                array_push($falseKey, $key);
            }
        }

        if(empty($falseKey)) {
            $usuario = new Usuario();
            $usuario = $usuario->insertUser($dados);
        }
    }

    private function retirarAcentos($email)
    {
        $comAcentos = array('à', 'á', 'â', 'ã', 'ä', 'å', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ù', 'ü', 'ú', 'ÿ', 'À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'O', 'Ù', 'Ü', 'Ú');

        $semAcentos = array('a', 'a', 'a', 'a', 'a', 'a', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'n', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'y', 'A', 'A', 'A', 'A', 'A', 'A', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'N', 'O', 'O', 'O', 'O', 'O', '0', 'U', 'U', 'U');

        return str_replace($comAcentos, $semAcentos, $email);
    }
}
