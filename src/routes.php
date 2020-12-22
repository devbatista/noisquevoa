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
$router->get('/admin/getPermissao/{id}', 'admin\AdminController@getPermissao');
$router->get('/admin/home/dados', 'admin\AdminController@getData');
$router->get('/admin/elenco/carregar_elenco', 'admin\ElencoController@getElenco');
$router->get('/admin/elenco/carregar_por_id/{id}', 'admin\ElencoController@getElencoById');
$router->get('/admin/elenco/aprovacao_cadastros', 'admin\ElencoController@getAprovarCadastros');
$router->post('/admin/elenco/cadastrar_usuario', 'admin\ElencoController@inserirUsuario');
$router->post('/admin/elenco/alterar_usuario/{id}', 'admin\ElencoController@alterarUsuario');
$router->put('/admin/elenco/aprovar_cadastro/{id}', 'admin\ElencoController@aprovarCadastro');
$router->put('/admin/elenco/desativar_usuario/{id}', 'admin\ElencoController@desativarUsuario');
// END API

$router->post('/email/phpmailer', 'EmailController@enviarPHPMailer');

$router->get('/cadastro', 'CadastroController@index');
$router->get('/cadastro/getPosicoes', 'CadastroController@getPosicoes');
$router->post('/cadastro/enviar', 'CadastroController@cadastrar');