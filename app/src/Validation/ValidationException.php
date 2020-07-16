<?php


namespace TradeFair\Validation;


use Throwable;

class ValidationException extends \Exception
{
	protected $validationErrors;

	public function __construct($validationErrors)
	{
		parent::__construct("Some fields failed validation");
		$this->validationErrors = $validationErrors;
	}

	public function getErrors():array {
		return $this->validationErrors;
	}
}
