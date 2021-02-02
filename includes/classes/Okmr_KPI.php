<?php

/**
 * Class Okmr_KPI
 *
 * This is the KPI class that inits the post type and handles all the action
 */
class Okmr_KPI{
	// Creates the post type
	static function init(){
		register_post_type('okmr_kpi',
			array(
				'labels'      => array(
					'name'          => __('KPIs', OKMR_TEXTDOMAIN),
					'singular_name' => __('KPI', OKMR_TEXTDOMAIN),
				),
				'description' => 'This is the place where the users will store their KPIs',
				'public'      => false,
				'has_archive' => true,
				'publicly_queryable' => true,
				'show_ui' => true,
//				'show_in_menu' => true
			)
		);
	}
}