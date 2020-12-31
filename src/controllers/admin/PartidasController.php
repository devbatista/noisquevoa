<?php

namespace src\controllers\admin;

use \core\Controller;
use \src\models\Partida;
use \src\models\Local;
use \src\models\Liga;

class PartidasController extends Controller
{
    public $partidas;
    public $local;

    public function __construct()
    {
        $this->detectarLogin();
        $this->partida = new Partida();
        $this->local = new Local();
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
}
