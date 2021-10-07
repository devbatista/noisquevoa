<?php

namespace src\controllers\site;

use \core\Controller;

class ContatoController extends Controller
{
    public $partidas;

    public function index()
    {
        $header = $this->getHeader();

        $this->loadView('site/header', $header);
        $this->loadView('site/contato');
        $this->loadView('site/footer');
    }
}
