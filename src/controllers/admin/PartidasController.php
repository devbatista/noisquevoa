<?php

namespace src\controllers\admin;

use \core\Controller;
use \src\models\Partida;
use \src\models\Local;
use \src\models\Liga;
use \src\models\Equipe;
use \src\models\Usuario;
use \src\models\Gol;
use \src\models\Assistencia;
use \src\models\Falta;
use \src\models\Cartao;

class PartidasController extends Controller
{
    public $partidas;
    public $local;
    public $equipes;
    public $usuario;
    public $gols;
    public $assistencias;
    public $faltas;

    public function __construct()
    {
        $this->detectarLogin();
        $this->partidas = new Partida();
        $this->local = new Local();
        $this->equipes = new Equipe();
        $this->usuario = new Usuario();
        $this->gols = new Gol();
        $this->assistencias = new Assistencia();
        $this->faltas = new Falta();
    }

    public function index()
    {
        $this->loadView('admin/header');
        $this->loadView('admin/partidas');
        $this->loadView('admin/footer');
    }

    public function cadastrarEstatisticas()
    {
        $this->loadView('admin/header');
        $this->loadView('admin/cadastrarEstatisticas');
        $this->loadView('admin/footer');
    }

    public function getDataEstatisticas()
    {
        $this->usuarios = new Usuario();
        $this->usuarios = $this->usuarios->getJogadores();

        $this->partidas = $this->partidas->getPartidasConcluidas();

        $jogadores = [];
        $jogos = [];

        foreach ($this->usuarios as $key => $value) {
            $jogadores[$key] = [
                'id_usuario' => $value['id_usuario'],
                'nome' => $value['nome'],
                'apelido' => $value['apelido'],
            ];
        }

        foreach ($this->partidas as $key => $value) {
            $jogos[$key] = [
                'id_partida' => $value['id_partida'],
                'liga' => $value['liga'],
                'NQV' => 'NQV',
                'nois_que_voa' => 'Nois Que Voa',
                'adversario' => $value['adversario'],
                'abreviacao' => $value['abreviacao'],
                'quadra' => $value['quadra'],
                'data_hora_partida' => date("d/m/Y H:i", strtotime($value['data_hora_partida'])),
                'tipo_mv' => $value['tipo_mv'],
            ];
        }

        $dados = [
            'jogadores' => $jogadores,
            'jogos' => $jogos,
        ];

        echo json_encode($dados);
    }

    public function enviarDataEstatisticas()
    {
        $sumula = null;
        $dados = [
            'id_partida' => $_POST['id_partida'],
            'placar_nqv' => $_POST['placar-nqv'],
            'placar_vis' => $_POST['placar-vis'],
            'jogadores_participantes' => implode(", ", $_POST['jogadores']),
        ];

        $dt_hr_partida = $this->partidas->getPartidaById($dados['id_partida']);
        $dt_hr_partida = $dt_hr_partida['data_hora_partida'];

        if ($_FILES) {
            $validar = $this->validarArquivo($_FILES['sumula']);

            if (!$validar) {
                $errorFile = [
                    'code' => 2,
                    'msg' => 'Erro no upload do arquivo',
                    'tipos_permitidos' => 'jpg/jpeg/png/pdf',
                    'tamanho_permitido' => 'até 4MB',
                ];

                echo json_encode($errorFile);
                return false;
            } else {
                $sumula = $this->salvarArquivo($_FILES['sumula'], $dados['id_partida']);
            }
        }
        for ($g = 1; $g <= count($_POST); $g++) {
            if (array_key_exists("gol_{$g}", $_POST)) {
                $dados['gols'][] = [
                    'gol' => $_POST["gol_{$g}"],
                    'tempo' => $_POST["tempoGol_{$g}"],
                    'periodo' => $_POST["periodoGol_{$g}"],
                    'dt_hora' => $dt_hr_partida,
                ];
            }
        }

        for ($a = 1; $a <= count($_POST); $a++) {
            if (array_key_exists("assistencia_{$a}", $_POST)) {
                $dados['assistencias'][] = [
                    'assistencia' => $_POST["assistencia_{$a}"],
                    'dt_hora' => $dt_hr_partida,
                ];
            }
        }

        for ($f = 1; $f <= 2; $f++) {
            if ($_POST["qtdFaltas{$f}"] > 0) {
                for ($q = 1; $q <= count($_POST); $q++) {
                    if (array_key_exists("falta{$f}_{$q}", $_POST)) {
                        $dados['faltas'][] = [
                            'falta' => $_POST["falta{$f}_{$q}"],
                            'periodo' => $f,
                            'dt_hora' => $dt_hr_partida,
                        ];
                    }
                }
            }
        }

        $cartoes = ['Amarelo', 'Vermelho'];
        foreach ($cartoes as $Cor) {
            if ($_POST["qtdCartoes{$Cor}"] > 0) {
                for ($c = 1; $c <= count($_POST); $c++) {
                    if (array_key_exists("cartao{$Cor}_{$c}", $_POST)) {
                        $cor = strtolower($Cor);
                        $dados["cartoes"][$cor][$c] = $_POST["cartao{$Cor}_{$c}"];
                    }
                }
            }
        }

        $partida = [
            'id_partida' => $dados['id_partida'],
            'placar_nqv' => $dados['placar_nqv'],
            'placar_vis' => $dados['placar_vis'],
            'jogadores' => $dados['jogadores_participantes'],
            'sumula' => $sumula,
            'estatisticas' => 1,
        ];
        $this->partidas->enviarEstatisticasPartida($partida);

        $gols = new Gol();
        $assistencias = new Assistencia();
        $cont = 0;
        if (isset($dados['gols'])) {
            foreach ($dados['gols'] as $gol) {
                $gol['gol'] = ($dados['gols'][$cont]['gol'] == "Gol contra") ? 0 : $dados['gols'][$cont]['gol'];
                $gol['id_partida'] = $dados['id_partida'];
                $gol['assistencia'] = ($dados['assistencias'][$cont]['assistencia'] == "Sem assistência") ? null : $dados['assistencias'][$cont]['assistencia'];
                $gol['dt_hora'] = $dt_hr_partida;
                $id_gol = $gols->insertGoals($gol);
                $this->usuario->updateGoalsUser($gol['gol']);

                if ($gol['assistencia'] = !null) {
                    $assistencia = $dados['assistencias'][$cont];
                    $assistencia['id_gol'] = $id_gol;
                    $assistencia['id_partida'] = $dados['id_partida'];
                    $assistencia['dt_hora'] = $dt_hr_partida;
                    $assistencias->insertAssists($assistencia);
                    $this->usuario->updateAssistsUser($assistencia['assistencia']);
                }

                $cont++;
            }
        }

        $faltas = new Falta();
        if (isset($dados['faltas'])) {
            foreach ($dados['faltas'] as $falta) {
                $falta['id_partida'] = $dados['id_partida'];
                $falta['dt_hora'] = $dt_hr_partida;
                $faltas->insertFouls($falta);
                $this->usuario->updateFoulsUser($falta['falta']);
            }
        }

        $cartoes = new Cartao();
        if (isset($dados['cartoes'])) {
            foreach ($dados['cartoes'] as $cor => $cartao) {
                $cartao = [
                    'id_usuario' => $cartao[1],
                    'id_partida' => $dados['id_partida'],
                ];
                switch ($cor) {
                    case 'amarelo':
                        $cartoes->insertCartoesAmarelos($cartao);
                        $this->usuario->updateYellowCard($cartao['id_usuario'], $dt_hr_partida);
                        break;

                    case 'vermelho':
                        $cartoes->insertCartoesVermelhos($cartao);
                        $this->usuario->updateRedCard($cartao['id_usuario'], $dt_hr_partida);
                        break;
                }
            }
        }

        $this->usuario->updateJogosUser($_POST['jogadores']);

        $retorno = [
            'code' => 0,
            'msg' => 'Estatísticas salvas com sucesso',
        ];

        echo json_encode($retorno);
        return true;
    }

