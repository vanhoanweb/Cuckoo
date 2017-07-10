<?php get_header(); ?>

<main id="main" class="site-main" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

	<article id="post-not-found" class="entry">

		<header class="entry-header">
			<h1><?php _e( 'Not Found, error 404', 'cuckoo' ); ?></h1>
		</header>

		<section class="entry-content">
			<p><?php _e( 'The page you are looking for no longer exists. Perhaps you can return back to <a href="'. home_url('/') .'">homepage</a> and see if you can find what you are looking for. Or, you can try finding it by using the search form below.', 'cuckoo' ); ?></p>
		</section>

		<section class="entry-search">
			<?php get_search_form(); ?>
		</section>

		<footer class="entry-footer">
			<h2>Sitemap</h2>

			<h4><?php _e( 'Pages', 'cuckoo' ); ?></h4>
			<ul><?php wp_list_pages( 'depth=&title_li=' ); ?></ul>

			<h4><?php _e( 'Categories', 'cuckoo' ); ?></h4>
			<ul><?php wp_list_categories( 'orderby=name&order=ASC&show_count=0&title_li=&depth=0' ); ?></ul>

			<h4><?php _e( 'Authors', 'cuckoo' ); ?></h4>
			<ul><?php wp_list_authors( array(
				'show_fullname'	=> 1,
				'optioncount'	=> 1,
				'orderby'		=> 'post_count',
				'order'			=> 'DESC',
				'number'		=> 10,
				'hide_empty'	=> 0,
				'echo'			=> 1,
				'exclude_admin'	=> 0
			) ); ?></ul>

			<h4><?php _e( 'Monthly', 'cuckoo' ); ?></h4>
			<ul><?php wp_get_archives( array( 'type' => 'monthly' ) ); ?></ul>

			<?php the_widget( 'WP_Widget_Recent_Posts', 'number=15', 'before_widget=&after_widget=&before_title=<h4>&after_title=</h4>' ); ?>
		</footer>

	</article>

</main>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
