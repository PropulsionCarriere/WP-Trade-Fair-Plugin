<?php

use TradeFair\TradeFairSchedule;
use WPEmerge\Application\ApplicationTrait;
use \TradeFair\CarbonFields\UserMeta;

/**
 * @mixin \WPEmergeAppCore\Application\ApplicationMixin
 */
class TradeFair {
	use ApplicationTrait;

	/**
	 * @var TradeFairSchedule
	 */
	protected static $schedule = null;

	public function schedule(){
		if (self::$schedule == null){
			self::$schedule = new \TradeFair\TradeFairSchedule();
		}
		return self::$schedule;
	}

	public function name(){
		return carbon_get_theme_option(\TradeFair\CarbonFields\TradeFairFields::NAME);
	}

	public function getExhibitorByID($id){
		$query = new WP_User_Query( array ( 'id' => $id ) );
		$results = $query->get_results();
		if (empty($results)){
			return null;
		}
		return $results[0];
	}

	public function getExhibitorNameByID($id){
		return carbon_get_user_meta($id, TradeFair\CarbonFields\UserMeta::COMPANY_NAME);
	}

	public function getExhibitorProfileURLByID($id){
		try {
			return TradeFair::routeUrl('tf-company', ['company_id' => $id]);
		} catch (Exception $e){}
		return "notFound";
	}

	public function getExhibitorLogoByID($id, $width, $height, $crop = false){
		$thumbnail = carbon_get_user_meta($id, TradeFair\CarbonFields\UserMeta::COMPANY_LOGO);
		if (!$thumbnail){
			return false;
		}
		return '<img class="tf-company-logo"
					 src="'.TradeFair::core()->image()->thumbnail( $thumbnail, $width, $height, $crop).'"
					 alt="'.carbon_get_user_meta($id, TradeFair\CarbonFields\UserMeta::COMPANY_NAME).' logo"/>';
	}

	public function queryExhibitors($countries = null, $exclude = false): array{
		$params = [
			'role'           => 'exhibitor',
		];
		$exhibitorsQuery = new WP_User_Query($params);
		$exhibitors = $exhibitorsQuery->get_results();
		if (!empty($countries)){
			if ($exclude){
				$exhibitors = self::excludeCountries($exhibitors, $countries);
			} else {
				$exhibitors = self::onlyCountries($exhibitors, $countries);
			}
		}
		return $exhibitors;
	}

	private function onlyCountries($exhibitors, $countries){
		$countries = self::countriesToArray($countries);
		$exhibitors = array_filter($exhibitors, function($user) use ($countries){
			$country = carbon_get_user_meta($user->ID, \TradeFair\CarbonFields\UserMeta::COMPANY_LOCATION);
			return in_array($country, $countries);
		});
		return $exhibitors;
	}

	private function countriesToArray($countries){
		if (is_string($countries)){
			$countries = explode(",",$countries);
		}
		return $countries;
	}

	private function excludeCountries($exhibitors, $countries){
		$countries = self::countriesToArray($countries);
		$exhibitors = array_filter($exhibitors, function($user) use ($countries){
			$country = carbon_get_user_meta($user->ID, \TradeFair\CarbonFields\UserMeta::COMPANY_LOCATION);
			return !in_array($country, $countries);
		});
		return $exhibitors;
	}

	public function getCompanyDescription($company){
		return self::getCompanyDescriptionByID($company->id);
	}

	public function getCompanyDescriptionByID($companyID){
		$locale = explode("_", get_locale());
		$language = $locale[0];
		$metaField = UserMeta::COMPANY_DESC_DEFAULT;
		switch ($language){
			case "fr":
				break;
			case "en":
				$metaField = UserMeta::COMPANY_DESC_EN;
				break;
			default:
				$metaField = UserMeta::COMPANY_DESC_DEFAULT;
		}
		$description = carbon_get_user_meta($companyID, $metaField);
		if ($description == null && $metaField != UserMeta::COMPANY_DESC_DEFAULT) {
			$description = carbon_get_user_meta($companyID, UserMeta::COMPANY_DESC_DEFAULT);
		}
		return $description;
	}

}
