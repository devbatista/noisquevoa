<?php

namespace src\controllers\admin;

use \core\Controller;

class JogadoresController extends Controller
{

    public function __construct()
    {
        $this->detectarLogin();
    }

    public function index()
    {
        $this->loadView('admin/header');
        $this->loadView('admin/jogadores');
        $this->loadView('admin/footer');
    }
}
