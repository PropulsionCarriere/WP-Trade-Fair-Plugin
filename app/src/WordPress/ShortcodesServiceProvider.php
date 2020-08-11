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
			),
			$atts,
			'tf-companies'
		);
		$exhibitorsQuery = new WP_User_Query([
			'role'           => 'exhibitor',
		]);
		return TradeFair::view( 'trade-fair-companies-grid' )->with( $atts )->with('exhibitors', $exhibitorsQuery->get_results())->toString();


	}
}
