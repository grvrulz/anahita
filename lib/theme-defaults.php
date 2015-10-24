<?php

/**
 * Setup Theme.
 *
 * @package Anahita
 * @anahita  MagikPress
 * @link    http://magikpress.com/themes/anahita/
 * @license GPL2-0+
 */

//* Anahita Theme Setting Defaults
add_filter( 'genesis_theme_settings_defaults', 'anahita_defaults' );
function anahita_defaults( $defaults ) {

	$defaults['blog_cat_num']              = 10;
	$defaults['content_archive_limit']     = 0;
	$defaults['content_archive_thumbnail'] = 0;
	$defaults['image_alignment']           = 'alignleft';
	$defaults['posts_nav']                 = 'numeric';
	$defaults['site_layout']               = 'content-sidebar';

	return $defaults;

}

//* Anahita Theme Setup
add_action( 'after_switch_theme', 'anahita_setting_defaults' );
function anahita_setting_defaults() {

	if( function_exists( 'genesis_update_settings' ) ) {

		genesis_update_settings( array(
			'blog_cat_num'              => 10,
			'content_archive_limit'     => 0,
			'content_archive_thumbnail' => 1,
			'image_alignment'           => 'alignleft',
			'posts_nav'                 => 'numeric',
			'site_layout'               => 'content-sidebar',
		) );

		if ( function_exists( 'GenesisResponsiveSliderInit' ) ) {

			genesis_update_settings( array(
				'location_horizontal'             => 'left',
				'location_vertical'               => 'top',
				'posts_num'                       => '5',
				'slideshow_arrows'                => 0,
				'slideshow_excerpt_content_limit' => '150',
				'slideshow_excerpt_content'       => 'full',
				'slideshow_excerpt_width'         => '60',
				'slideshow_excerpt_show'          => 1,
				'slideshow_height'                => '400',
				'slideshow_more_text'             => __( 'Continue Reading&hellip;', 'anahita' ),
				'slideshow_pager'                 => 1,
				'slideshow_title_show'            => 1,
				'slideshow_width'                 => '1200',
			), GENESIS_RESPONSIVE_SLIDER_SETTINGS_FIELD );

		}

	}

}

//* Set Genesis Responsive Slider defaults
add_filter( 'genesis_responsive_slider_settings_defaults', 'anahita_responsive_slider_defaults' );
function anahita_responsive_slider_defaults( $defaults ) {

	$args = array(
		'location_horizontal'             => 'left',
		'location_vertical'               => 'top',
		'posts_num'                       => '5',
		'slideshow_arrows'                => 0,
		'slideshow_excerpt_content_limit' => '150',
		'slideshow_excerpt_content'       => 'full',
		'slideshow_excerpt_width'         => '60',
		'slideshow_excerpt_show'          => 1,
		'slideshow_height'                => '400',
		'slideshow_more_text'             => __( 'Continue Reading&hellip;', 'anahita' ),
		'slideshow_pager'                 => 1,
		'slideshow_title_show'            => 1,
		'slideshow_width'                 => '1200',
	);

	$args = wp_parse_args( $args, $defaults );
	
	return $args;
	
}