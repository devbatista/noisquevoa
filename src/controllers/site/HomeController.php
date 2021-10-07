<?php

namespace src\controllers\site;

use \core\Controller;
use \src\models\Partida;

class HomeController extends Controller
{
    public $partidas;

    public function index()
    {
        $header = $this->getHeader();
        $dados = [
            'partidas' => $this->getProxPartidas(),
            'resultados' => $this->getUltimosResultados(),
        ];

        $this->loadView('site/header', $header);
        $this->loadView('site/home', $dados);
        $this->loadView('site/footer');
    }

    private function getProxPartidas()
    {
        $partidas = new Partida();
        $partidas = $partidas->getJogos();

        $proxPartidas = [];
        $ultimaPartida = [];
        $count = 0;

        foreach ($partidas as $key => $value) {
            if(!empty($ultimaPartida)) {
                if(($ultimaPartida['adversario'] == $proxPartidas[$count - 1]['adversario']) && ($ultimaPartida['data'] == $proxPartidas[$count - 1]['data']) && ($ultimaPartida['liga'] == $proxPartidas[$count - 1]['liga'])) { 
                    $ultimaPartida = [];
                    continue; 
                }
            }
            if (($value['data_hora_partida'] > date('Y-m-d H:i:s')) && (count($proxPartidas) < 3) && ($value['concluido'] == 0) && ($value['cancelado'] == 0)) {
                $proxPartidas[] = [
                    'data' => date('d/m/Y', strtotime($value['data_hora_partida'])),
                    'local' => $value['local'],
                    'horario' => date('H:i', strtotime($value['data_hora_partida'])),
                    'nqv' => '/assets/img/noisquevoa.png',
                    'logo_adversario' => $value['logo_adversario'],
                    'adversario' => $value['adversario'],
                    'tipo_mv' => $value['mandante_visitante'],
                    'concluido' => $value['concluido'],
                    'liga' => $value['liga'],
                ];
                $ultimaPartida = [
                    'adversario' => $value['adversario'],
                    'data' => date('d/m/Y', strtotime($value['data_hora_partida'])),
                    'liga' => $value['liga'],
                ];
                $count++;
            }            
        }

        return $proxPartidas;
    }

    private function getUltimosResultados()
    {
        $partidas = new Partida();
        $partidas = $partidas->getJogos('concluidos');

        $proxPartidas = [];
        $ultimaPartida = [];
        $count = 0;

        foreach ($partidas as $value) {
            if(!empty($ultimaPartida)) {
                $dt_hora = date('d/m/Y', strtotime($value['dt_hora']));
                if(($ultimaPartida['adversario'] === $value['adversario']) && ($ultimaPartida['data'] === $dt_hora) && ($ultimaPartida['liga'] === $value['liga'])) { 
                    $ultimaPartida = [];
                    $proxPartidas[$count-1] += [
                        'gols_pro2' => $value['gols_pro'],
                        'gols_contra2' => $value['gols_contra'],
                    ];
                    continue; 
                }
            }
            if (($value['dt_hora'] < date('Y-m-d H:i:s')) && (count($proxPartidas) < 3) && ($value['concluido'] == 1)) {
                $proxPartidas[] = [
                    'liga' => $value['liga'],
                    'gols_pro' => $value['gols_pro'],
                    'gols_contra' => $value['gols_contra'],
                    'data' => date('d/m/Y', strtotime($value['dt_hora'])),
                    'local' => $value['local'],
                    'nqv' => '/assets/img/noisquevoa.png',
                    'logo_adversario' => $value['logo_adversario'],
                    'adversario' => $value['adversario'],
                    'tipo_mv' => $value['mandante_visitante'],
                    'concluido' => $value['concluido'],
                ];
                $ultimaPartida = [
                    'adversario' => $value['adversario'],
                    'data' => date('d/m/Y', strtotime($value['dt_hora'])),
                    'liga' => $value['liga'],
                ];
                $count++;
            }            
        }

        return $proxPartidas;
    }
}
