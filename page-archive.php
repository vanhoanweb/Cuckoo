<?php
/*
 * Template Name: Archive Page
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
					<h4><?php _e('Pages:', 'zero-blank'); ?></h4>
					<ul><?php wp_list_pages('depth=&title_li='); ?></ul>

					<h4><?php _e('Categories:', 'zero-blank'); ?></h4>
					<ul><?php wp_list_categories('orderby=name&order=ASC&show_count=0&title_li=&depth=0'); ?></ul>

					<h4><?php _e('Authors:', 'zero-blank'); ?></h4>
					<ul><?php wp_list_authors(array(
						'show_fullname'	=> 1,
						'optioncount'	=> 1,
						'orderby'		=> 'post_count',
						'order'			=> 'DESC',
						'number'		=> 10,
						'hide_empty'	=> 0,
						'echo'			=> 1,
						'exclude_admin'	=> 0
					)); ?></ul>

					<h4><?php _e('Monthly:', 'zero-blank'); ?></h4>
					<ul><?php wp_get_archives(array('type' => 'monthly')); ?></ul>

					<h4><?php _e('Recent Posts:', 'zero-blank'); ?></h4>
					<?php $args = array('posts_per_page' => 10);
					$recent_posts = new WP_Query($args);
					if($recent_posts->have_posts()):
						echo '<ul>';
						while ($recent_posts->have_posts()) : $recent_posts->the_post();
							echo '<li><a href="'.get_the_permalink().'">'.get_the_title().'</a></li>';
						endwhile;
						echo '</ul>';
					endif;
					wp_reset_postdata(); ?>
				</div>

			</article>

		<?php endwhile; ?>

	<?php else : ?>
	
		<?php get_template_part('inc/not-found'); ?>
		
	<?php endif; ?>
	
</main>
	
<?php get_sidebar(); ?>

<?php get_footer(); ?>