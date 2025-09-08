<?php
/**
 * Title: Products
 * Slug: ecommerce-trendy-outfits/products
 * Categories: products
 * Block Types: core/template-part/products
 */
?>

<?php if ( class_exists( 'WooCommerce' ) && wc_get_products( array( 'status' => 'publish', 'limit' => 1 ) ) ) : ?>

<!-- wp:group {"tagName":"main","style":{"spacing":{"margin":{"top":"0","bottom":"0"},"padding":{"right":"0","left":"0","top":"0","bottom":"0"}}},"backgroundColor":"contrast"} -->
<main class="wp-block-group has-contrast-background-color has-background" style="margin-top:0;margin-bottom:0;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0"><!-- wp:group {"tagName":"main","className":"our-projects","style":{"spacing":{"padding":{"top":"50px","bottom":"50px","left":"0px","right":"0px"},"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained","contentSize":"80%"}} -->
<main class="wp-block-group our-projects" style="margin-top:0;margin-bottom:0;padding-top:50px;padding-right:0px;padding-bottom:50px;padding-left:0px"><!-- wp:group {"layout":{"type":"constrained","contentSize":"100%"}} -->
<div class="wp-block-group"><!-- wp:heading {"textAlign":"center","level":3,"style":{"elements":{"link":{"color":{"text":"var:preset|color|base"}}},"typography":{"fontSize":"25px","fontStyle":"normal","fontWeight":"700"}},"textColor":"base","fontFamily":"syne"} -->
<h3 class="wp-block-heading has-text-align-center has-base-color has-text-color has-link-color has-syne-font-family" style="font-size:25px;font-style:normal;font-weight:700"><?php esc_html_e('Trending Products','ecommerce-trendy-outfits'); ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","style":{"elements":{"link":{"color":{"text":"var:preset|color|base"}}},"typography":{"fontSize":"14px","fontStyle":"normal","fontWeight":"400"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"base","fontFamily":"poppins"} -->
<p class="has-text-align-center has-base-color has-text-color has-link-color has-poppins-font-family" style="margin-top:0;margin-bottom:0;font-size:14px;font-style:normal;font-weight:400"><?php esc_html_e('Lorem Ipsum is simply dummy text of the printing and typesetting industry.','ecommerce-trendy-outfits'); ?></p>
<!-- /wp:paragraph -->

<!-- wp:group {"layout":{"type":"constrained","contentSize":"100%"}} -->
<div class="wp-block-group"><!-- wp:woocommerce/product-collection {"queryId":0,"query":{"perPage":8,"pages":1,"offset":0,"postType":"product","order":"desc","orderBy":"date","search":"","exclude":[],"inherit":false,"taxQuery":[],"isProductCollectionBlock":true,"featured":false,"woocommerceOnSale":false,"woocommerceStockStatus":["instock","outofstock","onbackorder"],"woocommerceAttributes":[],"woocommerceHandPickedProducts":[],"timeFrame":{"operator":"in","value":"-3 months"},"filterable":false,"relatedBy":{"categories":true,"tags":true}},"tagName":"div","displayLayout":{"type":"flex","columns":4,"shrinkColumns":true},"dimensions":{"widthType":"fill"},"collection":"woocommerce/product-collection/new-arrivals","hideControls":["inherit","order","filterable"],"queryContextIncludes":["collection"],"__privatePreviewState":{"isPreview":false,"previewMessage":"Actual products will vary depending on the page being viewed."}} -->
<div class="wp-block-woocommerce-product-collection"><!-- wp:woocommerce/product-template -->
<!-- wp:group {"className":"product-main","layout":{"type":"constrained","contentSize":"100%"}} -->
<div class="wp-block-group product-main"><!-- wp:group {"className":"image-box","layout":{"type":"constrained","contentSize":"100%"}} -->
<div class="wp-block-group image-box"><!-- wp:woocommerce/product-image {"showSaleBadge":false,"imageSizing":"thumbnail","isDescendentOfQueryLoop":true,"width":"100%","height":"300px","style":{"border":{"radius":"12px"}}} -->
<!-- wp:group {"layout":{"type":"constrained","contentSize":"100%"}} -->
<div class="wp-block-group"><!-- wp:group {"className":"product-meta","style":{"spacing":{"blockGap":"10px"}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
<div class="wp-block-group product-meta"><!-- wp:group {"className":"wishlist-box","layout":{"type":"constrained"}} -->
<div class="wp-block-group wishlist-box"><!-- wp:yith/yith-wcwl-add-to-wishlist {"product_id":"14"} -->
[yith_wcwl_add_to_wishlist product_id="14" wishlist_url="" label="" browse_wishlist_text="" already_in_wishslist_text="" product_added_text="" icon="" link_classes=""]
<!-- /wp:yith/yith-wcwl-add-to-wishlist --></div>
<!-- /wp:group -->

<!-- wp:shortcode -->
<!-- /wp:shortcode --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:woocommerce/product-button {"textAlign":"center","isDescendentOfQueryLoop":true,"className":"carrt-btn","backgroundColor":"base","textColor":"contrast","fontFamily":"mulish","style":{"elements":{"link":{"color":{"text":"var:preset|color|contrast"}}},"border":{"radius":"8px"},"typography":{"fontSize":"16px","fontStyle":"normal","fontWeight":"700","textTransform":"capitalize"},"spacing":{"padding":{"top":"10px","bottom":"10px","left":"25px","right":"25px"}}}} /-->
<!-- /wp:woocommerce/product-image -->

<!-- wp:post-title {"textAlign":"left","isLink":true,"style":{"spacing":{"margin":{"bottom":"10px","top":"var:preset|spacing|30"}},"elements":{"link":{"color":{"text":"var:preset|color|base"}}},"typography":{"fontSize":"18px","fontStyle":"normal","fontWeight":"600"}},"textColor":"base","fontFamily":"syne","__woocommerceNamespace":"woocommerce/product-collection/product-title"} /-->

<!-- wp:woocommerce/product-price {"isDescendentOfQueryLoop":true,"textAlign":"left","textColor":"base","fontFamily":"poppins","style":{"elements":{"link":{"color":{"text":"var:preset|color|base"}}},"typography":{"fontSize":"14px","fontStyle":"normal","fontWeight":"300"},"spacing":{"padding":{"top":"0","bottom":"0"},"margin":{"top":"0","bottom":"0"}}}} /--></div>
<!-- /wp:group --></div>
<!-- /wp:group -->
<!-- /wp:woocommerce/product-template --></div>
<!-- /wp:woocommerce/product-collection --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></main>
<!-- /wp:group --></main>
<!-- /wp:group -->

<?php else : ?>

<!-- wp:group {"tagName":"main","className":"wp-block-group","style":{"spacing":{"margin":{"top":"0","bottom":"0"},"padding":{"right":"0","left":"0","top":"0","bottom":"0"}}},"backgroundColor":"contrast"} -->
<main class="wp-block-group has-contrast-background-color has-background" style="margin-top:0;margin-bottom:0;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0"><!-- wp:group {"tagName":"main","className":"our-projects","style":{"spacing":{"padding":{"top":"50px","bottom":"50px","left":"0px","right":"0px"},"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained","contentSize":"80%"}} -->
<main class="wp-block-group our-projects" style="margin-top:0;margin-bottom:0;padding-top:50px;padding-right:0px;padding-bottom:50px;padding-left:0px"><!-- wp:group {"layout":{"type":"constrained","contentSize":"100%"}} -->
<div class="wp-block-group"><!-- wp:heading {"textAlign":"center","level":3,"style":{"elements":{"link":{"color":{"text":"var:preset|color|base"}}},"typography":{"fontSize":"25px","fontStyle":"normal","fontWeight":"700"}},"textColor":"base","fontFamily":"syne"} -->
<h3 class="wp-block-heading has-text-align-center has-base-color has-text-color has-link-color has-syne-font-family" style="font-size:25px;font-style:normal;font-weight:700"><?php esc_html_e('Trending Products','ecommerce-trendy-outfits'); ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","style":{"elements":{"link":{"color":{"text":"var:preset|color|base"}}},"typography":{"fontSize":"14px","fontStyle":"normal","fontWeight":"400"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"base","fontFamily":"poppins"} -->
<p class="has-text-align-center has-base-color has-text-color has-link-color has-poppins-font-family" style="margin-top:0;margin-bottom:0;font-size:14px;font-style:normal;font-weight:400"><?php esc_html_e('Lorem Ipsum is simply dummy text of the printing and typesetting industry.','ecommerce-trendy-outfits'); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:columns {"align":"wide","className":" owl-carousel tour-box animations-hidden-item"} -->
<div class="wp-block-columns alignwide  owl-carousel tour-box animations-hidden-item"><!-- wp:column {"verticalAlignment":"center","className":"product-main","style":{"border":{"radius":"10px"},"spacing":{"padding":{"top":"0","bottom":"0"}}}} -->
<div class="wp-block-column is-vertically-aligned-center product-main" style="border-radius:10px;padding-top:0;padding-bottom:0"><!-- wp:group {"className":"image-box","style":{"dimensions":{"minHeight":"150px"},"spacing":{"padding":{"top":"0px"}}},"layout":{"type":"constrained","contentSize":"100%","justifyContent":"center"}} -->
<div class="wp-block-group image-box" style="min-height:150px;padding-top:0px"><!-- wp:image {"id":219,"scale":"cover","sizeSlug":"full","linkDestination":"none","align":"center","className":"product-image","style":{"spacing":{"margin":{"bottom":"10px"}},"border":{"radius":"12px"}}} -->
<figure class="wp-block-image aligncenter size-full has-custom-border product-image" style="margin-bottom:10px"><img src="<?php echo esc_url(get_template_directory_uri()) ?>/assets/images/product1.png" alt="" class="wp-image-219" style="border-radius:12px;object-fit:cover"/></figure>
<!-- /wp:image -->

<!-- wp:group {"className":"carrt-btn","layout":{"type":"constrained"}} -->
<div class="wp-block-group carrt-btn"><!-- wp:buttons {"className":"product-btn","layout":{"type":"flex","justifyContent":"center"}} -->
<div class="wp-block-buttons product-btn"><!-- wp:button {"backgroundColor":"base","textColor":"contrast","style":{"spacing":{"padding":{"left":"15px","right":"15px","top":"8px","bottom":"8px"}},"elements":{"link":{"color":{"text":"var:preset|color|contrast"}}},"border":{"radius":"4px"},"typography":{"fontSize":"15px","fontStyle":"normal","fontWeight":"700"}},"fontFamily":"mulish"} -->
<div class="wp-block-button"><a class="wp-block-button__link has-contrast-color has-base-background-color has-text-color has-background has-link-color has-mulish-font-family has-custom-font-size wp-element-button" style="border-radius:4px;padding-top:8px;padding-right:15px;padding-bottom:8px;padding-left:15px;font-size:15px;font-style:normal;font-weight:700"><?php esc_html_e('Add To Cart','ecommerce-trendy-outfits'); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"padding":{"right":"20px","left":"0px","bottom":"15px"}}},"layout":{"type":"constrained","contentSize":"100%"}} -->
<div class="wp-block-group" style="padding-right:20px;padding-bottom:15px;padding-left:0px"><!-- wp:heading {"level":5,"style":{"typography":{"fontSize":"18px","fontStyle":"normal","fontWeight":"600","textTransform":"capitalize"},"spacing":{"margin":{"top":"0","bottom":"0"}},"elements":{"link":{"color":{"text":"var:preset|color|base"}}}},"textColor":"base","fontFamily":"syne"} -->
<h5 class="wp-block-heading has-base-color has-text-color has-link-color has-syne-font-family" style="margin-top:0;margin-bottom:0;font-size:18px;font-style:normal;font-weight:600;text-transform:capitalize"><?php esc_html_e('Product Name Here','ecommerce-trendy-outfits'); ?></h5>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"elements":{"link":{"color":{"text":"var:preset|color|base"}}},"typography":{"fontSize":"13px","fontStyle":"normal","fontWeight":"400"},"spacing":{"margin":{"top":"0","bottom":"0"},"padding":{"top":"0","bottom":"0"}}},"textColor":"base","fontFamily":"poppins"} -->
<p class="has-base-color has-text-color has-link-color has-poppins-font-family" style="margin-top:0;margin-bottom:0;padding-top:0;padding-bottom:0;font-size:13px;font-style:normal;font-weight:400"><?php esc_html_e('$120.00','ecommerce-trendy-outfits'); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center","className":"product-main","style":{"border":{"radius":"10px"},"spacing":{"padding":{"top":"0","bottom":"0"}}}} -->
<div class="wp-block-column is-vertically-aligned-center product-main" style="border-radius:10px;padding-top:0;padding-bottom:0"><!-- wp:group {"className":"image-box","style":{"dimensions":{"minHeight":"150px"},"spacing":{"padding":{"top":"0px"}}},"layout":{"type":"constrained","contentSize":"100%","justifyContent":"center"}} -->
<div class="wp-block-group image-box" style="min-height:150px;padding-top:0px"><!-- wp:image {"id":220,"scale":"cover","sizeSlug":"full","linkDestination":"none","align":"center","className":"product-image","style":{"spacing":{"margin":{"bottom":"10px"}},"border":{"radius":"12px"}}} -->
<figure class="wp-block-image aligncenter size-full has-custom-border product-image" style="margin-bottom:10px"><img src="<?php echo esc_url(get_template_directory_uri()) ?>/assets/images/product2.png" alt="" class="wp-image-220" style="border-radius:12px;object-fit:cover"/></figure>
<!-- /wp:image -->

