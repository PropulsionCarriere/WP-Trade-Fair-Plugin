<?php

use TradeFair\TradeFairSchedule;
use WPEmerge\Application\ApplicationTrait;

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

}
