<?php

namespace src\controllers;

use \core\Controller;
use \src\models\Posicao;
use \src\models\Usuario;
use \src\handlers\ValidadorHandler;

class CadastroController extends Controller
{   
    public $usuario;

    public function index()
    {
        $this->loadView('cadastro/cadastro');
        $this->usuario = new Usuario();
    }

    public function getPosicoes()
    {
        $posicoes = new Posicao();
        $posicoes = $posicoes->getPosicoes();

        echo json_encode($posicoes);
    }

    public function cadastrar()
    {
        $validarImagem = false;

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

            if(isset($_FILES['foto'])) {
                $validarImagem = $this->validarImagem($_FILES['foto']);

                if(!$validarImagem) {
                    $errorImg = [
                        'code' => 2,
                        'msg' => 'Erro no upload da imagem',
                        'tipos_permitidos' => 'jpg/jpeg/png',
                        'tamanho_permitido' => 'até 2MB',
                    ];

                    echo json_encode($errorImg);
                    return false;
                }
            }

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
                $inserUser = new Usuario();
                $retorno = $inserUser->insertUser($dados);
            }

            if($retorno['code'] == 0 && $validarImagem) {
                $foto = $this->salvarImagem($_FILES['foto'], $retorno['id'], 'perfil');
                $foto = '/'.$foto;

                $updateFoto = new Usuario();
                $updateFoto->updatePhotoUser($foto, $retorno['id']);
            }

            echo json_encode($retorno);
        } else {
            return false;
        }
    }
}
