<?php
/**
 * About Story Section Template
 * ACF Flexible Content Layout: about_story
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

// Get ACF fields
$story_title = get_sub_field('story_title');
$story_content = get_sub_field('story_content');
$story_image = get_sub_field('story_image');
$image_position = get_sub_field('image_position'); // left, right
$show_stats = get_sub_field('show_stats');
$stats = get_sub_field('stats');

// Content classes
$content_classes = ['about-content'];
if ($image_position === 'right') {
    $content_classes[] = 'image-right';
} else {
    $content_classes[] = 'image-left';
}
?>

<section class="about-story">
    <div class="container">
        <div class="<?php echo esc_attr(implode(' ', $content_classes)); ?>">
            <div class="about-text">
                <?php if ($story_title): ?>
                <h2><?php echo esc_html($story_title); ?></h2>
                <?php endif; ?>

                <?php if ($story_content): ?>
                <?php echo wp_kses_post($story_content); ?>
                <?php endif; ?>

                <?php if ($show_stats && $stats && !empty($stats)): ?>
                <div class="about-stats">
                    <?php foreach ($stats as $stat): ?>
                    <div class="stat-item">
                        <?php
                                $stat_number = $stat['stat_number'];
                                $stat_label = $stat['stat_label'];
                                $stat_suffix = $stat['stat_suffix'];
                                
                                // Number with suffix
                                if ($stat_number):
                                    ?>
                        <div class="stat-number">
                            <?php 
                                        echo esc_html($stat_number);
                                        if ($stat_suffix) {
                                            echo '<span class="stat-suffix">' . esc_html($stat_suffix) . '</span>';
                                        }
                                        ?>
                        </div>
                        <?php
                                endif;
                                
                                // Label
                                if ($stat_label):
                                    ?>
                        <div class="stat-label"><?php echo esc_html($stat_label); ?></div>
                        <?php
                                endif;
                                ?>
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
            </div>

            <?php if ($story_image): ?>
            <div class="about-image">
                <?php
                    $image_url = wp_get_attachment_image_url($story_image, 'large');
                    $image_alt = get_post_meta($story_image, '_wp_attachment_image_alt', true) ?: get_the_title($story_image);
                    ?>
                <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($image_alt); ?>"
                    class="about-img">
            </div>
            <?php endif; ?>
        </div>
    </div>
</section>