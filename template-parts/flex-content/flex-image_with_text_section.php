<?php 
$section_image = get_sub_field('section_image');
$section_title = get_sub_field('section_title');
$description = get_sub_field('description');

$second_title = get_sub_field('second_title');
$second_description = get_sub_field('second_description');


$cip_right = get_sub_field('change_image_position_right');
$two_cta = get_sub_field('two_cta');
?> 
 <section class="img-with-txt <?= $cip_right?'right':''; ?>">  <!-- add class right -->
    <div class="container">
        <div class="row">
            <?php if(!empty($section_image)): ?>
            <div class="col-left">
             <?php echo wp_get_attachment_image($section_image,'full','false',array('class' =>'')); ?>
            </div>
            <?php endif; ?>
            <div class="col-right">
        
                <?php if(!empty($section_title)){ echo '<h3>'.$section_title.'</h3>'; } ?>
                <?php if(!empty($description)){ echo $description; } ?>
              
                <?php if(!empty($second_title)){ echo '<h3>'.$second_title.'</h3>'; } ?>

                <?php if(!empty($second_description)){ echo $second_description; } ?>

               <?php if (!empty($two_cta)): ?>
                 <a href="<?php echo esc_url($two_cta['url']); ?>" target="<?php echo esc_attr($two_cta['target']); ?>"class='btn'>
                   <?php echo esc_html($two_cta['title']); ?>
                 </a>
               <?php endif; ?>
            </div>
        </div>
    </div>
</section>