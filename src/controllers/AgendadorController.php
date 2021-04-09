<?php

namespace src\controllers;

use \core\Controller;
use \src\models\Partida;

class AgendadorController extends Controller
{
    public $partidas;

    public function __construct()
    {
        $this->partidas = new Partida();
    }

    public function checkPartidasConcluidas()
    {
        $this->partidas->updatePartidasConcluidas();
    }
}
