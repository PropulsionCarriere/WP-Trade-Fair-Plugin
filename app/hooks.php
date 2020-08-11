<?php
/**
 * Declare any actions and filters here.
 * In most cases you should use a service provider, but in cases where you
 * just need to add an action/filter and forget about it you can add it here.
 *
 * @package TradeFair
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// phpcs:ignore
// add_action( 'some_action', 'some_function' );
add_filter( 'carbon_fields_user_meta_container_admin_only_access', '__return_false' );
add_filter( 'login_redirect', 'trade_fair_redirect_exhibitor', 20, 3 );
function trade_fair_redirect_exhibitor( $redirect_to, $request, $user){
	if (isset( $user->roles ) && is_array( $user->roles )){
		if (in_array(\TradeFair\WordPress\RoleServiceProvider::EXHIBITOR, $user->roles)){
			return TradeFair::routeUrl('tf-profile');
		}
	}
	return $redirect_to;
}
