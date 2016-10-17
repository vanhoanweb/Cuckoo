<?php get_header(); ?>

<main id="content" role="main">
	<?php if ( have_posts() ) : ?>
		<header class="entry-header">
			<h1 class="entry-title"><?php printf( __( 'Search Results for: %s', 'zb' ), get_search_query() ); ?></h1>
		</header>

		<?php while ( have_posts() ) : the_post(); ?>
			<?php get_template_part( 'entry' ); ?>
		<?php endwhile; ?>

		<?php get_template_part('pagination'); ?>
	<?php else : ?>
		<article id="post-0" class="post no-results not-found">
			<header class="entry-header">
				<h2 class="entry-title"><?php _e( 'Nothing Found', 'zb' ); ?></h2>
			</header>

			<section class="entry-content">
				<p><?php _e( 'Sorry, nothing matched your search. Please try again.', 'zb' ); ?></p>
				<?php get_search_form(); ?>
			</section>
		</article>
	<?php endif; ?>
</main>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
