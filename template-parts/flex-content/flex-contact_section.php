<?php
$section_title = get_sub_field('section_title');
$phone_number = get_sub_field('phone_number');
$e_mail = get_sub_field('e-mail');
$contact_address = get_sub_field('contact_address');
$google_map_iframe = get_sub_field('google_map_iframe');
$select_your_contact_form = get_sub_field('select_your_contact_form');

$form_title = get_sub_field('form_title');
?>
<section class="contact-sec">
    <div class="container">
        <div class="row">
            <div class="col-left">
                
                <?php if(!empty($section_title)){ echo '<h3>'.$section_title.'</h3>'; } ?>
             
                <?php if (!empty($phone_number)): ?>
                <p>Phone:  <a href="<?php echo esc_url($phone_number['url']); ?>" target="<?php echo esc_attr($phone_number['target']); ?>">
                    <?php echo esc_html($phone_number['title']); ?>
                  </a></p>
                <?php endif; ?>


                <?php if (!empty($e_mail )): ?>
                  <p>E-mail:<a href="<?php echo esc_url($e_mail ['url']); ?>" target="<?php echo esc_attr($e_mail ['target']); ?>">
                    <?php echo esc_html($e_mail ['title']); ?>
                  </a> <p>
                <?php endif; ?>

                <?php if(!empty($contact_address)){ echo $contact_address; } ?>

                <div class="map">
                <?php if(!empty($google_map_iframe )){ echo $google_map_iframe ; } ?>
                </div>
            </div>
            <div class="col-right">
                <div class="form-box">
                <?php if(!empty($form_title)){ echo '<h3>'.$form_title.'</h3>'; } ?>
                    <?php if(!empty($select_your_contact_form)){ ?>
                    <?php echo do_shortcode( '[contact-form-7 id="'.$select_your_contact_form[0].'" title="Contact form"]' ); }?>
                </div>
            </div>
        </div>
    </div>
</section>