<!-- wp:group {"className":"carrt-btn","layout":{"type":"constrained"}} -->
<div class="wp-block-group carrt-btn"><!-- wp:buttons {"className":"product-btn","layout":{"type":"flex","justifyContent":"center"}} -->
<div class="wp-block-buttons product-btn"><!-- wp:button {"backgroundColor":"base","textColor":"contrast","style":{"spacing":{"padding":{"left":"15px","right":"15px","top":"8px","bottom":"8px"}},"elements":{"link":{"color":{"text":"var:preset|color|contrast"}}},"border":{"radius":"4px"},"typography":{"fontSize":"15px","fontStyle":"normal","fontWeight":"700"}},"fontFamily":"mulish"} -->
<div class="wp-block-button"><a class="wp-block-button__link has-contrast-color has-base-background-color has-text-color has-background has-link-color has-mulish-font-family has-custom-font-size wp-element-button" style="border-radius:4px;padding-top:8px;padding-right:15px;padding-bottom:8px;padding-left:15px;font-size:15px;font-style:normal;font-weight:700"><?php esc_html_e('Add To Cart','ecommerce-trendy-outfits'); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"padding":{"right":"20px","left":"0px","bottom":"15px"}}},"layout":{"type":"constrained","contentSize":"100%"}} -->
<div class="wp-block-group" style="padding-right:20px;padding-bottom:15px;padding-left:0px"><!-- wp:heading {"level":5,"style":{"typography":{"fontSize":"18px","fontStyle":"normal","fontWeight":"600","textTransform":"capitalize"},"spacing":{"margin":{"top":"0","bottom":"0"}},"elements":{"link":{"color":{"text":"var:preset|color|base"}}}},"textColor":"base","fontFamily":"syne"} -->
<h5 class="wp-block-heading has-base-color has-text-color has-link-color has-syne-font-family" style="margin-top:0;margin-bottom:0;font-size:18px;font-style:normal;font-weight:600;text-transform:capitalize"><?php esc_html_e('Product Name Here','ecommerce-trendy-outfits'); ?></h5>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"elements":{"link":{"color":{"text":"var:preset|color|base"}}},"typography":{"fontSize":"13px","fontStyle":"normal","fontWeight":"400"},"spacing":{"margin":{"top":"0","bottom":"0"},"padding":{"top":"0","bottom":"0"}}},"textColor":"base","fontFamily":"poppins"} -->
<p class="has-base-color has-text-color has-link-color has-poppins-font-family" style="margin-top:0;margin-bottom:0;padding-top:0;padding-bottom:0;font-size:13px;font-style:normal;font-weight:400"><?php esc_html_e('$120.00','ecommerce-trendy-outfits'); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center","className":"product-main","style":{"border":{"radius":"10px"},"spacing":{"padding":{"top":"0","bottom":"0"}}}} -->
<div class="wp-block-column is-vertically-aligned-center product-main" style="border-radius:10px;padding-top:0;padding-bottom:0"><!-- wp:group {"className":"image-box","style":{"dimensions":{"minHeight":"150px"},"spacing":{"padding":{"top":"0px"}}},"layout":{"type":"constrained","contentSize":"100%","justifyContent":"center"}} -->
<div class="wp-block-group image-box" style="min-height:150px;padding-top:0px"><!-- wp:image {"id":221,"scale":"cover","sizeSlug":"full","linkDestination":"none","align":"center","className":"product-image","style":{"spacing":{"margin":{"bottom":"10px"}},"border":{"radius":"12px"}}} -->
<figure class="wp-block-image aligncenter size-full has-custom-border product-image" style="margin-bottom:10px"><img src="<?php echo esc_url(get_template_directory_uri()) ?>/assets/images/product3.png" alt="" class="wp-image-221" style="border-radius:12px;object-fit:cover"/></figure>
<!-- /wp:image -->

