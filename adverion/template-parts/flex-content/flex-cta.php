<?php
/**
 * CTA Section Template
 * ACF Flexible Content Layout: cta
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

// Get ACF fields
$section_title = get_sub_field('section_title');
$section_subtitle = get_sub_field('section_subtitle');
$primary_cta_text = get_sub_field('primary_cta_text');
$primary_cta_url = get_sub_field('primary_cta_url');
$secondary_cta_text = get_sub_field('secondary_cta_text');
$secondary_cta_url = get_sub_field('secondary_cta_url');
$background_style = get_sub_field('background_style'); // gradient, solid, image
$background_color = get_sub_field('background_color');
$background_image = get_sub_field('background_image');

// Section classes
$section_classes = ['cta-section'];
$inline_styles = '';

switch ($background_style) {
    case 'solid':
        if ($background_color) {
            $inline_styles = 'background-color: ' . esc_attr($background_color) . ';';
        }
        break;
    case 'image':
        if ($background_image) {
            $bg_image_url = wp_get_attachment_image_url($background_image, 'full');
            $inline_styles = 'background-image: url(' . esc_url($bg_image_url) . '); background-size: cover; background-position: center;';
        }
        break;
    case 'gradient':
    default:
        // Default gradient from CSS
        break;
}
?>

<section class="<?php echo esc_attr(implode(' ', $section_classes)); ?>" <?php echo $inline_styles ? 'style="' . esc_attr($inline_styles) . '"' : ''; ?>>
    <div class="container">
        <div class="cta-content">
            <?php if ($section_title): ?>
                <h2 class="cta-title"><?php echo esc_html($section_title); ?></h2>
            <?php endif; ?>
            
            <?php if ($section_subtitle): ?>
                <p class="cta-subtitle"><?php echo esc_html($section_subtitle); ?></p>
            <?php endif; ?>
            
            <?php if ($primary_cta_text && $primary_cta_url || $secondary_cta_text && $secondary_cta_url): ?>
                <div class="cta-buttons">
                    <?php if ($primary_cta_text && $primary_cta_url): ?>
                        <a href="<?php echo esc_url($primary_cta_url); ?>" class="cta-primary">
                            <?php echo esc_html($primary_cta_text); ?>
                        </a>
                    <?php endif; ?>
                    
                    <?php if ($secondary_cta_text && $secondary_cta_url): ?>
                        <a href="<?php echo esc_url($secondary_cta_url); ?>" class="cta-secondary">
                            <?php echo esc_html($secondary_cta_text); ?>
                        </a>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
