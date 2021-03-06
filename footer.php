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
			<div class="footer-nav-contain">
				<nav class="footer-menu">
					<?php wp_nav_menu(array('theme_location' => 'footer')) ; ?>
				</nav>
				<nav class="socials-menu">
					<?php wp_nav_menu(array('theme_location' => 'social')) ; ?>
				</nav>
			</div>
			<div class="footer-bottom">
				<cite>&copy; 2022 Fandomonium - 
					<a href="#">Aleum K.</a>,
					<a href="#">Cory O.</a>,
					<a href="#">Erin D.</a>,
					<a href="#">Fiona Y.</a>
				</cite>
				<nav>
					<?php
					if (function_exists('get_field')) {
							if (get_field('location_of_convention', 'option')) {
								the_field('location_of_convention', 'option');
							}
						}
					?>
				</nav>
			</div>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
