<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 4.3.1
 */

defined( 'ABSPATH' ) || exit;

global $product;

// Ensure visibility.
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}
if( is_a($product, 'WC_Product'));
    $product = wc_get_product($post->ID);

$show_discount_percentage = cs_get_option( 'show_discount_percentage', false );

?>
<div class="tx-product-box tx-product-box__styleListView tx-pd-20 tx-radious-25 tx-border-all tx-border-op-10">

    <?php
        // discount badge functionq
        if(function_exists('telnet_discount_badge') && $show_discount_percentage == true) {
            print telnet_discount_badge();
        }

        // Hook: woocommerce_before_shop_loop_item.
        do_action( 'woocommerce_before_shop_loop_item' );
    ?>
    <div class="row">
        <div class="col-lg-4 col-md-4">
            <?php
                print '<div class="tx-thumb position-relative">';

                // wishlist button
                if(function_exists('telnet_wishlist_button') && TELNET_CORE && TELNET_WOOCOMMERCE_ACTIVED && class_exists( 'WPCleverWoosw' )) {
                    print telnet_wishlist_button();
                }

                // Hook: telnet_before_shop_loop_item_thumb.
                do_action( 'telnet_before_shop_loop_item_thumb' );

                // Hook: woocommerce_before_shop_loop_item_title.
                do_action( 'woocommerce_before_shop_loop_item_title' );
                print '</div>';

            ?>
        </div>
        <div class="col-lg-8 col-md-8">
            <?php
                /**
                 * Hook: woocommerce_shop_loop_item_title.
                 *
                 * @hooked woocommerce_template_loop_product_title - 10
                 */
                do_action( 'woocommerce_shop_loop_item_title' );

                /**
                 * Hook: woocommerce_after_shop_loop_item_title.
                 *
                 * @hooked woocommerce_template_loop_rating - 5
                 * @hooked woocommerce_template_loop_price - 10
                 */
                do_action( 'woocommerce_after_shop_loop_item_title' );

                do_action( 'telnet_woocommerce_after_shop_loop_item' );
                /**
                 * Hook: woocommerce_after_shop_loop_item.
                 *
                 * @hooked woocommerce_template_loop_product_link_close - 5
                 * @hooked woocommerce_template_loop_add_to_cart - 10
                 */
                do_action( 'woocommerce_after_shop_loop_item' );
            ?>
        </div>
    </div>
</div>
