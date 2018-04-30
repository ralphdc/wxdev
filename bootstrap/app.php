<?php

!defined("BASE_PATH") && exit("BASE_PATH not exit!");
define('TOKEN' ,'chao.dong.1985.sunlight-tech.com');

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require BASE_PATH.'vendor/autoload.php';

$config = require_once BASE_PATH."config.php";

$app = new \Slim\App(['settings' => $config]);

$container = $app->getContainer();
$container['logger'] = function($c) {
    $logger = new \Monolog\Logger('wx_logger');
    $file_handler = new \Monolog\Handler\StreamHandler($c['setting']['log_file']);
    $logger->pushHandler($file_handler);
    return $logger;
};

$container['db'] = function ($c) {
    $db = $c['settings']['db'];
    $pdo = new PDO('mysql:host=' . $db['host'] . ';dbname=' . $db['dbname'],
        $db['user'], $db['pass']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    return $pdo;
};


$app->get('/' ,  function(Request $request ,  Response $response , array $args){
	$params    = $request->getQueryParams();
	if($params['echostr']) return validate($request);

    $method = $request->getMethod();
    print_r($method);
});



