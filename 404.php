<?php get_header(); ?>

<main id="content" role="main">
	<article id="post-0" class="post not-found">
		<header class="entry-header">
			<h1 class="entry-title"><?php _e( 'Not Found', 'zb' ); ?></h1>
		</header>

		<section class="entry-content">
			<p><?php _e( 'Nothing found for the requested page. Try a search instead', 'zb' ); ?></p>
			<?php get_search_form(); ?>
		</section>
	</article>
</main>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
