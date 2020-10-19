<?php
use core\Router;

$router = new Router();

$router->get('/', 'HomeController@index');

$router->get('/login', 'LoginController@index');
$router->post('/login/autentica', 'LoginController@autentica');

$router->get('/admin', 'AdminController@index');

$router->post('/email/phpmailer', 'EmailController@enviarPHPMailer');