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

		// make acf for about page AK 
		if ( function_exists ( 'get_field' ) ) {
 
			if ( get_field( 'about_the_organization' ) ) {
				echo '<h1>About the organization</h1>';
					the_field( 'about_the_organization' );
			}
			
			if ( get_field( 'convention_purpose' ) ) {
				echo '<h1>Convention purpose/statement</h1>';
					echo '<p>'. get_field( 'convention_purpose' ) .'</p>';
			}
			
	} 
		echo do_shortcode('[contact-form-7 id="9" title="Contact form 1"]');
		
		echo do_shortcode('[wpgmza id="1"]');
		$my_map = get_field('map');
		echo $my_map['address'];
		
		?>

	</main><!-- #main -->

<?php
get_sidebar();
get_footer();
