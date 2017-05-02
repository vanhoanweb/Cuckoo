<?php get_header(); ?>

<main class="content">

	<?php if (have_posts()) : ?>
	
		<?php get_template_part('inc/content'); ?>

	<?php else : ?>
	
		<?php get_template_part('inc/not-found'); ?>
		
	<?php endif; ?>
	
</main>
	
<?php get_sidebar(); ?>

<?php get_footer(); ?>