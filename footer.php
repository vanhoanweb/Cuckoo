			</div>
		</div><!-- /.site-inner -->

		<div class="footer-widgets">
			<div class="wrap">
				<div class="footer-widgets-1 widget-area">
					<?php if (is_active_sidebar('footer-sidebar-1')) :
						dynamic_sidebar('footer-sidebar-1');
					else :
						the_widget('WP_Widget_Categories', '', 'before_widget=<section class="widget %s"><div class="widget-wrap">&after_widget=</div></section>&before_title=<h4 class="widget-title widgettitle">&after_title=</h4>');
					endif; ?>
				</div>

				<div class="footer-widgets-2 widget-area">
					<?php if (is_active_sidebar('footer-sidebar-2')) :
						dynamic_sidebar('footer-sidebar-2');
					else :
						the_widget('WP_Widget_Archives', '', 'before_widget=<section class="widget %s"><div class="widget-wrap">&after_widget=</div></section>&before_title=<h4 class="widget-title widgettitle">&after_title=</h4>');
					endif; ?>
				</div>

				<div class="footer-widgets-3 widget-area">
					<?php if (is_active_sidebar('footer-sidebar-3')) :
						dynamic_sidebar('footer-sidebar-3');
					else :
						the_widget('WP_Widget_Pages', '', 'before_widget=<section class="widget %s"><div class="widget-wrap">&after_widget=</div></section>&before_title=<h4 class="widget-title widgettitle">&after_title=</h4>');
					endif; ?>
				</div>
			</div>
		</div>

		<footer class="site-footer" role="contentinfo" itemscope="" itemtype="http://schema.org/WPFooter">
			<div class="wrap">
				<p class="site-info">&copy; <?php echo date('Y') ?> <a href="<?php echo home_url('/'); ?>" rel="home"><?php bloginfo('name'); ?></a>
				&bull; <a href="<?php bloginfo('rss2_url'); ?>"><?php _e('Entries (RSS)', 'zero-blank'); ?></a>
				&bull; <a href="<?php bloginfo('comments_rss2_url'); ?>"><?php _e('Comments (RSS)', 'zero-blank'); ?></a></p>
			</div>			
		</footer>

		<a class="scroll-top" href="#top"></a>
		
	</div><!-- /.site-container -->
	
	<?php wp_footer(); ?>
	
	</body>
</html>
