<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Fandomonium
 */

?>

	<footer id="colophon" class="site-footer">
		<div class="site-info">
			<section class="footer-menu">
				<?php wp_nav_menu(array('theme_location' => 'footer')) ; ?>
			</section>
			<section class="socials-menu">
				<?php wp_nav_menu(array('theme_location' => 'social')) ; ?>
			</section>
			<span class="sep"> | </span>
				<?php
				/* translators: 1: Theme name, 2: Theme author. */
				printf( esc_html__( 'Theme: %1$s by %2$s.', 'fandomonium' ), 'fandomonium', '<a href="https://fandomonium.bcitwebdeveloper.ca">FWD30</a>' );
				?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
