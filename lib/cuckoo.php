<?php
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
