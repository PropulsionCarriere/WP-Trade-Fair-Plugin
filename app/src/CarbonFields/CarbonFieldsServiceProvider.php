<?php

namespace TradeFair\CarbonFields;

use Carbon_Fields\Container\Container;
use Carbon_Fields\Field\Field;
use WPEmerge\ServiceProviders\ServiceProviderInterface;

/**
 * Provides Carbon Fields integration.
 */
class CarbonFieldsServiceProvider implements ServiceProviderInterface {
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
		add_action('after_setup_theme', [$this, 'bootstrapCarbonFields'], 100 );
		add_filter('carbon_fields_map_field_api_key', [$this, 'filterCarbonFieldsGoogleMapsKey'] );
		add_action('carbon_fields_register_fields', [$this, 'registerFields'] );
		add_action('widgets_init', [$this, 'registerWidgets'] );
	}

	/**
	 * Bootstrap Carbon Fields.
	 *
	 * @return void
	 */
	public function bootstrapCarbonFields() {
		\Carbon_Fields\Carbon_Fields::boot();
	}

	/**
	 * Filter the Google Maps API key Carbon Fields use.
	 *
	 * @return string
	 */
	public function filterCarbonFieldsGoogleMapsKey() {
		return carbon_get_theme_option( 'crb_google_maps_api_key' );
	}

	/**
	 * Register Carbon Fields fields.
	 *
	 * @return void
	 */
	public function registerFields() {
		$this->registerThemeOptions();
		$this->registerPostMeta();
		$this->registerTermMeta();
		$this->registerUserMeta();
		$this->registerBlocks();
	}

	public function registerBlocks(){
		$blocks = glob(__DIR__ . DIRECTORY_SEPARATOR . 'Blocks' . DIRECTORY_SEPARATOR . '*.php' );
		foreach ( $blocks as $block ) {
			if ( ! is_file( $block ) ) {
				continue;
			}
			require_once $block;
		}
	}

	/**
	 * Register Theme Options fields.
	 *
	 * @return void
	 */
	protected function registerThemeOptions() {
		Container::make( 'theme_options', __( 'Theme Options', 'trade_fair' ) )
			->set_page_file( 'trade_fair-theme-options.php' )
			->add_fields( array(
				Field::make( 'text', 'crb_google_maps_api_key', __( 'Google Maps API Key', 'trade_fair' ) ),
				Field::make( 'header_scripts', 'crb_header_script', __( 'Header Script', 'trade_fair' ) ),
				Field::make( 'footer_scripts', 'crb_footer_script', __( 'Footer Script', 'trade_fair' ) ),
			) );
		Container::make('theme_options', __('Trade Fair', 'trade_fair'))
		->add_fields([
			Field::make('text', 'trade_fair_name', __('Trade Fair name', 'trade_fair')),
			Field::make('date', 'trade_fair_start_date', __('Fair start date', 'trade_fair'))->set_width(50),
			Field::make('date', 'trade_fair_end_date', __('Fair end date', 'trade_fair'))->set_width(50),
			Field::make('time', 'trade_fair_start_time', __('Daily start time', 'trade_fair'))->set_width(50),
			Field::make('time', 'trade_fair_end_time', __('Daily end time', 'trade_fair'))->set_width(50),
		]);
	}

	/**
	 * Register Post Meta fields.
	 *
	 * @return void
	 */
	protected function registerPostMeta() {}

	/**
	 * Register Term Meta fields.
	 *
	 * @return void
	 */
	protected function registerTermMeta() {}

	/**
	 * Register User Meta fields.
	 *
	 * @return void
	 */
	protected function registerUserMeta() {
		Container::make( 'user_meta', __('Online Trade Fair', 'trade_fair') )
			->where('user_role', '=', 'exhibitor')
			->add_fields([
				Field::make('separator', 'tf-company-separator', __('Your company\'s profile', 'trade_fair')),
				Field::make('image', UserMeta::COMPANY_LOGO, __('Company\'s logo', 'trade_fair') ),
				Field::make('text', UserMeta::COMPANY_NAME, __('Company\'s name', 'trade_fair') ),
				Field::make('textarea', UserMeta::COMPANY_DESC, __('Company\'s description', 'trade_fair'))
					->set_help_text('(150 characters maximum)')
					->set_attribute('maxLength',150)
					->set_rows(3),
				Field::make('text', UserMeta::COMPANY_WEBSITE, __('Website link', 'trade_fair')),
				Field::make('text', UserMeta::COMPANY_CONFERENCE_LINK, __('Conference tool link', 'trade_fair')),
				Field::make('file', UserMeta::COMPANY_SALES_BROCHURE, __('Sales brochure', 'trade_fair'))
			]);
	}

	/**
	 * Register Widgets.
	 *
	 * @return void
	 */
	public function registerWidgets() {
		register_widget( \TradeFair\Widgets\Carbon_Rich_Text_Widget::class );
	}
}
