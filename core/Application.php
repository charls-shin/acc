<?php namespace app\core;

class Application
{
	public static $ROOT_DIR;
	public $router;
	public $request;
	public $response;
	public $controller;
	public static $app;

	public function __construct($rootPath)
	{
		self::$ROOT_DIR=$rootPath;
		self::$app=$this;
		$this->request = new Request();
		$this->response = new Response();
		$this->controller = new Controller();
		$this->router = new Router($this->request,$this->response);
	}

	public function run()
	{
		echo $this->router->resolve();
	}

	/**
	 * @return mixed
	 */
	public function getController(): Controller
	{
		return $this->controller;
	}

	/**
	 * @param mixed $controller
	 */
	public function setController($controller): void
	{
		$this->controller = $controller;
	}
	public function isGuest()
	{
		return true;
	}

}

