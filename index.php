<?php
require_once __DIR__.'/vendor/autoload.php';

$app = new core\Application();

$app->router->get('/',function(){
	return 'hellow World';
});

$app->router->get('/test',function(){
	return 'this is test';
});
// if($_SERVER['REMOTE_ADDR']=='192.168.20.44' || $_SERVER['REMOTE_ADDR']=='10.10.10.1')
// {
	// echo "<xmp>", print_r($_SERVER['REMOTE_ADDR']), "</xmp>";
	// die();
// }
$app->run();