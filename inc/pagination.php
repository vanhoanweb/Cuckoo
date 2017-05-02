<?php if (is_singular()) : ?>

	<div class="adjacent-entry-pagination pagination">	
		<?php previous_post_link('<div class="pagination-previous alignleft">%link</div>', '&larr; %title'); ?>	
		<?php next_post_link('<div class="pagination-next alignright">%link</div>', '%title &rarr;'); ?>	
	</div>

	<section class="author-box">
		<div class="author-box-avatar">
			<?php echo get_avatar(get_the_author_meta('user_email') , 90); ?>
		</div>		
		<h4 class="author-box-title">
			<?php _e('About ', 'zero-blank'); ?><?php the_post(); echo get_the_author(); rewind_posts(); ?>
		</h4>
		<div class="author-box-content"><p><?php the_author_meta('description'); ?></p></div>
	</section>

<?php elseif (get_next_posts_link() || get_previous_posts_link()) :

	zb_pagination();

endif; ?>