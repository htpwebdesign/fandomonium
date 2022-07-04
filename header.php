<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Fandomonium
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'fandomonium' ); ?></a>

	<header id="masthead" class="site-header">
		<div class="site-branding">
			<?php
		
			// Display custom logo if custom logo exists. Otherwise display site title. 
			$custom_logo_id = get_theme_mod( 'custom_logo' );
			$logo = wp_get_attachment_image_src( $custom_logo_id , 'medium' );

			if ( has_custom_logo() ) {
				echo '<a href="'.get_the_permalink(85).'"><img src="' . esc_url( $logo[0] ) . '" alt="' . get_bloginfo( 'name' ) . '"></a>';
			} else {
				echo '<h1>' . get_bloginfo('name') . '</h1>';
			}


			if ( is_front_page() && is_home() ) :
				?>
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<?php
			else :
				?>
				<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
				<?php
			endif;
			$fandomonium_description = get_bloginfo( 'description', 'display' );
			if ( $fandomonium_description || is_customize_preview() ) :
				?>
				<p class="site-description"><?php echo $fandomonium_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
			<?php endif; ?>
		</div><!-- .site-branding -->

		<div>
			<?php 
				if (function_exists('get_field')) {
					if (get_field('start_date_of_convention', 'option') && get_field('end_date_of_convention', 'option')) {
					?>	
						<p><?php the_field('start_date_of_convention', 'option') . the_field('end_date_of_convention', 'option') ?></p>
					<?php
					}
					if (get_field('location_of_convention', 'option')) {
					?>
						<p><?php the_field('location_of_convention', 'option'); ?></p>
					<?php
					}
				}
			?>
		</div>

		<nav id="site-navigation" class="main-navigation">
			<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'fandomonium' ); ?></button>
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'menu-1',
					'menu_id'        => 'primary-menu',
				)
			);
			?>
		</nav><!-- #site-navigation -->
	</header><!-- #masthead -->
