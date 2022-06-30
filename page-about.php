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
 
				if ( get_field( 'about_the_organization' ) ) {
					echo '<h1>About the organization</h1>';
					echo '<p>'. get_field( 'about_the_organization' ) .'</p>';
				}
				
				if ( get_field( 'convention_purpose' ) ) {
					echo '<h2>Convention purpose/statement</h2>';
						echo '<p>'. get_field( 'convention_purpose' ) .'</p>';
				}
				
		} 
			echo '<h2>Location</h2>';
			$my_map = get_field('map');
			echo $my_map['address'];
			echo do_shortcode('[wpgmza id="1"]');
		
	
			echo '<h2>Contact Form</h2>';
			echo do_shortcode('[contact-form-7 id="9" title="Contact form 1"]');
		
		
			
			
			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;
			
		endwhile; // End of the loop.

		// make acf for about page AK 

		?>
		</section>
	</main><!-- #main -->

<?php

get_footer();
