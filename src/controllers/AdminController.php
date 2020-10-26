<?php

namespace src\controllers;

use \core\Controller;

class AdminController extends Controller
{

    public function __construct()
    {
        $this->detectarLogin();
    }

    public function index()
    {
        $this->loadView('admin/header');
        $this->loadView('admin/admin');
        $this->loadView('admin/footer');
    }
}
