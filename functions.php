<?php
add_action( 'after_setup_theme', 'zb_setup' );
function zb_setup() {
	// load_theme_textdomain( 'zb', get_template_directory() . '/languages' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'automatic-feed-links');
	add_theme_support( 'menus' );
    add_theme_support( 'title-tag' );

	// Thumbnail size
	/*$thumb_realisation_ratio = 1.5; // Using aspect ratio for WP 4.4 responsive image
	add_image_size( 'zb-custom', 700, round(700/$thumb_realisation_ratio), true );*/

	// Enable support for HTML5 markup.
	add_theme_support( 'html5', array(
		'comment-list',
		'search-form',
		'comment-form'
	) );

	global $content_width;
	if ( ! isset( $content_width ) ) $content_width = 640;
	register_nav_menus(
		array( 'main-menu' => __( 'Main Menu', 'zb' ) )
	);
}

// Enqueue base scripts and styles
add_action( 'wp_enqueue_scripts', 'zb_scripts_and_styles' );
function zb_scripts_and_styles() {
	if ( is_admin() ) return;
	wp_enqueue_style( 'stylesheet', get_stylesheet_uri() );
	wp_enqueue_script( 'jquery' );
	/*if ( is_page('pagenamehere') ) {
		wp_enqueue_script( 'scriptname', get_template_directory_uri() . '/js/scriptname.js', array('jquery'), '', true);
	}*/
	if ( is_singular() && comments_open() && ( get_option( 'thread_comments' ) == 1 ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

add_filter( 'the_title', 'zb_title' );
function zb_title( $title ) {
	if ( $title == '' ) {
		return '&rarr;';
	} else {
		return $title;
	}
}

add_filter( 'wp_title', 'zb_filter_wp_title' );
function zb_filter_wp_title( $title ) {
	return $title . esc_attr( get_bloginfo( 'name' ) );
}

// Adding sidebars to Wordpress
add_action( 'widgets_init', 'zb_widgets_init' );
function zb_widgets_init() {
	register_sidebar( array (
		'name' => __( 'Sidebar Widget Area', 'zb' ),
		'id' => 'primary-widget-area',
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => "</li>",
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4>',
	) );
}

function zb_custom_pings( $comment ) {
	$GLOBALS['comment'] = $comment; ?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>"><?php echo comment_author_link(); ?></li>
<?php }

add_filter( 'get_comments_number', 'zb_comments_number' );
function zb_comments_number( $count ) {
	if ( !is_admin() ) {
		global $id;
		$comments_by_type = &separate_comments( get_comments( 'status=approve&post_id=' . $id ) );
		return count( $comments_by_type['comment'] );
	} else {
	return $count;
	}
}

// Pagination for paged posts, Page 1, Page 2, Page 3, with Next and Previous Links, No plugin
function zb_pagenavi() {
	global $wp_query;
	$bignum = 999999999;
	if ( $wp_query->max_num_pages <= 1 )
		return;
	echo '<nav class="pagination" role="navigation">';
	echo paginate_links( array(
		'base'			=> str_replace( $bignum, '%#%', esc_url( get_pagenum_link($bignum) ) ),
		'format'		=> '',
		'current'		=> max( 1, get_query_var('paged') ),
		'total'			=> $wp_query->max_num_pages,
		'prev_text'		=> '&laquo; Previous',
		'next_text'		=> 'Next &raquo;',
		'type'			=> 'list',
		'end_size'		=> 3,
		'mid_size'		=> 3
	) );
	echo '</nav>';
}

// Add 'Read more' button instead of [...] for Excerpts
add_filter( 'excerpt_more', 'zb_excerpt_more' );
function zb_excerpt_more( $more ) {
	global $post;
	return '... <a class="read-more" href="' . get_permalink($post->ID) . '">' . __( 'Read more', 'zb' ) . '</a>';
}
