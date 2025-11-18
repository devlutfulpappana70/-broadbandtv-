<?php

/**
 * [telnet_product_title description]
 * @return [type] [description]
 */
function telnet_product_title() {
    return '<h2 class="tx-product-title"><a href="' . get_the_permalink() . '">' . get_the_title() . '</a></h2>';
}

function telnet_product_list_cart_button() {
    global $product;
    $class = 'product_type_' . $product->get_type() . ' add_to_cart_button action ' . ($product->supports('ajax_add_to_cart') ? 'ajax_add_to_cart' : '');
    $attributes = array(
        'data-product_id' => $product->get_id(),
        'data-product_sku' => $product->get_sku(),
        'aria-label' => $product->add_to_cart_description(),
        'rel' => 'nofollow',
    );
    print '
        <div class="actions actions__list">';

        print '<div class="cart item d-flex align-items-center justify-content-center ' . $class . '"><a data-product_id="'.$product->get_id().'" data-product_sku="'.$product->get_sku().'" aria-label="'.$product->add_to_cart_description().'" rel="nofollow" class="' . $class . '" href="' . $product->add_to_cart_url() . '" title="'.__('Add to cart!', 'telnet').'"><span class="cart-text">'.__('Add to cart', 'telnet').'</span> <i class="pe-7s-cart"></i></a></div>';
        if( TELNET_WOOCOMMERCE_ACTIVED ) {
            print '<div class="wishlist item d-flex align-items-center justify-content-center">';
            print '';
            print '</div>';
        }
        print '<div class="view item d-flex align-items-center justify-content-center">';

        print '</div>';

    print '</div>';
}

/**
 * [telnet_product_cart_button description]
 * @return [type] [description]
 */
function woocommerce_custom_sale_text($text, $post, $_product) {
    $show_discount_percentage = cs_get_option( 'show_discount_percentage', false );
    if($show_discount_percentage == false) {
        return '<span class="tx-product-badge tx-product-badge__sale position-absolute">'.__('Sell', 'telnet').'</span>';
    }
}

function telnet_discount_badge()
{
    $show_discount_percentage = cs_get_option( 'show_discount_percentage', false );
    if($show_discount_percentage == true) {
        global $product;
        if ( ! $product->is_on_sale() ) return false;
        if ( $product->is_type( 'simple' ) ) {
            $max_percentage = ( ( $product->get_regular_price() - $product->get_sale_price() ) / $product->get_regular_price() ) * 100;
        } elseif ( $product->is_type( 'variable' ) ) {
            $max_percentage = 0;
            foreach ( $product->get_children() as $child_id ) {
                $variation = wc_get_product( $child_id );
                $price = $variation->get_regular_price();
                $sale = $variation->get_sale_price();
                if ( $price != 0 && ! empty( $sale ) ) $percentage = ( $price - $sale ) / $price * 100;
                if ( !empty($percentage) > !empty($max_percentage) ) {
                    $max_percentage = $percentage;
                }
            }
        }
        if ( !empty($max_percentage) > 0 ) return "<span class='tx-product-badge tx-product-badge__sale position-absolute'>-". round($max_percentage) ."%</span>";
    }

}

function telnet_woo_category() {
    global $product;
    $current_cats = get_the_terms( get_the_ID(), 'product_cat' );
    //only start if we have some tags
    if ( $current_cats && ! is_wp_error( $current_cats ) ) {

    //create a list to hold our tags
    echo '<div class="pp__c-top d-flex align-items-center"><div class="pp__cat pp__cat--2">';

    //for each tag we create a list item
    foreach ($current_cats as $cat) {

        $cat_title = $cat->name; // tag name
        $cat_link = get_term_link( $cat );// tag archive link

        echo '<a href="'.$cat_link.'">'.$cat_title.' </a>';
    }

    echo '</div></div>';
    }
}


/**
 * [telnet_woo_rating description]
 * @return [type] [description]
 */
