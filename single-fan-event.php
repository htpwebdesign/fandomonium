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
			?>
			<div class="single-event-header"> 
			<?php
			fandomonium_post_thumbnail();
			?>
				<div class="title-description-container">
					<?php
					the_title( '<h1 class="entry-title">', '</h1>' );
					if (function_exists('get_field')) :
						if (get_field('event_description')) :
							?>
								<p><?php the_field('event_description'); ?></p>
				</div>
			</div>
						<?php
				endif;
	
				if (get_field('start_time')) :
					?>
						<div class="heading-container">
							<h2>Event Details</h2>
							<a href="<?php echo get_permalink(12); ?>">Back to Schedule </a>
						</div>
						<div class="event-details-container">
							<p><strong>Type:</strong><br> <?php echo strip_tags(get_the_term_list($post->ID, 'fan-event-type', '')); ?></p>
							<p><strong>Date:</strong><br> <?php $startTime = explode('2022', get_field('start_time')); echo $startTime[0]; ?></p>
							<p><strong>Start:</strong><br> <?php $startTime = explode('2022', get_field('start_time')); echo $startTime[1]; ?></p>
							<p><strong>End:</strong><br> <?php the_field('end_time') ?></p>
						</div>
					<?php
					
				endif;

				
	
	
				$posts = get_field('guests');
				if( $posts ): ?>
					<div class="heading-container">
						<h2>Featured Guests</h2>
						<a href="<?php echo get_post_type_archive_link('fan-guest'); ?>">See all guests</a>
					</div>
						<ul class="single-event-guest-container">
							<?php foreach( $posts as $post ): ?>
								<li>
									<a href="<?php echo get_permalink( $post->ID ); ?>">
										<?php echo the_post_thumbnail('medium'); ?>
										<p><?php the_title(); ?></p>
									</a>
								</li>
							<?php endforeach; ?>
						</ul>
						
					<?php 
				endif; 
				wp_reset_postdata();

				?>
				<h2>More Events</h2>
				<?php
	
					$args = array(
						'post_type' 	 	=> 'fan-event',
						'posts_per_page' 	=>  4,
						'orderby'       	=> 'rand',
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
				
				
			endif;
			get_template_part( 'template-parts/page-bottom' );
		endwhile; // End of the loop.


		

		


		?>

	</main><!-- #main -->

<?php

get_footer();
