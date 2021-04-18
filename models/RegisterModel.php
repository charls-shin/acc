<?php


namespace app\models;


use app\core\Model;

class RegisterModel extends Model
{
	public $name;
	public $password;
	public $passwordConfirm;
	public $email;

	public function register()
	{
		return true;
	}

	public function rules(): array
	{
		return [
			'name'=>[self::RULE_REQUIRED],
			'password'=>[self::RULE_REQUIRED,[self::RULE_MIN,'min'=>2],[self::RULE_MAX,'max'=>5]],
			'passwordConfirm'=>[self::RULE_REQUIRED,[self::RULE_MATCH,'match'=>'password']],
			'email'=>[self::RULE_REQUIRED,self::RULE_EMAIL],
		];
	}


	/*$name = $request->getbody()['name'];
	if( !$name ){
	$errors['name']='this fild is required';
	}
	$name = $request->getbody()['password'];
	if( !$name ){
		$errors['name']='this fild is required';
	}*/
}