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
		self::assertFalse(empty($value), "This field is required.");
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
		self::assertTrue(preg_match("#^https?://.+#",$value), "This is not a valid url.");
		return $value;
	}

	public static function text($value){
		return sanitize_text_field($value);
	}

	public static function image($attachmentId){
		$type = get_post_mime_type($attachmentId);
		self::assertTrue(preg_match("#^image/.*#",$type), "This needs to be an image.");
		return $attachmentId;
	}

	public static function file($attachmentId){
		$type = get_post_mime_type($attachmentId);
		self::assertTrue(preg_match("#^application/.*#",$type), "This needs to be a file.");
		return$attachmentId;
	}

}
