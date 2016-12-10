<?php
/**
 * Functions.php
 *
 * @package  Theme_Customisations
 * @author   WooThemes
 * @since    1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * functions.php
 * Add PHP snippets here
 */
add_action('init','delay_remove');
function delay_remove() {
	remove_action( 'woocommerce_after_shop_loop', 'woocommerce_catalog_ordering', 10 );
	remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 10 );
}

// Hook in
add_filter( 'woocommerce_default_address_fields' , 'custom_override_default_address_fields', 10 );

// Our hooked in function - $address_fields is passed via the filter!
/*
country
first_name
last_name
company
address_1
address_2
city
state
postcode
*/
function custom_override_default_address_fields( $address_fields ) {
     $address_fields['address_1']['required'] = false;
     $address_fields['address_2']['required'] = false;
     $address_fields['company']['required'] = false;
     $address_fields['city']['required'] = false;
     $address_fields['state']['required'] = false;
     $address_fields['postcode']['required'] = false;
     $address_fields['country']['required'] = false;

     return $address_fields;
}

// Hook in
add_filter( 'woocommerce_checkout_fields' , 'custom_override_checkout_fields', 10 );

	//unset($fields['order']['order_comments']);
	//unset($fields['billing']['billing_company']);
	//unset($fields['billing']['billing_phone']);
	//unset($fields['order']['order_comments']);

// Our hooked in function – $fields is passed via the filter!
function custom_override_checkout_fields( $fields ) {

	unset($fields['billing']['billing_address_1']);
	unset($fields['billing']['billing_address_2']);
    unset($fields['billing']['billing_city']);
    unset($fields['billing']['billing_postcode']);
    unset($fields['billing']['billing_country']);
    unset($fields['billing']['billing_state']);

return $fields;
}



/*
 * Custom footer
 */
add_action( 'init', 'custom_remove_footer_credit', 10 );
function custom_remove_footer_credit () {
    remove_action( 'storefront_footer', 'storefront_credit', 20 );
    add_action( 'storefront_footer', 'custom_storefront_credit', 20 );
}

function custom_storefront_credit() {
?>
	<div class="site-info">
		&copy; <?php echo get_bloginfo( 'name' ) . ' ' . get_the_date( 'Y' ); ?>
	</div><!-- .site-info -->
<?php
}
?>