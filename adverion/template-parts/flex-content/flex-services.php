<?php
/**
 * Services Section Template
 * ACF Flexible Content Layout: services
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

// Get ACF fields
$section_title = get_sub_field('section_title');
$section_subtitle = get_sub_field('section_subtitle');
$services = get_sub_field('services');
?>

<section class="services" id="services">
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

        <?php if ($services && !empty($services)): ?>
        <div class="services-grid">
            <?php foreach ($services as $service): ?>
            <div class="service-card">
                <?php
                        $service_icon = $service['font_awesome_class'];
                        $service_image = $service['service_image'];
                        $service_title = $service['service_title'];
                        $service_description = $service['service_description'];
                        $service_link = $service['service_link'];
                    
                    
                  
                        // Icon
                        if ($service_icon && is_array($service_icon)):
                            // Handle icon picker array format
                            if ($service_icon['type'] == 'dashicons'):
                                ?>
                <div class="service-icon">
                    <span class="<?php echo "dashicons " . esc_attr($service_icon['value']); ?>"></span>
                </div>
                <?php
                            elseif ($service_icon['type'] == 'media_library'):
                                // Handle media library image
                                //print_r($service_icon['value']['url']);
                                                        ?>
                <div class="service-icon">
                    <img src="<?php echo esc_url($service_icon['value']['url']); ?>" class="service-icon-img">
                </div>
                <?php
                            elseif ($service_icon['type'] == 'font-awesome'):
                                // Handle Font Awesome icon
                                ?>
                <div class="service-icon">
                    <i class="<?php echo esc_attr($service_icon['value']); ?>"></i>
                </div>
                <?php
                            endif;
                        elseif ($service_icon && !is_array($service_icon)):
                            // Fallback for old image ID format
                            $icon_url = wp_get_attachment_image_url($service_icon, 'thumbnail');
                            $icon_alt = get_post_meta($service_icon, '_wp_attachment_image_alt', true) ?: get_the_title($service_icon);
                            ?>
                <div class="service-icon">
                    <img src="<?php echo esc_url($icon_url); ?>" alt="<?php echo esc_attr($icon_alt); ?>"
                        class="service-icon-img">
                </div>
                <?php
                        else:
                            // Fallback to Font Awesome icon (if using text field)
                            $font_awesome_class = $service['font_awesome_class'];
                            if ($font_awesome_class && !is_array($font_awesome_class) && !empty($font_awesome_class)):
                                ?>
                <div class="service-icon">
                    <i class="<?php echo esc_attr($font_awesome_class); ?>"></i>
                </div>
                <?php
                            endif;
                        endif;
                        
                        // Image
                        if ($service_image):
                            $image_url = wp_get_attachment_image_url($service_image, 'medium');
                            $image_alt = get_post_meta($service_image, '_wp_attachment_image_alt', true) ?: get_the_title($service_image);
                            ?>
                <div class="service-image">
                    <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($image_alt); ?>"
                        class="service-img">
                </div>
                <?php
                        endif;
                        
                        // Title
                        if ($service_title):
                            if ($service_link):
                                ?>
                <h3><a href="<?php echo esc_url($service_link); ?>"><?php echo esc_html($service_title); ?></a></h3>
                <?php
                            else:
                                ?>
                <h3><?php echo esc_html($service_title); ?></h3>
                <?php
                            endif;
                        endif;
                        
                        // Description
                        if ($service_description):
                            ?>
                <p><?php echo wp_kses_post($service_description); ?></p>
                <?php
                        endif;
                        ?>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </div>
</section>