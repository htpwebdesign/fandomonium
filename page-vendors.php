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
			the_post();?>

		<section>
					<h1><?php the_title(); ?></h1>
					<h2>Our featured Vendors</h2>
					<?php // wp query for platinum vendors only
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
						<?php if($query -> have_posts()):
							while($query -> have_posts()):
								$query->the_post(); ?>
								<article>				
									<h3><?php the_title();?></h3>
									<?php the_post_thumbnail();?>
									<?php if (function_exists('get_field')): 
											if (get_field('vendor_description')):?>
													<p><?php the_field('vendor_description');?></p>
											<?php endif; ?>
										<?php endif?>
								</article>		
							<?php endwhile?>
							<?php wp_reset_postdata();?>
						<?php endif?>
					</div>
				

					<h2>Other Vendors</h2>

					<?php // wp query for all other vendors
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
							<?php if($query -> have_posts()):
								while($query -> have_posts()):
									$query->the_post();?>

									<h3><?php the_title();?></h3>
								<?php endwhile?>
							<?php wp_reset_postdata();?>
							<?php endif?>
						</div>
			</section>

			<section>
				<h2 class="h1" id="vendor-apply">Apply as a Vendor</h2>
				<div>
					<p>These are our available tiers:</p>
					<?php 
						$terms = get_terms( 
							array(
								'taxonomy' => 'fan-vendor-type'
							) 
						);

						if ( $terms && ! is_wp_error( $terms ) ) :
							foreach ($terms as $term):?>
							
							<h3><?php echo $term->name; ?></h3>
							<?php if(function_exists('get_field')):
								if(get_field('tier_price', $term)):?>
								<p><?php the_field('tier_price', $term);?></p>
								<?php endif?>
							<?php endif?>
							<p><?echo $term->description;?></p>

							<?php endforeach?>
						<?php endif?>
				</div>
				<?php echo do_shortcode('[contact-form-7 id="63" title="Vendor Application"]');?>
			</section>

			<?php // If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.?>

		<?php get_template_part( 'template-parts/page', 'bottom' ); ?>
	</main><!-- #main -->

<?php
get_footer();
