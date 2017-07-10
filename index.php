<?php get_header(); ?>

<main id="main" class="site-main" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

	<?php if ( have_posts() ) : ?>

		<?php get_template_part( 'inc/content' ); ?>

	<?php else : ?>

		<?php get_template_part( 'inc/not-found' ); ?>

	<?php endif; ?>

</main>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
