<?php

namespace src\controllers\admin;

use \core\Controller;
use src\controllers\EmailController;
use \src\models\Usuario;
use \src\handlers\ValidadorHandler;

class ElencoController extends Controller
{
    public $jogadores;

    public function __construct()
    {
        $this->detectarLogin();
        $this->jogadores = new Usuario();
    }

    public function index()
    {
        $this->loadView('admin/header');
        $this->loadView('admin/elenco');
        $this->loadView('admin/footer');
    }

    public function getElenco()
    {
        $dados = [];

        $elenco = $this->jogadores->getAllElenco();

        foreach ($elenco as $key => $value) {
            if ($value['mensalista'] == 1) {
                $dados[$key] = [
                    'id' => $value['id_usuario'],
                    'nome' => $value['nome'],
                    'apelido' => $value['apelido'],
                    'posicao' => $value['posicao'],
                    'dt_nascimento' => date('d/m/Y', strtotime($value['dt_nascimento'])),
                    'foto' => $value['foto'],
                ];
            }
        }

        echo json_encode($dados);
    }

    public function getElencoById($id)
    {
        $dados = [];

        $elenco = $this->jogadores->getElencoById($id['id']);

        foreach ($elenco as $key => $value) {
            $dados[$key] = [
                'id' => $value['id_usuario'],
                'nome' => $value['nome'],
                'apelido' => $value['apelido'],
                'email' => $value['email'],
                'cpf' => $value['cpf'],
                'celular' => $value['celular'],
                'diretoria' => $value['diretoria'],
                'comissao_tecnica' => $value['comissao_tecnica'],
                'jogador' => $value['jogador'],
                'dt_nascimento' => $value['dt_nascimento'],
                'jogador' => $value['jogador'],
                'posicao' => $value['posicao'],
            ];
        }

        echo json_encode($dados);
    }

    public function getAprovarCadastros()
    {
        $dados = [];

        $aprovarCadastro = $this->jogadores->getUsuariosAprovar();

        foreach ($aprovarCadastro as $key => $value) {
            $dados[$key] = [
                'id' => $value['id_usuario'],
                'foto' => $value['foto'],
                'apelido' => $value['apelido'],
                'celular' => ($value['celular']) ? $value['celular'] : '',
                'email' => $value['email'],
                'posicao' => $value['posicao'],
            ];
        }

        echo json_encode($dados);
    }

    public function aprovarCadastro($id)
    {
        $this->jogadores->approveRegistration($id['id']);
        $dadosEmail = $this->jogadores->getUserById($id['id']);
        $enviarEmail = new EmailController();

        $dados = [
            'id' => $dadosEmail['id_usuario'],
            'nome' => $dadosEmail['nome'],
            'apelido' => $dadosEmail['apelido'],
            'email' => $dadosEmail['email'],
        ];

        $enviarEmail = new EmailController();

        $enviarEmail->enviarConfirmacaoAprovado($dados);
    }

    public function inserirUsuario()
    {
        if ($_POST) {
            $retorno = '';
            $jogador = filter_input(INPUT_POST, 'jogador', FILTER_VALIDATE_INT);
            $diretoria = filter_input(INPUT_POST, 'diretoria', FILTER_VALIDATE_INT);
            $comissao = filter_input(INPUT_POST, 'comissao_tecnica', FILTER_VALIDATE_INT);
            $posicao = filter_input(INPUT_POST, 'posicao', FILTER_VALIDATE_INT);

            $dados = [
                'nome' => $this->retirarAcentos(filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING)),
                'apelido' => $this->retirarAcentos(filter_input(INPUT_POST, 'apelido')),
                'email' => $this->retirarAcentos(filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL)),
                'senha' => password_hash('NoisQueVoa@2021', PASSWORD_DEFAULT),
                'cpf' => filter_input(INPUT_POST, 'cpf'),
                'jogador' => ($jogador) ? $jogador : 0,
                'diretoria' => ($diretoria) ? $diretoria : 0,
                'comissao_tecnica' => ($comissao) ? $comissao : 0,
                'posicao' => ($posicao) ? $posicao : null
            ];

