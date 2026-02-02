<?php
/**
 * Custom functions for the Adverion theme
 *
 * @package adverion
 */

/**
 * Fallback menu function when no menu is assigned.
 */
function adverion_fallback_menu() {
	if ( current_user_can( 'edit_theme_options' ) ) {
		?>
<ul id="nav-menu" class="nav-links">
    <li><a
            href="<?php echo esc_url( admin_url( 'nav-menus.php' ) ); ?>"><?php esc_html_e( 'Add a menu', 'adverion' ); ?></a>
    </li>
</ul>
<?php
	} else {
		?>
<ul id="nav-menu" class="nav-links">
    <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'adverion' ); ?></a></li>
    <?php if ( get_option( 'page_for_posts' ) ) : ?>
    <li><a
            href="<?php echo esc_url( get_permalink( get_option( 'page_for_posts' ) ) ); ?>"><?php esc_html_e( 'Blog', 'adverion' ); ?></a>
    </li>
    <?php endif; ?>
    <li><a href="<?php echo esc_url( home_url( '/contact' ) ); ?>"
            class="nav-cta"><?php esc_html_e( 'Contact', 'adverion' ); ?></a></li>
</ul>
<?php
	}
}

/**
 * Custom Walker for styling the last menu item as a button
 */
class Adverion_Nav_Walker extends Walker_Nav_Menu {
	private $last_item_id = null;
	
	function __construct() {
		// Get the menu items to find the last one
		$locations = get_nav_menu_locations();
		if (isset($locations['primary'])) {
			$menu = wp_get_nav_menu_object($locations['primary']);
			if ($menu) {
				$menu_items = wp_get_nav_menu_items($menu->term_id);
				if ($menu_items && !empty($menu_items)) {
					$last_item = end($menu_items);
					$this->last_item_id = $last_item->ID;
				}
			}
		}
	}
	
	function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
		$classes = empty($item->classes) ? array() : (array) $item->classes;
		$classes[] = 'menu-item-' . $item->ID;
		
		// Check if this is the last menu item
		if ($this->last_item_id && $item->ID == $this->last_item_id) {
			$classes[] = 'menu-item-last';
		}
		
		$class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args, $depth));
		$class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';
		
		$id = apply_filters('nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args, $depth);
		$id = $id ? ' id="' . esc_attr($id) . '"' : '';
		
		$output .= '<li' . $id . $class_names .'>';
		
		$attributes = ! empty($item->attr_title) ? ' title="'  . esc_attr($item->attr_title) .'"' : '';
		$attributes .= ! empty($item->target)     ? ' target="' . esc_attr($item->target)     .'"' : '';
		$attributes .= ! empty($item->xfn)        ? ' rel="'    . esc_attr($item->xfn)        .'"' : '';
		$attributes .= ! empty($item->url)        ? ' href="'   . esc_attr($item->url)        .'"' : '';
		
		// Add button class to last menu item
		$item_output = $args->before;
		if ($this->last_item_id && $item->ID == $this->last_item_id) {
			$item_output .= '<a'. $attributes .' class="nav-cta">';
		} else {
			$item_output .= '<a'. $attributes .'>';
		}
		$item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
		$item_output .= '</a>';
		$item_output .= $args->after;
		
		$output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
	}
}

/**
 * Handle newsletter subscription
 */
function adverion_newsletter_subscribe() {
    if (isset($_POST['email']) && !empty($_POST['email'])) {
        $email = sanitize_email($_POST['email']);
        
        if (!is_email($email)) {
            wp_redirect(add_query_arg('newsletter', 'invalid', wp_get_referer()));
            exit;
        }
        
        // Here you can integrate with your email service (Mailchimp, SendGrid, etc.)
        // For now, we'll just store it as a transient or send admin email
        
        // Option 1: Send email to admin
        $subject = 'New Newsletter Subscription';
        $message = "New subscriber email: " . $email;
        wp_mail(get_option('admin_email'), $subject, $message);
        
        // Option 2: Store in database (you might want to create a custom table)
        // For demonstration, we'll use a transient
        $subscribers = get_transient('newsletter_subscribers') ?: array();
        $subscribers[] = array(
            'email' => $email,
            'date' => current_time('mysql')
        );
        set_transient('newsletter_subscribers', $subscribers, DAY_IN_SECONDS * 30);
        
        wp_redirect(add_query_arg('newsletter', 'success', wp_get_referer()));
        exit;
    }
    
    wp_redirect(add_query_arg('newsletter', 'error', wp_get_referer()));
    exit;
}
add_action('admin_post_nopriv_newsletter_subscribe', 'adverion_newsletter_subscribe');
add_action('admin_post_newsletter_subscribe', 'adverion_newsletter_subscribe');