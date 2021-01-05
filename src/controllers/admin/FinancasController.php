<?php

namespace src\controllers\admin;

use \core\Controller;
use \src\models\Usuario;

class FinancasController extends Controller
{
    public $partidas;

    public function __construct()
    {
        
    }

    public function index()
    {
        $this->loadView('admin/header');
        $this->loadView('admin/financas');
        $this->loadView('admin/footer');
    }
}
