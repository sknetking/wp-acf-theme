<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package dlkadvisory
 */

get_header();
?>

<main id="primary" class="site-main">
		<section class="error-404 not-found">
			<div class="container">
				<div class="text-center">
					<h1>404</h1>
					<h2>Oops! We couldn't find<br> that page.</h2>
					<p>It seems the page you're looking for has wandered off. Please check the URL or return to our<br> homepage for delicious pita bread options!</p>
					<div class="btn-wrp">
						<a href="<?php echo site_url(); ?>" class="btn">Home</a>
					</div>
				</div>
			</div>
		</section>
	</main><!-- #main -->

<?php
get_footer();
