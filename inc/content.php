<?php while (have_posts()) : the_post(); ?>

	<article id="post-<?php the_ID(); ?>" <?php post_class( 'entry' ); ?> role="article"
	<?php if ( is_singular() ) : ?> itemscope <?php echo ( is_page() ) ? 'itemtype="http://schema.org/BlogPosting"' : 'itemprop="blogPost" itemtype="http://schema.org/BlogPosting"'; ?>
	<?php endif; ?>>

		<?php if ( has_post_thumbnail() ) : ?>
		<figure class="entry-image">
			<a href="<?php the_permalink(); ?>">
				<?php the_post_thumbnail( 'large', array( 'class' => 'aligncenter' ) ); ?>
			</a>
		</figure><?php endif; ?>

		<header class="entry-header">
			<?php if ( is_singular() ) : ?>
				<h1 class="entry-title" itemprop="headline" rel="bookmark"><?php the_title(); ?></h1>
			<?php else : ?>
				<h2 class="entry-title" itemprop="headline"><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
			<?php endif; ?>

			<?php if ( get_post_type() == 'post' ) : ?>
			<p class="entry-meta">
				<span class="entry-author" itemscope itemprop="author" itemtype="http://schema.org/Person">
					<em><?php _e( 'By ', 'cuckoo' ); ?></em><?php the_author_posts_link(); ?>
				</span>

				<span class="entry-categories">
					<?php _e( 'In: ', 'cuckoo' ); ?><?php the_category( ', ' ); ?>
				</span>

				<span class="entry-time">
					<em><?php _e( 'Posted on ', 'cuckoo' ); ?></em><time itemprop="datePublished" pubdate datetime="<?php the_time( 'Y-m-d' ); ?>"><?php echo get_the_time( get_option( 'date_format' ) ); ?></time>
				</span>

				<?php if ( comments_open(get_the_ID()) ) : ?>
					<span class="entry-comments-link"><?php comments_popup_link( 'Leave a comment', '1 comment', '% comments', '', 'Comments disabled' ); ?></span>
				<?php endif; ?>
				<?php edit_post_link( 'Edit this &raquo;', '<span class="entry-edit">', '</span>' ); ?>
			</p>
			<?php endif; ?>
		</header>

		<section class="entry-content"
			<?php if ( is_singular() ) : ?> itemprop="articleBody">
				<?php the_content(); // do_shortcode('[post_share position="bottom"]'); ?>
			<?php else : ?>>
				<?php the_excerpt(); ?>
			<?php endif; ?>
		</section>

		<?php if ( get_post_type() == 'post' ) : ?>
		<footer class="entry-footer">
			<p class="entry-meta">
				<span class="entry-categories"><?php _e( 'Filed Under: ', 'cuckoo' ); ?><?php the_category( ', ' ); ?></span>
				<span class="entry-tags"><?php the_tags( 'Tagged With: ' ); ?></span>
			</p>
		</footer>
		<?php endif; ?>

	</article>

<?php endwhile; ?>

<?php if ( is_singular() && get_post_type() == 'post' ) :

	// ck_related_posts(); ck_author_box(); ?>

	<nav class="post-nav clearfix" aria-label="Page navigation">
		<?php previous_post_link( '<div class="prev-post alignleft"><p>&larr; Prev Post</p><h5>%link</h5></div>', '%title' ); ?>
		<?php next_post_link( '<div class="next-post alignright"><p>Next Post &rarr;</p><h5>%link</h5></div>', '%title' ); ?>
	</nav>

	<?php comments_template(); ?>

<?php elseif ( get_next_posts_link() || get_previous_posts_link() ) :

	ck_pagination();

endif; ?>
