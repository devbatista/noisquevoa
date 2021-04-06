<?php

namespace src\controllers\admin;

use \core\Controller;
use src\models\Assistencia;
use \src\models\Partida;
use \src\models\Gol;
use \src\models\Falta;
use \src\models\Cartao;
use \src\models\Usuario;

class EstatisticasController extends Controller
{
    public $partidas;

    public function __construct()
    {
        $this->detectarLogin();
        $this->partidas = new Partida();
    }

    public function index()
    {
        $this->loadView('admin/header');
        $this->loadView('admin/estatisticas');
        $this->loadView('admin/footer');
    }

    public function getData()
    {
        $this->partidas = $this->partidas->getJogos('concluidos');

        $dados = [
            'jogadores' => $this->getJogadores(),
            'partidas' => $this->getPartidas(),
            'gols' => $this->getGols(),
            'assistencia' => $this->getAssistencias(),
            'faltas' => $this->getFaltas(),
            'cartoes_amarelos' => $this->getCartoes('amarelos'),
            'cartoes_vermelhos' => $this->getCartoes('vermelhos'),
        ];

        echo json_encode($dados);
    }

    private function getJogadores()
    {
        $ativo = false;
        $usuario = new Usuario();
        $usuario = $usuario->getJogadores($ativo);

        $usuarios = [];

        foreach ($usuario as $key => $value) {
            $usuarios[$key] = [
                'id_usuario' => $value['id_usuario'],
                'nome' => $value['nome'],
                'apelido' => $value['apelido'],
                'dt_hr_criado' => date('m/d/Y H:i:s', strtotime($value['dt_hr_criado'])),
                'dt_hr_desativado' => ($value['dt_hr_desativado']) ? date('m/d/Y H:i:s', strtotime($value['dt_hr_desativado'])) : null,
            ];
        }

        return $usuarios;
    }

    private function getPartidas()
    {
        foreach ($this->partidas as $key => $value) {
            $this->partidas[$key]['dt_hora'] = date('m/d/Y H:i:s', strtotime($value['dt_hora']));
            $this->partidas[$key]['quem_jogou'] = explode(', ', $value['quem_jogou']);
        }

        return $this->partidas;
    }

    private function getGols()
    {
        $gols = new Gol();
        return $gols->getGoals();
    }

    private function getAssistencias()
    {
        $assistencia = new Assistencia();
        return $assistencia->getAssistencias();
    }

    private function getFaltas()
    {
        $faltas = new Falta();
        return $faltas->getFaltas();
    }

    private function getCartoes($cor)
    {
        $cartoes = new Cartao();
        return $cartoes->getCartoes($cor);
    }
}
