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
	<main class=site-hero>
		<section class="hero-no-img">
			<?php the_title('<h1 class="page-title">', '</h1>'); ?>
			<?php fandomonium_post_thumbnail(); ?>
		</section>
	</main>

	<main id="primary" class="site-main">

		<?php
		while ( have_posts() ) :
			the_post(); ?>
			
					<section>
					<?php if (function_exists('get_field')):
							if(get_field('short_description')):
					?>
								<p><?php the_field('short_description');?></p>
							<?php endif?>
						<?php endif?>
					
					<div id="my-accordion" class="accordionjs">
						<?php
						if (function_exists('get_field')):
							if(have_rows('faq')):
								while( have_rows('faq') ) : the_row();
						?>
								<button class="faq-heading accordion">
									<h2><?php echo get_sub_field('question');?></h2>
								</button>
								<div class="faq-answer panel">
									<p><?php echo get_sub_field('answer');?></p>
								</div>
								<?php endwhile?>
							<?php endif?>
						<?php endif?>

						<section class="contact">
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
		<?php get_template_part( 'template-parts/page', 'bottom' ); ?>
	</main><!-- #main -->

<?php
get_footer();
