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
			the_post(); ?>

			
					<section>
						<h1><?php the_title();?></h1>
					<?php if (function_exists('get_field')):
							if(get_field('short_description')):
					?>
								<p><?php the_field('short_description');?></p>
							<?php endif?>
						<?php endif?>
					
					<div>
						<?php
						if (function_exists('get_field')):
							if(have_rows('faq')):
								while( have_rows('faq') ) : the_row();
						?>
								<div class="faq-heading">
									<h2><?php echo get_sub_field('question');?></h2>
								</div>
								<div class="faq-answer">
									<p><?php echo get_sub_field('answer');?></p>
								</div>
								<?php endwhile?>
							<?php endif?>
						<?php endif?>

						<section>
							<?php if (function_exists('get_field')):
							if(get_field('cta_sentence')): ?>
								<p><?php the_field('cta_sentence'); ?></p>
							<?php endif?>
								<?php if(get_field('cta')): ?>
									<a href="<?php echo esc_url((get_field('cta')['url']))?>"><?php echo esc_html((get_field('cta')['title']))?></a>
								<?php endif?>
							<?php endif?>
						</section>

					</div>
				</section>

			<?php // If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

<?php
get_footer();
