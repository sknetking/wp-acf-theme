<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package adverion
 */

?>

<footer class="footer">
    <div class="container">
        <div class="footer-content">
            <div class="footer-brand">
                <?php 
					if (function_exists('the_custom_logo')) {
						the_custom_logo();
					} else {
						// Fallback to site title if no custom logo
						echo '<a href="' . esc_url(home_url('/')) . '" class="site-title">' . get_bloginfo('name') . '</a>';
					}
					?>
                <p><?php echo wp_kses_post(get_field('footer_description', 'option') ?: 'Data-driven digital marketing for enterprise growth.'); ?>
                </p>
            </div>
            <div class="footer-links">
                <div class="footer-column">
                    <h4><?php echo esc_html(get_field('services_title', 'option') ?: 'Services'); ?></h4>
                    <?php
						wp_nav_menu(
							array(
								'theme_location' => 'footer-services',
								'menu_class'     => 'footer-services-menu',
								'container'      => false,
								'fallback_cb'    => false
							)
						);
						?>
                </div>
                <div class="footer-column">
                    <h4><?php echo esc_html(get_field('company_title', 'option') ?: 'Company'); ?></h4>
                    <?php
						wp_nav_menu(
							array(
								'theme_location' => 'footer-company',
								'menu_class'     => 'footer-company-menu',
								'container'      => false,
								'fallback_cb'    => false
							)
						);
						?>
                </div>
                <div class="footer-column">
                    <h4><?php echo esc_html(get_field('newsletter_title', 'option') ?: 'Stay Updated'); ?></h4>
                    <p><?php echo esc_html(get_field('newsletter_description', 'option') ?: 'Subscribe to our newsletter for the latest updates and insights.'); ?>
                    </p>
                    <form class="newsletter-form" method="post"
                        action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
                        <input type="hidden" name="action" value="newsletter_subscribe">
                        <input type="email" name="email"
                            placeholder="<?php esc_attr_e('Enter your email', 'adverion'); ?>" required>
                        <button type="submit"
                            class="newsletter-btn"><?php esc_html_e('Subscribe', 'adverion'); ?></button>
                    </form>
                    <?php if (get_field('show_contact_info', 'option')): ?>
                    <div class="contact-info">
                        <p><strong><?php esc_html_e('Email:', 'adverion'); ?></strong>
                            <?php echo esc_html(get_field('contact_email', 'option') ?: get_option('admin_email')); ?>
                        </p>
                        <p><strong><?php esc_html_e('Phone:', 'adverion'); ?></strong>
                            <?php echo esc_html(get_field('contact_phone', 'option')); ?></p>
                    </div>
                    <?php endif; ?>
                </div>

            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; <?php echo date('Y'); ?> <?php echo esc_html(get_bloginfo('name')); ?>.
                <?php echo esc_html(get_field('copyright_text', 'option') ?: 'All rights reserved.'); ?></p>
        </div>
    </div>
</footer>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>

</html>