    public function carregarLocais()
    {
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

    public function carregarPartidas()
    {
        $partidas = [];
        $dados = $this->partidas->getJogos();

        foreach ($dados as $key => $value) {
            $partidas[$key] = [
                'id_partida' => $value['id_partida'],
                'liga' => $value['liga'],
                'data' => date('d/m/Y', strtotime($value['data_hora_partida'])),
                'local' => $value['local'],
                'horario' => date('H:i', strtotime($value['data_hora_partida'])),
                'nqv' => 'Nois Que Voa',
                'logo_nqv' => '/assets/img/times/noisquevoa.png',
                'gols_pro' => $value['gols_pro'],
                'gols_contra' => $value['gols_contra'],
                'tipo_mv' => $value['mandante_visitante'],
                'adversario' => $value['adversario'],
                'abreviacao' => $value['abreviacao'],
                'logo_adversario' => $value['logo_adversario'],
                'concluido' => $value['concluido'],
                'estatisticas' => $value['estatisticas'],
            ];
        }

        echo json_encode($partidas);
    }

    public function getEstatisticasById($get)
    {
        $id = $get['id'];
        $partida = $this->partidas;
        $usuario = $this->usuario;
        $gols = $this->gols;
        $assistencias = $this->assistencias;
        $faltas = $this->faltas;
        $cartoes = new Cartao();

        $partida = $partida->getPartidaById($id);
        $gols = $gols->getGoalsByPartidaId($id);
        $assistencias = $assistencias->getAssistsByPartidaId($id);
        $faltas = $faltas->getFoulsByPartidaId($id);
        $cartoesAmarelos = $cartoes->getCartoesByPartidaId($id, 'cartoes_amarelos', 'id_cartao_amarelo');
        $cartoesVermelhos = $cartoes->getCartoesByPartidaId($id, 'cartoes_vermelhos', 'id_cartao_vermelho');

        $quem_jogou = explode(', ', $partida['quem_jogou']);
        foreach ($quem_jogou as $value) {
            $user = $usuario->getUserById($value);
            $jogadores[$value] = [
                'id_usuario' => $user['id_usuario'],
                'nome' => $user['nome'],
                'apelido' => $user['apelido'],
            ];
        }

        $dados = [
            'partida' => $partida,
            'jogadores' => $jogadores,
            'gols' => $gols,
            'assistencias' => $assistencias,
            'faltas' => $faltas,
            'cartoesAmarelos' => $cartoesAmarelos,
            'cartoesVermelhos' => $cartoesVermelhos,
        ];

        $dia = date('D', strtotime($dados['partida']['data_hora_partida']));
        $data_hora_partida = $this->diaDaSemana($dia). ', '.date('d/m/Y - H:i', strtotime($dados['partida']['data_hora_partida']));
        $dados['partida']['data_hora_partida'] = $data_hora_partida;
        $dados['partida']['sumula'] = ($dados['partida']['sumula']) ? $dados['partida']['sumula'] : false;

        echo json_encode($dados);
        return true;
    }

    public function checkPartidasConcluidas()
    {
        $this->partidas->updatePartidasConcluidas();
    }
}
