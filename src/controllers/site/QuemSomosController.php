<?php

namespace src\controllers\site;

use \core\Controller;

class QuemSomosController extends Controller
{
    public $partidas;

    public function index()
    {
        $header = $this->getHeader();

        $this->loadView('site/header', $header);
        $this->loadView('site/quemSomos');
        $this->loadView('site/footer');
    }
}
