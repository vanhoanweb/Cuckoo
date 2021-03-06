<?php get_header(); ?>

<main id="main" class="site-main" role="main">

	<div class="archive-description">

		<h1 class="archive-title"><?php _e( 'Search Results for: ', 'cuckoo' ); ?><?php the_search_query(); ?></h1>

	</div>

	<?php if ( have_posts() ) : ?>

		<?php get_template_part( 'inc/content' ); ?>

	<?php else : ?>

		<?php get_template_part( 'inc/not-found' ); ?>

	<?php endif; ?>

</main>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
