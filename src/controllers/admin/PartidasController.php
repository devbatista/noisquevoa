<?php

namespace src\controllers\admin;

use \core\Controller;
use \src\models\Partida;
use \src\models\Local;
use \src\models\Liga;
use \src\models\Equipe;

class PartidasController extends Controller
{
    public $partidas;
    public $local;
    public $equipes;

    public function __construct()
    {
        $this->detectarLogin();
        $this->partidas = new Partida();
        $this->local = new Local();
        $this->equipes = new Equipe();
    }

    public function index()
    {
        $this->loadView('admin/header');
        $this->loadView('admin/partidas');
        $this->loadView('admin/footer');
    }

    public function carregarLocais()
    {
        $this->local = new Local();
        $this->local = $this->local->getData();

        echo json_encode($this->local);
    }

    public function carregarLigas()
    {
        $ligas = new Liga();
        $ligas = $ligas->getData();

        echo json_encode($ligas);
    }

    public function carregarEquipes()
    {
        $equipes = $this->equipes->getData();

        echo json_encode($equipes);
        return true;
    }

    public function cadastrarLocal()
    {
        $retorno = [];

        $endereco = $_POST['endereco'] . ', ' . $_POST['numero'] . ' ' . $_POST['complemento'] . ' - ' . $_POST['bairro'];
        $endereco = preg_replace('/\\s\\s+/', ' ', $endereco);

        $dados = [
            'nome' => filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING),
            'cep' => filter_input(INPUT_POST, 'cep', FILTER_SANITIZE_STRING),
            'endereco' => $endereco,
            'cidade' => filter_input(INPUT_POST, 'cidade', FILTER_SANITIZE_STRING),
            'estado' => filter_input(INPUT_POST, 'estado', FILTER_SANITIZE_STRING),
        ];

        $cadastrar = $this->local->insertLocal($dados);

        if ($cadastrar[1] == 1062) {
            $retorno = [
                'code' => 1062,
                'msg' => 'Nome já existente',
            ];

            echo json_encode($retorno);
            return false;
        }

        $retorno = [
            'code' => 0,
            'msg' => 'Dados atualizados com sucesso',
        ];

        echo json_encode($retorno);
        return true;
    }

    public function inserirPartida()
    {

        $dados = [
            'adversario' => filter_input(INPUT_POST, 'adversario', FILTER_SANITIZE_STRING),
            'abreviacao' =>
            strtoupper(filter_input(INPUT_POST, 'abreviacao', FILTER_SANITIZE_STRING)),
            'local' => filter_input(INPUT_POST, 'local', FILTER_VALIDATE_INT),
            'liga' => filter_input(INPUT_POST, 'liga', FILTER_VALIDATE_INT),
            'tipo_mv' => filter_input(INPUT_POST, 'tipo_mv', FILTER_VALIDATE_INT),
            'quadros' => filter_input(INPUT_POST, 'quadros', FILTER_VALIDATE_INT),
            'data_hora_partida' => date("Y-m-d H:i", strtotime(filter_input(INPUT_POST, 'data_hora_partida'))),
        ];

        $adversario = $this->equipes->equipeExiste($dados['adversario'], $dados['abreviacao']);
        if (!$adversario) {
            $equipe = $this->equipes->createTeam($dados['adversario'], $dados['abreviacao']);
            $dados['id_adversario'] = $equipe;
        } else {
            $dados['id_adversario'] = $adversario['id_equipe'];
        }

        if (isset($_FILES['logo'])) {
            $validarImagem = $this->validarImagem($_FILES['logo']);

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
            $logo = $this->salvarImagem($_FILES['logo'], $dados['id_adversario'], 'times');
            $logo = '/' . $logo;

            $updateLogo = new Equipe();
            $updateLogo->updatePhotoTeam($logo, $dados['id_adversario']);
        }
        
        for ($i = 1; $i <= $dados['quadros']; $i++) {
            $this->partidas->createPartida($dados);
            if ($dados['quadros'] == 2) {
                $dados['data_hora_partida'] = date("Y-m-d H:i", strtotime($dados['data_hora_partida'] . "+1 hour"));
            }
        }

        $code = [
            'code' => 0,
            'msg' => 'Success',
        ];

        echo json_encode($code);
        return true;
    }
}
