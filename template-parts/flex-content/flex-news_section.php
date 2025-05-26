<?php 
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$show_posts = get_sub_field('show_posts');
?>
<section class="new-sec">
    <div class="container">
        <div class="row">
            <?php
            $args = array(
                'post_type'      => 'post',
                'posts_per_page' => $show_posts,
                'paged'          => $paged,
            );
            $query = new WP_Query($args);
            if ($query->have_posts()) :
                while ($query->have_posts()) : $query->the_post();
                    $author_id = get_the_author_meta('ID');
                    $author_name = get_the_author();
                    $author_avatar = get_avatar_url($author_id);
                    $author_nickname = get_the_author_meta('nickname', $author_id);
                    $post_date = get_the_date('jS F, Y');
                    ?>
                    <div class="col">
                        <div class="new-block">
                            <div class="img-wrapper">
                                <?php if (has_post_thumbnail()) : ?>
                                    <img src="<?php the_post_thumbnail_url('medium-large'); ?>" alt="<?php the_title_attribute(); ?>">
                                <?php else : ?>
                                    <img src="https://via.placeholder.com/300x200" alt="No image available">
                                <?php endif; ?>
                            </div>
                            <div class="new-text-block">
                                <a href="<?php the_permalink(); ?>" class="h4 title"><?php the_title(); ?></a>
                                <div class="desc">
                                    <p><?php echo wp_trim_words(get_the_excerpt(), 20, '...'); ?></p>
                                    <a href="<?php the_permalink(); ?>">Read more</a>
                                </div>
                                <div class="auth-date">
                                    <span class="img">
                                        <img src="<?php echo $author_avatar; ?>" alt="<?php echo $author_name; ?>">
                                    </span>
                                    <span class="name"><?php echo ($author_nickname) ? $author_nickname : $author_name; ?></span>
                                    <span class="date"><?php echo $post_date; ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                endwhile;
                ?>
        </div>
        <div class="pagination">
            <?php
            $big = 999999999; // need an unlikely integer
            echo paginate_links(array(
                'base'    => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
                'format'  => '?paged=%#%',
                'current' => max(1, $paged),
                'total'   => $query->max_num_pages,
                'prev_text' => '&laquo; Previous',
                'next_text' => 'Next &raquo;',
            ));
            ?>
        </div>
        <?php
        wp_reset_postdata();
        else :
            echo '<p>No posts found.</p>';
        endif;
        ?>
    </div>
</section>
