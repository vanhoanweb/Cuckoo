<?php
/**
 * Author: Van Hoan | @vanhoanweb
 * URL: vanhoan.com
 * Custom functions, support, custom post types and more.
 */

if (!defined('ABSPATH')) exit;

function zb_setup() {
	// translation
	// load_theme_textdomain('zero-blank', get_template_directory() .'/languages');

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

// ZB Pagination for paged posts, Page 1, Page 2, Page 3, with Next and Previous Links, No plugin
function zb_pagination() {
	global $wp_query;
	$bignum = 999999999;
	if ( $wp_query->max_num_pages <= 1 ) return;
	echo '<div class="archive-pagination pagination">';
	echo paginate_links( array(
		'base'			=>	str_replace( $bignum, '%#%', esc_url( get_pagenum_link($bignum) ) ),
		'format'		=>	'',
		'current'		=>	max( 1, get_query_var('paged') ),
		'total'			=>	$wp_query->max_num_pages,
		'prev_text'		=>	'&laquo; Previous',
		'next_text'		=>	'Next &raquo;',
		'type'			=>	'list',
		'end_size'		=>	3,
		'mid_size'		=>	3
	) );
	echo '</div>';
}

// ZB Popular Posts
function zb_popular_posts($post_id) {
	$count_key = 'popular_posts';
	$count = get_post_meta($post_id, $count_key, true);
	if ($count == '') {
		$count = 0;
		delete_post_meta($post_id, $count_key);
		add_post_meta($post_id, $count_key, '0');
	} else {
		$count++;
		update_post_meta($post_id, $count_key, $count);
	}
}
function zb_track_posts($post_id) {
	if (!is_single()) return;
	if (empty($post_id)) {
		global $post;
		$post_id = $post->ID;
	}
	zb_popular_posts($post_id);
}
add_action('wp_head', 'zb_track_posts');

// ZB Comments Callback
function zb_comments($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment;
	extract($args, EXTR_SKIP);
	if ( 'div' == $args['style'] ) {
		$tag = 'div';
		$add_below = 'comment';
	} else {
		$tag = 'li';
		$add_below = 'div-comment';
	}
?>
	<<?php echo $tag ?> <?php comment_class(empty( $args['has_children'] ) ? '' : 'parent') ?> id="comment-<?php comment_ID() ?>">
	<?php if ( 'div' != $args['style'] ) : ?>
	<article class="comment-body" itemprop="comment" itemscope="" itemtype="https://schema.org/Comment">
	<?php endif; ?>
		<header class="comment-header">
			<p class="comment-author" itemprop="author" itemscope="" itemtype="https://schema.org/Person">
				<?php if ($args['avatar_size'] != 0) echo get_avatar($comment, 70, '', '', ['class' => 'alignleft']); ?>
				<?php printf(__('<span itemprop="name">%s</span> <span class="says">says</span>'), get_comment_author_link()) ?>
			</p>

			<p class="comment-meta">
				<time class="comment-time" datetime="<?php the_time('Y-m-d'); ?>" itemprop="datePublished">
					<a href="<?php echo htmlspecialchars(get_comment_link($comment->comment_ID)) ?>" class="comment-time-link" itemprop="url"><?php printf(__('%1$s at %2$s'), get_comment_date(),  get_comment_time()) ?></a>
				</time>
				<?php edit_comment_link(__('(Edit)'),'  ','' ); ?>
			</p>

			<?php if ($comment->comment_approved == '0') : ?>
				<em class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.') ?></em><br />
			<?php endif; ?>
		</header>

		<div class="comment-content" itemprop="text">
			<?php comment_text() ?>
		</div>

		<div class="comment-reply">
			<?php comment_reply_link(array_merge( $args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
		</div>
	<?php if ('div' != $args['style']) echo '</article>'; ?>
<?php }

// Custom the_excerpt or the_content
function zb_excerpt( $limit ) {
	return wp_trim_words( wp_strip_all_tags( get_the_excerpt() ), $limit, '...' );
}

// By default, excerpt length is set to 55 words. To change excerpt length to 30 words
function zb_excerpt_length( $length ) {
	return (is_front_page() || is_home()) ? 55 : 30;
}
add_filter('excerpt_length', 'zb_excerpt_length', 999);

// Add 'Continue reading' button instead of [...] for Excerpts
function zb_excerpt_more($more) {
	global $post;
	return '... <a class="more-link" href="' . get_permalink($post->ID) . '">' . __( '[Continue reading]', 'zero-blank' ) . '</a>';
}
add_filter('excerpt_more', 'zb_excerpt_more');

// Add body_class tag
function zb_body_class($classes) {
	if () {
		$classes[] = '';
	} else {
		$classes[] = '';
	}
	return $classes;
}
add_filter('body_class', 'zb_body_class');

// Include files
require_once get_template_directory() .'/inc/zb-post-type.php';
require_once get_template_directory() .'/inc/zb-sidebar.php';
require_once get_template_directory() .'/inc/zb-metabox.php';
require_once get_template_directory() .'/inc/zb-shortcode.php';
require_once get_template_directory() .'/inc/zb-options.php';
