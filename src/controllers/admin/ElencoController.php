<?php

namespace src\controllers\admin;

use \core\Controller;

class ElencoController extends Controller
{

    public function __construct()
    {
        $this->detectarLogin();
    }

    public function index()
    {
        $this->loadView('admin/header');
        $this->loadView('admin/elenco');
        $this->loadView('admin/footer');
    }
}
