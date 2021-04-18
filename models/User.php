<?php


namespace app\models;


use app\core\DbModel;

class User extends DbModel
{
	const  STATUS_INACTIVE = 0;
	const  STATUS_ACTIVE = 1;
	const  STATUS_DELETED = 2;

	public $name = '';
	public $password = '';
	public $passwordConfirm = '';
	public $email = '';
	public $status = self::STATUS_INACTIVE;

	public function tableName(): string
	{
		return 'users';
	}

	public function attributes(): array
	{
		return ['name','password','email','status'];
	}

	public function save()
	{
		$this->status=self::STATUS_ACTIVE;
		$this->password = password_hash($this->password,PASSWORD_DEFAULT);
		return parent::save();
	}

	public function rules(): array
	{
		return [
			'name'=>[self::RULE_REQUIRED],
			'password'=>[self::RULE_REQUIRED,[self::RULE_MIN,'min'=>2],[self::RULE_MAX,'max'=>5]],
			'passwordConfirm'=>[self::RULE_REQUIRED,[self::RULE_MATCH,'match'=>'password']],
			'email'=>[self::RULE_REQUIRED,self::RULE_EMAIL]
		];
	}
}