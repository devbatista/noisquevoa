<?php

namespace src\controllers\admin;

use \core\Controller;

class PartidasController extends Controller
{

    public function __construct()
    {
        $this->detectarLogin();
    }

    public function index()
    {
        $this->loadView('admin/header');
        $this->loadView('admin/partidas');
        $this->loadView('admin/footer');
    }
}
