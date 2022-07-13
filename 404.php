<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Fandomonium
 */

get_header();
?>

	<main id="primary" class="site-main">

		<section class="error-404 not-found">
			<header class="page-header">
				<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'fandomonium' ); ?></h1>
			</header><!-- .page-header -->

			<div class="page-content">
				<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try a search? But if you were looking for nothing, then woohoo! You found it!', 'fandomonium' ); ?></p>

					<?php
					get_search_form();
					?>

			</div><!-- .page-content -->
		</section><!-- .error-404 -->

		<?php get_template_part('template-parts/page', 'bottom'); ?>
	</main><!-- #main -->

<?php
get_footer();
