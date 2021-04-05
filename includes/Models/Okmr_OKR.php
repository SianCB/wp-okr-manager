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

	static function kpi_meta_box(){
	    add_meta_box(
	        'kpis',
            __('KPIs', OKMR_TEXTDOMAIN),
            array('Okmr_OKR', 'kpi_meta_box_callable'),
	    'okmr_okr');
    }

    public function kpi_meta_box_callable(){
		$args = array(
			'post_type' => 'okmr_kpi',
			'meta_key' => 'parent_okr',
			'meta_value_num' => get_the_ID(),
		);
		$kpis = new WP_Query($args);?>
		    <ul class="okmr-list-kpis">
			    <?php if ($kpis->have_posts()): while ($kpis->have_posts()): $kpis->the_post();?>
	                <li id="okmr-kpi-wrap-<?php the_ID(); ?>">
                        <ul id="element-<?php the_ID(); ?>" class="okmr-kpi-element">
                            <li class="okmr-element"><?php the_title(); ?></li>
                                <li>
                                    <ul class="okrm-action-btns">
                                        <li class="okmr-edit-btn"><a href="#" onclick="new OKMR_editForm(<?php the_ID(); ?>)"><span class="dashicons dashicons-edit-large"></a></span></li>
                                        <li class="okmr-delete-btn"><span class="dashicons dashicons-trash"></span></li>
                                    </ul>
                                </li>
                        </ul>
                    </li>
                    <div class="okmr-clearfix"></div>
			    <?php endwhile;?>
		    </ul>
	    <?php
	    endif;
    }

    private function saveData(){
		// Hold some data
    }
}