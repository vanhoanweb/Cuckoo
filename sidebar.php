<aside class="sidebar sidebar-primary widget-area" role="complementary" aria-label="Primary Sidebar" itemscope="" itemtype="http://schema.org/WPSideBar">
	
	<?php if (is_active_sidebar('widgets_sidebar')) :
		dynamic_sidebar('widgets_sidebar');
	else : ?>

		<?php the_widget('WP_Widget_Search', '', 'before_widget=<section class="widget %s"><div class="widget-wrap">&after_widget=</div></section>'); ?>

		<?php the_widget('WP_Widget_Recent_Posts', '', 'before_widget=<section class="widget %s"><div class="widget-wrap">&after_widget=</div></section>&before_title=<h4 class="widget-title widgettitle">&after_title=</h4>'); ?>

		<?php the_widget('WP_Widget_Recent_Comments', '', 'before_widget=<section class="widget %s"><div class="widget-wrap">&after_widget=</div></section>&before_title=<h4 class="widget-title widgettitle">&after_title=</h4>'); ?>

		<?php the_widget('WP_Widget_Tag_Cloud', '', 'before_widget=<section class="widget %s"><div class="widget-wrap">&after_widget=</div></section>&before_title=<h4 class="widget-title widgettitle">&after_title=</h4>'); ?>		

		<section class="widget recent-posts">
			<div class="widget-wrap">
				<h4 class="widget-title widgettitle">Recent Posts</h4>
				<?php $args = array('posts_per_page' => 5);
				$recent_posts = new WP_Query($args);
				if($recent_posts->have_posts()):
					while ($recent_posts->have_posts()) : $recent_posts->the_post(); ?>
						<article <?php post_class('entry'); ?>>
							
							<?php if (has_post_thumbnail()) : ?>
							<a class="featured-image" href="<?php the_permalink(); ?>">
								<?php the_post_thumbnail(array(100,100), array('class' => 'entry-image')); ?>
							</a><?php endif; ?>

							<header class="entry-header">
								<h3 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
							</header>

							<p class="entry-meta">
								<span class="entry-time">
									<time itemprop="datePublished" datetime="<?php the_time('Y-m-d'); ?>" pubdate><?php the_time('F jS, Y'); ?></time>
								</span>
								<span class="entry-author" itemprop="author" itemscope="" itemtype="http://schema.org/Person">
									<em><?php _e('by ', 'zero-blank'); ?></em><?php the_author_posts_link(); ?>
								</span>
							</p>

						</article>
				<?php endwhile; endif;
				wp_reset_postdata(); ?>
			</div>
		</section>		

	<?php endif; ?>
	
</aside>
