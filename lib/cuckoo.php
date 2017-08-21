<?php
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

// Custom the_excerpt or the_content
function ck_excerpt( $limit ) {
	return wp_trim_words( wp_strip_all_tags( get_the_excerpt() ), $limit, '...' );
}

// Add target blank to links from comment message
function ck_filter_comment_content( $comment_content ) {
	return str_replace( '<a ', '<a rel="external nofollow" target="_blank" ', $comment_content );
}
add_filter( 'comment_text', 'ck_filter_comment_content' );

// Add target blank to author name in comments
function ck_comment_author_link( $author_link ) {
	return str_replace( '<a ', '<a class="comment-author-link" rel="external nofollow" itemprop="url" target="_blank" ', $author_link );
}
add_filter( 'get_comment_author_link', 'ck_comment_author_link' );

/*********************
CUSTOM MENU FOR ADMIN
*********************/
function ck_remove_menu_pages() {
	global $current_user;
	if ( $current_user->ID == 2 ) {
		remove_menu_page( 'index.php' );
		remove_menu_page( 'edit.php' );
		remove_menu_page( 'upload.php' );
		remove_menu_page( 'edit-comments.php' );
		remove_menu_page( 'themes.php' );
		remove_menu_page( 'plugins.php' );
		remove_menu_page( 'users.php' );
		remove_menu_page( 'tools.php' );
		remove_menu_page( 'edit.php?post_type=acf' );
		add_menu_page(
			'Users',			// page_title
			'Users',			// menu_title
			'manage_options',	// capability
			'profile.php',		// menu_slug
			'',					// function
			'dashicons-admin-users', // icon_url
			20 					// position
		);
	}
}
add_action( 'admin_init', 'ck_remove_menu_pages' );

/*********************
TRACK POSTS
*********************/
function ck_popular_posts( $post_id ) {
	$count_key = 'popular_posts';
	$count = get_post_meta( $post_id, $count_key, true );
	if ( $count == '' ) {
		$count = 0;
		delete_post_meta( $post_id, $count_key );
		add_post_meta( $post_id, $count_key, '0' );
	} else {
		$count++;
		update_post_meta( $post_id, $count_key, $count );
	}
}
function ck_track_posts( $post_id ) {
	if ( !is_single() ) return;
	if ( empty( $post_id ) ) {
		global $post;
		$post_id = $post->ID;
	}
	ck_popular_posts( $post_id );
}
add_action( 'wp_head', 'ck_track_posts' );

/*********************
RELATED POSTS
*********************/
function ck_related_posts() {
	$category_id = get_the_category();
	$related_posts = new WP_Query( array( 'posts_per_page' => 3, 'category__in' => $category_id[0]->term_id ) );
	if ( $related_posts->have_posts() ) : ?>
	<section class="related-posts">
		<h4>Related Posts</h4>
		<?php while ( $related_posts->have_posts() ) : $related_posts->the_post(); ?>
		<article <?php post_class( 'entry' ); ?>>
			<?php if ( has_post_thumbnail() ) : ?>
			<figure class="entry-image">
				<a href="<?php the_permalink(); ?>">
					<?php the_post_thumbnail( array(225,120), array( 'class' => 'aligncenter' ) ); ?>
				</a>
			</figure><?php endif; ?>

			<section class="entry-content">
				<p class="entry-meta">
					<span class="entry-categories"><?php the_category( ', ' ); ?></span>
				</p>
				<h5 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
			</section>
		</article>
		<?php endwhile; wp_reset_postdata(); ?>
	</section>
	<?php endif;
}

/*********************
AUTHOR BOX
*********************/
function ck_author_box() { ?>
	<section class="author-box" itemscope itemprop="author" itemtype="http://schema.org/Person">
		<div class="author-box-avatar">
			<?php echo get_avatar( get_the_author_meta( 'user_email' ), 90, '', '', [ 'class' => 'alignleft' ] ); ?>
		</div>
		<h4 class="author-box-title">
			<?php _e( 'About ', 'cuckoo' ); ?>
			<?php echo ( is_author() ) ? get_the_author() : '<a class="author-box-link" href="'. esc_url(get_author_posts_url(get_the_author_meta('ID'))) .'" rel="author"><span itemprop="name">'. get_the_author() .'</span></a>'; ?>
		</h4>
		<div class="author-box-content" itemprop="description">
			<p><?php echo get_the_author_meta( 'description' ); ?></p>
		</div>
	</section>
<?php }

/*********************
PAGE NAVI
*********************/
function ck_pagination() {
	global $wp_query;
	$bignum = 999999999;
	if ( $wp_query->max_num_pages <= 1 ) return;
	echo '<nav class="pagination" aria-label="Page navigation">';
	echo paginate_links( array(
		'base'		=>	str_replace( $bignum, '%#%', esc_url( get_pagenum_link( $bignum ) ) ),
		'format'	=>	'',
		'current'	=>	max( 1, get_query_var( 'paged' ) ),
		'total'		=>	$wp_query->max_num_pages,
		'prev_text'	=>	'&laquo; Previous',
		'next_text'	=>	'Next &raquo;',
		'type'		=>	'list',
		'end_size'	=>	3,
		'mid_size'	=>	3
	) );
	echo '</nav>';
}

/*********************
COMMENTS CALLBACK
*********************/
function ck_comments( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment; ?>

	<li id="comment-<?php comment_ID() ?>" <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ) ?> itemscope itemprop itemtype="https://schema.org/UserComments">
		<article class="comment-body" itemscope itemprop="comment" itemtype="https://schema.org/Comment">
			<header class="comment-header">
				<p class="comment-author" itemscope itemprop="author" itemtype="https://schema.org/Person">
					<?php echo get_avatar( $comment, 70, '', '', [ 'class' => 'alignleft' ] ); ?>
					<?php printf( __( '<span class="name" itemprop="name">%s</span> <span class="says">says</span>' ), get_comment_author_link() ) ?>
				</p>

				<p class="comment-meta">
					<time class="comment-time" datetime="<?php the_time('Y-m-d'); ?>" itemprop="datePublished">
						<a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>" class="comment-time-link" itemprop="url"><?php printf( __( '%1$s at %2$s' ), get_comment_date(),  get_comment_time() ) ?></a>
					</time>
					<?php edit_comment_link( __('(Edit)'),'  ','' ); ?>
				</p>

				<?php if ( $comment->comment_approved == '0' ) : ?>
					<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'cuckoo' ) ?></p>
				<?php endif; ?>
			</header>

			<section class="comment-content" itemprop="text">
				<?php comment_text() ?>
			</section>

			<div class="comment-reply">
				<?php echo preg_replace( '/comment-reply-link/', 'comment-reply-link btn',
				get_comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ), 1); ?>
			</div>
		</article>
<?php }
