<!DOCTYPE html>
<html>
<head>
	<meta charset='utf-8'>
	<meta http-equiv='X-UA-Compatible' content='IE=edge'>
	<title>Phast - Home page</title>
	<meta name='viewport' content='width=device-width, initial-scale=1'>
	<meta name='robots' content="noindex, nofollow">
	<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon.ico" />
	<link rel='stylesheet' type='text/css' media='screen' href='<?php echo get_stylesheet_uri()   ?>'>
	<!-- <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet"> -->
	<script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/js/jquery.min.js"></script>
	 <?php  wp_head(); ?> 
</head>
<body class="home">
	<header id="site-header">
		<div class="header-top-bar">
			<div class="wrapper">
				<div class="d-flex justify-content-between">
					<nav id="top-left-nav">
						<ul>
							<li><a href="#">Établissements de santé</a></li>
							<li><a href="#">Éditeur</a></li>
						</ul>
					</nav>
					<nav id="lang-switcher">
						<ul>
							<li class="current-lang"><a href="#">FR</a></li>
							<li><a href="#">EN</a></li>
						</ul>
					</nav>
				</div>
			</div>
		</div>
		<div id="main-navigation">
			<div >
				<div class="d-grid main-navigation--inner">				
					<?php if ( function_exists( 'the_custom_logo' ) ) {
							the_custom_logo();
					} ?>											
					<?php wp_nav_menu( [ 'container' => 'nav', 'container_class' => 'main-navigation--menu', 'menu_id' => 'headermenu', 'theme_location'  => 'primary' ] ) ?> 

				</div>
			</div>
		</div>
	</header>