function telnet_product_details_rating(){
    global $product;
    $rating = $product->get_average_rating();
    $rating_count = $product->get_review_count();
    $html = '';
    $html .= '<div class="tx-ratingWrapper d-flex align-items-center mb-20">
    <div class="tx-ratingStars d-flex align-items-center">';
    for ($i = 0; $i <= 4; $i++) {
        if ($i < floor($rating)) {
            $html .= '<i class="fas fa-star"></i>';
        } else {
            $html .= '<i class="fal fa-star"></i>';
        }
    }
    $html .= '</div>
        <span class="tx-ratingText">( ' . $rating_count . ' Customar Review )</span>';
    $html .= '</div>';
    print telnet_product_details_rating_render($html);
}

function telnet_product_details_rating_render($html){
    return $html;
}

function telnet_woo_rating_for_shop(){
    global $product;
    $rating = $product->get_average_rating();
    $rating_count = $product->get_review_count();
    $html = '';
    $html .= '<div class="telnet-rating-wrapper">';
    for ($i = 0; $i <= 4; $i++) {
        if ($i < floor($rating)) {
            $html .= '<i class="fas fa-star"></i> ';
        } else {
            $html .= '<i class="fal fa-star"></i>';
        }
    }
    $html .= '<span class="green">  ' . $rating_count . ' review</span>';
    $html .= '</div>';
    print telnet_woo_rating_for_shop_html($html);
}

function telnet_woo_rating_for_shop_html($html){
    return $html;
}

/**
 * [telnet_woo_rating description]
 * @return [type] [description]
 */
function telnet_woo_shop_rating()
{
    global $product;
    $rating = $product->get_average_rating();
    $review = esc_html('' . $rating . ' review');
    ob_start(); ?>
    <div class="telnet-rating-wrapper telnet-rating-wrapper__details">
        <?php
        for ($i = 0; $i <= 4; $i++) {
            if ($i < floor($rating)) { ?>
                <i class="fas fa-star"></i>
                <?php
            } else { ?>
                <i class="far fa-star"></i>
                <?php
            }
        }
        ?>
    </div>
    <?php
    return ob_get_clean();
}

function telnet_get_price() {
    ob_start(); ?>
    <span class="woocommerce-Price-amount amount price"><?php print telnet_get_price_html(); ?></span>
    <?php
    return ob_get_clean();
}

function telnet_product_price( $product_id, $oldp = false ) {

    $product = wc_get_product( $product_id );

    $old = '';
    $price = $product->get_regular_price();

    if ( $product->get_sale_price() != '' ) {

        $price = $product->get_sale_price();

        if ( $oldp ) {
            $old = '
            <span class="regular">
                / <del>' . get_woocommerce_currency_symbol( get_woocommerce_currency() ) . $product->get_regular_price() . '</del>
            </span>';
        }
    }

    $price = get_woocommerce_currency_symbol( get_woocommerce_currency() ) . $price;

    if ( $product->get_type() == 'grouped' ) {
        return false;
    }

    return '<h6 class="price">' . $price . $old . '</h6> ' ;
}

function telnet_get_price_html() {
    global $product;
    return $product->get_price_html();
}

/**
 * [telnet_comment_rating description]
 * @param  [type] $rating [description]
 * @return [type]         [description]
 */
function telnet_comment_rating($rating)
{
    $review = '' . esc_html($rating) . ' Rating';
    $html = '';
    $html .= '<div class="tx-ratingStars d-flex align-items-center">';
    for ($i = 0; $i <= 4; $i++) {
        if ($i < floor($rating)) {
            $html .= '<i class="fas fa-star"></i>';
        } else {
            $html .= '<i class="fal fa-star"></i>';
        }
    }
    $html .= '</div>';
    return $html;
}


add_filter('woocommerce_product_additional_information_heading', 'telnet_tab_heading');

add_filter('woocommerce_product_description_heading', 'telnet_tab_heading');

/**
 * [telnet_tab_heading description]
 * @param  [type] $heading [description]
 * @return [type]          [description]
 */
function telnet_tab_heading($heading)
{
    return '';
}

function telnet_woocommerce_get_sidebar()
{
    dynamic_sidebar('product-sidebar');
}

