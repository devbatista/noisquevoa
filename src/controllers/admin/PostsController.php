<?php

namespace src\controllers\admin;

use \core\Controller;

class PostsController extends Controller
{

    public function __construct()
    {
        $this->detectarLogin();
    }

    public function index()
    {
        $this->loadView('admin/header');
        $this->loadView('admin/posts');
        $this->loadView('admin/footer');
    }
}
