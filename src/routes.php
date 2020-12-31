<?php
use core\Router;

$router = new Router();

$router->get('/', 'HomeController@index');

$router->get('/login', 'LoginController@index');
$router->get('/logout', 'LoginController@logout');
$router->post('/login/autentica', 'LoginController@autentica');

$router->get('/alterar-minha-senha', 'AlterarSenhaController@index');
$router->post('/alteracao-senha', 'AlterarSenhaController@alteracaoSenha');

$router->get('/admin', 'admin\AdminController@index');
$router->get('/admin/perfil', 'admin\PerfilController@index');
$router->get('/admin/partidas', 'admin\PartidasController@index');
$router->get('/admin/estatisticas', 'admin\EstatisticasController@index');
$router->get('/admin/elenco', 'admin\ElencoController@index');
$router->get('/admin/diretoria', 'admin\DiretoriaController@index');
$router->get('/admin/posts', 'admin\PostsController@index');
$router->get('/admin/ligas', 'admin\LigasController@index');

// API
$router->get('/admin/getPermissao/{id}', 'admin\AdminController@getPermissao');

$router->get('/admin/home/dados', 'admin\AdminController@getData');

$router->get('/admin/perfil/getData/{id}', 'admin\PerfilController@getData');
$router->post('/admin/perfil/alterar-dados', 'admin\PerfilController@updateData');

$router->get('/admin/partidas/carregar-locais', 'admin\PartidasController@carregarLocais');
$router->get('/admin/partidas/carregar-ligas', 'admin\PartidasController@carregarLigas');
$router->post('/admin/partidas/cadastrar-local', 'admin\PartidasController@cadastrarLocal');

$router->get('/admin/elenco/carregar_elenco', 'admin\ElencoController@getElenco');
$router->get('/admin/elenco/carregar_por_id/{id}', 'admin\ElencoController@getElencoById');
$router->get('/admin/elenco/aprovacao_cadastros', 'admin\ElencoController@getAprovarCadastros');
$router->post('/admin/elenco/cadastrar_usuario', 'admin\ElencoController@inserirUsuario');
$router->post('/admin/elenco/alterar_usuario/{id}', 'admin\ElencoController@alterarUsuario');
$router->put('/admin/elenco/aprovar_cadastro/{id}', 'admin\ElencoController@aprovarCadastro');
$router->put('/admin/elenco/desativar_usuario/{id}', 'admin\ElencoController@desativarUsuario');

$router->get('/admin/diretoria/carregar_diretoria', 'admin\DiretoriaController@getDiretoria');
$router->get('/admin/diretoria/aprovacao_cadastros', 'admin\DiretoriaController@getAprovarCadastros');
$router->put('/admin/diretoria/aprovar_cadastro/{id}', 'admin\DiretoriaController@aprovarCadastro');
$router->post('/admin/diretoria/cadastrar_diretoria', 'admin\DiretoriaController@inserirUsuario');
$router->get('/admin/diretoria/carregar_por_id/{id}', 'admin\DiretoriaController@getDiretoriaById');
$router->post('/admin/diretoria/alterar_diretoria/{id}', 'admin\DiretoriaController@alterarUsuario');
$router->put('/admin/diretoria/desativar_usuario/{id}', 'admin\DiretoriaController@desativarUsuario');
// END API

// Emails
$router->post('/email/esqueci_minha_senha', 'EmailController@esqueciMinhaSenha');

$router->post('/email/phpmailer', 'EmailController@enviarPHPMailer');

$router->get('/cadastro', 'CadastroController@index');
$router->get('/cadastro/getPosicoes', 'CadastroController@getPosicoes');
$router->post('/cadastro/enviar', 'CadastroController@cadastrar');





$router->get('/cadastro/testar_img', 'CadastroController@testar_img');