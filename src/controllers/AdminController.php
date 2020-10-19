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
        $this->loadView('admin/admin');
    }
}
