<?php

/**
 * [telnet_remove_hook description]
 * @return [type] [description]
 */
function telnet_remove_hook() {

    remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );
    remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );
    remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
    remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );
    remove_action( 'woocommerce_product_thumbnails', 'woocommerce_show_product_thumbnails', 20 );
    remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
    remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );

    remove_action( 'woocommerce_before_shop_loop', 'woocommerce_output_all_notices', 10 );
    remove_action( 'woocommerce_before_shop_loop', 'telnet_woo_notice', 10 );

    remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );
    add_action( 'woocommerce_sidebar', 'telnet_woocommerce_get_sidebar', 10 );

    remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
    remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
    remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
    remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );

    add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
    add_action( 'woocommerce_single_product_summary', 'telnet_product_details_rating', 10 );
    add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 15 );
    add_action( 'telnet_before_shop_loop_item_thumb', 'woocommerce_template_loop_product_link_open', 5 );
    add_action( 'telnet_before_shop_loop_item_thumb', 'woocommerce_template_loop_product_link_close', 10 );
    add_action( 'telnet_woocommerce_product_thumbnails', 'woocommerce_show_product_thumbnails', 20 );

    remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
    add_action( 'telnet_default_view_action', 'telnet_woocommerce_template_loop_content', 10 );
    add_action( 'telnet_woocommerce_after_shop_loop_item', 'telnet_list_woocommerce_template_loop_content', 20 );

    add_filter( 'woocommerce_sale_flash', 'woocommerce_custom_sale_text', 10, 3 );


}

telnet_remove_hook();

add_filter( 'woocommerce_show_page_title', function () {
    return false;
} );