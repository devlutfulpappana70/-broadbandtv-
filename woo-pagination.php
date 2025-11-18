<?php

// WOOCOMERCE PAGINATION
function telnet_woo_pagination( $pagination ) {
    $pagi = '';
    if ( $pagination != '' ) {
        $pagi .= '<div class="tx-pagination tx-pagination__styleShop">
        <ul class="mt-50 list-unstyled d-flex align-items-center justify-content-center">';
        foreach ( $pagination as $key => $pg ) {
            $pagi .= '<li class="page-item">' . $pg . '</li>';
        }
        $pagi .= '</ul></div>';
    }
    return $pagi;
}