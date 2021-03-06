<?php
/**
 * WooCommerce Compatibility File
 *
 * @link https://woocommerce.com/
 *
 * @package Fandomonium
 */

/**
 * WooCommerce setup function.
 *
 * @link https://docs.woocommerce.com/document/third-party-custom-theme-compatibility/
 * @link https://github.com/woocommerce/woocommerce/wiki/Enabling-product-gallery-features-(zoom,-swipe,-lightbox)
 * @link https://github.com/woocommerce/woocommerce/wiki/Declaring-WooCommerce-support-in-themes
 *
 * @return void
 */
function fandomonium_woocommerce_setup() {
	add_theme_support(
		'woocommerce',
		array(
			'thumbnail_image_width' => 300,
			'single_image_width'    => 600,
			'product_grid'          => array(
				'default_rows'    => 3,
				'min_rows'        => 1,
				'default_columns' => 4,
				'min_columns'     => 1,
				'max_columns'     => 6,
			),
		)
	);
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
}
add_action( 'after_setup_theme', 'fandomonium_woocommerce_setup' );

/**
 * WooCommerce specific scripts & stylesheets.
 *
 * @return void
 */
function fandomonium_woocommerce_scripts() {
	wp_enqueue_style( 'fandomonium-woocommerce-style', get_template_directory_uri() . '/woocommerce.css', array(), _S_VERSION );

	$font_path   = WC()->plugin_url() . '/assets/fonts/';
	$inline_font = '@font-face {
			font-family: "star";
			src: url("' . $font_path . 'star.eot");
			src: url("' . $font_path . 'star.eot?#iefix") format("embedded-opentype"),
				url("' . $font_path . 'star.woff") format("woff"),
				url("' . $font_path . 'star.ttf") format("truetype"),
				url("' . $font_path . 'star.svg#star") format("svg");
			font-weight: normal;
			font-style: normal;
		}';

	wp_add_inline_style( 'fandomonium-woocommerce-style', $inline_font );
}
add_action( 'wp_enqueue_scripts', 'fandomonium_woocommerce_scripts' );

/**
 * Disable the default WooCommerce stylesheet.
 *
 * Removing the default WooCommerce stylesheet and enqueing your own will
 * protect you during WooCommerce core updates.
 *
 * @link https://docs.woocommerce.com/document/disable-the-default-stylesheet/
 */
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

/**
 * Add 'woocommerce-active' class to the body tag.
 *
 * @param  array $classes CSS classes applied to the body tag.
 * @return array $classes modified to include 'woocommerce-active' class.
 */
function fandomonium_woocommerce_active_body_class( $classes ) {
	$classes[] = 'woocommerce-active';

	return $classes;
}
add_filter( 'body_class', 'fandomonium_woocommerce_active_body_class' );

/**
 * Related Products Args.
 *
 * @param array $args related products args.
 * @return array $args related products args.
 */
function fandomonium_woocommerce_related_products_args( $args ) {
	$defaults = array(
		'posts_per_page' => 3,
		'columns'        => 3,
	);

	$args = wp_parse_args( $defaults, $args );

	return $args;
}
add_filter( 'woocommerce_output_related_products_args', 'fandomonium_woocommerce_related_products_args' );

/**
 * Remove default WooCommerce wrapper.
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

if ( ! function_exists( 'fandomonium_woocommerce_wrapper_before' ) ) {
	/**
	 * Before Content.
	 *
	 * Wraps all WooCommerce content in wrappers which match the theme markup.
	 *
	 * @return void
	 */
	function fandomonium_woocommerce_wrapper_before() {
		?>
			<main id="primary" class="site-main">
		<?php
	}
}
add_action( 'woocommerce_before_main_content', 'fandomonium_woocommerce_wrapper_before' );

if ( ! function_exists( 'fandomonium_woocommerce_wrapper_after' ) ) {
	/**
	 * After Content.
	 *
	 * Closes the wrapping divs.
	 *
	 * @return void
	 */
	function fandomonium_woocommerce_wrapper_after() {
		?>
			</main><!-- #main -->
		<?php
	}
}
add_action( 'woocommerce_after_main_content', 'fandomonium_woocommerce_wrapper_after' );

/**
 * Sample implementation of the WooCommerce Mini Cart.
 *
 * You can add the WooCommerce Mini Cart to header.php like so ...
 *
	<?php
		if ( function_exists( 'fandomonium_woocommerce_header_cart' ) ) {
			fandomonium_woocommerce_header_cart();
		}
	?>
 */

if ( ! function_exists( 'fandomonium_woocommerce_cart_link_fragment' ) ) {
	/**
	 * Cart Fragments.
	 *
	 * Ensure cart contents update when products are added to the cart via AJAX.
	 *
	 * @param array $fragments Fragments to refresh via AJAX.
	 * @return array Fragments to refresh via AJAX.
	 */
	function fandomonium_woocommerce_cart_link_fragment( $fragments ) {
		ob_start();
		fandomonium_woocommerce_cart_link();
		$fragments['a.cart-contents'] = ob_get_clean();

		return $fragments;
	}
}
add_filter( 'woocommerce_add_to_cart_fragments', 'fandomonium_woocommerce_cart_link_fragment' );

