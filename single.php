<?php get_header(); ?>
	
<main class="site-main" role="main">

	<div class="breadcrumb" itemscope="" itemtype="https://schema.org/BreadcrumbList"><?php zb_breadcrumb(); ?></div>

	<?php if (have_posts()) : ?>
	
		<?php get_template_part('inc/content'); ?>

	<?php else : ?>
	
		<?php get_template_part('inc/not-found'); ?>
		
	<?php endif; ?>
	
</main>
	
<?php get_sidebar(); ?>

<?php get_footer(); ?>
