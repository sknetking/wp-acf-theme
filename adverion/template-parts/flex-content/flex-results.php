<?php
/**
 * Results Section Template
 * ACF Flexible Content Layout: results
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

// Get ACF fields
$section_title = get_sub_field('section_title');
$section_subtitle = get_sub_field('section_subtitle');
$results = get_sub_field('results');
?>

<section class="results" id="results">
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
        
        <?php if ($results && !empty($results)): ?>
            <div class="results-grid">
                <?php foreach ($results as $result): ?>
                    <div class="result-item">
                        <?php
                        $result_number = $result['result_number'];
                        $result_text = $result['result_text'];
                        $result_suffix = $result['result_suffix'];
                        
                        // Number with suffix
                        if ($result_number):
                            ?>
                            <div class="result-number">
                                <?php 
                                echo esc_html($result_number);
                                if ($result_suffix) {
                                    echo '<span class="result-suffix">' . esc_html($result_suffix) . '</span>';
                                }
                                ?>
                            </div>
                            <?php
                        endif;
                        
                        // Text
                        if ($result_text):
                            ?>
                            <div class="result-text"><?php echo esc_html($result_text); ?></div>
                            <?php
                        endif;
                        ?>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>
