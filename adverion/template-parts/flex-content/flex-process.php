<?php
/**
 * Process Section Template
 * ACF Flexible Content Layout: process
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

// Get ACF fields
$section_title = get_sub_field('section_title');
$section_subtitle = get_sub_field('section_subtitle');
$process_steps = get_sub_field('process_steps');
?>

<section class="process" id="process">
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
        
        <?php if ($process_steps && !empty($process_steps)): ?>
            <div class="process-timeline">
                <?php foreach ($process_steps as $index => $step): ?>
                    <div class="process-step">
                        <div class="step-number"><?php echo esc_html($index + 1); ?></div>
                        <div class="step-content">
                            <?php
                            $step_title = $step['step_title'];
                            $step_description = $step['step_description'];
                            
                            // Title
                            if ($step_title):
                                ?>
                                <h3><?php echo esc_html($step_title); ?></h3>
                                <?php
                            endif;
                            
                            // Description
                            if ($step_description):
                                ?>
                                <p><?php echo wp_kses_post($step_description); ?></p>
                                <?php
                            endif;
                            ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>
