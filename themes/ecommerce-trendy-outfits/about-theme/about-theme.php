<?php
/**
 * Titan Notice Handler
 */

defined( 'ABSPATH' ) || exit;

define('ECOMMERCE_TRENDY_OUTFITS_PREMIUM_DOCUMENTATION',__('https://preview.titanthemes.net/documentation/ecommerce-trendy-outfits-pro/','ecommerce-trendy-outfits'));
define('ECOMMERCE_TRENDY_OUTFITS_SUPPORT',__('https://wordpress.org/support/theme/ecommerce-trendy-outfits/','ecommerce-trendy-outfits'));
define('ECOMMERCE_TRENDY_OUTFITS_REVIEW',__('https://wordpress.org/support/theme/ecommerce-trendy-outfits/reviews/#new-post','ecommerce-trendy-outfits'));
define('ECOMMERCE_TRENDY_OUTFITS_BUY_NOW',__('https://www.titanthemes.net/products/trendy-outfit-wordpress-theme','ecommerce-trendy-outfits'));
define('ECOMMERCE_TRENDY_OUTFITS_DOC_URL',__('https://preview.titanthemes.net/documentation/ecommerce-trendy-outfits-lite/','ecommerce-trendy-outfits'));
define('ECOMMERCE_TRENDY_OUTFITS_LIVE_DEMO',__('https://preview.titanthemes.net/ecommerce-trendy-outfits/','ecommerce-trendy-outfits'));
define('ECOMMERCE_TRENDY_OUTFITS_BUNDLE',__('https://www.titanthemes.net/products/wordpress-theme-bundle','ecommerce-trendy-outfits'));
/**
 * Admin Hook
 */
function ecommerce_trendy_outfits_admin_menu_page() {
    $ecommerce_trendy_outfits_theme = wp_get_theme( get_template() );

    add_theme_page(
        $ecommerce_trendy_outfits_theme->display( 'Name' ),
        $ecommerce_trendy_outfits_theme->display( 'Name' ),
        'manage_options',
        'ecommerce-trendy-outfits',
        'ecommerce_trendy_outfits_do_admin_page'
    );
}
add_action( 'admin_menu', 'ecommerce_trendy_outfits_admin_menu_page' );

/**
 * Enqueue getting started styles and scripts
 */
function titan_widgets_backend_enqueue() {
    wp_enqueue_style( 'titan-getting-started', get_template_directory_uri() . '/about-theme/about-theme.css' );
}
add_action( 'admin_enqueue_scripts', 'titan_widgets_backend_enqueue' );

/**
 * Class Titan_Notice_Handler
 */
class Titan_Notice_Handler {

    public static $nonce;

    /**
     * Empty Constructor
     */
    public function __construct() {
        // Activation notice
        add_action( 'switch_theme', array( $this, 'flush_dismiss_status' ) );
        add_action( 'admin_init', array( $this, 'getting_started_notice_dismissed' ) );
        add_action( 'admin_notices', array( $this, 'titan_theme_info_welcome_admin_notice' ), 3 );
        add_action( 'wp_ajax_titan_getting_started', array( $this, 'titan_getting_started' ) );
    }

    /**
     * Display an admin notice linking to the about page
     */
    public function titan_theme_info_welcome_admin_notice() {

    $current_screen = get_current_screen();

    $ecommerce_trendy_outfits_theme = wp_get_theme();
    if ( is_admin() && ! get_user_meta( get_current_user_id(), 'gs_notice_dismissed' ) && $current_screen->base != 'appearance_page_ecommerce-trendy-outfits' ) {
        echo '<div class="updated notice notice-success is-dismissible getting-started">';
        echo '<p><strong>' . sprintf( esc_html__( 'Welcome! Thank you for choosing %1$s.', 'ecommerce-trendy-outfits' ), esc_html( $ecommerce_trendy_outfits_theme->get( 'Name' ) ) ) . '</strong></p>';
        echo '<p class="plugin-notice">' . esc_html__( 'By clicking "Get Started," you can access our theme features.', 'ecommerce-trendy-outfits' ) . '</p>';
        echo '<div class="titan-buttons">';
        echo '<p><a href="' . esc_url(admin_url('themes.php?page=ecommerce-trendy-outfits')) . '" class="titan-install-plugins button button-primary">' . sprintf( esc_html__( 'Get started with %s', 'ecommerce-trendy-outfits' ), esc_html( $ecommerce_trendy_outfits_theme->get( 'Name' ) ) ) . '</a></p>';
        echo '<p><a href="' . esc_url( ECOMMERCE_TRENDY_OUTFITS_BUY_NOW ) . '" class="button button-secondary" target="_blank">' . esc_html__( 'GO FOR PREMIUM', 'ecommerce-trendy-outfits' ) . '</a></p>';
        echo '</div>';
        echo '<a href="' . esc_url( wp_nonce_url( add_query_arg( 'gs-notice-dismissed', 'dismiss_admin_notices' ) ) ) . '" class="getting-started-notice-dismiss">Dismiss</a>';
        echo '</div>';
    }
}

