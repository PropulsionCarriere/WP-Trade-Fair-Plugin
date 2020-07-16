<?php

namespace TradeFair\WordPress;

use Carbon_Fields\Container;
use Carbon_Fields\Field;
use WPEmerge\ServiceProviders\ServiceProviderInterface;

/**
 * Register widgets and sidebars.
 */
class ContentTypesServiceProvider implements ServiceProviderInterface
{
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
		add_action( 'init', [$this, 'registerPostTypes'] );
		add_action( 'init', [$this, 'registerTaxonomies'] );
	}

	/**
	 * Register post types.
	 *
	 * @return void
	 */
	public function registerPostTypes() {
		// phpcs:disable
		/*
		register_post_type(
			'trade_fair_custom_post_type',
			array(
				'labels'              => array(
					'name'               => __( 'Custom Types', 'trade_fair' ),
					'singular_name'      => __( 'Custom Type', 'trade_fair' ),
					'add_new'            => __( 'Add New', 'trade_fair' ),
					'add_new_item'       => __( 'Add new Custom Type', 'trade_fair' ),
					'view_item'          => __( 'View Custom Type', 'trade_fair' ),
					'edit_item'          => __( 'Edit Custom Type', 'trade_fair' ),
					'new_item'           => __( 'New Custom Type', 'trade_fair' ),
					'search_items'       => __( 'Search Custom Types', 'trade_fair' ),
					'not_found'          => __( 'No custom types found', 'trade_fair' ),
					'not_found_in_trash' => __( 'No custom types found in trash', 'trade_fair' ),
				),
				'public'              => true,
				'exclude_from_search' => false,
				'show_ui'             => true,
				'capability_type'     => 'post',
				'hierarchical'        => false,
				'query_var'           => true,
				'menu_icon'           => 'dashicons-admin-post',
				'supports'            => array( 'title', 'editor', 'page-attributes' ),
				'rewrite'             => array(
					'slug'       => 'custom-post-type',
					'with_front' => false,
				),
			)
		);
		*/
		// phpcs:enable
	}

	/**
	 * Register taxonomies.
	 *
	 * @return void
	 */
	public function registerTaxonomies() {
		// phpcs:disable
		/*
		register_taxonomy(
			'trade_fair_custom_taxonomy',
			array( 'post_type' ),
			array(
				'labels'            => array(
					'name'              => __( 'Custom Taxonomies', 'trade_fair' ),
					'singular_name'     => __( 'Custom Taxonomy', 'trade_fair' ),
					'search_items'      => __( 'Search Custom Taxonomies', 'trade_fair' ),
					'all_items'         => __( 'All Custom Taxonomies', 'trade_fair' ),
					'parent_item'       => __( 'Parent Custom Taxonomy', 'trade_fair' ),
					'parent_item_colon' => __( 'Parent Custom Taxonomy:', 'trade_fair' ),
					'view_item'         => __( 'View Custom Taxonomy', 'trade_fair' ),
					'edit_item'         => __( 'Edit Custom Taxonomy', 'trade_fair' ),
					'update_item'       => __( 'Update Custom Taxonomy', 'trade_fair' ),
					'add_new_item'      => __( 'Add New Custom Taxonomy', 'trade_fair' ),
					'new_item_name'     => __( 'New Custom Taxonomy Name', 'trade_fair' ),
					'menu_name'         => __( 'Custom Taxonomies', 'trade_fair' ),
				),
				'hierarchical'      => true,
				'show_ui'           => true,
				'show_admin_column' => true,
				'query_var'         => true,
				'rewrite'           => array( 'slug' => 'custom-taxonomy' ),
			)
		);
		*/
		// phpcs:enable
	}
}
