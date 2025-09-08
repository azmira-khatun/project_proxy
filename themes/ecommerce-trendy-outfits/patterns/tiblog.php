<?php
/**
 * Title: Product
 * Slug: ecommerce-trendy-outfits/tiblog
 * Categories: tiblog
 * Block Types: core/template-part/tiblog
 */
?>

<!-- wp:group {"className":"news-section","style":{"spacing":{"margin":{"top":"0px","bottom":"0px"},"padding":{"bottom":"var:preset|spacing|50","top":"var:preset|spacing|50","left":"0","right":"0"}}},"backgroundColor":"contrast","layout":{"type":"constrained","contentSize":"80%"}} -->
<div class="wp-block-group news-section has-contrast-background-color has-background" style="margin-top:0px;margin-bottom:0px;padding-top:var(--wp--preset--spacing--50);padding-right:0;padding-bottom:var(--wp--preset--spacing--50);padding-left:0"><!-- wp:columns {"className":"news-heading-box"} -->
<div class="wp-block-columns news-heading-box"><!-- wp:column {"width":"100%","className":"news-heading-inner-box"} -->
<div class="wp-block-column news-heading-inner-box" style="flex-basis:100%"><!-- wp:heading {"textAlign":"center","level":4,"className":"news-sec-heading has-archivo-font-family","style":{"typography":{"fontSize":"25px","fontStyle":"normal","fontWeight":"700"},"elements":{"link":{"color":{"text":"var:preset|color|base"}}}},"textColor":"base","fontFamily":"syne"} -->
<h4 class="wp-block-heading has-text-align-center news-sec-heading has-archivo-font-family has-base-color has-text-color has-link-color has-syne-font-family" style="font-size:25px;font-style:normal;font-weight:700"><?php esc_html_e('Our Recent Blogs','ecommerce-trendy-outfits'); ?></h4>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","className":"news-sec-heading has-archivo-font-family","style":{"typography":{"fontSize":"15px","fontStyle":"normal","fontWeight":"400"},"spacing":{"margin":{"top":"0","bottom":"0"}},"elements":{"link":{"color":{"text":"var:preset|color|base"}}}},"textColor":"base","fontFamily":"poppins"} -->
<p class="has-text-align-center news-sec-heading has-archivo-font-family has-base-color has-text-color has-link-color has-poppins-font-family" style="margin-top:0;margin-bottom:0;font-size:15px;font-style:normal;font-weight:400"><?php esc_html_e('Lorem Ipsum is simply dummy text of the printing and typesetting industry.','ecommerce-trendy-outfits'); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->

<!-- wp:query {"queryId":11,"query":{"perPage":8,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false,"parents":[],"format":[]},"metadata":{"categories":["posts"],"patternName":"core/query-standard-posts","name":"Standard"}} -->
<div class="wp-block-query"><!-- wp:post-template {"className":"news-box","layout":{"type":"grid","columnCount":3}} -->
<!-- wp:group {"className":"news-img","style":{"dimensions":{"minHeight":"230px"},"border":{"radius":"10px"},"spacing":{"padding":{"top":"0px","bottom":"0px","left":"0px","right":"0px"}}},"backgroundColor":"secondary","layout":{"type":"constrained"}} -->
<div class="wp-block-group news-img has-secondary-background-color has-background" style="border-radius:10px;min-height:230px;padding-top:0px;padding-right:0px;padding-bottom:0px;padding-left:0px"><!-- wp:post-featured-image {"isLink":true,"height":"230px","align":"wide","style":{"border":{"radius":"10px"},"color":[]}} /--></div>
<!-- /wp:group -->

<!-- wp:post-title {"level":5,"isLink":true,"style":{"spacing":{"margin":{"bottom":"var:preset|spacing|20","top":"var:preset|spacing|30"}},"elements":{"link":{"color":{"text":"var:preset|color|base"}}},"typography":{"fontSize":"18px","fontStyle":"normal","fontWeight":"600"}},"textColor":"base","fontFamily":"syne"} /-->

<!-- wp:post-excerpt {"moreText":"Read More","excerptLength":10,"className":"recent-btn","style":{"typography":{"fontSize":"15px","fontStyle":"normal","fontWeight":"400"},"spacing":{"margin":{"top":"0px","bottom":"5px"}},"elements":{"link":{"color":{"text":"var:preset|color|base"}}}},"textColor":"base","fontFamily":"poppins"} /-->
<!-- /wp:post-template --></div>
<!-- /wp:query --></div>
<!-- /wp:group -->