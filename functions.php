<?php
/**
 * Author: Van Hoan | @vanhoanweb
 * URL: vanhoan.com
 * Custom functions, support, custom post types and more.
 */
if ( !defined( 'ABSPATH' ) ) exit;

/*********************
THEME SUPPORT
*********************/
function ck_setup() {
	// define max content width
	global $content_width;
	if ( !isset( $content_width ) ) $content_width = 960;

	// set up theme support
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'custom-header' );
	add_theme_support( 'custom-logo' );
	add_theme_support( 'custom-background' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'post_formats', array( 'aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat' ) );
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );

	// menu
	add_theme_support( 'menus' );
	register_nav_menus( array(
		'primary-navigation'	=>	__('Primary Navigation', 'cuckoo'),
		'secondary-navigation'	=>	__('Secondary Navigation', 'cuckoo')
	) );
}
add_action( 'after_setup_theme', 'ck_setup' );

/*********************
SCRIPTS & ENQUEUEING
*********************/
function ck_scripts_and_styles() {
	if ( is_admin() ) return;

	// wp_enqueue_style($handle, $src, $deps, $ver, $media)
	wp_enqueue_style( 'dashicons' );
	wp_enqueue_style( 'normalize', 'https://cdnjs.cloudflare.com/ajax/libs/normalize/7.0.0/normalize.min.css', array(), null );
	wp_enqueue_style( 'menu', get_template_directory_uri() . '/css/menu.css', array(), null );
	wp_enqueue_style( 'style', get_stylesheet_uri(), array(), null );

	wp_deregister_script( 'jquery' );
	// wp_enqueue_script($handle, $src, $deps, $ver, $in_footer)
	wp_enqueue_script( 'jquery', 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js', array(), null, true );
	wp_enqueue_script( 'modernizr', 'https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js', array(), null, true );
	wp_enqueue_script( 'jquery-easing', 'https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js', array(), null, true );
	wp_enqueue_script( 'main', get_template_directory_uri() . '/js/main.js', array('jquery'), null, true );

	if ( is_singular() && comments_open() && ( get_option( 'thread_comments' ) == 1 ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'ck_scripts_and_styles' );

// Custom the_excerpt or the_content
function zb_excerpt($limit) {
	return wp_trim_words(wp_strip_all_tags(get_the_excerpt()), $limit, '...');
}

/*********************
WP_HEAD GOODNESS
*********************/
// category feeds
remove_action( 'wp_head', 'feed_links_extra', 3 );
// post and comment feeds
remove_action( 'wp_head', 'feed_links', 2 );
// EditURI link
remove_action( 'wp_head', 'rsd_link' );
// windows live writer
remove_action( 'wp_head', 'wlwmanifest_link' );
// previous link
remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );
// start link
remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
// links for adjacent posts
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
// WP version
remove_action( 'wp_head', 'wp_generator' );
// remove the REST API lines from the HTML Header
remove_action( 'wp_head', 'rest_output_link_wp_head', 10 );
remove_action( 'wp_head', 'wp_oembed_add_discovery_links', 10 );
// remove WP version from css and scripts
function ck_remove_wp_ver_css_js( $src ) {
	if ( strpos( $src, 'ver=' ) )
		$src = remove_query_arg( 'ver', $src );
	return $src;
}
add_filter( 'style_loader_src', 'ck_remove_wp_ver_css_js', 9999 );
add_filter( 'script_loader_src', 'ck_remove_wp_ver_css_js', 9999 );
// remove WP version from RSS
function ck_rss_version() { return ''; }
add_filter( 'the_generator', 'ck_rss_version' );
// remove WP Emoji
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );
remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
// remove the tinymce emoji plugin
function disable_emojis_tinymce( $plugins ) {
	if ( is_array( $plugins ) ) {
		return array_diff( $plugins, array( 'wpemoji' ) );
	} else {
		return array();
	}
}
add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' );
// remove emoji CDN hostname from DNS prefetching hints
function disable_emojis_remove_dns_prefetch( $urls, $relation_type ) {
	if ( 'dns-prefetch' == $relation_type ) {
		/** This filter is documented in wp-includes/formatting.php */
		$emoji_svg_url = apply_filters( 'emoji_svg_url', 'https://s.w.org/images/core/emoji/2/svg/' );

		$urls = array_diff( $urls, array( $emoji_svg_url ) );
	}
	return $urls;
}
add_filter( 'wp_resource_hints', 'disable_emojis_remove_dns_prefetch', 10, 2 );

/*********************
CLEANUP ITEMS
*********************/
// By default, excerpt length is set to 55 words.
function ck_excerpt_length( $length ) {
	return ( is_front_page() || is_home() ) ? 55 : 30;
}
add_filter( 'excerpt_length', 'ck_excerpt_length', 999 );

// Add 'Continue reading' button instead of [...] for Excerpts
function ck_excerpt_more( $more ) {
	global $post;
	return '... <a class="more-link" href="' . get_permalink( $post->ID ) . '">' . __( '[Continue reading]', 'cuckoo' ) . '</a>';
}
add_filter( 'excerpt_more', 'ck_excerpt_more' );

// Add target blank to links from comment message
function ck_filter_comment_content( $comment_content ){
	return str_replace( '<a ', '<a rel="external nofollow" target="_blank" ', $comment_content );
}
add_filter( 'comment_text', 'ck_filter_comment_content' );

// Add target blank to author name in comments
function ck_comment_author_link( $author_link ){
	return str_replace( '<a ', '<a class="comment-author-link" rel="external nofollow" itemprop="url" target="_blank" ', $author_link );
}
add_filter( 'get_comment_author_link', 'ck_comment_author_link' );

// Add body_class tag
/*function zb_body_class($classes) {
	if () {
		$classes[] = '';
	} else {
		$classes[] = '';
	}
	return $classes;
}
add_filter('body_class', 'zb_body_class');*/

// Include files
require_once get_template_directory() . '/lib/cuckoo.php';
// require_once get_template_directory() . '/lib/shortcode.php';
// require_once get_template_directory() . '/lib/post-type.php';
// require_once get_template_directory() . '/lib/sidebar.php';
