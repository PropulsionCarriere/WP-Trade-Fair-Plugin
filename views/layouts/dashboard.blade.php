<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	@include('partials.header')
	<body <?php body_class(); ?>>
	<div class="tf-container">
		<div class="tf-profile-nav">
			<span class="tf-name">{{carbon_get_theme_option('trade_fair_name')}}</span>
			<?php
			wp_nav_menu([
				'depth'             => 2,
				'container'         => 'nav',
				'container_class'   => 'collapse navbar-collapse',
				'container_id'      => 'navbar-items-container',
				'menu_class'        => 'tf-nav-bar',
			]);
			?>
		</div>
	</div>

		@yield('main')

		@php do_action('get_footer') @endphp
		@php wp_footer() @endphp
	</body>
</html>
