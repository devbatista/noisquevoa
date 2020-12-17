<?php
use core\Router;

$router = new Router();

$router->get('/', 'HomeController@index');

$router->get('/login', 'LoginController@index');
$router->get('/logout', 'LoginController@logout');
$router->post('/login/autentica', 'LoginController@autentica');

$router->get('/admin', 'admin\AdminController@index');
$router->get('/admin/partidas', 'admin\PartidasController@index');
$router->get('/admin/estatisticas', 'admin\EstatisticasController@index');
$router->get('/admin/elenco', 'admin\ElencoController@index');
$router->get('/admin/diretoria', 'admin\DiretoriaController@index');
$router->get('/admin/posts', 'admin\PostsController@index');

// API
$router->get('/admin/home/dados', 'admin\AdminController@getData');
// END API

$router->post('/email/phpmailer', 'EmailController@enviarPHPMailer');

$router->get('/cadastro', 'CadastroController@index');
$router->get('/cadastro/getPosicoes', 'CadastroController@getPosicoes');
$router->post('/cadastro/enviar', 'CadastroController@cadastrar');