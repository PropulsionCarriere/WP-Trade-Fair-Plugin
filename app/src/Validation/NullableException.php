<?php


namespace TradeFair\Validation;


use Throwable;

class NullableException extends \Exception
{
	public function __construct($message = "", $code = 0, Throwable $previous = null)
	{
		parent::__construct($message, $code, $previous);
	}
}
