<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Fandomonium
 */

get_header();
?>

	<main id="primary" class="site-main">

		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', get_post_type() );

			the_post_navigation(
				array(
					'prev_text' => '<span class="nav-subtitle">' . esc_html__( 'Previous:', 'fandomonium' ) . '</span> <span class="nav-title">%title</span>',
					'next_text' => '<span class="nav-subtitle">' . esc_html__( 'Next:', 'fandomonium' ) . '</span> <span class="nav-title">%title</span>',
				)
			);

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.


		if (function_exists('get_field')) :
			if (get_field('event_description')) :
				?>
					<p><?php the_field('event_description'); ?></p>
				<?php
			endif;

			$posts = get_field('guests');

			if( $posts ): ?>
					<ul>
						<?php foreach( $posts as $post ): ?>
							<li>
								<a href="<?php echo get_permalink( $post->ID ); ?>"><?php echo get_the_title( $post->ID ); ?></a>
							</li>
						<?php endforeach; ?>
					</ul>
				<?php 
			endif; 
		endif;

		


		?>

	</main><!-- #main -->

<?php
get_sidebar();
get_footer();