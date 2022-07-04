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
	
		$location = get_field('map');
		if( $location ): ?>
				<div class="acf-map" data-zoom="16">
						<div class="marker" data-lat="<?php echo esc_attr($location['lat']); ?>" data-lng="<?php echo esc_attr($location['lng']); ?>"></div>
				</div>
		<?php endif; ?>
		<p><em><?php echo esc_html( $location['address'] ); ?></em></p>
	<?php
			echo '<h2>Contact Form</h2>';
			echo do_shortcode('[contact-form-7 id="9" title="Contact form 1"]');
		
			
			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		// make acf for about page AK 

		?>
		</section>
			<?php endwhile;?> 
	</main><!-- #main -->

<?php

get_footer();
