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
	<main class=site-hero>
		<section class="hero-no-img">
			<?php the_title('<h1 class="page-title">', '</h1>'); ?>
			<?php fandomonium_post_thumbnail(); ?>
		</section>
	</main>

	<main id="primary" class="site-main">

	<section class="about-content">
		<?php
		while ( have_posts() ) :
			the_post(); ?>
		
		<?php
			if ( function_exists ( 'get_field' ) ) {
 
				if ( get_field( 'about_the_organization' ) ) { ?>
					<article>
						<h2>About the organization</h2>
						<p><?php the_field( 'about_the_organization' )?></p>
					</article>
				<?php
				}
				
				if ( get_field( 'convention_purpose' ) ) { ?>
					<article>
						<h2>Convention purpose/statement</h2>
						<p><?php the_field( 'convention_purpose' )?></p>
					</article>
				<?php
				}
		} ?>
			<section class="about-grid">
    	<article>
      		<h2>Location</h2>
			
			<?php
		  		$location = get_field('map');
		  		if( $location ): ?>
				  <div class="acf-map" data-zoom="16">
						  <div class="marker" data-lat="<?php echo esc_attr($location['lat']); ?>" data-lng="<?php echo esc_attr($location['lng']); ?>"></div>
				  </div>
		  <?php endif; ?>
		    <p><em><?php echo esc_html( $location['address'] ); ?></em></p>

		</article>
		<article>
				<h2>Contact Form</h2>

				<?php echo do_shortcode('[contact-form-7 id="9" title="Contact form 1"]'); ?>
        
		  </article>
      <?php endwhile; // End of the loop. ?>
			</section>
		</section>

		<?php get_template_part('template-parts/page', 'bottom'); ?>
    
	</main><!-- #main -->


<?php
get_footer();
