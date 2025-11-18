<?php

/**
 *
 * telnet header
 */
function telnet_check_header() {
    $id = get_the_ID();

    if ( get_option( 'page_for_posts' ) ) {
        $id = get_the_ID();
    }

    if ( is_shop() ) {
        $id = get_option( 'woocommerce_shop_page_id' );
    }

    $header_meta = get_post_meta( $id, 'telnet_page_meta', true ) ? get_post_meta( $id, 'telnet_page_meta', true ) : [];

    $page_header_disable = array_key_exists( 'page_header_disable', $header_meta ) ? $header_meta['page_header_disable'] : false;

    if ( $page_header_disable != true ) {
        Telnet_Helper::telnet_header_template();
    }

}
add_action( 'telnet_header_style', 'telnet_check_header', 10 );

/**
 *
 * telnet footer
 */
function telnet_check_footer() {
    $id = get_the_ID();

    if ( get_option( 'page_for_posts' ) ) {
        $id = get_the_ID();
    }
    if ( is_shop() ) {
        $id = get_option( 'woocommerce_shop_page_id' );
    }

    $footer_meta = get_post_meta( $id, 'telnet_page_meta', true ) ? get_post_meta( $id, 'telnet_page_meta', true ) : [];

    if ( array_key_exists( 'page_footer_disable', $footer_meta ) ) {
        $page_footer_disable = $footer_meta['page_footer_disable'];
    } else {
        $page_footer_disable = false;
    }
    if ( $page_footer_disable != true ) {
        Telnet_Helper::telnet_footer_template();
    }
}
add_action( 'telnet_footer_style', 'telnet_check_footer', 10 );

// favicon logo
function telnet_favicon_logo_func() {
    $telnet_favicon = cs_get_option( 'telnet_favicon', get_template_directory_uri() . '/assets/img/favicon.png' );
    if ( isset( $telnet_favicon['url'] ) ) {
        $telnet_favicon_url = $telnet_favicon['url'];
    } else {
        $telnet_favicon_url = get_template_directory_uri() . '/assets/img/favicon.png';
    }
    ?>
    <link rel="shortcut icon" type="image/x-icon" href="<?php print esc_url( $telnet_favicon_url );?>">
    <?php
}
add_action( 'wp_head', 'telnet_favicon_logo_func' );

function telnet_custom_class( $classes ) {
    $page_meta = get_post_meta( get_the_ID(), 'telnet_page_meta', true ) ? get_post_meta( get_the_ID(), 'telnet_page_meta', true ) : [];
    $enable_boxed_layout = array_key_exists( 'enable_boxed_layout', $page_meta ) ? $page_meta['enable_boxed_layout'] : false;
    $box_layout_class = $enable_boxed_layout == true ? 'tx-boxed-layout' : '';
    $classes[] = '' . esc_attr( $box_layout_class ) . '';
    return $classes;
}
add_filter( 'body_class', 'telnet_custom_class' );