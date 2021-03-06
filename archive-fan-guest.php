<?php
/**
 * The template for displaying work archives
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package FWD_Starter_Theme
 */

get_header();
?>

	<main id="primary" class="site-main">
		<section class=site-hero>
			<div class="hero-no-img">
				<h1 class="archive-title"><?php the_archive_title(); ?></h1>
			</div>
		</section>

		<?php
		the_archive_description( '<div class="archive-description">', '</div>' );
		?>
		
		<?php
		$args = array (
			'post_type' => 'fan-guest',
			'posts_per_page' => -1,
			'order'          => 'ASC',
			'orderby'        => 'title',

		);
		$query = new WP_Query($args);
		if ($query -> have_posts())	{
			echo '<section class="guest-container">';
			while ( $query -> have_posts()) {
				$query -> the_post();
				echo '<article class="guest-wrapper">';
					echo '<a href="'.get_permalink().'">';
						the_post_thumbnail('thumbnail');
					echo '<h2>'.get_the_title().'</h2>';
					echo '</a>';

					// make acf for guest page AK 
					if ( function_exists ( 'get_field' ) ) {
					if ( get_field( 'occupation_of_guest' ) ) {
							echo '<p>';
							the_field( 'occupation_of_guest' );
							echo '</p>';
					}
			} 
			echo '</article>';
			}
			wp_reset_postdata();
			echo '</section>';
		}
	
		?>

		<?php get_template_part('template-parts/page', 'bottom'); ?>


	</main><!-- #primary -->

<?php

get_footer();
