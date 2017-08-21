<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head <?php if ( is_front_page() || is_home() ) echo 'itemscope itemtype="http://schema.org/WebSite"'; ?>>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta http-equiv="x-ua-compatible" content="ie=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta name="robots" content="noindex, nofollow" />

	<link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/apple-touch-icon.png" />
	<!-- Place favicon.ico in the root directory -->

	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?> itemscope itemtype="<?php echo ( is_search() ) ? 'http://schema.org/SearchResultsPage' : 'http://schema.org/WebPage'; ?>">
	<!--[if lte IE 9]>
		<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
	<![endif]-->

	<div class="site-container">

		<header id="header" class="site-header" role="banner" itemscope itemtype="http://schema.org/WPHeader">
			<div class="wrap">
				<div class="title-area">
					<?php if ( is_front_page() || is_home() ) : ?>
						<h1 class="site-title" itemscope itemtype="http://schema.org/Organization"><a href="<?php echo home_url( '/' ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<?php else : ?>
						<p class="site-title" itemscope itemtype="http://schema.org/Organization"><a href="<?php echo home_url( '/' ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
					<?php endif;

					$description = get_bloginfo( 'description', 'display' );
					if ( $description || is_customize_preview() ) : ?>
						<p class="site-description"><?php echo $description; ?></p>
					<?php endif; ?>
				</div>
			</div>
		</header>

		<nav class="nav-primary" aria-label="Main navigation" role="navigation" itemscope itemtype="http://schema.org/SiteNavigationElement">
			<div class="wrap">
				<?php if ( has_nav_menu( 'primary-navigation' ) ) :
				wp_nav_menu( array(
					'menu_class'		=>	'menu',
					'container'			=>	'',
					'theme_location'	=>	'primary-navigation',
					'items_wrap'		=>	'<ul id="%1$s" class="%2$s"><li class="menu-item home"><a href="'. home_url( '/' ) .'" rel="home">Home</a></li>%3$s</ul>'
				) ); endif; ?>
			</div>
		</nav>

		<div class="site-inner">
			<div class="content-sidebar-wrap">