// add to cart function
function telnet_add_cart_button() {
    global $product;
    $class = 'product_type_' . $product->get_type() . ' add_to_cart_button action ' . ($product->supports('ajax_add_to_cart') ? 'ajax_add_to_cart' : '');

    $enable_custom_add_to_cart_text = cs_get_option('enable_custom_add_to_cart_text', false);
    $custom_add_to_cart_text = cs_get_option('custom_add_to_cart_text', __('Purchase Now', 'telnet'));

    if($enable_custom_add_to_cart_text == true ){
        $add_cart_text = $custom_add_to_cart_text;
    } else {
        $add_cart_text = $product->add_to_cart_text();
    }

    $attributes = array(
        'data-product_id' => $product->get_id(),
        'data-product_sku' => $product->get_sku(),
        'aria-label' => $product->add_to_cart_description(),
        'rel' => 'nofollow',
    );

    $button_html = '';
    $button_html = '<a href="' . $product->add_to_cart_url() . '" ';
    $button_html .= 'class="tx-button tx-button__styleDark' . ' ' . esc_attr($class) . '" ';
    $button_html .= 'data-product_id="' . $product->get_id() . '" ';
    $button_html .= 'data-product_sku="' . $product->get_sku() . '" ';
    $button_html .= 'aria-label="' . $product->add_to_cart_description() . '" ';
    $button_html .= 'rel="nofollow">' . esc_html($add_cart_text) . '</a>';

    return $button_html;
}


function telnet_product_custom_badge() {
    global $product;
    $id = $product->get_id();
    $telnet_product_meta = get_post_meta($id, 'telnet_product_meta', true) ? get_post_meta($id, 'telnet_product_meta', true) : [];
    $enable_product_badge = array_key_exists('enable_product_badge', $telnet_product_meta) ? $telnet_product_meta['enable_product_badge'] : '';
    $badge_text = array_key_exists('product_badge_text', $telnet_product_meta) ? $telnet_product_meta['product_badge_text'] : '';
    $badge = '';

    if ($enable_product_badge == true && $badge_text != '') {
        $badge = '<span class="tx-product-badge tx-product-badge__new tx-uppercase mb-10">' . esc_html($badge_text) . '</span>';
    }
    return $badge;
}

// product content function
function telnet_woocommerce_template_loop_content() {
    print '<div class="tx-content position-relative tx-z1 pt-20">';
    print function_exists('telnet_product_custom_badge') ? telnet_product_custom_badge() : '';
    print function_exists('telnet_product_title') ? telnet_product_title() : '';
    print '<div class="tx-productPrice pt-10">';
    print function_exists('telnet_get_price') ? telnet_get_price() : '';
    print '</div>';
    print '<div class="tx-buttonWrapper mt-20">';
    print function_exists('telnet_add_cart_button') ? telnet_add_cart_button() : '';
    print '</div>';
    print '</div>';

}

// list contnet function
function telnet_list_woocommerce_template_loop_content() {
    print '<div class="tx-content position-relative tx-z1 pt-20">';
    print function_exists('telnet_product_custom_badge') ? telnet_product_custom_badge() : '';
    print function_exists('telnet_product_title') ? telnet_product_title() : '';
    print '<div class="tx-productPrice pt-10">';
    print function_exists('telnet_get_price') ? telnet_get_price() : '';
    print '</div>';
    print '<div class="tx-buttonWrapper mt-20">';
    print function_exists('telnet_add_cart_button') ? telnet_add_cart_button() : '';
    print '</div>';
    print '</div>';
}


function telnet_woocommerce_template_single_price(){
    print telnet_get_price_html();

}

function woocommerce_template_single_stock()
{
    global $product;
    if ($product->get_stock_quantity() > 0) {
        print '<div class="cart-title">';
        print '<h6>Availability: <span>In Stock</span></h6>';
        print '</div>';
    } else {
        if ($product->backorders_allowed()) {
            print '<div class="cart-title">';
            print '<h6>Availability: <span>On Backorder</span></h6>';
            print '</div>';
        } else {
            print '<div class="cart-title">';
            print '<h6>Availability: <span>Out of stock</span></h6>';
            print '</div>';
        }
    }
}

// Releted Product limit
function telnet_related_products_limit() {
    global $product;

      $args['posts_per_page'] = 3;
      return $args;
}
add_filter( 'woocommerce_output_related_products_args', 'telnet_related_products_args', 20 );
function telnet_related_products_args( $args ) {
    $args['posts_per_page'] = 3; // 4 related products
    $args['columns'] = 2; // arranged in 2 columns
    return $args;
}