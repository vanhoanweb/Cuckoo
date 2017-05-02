<?php

if (!defined('ABSPATH')) exit;

function zb_setup() {	
	// define max content width
	global $content_width;
	if (!isset($content_width)) $content_width = 960;

	// set up theme support
	add_theme_support('post-thumbnails');
	add_theme_support('automatic-feed-links');
	add_theme_support('custom-background');
	add_theme_support('custom-header');
	add_theme_support('custom-logo');
	add_theme_support('menus');
	add_theme_support('title-tag');

	// register menu
	register_nav_menus(
		array(
			'menu-primary'	=>	__('Main Menu', 'zero-blank'),
			'menu-secondary'=>	__('Extra Menu', 'zero-blank')
		)
	);
	
}
add_action('after_setup_theme', 'zb_setup');

// frontend script & style
function zb_scripts_and_styles() {
	if (is_admin()) return;
	
	// wp_enqueue_style($handle, $src, $deps, $ver, $media)
	wp_enqueue_style('zb', get_stylesheet_uri(), array(), null);
	
	// wp_enqueue_script($handle, $src, $deps, $ver, $in_footer)
	wp_enqueue_script('zb', get_template_directory_uri() .'/js/zb.js', array('jquery'), null, true);
	
	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}
}
add_action('wp_enqueue_scripts', 'zb_scripts_and_styles');

// register widgets
function zb_widgets_init() {	
	$widget_args_1 = array(		
		'name'			=>	__('Widgets Sidebar', 'zero-blank'),
		'id'			=>	'widgets_sidebar',
		'class'			=>	'',
		'description'	=>	__('Widgets added here are displayed in the sidebar', 'zero-blank'),
		'before_widget'	=>	'<section class="widget %s">',
		'after_widget'	=>	'</section>',
		'before_title'	=>	'<h4 class="widget-title widgettitle">',
		'after_title'	=>	'</h4>'		
	);	
	register_sidebar($widget_args_1);	
}
add_action('widgets_init', 'zb_widgets_init');

// Pagination for paged posts, Page 1, Page 2, Page 3, with Next and Previous Links, No plugin
function zb_pagination() {
	global $wp_query;
	$bignum = 999999999;
	if ( $wp_query->max_num_pages <= 1 )
		return;
	echo '<div class="archive-pagination pagination">';
	echo paginate_links( array(
		'base'			=>	str_replace( $bignum, '%#%', esc_url( get_pagenum_link($bignum) ) ),
		'format'		=>	'',
		'current'		=>	max( 1, get_query_var('paged') ),
		'total'			=>	$wp_query->max_num_pages,
		'prev_text'		=>	'&laquo; Previous Page',
		'next_text'		=>	'Next Page &raquo;',
		'type'			=>	'list',
		'end_size'		=>	3,
		'mid_size'		=>	3
	) );
	echo '</div>';
}

// Add 'Continue reading' button instead of [...] for Excerpts
add_filter('excerpt_more', 'zb_excerpt_more');
function zb_excerpt_more($more) {
	global $post;
	return '... <a class="more-link" href="' . get_permalink($post->ID) . '">' . __( '[Continue reading]', 'zero-blank' ) . '</a>';
}