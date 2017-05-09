<?php
/*
 * Template Name: Landing Page
 */
get_header(); ?>
	
<main class="content">

	<?php if (have_posts()) : ?>
	
		<?php while (have_posts()) : the_post(); ?>
	
			<article <?php post_class('entry'); ?> itemscope="" itemtype="http://schema.org/CreativeWork">

				<header class="entry-header">
					<h1 class="entry-title" itemprop="headline"><?php the_title(); ?></h1>
				</header>

				<div class="entry-content" itemprop="text">
					<?php the_content(); ?>
				</div>

			</article>

		<?php endwhile; ?>

	<?php else : ?>
	
		<?php get_template_part('inc/not-found'); ?>
		
	<?php endif; ?>

</main>

<?php get_footer(); ?>