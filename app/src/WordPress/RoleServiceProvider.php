<?php

namespace TradeFair\WordPress;

use WPEmerge\ServiceProviders\ServiceProviderInterface;

/**
 * A service provider.
 */
class RoleServiceProvider implements ServiceProviderInterface {

	const EXHIBITOR = "exhibitor";

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
		add_action( 'init', [$this, 'addRoles'] );
	}

	public function addRoles(){
		remove_role('exhibitor');
		add_role( "exhibitor", __("Exhibitor", 'trade_fair'), [
			'read' => true,
			'upload_files' => true,
		]);
	}
}
