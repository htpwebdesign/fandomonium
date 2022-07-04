<?php

/**
 * The List of News (Blog) template file
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Fandomonium
 */

get_header();
?>

<main id="primary" class="site-main">

	<?php
	if (have_posts()) :

		if (is_home() && !is_front_page()) :
	?>
			<header class="no-banner-header">
				<h1 class="archive-title"><?php single_post_title(); ?></h1>
			</header>
			<?php
		endif; ?>

		<?php
		if (function_exists('get_field')) {
			if (get_field('news_page_description', 89)) { ?>
				<p><?php the_field('news_page_description', 89); ?></p>
			<?php
			}
		}

		get_sidebar();

		/* Start the Loop */
		while (have_posts()) :
			the_post();
			?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<?php fandomonium_post_thumbnail(); ?>
				
				<header class="entry-header">
					<?php the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>'); ?>
				</header>
			</article>
		<?php
		endwhile;

		the_posts_navigation();

	else :

		get_template_part('template-parts/content', 'none');

	endif;
	get_template_part('template-parts/page', 'bottom');

		?>

</main><!-- #main -->

<?php
get_footer();
