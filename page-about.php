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

		<section>
		<?php
		while ( have_posts() ) :
			the_post();

			the_title( '<h1 class="entry-title">', '</h1>' );

			if ( function_exists ( 'get_field' ) ) {
 
				if ( get_field( 'about_the_organization' ) ) { ?>
					<h2>About the organization</h2>
					<p><?php get_field( 'about_the_organization' )?></p>
				<?php
				}
				
				if ( get_field( 'convention_purpose' ) ) { ?>
					<h2>Convention purpose/statement</h2>
					<p><?php get_field( 'convention_purpose' )?></p>
				<?php
				}
				
		}?>
		<h2>Location</h2>

		<?php
			$my_map = get_field('map');
			$my_map['address'];
			do_shortcode('[wpgmza id="1"]');
		?>
		<h2>Contact Form</h2>

		<?php 
			do_shortcode('[contact-form-7 id="9" title="Contact form 1"]');
			
			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;
			
		endwhile; // End of the loop.

		// make acf for about page AK 

		?>
		</section>
		
		<?php get_template_part('template-parts/page', 'bottom'); ?>

	</main><!-- #main -->

<?php

get_footer();
