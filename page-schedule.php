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
			
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>


		<?php fandomonium_post_thumbnail(); ?>

			
		<div>
			<?php

			if (function_exists('get_field')) :
				if (get_field('description')) :
					?>
						<p><?php the_field('description'); ?></p>
					<?php
				endif;
			endif;

			$args = array(
				'post_type' 	 => 'fan-event',
				'posts_per_page' => -1,
				'orderby'        => 'meta_value',
    			'meta_key'       => 'start_time',
				'order' 		 => 'ASC',
			);

		
			$query = new WP_Query( $args );
			
				if ( $query -> have_posts() ) {
					?>
					<section class="anchor-container day-one">
						<h2>Day One</h2>
						<?php  
							while ( $query -> have_posts() ) {
								$query -> the_post();
									if (get_field('day') === 'one') {
								
									?>
									<article class="schedule day-one">
										<a href="<?php echo get_permalink(); ?>">
											<h2><?php echo get_the_title(); ?></h2>
											<?php the_post_thumbnail('thumbnail'); ?>
										</a>
										<p>Type: <?php echo strip_tags(get_the_term_list($post->ID, 'fan-event-type', '')); ?></p>
										<p>Date: <?php $startTime = explode('2022', get_field('start_time')); echo $startTime[0]; ?></p>
										<p>Start: <?php $startTime = explode('2022', get_field('start_time')); echo $startTime[1]; ?></p>
										<p>End: <?php the_field('end_time') ?></p>
									</article>
									<?php
								}
							
							}
						wp_reset_postdata();
						?>
					</section>

					<section class="anchor-container day-two">
					<h2>Day Two</h2>
						<?php  
							while ( $query -> have_posts() ) {
								$query -> the_post();
									if (get_field('day') === 'two') {
								
									?>
									<article class="schedule day-two">
										<a href="<?php echo get_permalink(); ?>">
											<h2><?php echo get_the_title(); ?></h2>
											<?php the_post_thumbnail('thumbnail'); ?>
										</a>
										<p><?php echo strip_tags(get_the_term_list($post->ID, 'fan-event-type', '')); ?></p>
										<p>Date: <?php $startTime = explode('2022', get_field('start_time')); echo $startTime[0]; ?></p>
										<p>Start: <?php $startTime = explode('2022', get_field('start_time')); echo $startTime[1]; ?></p>
										<p>End: <?php the_field('end_time') ?></p>
									</article>
									<?php
								}
							
							}
						wp_reset_postdata();
						?>
					</section>	
					
					<?php
				
				}
			
			
			?>
		</div>
			<?php

		endwhile; // End of the loop.
		?>

		

	</main><!-- #main -->

<?php

get_footer();
