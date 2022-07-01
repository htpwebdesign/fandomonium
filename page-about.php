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
				
		}?>
			<article>
				<h2>Location</h2>

				<?php
					$my_map = get_field('map');
					$my_map['address'];
					echo do_shortcode('[wpgmza id="1"]');
				?>
			</article>
			<article>
				<h2>Contact Form</h2>

				<?php 
					echo do_shortcode('[contact-form-7 id="9" title="Contact form 1"]');

				endwhile; // End of the loop.

				// make acf for about page AK 
				?>
			</article>
		</section>

		<?php get_template_part('template-parts/page', 'bottom'); ?>

	</main><!-- #main -->

<?php
get_footer();
