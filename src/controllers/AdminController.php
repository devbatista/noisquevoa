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
        echo '<pre>';
        print_r($_SESSION);
        echo '</pre>';
        $this->loadView('admin/admin');
    }
}
