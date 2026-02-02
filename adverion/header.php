<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package adverion
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
        <a class="skip-link screen-reader-text"
            href="#primary"><?php esc_html_e( 'Skip to content', 'adverion' ); ?></a>

        <header id="masthead" class="site-header">
            <nav class="navbar">
                <div class="nav-container">
                    <div class="nav-logo">
                        <?php 
                        if (function_exists('the_custom_logo')) {
                            the_custom_logo();
                        } else {
                            // Fallback to site title if no custom logo
                            echo '<a href="' . esc_url(home_url('/')) . '" class="site-title">' . get_bloginfo('name') . '</a>';
                        }
                        ?>
                    </div>
                    <div class="nav-menu">
                        <?php
                        wp_nav_menu(
                            array(
                                'theme_location' => 'primary',
                                'menu_id'        => 'nav-menu',
                                'menu_class'     => 'nav-links',
                                'container'      => false,
                                'fallback_cb'    => 'adverion_fallback_menu',
                                'walker'         => new Adverion_Nav_Walker()
                            )
                        );
                        ?>
                    </div>
                    <div class="nav-toggle">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </div>
            </nav>
        </header><!-- #masthead -->