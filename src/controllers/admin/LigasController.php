<?php

namespace src\controllers\admin;

use \core\Controller;
use \src\models\Liga;

class LigasController extends Controller
{
    public $ligas;

    public function __construct()
    {
        $this->detectarLogin();
        $this->ligas = new Liga();
    }

    public function index()
    {
        $this->loadView('admin/header');
        $this->loadView('admin/ligas');
        $this->loadView('admin/footer');
    }
}
