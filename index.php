<?php

use Slim\Factory\AppFactory;
use App\Middleware\JwtMiddleware;
use Dotenv\Dotenv;

error_reporting(E_ALL);
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Content-Type, Authorization, x-requested-with');

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/src/container/cnf.php';

$env = Dotenv::create(__DIR__);
$env->load();

AppFactory::setContainer($container);


$app = AppFactory::create();
$app->addRoutingMiddleware();
$app->addErrorMiddleware(true,true,true);
//$app->add(JwtMiddleware::class);

$en  = glob(__DIR__."/src/util/*.php");$lon = count($en);for($i=0; $i<$lon; $i++){ require $en[$i]; }
$en  = glob(__DIR__."/src/repository/*.php");$lon = count($en);for($i=0; $i<$lon; $i++){ require $en[$i]; }
$en  = glob(__DIR__."/src/controller/*.php");$lon = count($en);for($i=0; $i<$lon; $i++){ require $en[$i]; }
$en  = glob(__DIR__."/src/router/*.php");$lon = count($en);for($i=0; $i<$lon; $i++){ require $en[$i]; }

$app->get('/', function ($request, $response) {
    return $response->withHeader('Location', '/v1/pdf')->withStatus(302);
});


$app->run();
