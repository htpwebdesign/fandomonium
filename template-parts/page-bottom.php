<?php

/**
 * Template part for bottom of each page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Fandomonium
 */
?>
<section class="page-bottom-section">

	<?php
	// Includes CTA from Options subpage 'General'
	// This piece will not show on archive-product.php
	if (!is_post_type_archive('product')) {
		if (function_exists('get_fields')) {
			if (get_field('page_bottom_cta', 'options')) {
				$link = get_field('page_bottom_cta', 'options');
				$link_url = $link['url'];
				$link_title = $link['title'];
	?>
				<article class="buy-tickets-cta">
					<a href="<?php echo esc_url($link_url); ?>">
						<?php echo esc_html($link_title) ?>
					</a>
				</article>
	<?php
			}
		}
	}
	?>
	<?php
	// Includs section for featured vendors
	// This piece will not show on page-vendors.php
	if (!is_page(73)) {
		$args = array(
			'post_type' 	 => 'fan-vendor',
			'posts_per_page' => 6,
			'tax_query' => array(
				array(
					'taxonomy' => 'fan-vendor-type',
					'field'    => 'slug',
					'terms'    => 'platinum',
				),
			)
		);

		$query = new WP_Query($args);
		if ($query->have_posts()) {
	?>
			<article class="feat-vendors">
				<?php
				while ($query->have_posts()) {
					$query->the_post();
					the_title();
				}
				?>
			</article>
	<?php
			wp_reset_postdata();
		}
	}
	?>
</section>