<!DOCTYPE html> 
<html <?php language_attributes(); ?>>
<head <?php if (is_front_page() || is_home()) echo 'itemscope="" itemtype="http://schema.org/WebSite"'; ?>>	
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/x-icon" href="<?php echo get_template_directory_uri(); ?>/images/favicon.ico">
	
	<?php wp_head(); ?>

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->	
</head>
<body <?php body_class(); ?> itemscope="" itemtype="http://schema.org/WebPage">
	
	<div class="site-container">
		
		<header class="site-header" itemscope="" itemtype="http://schema.org/WPHeader">
			<div class="wrap">
				<div class="title-area">
					<?php if (is_front_page() || is_home()) : ?>
						<h1 class="site-title"><a href="<?php echo home_url('/'); ?>"><?php bloginfo('name'); ?></a></h1>
					<?php else: ?>
						<p class="site-title"><a href="<?php echo home_url('/'); ?>"><?php bloginfo('name'); ?></a></p>
					<?php endif; ?>

					<p class="site-description"><?php bloginfo('description'); ?></p>
				</div>
			</div>			
		</header>

		<nav class="nav-primary" itemscope="" itemtype="http://schema.org/SiteNavigationElement" aria-label="Main navigation">
			<div class="wrap">
				<?php if (has_nav_menu('primary-navigation')) :
				wp_nav_menu(array(
					'menu_class'	=>	'menu zb-nav-menu',
					'container'		=>	'',
					'theme_location'=>	'primary-navigation'
				)); endif; ?>
			</div>
		</nav>

		<div class="site-inner">
			<div class="content-sidebar-wrap">
