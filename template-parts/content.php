<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package dlkadvisory
 */

  $author_id = get_the_author_meta('ID');
$author_name = get_the_author(); // Display Name
$author_nickname = get_the_author_meta('nickname', $author_id);
$author_avatar = get_avatar_url($author_id);
$post_date = get_the_date('jS F, Y');

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
	<div class="post-thumbnail"><?php  

				if (has_post_thumbnail()) {
				the_post_thumbnail('full');
			}
	?>
	</div>

	<div class="row">
		<div class="col-left">
			<header class="entry-header">
				<?php
				if ( is_singular() ) :
					the_title( '<h1 class="entry-title h4">', '</h1>' );
				else :
					the_title( '<h2 class="entry-title h4"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
				endif;

				if ( 'post' === get_post_type() ) :
					?>
					
					 <div class="auth-date">
						<span class="img">
							<img src="<?php echo esc_url($author_avatar); ?>" alt="<?php echo esc_attr($author_name); ?>">
						</span>
						<span class="name"><?php echo ($author_nickname)?$author_nickname:esc_html($author_name); ?></span>
						<span class="date"><?php echo esc_html($post_date); ?></span>
					</div>

				<?php endif; ?>
			</header><!-- .entry-header -->

			<div class="entry-content">
				<?php
				the_content(
					sprintf(
						wp_kses(
							/* translators: %s: Name of current post. Only visible to screen readers */
							__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'dlkadvisory' ),
							array(
								'span' => array(
									'class' => array(),
								),
							)
						),
						wp_kses_post( get_the_title() )
					)
				);

				wp_link_pages(
					array(
						'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'dlkadvisory' ),
						'after'  => '</div>',
					)
				);
				?>
			</div><!-- .entry-content -->
		</div>
		<div class="col-right">
			<?php get_sidebar(); ?>
		</div>
	</div>
</article><!-- #post-<?php the_ID(); ?> -->
