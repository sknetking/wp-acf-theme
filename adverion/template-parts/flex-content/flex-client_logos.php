<?php
/**
 * Client Logos Section Template
 * ACF Flexible Content Layout: client_logos
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

// Get ACF fields
$section_title = get_sub_field('section_title');
$logos = get_sub_field('logos');
?>

<section class="client-trust">
    <div class="container">
        <?php if ($section_title): ?>
        <div class="trust-header">
            <p><?php echo esc_html($section_title); ?></p>
        </div>
        <?php endif; ?>

        <?php if ($logos && !empty($logos)): ?>
        <div class="client-logos-slider">
            <div class="client-logos-wrapper">
                <?php foreach ($logos as $logo): ?>
                <div class="client-logo-slide">
                    <div class="client-logo">
                        <?php
                                $logo_image = $logo['logo_image'];
                                $logo_link = $logo['logo_link'];
                                
                                if ($logo_image):
                                    $logo_url = wp_get_attachment_image_url($logo_image, 'medium');
                                    $logo_alt = get_post_meta($logo_image, '_wp_attachment_image_alt', true) ?: get_the_title($logo_image);
                                    
                                    if ($logo_link):
                                        ?>
                        <a href="<?php echo esc_url($logo_link); ?>" target="_blank" rel="noopener noreferrer">
                            <img src="<?php echo esc_url($logo_url); ?>" alt="<?php echo esc_attr($logo_alt); ?>"
                                class="logo-img">
                        </a>
                        <?php
                                    else:
                                        ?>
                        <img src="<?php echo esc_url($logo_url); ?>" alt="<?php echo esc_attr($logo_alt); ?>"
                            class="logo-img">
                        <?php
                                    endif;
                                else:
                                    // Fallback to text if no image
                                    $logo_text = $logo['logo_text'];
                                    if ($logo_text):
                                        if ($logo_link):
                                            ?>
                        <a href="<?php echo esc_url($logo_link); ?>" target="_blank" rel="noopener noreferrer">
                            <div class="logo-placeholder"><?php echo esc_html($logo_text); ?></div>
                        </a>
                        <?php
                                        else:
                                            ?>
                        <div class="logo-placeholder"><?php echo esc_html($logo_text); ?></div>
                        <?php
                                        endif;
                                    else:
                                        // No image and no text, show placeholder
                                        ?>
                        <div class="logo-placeholder">Client Logo</div>
                        <?php
                                    endif;
                                endif;
                                ?>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>

            <!-- Slider Navigation -->
            <button class="slider-nav slider-prev">
                <i class="fas fa-chevron-left"></i>
            </button>
            <button class="slider-nav slider-next">
                <i class="fas fa-chevron-right"></i>
            </button>
        </div>
        <?php endif; ?>
    </div>
</section>