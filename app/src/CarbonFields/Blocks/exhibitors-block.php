<?php

use Carbon_Fields\Block;
use Carbon_Fields\Field;

Block::make( __( 'Trade Fair Participants', 'trade_fair' ) )
	->add_fields([
		Field::make('html','trade_fair_gutenberg_block_help',__('Click on the "eye icon" above for a preview of the block', 'trade_fair'))
			->set_html(sprintf('<label>%s</label>', __( 'Click on the "eye icon" above for a preview of the block', 'trade_fair' ))),
		Field::make( 'text', 'n_cols', __( 'Number of columns', 'trade_fair' ) )
			->set_attribute( 'type', 'number' )
			->set_attribute('min','1')
			->set_attribute('max','4')
			->set_default_value( '2')
	])
	->set_render_callback( function ( $fields, $attributes, $inner_blocks ) {
		$exhibitors_query = new WP_User_Query([
			'role'           => 'exhibitor',
		]);
		TradeFair::render('trade-fair-companies-grid', array_merge($fields,[
			'exhibitors' => $exhibitors_query->get_results(),
		]));
	} );
