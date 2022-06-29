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

		endwhile; // End of the loop.?>

		<section>
			
				<h2>Our featured Vendors</h2>
				<? // wp query for platinum vendors only
				$args = array(
						'post_type' => 'fan-vendor',
						'posts_per_page' => -1,
						'tax_query' => array(
							array(
								'taxonomy' => 'fan-vendor-type',
								'field' => 'slug',
								'terms' => 'platinum',
							)
						)
					);
					$query = new WP_Query($args);?>
				
				<div>
					<? if($query -> have_posts()):
						while($query -> have_posts()):
							$query->the_post(); ?>
							<article>				
								<h3><?the_title();?></h3>
								<?the_post_thumbnail();?>
								<?	if (function_exists('get_field')): 
										if (get_field('vendor_description')):?>
												<p><?php the_field('vendor_description');?></p>
										<?endif; ?>
									<?endif?>
							</article>		
						<?endwhile?>
						<?wp_reset_postdata();?>
					<?endif?>
				</div>
			

				<h2>Other Vendors</h2>

				<? // wp query for all other vendors
				$args = array(
						'post_type' => 'fan-vendor',
						'posts_per_page' => -1,
						'tax_query' => array(
							array(
								'taxonomy' => 'fan-vendor-type',
								'field' => 'slug',
								'terms' => array('gold', 'silver', 'bronze')
							)
						)
					);
					$query = new WP_Query($args); ?>


					<div>
						<? if($query -> have_posts()):
							while($query -> have_posts()):
								$query->the_post();?>

								<h3><?the_title();?></h3>
							<?endwhile?>
						<?wp_reset_postdata();?>
						<?endif?>
					</div>
		</section>
	</main><!-- #main -->

<?php
get_sidebar();
get_footer();
