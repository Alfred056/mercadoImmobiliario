<?php 

use DI\Container;
use Medoo\Medoo;

$container = new Container();

$container->set('database',function(){
    
    return new Medoo([
		'type'      => 'mysql',
		'host'      => $_ENV['MYSQL_HOST'],
		'database'  => $_ENV['MYSQL_DBNAME'],
		'username'  => $_ENV['MYSQL_USER'],
		'password'  => $_ENV['MYSQL_PASSWORD'],
        'port'      => $_ENV['MYSQL_PORT'],
        'option' => [
            PDO::ATTR_CASE => PDO::CASE_NATURAL
        ],
	]); 


});

/*
$container->set('view', function() {

    return Twig::create(__DIR__ . '/../template/',
     ['cache' => __DIR__ . '/../template/cache']
    );

});*/
