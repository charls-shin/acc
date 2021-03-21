<?php
require_once __DIR__.'/../vendor/autoload.php';

$app = new core\Application(dirname(__DIR__));

$app->router->get('/','login');
$app->router->get('/test','test');
$app->router->post('/test',function(){
	return 'asdfas';
});

$app->run();