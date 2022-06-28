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

		<section class="welcome-message">

			<?php
				if (function_exists('get_fields')) {

					if (get_field('welcome_heading')) {
						?>
						<h2><?php the_field('welcome_heading'); ?></h2>
						<?php
					}

					if (get_field('welcome_message')) {
						?>
						<p><?php the_field('welcome_message'); ?></p>
						<?php
					}
				}
			?>

		</section>
		<section class="featured-events"></section>
		<section class="featured-news"></section>
		<section class="featured-guests"></section>
		<section class="featured-vendors"></section>

		<?php
		endwhile; // End of the loop.
		?>

		</article>

	</main><!-- #main -->

<?php
get_footer();
