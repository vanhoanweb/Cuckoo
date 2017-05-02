<aside class="sidebar sidebar-primary widget-area">
	
	<?php if (is_active_sidebar('widgets_sidebar')) :
		
		dynamic_sidebar('widgets_sidebar'); 
		
	else : ?>

		<?php the_widget('WP_Widget_Search', '', 'before_widget=<section class="widget %s"><div class="widget-wrap">&after_widget=</div></section>'); ?>

		<?php the_widget('WP_Widget_Recent_Posts', '', 'before_widget=<section class="widget %s"><div class="widget-wrap">&after_widget=</div></section>&before_title=<h4 class="widget-title widgettitle">&after_title=</h4>'); ?>

		<?php the_widget('WP_Widget_Recent_Comments', '', 'before_widget=<section class="widget %s"><div class="widget-wrap">&after_widget=</div></section>&before_title=<h4 class="widget-title widgettitle">&after_title=</h4>'); ?>

		<?php the_widget('WP_Widget_Tag_Cloud', '', 'before_widget=<section class="widget %s"><div class="widget-wrap">&after_widget=</div></section>&before_title=<h4 class="widget-title widgettitle">&after_title=</h4>'); ?>		

		<?php $args = array('posts_per_page' => 5);
		$the_query = new WP_Query($args);
		if($the_query->have_posts()):
			echo '<ul>';
			while ($the_query->have_posts()) : $the_query->the_post();
				echo '<li><a href="'.get_the_permalink().'">'.get_the_post_thumbnail($post_id, array(100,100), array('class' => 'entry-image')).' '.get_the_title().'</a></li>';
			endwhile;
			echo '</ul>';
		endif;
		wp_reset_postdata(); ?>

	<?php endif; ?>
	
</aside>