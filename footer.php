<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package dlkadvisory
 */

?>
<footer class="site-footer">
    <div class="container">
        <div class="row">
            <div class="ft-col1">
                <?php if ($footer_logo = get_field('footer_logo', 'option')): ?>
                    <div class="ft-logo">
                    	<?php echo wp_get_attachment_image($footer_logo,'full'); ?>
                    </div>
                <?php endif; ?>
                
                <?php if ($footer_tagline = get_field('footer_tagline', 'option')): ?>
                    <div class="desc">
                        <p><?php echo esc_html($footer_tagline); ?></p>
                    </div>
                <?php endif; ?>
                
                <?php if (have_rows('social_links', 'option')): ?>
                    <div class="social-icon">
                        <?php while (have_rows('social_links', 'option')): the_row(); ?>
                            <a href="<?php echo esc_url(get_sub_field('social_url')); ?>" target="_blank">
                                <img src="<?php echo esc_url(get_sub_field('social_icon')); ?>" alt="">
                            </a>
                        <?php endwhile; ?>
                    </div>
                <?php endif; ?>
            </div>
            
            <div class="ft-col2">
               
				<?php
					$section_title = get_field('section_title','option');
				if(!empty($section_title)){ echo '<h6>'.$section_title.'</h6>'; }else{
					echo "<h6>".esc_html(get_bloginfo('name'))."</h6>";
				} ?>

                <?php if ($footer_address = get_field('footer_address', 'option')): ?>
                    <p><?php echo wp_kses_post(nl2br($footer_address)); ?></p>
                <?php endif; ?>
            </div>
            
            <div class="ft-col3">
                
				<?php
					$section_title_2 = get_field('section_title_2','option');
				if(!empty($section_title_2)){ echo '<h6>'.$section_title_2.'</h6>'; } ?>
                <ul class="contact-info">
                    <?php if ($contact_phone = get_field('contact_phone', 'option')): ?>
                        <li>
                            <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/', '', $contact_phone)); ?>">
                                <span class="icon">
                                    <img src="<?php echo site_url();  ?>/wp-content/uploads/2025/05/fluent_call-28-filled.svg" alt="">
                                </span>
                                <?php echo esc_html($contact_phone); ?>
                            </a>
                        </li>
                    <?php endif; ?>
                    
                    <?php if ($contact_email = get_field('contact_email', 'option')): ?>
                        <li>
                            <a href="mailto:<?php echo esc_attr($contact_email); ?>">
                                <span class="icon">
                                    <img src="<?php echo site_url();  ?>/wp-content/uploads/2025/05/material-symbols_mail-rounded.svg" alt="">
                                </span>
                                <?php echo esc_html($contact_email); ?>
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
            
            <div class="ft-col4">
               <?php
					$section_title3 = get_field('section_title_3','option');
				if(!empty($section_title3)){ echo '<h6>'.$section_title3.'</h6>'; } ?>
                <div class="ft-menu">
                    <?php
                        wp_nav_menu(
                            array(
                                'theme_location' => 'footer_menu',
                                'menu_id'        => 'footer_menu',
                                'menu_class'     => 'menu',
                            )
                        );
                    ?>
                </div>
            </div>
        </div>
        
        <div class="copyright text-center">
            <p>
                <?php if ($copyright_text = get_field('copyright_text', 'option')): ?>
                    <?php echo esc_html($copyright_text); ?>  /  
                <?php endif; ?>
				<?php 
				   $footer_links_rep = get_field('footer_links_rep','option');
				
				?>
				<?php $index = 1;
			if (!empty($footer_links_rep)):
			 foreach ($footer_links_rep as $data){ 
				$footer_link = $data['footer_link'];
				 if (!empty($footer_link)): ?>
				  <a href="<?php echo esc_url($footer_link['url']); ?>" target="<?php echo esc_attr($footer_link['target']); ?>">
					<?php echo esc_html($footer_link['title']); ?>
				  </a>/
				<?php 
				if(count($footer_links_rep)-1 == $index){
					echo 'Website by';
				}
				endif; ?>

				<?php  $index++; }?>
				<?php endif; ?>
            </p>
        </div>
    </div>
</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>