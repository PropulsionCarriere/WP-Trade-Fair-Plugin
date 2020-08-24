<?php


namespace TradeFair\Controllers;


use TradeFair\Validation\NullableException;
use TradeFair\Validation\RuleNotRespectedException;
use TradeFair\Validation\ValidationException;
use WPEmerge\Requests\Request;

class Controller
{
	protected $pageTitle = null;

	public function __construct()
	{
		add_filter('pre_get_document_title', [$this, 'setPageTitleCallBack'], 20);
		add_action( 'wp_enqueue_scripts', [$this, 'enqueueFrontendAssets'], 20 );
	}

	public function setPageTitleCallBack($title){
		return $this->pageTitle ?? $title;
	}

	public function enqueueFrontendAssets(){}
	/**
	 * @param $validationRules
	 * @param Request $request
	 * @return array
	 * @throws ValidationException
	 */
	protected function validate($validationRules, Request $request): array{
		$inputs = $request->body();
		$errors = [];
		$outputs = [];
		foreach ($validationRules as $fieldName => $rules){
			$value = $inputs[$fieldName];
			try {
				$value = $this->applyRules($value, $rules);
			} catch (RuleNotRespectedException $e){
				$errors[$fieldName] = $e->getMessage();
			} catch (NullableException $e) {
				$value = null;
			}
			$outputs[$fieldName] = $value;
		}
		if (count($errors) > 0){
			throw new ValidationException($errors);
		}
		return $outputs;
	}

	private function applyRules($value, $rules){
		foreach ($rules as $rule){
			if (is_string($rule)){
				$rule = 'TradeFair\Validation\Rule::'. $rule;
			}
			$value = $rule($value);
		}
		return $value;
	}

	protected function updateCurrentUserField($fieldName, $newValue){
		carbon_set_user_meta(wp_get_current_user()->ID, $fieldName, $newValue);
	}
}
