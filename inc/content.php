<?php while (have_posts()) : the_post(); ?>
	
	<article <?php post_class('entry'); ?> itemscope="" itemtype="http://schema.org/CreativeWork">

		<?php if (has_post_thumbnail()) : ?>
		<a class="entry-image-link" href="<?php the_permalink(); ?>">
			<?php the_post_thumbnail('large', array('class' => 'entry-image')); ?>
		</a><?php endif; ?>

		<header class="entry-header">
			<?php if (is_singular()): ?>
				<h1 class="entry-title" itemprop="headline"><?php the_title(); ?></h1>
			<?php else : ?>
				<h2 class="entry-title" itemprop="headline"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
			<?php endif; ?>

			<?php if (get_post_type() == 'post'): ?>
			<p class="entry-meta">
				<span class="entry-time">
					<em><?php _e('Posted on ', 'zero-blank'); ?></em><time itemprop="datePublished" datetime="<?php the_time('Y-m-d'); ?>" pubdate><?php the_time('F jS, Y'); ?></time>
				</span>
				<span class="entry-author" itemprop="author" itemscope="" itemtype="http://schema.org/Person">
					<em><?php _e('Written by ', 'zero-blank'); ?></em><?php the_author_posts_link(); ?>
				</span>
				<?php if (comments_open(get_the_ID())): ?>
					<span class="entry-comments-link"><?php comments_popup_link('Leave a comment', '1 comment', '% comments', '', 'Comments disabled'); ?></span>
				<?php endif; ?>
				<?php edit_post_link('Edit this &raquo;', '<span class="entry-edit">', '</span>'); ?>
			</p>
			<?php endif; ?>
		</header>

		<div class="entry-content" itemprop="text">
			<?php if (is_singular()): ?>
				<?php the_content(); ?>
			<?php else : ?>
				<?php the_excerpt(); ?>
			<?php endif; ?>
		</div>

		<?php if (get_post_type() == 'post'): ?>
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
