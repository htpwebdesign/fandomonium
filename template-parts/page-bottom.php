<?php

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

