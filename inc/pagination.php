<?php if (is_singular('post')) : ?>

	<div class="adjacent-entry-pagination pagination">
		<?php previous_post_link('<div class="pagination-previous alignleft">%link</div>', '&larr; %title'); ?>
		<?php next_post_link('<div class="pagination-next alignright">%link</div>', '%title &rarr;'); ?>
	</div>

	<section class="author-box" itemprop="author" itemscope="" itemtype="http://schema.org/Person">
		<div class="author-box-avatar">
			<?php echo get_avatar(get_the_author_meta('user_email'), 90, '', '', ['class' => 'alignleft']); ?>
		</div>		
		<h3 class="author-box-title">
			<?php _e('About ', 'zero-blank'); ?>
			<a class="author-box-link" href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>" rel="author">
				<span itemprop="name"><?php echo get_the_author(); ?></span></a>
		</h3>
		<div class="author-box-content" itemprop="description">
			<p><?php the_author_meta('description'); ?></p>
		</div>
	</section>

	<?php comments_template(); ?>

<?php elseif (get_next_posts_link() || get_previous_posts_link()) :

	zb_pagination();

endif; ?>
