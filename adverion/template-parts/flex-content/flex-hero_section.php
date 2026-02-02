<?php
/**
 * Hero Section Template
 * ACF Flexible Content Layout: hero_section
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

// Get ACF fields
$hero_title = get_sub_field('hero_title');
$hero_subtitle = get_sub_field('hero_subtitle');
$primary_button_text = get_sub_field('hero_primary_button');
$primary_button_link = get_sub_field('hero_primary_link');
$secondary_button_text = get_sub_field('hero_secondary_button');
$secondary_button_link = get_sub_field('hero_secondary_link');
?>

<section class="hero">
    <div class="hero-background">
        <div class="gradient-orb orb-1"></div>
        <div class="gradient-orb orb-2"></div>
        <div class="gradient-orb orb-3"></div>
    </div>
    <div class="hero-container">
        <div class="hero-content">
            <?php if ($hero_title): ?>
            <h1 class="hero-title">
                <?php echo wp_kses_post($hero_title); ?>
            </h1>
            <?php else: ?>
            <h1 class="hero-title">
                Grow Your Brand Faster With <span class="text-gradient">Data-Driven</span> Digital Marketing
            </h1>
            <?php endif; ?>

            <?php if ($hero_subtitle): ?>
            <p class="hero-subtitle">
                <?php echo wp_kses_post($hero_subtitle); ?>
            </p>
            <?php else: ?>
            <p class="hero-subtitle">
                Adverion helps businesses scale through performance marketing, SEO, and conversion-focused strategies.
            </p>
            <?php endif; ?>

            <div class="hero-cta">
                <?php if ($primary_button_text && $primary_button_link): ?>
                <a href="<?php echo esc_url($primary_button_link); ?>" class="cta-primary">
                    <?php echo esc_html($primary_button_text); ?>
                </a>
                <?php else: ?>
                <button class="cta-primary">Get Free Strategy Call</button>
                <?php endif; ?>

                <?php if ($secondary_button_text && $secondary_button_link): ?>
                <a href="<?php echo esc_url($secondary_button_link); ?>" class="cta-secondary">
                    <?php echo esc_html($secondary_button_text); ?>
                </a>
                <?php elseif ($secondary_button_text): ?>
                <button class="cta-secondary"><?php echo esc_html($secondary_button_text); ?></button>
                <?php else: ?>
                <button class="cta-secondary">View Our Work</button>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>