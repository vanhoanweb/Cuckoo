<?php get_header(); ?>

<section id="content" role="main">
	<?php if ( have_posts() ) : ?>
		<header class="header">
			<h1 class="entry-title"><?php printf( __( 'Search Results for: %s', 'zeroblank' ), get_search_query() ); ?></h1>
		</header>

		<?php while ( have_posts() ) : the_post(); ?>
			<?php get_template_part( 'entry' ); ?>
		<?php endwhile; ?>

		<?php zeroblank_pagenavi(); ?>
	<?php else : ?>
		<article id="post-0" class="post no-results not-found">
			<header class="header">
				<h2 class="entry-title"><?php _e( 'Nothing Found', 'zeroblank' ); ?></h2>
			</header>

			<section class="entry-content">
				<p><?php _e( 'Sorry, nothing matched your search. Please try again.', 'zeroblank' ); ?></p>
				<?php get_search_form(); ?>
			</section>
		</article>
	<?php endif; ?>
</section>

<?php get_sidebar(); ?>

<?php get_footer(); ?>