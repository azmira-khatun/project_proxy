<?php
/**
 * Title: Header
 * Slug: ecommerce-trendy-outfits/header
 * Categories: header
 * Block Types: core/template-part/header
 */
?>

<!-- wp:group {"className":"header-box-upper","style":{"spacing":{"padding":{"top":"0","bottom":"0","left":"0","right":"0"},"margin":{"top":"0","bottom":"0"},"blockGap":"var:preset|spacing|30"},"color":{"background":"#efefef"}},"layout":{"type":"constrained","contentSize":"100%","justifyContent":"center"}} -->
<div class="wp-block-group header-box-upper has-background" style="background-color:#efefef;margin-top:0;margin-bottom:0;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0"><!-- wp:group {"className":"general-header-middle","style":{"spacing":{"margin":{"top":"0","bottom":"0"},"padding":{"top":"10px","bottom":"10px"}},"border":{"radius":"0px"}},"backgroundColor":"contrast","layout":{"type":"constrained","contentSize":"80%","justifyContent":"center"}} -->
<div class="wp-block-group general-header-middle has-contrast-background-color has-background" style="border-radius:0px;margin-top:0;margin-bottom:0;padding-top:10px;padding-bottom:10px"><!-- wp:columns {"verticalAlignment":"center","className":"header-box","style":{"border":{"bottom":{"color":"var:preset|color|base","width":"1px"}},"spacing":{"padding":{"bottom":"20px"}}}} -->
<div class="wp-block-columns are-vertically-aligned-center header-box" style="border-bottom-color:var(--wp--preset--color--base);border-bottom-width:1px;padding-bottom:20px"><!-- wp:column {"verticalAlignment":"center","width":"230px","className":"header-logo"} -->
<div class="wp-block-column is-vertically-aligned-center header-logo" style="flex-basis:230px"><!-- wp:site-title {"style":{"elements":{"link":{"color":{"text":"var:preset|color|base"}}},"typography":{"fontSize":"28px","fontStyle":"normal","fontWeight":"700"}},"textColor":"base","fontFamily":"poppins"} /--></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center","width":"70%","className":"header-inner-menu"} -->
<div class="wp-block-column is-vertically-aligned-center header-inner-menu" style="flex-basis:70%"><!-- wp:navigation {"textColor":"base","overlayTextColor":"contrast","metadata":{"ignoredHookedBlocks":["woocommerce/customer-account","woocommerce/mini-cart"]},"className":"is-head-menu","style":{"typography":{"textTransform":"capitalize","fontSize":"16px","fontStyle":"normal","fontWeight":"500"},"spacing":{"blockGap":"var:preset|spacing|40"}},"fontFamily":"syne","layout":{"type":"flex","justifyContent":"right"}} -->
<!-- wp:navigation-link {"label":"Home","type":"","url":"#","kind":"custom","isTopLevelLink":true} /-->

<!-- wp:navigation-link {"label":"About Us","type":"","url":"#","kind":"custom","isTopLevelLink":true} /-->

<!-- wp:navigation-link {"label":"Collection","type":"","url":"#","kind":"custom","isTopLevelLink":true} /-->

<!-- wp:navigation-link {"label":"Shop","type":"","url":"#","kind":"custom","isTopLevelLink":true} /-->

<!-- wp:navigation-link {"label":"Pages","type":"","url":"#","kind":"custom","isTopLevelLink":true} /-->

<!-- wp:navigation-link {"label":"Blogs","type":"","url":"#","kind":"custom","isTopLevelLink":true} /-->
<!-- /wp:navigation --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center","width":"20%","className":"header-inner-meta"} -->
<div class="wp-block-column is-vertically-aligned-center header-inner-meta" style="flex-basis:20%"><!-- wp:columns {"verticalAlignment":"center","className":"woo-icon","style":{"spacing":{"blockGap":{"left":"var:preset|spacing|30"}}}} -->
<div class="wp-block-columns are-vertically-aligned-center woo-icon"><!-- wp:column {"verticalAlignment":"center","width":"100%","className":"wishlist-column"} -->
<div class="wp-block-column is-vertically-aligned-center wishlist-column" style="flex-basis:100%"><!-- wp:columns {"verticalAlignment":"center","className":"header-meta","style":{"spacing":{"blockGap":{"left":"20px"}}}} -->
<div class="wp-block-columns are-vertically-aligned-center header-meta"><!-- wp:column {"verticalAlignment":"center","width":"33.33%","className":"search-box"} -->
<div class="wp-block-column is-vertically-aligned-center search-box" style="flex-basis:33.33%"><!-- wp:search {"label":"Search","showLabel":false,"placeholder":"Products Search...","width":100,"widthUnit":"%","buttonText":"Search Now","buttonPosition":"button-only","buttonUseIcon":true,"query":{"post_type":"product"},"isSearchFieldHidden":true,"style":{"border":{"radius":"10px"},"spacing":{"margin":{"right":"0","left":"0","top":"0","bottom":"0"}},"typography":{"fontSize":"12px","fontStyle":"normal","fontWeight":"600"},"elements":{"link":{"color":{"text":"var:preset|color|base"}}}},"backgroundColor":"contrast","textColor":"base","fontFamily":"quicksand"} /--></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center","width":"33.33%","className":"cart-box"} -->
<div class="wp-block-column is-vertically-aligned-center cart-box" style="flex-basis:33.33%"><!-- wp:woocommerce/mini-cart {"miniCartIcon":"bag-alt","priceColor":{"color":"#ffffff","name":"Base","slug":"base","class":"has-base-price-color"},"iconColor":{"color":"#ffffff","name":"Base","slug":"base","class":"has-base-icon-color"},"productCountVisibility":"never"} /--></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center","width":"66.66%","className":"phone-number"} -->
<div class="wp-block-column is-vertically-aligned-center phone-number" style="flex-basis:66.66%"><!-- wp:buttons {"layout":{"type":"flex","justifyContent":"right"}} -->
<div class="wp-block-buttons"><!-- wp:button {"textColor":"base","style":{"border":{"radius":"7px"},"spacing":{"padding":{"left":"20px","right":"20px","top":"10px","bottom":"10px"}},"elements":{"link":{"color":{"text":"var:preset|color|base"}}},"typography":{"fontSize":"14px","fontStyle":"normal","fontWeight":"400"}},"fontFamily":"mulish"} -->
<div class="wp-block-button"><a class="wp-block-button__link has-base-color has-text-color has-link-color has-mulish-font-family has-custom-font-size wp-element-button" style="border-radius:7px;padding-top:10px;padding-right:20px;padding-bottom:10px;padding-left:20px;font-size:14px;font-style:normal;font-weight:400"><?php esc_html_e('Get Quote','ecommerce-trendy-outfits'); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->