<?php namespace app\controllers;

use app\core\Application;

class SiteController
{
	static function home()
	{
		$params=[
			'name'=>"charls"
		];
		return Application::$app->router->renderView('home',$params);
	}

	static function contact()
	{
		return 'handing data';
	}
}

