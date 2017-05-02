<?php while (have_posts()) : the_post(); ?>
	
	<article <?php post_class('entry'); ?>>

		<?php if (has_post_thumbnail()) {
			echo '<a href="'.get_the_permalink().'" class="alignnone">';
			the_post_thumbnail('large', array('class' => 'entry-image'));
			echo '</a>';
		} ?>

		<header class="entry-header">
			<?php if (is_singular()): ?>
				<h1 class="entry-title"><?php the_title(); ?></h1>
			<?php else : ?>
				<h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
			<?php endif; ?>

			<p class="entry-meta">
				<span class="posted-on">
					<em><?php _e('Posted on ', 'zero-blank'); ?></em><time class="entry-time" datetime="<?php the_time('Y-m-d'); ?>" pubdate><?php the_time('F jS, Y'); ?></time>
				</span>
				<span class="byline">
					<em><?php _e('Written by ', 'zero-blank'); ?></em><?php the_author_posts_link(); ?>
				</span>
				<?php if (comments_open(get_the_ID())): ?>
					<span class="entry-comments-link"><?php comments_popup_link('Leave a comment', '1 comment', '% comments', 'comments-link', 'Comments disabled'); ?></span>
				<?php endif; ?>
				<?php edit_post_link('Edit this &raquo;', '<span class="edit-link">', '</span>'); ?>
			</p>
		</header>

		<div class="entry-content">
			<?php if (is_singular()): ?>
				<?php the_content(); ?>
			<?php else : ?>
				<?php the_excerpt(); ?>
			<?php endif; ?>
		</div>

		<?php if (get_post()->post_type == 'post'): ?>
			<footer class="entry-footer">
				<p class="entry-meta">
					<span class="entry-categories"><?php _e('Filed Under: ', 'zero-blank'); ?><?php the_category(', '); ?></span>
					<span class="entry-tags"><?php the_tags('Tagged With: '); ?></span>
				</p>
			</footer>
		<?php endif; ?>

	</article>

<?php endwhile; ?>

<?php get_template_part('inc/pagination'); ?>

<?php if (is_singular()) comments_template(); ?>