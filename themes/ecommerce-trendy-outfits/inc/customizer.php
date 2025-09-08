<?php
/**
 * Customizer
 * 
 * @package WordPress
 * @subpackage ecommerce-trendy-outfits
 * @since ecommerce-trendy-outfits 1.0
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function ecommerce_trendy_outfits_customize_register( $wp_customize ) {
    // Check for existence of WP_Customize_Manager before proceeding
	if ( ! class_exists( 'WP_Customize_Manager' ) ) {
        return;
    }
    
    // Add the "Go to Premium" upsell section
	$wp_customize->add_section( new Ecommerce_Trendy_Outfits_Upsell_Section( $wp_customize, 'upsell_premium_section', array(
		'title'       => __( 'Ecommerce Trendy Outfits', 'ecommerce-trendy-outfits' ),
		'button_text' => __( 'GO TO PREMIUM', 'ecommerce-trendy-outfits' ),
		'url'         => esc_url( ECOMMERCE_TRENDY_OUTFITS_BUY_NOW ),
		'priority'    => 0,
	)));

	// Add the "Bundle" upsell section
	$wp_customize->add_section( new Ecommerce_Trendy_Outfits_Upsell_Section( $wp_customize, 'upsell_bundle_section', array(
		'title'       => __( 'All themes in Single Package', 'ecommerce-trendy-outfits' ),
		'button_text' => __( 'GET BUNDLE', 'ecommerce-trendy-outfits' ),
		'url'         => esc_url( ECOMMERCE_TRENDY_OUTFITS_BUNDLE ),
		'priority'    => 1,
	)));
}
add_action( 'customize_register', 'ecommerce_trendy_outfits_customize_register' );

if ( class_exists( 'WP_Customize_Section' ) ) {
	class Ecommerce_Trendy_Outfits_Upsell_Section extends WP_Customize_Section {
		public $type = 'ecommerce-trendy-outfits-upsell';
		public $button_text = '';
		public $url = '';

		protected function render() {
			?>
			<li id="accordion-section-<?php echo esc_attr( $this->id ); ?>" class="ecommerce_trendy_outfits_upsell_section accordion-section control-section control-section-<?php echo esc_attr( $this->id ); ?> cannot-expand">
				<h3 class="accordion-section-title premium-details">
					<?php echo esc_html( $this->title ); ?>
					<a href="<?php echo esc_url( $this->url ); ?>" class="button button-secondary alignright" target="_blank" style="margin-top: -4px;"><?php echo esc_html( $this->button_text ); ?></a>
				</h3>
			</li>
			<?php
		}
	}
}

/**
 * Enqueue script for custom customize control.
 */
function ecommerce_trendy_outfits_custom_control_scripts() {
	wp_enqueue_script( 'ecommerce-trendy-outfits-custom-controls-js', get_template_directory_uri() . '/assets/js/custom-controls.js', array( 'jquery', 'jquery-ui-core', 'jquery-ui-sortable' ), '1.0', true );

    wp_enqueue_style( 'ecommerce-trendy-outfits-customizer-css', get_template_directory_uri() . '/assets/css/customizer.css', array(), '1.0' );
}
add_action( 'customize_controls_enqueue_scripts', 'ecommerce_trendy_outfits_custom_control_scripts' );
