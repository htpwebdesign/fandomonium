<?php
/**
 * The template for displaying work archives
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package FWD_Starter_Theme
 */

get_header();
?>

	<main id="primary" class="site-main">


			<header class="page-header">
				<?php
				the_archive_title( '<h1 class="page-title">', '</h1>' );
				the_archive_description( '<div class="archive-description">', '</div>' );
				?>
			</header><!-- .page-header -->

		<div class="guest-part">
		
		<?php
		$args = array (
			'post_type' => 'fan-guest',
			'posts_per_page' => -1,
			'order'          => 'ASC',
			'orderby'        => 'title',

		);
		$query = new WP_Query($args);
		if ($query -> have_posts())	{
			echo '<section>';
			while ( $query -> have_posts()) {
				$query -> the_post();
				echo '<article>';
					the_post_thumbnail('thumbnail');
					echo '<h2>'.get_the_title().'</h2>';
					// make acf for guest page AK 
					if ( function_exists ( 'get_field' ) ) {
					if ( get_field( 'occupation_of_guest' ) ) {
							the_field( 'occupation_of_guest' );
					}
			} 
					echo '<a href="'.get_permalink().'"> View Bio';
					echo '</a>';
				echo '</article>';
			}
			wp_reset_postdata();
			echo '</section>';
		}
	
		?>
		</div>


	</main><!-- #primary -->

<?php

get_footer();
