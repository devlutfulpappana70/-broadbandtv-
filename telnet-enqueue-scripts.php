<?php

/**
 * telnet_scripts description
 * @return [type] [description]
 */
function telnet_scripts() {

    wp_enqueue_style( 'telnet-fonts', telnet_fonts_url(), [], null );
    wp_enqueue_style( 'bootstrap-min', TELNET_THEME_CSS_DIR . 'bootstrap.min.css', [] );
    wp_enqueue_style( 'custom-animate', TELNET_THEME_CSS_DIR . 'custom-animate.css', [] );
    wp_enqueue_style( 'linearicons', TELNET_THEME_CSS_DIR . 'linearicons.css', [] );
    wp_enqueue_style( 'owl', TELNET_THEME_CSS_DIR . 'owl.css', [] );
    wp_enqueue_style( 'font-awesome-min', TELNET_THEME_CSS_DIR . 'font-awesome.min.css', [] );
    wp_enqueue_style( 'animate-min', TELNET_THEME_CSS_DIR . 'animate.min.css', [] );
    wp_enqueue_style( 'flaticon', TELNET_THEME_CSS_DIR . 'flaticon.css', [], VERSION );
    wp_enqueue_style( 'flaticon-2', TELNET_THEME_CSS_DIR . 'flaticon-2.css', [], VERSION );
    wp_enqueue_style( 'flaticon-3', TELNET_THEME_CSS_DIR . 'flaticon-3.css', [], VERSION );
    wp_enqueue_style( 'lightcase', TELNET_THEME_CSS_DIR . 'lightcase.css', [], VERSION );
    wp_enqueue_style( 'meanmenu-min', TELNET_THEME_CSS_DIR . 'meanmenu.min.css', [], VERSION );
    wp_enqueue_style( 'nice-select-min', TELNET_THEME_CSS_DIR . 'nice-select.min.css', [], VERSION );
    wp_enqueue_style( 'odometer-min', TELNET_THEME_CSS_DIR . 'odometer.min.css', [], VERSION );
    wp_enqueue_style( 'magnific-popup', TELNET_THEME_CSS_DIR . 'magnific-popup.css', [] );
    wp_enqueue_style( 'jquery-fancybox-min', TELNET_THEME_CSS_DIR . 'jquery.fancybox.min.css', [] );
    wp_enqueue_style( 'jquery-mCustomScrollbar-min', TELNET_THEME_CSS_DIR . 'jquery.mCustomScrollbar.min.css', [] );
    wp_enqueue_style( 'telnet-swiper-min', TELNET_THEME_CSS_DIR . 'swiper.min.css', [], VERSION );
    wp_enqueue_style( 'telnet-global', TELNET_THEME_CSS_DIR . 'global.css', [], VERSION );
    wp_enqueue_style( 'telnet-header', TELNET_THEME_CSS_DIR . 'header.css', [], VERSION );
    wp_enqueue_style( 'telnet-footer', TELNET_THEME_CSS_DIR . 'footer.css', [], VERSION );
    wp_enqueue_style( 'telnet-core', TELNET_THEME_CSS_DIR . 'telnet-core.css', [], VERSION );
    wp_enqueue_style( 'telnet-companion', TELNET_THEME_CSS_DIR . 'telnet-companion.css', [] );
    wp_enqueue_style( 'default', TELNET_THEME_CSS_DIR . 'default.css', [], VERSION );
    wp_enqueue_style( 'telnet-custom', TELNET_THEME_CSS_DIR . 'telnet-custom.css', [] );
    wp_enqueue_style( 'responsive', TELNET_THEME_CSS_DIR . 'responsive.css', [] );
    wp_enqueue_style( 'responsive-2', TELNET_THEME_CSS_DIR . 'responsive-2.css', [] );
    wp_enqueue_style( 'telnet-style', get_stylesheet_uri() );

    $my_current_lang = apply_filters( 'wpml_current_language', NULL );

    // rtl css files
    $enable_rtl = cs_get_option( 'enable_rtl', false );
    if ( $enable_rtl || is_rtl() ) {
        wp_enqueue_style( 'telnet-rtl', TELNET_THEME_CSS_DIR . 'telnet-rtl.css', [] );
    }

    // all js files
    wp_enqueue_script( 'bootstrap-min', TELNET_THEME_JS_DIR . 'bootstrap.min.js', ['jquery'], false, true );
    wp_enqueue_script( 'imagesloaded', ['jquery'], false, true );
    wp_enqueue_script( 'jquery-ui-core', ['jquery'], false, true );
    wp_enqueue_script( 'isotope-pkgd-min', TELNET_THEME_JS_DIR . 'isotope.pkgd.min.js', ['jquery'], false, true );
    wp_enqueue_script( 'tilt-jquery-min', TELNET_THEME_JS_DIR . 'tilt.jquery.min.js', ['jquery'], false, true );
    wp_enqueue_script( 'jquery-mCustomScrollbar-concat-min', TELNET_THEME_JS_DIR . 'jquery.mCustomScrollbar.concat.min.js', ['jquery'], false, true );
    wp_enqueue_script( 'jquery-fancybox', TELNET_THEME_JS_DIR . 'jquery.fancybox.js', ['jquery'], false, true );
    wp_enqueue_script( 'jquery-paroller-min', TELNET_THEME_JS_DIR . 'jquery.paroller.min.js', ['jquery'], false, true );
    wp_enqueue_script( 'lightcase', TELNET_THEME_JS_DIR . 'lightcase.js', ['jquery'], false, true );
    wp_enqueue_script( 'owl', TELNET_THEME_JS_DIR . 'owl.js', ['jquery'], false, true );
    wp_enqueue_script( 'nav-tool', TELNET_THEME_JS_DIR . 'nav-tool.js', ['jquery'], false, true );
    wp_enqueue_script( 'marquee-min', TELNET_THEME_JS_DIR . 'marquee.min.js', ['jquery'], false, true );
    wp_enqueue_script( 'meanmenu-min', TELNET_THEME_JS_DIR . 'meanmenu.min.js', ['jquery'], false, true );
    wp_enqueue_script( 'jquery-nice-select-min', TELNET_THEME_JS_DIR . 'jquery-nice-select.min.js', ['jquery'], false, true );
    wp_enqueue_script( 'js-jquery-appear', TELNET_THEME_JS_DIR . 'js-jquery.appear.js', ['jquery'], false, true );
    wp_enqueue_script( 'odometer-min', TELNET_THEME_JS_DIR . 'odometer.min.js', ['jquery'], false, true );
    wp_enqueue_script( 'knob', TELNET_THEME_JS_DIR . 'knob.js', ['jquery'], false, true );
    wp_enqueue_script( 'waypoint', TELNET_THEME_JS_DIR . 'waypoint.js', ['jquery'], false, true );
    wp_enqueue_script( 'telnet-swiper-min', TELNET_THEME_JS_DIR . 'swiper.min.js', ['jquery'], false, true );
    wp_enqueue_script( 'masonry-pkgd-min', TELNET_THEME_JS_DIR . 'masonry.pkgd.min.js', ['jquery'], false, true );
    wp_enqueue_script( 'parallax-scroll', TELNET_THEME_JS_DIR . 'parallax-scroll.js', ['jquery'], false, true );
    wp_enqueue_script( 'parallax-min', TELNET_THEME_JS_DIR . 'parallax.min.js', ['jquery'], false, true );
    wp_enqueue_script( 'gsap-min', TELNET_THEME_JS_DIR . 'gsap.min.js', ['jquery'], false, true );
    wp_enqueue_script( 'jquery-filterizr', TELNET_THEME_JS_DIR . 'jquery.filterizr.js', ['jquery'], false, true );
    wp_enqueue_script( 'scrollTrigger-min', TELNET_THEME_JS_DIR . 'scrollTrigger.min.js', ['jquery'], false, true );
    wp_enqueue_script( 'scrollToPlugin-min', TELNET_THEME_JS_DIR . 'scrollToPlugin.min.js', ['jquery'], false, true );
    wp_enqueue_script( 'scrollSmoother-min', TELNET_THEME_JS_DIR . 'scrollSmoother.min.js', ['jquery'], false, true );
    wp_enqueue_script( 'magnific-popup', TELNET_THEME_JS_DIR . 'jquery.magnific-popup.min.js', ['jquery'], false, true );
    wp_enqueue_script( 'splitText-min', TELNET_THEME_JS_DIR . 'splitText.min.js', ['jquery'], false, true );
    wp_enqueue_script( 'wow-min', TELNET_THEME_JS_DIR . 'wow.min.js', ['jquery'], false, true );
    wp_enqueue_script( 'element-in-view', TELNET_THEME_JS_DIR . 'element-in-view.js', ['jquery'], false, true );
    wp_enqueue_script( 'telnet-custom', TELNET_THEME_JS_DIR . 'telnet-custom.js', ['jquery'], false, true );

    // rtl js files
    if ( $enable_rtl || is_rtl() ) {
        wp_enqueue_script( 'telnet-core-rtl', TELNET_THEME_JS_DIR . 'telnet-core-rtl.js', ['jquery'], VERSION, true );
    } else {
        wp_enqueue_script( 'telnet-core', TELNET_THEME_JS_DIR . 'telnet-core.js', ['jquery'], VERSION, true );
    }

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }

}
add_action( 'wp_enqueue_scripts', 'telnet_scripts' );