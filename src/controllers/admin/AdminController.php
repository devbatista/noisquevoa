<?php

namespace src\controllers\admin;

use \core\Controller;
use \src\models\Partida;
use \src\models\Usuario;

class AdminController extends Controller
{
    public $partidas;

    public function __construct()
    {
        $this->detectarLogin();
        $this->partidas = new Partida();
        $this->partidas = $this->partidas->getJogos();
    }

    public function index()
    {
        $this->loadView('admin/header');
        $this->loadView('admin/admin');
        $this->loadView('admin/footer');
    }

    public function getPermissao($id)
    {
        $jogadores = new Usuario();
        $jogadores = $jogadores->getPermissionById($id['id']);

        echo json_encode($jogadores);
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

        echo json_encode($dados);
    }

    private function getQtdJogos()
    {
        $qtdJogos = count($this->getPartidasAnteriores());

        return $qtdJogos;
    }

    private function getVitorias()
    {
        $vitorias = 0;

        foreach ($this->getPartidasAnteriores() as $value) {
            if ($value['gols_pro'] > $value['gols_contra']) {
                $vitorias++;
            }
        }

        return $vitorias;
    }

    private function getEmpates()
    {
        $empates = 0;

        foreach ($this->getPartidasAnteriores() as $value) {
            if ($value['gols_pro'] == $value['gols_contra']) {
                $empates++;
            }
        }

        return $empates;
    }

    private function getDerrotas()
    {
        $derrotas = 0;

        foreach ($this->getPartidasAnteriores() as $value) {
            if ($value['gols_pro'] < $value['gols_contra']) {
                $derrotas++;
            }
        }

        return $derrotas;
    }

    private function getArtilharia()
    {
        $artilharia = [];
        $jogadores = new Usuario();
        $jogadores = $jogadores->getArtilheiros();

        foreach ($jogadores as $key => $value) {
            $artilharia[$key] = [
                'id' => $value['id_usuario'],
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
        $jogadores = new Usuario();
        $jogadores = $jogadores->getAssistencias();

        foreach ($jogadores as $key => $value) {
            $assistencias[$key] = [
                'id' => $value['id_usuario'],
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
            if (($value['data_hora_partida'] > date('Y-m-d H:i:s')) && (count($proxPartidas) < 2) && ($value['concluido'] == 0)) {
                $proxPartidas[$key] = [
                    'liga' => $value['liga'],
                    'data' => date('d/m/Y', strtotime($value['data_hora_partida'])),
                    'local' => $value['local'],
                    'horario' => date('H:i', strtotime($value['data_hora_partida'])),
                    'nqv' => '/assets/img/noisquevoa.png',
                    'adversario' => $value['logo_adversario'],
                    'tipo_mv' => $value['mandante_visitante'],
                    'concluido' => $value['concluido'],
                ];
            }
            
        }

        return $proxPartidas;
    }

    private function getPartidasAnteriores()
    {
        $partidasAnteriores = [];

        $partidas = $this->partidas;
        krsort($partidas);
        
        $key = 0;

        foreach ($partidas as $value) {
            if ($value['data_hora_partida'] < date('Y-m-d H:i:s') && count($partidasAnteriores) < 4 && $value['concluido'] == 1 && $value['estatisticas'] == 1) {
                $partidasAnteriores[$key] = [
                    'liga' => $value['liga'],
                    'data' => date('d/m/Y', strtotime($value['data_hora_partida'])),
                    'local' => $value['local'],
                    'horario' => date('H:i', strtotime($value['data_hora_partida'])),
                    'nqv' => '/assets/img/noisquevoa.png',
                    'gols_pro' => $value['gols_pro'],
                    'gols_contra' => $value['gols_contra'],
                    'tipo_mv' => $value['mandante_visitante'],
                    'adversario' => $value['logo_adversario'],
                ];
                $key++;
            }
        }

        return $partidasAnteriores;
    }
}
