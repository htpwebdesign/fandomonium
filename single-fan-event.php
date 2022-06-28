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

			


			if (function_exists('get_field')) :
				if (get_field('event_description')) :
					?>
						<p><?php the_field('event_description'); ?></p>
					<?php
				endif;
	
				if (get_field('start_time')) :
					?>
						<h2>Event Details</h2>
						<p>Event type: <?php echo strip_tags(get_the_term_list($post->ID, 'fan-event-type', '')); ?></p>
						<p>Date: <?php $startTime = explode('2022', get_field('start_time')); echo $startTime[0]; ?></p>
						<p>Start: <?php $startTime = explode('2022', get_field('start_time')); echo $startTime[1]; ?></p>
						<p>End: <?php the_field('end_time') ?></p>
					<?php
					
				endif;
	
	
				$posts = get_field('guests');
				if( $posts ): ?>
					<h2>Featured Guests</h2>
						<ul>
							<?php foreach( $posts as $post ): ?>
								<li>
									<a href="<?php echo get_permalink( $post->ID ); ?>"><?php echo get_the_title( $post->ID ); ?></a>
								</li>
							<?php endforeach; ?>
						</ul>
					<?php 
				endif; 
				?>
				<a href="<?php echo get_post_type_archive_link('fan-guest'); ?>">See all guests</a>
				<?php
				wp_reset_postdata();
	
				
				
			endif;

		endwhile; // End of the loop.


		

		


		?>

	</main><!-- #main -->

<?php
get_sidebar();
get_footer();
