<?php get_header(); ?>

<main id="main" class="site-main" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

	<?php if ( have_posts() ) : ?>

		<section class="archive-box">

			<?php the_archive_title( '<h1 class="archive-title">', '</h1>' );

			the_archive_description( '<div class="archive-description">', '</div>' ); ?>

		</section>

		<?php get_template_part( 'inc/content' ); ?>

	<?php else : ?>

		<?php get_template_part( 'inc/not-found' ); ?>

	<?php endif; ?>

</main>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
