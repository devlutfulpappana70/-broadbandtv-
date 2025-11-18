<?php

if (TELNET_WOOCOMMERCE_ACTIVED) {
    function telnet_mini_cart()
    {
        ob_start();
        ?>
        <div class="tx-sideInfoWrapper tx-sideInfoWrapper__styleLight" data-txMiniCartWrapper>
            <div class="top-wrapper d-flex align-items-center justify-content-between mb-20 pb-25">
                <h3 class="tx-title">
                    <?php echo esc_html__('Cart Items', 'telnet'); ?>
                    <span class="tx-cart-count tx-radious-50 position-static">
                        <?php echo esc_html(WC()->cart->cart_contents_count); ?>
                    </span>
                </h3>
                <button class="tx-close-btn" data-txClose>+</button>
            </div>

            <div class="header-mini-cart">
                <?php woocommerce_mini_cart(); ?>
            </div>
        </div>
        <?php return ob_get_clean();
    }
}

if (!function_exists('telnet_header_cart_count')) {
    function telnet_header_cart_count($fragments)
    {
        ob_start();
        ?>
        <span class="tx-cart-count tx-radious-50">
            <?php print esc_html(WC()->cart->cart_contents_count); ?>
        </span>
        <?php
        $fragments['.tx-cart-count'] = ob_get_clean();
        return $fragments;
    }
}

add_filter('woocommerce_add_to_cart_fragments', function ($fragments) {
    // Modify the mini cart content
    ob_start();
    ?>
    <div class="header-mini-cart">
        <?php woocommerce_mini_cart(); ?>
    </div>
    <?php
    $fragments['.header-mini-cart'] = ob_get_clean();

    // Modify the cart count
    ob_start();
    ?>
    <span class="tx-cart-count tx-radious-50">
        <?php print esc_html(WC()->cart->cart_contents_count); ?>
    </span>
    <?php
    $fragments['.tx-cart-count'] = ob_get_clean();

    return $fragments;
});
