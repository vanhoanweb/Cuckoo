<?php if (is_singular('post')) :

	zb_author_box(); ?>

	<div class="adjacent-entry-pagination pagination">
		<?php previous_post_link('<div class="pagination-previous alignleft">%link</div>', '&larr; %title'); ?>
		<?php next_post_link('<div class="pagination-next alignright">%link</div>', '%title &rarr;'); ?>
	</div>

	<?php comments_template(); ?>

<?php elseif (get_next_posts_link() || get_previous_posts_link()) :

	zb_pagination();

endif; ?>
