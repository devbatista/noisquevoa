<?php

namespace src\controllers\admin;

use \core\Controller;

class EstatisticasController extends Controller
{

    public function __construct()
    {
        $this->detectarLogin();
    }

    public function index()
    {
        $this->loadView('admin/header');
        $this->loadView('admin/estatisticas');
        $this->loadView('admin/footer');
    }

    public function getPartidas()
    {

    }
}
