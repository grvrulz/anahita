<?php
//* Start the engine
include_once( get_template_directory() . '/lib/init.php' );

//* Setup Theme
include_once( get_stylesheet_directory() . '/lib/theme-defaults.php' );

//* Child theme (do not remove)
define( 'CHILD_THEME_NAME', 'Anahita' );
define( 'CHILD_THEME_URL', 'http://magikpress.com/themes/anahita' );
define( 'CHILD_THEME_VERSION', '1.0.0' );

//* Enqueue scripts and styles
add_action( 'wp_enqueue_scripts', 'mobile_first_scripts_styles' );
function mobile_first_scripts_styles() {

	wp_enqueue_script( 'mobile-first-responsive-menu', get_bloginfo( 'stylesheet_directory' ) . '/js/responsive-menu.js', array( 'jquery' ), '1.0.0' );
	wp_enqueue_script( 'mobile-first-sticky-message', get_bloginfo( 'stylesheet_directory' ) . '/js/sticky-message.js', array( 'jquery' ), '1.0.0' );

	wp_enqueue_style( 'dashicons' );
	wp_enqueue_style( 'google-fonts', '//fonts.googleapis.com/css?family=Dancing+Script|Lato:400,700', array(), CHILD_THEME_VERSION );

}

//* Add HTML5 markup structure
add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', ) );

//* Add viewport meta tag for mobile browsers
add_theme_support( 'genesis-responsive-viewport' );

//* Add support for structural wraps
add_theme_support( 'genesis-structural-wraps', array(
	'header',
	'nav',
	'site-inner',
	'footer-widgets',
	'footer'
) );

//* Add support for custom header
add_theme_support( 'custom-header', array(
	'width'           => 600,
	'height'          => 128,
	'header-selector' => '.site-title a',
	'header-text'     => false,
	'flex-height'     => true,
) );

//* Add support for custom background
add_theme_support( 'custom-background' );

//* Remove the secondary sidebar
unregister_sidebar( 'sidebar-alt' );
unregister_sidebar( 'header-right' );

//* Remove site layouts
genesis_unregister_layout( 'content-sidebar-sidebar' );
genesis_unregister_layout( 'sidebar-sidebar-content' );
genesis_unregister_layout( 'sidebar-content-sidebar' );

//* Remove comment form allowed tags
add_filter( 'comment_form_defaults', 'mobile_first_remove_comment_form_allowed_tags' );
function mobile_first_remove_comment_form_allowed_tags( $defaults ) {
	$defaults['comment_notes_after'] = '';
	return $defaults;
}

//* Modify the size of the Gravatar in the author box
add_filter( 'genesis_author_box_gravatar_size', 'mobile_first_author_box_gravatar' );
function mobile_first_author_box_gravatar( $size ) {
	return 160;
}

//* Modify the size of the Gravatar in the entry comments
add_filter( 'genesis_comment_list_args', 'mobile_first_comments_gravatar' );
function mobile_first_comments_gravatar( $args ) {
	$args['avatar_size'] = 100;
	return $args;
}

//* Add support for 3-column footer widgets
add_theme_support( 'genesis-footer-widgets', 3 );

//* Remove Genesis site favicon
remove_action( 'wp_head', 'genesis_load_favicon' );

//* Image sizes
add_image_size('featured', 694, 400, true);
add_image_size('home-featured', 1200, 400, true);

//* Register widget areas
genesis_register_sidebar( array(
	'id'          => 'home-featured',
	'name'        => __( 'Home Page featured', 'anahita' ),
	'description' => __( 'This is the Home Page featured area', 'anahita' ),
) );


//* Display Featured Image on single post
add_action( 'genesis_entry_header', 'anahita_featured_post_image', 16 );
function anahita_featured_post_image() {
  if ( ! is_singular( 'post' ) )  return;
	the_post_thumbnail('post-image');
}

//* Move post info above title
remove_action( 'genesis_entry_header', 'genesis_post_info', 12);
add_action( 'genesis_entry_header', 'genesis_post_info', 6);

add_filter( 'genesis_post_info', 'anahita_post_info');
function anahita_post_info($filtered) {
	$filtered = '[post_author_posts_link] [post_date format="M d, Y"] [post_comments] [post_edit]';
	return $filtered;
}

add_filter('excerpt_more', 'get_read_more_link');
add_filter( 'the_content_more_link', 'get_read_more_link' );
function get_read_more_link() {
return '…&nbsp;<a href="' . get_permalink() . '">'. __( 'Read More…', 'anahita' ) .'</a>';
}


//* Add theme support for post formats
add_theme_support( 'post-formats', array(
	'quote',
) );

//* Move around things for different post formats
add_action( 'genesis_before_entry', 'anahita_post_format_stuff' );
function anahita_post_format_stuff() {
	//* get the post format
	$post_format = get_post_format( get_the_ID() );
	//* remove the entry header based on the post format
	if ( "quote" == $post_format ) {
		remove_action( 'genesis_entry_header', 'genesis_do_post_format_image', 4 );
		remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_open', 5 );
		remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_close', 15 );
		remove_action( 'genesis_entry_header', 'genesis_do_post_title' );
		remove_action( 'genesis_entry_header', 'genesis_post_info', 6 );
		add_action( 'genesis_entry_footer', 'genesis_do_post_title', 6);
		add_action( 'genesis_entry_footer', 'genesis_post_info', 7);
		echo '<script>console.log("'.get_the_ID().'")</script>';
	}
}
