<?php

namespace core;

use \src\Config;
use \src\handlers\LoginHandler;

class Controller
{
    public $loggedUser;

    public function __construct()
    {
        // header("Access-Control-Allow-Origin:*");
        // header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
        // header("Content-Type: application/json");
        // header('Access-Control-Allow-Headers: X-PINGARUNER');
        // header('Access-Control-Max-Age: 1728000');
        // header("Content-Length: 0");
        // header("Content-Type: text/plain");
    }

    protected function redirect($url)
    {
        header("Location: " . $this->getBaseUrl() . $url);
        exit;
    }

    private function getBaseUrl()
    {
        $base = (isset($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) == 'on') ? 'https://' : 'http://';
        $base .= $_SERVER['SERVER_NAME'];
        if ($_SERVER['SERVER_PORT'] != '80') {
            $base .= ':' . $_SERVER['SERVER_PORT'];
        }
        $base .= Config::BASE_DIR;

        return $base;
    }

    private function _render($folder, $viewName, $viewData = [])
    {
        if (file_exists('../src/views/' . $folder . '/' . $viewName . '.php')) {
            extract($viewData);
            $view = fn ($vN, $vD = []) => $this->renderPartial($vN, $vD);
            $base = $this->getBaseUrl();
            require '../src/views/' . $folder . '/' . $viewName . '.php';
        }
    }

    private function renderPartial($viewName, $viewData = [])
    {
        $this->_render('partials', $viewName, $viewData);
    }

    public function loadView($viewName, $viewData = [])
    {
        $this->_render('pages', $viewName, $viewData);
    }

    public function detectarLogin() {
        $this->loggedUser = LoginHandler::checkLogin();

        if ($this->loggedUser === false) {
            $this->redirect('/login');
        }
    }
}
