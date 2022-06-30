<?php

	
		if ( function_exists('get_fields') ) {
			if ( get_field( 'page_bottom_cta', 'options' ) ) {
				$link = get_field( 'page_bottom_cta', 'options' );
				$link_url = $link['url'];
				$link_title = $link['title'];
				?><a href="<?php echo esc_url( $link_url ); ?>"><?php echo esc_html($link_title) ?></a><?php
			}	
		}
	
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
	
		$query = new WP_Query( $args );
		if ( $query -> have_posts() ) {
			while ( $query -> have_posts() ) {
				$query -> the_post();
					the_title();

			}
			wp_reset_postdata();
		}


?>

