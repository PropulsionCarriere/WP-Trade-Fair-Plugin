<?php

namespace TradeFair\Controllers\Web;

use TradeFair\CarbonFields\UserMeta;
use TradeFair\Controllers\Controller;
use TradeFair\Validation\RuleNotRespectedException;
use WPEmerge\Requests\Request;
use WPEmerge\View\ViewInterface;

class TradeFairProfileController extends Controller {

	/**
	 * Handle the trade fair profile.
	 * @return ViewInterface
	 */
	public function index() {
		wp_enqueue_media();
		$this->pageTitle = __("Trade Fair Profile", 'trade_fair');
		return \TradeFair::view('trade-fair-profile');
	}

	public function update(Request $request){
		$inputs = $this->validate([
			UserMeta::COMPANY_NAME => [
				'required',
				'text',
			],
			UserMeta::COMPANY_DESC_DEFAULT => [
				'required',
				'text',
				function ($value){
					if (strlen($value)>150){
						throw new RuleNotRespectedException("The field cannot be over 150 characters");
					}
					return $value;
				},
			],
			UserMeta::COMPANY_DESC_EN => [
				'required',
				'text',
				function ($value){
					if (strlen($value)>150){
						throw new RuleNotRespectedException("The field cannot be over 150 characters");
					}
					return $value;
				},
			],
			UserMeta::COMPANY_WEBSITE => [
				'optional',
				'url',
			],
			UserMeta::COMPANY_CONFERENCE_LINK => [
				'required',
				'url',
			],
			UserMeta::COMPANY_LOGO => [
				'required',
				'image',
			],
			UserMeta::COMPANY_SALES_BROCHURE => [
				'optional',
				'file',
			],
			UserMeta::COMPANY_LOCATION => [
				'required',
			]
		], $request);
		foreach ($inputs as $field => $value){
			$this->updateCurrentUserField($field, $value);
		}
		\TradeFair::flash()->add('tf-profile-success', __('Your profile has been updated successfully.', 'trade_fair'));
		return \TradeFair::redirect()->back(home_url('/trade-fair-profile/'));
	}

	public function enqueueFrontendAssets()
	{
		parent::enqueueFrontendAssets();
		\TradeFair::core()->assets()->enqueueScript(
			'tf-js-bundle',
			\TradeFair::core()->assets()->getBundleUrl( 'tf-profile', '.js' ),
			[],
			true
		);
		wp_localize_script( 'tf-js-bundle', 'lang', [
			'change_label' => __('Change', 'trade_fair'),
			'media_library_title' => __('Select or upload a media', 'trade_fair'),
			'use_this'=> __('Use selected', 'trade_fair'),
			'preview_not_available' => __('Preview unavailable', 'trade_fair'),
		]);
	}

}