if ( ! function_exists( 'fandomonium_woocommerce_cart_link' ) ) {
	/**
	 * Cart Link.
	 *
	 * Displayed a link to the cart including the number of items present and the cart total.
	 *
	 * @return void
	 */
	function fandomonium_woocommerce_cart_link() {
		?>
		<a class="cart-contents" href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="<?php esc_attr_e( 'View your shopping cart', 'fandomonium' ); ?>">
			<?php
			$item_count_text = sprintf(
				/* translators: number of items in the mini cart. */
				_n( '%d item', '%d items', WC()->cart->get_cart_contents_count(), 'fandomonium' ),
				WC()->cart->get_cart_contents_count()
			);
			?>
			<span class="amount"><?php echo wp_kses_data( WC()->cart->get_cart_subtotal() ); ?></span> <span class="count"><?php echo esc_html( $item_count_text ); ?></span>
		</a>
		<?php
	}
}

if ( ! function_exists( 'fandomonium_woocommerce_header_cart' ) ) {
	/**
	 * Display Header Cart.
	 *
	 * @return void
	 */
	function fandomonium_woocommerce_header_cart() {
		if ( is_cart() ) {
			$class = 'current-menu-item';
		} else {
			$class = '';
		}
		?>
		<ul id="site-header-cart" class="site-header-cart">
			<li class="<?php echo esc_attr( $class ); ?>">
				<?php fandomonium_woocommerce_cart_link(); ?>
			</li>
			<li>
				<?php
				$instance = array(
					'title' => '',
				);

				the_widget( 'WC_Widget_Cart', $instance );
				?>
			</li>
		</ul>
		<?php
	}
}

/**
 * Remove sidebar on woocommerce pages
 */
remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar', 10);

/*********** 
 * Specific to Shop Page (archive-product.php) *
 ************/

/**
 * Add Ticket fields to archive-product.php in woocommerce
 */
add_action('woocommerce_archive_description', 'add_ticket_fields', 15);
function add_ticket_fields() {
	if (function_exists('get_field')) {
		if (get_field('ticket_page_description', 27)) { ?>
			<p><?php the_field('ticket_page_description', 27);?></p>
		<?php
		}
	}
}

/**
 * Remove WooCommerce Shop Results Count
 */
remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);

/**
 * Remove WooCommerce Sorting Dropdown
 */
remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);

/**
 * Default catalogue product ordering by price ASC
 */
add_filter( 'woocommerce_default_catalog_orderby', 'fan_default_catalog_orderby');

function fan_default_catalog_orderby( $sort_by ) {
	return 'price';
}

/**
 * Add Product description on archive-products.php
 */
add_action('woocommerce_after_shop_loop_item_title', 'add_product_excerpt', 20);
function add_product_excerpt() {
	the_excerpt();
}

/**
 * Display currency next to price
 */
add_action('woocommerce_after_shop_loop_item_title', 'add_currency', 15);
function add_currency() {
	$currency = get_woocommerce_currency();
	echo '<span class="currency-display">'. $currency .'</span>';
}

/**
 * Show number of items in Cart
 */
function show_number_of_cart_items() {
	echo "<div class='cart-items'>";
	echo "<p>You have <span class='items-number'>". WC()->cart->get_cart_contents_count() ."</span> item(s) in your Cart</p>";
}
add_action('woocommerce_after_shop_loop', 'show_number_of_cart_items', 20);

/**
 * Checkout button to Cart page
 */
function checkout_button() { ?>
	<a class='checkout-btn' href='<?php echo get_permalink(28) ?>'>checkout</a>
	</div>
	<?php
}
add_action('woocommerce_after_shop_loop', 'checkout_button', 30);

/**
 * Add Page Bottom Template Part to bottom of Shop page
 */
function page_bottom_template_part() {
	get_template_part( 'template-parts/page', 'bottom' );
}
add_action('woocommerce_after_shop_loop', 'page_bottom_template_part', 40);

/*********** 
 * Specific to Single Product Pages (single-product.php) *
 ************/

/**
 * Remove Product Tabs after Product Meta
 */
remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10);

/**
 * Remove Related Products
 */
remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);

/**
 * Display currency next to price
 */
add_action('woocommerce_single_product_summary', 'add_currency', 15);

/**
 * Add number of items in cart and checkout link
 */
add_action('woocommerce_after_single_product_summary', 'show_number_of_cart_items', 20);
add_action('woocommerce_after_single_product_summary', 'checkout_button', 30);

/**
 * Display subheading for 'Quantity'
 */
function add_qty_subheading() {
	echo '<p class="quantity-title">Qty</p>';
}
add_action('woocommerce_before_add_to_cart_quantity', 'add_qty_subheading', 99);