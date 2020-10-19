<?php
use core\Router;

$router = new Router();

$router->get('/', 'HomeController@index');

$router->get('/login', 'LoginController@index');
$router->get('/logout', 'LoginController@logout');
$router->post('/login/autentica', 'LoginController@autentica');

$router->get('/admin', 'AdminController@index');

$router->post('/email/phpmailer', 'EmailController@enviarPHPMailer');

$router->get('/cadastro', 'CadastroController@index');
$router->get('/cadastro/getPosicoes', 'CadastroController@getPosicoes');
$router->post('/cadastro/enviar', 'CadastroController@cadastrar');