<?php 
$cta_description = get_sub_field('cta_description');
$cta_btn = get_sub_field('cta_btn');
?>
<section class="cta-sec my-0">
    <div class="container">
        <div class="text-center">
          <?php if(!empty($cta_description)){ echo $cta_description; } ?>
           
            <?php if (!empty($cta_btn)): ?>
              <a href="<?php echo esc_url($cta_btn['url']); ?>" target="<?php echo esc_attr($cta_btn['target']); ?>" class='btn'>
                <?php echo esc_html($cta_btn['title']); ?>
              </a>
            <?php endif; ?>
        </div>
    </div>
</section>