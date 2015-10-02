<?php

add_action( 'genesis_meta', 'anahita_home_genesis_meta' );
/**
 * Add widget support for homepage. If no widgets active, display the default loop.
 *
 */
function anahita_home_genesis_meta() {

  if ( is_active_sidebar( 'home-featured' ) || is_active_sidebar( 'home-top' ) || is_active_sidebar( 'home-middle' ) ) {

    //* Add anahita-home body class
    add_filter( 'body_class', 'anahita_body_class' );
    function anahita_body_class( $classes ) {

         $classes[] = 'anahita-home';
        return $classes;

    }

    //* Force full width content layout
    add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

    //* Remove breadcrumbs
    remove_action( 'genesis_before_loop', 'genesis_do_breadcrumbs');

    //* Remove the default Genesis loop
    remove_action( 'genesis_loop', 'genesis_do_loop' );

    //* Add homepage widgets
    add_action( 'genesis_after_header', 'anahita_homepage_widgets' );

  }
}

//* Add markup for homepage widgets
function anahita_homepage_widgets() {

  genesis_widget_area( 'home-featured', array(
    'before' => '<div class="home-featured widget-area">',
    'after'  => '</div>',
  ) );

  genesis_widget_area( 'home-top', array(
    'before' => '<div class="home-top widget-area"><div class="wrap">',
    'after'  => '</div></div>',
  ) );
  /*
  genesis_widget_area( 'home-middle', array(
    'before' => '<div class="home-middle widget-area"><div class="wrap">',
    'after'  => '</div></div>',
  ) );

  genesis_widget_area( 'home-bottom', array(
    'before' => '<div class="home-bottom widget-area"><div class="wrap">',
    'after'  => '</div></div>',
  ) );
  */

}

genesis();
