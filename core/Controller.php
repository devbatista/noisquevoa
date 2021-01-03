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

    protected function detectarLogin()
    {
        $this->loggedUser = LoginHandler::checkLogin();

        if ($this->loggedUser === false) {
            $this->redirect('/login');
        }
    }

    protected function pegarUrl()
    {
        return $this->getBaseUrl();
    }

    protected function retirarAcentos($email)
    {
        $comAcentos = array('à', 'á', 'â', 'ã', 'ä', 'å', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ù', 'ü', 'ú', 'ÿ', 'À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'O', 'Ù', 'Ü', 'Ú');
        $semAcentos = array('a', 'a', 'a', 'a', 'a', 'a', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'n', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'y', 'A', 'A', 'A', 'A', 'A', 'A', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'N', 'O', 'O', 'O', 'O', 'O', '0', 'U', 'U', 'U');

        return str_replace($comAcentos, $semAcentos, $email);
    }

    protected function validarImagem($imagem)
    {
        $permitidos = ['image/jpeg', 'image/jpg', 'image/png'];

        if ((in_array($imagem['type'], $permitidos)) && ($imagem['size'] <= 2097152) && ($imagem['error'] == 0)) {
            return true;
        }

        return false;
    }

    protected function salvarImagem($foto, $id, $pasta)
    {
        $width = 500;
        $heigth = 500;
        $finalX = 0;
        $finalY = 0;
        $tipo = '';


        $tipo = $this->tipoImg($foto['type']);

        $arquivo = 'assets/img/' . $pasta . '/' . $id . $tipo;
        move_uploaded_file($foto['tmp_name'], $arquivo);

        list($larguraOriginal, $alturaOriginal) = getimagesize($arquivo);

        $ratio = $larguraOriginal / $alturaOriginal;
        $ratioDest = $width / $heigth;

        if ($ratioDest > $ratio) {
            $finalWidth = $heigth * $ratio;
            $finalHeight = $heigth;
        } else {
            $finalHeight = $width / $ratio;
            $finalWidth = $width;
        }

        if ($finalWidth < $width) {
            $finalWidth = $width;
            $finalHeight = $width / $ratio;

            $finalY = - (($finalHeight - $heigth) / 2);
        } else {
            $finalHeight = $heigth;
            $finalWidth = $heigth * $ratio;

            $finalX = - (($finalWidth - $width) / 2);
        }

        $imagem = imagecreatetruecolor($width, $heigth);
        if ($tipo == '.jpeg' || $tipo == '.jpg') {
            $originalImg = imagecreatefromjpeg($arquivo);;
        } else {
            $originalImg = imagecreatefrompng($arquivo);
        }

        imagecopyresampled($imagem, $originalImg, $finalX, $finalY, 0, 0, $finalWidth, $finalHeight, $larguraOriginal, $alturaOriginal);

        if ($tipo == '.jpeg' || $tipo == '.jpg') {
            imagejpeg($imagem, $arquivo, 100);
        } else {
            imagepng($imagem, $arquivo, 9);
        }

        return $arquivo;
    }

    private function tipoImg($tipo)
    {
        $type = '';

        if ($tipo == 'image/jpeg') {
            $type = '.jpeg';
        } else if ($tipo == 'image/jpg') {
            $type = '.jpg';
        } else if ($tipo == 'image/png') {
            $type = '.png';
        } else {
            return false;
        }

        return $type;
    }
}
