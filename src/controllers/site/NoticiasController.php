<?php

namespace src\controllers\site;

use \core\Controller;

class NoticiasController extends Controller
{
    public $header;

    public function __construct()
    {
        $this->header = $this->getHeader();
    }
    public function index()
    {
        $this->loadView('site/header', $this->header);
        $this->loadView('site/noticias');
        $this->loadView('site/footer');
    }

    public function noticia($slug) 
    {
        $this->header['uri'] = '/noticias';
        $this->loadView('site/header', $this->header);
        $this->loadView('site/detalheNoticia');
        $this->loadView('site/footer');
    }
}
