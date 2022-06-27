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

			get_template_part( 'template-parts/content', 'page' );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

		<section>

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
				
			
				if ( $query -> have_posts() ) {
					echo "<div class='anchor-container'>";
					while ( $query -> have_posts() ) {
						$query -> the_post();

						echo "<article class='student-item'>";
								echo '<a href="'.get_permalink().'">';
									echo "<h2>".get_the_title()."</h2>";
									the_post_thumbnail( 'thumbnail' );
								echo '</a>';
							the_excerpt();
							echo "<p>".the_taxonomies()."</p>";
						echo "</article>";
		
					}
					wp_reset_postdata();
					echo "</div>";
				}
			wp_reset_postdata();
			}
			?>
			

			
		</section>

	</main><!-- #main -->

<?php
get_sidebar();
get_footer();