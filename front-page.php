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
		<article>

		<?php
		while ( have_posts() ) :
			the_post();
		?>
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		<?php fandomonium_post_thumbnail(); ?>

		<section>
		
		</section>

		<?php
		endwhile; // End of the loop.
		?>

		</article>
		
	</main><!-- #main -->

<?php
get_footer();
