<?php

namespace TradeFair\WordPress;

use TradeFair;
use WP_User_Query;
use WPEmerge\ServiceProviders\ServiceProviderInterface;

/**
 * Register shortcodes.
 */
class ShortcodesServiceProvider implements ServiceProviderInterface {
	/**
	 * {@inheritDoc}
	 */
	public function register( $container ) {
		// Nothing to register.
	}

	/**
	 * {@inheritDoc}
	 */
	public function bootstrap( $container ) {
		add_shortcode( 'tf-companies', [$this, 'shortcodeCompanies'] );
		add_shortcode('tf-start-date', [$this, 'shortcodeStartDate']);
		add_shortcode('tf-end-date', [$this, 'shortcodeEndDate']);
	}

	/**
	 * Example shortcode.
	 *
	 * @param  array  $atts
	 * @param  string $content
	 * @return string
	 */
	public function shortcodeCompanies( $atts, $content ) {
		$atts = shortcode_atts(
			array(
				'n_cols' => '2',
				'location' => null,
				'exclude' => false,
			),
			$atts,
			'tf-companies'
		);

		$exhibitors = TradeFair::queryExhibitors($atts['location'], $atts['exclude']);
		return TradeFair::view( 'trade-fair-companies-grid' )->with( $atts )->with('exhibitors', $exhibitors)->toString();
	}

	public function shortcodeStartDate($atts, $content) {
		return TradeFair::view('start-date')->toString();
	}

	public function shortcodeEndDate(){
		return TradeFair::view('end-date')->toString();
	}
}
