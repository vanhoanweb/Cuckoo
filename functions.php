<?php
/**
 * Author: Van Hoan | @vanhoanweb
 * URL: vanhoan.com
 * Custom functions, support, custom post types and more.
 */
if ( !defined( 'ABSPATH' ) ) exit;

/*********************
SCRIPTS & ENQUEUEING
*********************/
function ck_scripts_and_styles() {
	if ( is_admin() ) return;

	// wp_enqueue_style( $handle, $src, $deps, $ver, $media )
	wp_enqueue_style( 'dashicons' );
	wp_enqueue_style( 'normalize', 'https://cdnjs.cloudflare.com/ajax/libs/normalize/7.0.0/normalize.min.css', array(), null );
	wp_enqueue_style( 'menu', get_template_directory_uri() . '/css/menu.css', array(), null );
	wp_enqueue_style( 'style', get_stylesheet_uri(), array(), null );

	wp_deregister_script( 'jquery' );
	// wp_enqueue_script( $handle, $src, $deps, $ver, $in_footer )
	wp_enqueue_script( 'jquery', 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js', array(), null, true );
	wp_enqueue_script( 'modernizr', 'https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js', array(), null, true );
	wp_enqueue_script( 'jquery-easing', 'https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js', array(), null, true );
	wp_enqueue_script( 'main', get_template_directory_uri() . '/js/main.js', array('jquery'), null, true );

	if ( is_singular() && comments_open() && ( get_option( 'thread_comments' ) == 1 ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'ck_scripts_and_styles' );

// Include files
require_once get_template_directory() . '/lib/cuckoo.php';
// require_once get_template_directory() . '/lib/shortcode.php';
// require_once get_template_directory() . '/lib/post-type.php';
// require_once get_template_directory() . '/lib/sidebar.php';
