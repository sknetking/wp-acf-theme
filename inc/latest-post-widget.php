<?php
/**
 * Recent News Widget
 */
class Recent_News_Widget extends WP_Widget {

    function __construct() {
        parent::__construct(
            'recent_news_widget',
            __('Recent News & Updates', 'dlkadvisory'),
            array('description' => __('Displays recent posts in a stylish format', 'dlkadvisory'))
        );
    }

    public function widget($args, $instance) {
        echo $args['before_widget'];
        
        $title = !empty($instance['title']) ? $instance['title'] : __('Recent News & Updates', 'dlkadvisory');
        $number = !empty($instance['number']) ? $instance['number'] : 3;
        
        echo $args['before_title'] .($title) . $args['after_title'];
        
        $recent_posts = new WP_Query(array(
            'posts_per_page' => $number,
            'post_status' => 'publish',
            'ignore_sticky_posts' => true
        ));
        
        if ($recent_posts->have_posts()) :
            echo '<div class="recent-news-widget">';
            while ($recent_posts->have_posts()) : $recent_posts->the_post();
                    $author_id = get_the_author_meta('ID');
                    $author_name = get_the_author();
                    $author_avatar = get_avatar_url($author_id);
                    $author_nickname = get_the_author_meta('nickname', $author_id);

                    $post_date = get_the_date('jS F, Y');
                ?>
                <div class="news-item">
                    <div class="news-content">
                        <h4 class="news-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                        <div class='content-wrapper'>
                            <div class="news-excerpt"><?php echo wp_trim_words(get_the_excerpt(), 15, '...'); ?></div>
                             <a href="<?php the_permalink(); ?>" class="read-more">Read more</a>
                        </div>
                        
                    </div>
                     <div class="auth-date">
                                    <span class="img">
                                        <img src="<?php echo esc_url($author_avatar); ?>" alt="<?php echo esc_attr($author_name); ?>">
                                    </span>
                                    <span class="name"><?php echo ($author_nickname)?$author_nickname:esc_html($author_name); ?></span>
                                    <span class="date"><?php echo esc_html($post_date); ?></span>
                    </div>
                </div>
                <hr class="news-divider">
                <?php
            endwhile;
            echo '</div>';
            wp_reset_postdata();
        else :
            echo '<p>No recent news found.</p>';
        endif;
        
        echo $args['after_widget'];
    }

    public function form($instance) {
        $title = !empty($instance['title']) ? $instance['title'] : __('Recent News & Updates', 'dlkadvisory');
        $number = !empty($instance['number']) ? $instance['number'] : 3;
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of posts to show:'); ?></label>
            <input class="tiny-text" id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="number" step="1" min="1" value="<?php echo esc_attr($number); ?>" size="3">
        </p>
        <?php
    }

    public function update($new_instance, $old_instance) {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
        $instance['number'] = (!empty($new_instance['number'])) ? absint($new_instance['number']) : 3;
        return $instance;
    }
}

// Register the widget
function register_recent_news_widget() {
    register_widget('Recent_News_Widget');
}
add_action('widgets_init', 'register_recent_news_widget');