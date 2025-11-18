<?php

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function telnet_widgets_init() {

    /**
     * blog sidebar
     */
    register_sidebar( [
        'name'          => esc_html__( 'Blog Sidebar', 'telnet' ),
        'id'            => 'blog-sidebar',
        'before_widget' => '<div id="%1$s" class="tx-blog-widget tx-border-all tx-border-op-10 widget mt-30 %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title mb-40">',
        'after_title'   => '</h4>',
    ] );

    if ( TELNET_WOOCOMMERCE_ACTIVED ) {
        // shop sidebar
        register_sidebar( [
            'name'          => esc_html__( 'Product Sidebar', 'telnet' ),
            'id'            => 'product-sidebar',
            'before_widget' => '<div id="%1$s" class="tx-blog-widget tx-shop-widget tx-border-all tx-border-op-10 widget mt-30 %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h4 class="widget-title mb-25">',
            'after_title'   => '</h4>',
        ] );
    }

    $footer_widgets = cs_get_option( 'footer_widget_number' );

    // footer default
    for ( $num = 1; $num <= $footer_widgets; $num++ ) {
        register_sidebar( [
            'name'          => sprintf( esc_html__( 'Footer %1$s', 'telnet' ), $num ),
            'id'            => 'footer-' . $num,
            'description'   => sprintf( esc_html__( 'Footer %1$s', 'telnet' ), $num ),
            'before_widget' => '<div id="%1$s" class="footer-widget footer-widget__styleDefault widget mt-30 %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h4 class="widget-title widget-title__light mb-40">',
            'after_title'   => '</h4>',
        ] );
    }

}
add_action( 'widgets_init', 'telnet_widgets_init' );