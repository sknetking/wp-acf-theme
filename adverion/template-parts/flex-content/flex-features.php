<?php
/**
 * Features Section Template
 * ACF Flexible Content Layout: features
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

// Get ACF fields
$section_title = get_sub_field('section_title');
$section_subtitle = get_sub_field('section_subtitle');
$features = get_sub_field('features');
?>

<section class="why-choose">
    <div class="container">
        <?php if ($section_title || $section_subtitle): ?>
            <div class="section-header">
                <?php if ($section_title): ?>
                    <h2 class="section-title"><?php echo esc_html($section_title); ?></h2>
                <?php endif; ?>
                
                <?php if ($section_subtitle): ?>
                    <p class="section-subtitle"><?php echo esc_html($section_subtitle); ?></p>
                <?php endif; ?>
            </div>
        <?php endif; ?>
        
        <?php if ($features && !empty($features)): ?>
            <div class="features-grid">
                <?php foreach ($features as $feature): ?>
                    <div class="feature-item">
                        <?php
                        $feature_icon = $feature['feature_icon'];
                        $feature_title = $feature['feature_title'];
                        $feature_description = $feature['feature_description'];
                        
                        // Icon
                        if ($feature_icon):
                            $icon_url = wp_get_attachment_image_url($feature_icon, 'thumbnail');
                            $icon_alt = get_post_meta($feature_icon, '_wp_attachment_image_alt', true) ?: get_the_title($feature_icon);
                            ?>
                            <div class="feature-icon">
                                <img src="<?php echo esc_url($icon_url); ?>" alt="<?php echo esc_attr($icon_alt); ?>" class="feature-icon-img">
                            </div>
                            <?php
                        else:
                            // Fallback to Font Awesome icon
                            $font_awesome_class = $feature['font_awesome_class'];
                            if ($font_awesome_class):
                                ?>
                                <div class="feature-icon">
                                    <i class="<?php echo esc_attr($font_awesome_class); ?>"></i>
                                </div>
                                <?php
                            endif;
                        endif;
                        
                        // Title
                        if ($feature_title):
                            ?>
                            <h3><?php echo esc_html($feature_title); ?></h3>
                            <?php
                        endif;
                        
                        // Description
                        if ($feature_description):
                            ?>
                            <p><?php echo wp_kses_post($feature_description); ?></p>
                            <?php
                        endif;
                        ?>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>
