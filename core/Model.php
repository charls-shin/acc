<?php


namespace app\core;


abstract class Model
{
	const RULE_REQUIRED = 'required';
	const RULE_EMAIL = 'email';
	const RULE_MIN = 'min';
	const RULE_MAX = 'max';
	const RULE_MATCH = 'match';
	const RULE_UNIQUE = 'unique';

	public $errors = [];

	public function loadData($data)
	{
		foreach ($data as $key => $value) {
			if (property_exists($this, $key)) {
				$this->{$key} = $value;
			}
		}
	}

	abstract public function rules() : array;

	public function validate()
	{
		foreach ($this->rules() as $attribute=>$rules){
			$value =$this->{$attribute};
			foreach ($rules as $rule){
				$ruleName=$rule;
				if(!is_string($ruleName)){
					$ruleName=$rule[0];
				}
				if($ruleName===self::RULE_REQUIRED && !$value){
					$this->addError($attribute,self::RULE_REQUIRED);
				}
				if ($ruleName === self::RULE_EMAIL && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
					$this->addError($attribute, self::RULE_EMAIL);
				}
				if ($ruleName === self::RULE_MIN && strlen($value) < $rule['min']) {
					$this->addError($attribute, self::RULE_MIN, ['min' => $rule['min']]);
				}
				if ($ruleName === self::RULE_MAX && strlen($value) > $rule['max']) {
					$this->addError($attribute, self::RULE_MAX, ['max' => $rule['max']]);
				}
				if ($ruleName === self::RULE_MATCH && $value !== $this->{$rule['match']}) {
					$this->addError($attribute, self::RULE_MATCH, ['match' => $rule['match']]);
				}
			}
		}

		return empty($this->errors);
	}

	public function addError($attribute,$rule,$params=[])
	{
		$message=$this->errorMessages()[$rule] ?? '';
		foreach ($params as $key=>$value)
		{
			$message=str_replace("{{$key}}",$value,$message);
		}
		$this->errors[$attribute][] = $message;
	}

	public function errorMessages()
	{
		return [
			self::RULE_REQUIRED => 'This field is required',
			self::RULE_EMAIL => 'This field must be valid email address',
			self::RULE_MIN => 'Min length of this field must be {min}',
			self::RULE_MAX => 'Max length of this field must be {max}',
			self::RULE_MATCH => 'This field must be the same as {match}',
			self::RULE_UNIQUE => 'Record with with this {field} already exists',
		];
	}

	public function hasError($attribute)
	{
		return $this->errors[$attribute] ?? false;
	}

	public function getFirstError($attribute)
	{
		return $this->errors[$attribute][0] ?? false;
	}
}