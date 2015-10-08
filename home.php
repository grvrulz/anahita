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

    //* Add homepage widgets
    add_action( 'genesis_after_header', 'anahita_homepage_widgets' );

  }
}

//* Add markup for homepage widgets
function anahita_homepage_widgets() {

  genesis_widget_area( 'home-featured', array(
    'before' => '<div class="home-featured home-odd widget-area">',
    'after'  => '</div>',
  ) );

}

genesis();
