<?php

namespace src\controllers\admin;

use \core\Controller;
use \src\models\Liga;

class LigasController extends Controller
{
    public $ligas;

    public function __construct()
    {
        $this->detectarLogin();
        $this->ligas = new Liga();
    }

    public function index()
    {
        $this->loadView('admin/header');
        $this->loadView('admin/ligas');
        $this->loadView('admin/footer');
    }

    public function getLigas()
    {
        $ligas = $this->ligas->getData();

        echo json_encode($ligas);
        return true;
    }

    public function addLiga()
    {
        $dados = [
            'nome' => $_POST['nome'],
            'site' => (!empty($_POST['site'])) ? $_POST['site'] : null,
        ];

        $id_liga = $this->ligas->addLiga($dados);

        if ($_FILES) {
            $validar = $this->validarArquivo($_FILES['logo']);
            if ($_FILES['logo']['type'] == 'application/pdf') {
                $validar = false;
            }

            if (!$validar) {
                $retorno = [
                    'code' => 1,
                    'msg' => 'Erro no upload do arquivo',
                    'tipos_permitidos' => 'jpg/jpeg/png',
                    'tamanho_permitido' => 'até 4MB',
                ];

                echo json_encode($retorno);
                return false;
            }

            $logo = $this->salvarImagem($_FILES['logo'], $id_liga, 'ligas');
            $logo = '/' . $logo;
            $this->ligas->updateLogoLiga($logo, $id_liga);
        }

        $retorno = [
            'code' => 0,
            'msg' => 'Liga cadastrada com sucesso',
        ];

        echo json_encode($retorno);
        return true;
    }

    public function updateLiga()
    {
        $dados = [
            'id_liga' => $_POST['id'],
            'nome' => $_POST['novoNome'],
            'url_site' => (!empty($_POST['novoSite']) || $_POST['novoSite'] == 'Sem site') ? $_POST['novoSite'] : null,
        ];

        $this->ligas->updateLiga($dados);
    }

    public function disableLiga($data)
    {
        $id = $data['id'];
        $this->ligas->disableLiga($id);
    }
}
