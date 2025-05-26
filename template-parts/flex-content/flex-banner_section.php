<?php 
$background_image = get_sub_field('background_image');
$banner_title = get_sub_field('banner_title');
$banner_description = get_sub_field('banner_description');
$cta_1 = get_sub_field('cta_1');
$cta_2 = get_sub_field('cta_2');

?>
<section class="banner-sec my-0 section-padding" style="background-image: url(<?php echo $background_image;  ?>);">
    <div class="container">
        <div class="banner-content">
            <?php if(!empty($banner_title)){ echo '<h1 class="h2">'.$banner_title.'</h1>'; } ?>
            <?php if(!empty($banner_description)){ echo $banner_description; } ?>
            <?php if (!empty($cta_1) || !empty($cta_2)): ?>
            <div class="btn-wrapper">
                  <a href="<?php echo esc_url($cta_1['url']); ?>" target="<?php echo esc_attr($cta_1['target']); ?>" class="btn btn-white">
                    <?php echo esc_html($cta_1['title']); ?>
                  </a>
                  <a href="<?php echo esc_url($cta_2['url']); ?>" target="<?php echo esc_attr($cta_2['target']); ?>" class="btn btn-outline">
                    <?php echo esc_html($cta_2['title']); ?>
                  </a>
                </div>
                <?php endif; ?>
        </div>
    </div>
</section>