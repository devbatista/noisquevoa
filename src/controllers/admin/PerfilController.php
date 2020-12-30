<?php

namespace src\controllers\admin;

use \core\Controller;
use \src\models\Partida;
use \src\models\Usuario;

class PerfilController extends Controller
{
    public $usuario;

    public function __construct()
    {
        $this->detectarLogin();
    }

    public function index()
    {
        $this->loadView('admin/header');
        $this->loadView('admin/perfil');
        $this->loadView('admin/footer');
    }

    
}
