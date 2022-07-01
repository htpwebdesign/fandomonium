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
		?>

		<section>
			<?
				if (function_exists('get_field')):
					if(get_field('short_description')):
			?>
						<p><?the_field('short_description');?></p>
					<?endif?>
				<?endif?>
			
			<div>
				<?
				if (function_exists('get_field')):
					if(have_rows('faq')):
						while( have_rows('faq') ) : the_row();
				?>
						<div class="faq-heading">
							<h2><?echo get_sub_field('question');?></h2>
						</div>
						<div class="faq-answer">
							<p><?echo get_sub_field('answer');?></p>
						</div>
						<?endwhile?>
					<?endif?>
				<?endif?>

				<section>
					<?if (function_exists('get_field')):
					if(get_field('cta_sentence')): ?>
						<p><? the_field('cta_sentence'); ?></p>
					<?endif?>
						<? if(get_field('cta')): ?>
							<a href="<?echo esc_url((get_field('cta')['url']))?>"><? echo esc_html((get_field('cta')['title']))?></a>
						<?endif?>
					<?endif?>
				</section>

			</div>
		</section>

	</main><!-- #main -->

<?php
get_footer();
