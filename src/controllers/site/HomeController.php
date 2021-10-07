<?php

namespace src\controllers\site;

use \core\Controller;

class HomeController extends Controller
{
    public $partidas;

    public function index()
    {
        $header = $this->getHeader();

        $this->loadView('site/header', $header);
        $this->loadView('site/home');
        $this->loadView('site/footer');
    }
}
