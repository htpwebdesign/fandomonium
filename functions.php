<?php
/**
 * Fandomonium functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Fandomonium
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function fandomonium_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on Fandomonium, use a find and replace
		* to change 'fandomonium' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'fandomonium', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );
	
	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'header' => esc_html__( 'Header Menu Location', 'fandomonium' ),
			'footer' => esc_html__( 'Footer Menu Location', 'fandomonium' ),
			'social' => esc_html__( 'Social Menu Location', 'fandomonium' )
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'fandomonium_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	// Custom img crop sizes
	

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'fandomonium_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function fandomonium_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'fandomonium_content_width', 640 );
}
add_action( 'after_setup_theme', 'fandomonium_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function fandomonium_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'fandomonium' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'fandomonium' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'fandomonium_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function fandomonium_scripts() {
	wp_enqueue_style( 'fandomonium-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'fandomonium-style', 'rtl', 'replace' );

	// google font 'source-sans-3'
	wp_enqueue_style( 'wpb-google-fonts', 'https://fonts.googleapis.com/css2?family=Source+Sans+3:ital,wght@0,200;0,300;0,400;0,700;1,200;1,300;1,400;1,500;1,600;1,700&display=swap', array(), null ); 
	
	// navigation script
	wp_enqueue_script( 'fandomonium-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );
	
	// schedule tabs script - schedule page id = 12
	if (is_page(12)) {
		wp_enqueue_script( 'fandomonium-schedule', get_template_directory_uri() . '/js/schedule.js', array(), _S_VERSION, true );
	}

	// animate on scroll
	// wp_enqueue_style( 'AOS-style','https://unpkg.com/aos@2.3.1/dist/aos.css', array(), _S_VERSION, "(prefers-reduced-motion: no-preference)" );
	wp_enqueue_script( 'fandomonium-AOS','https://unpkg.com/aos@2.3.1/dist/aos.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'fandomonium-AOS-init', get_template_directory_uri() . '/js/AOS.js', array('fandomonium-AOS'), _S_VERSION, true );
	
	/*google map AK*/
	wp_enqueue_script( 'google-map',	'https://maps.googleapis.com/maps/api/js?key=AIzaSyBlc0CQZKqH8D3hXgsuXY3QYWwIlWEO8Sw', array(), _S_VERSION, true );
	wp_enqueue_script( 'google-map-init',get_template_directory_uri() . '/js/google-map-script.js', array('google-map','jquery'), _S_VERSION, true );

	/*accordion script */
	wp_enqueue_script( 'fandomonium-accordion', get_template_directory_uri() . '/js/accordion.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'fandomonium_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce.php';
}

/**
 *Load custom post types and taxonomies.
 */
require get_template_directory() . '/inc/cpt-taxonomy.php';

/**
 *Load options page from ACF Pro plugin
 */
if( function_exists('acf_add_options_page') ) {
	acf_add_options_page();
	acf_add_options_sub_page('General');	
	acf_add_options_sub_page('Header');
}

/**
 * Remove Block Editor from Pages
 */
function fan_post_filter( $use_block_editor, $post ) {
    // Change the integer in array to your Page ID
    $page_ids = array( 27, 85, 89, 12, 73, 37, 137 );
    if ( in_array( $post->ID, $page_ids ) ) {
        return false;
    } else {
        return $use_block_editor;
    }
}
add_filter( 'use_block_editor_for_post', 'fan_post_filter', 10, 2 );


function fan_archive_title_prefix( $prefix ){
		if ( get_post_type() === 'fan-guest' ) {
				return false;
		} else {
				return $prefix;
		}
}
add_filter( 'get_the_archive_title_prefix', 'fan_archive_title_prefix' );

/* google map  */
function my_acf_google_map_api( $api ){
	$api['key'] = 'AIzaSyBlc0CQZKqH8D3hXgsuXY3QYWwIlWEO8Sw';
	return $api;
}
add_filter('acf/fields/google_map/api', 'my_acf_google_map_api');

/**
 * Lower Yoast SEO Metabox location
 */
function yoast_to_bottom(){
	return 'low';
}
add_filter( 'wpseo_metabox_prio', 'yoast_to_bottom' );

/*    custom logo for login screen      */
function wpdev_filter_login_head() {
 
    if ( has_custom_logo() ) :
 
        $image = wp_get_attachment_image_src( get_theme_mod( 'custom_logo' ), 'thumbnail' );
        ?>
        <style type="text/css">
            .login h1 a {
                background-image: url(<?php echo esc_url( $image[0] ); ?>);
                -webkit-background-size: <?php echo absint( $image[1] )?>px;
                background-size: <?php echo absint( $image[1] ) ?>px;
                height: <?php echo absint( $image[2] ) ?>px;
                width: <?php echo absint( $image[1] ) ?>px;
            }
        </style>
        <?php
    endif;
}
 
add_action( 'login_head', 'wpdev_filter_login_head', 100 );



function remove_dashboard_widgets() {
    global $wp_meta_boxes;
  
    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_drafts']);
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);
    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);
  
} 
add_action('wp_dashboard_setup', 'remove_dashboard_widgets' );


  
function my_custom_dashboard_widgets() {
global $wp_meta_boxes;
 
wp_add_dashboard_widget('custom_help_widget', 'Theme Support', 'custom_dashboard_help');
}
 
function custom_dashboard_help() {
	?>
		<a href="<?php echo wp_get_attachment_url(319); ?>">Tutorial PDF</a>
	<?php
}

add_action('wp_dashboard_setup', 'my_custom_dashboard_widgets');



