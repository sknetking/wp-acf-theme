<?php 
$section_title = get_sub_field('section_title');
$section_description = get_sub_field('section_description');
$cta = get_sub_field('cta');
$select_image_1 = get_sub_field('select_image_1');
$select_image_2 = get_sub_field('select_image_2');
$select_image_3 = get_sub_field('select_image_3');

?>
<section class="journey-sec">
    <div class="container">
        <div class="row">
            <div class="col-left">
                <div class="row">
                    <?php if(!empty($select_image_1)): ?>
                    <div class="col">
                        <div class="img-wrapper">
                            <?php echo wp_get_attachment_image($select_image_1,'full','false',array('class' =>'')); ?>
                        </div>
                    </div>
                    <?php endif; ?>
                    <div class="col-half">
                        <?php if(!empty($select_image_2)): ?>
                        <div class="img-wrapper">
                           <?php echo wp_get_attachment_image($select_image_2,'full','false',array('class' =>'')); ?>
                        </div>
                        <?php endif; ?>
                    </div>
                    <div class="col-half">
                        <?php if(!empty($select_image_3)): ?>
                        <div class="img-wrapper">
                            <?php echo wp_get_attachment_image($select_image_3,'full','false',array('class' =>'')); ?>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="col-right">
                <?php if(!empty($section_title)){ echo '<h2>'.$section_title.'</h2>'; } ?>
                <?php if(!empty($section_description)){ echo $section_description; } ?>
                
                <?php if (!empty($cta)): ?>
                  <a href="<?php echo esc_url($cta['url']); ?>" target="<?php echo esc_attr($cta['target']); ?>" class='btn'>
                    <?php echo esc_html($cta['title']); ?>
                  </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>