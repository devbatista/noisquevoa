<?php

namespace src\controllers\site;

use \core\Controller;

class PartidasController extends Controller
{
    public $partidas;

    public function index()
    {
        $header = $this->getHeader();

        $this->loadView('site/header', $header);
        $this->loadView('site/partidas');
        $this->loadView('site/footer');
    }
}
