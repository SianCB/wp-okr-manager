<?php

/**
 * Class Okmr_OKR
 *
 * This is the OKR class that inits the post type and handles all the action
 */

class Okmr_OKR {
	// Creates the post type
	static function init(){
		register_post_type('okmr_okr',
			array(
				'labels'      => array(
					'name'          => __('OKRs', OKMR_TEXTDOMAIN),
					'singular_name' => __('OKR', OKMR_TEXTDOMAIN),
				),
				'description' => 'This is the place where the users will store their OKRs',
				'public'      => false,
				'has_archive' => true,
				'publicly_queryable' => true,
				'show_ui' => true,
			)
		);
	}
}