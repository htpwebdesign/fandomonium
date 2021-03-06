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

		<section class=site-hero>
            <div class="hero-with-img">
                <?php the_title('<h1 class="page-title">', '</h1>'); ?>
                <?php fandomonium_post_thumbnail(); ?>
             <div class="vendor-apply">
					     <?php if(function_exists('get_field')):
						    if(get_field('cta')): ?>
							  <a href="<?php echo esc_url(get_field('cta')['url']); ?>" class="vendor-apply"><?php echo get_field('cta')['title']?></a>
						    <?php endif?>
					     <?php endif ?>
				      </div>
            </div>
        </section>
			
		<section class="vendors">
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
					
					<div class="platinum-vendors">
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
				

				<div class="list-contain">
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


						<div class="other-vendors">
							<?php if($query -> have_posts()):
								while($query -> have_posts()):
									$query->the_post();?>
									<h3><?php the_title();?></h3>
								<?php endwhile?>
							<?php wp_reset_postdata();?>
							<?php endif?>
						</div>
				</div>
			</section>

			<section>
				<h2 class="h1">Apply as a Vendor</h2>
				<p>These are our available tiers:</p>
				<div class="tiers">
					<?php 
						$terms = get_terms( 
							array(
								'taxonomy' => 'fan-vendor-type'
							) 
						);

						if ( $terms && ! is_wp_error( $terms ) ) :
							foreach ($terms as $term):?>
							<article>
								<h3><?php echo $term->name; ?></h3>
								<?php if(function_exists('get_field')):

									if(get_field('tier_picture', $term)):?>
										<img 
											class="tier-badge" 
											src="<?php echo get_field('tier_picture', $term)['sizes']['thumbnail'];?>"
											alt="<?php echo get_field('tier_picture', $term)['alt'];?>"
										>
									<?php endif?>

									<?php if(get_field('tier_price', $term)):?>
										<p class="price"><?php the_field('tier_price', $term);?></p>
									<?php endif?>
								<?php endif?>
								<p><?php echo $term->description;?></p>
							</article>
							<?php endforeach?>
						<?php endif?>
				</div>
				<div class="vendor-form">
				<h2>Vendor Resgistration Form</h2>
				<?php echo do_shortcode('[contact-form-7 id="63" title="Vendor Application" html_id="vendor-application"]');?>
				</div>
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
