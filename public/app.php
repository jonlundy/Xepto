<?php namespace XeptoAuthCAS;

use Xepto;
use XeptoCheck;

chdir($_SERVER['DOCUMENT_ROOT']);
set_include_path(get_include_path().':lib/');

require 'Xepto/include/get_headers.php';
require 'Xepto/include/get_query.php';
require 'Xepto/include/get_post.php';

require 'Xepto/include/get_autoloader.php';

$request  = new Xepto\Request\Request  ();

$env = $request->server('APP_ENV');

$config = new Xepto\Config\Config();
$config->merge(require "XeptoCheck/config/check.$env.php");
$config->merge(require "XeptoAuthCAS/config/auth.$env.php");


$response = new Xepto\Request\Response ($config->response, $request);

$persist    = new XeptoCheck\Token\Persist   ($config->persist);
$encryption = new XeptoCheck\Token\Encryption(MCRYPT_BlOWFISH, MCRYPT_MODE_CBC);
$token      = new XeptoCheck\Token\Token     ($config->token, $request, $response, $persist, $encryption);

$router   = new Xepto\Request\Router   ($config->router,   $request, $response, $token);

return $router->run($config->app);