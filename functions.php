<?php
/**
 * Author: Van Hoan | @vanhoanweb
 * URL: vanhoan.com
 * Custom functions, support, custom post types and more.
 */

if (!defined('ABSPATH')) exit;

function zb_setup() {

	// define max content width
	global $content_width;
	if (!isset($content_width)) $content_width = 960;

	// set up theme support
	add_theme_support('automatic-feed-links');
	add_theme_support('title-tag');
	add_theme_support('post-thumbnails');
	add_theme_support('custom-header');
	add_theme_support('custom-logo');
	add_theme_support('custom-background');
	add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption'));
	
	// menu
	add_theme_support('menus');
	register_nav_menus(array(
		'primary-navigation'	=>	__('Primary Navigation', 'zero-blank'),
		'secondary-navigation'	=>	__('Secondary Navigation', 'zero-blank')
	));	
}
add_action('after_setup_theme', 'zb_setup');

// frontend script & style
function zb_scripts_and_styles() {
	if (is_admin()) return;
	
	// wp_enqueue_style($handle, $src, $deps, $ver, $media)
	wp_enqueue_style('dashicons');
	wp_enqueue_style('zb-menu', get_template_directory_uri() .'/css/zb-menu.css', array(), null);
	wp_enqueue_style('zb-main', get_stylesheet_uri(), array(), null);
	
	// wp_enqueue_script($handle, $src, $deps, $ver, $in_footer)
	wp_enqueue_script('jquery-easing', 'https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js', array(), null, true);
	wp_enqueue_script('zb-main', get_template_directory_uri() .'/js/zb.js', array('jquery'), null, true);
	
	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}
}
add_action('wp_enqueue_scripts', 'zb_scripts_and_styles');

// Custom the_excerpt or the_content
function zb_excerpt($limit) {
	return wp_trim_words(wp_strip_all_tags(get_the_excerpt()), $limit, '...');
}

// By default, excerpt length is set to 55 words. To change excerpt length to 30 words
function zb_excerpt_length($length) {
	return (is_front_page() || is_home()) ? 55 : 30;
}
add_filter('excerpt_length', 'zb_excerpt_length', 999);

// Add 'Continue reading' button instead of [...] for Excerpts
function zb_excerpt_more($more) {
	global $post;
	return '... <a class="more-link" href="' . get_permalink($post->ID) . '">' . __( '[Continue reading]', 'zero-blank' ) . '</a>';
}
add_filter('excerpt_more', 'zb_excerpt_more');

// Add target blank to links from comment message
function zb_filter_comment_content($comment_content){
	return str_replace('<a ', '<a rel="external nofollow" target="_blank" ', $comment_content);
}
add_filter('comment_text', 'zb_filter_comment_content');

// Add target blank to author name in comments
function zb_comment_author_link($author_link){
	return str_replace('<a ', '<a class="comment-author-link" rel="external nofollow" itemprop="url" target="_blank" ', $author_link);
}
add_filter('get_comment_author_link', 'zb_comment_author_link');

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
require_once get_template_directory() .'/inc/zb-sidebar.php';
require_once get_template_directory() .'/inc/zb-metabox.php';
require_once get_template_directory() .'/inc/zb-options.php';
require_once get_template_directory() .'/inc/zb-functions.php';
require_once get_template_directory() .'/inc/zb-shortcode.php';
require_once get_template_directory() .'/inc/zb-post-type.php';
