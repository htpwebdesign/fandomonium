<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Fandomonium
 */

get_header();
?>

	<main id="primary" class="site-main">

		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', get_post_type() );

		endwhile; // End of the loop.
		?>
		<section class="more-latest-news">
			<h2>more latest news</h2>
			<article class="latest-news-container">
				<?php
				$args = array(
					'post_type'      => 'post',
					'posts_per_page' => 6,
					'post__not_in' => array( $post->ID )
				);

				$blog_query = new WP_Query($args);

				if ($blog_query->have_posts()) {
					while ($blog_query->have_posts()) {
						$blog_query->the_post();
				?>
						<article class="post-container">
							<a href="<?php the_permalink(); ?>">
								<?php the_post_thumbnail(); ?>
								<h3><?php the_title(); ?></h3>
							</a>
						</article>
				<?php
					}
					wp_reset_postdata();
				}
				?>
			</article>
		</section>

		<?php get_template_part( 'template-parts/page', 'bottom' ); ?>
		
	</main><!-- #main -->

<?php
get_footer();
