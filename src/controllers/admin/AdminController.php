<?php

namespace src\controllers\admin;

use \core\Controller;
use \src\models\Partida;
use \src\models\Usuario; 

class AdminController extends Controller
{
    public $partidas;
    public $jogadores;

    public function __construct()
    {
        $this->detectarLogin();
        $this->partidas = new Partida();
        $this->partidas = $this->partidas->getJogos();

        $this->jogadores = new Usuario();
        $this->jogadores = $this->jogadores->getJogadores();
    }

    public function index()
    {
        $this->loadView('admin/header');
        $this->loadView('admin/admin');
        $this->loadView('admin/footer');
    }

    public function getData()
    {
        $dados = [
            'qtdJogos' => $this->getQtdJogos(),
            'vitorias' => $this->getVitorias(),
            'empates' => $this->getEmpates(),
            'derrotas' => $this->getDerrotas(),
            'artilharia' => $this->getArtilharia(),
            'assistencia' => $this->getAssistencias(),
            'proximas_partidas' => $this->getProxPartidas(),
            'partidas_anteriores' => $this->getPartidasAnteriores(),
        ];

        print_r($dados);exit;

        echo json_encode($dados);
    }

    private function getQtdJogos()
    {
        $qtdJogos = count($this->partidas);

        return $qtdJogos;
    }

    private function getVitorias()
    {
        $vitorias = 0;

        foreach ($this->partidas as $value) {
            if ($value['gols_pro'] > $value['gols_contra']) {
                $vitorias++;
            }
        }

        return $vitorias;
    }

    private function getEmpates()
    {
        $empates = 0;

        foreach ($this->partidas as $value) {
            if ($value['gols_pro'] == $value['gols_contra']) {
                $empates++;
            }
        }

        return $empates;
    }

    private function getDerrotas()
    {
        $derrotas = 0;

        foreach ($this->partidas as $value) {
            if ($value['gols_pro'] < $value['gols_contra']) {
                $derrotas++;
            }
        }

        return $derrotas;
    }

    private function getArtilharia()
    {
        $artilharia = [];

        foreach ($this->jogadores as $key => $value) {
            $artilharia[$key] = [
                'apelido' => $value['apelido'],
                'gols' => $value['gols'] ? $value['gols'] : 0,
                'jogos' => $value['jogos'] ? $value['jogos'] : 0,
            ];
        }

        return $artilharia;
    }

    private function getAssistencias()
    {
        $assistencias = [];

        foreach ($this->jogadores as $key => $value) {
            $assistencias[$key] = [
                'apelido' => $value['apelido'],
                'assistencias' => $value['assistencias'] ? $value['assistencias'] : 0,
                'jogos' => $value['jogos'] ? $value['jogos'] : 0,
            ];
        }

        return $assistencias;
    }

    private function getProxPartidas()
    {
        $proxPartidas = [];

        foreach ($this->partidas as $key => $value) {
            if($value['data_hora_partida'] > date('Y-m-d H:i:s') && $key <= 1) {
                $proxPartidas[$key] = [
                    'liga' => $value['liga'],
                    'data' => date('d/m/Y', strtotime($value['data_hora_partida'])),
                    'local' => $value['local'],
                    'horario' => date('H:i', strtotime($value['data_hora_partida'])),
                    'nqv' => '/assets/img/noisquevoa.png',
                    'adversario' => $value['logo_adversario'],
                ];
            }
        }

        return $proxPartidas;
    }

    private function getPartidasAnteriores()
    {
        $partidasAnteriores = [];

        foreach ($this->partidas as $key => $value) {
            if($value['data_hora_partida'] < date('Y-m-d H:i:s') && $key <= 2) {
                $partidasAnteriores[$key] = [
                    'liga' => $value['liga'],
                    'data' => date('d/m/Y', strtotime($value['data_hora_partida'])),
                    'local' => $value['local'],
                    'horario' => date('H:i', strtotime($value['data_hora_partida'])),
                    'nqv' => '/assets/img/noisquevoa.png',
                    'gols_pro' => $value['gols_pro'],
                    'gols_contra' => $value['gols_contra'],
                    'adversario' => $value['logo_adversario'],
                ];
            }
        }

        return $partidasAnteriores;
    }
}
