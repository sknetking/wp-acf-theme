<?php
        // Define your categories in order you want them displayed
        $categories = array(
            'our-core-team-members',
            'team-members'
        );
        
        foreach ($categories as $category) :
            // Get all team members in this category
            $args = array(
                'post_type' => 'team-member',
                'posts_per_page' => -1,
                'tax_query' => array(
                    array(
                        'taxonomy' => 'team-category', // or your custom taxonomy if you're using one
                        'field'    => 'slug',
                        'terms'    => $category,
                    ),
                ),
            );
            
            $team_query = new WP_Query($args);
            
            if ($team_query->have_posts()) :
            ?>
<section class="team-member">
    <div class="container">

                <div class="section-header">
                    <h2 class="h1">
                        <?php  echo $title = ucwords(str_replace('-', ' ',$category)); ?>
                    </h2>
                </div>
                
                <div class="row">
                    <?php while ($team_query->have_posts()) : $team_query->the_post(); ?>
                    <div class="col">
                        <div class="team-box">
                            <div class="team-inner">
                                <div class="team-front">
                                    <div class="img-wrapper">
                                        <?php if (has_post_thumbnail()) : ?>
                                            <?php the_post_thumbnail('medium-large'); ?>
                                        <?php else : ?>
                                            <img src="<?php echo get_template_directory_uri(); ?>/path-to-default-image.jpg" alt="">
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="team-back">
                                  <a href='<?php echo get_permalink(); ?>'> <h5><?php the_title(); ?></h5> </a>
                                    <?php the_excerpt(); //the_content(); ?>
                                </div>
                            </div>
                            <a href='<?php echo get_permalink(); ?>'> <h5 class="text-center title"><?php the_title(); ?></h5> </a>
                              
                        </div>
                    </div>
                    <?php endwhile; ?>
                </div>
                
    
    </div>
</section>
<?php
                wp_reset_postdata();
            endif;
        endforeach;
        ?>