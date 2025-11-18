<?php

/**
 * [telnet_breadcrumb description]
 * @return [type] [description]
 */
function telnet_breadcrumb() {

    $wpbreadcrumb_class = '';
    $breadcrumb_show = 1;

    $id = get_the_ID();

    if ( is_front_page() && is_home() ) {
        $title = get_the_title();
        $wpbreadcrumb_class = 'tx-front-page';
    } elseif ( is_front_page() ) {
        $title = get_the_title();
        $breadcrumb_show = 0;

    } elseif ( is_home() ) {
        if ( get_option( 'page_for_posts' ) ) {
            $id = get_option( 'page_for_posts' );
            $title = get_the_title( get_option( 'page_for_posts' ) );
        }
    } elseif ( is_single() && 'post' == get_post_type() ) {
        $title = get_the_title();
    } elseif ( is_search() ) {
        $title = esc_html__( 'Search Results for : ', 'telnet' ) . get_search_query();
    } elseif ( is_404() ) {
        $title = esc_html__( 'Page not Found', 'telnet' );
    } elseif ( function_exists( 'is_woocommerce' ) && is_shop() ) {
        $title = get_the_title( get_option( 'woocommerce_shop_page_id' ) );
    } elseif ( function_exists( 'is_woocommerce' ) && is_product() ) {
        $title = __( 'Product Details', 'telnet' );
    } elseif ( function_exists( 'is_woocommerce' ) && is_product_tag() ) {
        $title = get_the_archive_title();
    } elseif ( function_exists( 'is_woocommerce' ) && is_product_category() ) {
        $title = get_the_archive_title();
    } elseif ( is_archive() ) {
        $title = get_the_archive_title();
    } else {
        $title = get_the_title();
    }

    // from page meta
    if ( get_option( 'page_for_posts' ) ) {
        $page_for_posts = get_queried_object_id();
        $page_for_posts_meta = get_post_meta( $page_for_posts, 'telnet_page_meta', true ) ? get_post_meta( $page_for_posts, 'telnet_page_meta', true ) : [];
    } else {
        $page_meta = get_post_meta( $id, 'telnet_page_meta', true ) ? get_post_meta( $id, 'telnet_page_meta', true ) : [];
    }

    if ( get_option( 'page_for_posts' ) ) {
        $enable_page_preadcrumb = array_key_exists( 'enable_page_preadcrumb', $page_for_posts_meta ) ? $page_for_posts_meta['enable_page_preadcrumb'] : true;
    } else {
        $enable_page_preadcrumb = array_key_exists( 'enable_page_preadcrumb', $page_meta ) ? $page_meta['enable_page_preadcrumb'] : true;
    }

    if ( get_option( 'page_for_posts' ) ) {
        $enable_bg_image = array_key_exists( 'enable_bg_image', $page_for_posts_meta ) ? $page_for_posts_meta['enable_bg_image'] : true;
    } else {
        $enable_bg_image = array_key_exists( 'enable_bg_image', $page_meta ) ? $page_meta['enable_bg_image'] : true;
    }

    if ( $enable_page_preadcrumb == true && $breadcrumb_show == 1 ) {

        // from page meta
        if ( get_option( 'page_for_posts' ) ) {
            $bg_img_from_page = array_key_exists( 'bg_img_from_page', $page_for_posts_meta ) ? $page_for_posts_meta['bg_img_from_page'] : '';
            $enable_custom_title = array_key_exists( 'enable_custom_title', $page_for_posts_meta ) ? $page_for_posts_meta['enable_custom_title'] : false;
            $page_custom_title = array_key_exists( 'page_custom_title', $page_for_posts_meta ) ? $page_for_posts_meta['page_custom_title'] : '';
        } else {
            $bg_img_from_page = array_key_exists( 'bg_img_from_page', $page_meta ) ? $page_meta['bg_img_from_page'] : '';
            $enable_custom_title = array_key_exists( 'enable_custom_title', $page_meta ) ? $page_meta['enable_custom_title'] : false;
            $page_custom_title = array_key_exists( 'page_custom_title', $page_meta ) ? $page_meta['page_custom_title'] : '';
        }

        // from theme option
        $breadcrumb_bg = cs_get_option( 'breadcrumb_bg_img' );
        $bg_img = !empty( $breadcrumb_bg ) ? $breadcrumb_bg['url'] : '';

        if ( $enable_bg_image == false ) {
            $bg_img = $bg_img;
        } else {
            $bg_img = !empty( $bg_img_from_page['url'] ) ? $bg_img_from_page['url'] : $bg_img;
        }

        $shop_details_breadcrumb = is_single() && 'product' == get_post_type() ? ' no-breadcrumb-ttile' : '';
        $bg_url = !empty( $bg_img ) ? $bg_img : "";
        $title = $enable_custom_title == true ? $page_custom_title : $title;

        ?>

        <div class="tx-breadcrumb-section <?php echo esc_attr( $wpbreadcrumb_class . $shop_details_breadcrumb ); ?>">
            <div class="container-fluid tx-container-fluid">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="tx-wrapper position-relative" data-background="<?php echo esc_url( $bg_url ); ?>">
                            <div class="tx-breadcrumb text-center">
                                <h1 class="tx-breadcrumb__title"><?php echo wp_kses_post( $title ); ?></h1>
                                <?php telnet_breadcrumb_callback();?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
}
}
add_action( 'telnet_before_main_content', 'telnet_breadcrumb' );

function telnet_breadcrumb_callback() {
    $args = [
        'show_browse'   => false,
        'post_taxonomy' => ['product' => 'product_cat'],
    ];
    $breadcrumb = new TelnetBreadcrumbClass( $args );

    return $breadcrumb->trail();
}