    /**
     * Register dismissal of the getting started notification.
     * Acts on the dismiss link.
     * If clicked, the admin notice disappears and will no longer be visible to this user.
     */
    public function getting_started_notice_dismissed() {
        if ( isset( $_GET['gs-notice-dismissed'] ) ) {
            add_user_meta( get_current_user_id(), 'gs_notice_dismissed', 'true' );
        }
    }

    /**
     * Deletes the getting started notice's dismiss status upon theme switch.
     */
    public function flush_dismiss_status() {
        delete_user_meta( get_current_user_id(), 'gs_notice_dismissed' );
    }
}
new Titan_Notice_Handler();

/**
 * Render admin page.
 *
 * @since 1.0.0
 */
function ecommerce_trendy_outfits_do_admin_page() { 
    $ecommerce_trendy_outfits_theme = wp_get_theme(); ?>
    <div class="ecommerce-trendy-outfits-themeinfo-page--wrapper">
        <div class="free&pro">
            <div id="ecommerce-trendy-outfits-admin-about-page-1">
                <div class="theme-detail">
                   <div class="ecommerce-trendy-outfits-admin-card-header-1">
                    <div class="ecommerce-trendy-outfits-header-left">
                        <h2>
                            <?php echo esc_html( $ecommerce_trendy_outfits_theme->Name ); ?> <span><?php echo esc_html($ecommerce_trendy_outfits_theme['Version']);?></span>
                        </h2>
                        <p>
                            <?php
                            echo wp_kses_post( apply_filters( 'titan_theme_description', esc_html( $ecommerce_trendy_outfits_theme->get( 'Description' ) ) ) );
                        ?>
                        </p>
                    </div>
                    <div class="ecommerce-trendy-outfits-header-right">
                        <div class="ecommerce-trendy-outfits-pro-button">
                            <a href="<?php echo esc_url( ECOMMERCE_TRENDY_OUTFITS_BUY_NOW ); ?>" class="ecommerce-trendy-outfits-button button-primary" target="_blank" rel="noreferrer">
                                <?php esc_html_e( 'UPGRADE TO PREMIUM', 'ecommerce-trendy-outfits' ); ?>
                            </a>
                        </div>
                    </div>
                </div>   
                </div>   
                <div class="ecommerce-trendy-outfits-features">
                    <div class="ecommerce-trendy-outfits-features-box">
                        <h3><?php esc_html_e( 'PREMIUM DEMONSTRATION', 'ecommerce-trendy-outfits' ); ?></h3>
                        <p><?php esc_html_e( 'Effortlessly create and customize your website by arranging text, images, and other elements using the Gutenberg editor, making web design easy and accessible for all skill levels.', 'ecommerce-trendy-outfits' ); ?></p>
                        <a href="<?php echo esc_url( ECOMMERCE_TRENDY_OUTFITS_LIVE_DEMO ); ?>" class="ecommerce-trendy-outfits-button button-secondary-1" target="_blank" rel="noreferrer">
                                <?php esc_html_e( 'DEMONSTRATION', 'ecommerce-trendy-outfits' ); ?>
                            </a>
                    </div>
                    <div class="ecommerce-trendy-outfits-features-box">
                        <h3><?php esc_html_e( 'REVIEWS', 'ecommerce-trendy-outfits' ); ?></h3>
                        <p><?php esc_html_e( 'We would be happy to hear your thoughts and value your evaluation.', 'ecommerce-trendy-outfits' ); ?></p>
                        <a href="<?php echo esc_url( ECOMMERCE_TRENDY_OUTFITS_REVIEW ); ?>" class="ecommerce-trendy-outfits-button button-secondary-1" target="_blank" rel="noreferrer">
                                <?php esc_html_e( 'REVIEWS', 'ecommerce-trendy-outfits' ); ?>
                            </a>
                    </div>
                    <div class="ecommerce-trendy-outfits-features-box">
                        <h3><?php esc_html_e( '24/7 SUPPORT', 'ecommerce-trendy-outfits' ); ?></h3>
                        <p><?php esc_html_e( 'Please do not hesitate to contact us at support if you need help installing our lite theme. We are prepared to assist you!', 'ecommerce-trendy-outfits' ); ?></p>
                        <a href="<?php echo esc_url( ECOMMERCE_TRENDY_OUTFITS_SUPPORT ); ?>" class="ecommerce-trendy-outfits-button button-secondary-1" target="_blank" rel="noreferrer">
                            <?php esc_html_e( 'SUPPORT', 'ecommerce-trendy-outfits' ); ?>
                        </a>
                    </div>
                    <div class="ecommerce-trendy-outfits-features-box">
                        <h3><?php esc_html_e( 'THEME INSTRUCTION', 'ecommerce-trendy-outfits' ); ?></h3>
                        <p><?php esc_html_e( 'If you need assistance configuring and setting up the theme, our tutorial is available. A fast and simple method for setting up the theme.', 'ecommerce-trendy-outfits' ); ?></p>
                        <a href="<?php echo esc_url( ECOMMERCE_TRENDY_OUTFITS_DOC_URL ); ?>" class="ecommerce-trendy-outfits-button button-secondary-1" target="_blank" rel="noreferrer">
                                <?php esc_html_e( 'DOCUMENTATION', 'ecommerce-trendy-outfits' ); ?>
                            </a>
                    </div>
                </div>   
            </div>
            <div id="ecommerce-trendy-outfits-admin-about-page-2">
                <div class="theme-detail">
                   <div class="ecommerce-trendy-outfits-admin-card-header-1">
                        <div class="ecommerce-trendy-outfits-header-left-pro"> 
                            <h2><?php esc_html_e( 'The premium version of this theme will be available for you to enhance or unlock our premium features.', 'ecommerce-trendy-outfits' ); ?></h2>
                        </div>
                        <div class="ecommerce-trendy-outfits-header-right-2">
                            <div class="ecommerce-trendy-outfits-pro-button">
                                <a href="<?php echo esc_url( ECOMMERCE_TRENDY_OUTFITS_BUY_NOW ); ?>" class="ecommerce-trendy-outfits-button button-primary-1 buy-now" target="_blank" rel="noreferrer">
                                    <?php esc_html_e( 'GO TO PREMIUM', 'ecommerce-trendy-outfits' ); ?>
                                </a>
                            </div>
                            <div class="ecommerce-trendy-outfits-pro-button">
                                <a href="<?php echo esc_url( ECOMMERCE_TRENDY_OUTFITS_LIVE_DEMO ); ?>" class="ecommerce-trendy-outfits-button button-primary-1 pro-demo" target="_blank" rel="noreferrer">
                                    <?php esc_html_e( 'PREMIUM DEMO', 'ecommerce-trendy-outfits' ); ?>
                                </a>
                            </div>
                            <div class="ecommerce-trendy-outfits-pro-button">
                                <a href="<?php echo esc_url( ECOMMERCE_TRENDY_OUTFITS_PREMIUM_DOCUMENTATION ); ?>" class="ecommerce-trendy-outfits-button button-primary-1 buy-now" target="_blank" rel="noreferrer">
                                    <?php esc_html_e( 'PRO DOCUMENTATION', 'ecommerce-trendy-outfits' ); ?>
                                </a>
                            </div>  
                        </div>
                    </div>
                    <div class="ecommerce-trendy-outfits-admin-card-header-2">
                        <img class="img_responsive" style="width: 100%;" src="<?php echo esc_url( $ecommerce_trendy_outfits_theme->get_screenshot() ); ?>" />
                    </div> 
                </div>    
            </div>
        </div>
    </div>
<?php } ?>