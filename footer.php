			</div>
		</div><!-- /.site-inner -->

		<div class="footer-widgets">
			<div class="wrap">
				<div class="footer-widgets-1 widget-area">
					<?php the_widget('WP_Widget_Categories', '', 'before_widget=<section class="widget %s"><div class="widget-wrap">&after_widget=</div></section>&before_title=<h4 class="widget-title widgettitle">&after_title=</h4>'); ?>
				</div>
				<div class="footer-widgets-2 widget-area">
					<?php the_widget('WP_Widget_Archives', '', 'before_widget=<section class="widget %s"><div class="widget-wrap">&after_widget=</div></section>&before_title=<h4 class="widget-title widgettitle">&after_title=</h4>'); ?>
				</div>
				<div class="footer-widgets-3 widget-area">
					<?php the_widget('WP_Widget_Pages', '', 'before_widget=<section class="widget %s"><div class="widget-wrap">&after_widget=</div></section>&before_title=<h4 class="widget-title widgettitle">&after_title=</h4>'); ?>
				</div>
			</div>
		</div>

		<footer class="site-footer" itemscope="" itemtype="http://schema.org/WPFooter">
			<div class="wrap">
				<p>&copy; <?php echo date('Y') .' '. get_bloginfo('name'); ?>
				&bull; <a href="<?php bloginfo('rss2_url'); ?>"><?php _e('Entries (RSS)', 'zero-blank'); ?></a>
				&bull; <a href="<?php bloginfo('comments_rss2_url'); ?>"><?php _e('Comments (RSS)', 'zero-blank'); ?></a></p>
			</div>			
		</footer>
		
	</div><!-- /.site-container -->
	
	<?php wp_footer(); ?>
	
	</body>
</html>
