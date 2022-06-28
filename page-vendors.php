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

		$terms = get_terms(
			array(
				'taxonomy' => 'fan-vendor-type'
			)
		);

		if ( $terms && ! is_wp_error( $terms ) ) :
			foreach ($terms as $term):?>

			<h2><?echo $term->name; ?></h2>

			<? 
			$args = array(
					'post_type' => 'fan-vendor',
					'posts_per_page' => -1,
					'tax_query' => array(
						array(
							'taxonomy' => 'fan-vendor-type',
							'field' => 'slug',
							'terms' => $term->slug,
						)
					),
					'orderby' => 'title',
					'order'   => 'ASC',
				);
				$query = new WP_Query($args);

				print_r($query);
			?>


			<?php endforeach // end the foreach?> 
		<?php endif // end if for the terms?>
		
				

	</main><!-- #main -->

<?php
get_sidebar();
get_footer();
