<?php
// telnet_search_filter_form
if ( !function_exists( 'telnet_search_filter_form' ) ) {
    function telnet_search_filter_form( $form ) {

        $form = sprintf(
            '<form class="tx-search-widget tx-input-field" action="%s" method="get">
                <div class="position-relative fix">
                    <input type="search" value="%s" required name="s" placeholder="%s">
                    <button class="position-absolute" type="submit"><i class="far fa-search"></i></button>
                </div>
		    </form>',
            esc_url( home_url( '/' ) ),
            esc_attr( get_search_query() ),
            esc_html__( 'Search...', 'telnet' )
        );

        return $form;
    }
    add_filter( 'get_search_form', 'telnet_search_filter_form' );
    add_filter('render_block_core/search', 'telnet_search_filter_form');
}


// woocommerce search widget form
if ( TELNET_WOOCOMMERCE_ACTIVED && !function_exists( 'telnet_woocommerce_product_search' ) ) {
    function telnet_woocommerce_product_search( $form ) {

        $form = sprintf(
            '<form class="tx-search-widget tx-input-field" action="%s" method="get">
                <div class="position-relative fix">
                    <input type="search" value="%s" required name="s" placeholder="%s">
                    <button class="position-absolute" type="submit"><i class="far fa-search"></i></button>
                    <input type="hidden" name="post_type" value="product">
                </div>
            </form>',
            esc_url( home_url( '/' ) ),
            esc_attr( get_search_query() ),
            esc_html__( 'Search...', 'telnet' )
        );

        return $form;
    }
    add_filter( 'get_product_search_form', 'telnet_woocommerce_product_search' );
    add_filter('render_block_core/search', 'telnet_woocommerce_product_search');
}