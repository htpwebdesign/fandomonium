<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Fandomonium
 */

get_header();
?>

	<main id="primary" class="site-main">
		<article>

		<?php
		while ( have_posts() ) :
			the_post();
		?>
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		<?php fandomonium_post_thumbnail(); ?>

		<section class="welcome-message">
			<?php
				if (function_exists('get_fields')) {

					if (get_field('welcome_heading')) {
						?>
						<h2><?php the_field('welcome_heading'); ?></h2>
						<?php
					}

					if (get_field('welcome_message')) {
						?>
						<p><?php the_field('welcome_message'); ?></p>
						<?php
					}
				}
			?>
		</section>


		<section class="featured-events">
			<?php
			if (function_exists('get_fields')) {

				if (get_field('featured_events_heading')) {
					?>
					<h2><?php the_field('featured_events_heading'); ?></h2>
					<?php
				}

				$posts = get_field('feature_events');
				if( $posts ): ?>
						<ul>
							<?php foreach( $posts as $post ): ?>
								<li>
									<a href="<?php echo get_permalink( $post->ID ); ?>">
										<?php echo get_the_title( $post->ID ); ?>
										<?php echo get_the_post_thumbnail( $post->ID, 'medium' ); ?>
									</a>
								</li>
							<?php endforeach; ?>
						</ul>
						<a href="<?php echo get_post_type_archive_link('fan-guest'); ?>">See all Events</a>
					<?php 
				endif; 
				wp_reset_postdata();
			}
			?>
		</section>


		<section class="featured-news">
		<?php
		$args = array(
					'post_type' 	 	=> 'post',
					'posts_per_page' 	=>  3,
					
				);
				$blog_query = new WP_query( $args );
				if ( $blog_query -> have_posts() ) :
					while ( $blog_query -> have_posts() ) :
						$blog_query -> the_post();

						?>
						<article>
							<a href="<?php the_permalink(); ?>">
								<h3> <?php the_title(); ?> </h3>
								<?php the_post_thumbnail( 'medium' ); ?>

							</a>
						</article>
						<?php

					endwhile;
					wp_reset_postdata();
				endif;
			?>
		</section>
		<section class="featured-guests"></section>
		<section class="featured-vendors"></section>

		<?php
		endwhile; // End of the loop.
		?>

		</article>

	</main><!-- #main -->

<?php
get_footer();
