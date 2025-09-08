<?php
/**
 * Ecommerce Trendy Outfits functions
 */

if ( ! function_exists( 'ecommerce_trendy_outfits_setup' ) ) :
function ecommerce_trendy_outfits_setup() {
    load_theme_textdomain( 'ecommerce-trendy-outfits', get_template_directory() . '/languages' );

    /**
	* About Theme Function
	*/
	require get_theme_file_path( '/about-theme/about-theme.php' );

}
endif; 
add_action( 'after_setup_theme', 'ecommerce_trendy_outfits_setup' );

if ( ! function_exists( 'ecommerce_trendy_outfits_styles' ) ) :
	function ecommerce_trendy_outfits_styles() {
		// Register theme stylesheet.
		wp_register_style('ecommerce-trendy-outfits-style',
			get_template_directory_uri() . '/style.css',array(),
			wp_get_theme()->get( 'Version' )
		);

		wp_enqueue_style(
			'owl.carousel-css',
			get_template_directory_uri() . '/assets/css/owl.carousel.css',
			array(),
			'2.3.4'
		);

		wp_enqueue_script(
			'owl-carousel-js',
			get_template_directory_uri() . '/assets/js/owl.carousel.js',
			array('jquery'),
			'2.3.4',
			true
		);

		wp_enqueue_script('ecommerce-trendy-outfits-js',
        	get_template_directory_uri() . '/assets/js/effects.js',array(),
        	wp_get_theme()->get('Version'),true 
   		);

		// Enqueue theme stylesheet.
		wp_enqueue_style( 'ecommerce-trendy-outfits-style' );

		wp_style_add_data( 'ecommerce-trendy-outfits-style', 'rtl', 'replace' );
	}
endif;
add_action( 'wp_enqueue_scripts', 'ecommerce_trendy_outfits_styles' );

/**
 * TGM FILE
 */
require get_theme_file_path( '/tgm.php' );


function ecommerce_trendy_outfits_hide_wishlist_box_if_no_quick_view() {
    if ( ! class_exists( 'WPCleverWoosq' ) ) { 
        ?>
        <style>
            .wishlist-box {
                display: none !important;
            }
        </style>
        <?php
    }
}
add_action( 'wp_head', 'ecommerce_trendy_outfits_hide_wishlist_box_if_no_quick_view' );


/**
 * Customizer
 */
require get_template_directory() . '/inc/customizer.php';