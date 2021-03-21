<?php namespace core;

class Router
{
	public $request;
	protected array $routes=[];

	public function __construct($request)
	{
		$this->request = $request;
	}

	public function get($path,$callback)
	{
		$this->routes[$path]=$callback;
	}

	public function resolve()
	{
		$path=$this->request->getPath();
		$method=$this->request->getMethod();
		$callback=$this->routes[$path] ?? false;

		if( $callback === false ){
			echo "Not found";
			exit;
		}

		echo call_user_func($callback);

		// var_dump($callback);
	}
}

