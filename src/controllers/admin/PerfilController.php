<?php

namespace src\controllers\admin;

use \core\Controller;
use \src\models\Usuario;
use \src\handlers\ValidadorHandler;

class PerfilController extends Controller
{
    public $usuario;

    public function __construct()
    {
        // $this->detectarLogin();
        $this->usuario = new Usuario();
    }

    public function index()
    {
        $this->loadView('admin/header');
        $this->loadView('admin/perfil');
        $this->loadView('admin/footer');
    }

    public function getData($id)
    {
        $dados = [];
        $user = $this->usuario->getUserById($id['id']);
        echo json_encode($user);
    }

    public function updateData()
    {
        $dados = $_POST;
        $retorno = [];

        if (!empty($dados['senha']) && !empty($dados['confirmarSenha'])) {
            $senha = password_hash($dados['senha'], PASSWORD_DEFAULT);
            $confere = ValidadorHandler::validarSenha($senha, $dados['confirmarSenha']);

            if ($confere == 0) {
                $retorno = [
                    'code' => 1,
                    'msg' => 'Senhas não conferem',
                ];

                echo json_encode($retorno);
                return false;
            } else {
                $this->usuario->updatePasswordProfile($senha, $dados['id']);
            }
        }

        $user = $this->usuario->getUserById($dados['id']);

        if ($dados['email'] != $user['email']) {
            $email = $this->usuario->updateEmailUser($dados['email'], $dados['id']);

            if ($email[1] == 1062) {
                $retorno = [
                    'code' => 1062,
                    'msg' => 'Conta de email já existe em nosso sistema, dados não atualizados',
                ];

                echo json_encode($retorno);
                return false;
            }
        }

        if ($dados['cpf'] != $user['cpf']) {
            $cpf = $this->usuario->updateCPFUser($dados['cpf'], $dados['id']);

            if ($cpf[1] == 1062) {
                $retorno = [
                    'code' => 1062,
                    'msg' => 'CPF já existe em nosso sistema, dados não atualizados',
                ];

                echo json_encode($retorno);
                return false;
            }
        }

        if ($dados['nome'] != $user['nome']) {
            $this->usuario->updateNomeUser($dados['nome'], $dados['id']);
        }

        if ($dados['apelido'] != $user['apelido']) {
            $this->usuario->updateApelidoUser($dados['apelido'], $dados['id']);
        }

        if ($dados['whatsapp'] != $user['celular']) {
            $this->usuario->updateCelularUser($dados['whatsapp'], $dados['id']);
        }

        if ($dados['nascimento'] != $user['dt_nascimento']) {
            $this->usuario->updateNascimentoUser($dados['nascimento'], $dados['id']);
        }

        $validarImagem = false;

        if (isset($_FILES['foto']) && !empty($_FILES['foto'])) {
            $validarImagem = $this->validarImagem($_FILES['foto']);

            if (!$validarImagem) {
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

        if ($validarImagem) {
            $foto = $this->salvarImagem($_FILES['foto'], $dados['id']);
            $foto = '/' . $foto;

            $updateFoto = new Usuario();
            $updateFoto->updatePhotoUser($foto, $dados['id']);
        }

        $retorno = [
            'code' => 0,
            'msg' => 'Dados atualizados com sucesso',
        ];

        echo json_encode($retorno);
        return true;
    }
}
