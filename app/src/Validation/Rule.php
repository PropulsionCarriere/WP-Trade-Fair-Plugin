<?php


namespace TradeFair\Validation;


class Rule
{
	/**
	 * Assert the value is not empty
	 * @param $value
	 * @return mixed
	 * @throws RuleNotRespectedException
	 */
	public static function required($value){
		$value = trim($value);
		self::assertFalse(empty($value), __("This field is required.", 'trade_fair'));
		return $value;
	}

	/**
	 * @param bool $value
	 * @param $message
	 * @throws RuleNotRespectedException
	 */
	private static function assertTrue($value, $message){
		if (!$value){
			throw new RuleNotRespectedException($message);
		}
	}

	/**
	 * @param $value
	 * @param $message
	 * @throws RuleNotRespectedException
	 */
	private static function assertFalse($value, $message){
		if ($value){
			throw new RuleNotRespectedException($message);
		}
	}

	public static function url($value){
		self::assertTrue(preg_match("#^https?://.+#", $value), __("This is not a valid url.", 'trade_fair'));
		return $value;
	}

	public static function text($value){
		return sanitize_text_field($value);
	}

	public static function image($attachmentId){
		$type = get_post_mime_type($attachmentId);
		self::assertTrue(preg_match("#^image/.*#",$type), __("This needs to be an image.", 'trade_fair'));
		return $attachmentId;
	}

	public static function file($attachmentId){
		$type = get_post_mime_type($attachmentId);
		self::assertTrue(preg_match("#^application/.*#",$type), __("This needs to be a file.", 'trade_fair'));
		return $attachmentId;
	}

	/**
	 * @param $value
	 * @return mixed
	 * @throws NullableException
	 */
	public static function optional($value){
		if (empty($value)){
			throw new NullableException("Skipping next rules. Value is null");
		}
		return $value;
	}

}
