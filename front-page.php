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
		
		<?php
		while ( have_posts() ) :
			the_post();
		?>
		<section class=site-hero>
			<div class="hero-with-img">
				<?php the_title( '<h1 class="page-title">', '</h1>' ); ?>
				<?php fandomonium_post_thumbnail(); ?>
			</div>
		</section>

		<section class="welcome-message" data-aos="fade-up"
     data-aos-duration="1500">
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


		<section class="featured-events" >
			<?php
			if (function_exists('get_fields')) {
				?><div class="featured-events-heading-container" data-aos="fade-up"
																 data-aos-offset="200"><?php
				if (get_field('featured_events_heading')) {
					?>
					<h2><?php the_field('featured_events_heading'); ?></h2>
					<?php
				}
				if (get_field('events_link')) {
					?><a href="<?php echo get_permalink( 12 ); ?>"><?php the_field('events_link'); ?></a><?php
				}
				?></div><?php

				$posts = get_field('feature_events');
				if( $posts ): ?>
						<ul>
							<?php foreach( $posts as $post ): ?>
								<li data-aos="fade-up"
									data-aos-offset="200">
									<a href="<?php echo get_permalink( $post->ID ); ?>">
										<?php echo get_the_post_thumbnail( $post->ID, 'large' ); ?>
										<h3><?php the_title(); ?></h3>	
									</a>
								</li>
							<?php endforeach; ?>
						</ul>
						
					<?php 
				
				endif; 
				wp_reset_postdata();
				
			}
			?>
		</section>


		<section class="featured-news"  >
		<?php

			if ( function_exists('get_fields') ) {
				?><div class="featured-news-heading-container" data-aos="fade-up"
															   data-aos-offset="200"><?php
				if (get_field('news_heading')) {
					?>
					<h2><?php the_field('news_heading'); ?></h2>
					<?php
				}

				if (get_field('news_link')) {
					?><a href="<?php echo get_post_type_archive_link( 'post' ); ?>"><?php the_field('news_link') ?></a><?php
				}
				?></div><?php
			}

				$args = array(
					'post_type' 	 	=> 'post',
					'posts_per_page' 	=>  3,
					
				);
				$blog_query = new WP_query( $args );
				if ( $blog_query -> have_posts() ) :
					?><div class="blog-posts-container"><?php
					while ( $blog_query -> have_posts() ) :
						$blog_query -> the_post();

						?>
						<article    data-aos="fade-up"
									data-aos-offset="200">

							<a href="<?php the_permalink(); ?>">
								<?php the_post_thumbnail( 'large' ); ?>
								<h3> <?php the_title(); ?> </h3>
							</a>
						</article>
						<?php

					endwhile;
					?></div><?php
					wp_reset_postdata();
					
					
					
				endif;

				

				
			?>
		</section>


		<section class="featured-guests" >

		<?php
			if (function_exists('get_fields')) :
				?><div class="featured-guests-heading-container" data-aos="fade-up"
															   	 data-aos-offset="200"><?php
				if (get_field('featured_guests_heading')) {
					?>
					<h2><?php the_field('featured_guests_heading'); ?></h2>
					<?php
				}
				if (get_field('guests_link')) {
					?><a href="<?php echo get_post_type_archive_link( 'post' ); ?>"><?php the_field('guests_link') ?></a><?php
				}
				?></div><?php

				$posts = get_field('featured_guests');
				if( $posts ): ?>
						<ul>
							<?php foreach( $posts as $post ): ?>
								<li data-aos="fade-up"
									data-aos-offset="200">
									<a href="<?php echo get_permalink( $post->ID ); ?>">
										<?php echo get_the_post_thumbnail( $post->ID, 'large' ); ?>
										<h3><?php the_title(); ?></h3>
									</a>
								</li>
							<?php endforeach; ?>
						</ul>
					<?php 
				endif; 
				wp_reset_postdata();

				
					
			endif;
			?>

		</section>

		<section class="featured-vendors" >

			<?php 
			get_template_part( 'template-parts/page-bottom' );
			?>

		</section>

		<?php
		endwhile; // End of the loop.
		?>

		

	</main><!-- #main -->

<?php
get_footer();
