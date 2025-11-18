<?php

add_action( 'tgmpa_register', 'telnet_register_required_plugins' );

function telnet_register_required_plugins() {

    $plugins = [
        [
            'name'               => esc_html__( 'Telnet Core', 'telnet' ),
            'slug'               => 'telnet-core',
            'source'             => esc_url( 'https://themexriver.com/wp/telnet-wp/telnet-plug/telnet-core.zip' ),
            'external_url'       => esc_url( 'https://themexriver.com/wp/telnet-wp/telnet-plug/telnet-core.zip' ),
            'required'           => true,
            'force_activation'   => false,
            'force_deactivation' => false,
        ],
        [
            'name'     => esc_html__( 'Elementor Page Builder', 'telnet' ),
            'slug'     => 'elementor',
            'required' => true,
        ],
        [
            'name'         => esc_html__( 'Envato Market', 'telnet' ),
            'slug'         => 'envato-market',
            'source'       => esc_url( 'https://goo.gl/pkJS33' ),
            'external_url' => esc_url( 'https://goo.gl/pkJS33' ),
            'required'     => true,
        ],
        [
            'name'     => esc_html__( 'WP Classic Editor', 'telnet' ),
            'slug'     => 'classic-editor',
            'required' => false,
        ],
        [
            'name'     => esc_html__( 'Contact Form 7', 'telnet' ),
            'slug'     => 'contact-form-7',
            'required' => true,
        ],
        [
            'name'     => esc_html__( 'WooCommerce', 'telnet' ),
            'slug'     => 'woocommerce',
            'required' => true,
        ],
        [
            'name'               => esc_html__( 'SVG Support', 'gilroy' ),
            'slug'               => 'svg-support',
            'required'           => true,
        ],
        [
            'name'     => esc_html__( 'WPC Smart Wishlist for WooCommerce', 'telnet' ),
            'slug'     => 'woo-smart-wishlist',
            'required' => true,
        ],
        [
            'name'     => esc_html__( 'Additional Variation Images Gallery for WooCommerce', 'telnet' ),
            'slug'     => 'woo-variation-gallery',
            'required' => true,
        ],
        [
            'name'     => esc_html__( 'One Click Demo Import', 'telnet' ),
            'slug'     => 'one-click-demo-import',
            'required' => false,
        ],

    ];

    $config = [
        'id'           => 'telnet',
        'parent_slug'  => 'telnet',
        'menu'         => 'tgmpa-install-plugins',
        'dismissable'  => true,
        'dismiss_msg'  => '',
        'is_automatic' => false,
        'message'      => '',
        'default_path' => '',
    ];

    tgmpa( $plugins, $config );
}