<!-- wp:group {"className":"carrt-btn","layout":{"type":"constrained"}} -->
<div class="wp-block-group carrt-btn"><!-- wp:buttons {"className":"product-btn","layout":{"type":"flex","justifyContent":"center"}} -->
<div class="wp-block-buttons product-btn"><!-- wp:button {"backgroundColor":"base","textColor":"contrast","style":{"spacing":{"padding":{"left":"15px","right":"15px","top":"8px","bottom":"8px"}},"elements":{"link":{"color":{"text":"var:preset|color|contrast"}}},"border":{"radius":"4px"},"typography":{"fontSize":"15px","fontStyle":"normal","fontWeight":"700"}},"fontFamily":"mulish"} -->
<div class="wp-block-button"><a class="wp-block-button__link has-contrast-color has-base-background-color has-text-color has-background has-link-color has-mulish-font-family has-custom-font-size wp-element-button" style="border-radius:4px;padding-top:8px;padding-right:15px;padding-bottom:8px;padding-left:15px;font-size:15px;font-style:normal;font-weight:700"><?php esc_html_e('Add To Cart','ecommerce-trendy-outfits'); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"padding":{"right":"20px","left":"0px","bottom":"15px"}}},"layout":{"type":"constrained","contentSize":"100%"}} -->
<div class="wp-block-group" style="padding-right:20px;padding-bottom:15px;padding-left:0px"><!-- wp:heading {"level":5,"style":{"typography":{"fontSize":"18px","fontStyle":"normal","fontWeight":"600","textTransform":"capitalize"},"spacing":{"margin":{"top":"0","bottom":"0"}},"elements":{"link":{"color":{"text":"var:preset|color|base"}}}},"textColor":"base","fontFamily":"syne"} -->
<h5 class="wp-block-heading has-base-color has-text-color has-link-color has-syne-font-family" style="margin-top:0;margin-bottom:0;font-size:18px;font-style:normal;font-weight:600;text-transform:capitalize"><?php esc_html_e('Product Name Here','ecommerce-trendy-outfits'); ?></h5>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"elements":{"link":{"color":{"text":"var:preset|color|base"}}},"typography":{"fontSize":"13px","fontStyle":"normal","fontWeight":"400"},"spacing":{"margin":{"top":"0","bottom":"0"},"padding":{"top":"0","bottom":"0"}}},"textColor":"base","fontFamily":"poppins"} -->
<p class="has-base-color has-text-color has-link-color has-poppins-font-family" style="margin-top:0;margin-bottom:0;padding-top:0;padding-bottom:0;font-size:13px;font-style:normal;font-weight:400"><?php esc_html_e('$120.00','ecommerce-trendy-outfits'); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center","className":"product-main","style":{"border":{"radius":"10px"},"spacing":{"padding":{"top":"0","bottom":"0"}}}} -->
<div class="wp-block-column is-vertically-aligned-center product-main" style="border-radius:10px;padding-top:0;padding-bottom:0"><!-- wp:group {"className":"image-box","style":{"dimensions":{"minHeight":"150px"},"spacing":{"padding":{"top":"0px"}}},"layout":{"type":"constrained","contentSize":"100%","justifyContent":"center"}} -->
<div class="wp-block-group image-box" style="min-height:150px;padding-top:0px"><!-- wp:image {"id":222,"scale":"cover","sizeSlug":"full","linkDestination":"none","align":"center","className":"product-image","style":{"spacing":{"margin":{"bottom":"10px"}},"border":{"radius":"12px"}}} -->
<figure class="wp-block-image aligncenter size-full has-custom-border product-image" style="margin-bottom:10px"><img src="<?php echo esc_url(get_template_directory_uri()) ?>/assets/images/product4.png" alt="" class="wp-image-222" style="border-radius:12px;object-fit:cover"/></figure>
<!-- /wp:image -->

