<?php 
$section_title = get_sub_field('section_title');
?>
<section class="latest-news section-padding my-0">
    <div class="container">
        <div class="section-header text-center">
          
            <?php if(!empty($section_title )){ echo '<h2>'.$section_title .'</h2>'; } ?>
        </div>
        <div class="row">
            <?php
            $args = array(
                'posts_per_page' => 4,
                'post_status' => 'publish',
                'orderby' => 'date',
                'order' => 'DESC'
            );
            
            $latest_posts = new WP_Query($args);
            
            if ($latest_posts->have_posts()) :
                while ($latest_posts->have_posts()) : $latest_posts->the_post();
            ?>
            <div class="col">
                <div class="latest-news-box">
                    <?php if (has_post_thumbnail()) : ?>
                    <div class="img-wrapper">
                        <?php the_post_thumbnail('medium'); ?>
                    </div>
                    <?php endif; ?>
                    <h4><?php the_title(); ?></h4>
                    <div class="desc">
                        <?php the_excerpt(); ?>
                    </div>
                    <a href="<?php the_permalink(); ?>" class="link">See More</a>
                </div>
            </div>
            <?php
                endwhile;
                wp_reset_postdata();
            else:
                echo "<p>Not found any Post pleas add some post.";
            endif;
            ?>
        </div>
    </div>
</section>