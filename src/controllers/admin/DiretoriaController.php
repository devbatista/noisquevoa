<?php

namespace src\controllers\admin;

use \core\Controller;

class DiretoriaController extends Controller
{

    public function __construct()
    {
        $this->detectarLogin();
    }

    public function index()
    {
        $this->loadView('admin/header');
        $this->loadView('admin/diretoria');
        $this->loadView('admin/footer');
    }
}
