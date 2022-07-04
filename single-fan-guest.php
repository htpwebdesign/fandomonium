<?php
/**
 * The template for displaying all single Work posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package FWD_Starter_Theme
 */

get_header();
?>

	<main id="primary" class="site-main">

		<?php 
		
		$link = get_field('back');
		if( $link ): ?>
		<section>
		<a class="button" href="<?php echo esc_url( $link ); ?>"><- Back to guest List</a>
		<?php endif; ?>
		</section>
		
		<section>
		<?php
		while ( have_posts() ) :
			the_post();
			get_template_part( 'template-parts/content', get_post_type() );

			if ( function_exists ( 'get_field' ) ) {
				if ( get_field( 'guest_description' ) ) {
					echo '<p>'.	get_field( 'guest_description' ) .'</p>';
				}
		} 
		
					// Add an ACF relationship field and assign it to the Single guest page
					if ( function_exists( 'get_field' ) ) : 
							$featured_works = get_field('guest_event');
							if ($featured_works) :
									foreach($featured_works as $post) :
											setup_postdata($post); 
											?>
											<article class="event-link">
													<a href="<?php the_permalink(); ?>">
															<h3><?php the_title(); ?></h3>
													</a>
											</article>
											<?php 
									endforeach;
									wp_reset_postdata();
							endif;
					endif;

				$image = get_field('image_icon1');
				if (!empty($image)) {
					$url = get_field('image_url1');
					?>
						<a href="<?php echo $url; ?>" target="_blank"><img src="<?php 
								echo $image['url']; ?>" alt="<?php 
								echo $image['alt']; ?>" /></a>
					<?php 
				}

				$image = get_field('image_icon2');
				if (!empty($image)) {
					$url = get_field('image_url2');
					?>
						<a href="<?php echo $url; ?>" target="_blank"><img src="<?php 
								echo $image['url']; ?>" alt="<?php 
								echo $image['alt']; ?>" /></a>
					<?php 
				}

			the_post_navigation(
				array(
					'prev_text' => '<span class="nav-subtitle">' . esc_html__( 'Previous:', 'fwd' ) . '</span> <span class="nav-title">%title</span>',
					'next_text' => '<span class="nav-subtitle">' . esc_html__( 'Next:', 'fwd' ) . '</span> <span class="nav-title">%title</span>',
				)
			);


		endwhile; // End of the loop.
		?>

	</main><!-- #primary -->
	</section>
<?php
get_footer();