<!-- wp:group {"className":"carrt-btn","layout":{"type":"constrained"}} -->
<div class="wp-block-group carrt-btn"><!-- wp:buttons {"className":"product-btn","layout":{"type":"flex","justifyContent":"center"}} -->
<div class="wp-block-buttons product-btn"><!-- wp:button {"backgroundColor":"base","textColor":"contrast","style":{"spacing":{"padding":{"left":"15px","right":"15px","top":"8px","bottom":"8px"}},"elements":{"link":{"color":{"text":"var:preset|color|contrast"}}},"border":{"radius":"4px"},"typography":{"fontSize":"15px","fontStyle":"normal","fontWeight":"700"}},"fontFamily":"mulish"} -->
<div class="wp-block-button"><a class="wp-block-button__link has-contrast-color has-base-background-color has-text-color has-background has-link-color has-mulish-font-family has-custom-font-size wp-element-button" style="border-radius:4px;padding-top:8px;padding-right:15px;padding-bottom:8px;padding-left:15px;font-size:15px;font-style:normal;font-weight:700"><?php esc_html_e('Add To Cart','ecommerce-trendy-outfits'); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"padding":{"right":"20px","left":"0px","bottom":"15px"}}},"layout":{"type":"constrained","contentSize":"100%"}} -->
<div class="wp-block-group" style="padding-right:20px;padding-bottom:15px;padding-left:0px"><!-- wp:heading {"level":5,"style":{"typography":{"fontSize":"18px","fontStyle":"normal","fontWeight":"600","textTransform":"capitalize"},"spacing":{"margin":{"top":"0","bottom":"0"}},"elements":{"link":{"color":{"text":"var:preset|color|base"}}}},"textColor":"base","fontFamily":"syne"} -->
<h5 class="wp-block-heading has-base-color has-text-color has-link-color has-syne-font-family" style="margin-top:0;margin-bottom:0;font-size:18px;font-style:normal;font-weight:600;text-transform:capitalize"><?php esc_html_e('Product Name Here','ecommerce-trendy-outfits'); ?></h5>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"elements":{"link":{"color":{"text":"var:preset|color|base"}}},"typography":{"fontSize":"13px","fontStyle":"normal","fontWeight":"400"},"spacing":{"margin":{"top":"0","bottom":"0"},"padding":{"top":"0","bottom":"0"}}},"textColor":"base","fontFamily":"poppins"} -->
<p class="has-base-color has-text-color has-link-color has-poppins-font-family" style="margin-top:0;margin-bottom:0;padding-top:0;padding-bottom:0;font-size:13px;font-style:normal;font-weight:400"><?php esc_html_e('$120.00','ecommerce-trendy-outfits'); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></main>
<!-- /wp:group --></main>
<!-- /wp:group -->

<?php endif; ?>