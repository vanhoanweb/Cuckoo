<?php get_header(); ?>

<section id="content" role="main">
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	<?php get_template_part( 'entry' ); ?>
	<?php if ( ! post_password_required() ) comments_template( '', true ); ?>
	<?php endwhile; endif; ?>

	<footer class="footer">
		<nav id="nav-below" class="navigation" role="navigation">
			<div class="nav-previous"><?php previous_post_link( '%link', '<span class="meta-nav">&larr;</span> %title' ); ?></div>
			<div class="nav-next"><?php next_post_link( '%link', '%title <span class="meta-nav">&rarr;</span>' ); ?></div>
		</nav>
	</footer>
</section>

<?php get_sidebar(); ?>

<?php get_footer(); ?>