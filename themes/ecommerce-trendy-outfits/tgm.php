<?php

require get_template_directory() . '/class-tgm-plugin-activation.php';
/**
 * Recommended plugins.
 */
function ecommerce_trendy_outfits_register_recommended_plugins() {
	$plugins = array(
		array(
			'name'      => esc_html__( 'WooCommerce', 'ecommerce-trendy-outfits' ),
			'slug'      => 'woocommerce',
			'source'           => '',
			'required'  => false,
			'force_activation' => false,
		),
		array(
			'name'      => esc_html__( 'YITH WooCommerce Wishlist', 'ecommerce-trendy-outfits' ),
			'slug'      => 'yith-woocommerce-wishlist',
			'source'           => '',
			'required'  => false,
			'force_activation' => false,
		),
		array(
			'name'      => esc_html__( 'WPC Smart Quick View for WooCommerce', 'ecommerce-trendy-outfits' ),
			'slug'      => 'woo-smart-quick-view',
			'source'           => '',
			'required'  => false,
			'force_activation' => false,
		)
	);
	$config = array();
	tgmpa( $plugins, $config );
}
add_action( 'tgmpa_register', 'ecommerce_trendy_outfits_register_recommended_plugins' );