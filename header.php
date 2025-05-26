<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package dlkadvisory
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'dlkadvisory' ); ?></a>

	<header id="masthead" class="site-header">
	<div class="container">
			<div class="row align-items-center">
				<div class="col-left site-branding">
					<?php the_custom_logo(); ?>
				</div>
				<div class="col-right">
					<nav id="site-navigation" class="main-navigation">
						<div class="menu-close text-start">
							<img src="<?php echo get_template_directory_uri(''); ?>/assets/images/close.png" alt="BMF Close">
						</div>
						<?php
						wp_nav_menu(
							array(
								'theme_location' => 'menu-1',
								'menu_id'        => 'primary-menu',
								'menu_class'     => 'menu',
							)
						);
						?>
					</nav><!-- #site-navigation -->
					<div class="menu-icon">
						<img src="<?php echo get_template_directory_uri(''); ?>/assets/images/menu.svg" alt="Serbfashion Menu">
					</div>
				</div>
			</div>
		</div>
		<div class="draw-back"></div>
	</header><!-- #masthead -->
