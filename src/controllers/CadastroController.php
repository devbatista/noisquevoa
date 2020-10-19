<?php

namespace src\controllers;

use \core\Controller;

class CadastroController extends Controller
{

    public function index()
    {
        $this->loadView('cadastro/cadastro');
    }
}
