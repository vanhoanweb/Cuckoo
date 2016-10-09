<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header>
		<?php if ( is_singular() ) { echo '<h1 class="entry-title">'; } else { echo '<h2 class="entry-title"><a href="'. get_permalink() .'" title="'. get_the_title() .'" rel="bookmark">'; } ?><?php the_title(); ?><?php if ( is_singular() ) { echo '</h1>'; } else { echo '</a></h2>'; } ?>
		<?php if ( !is_search() ) get_template_part( 'entry', 'meta' ); ?>
	</header>

	<?php get_template_part( 'entry', ( is_singular() ? 'content' : 'summary' ) ); ?>
	<?php if ( !is_search() ) get_template_part( 'entry-footer' ); ?>
</article>