            $validador = [
                'nome' => ValidadorHandler::validarNome($dados['nome']),
                'apelido' => ValidadorHandler::validarApelido($dados['apelido']),
                'email' => ValidadorHandler::validarEmail($dados['email']),
                'cpf' => ValidadorHandler::validarCPF($dados['cpf']),
                'tipo_usuario' => ValidadorHandler::validarTipo($dados['jogador'], $dados['diretoria'], $dados['posicao'], $dados['comissao_tecnica']),
            ];

            $falseKey = [];

            foreach ($validador as $key => $value) {
                if ($value == null) {
                    array_push($falseKey, $key);
                }
            }

            if (empty($falseKey)) {
                $usuario = new Usuario();
                $retorno = $usuario->insertUserByDiretoria($dados);
            }

            echo json_encode($retorno);
        } else {
            return false;
        }
    }

    public function inserirAvulso()
    {
        $retorno = [];

        if ($_POST) {
            $dados = [
                'nome' => $this->retirarAcentos(filter_input(INPUT_POST, 'nome_avulso', FILTER_SANITIZE_STRING)),
                'apelido' => $this->retirarAcentos(filter_input(INPUT_POST, 'apelido_avulso')),
                'posicao' => filter_input(INPUT_POST, 'posicao_avulso', FILTER_VALIDATE_INT),
            ];

            if (in_array('', $dados)) {
                $retorno = [
                    'code' => 2,
                    'msg' => 'Preencha todos os dados',
                ];

                echo json_encode($retorno);
                return false;
            }

            $validador = $this->jogadores->verifyAvulsoExists($dados);
            if ($validador) {
                $retorno = [
                    'code' => 1,
                    'msg' => 'Nome ou apelido já cadastrado no sistema',
                ];

                echo json_encode($retorno);
                return false;
            }

            $id = $this->jogadores->insertAvulso($dados);

            if ($id != 0) {
                $retorno = [
                    'code' => 0,
                    'msg' => 'Jogador cadastrado com sucesso',
                ];
            } else {
                $retorno = [
                    'code' => 3,
                    'msg' => 'Erro ao cadastrar, tente novamente',
                ];
            }

            echo json_encode($retorno);
            return true;
        } else {
            $retorno = [
                'code' => 4,
                'msg' => 'Erro fatal, atualize a tela e tente novamente',
            ];

            echo json_encode($retorno);
            return false;
        }
    }

    public function alterarUsuario($id)
    {
        if ($_POST) {
            $retorno = '';
            $jogador = filter_input(INPUT_POST, 'jogador', FILTER_VALIDATE_INT);
            $diretoria = filter_input(INPUT_POST, 'diretoria', FILTER_VALIDATE_INT);
            $comissao = filter_input(INPUT_POST, 'comissao_tecnica', FILTER_VALIDATE_INT);
            $posicao = filter_input(INPUT_POST, 'posicao', FILTER_VALIDATE_INT);

            $dados = [
                'id' => $id['id'],
                'nome' => filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING),
                'apelido' => filter_input(INPUT_POST, 'apelido'),
                'celular' => filter_input(INPUT_POST, 'whatsapp'),
                'jogador' => ($jogador) ? $jogador : 0,
                'diretoria' => ($diretoria) ? $diretoria : 0,
                'comissao_tecnica' => ($comissao) ? $comissao : 0,
                'posicao' => ($posicao) ? $posicao : null
            ];

            $validador = [
                'nome' => ValidadorHandler::validarNome($dados['nome']),
                'apelido' => ValidadorHandler::validarApelido($dados['apelido']),
                'tipo_usuario' => ValidadorHandler::validarTipo($dados['jogador'], $dados['diretoria'], $dados['posicao'], $dados['comissao_tecnica']),
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
                $usuario = new Usuario();
                $retorno = $usuario->alterUser($dados);

                echo json_encode($retorno);
            } else {
                return false;
            }
        }
    }

    public function desativarUsuario($id)
    {
        $this->jogadores->disableUser($id['id']);
    }
}
