<?php

// logo css
function telnet_primary_color() {

    wp_enqueue_style( 'telnet-primary-color', TELNET_THEME_CSS_DIR . 'telnet-custom.css', [] );

    $theme_primary_color = cs_get_option( 'theme_primary_color' );
    $theme_color_2 = cs_get_option( 'theme_color_2' );
    $theme_color_3 = cs_get_option( 'theme_color_3' );
    $theme_color_4 = cs_get_option( 'theme_color_4' );
    $theme_color_5 = cs_get_option( 'theme_color_5' );
    $theme_color_6 = cs_get_option( 'theme_color_6' );
    $theme_color_7 = cs_get_option( 'theme_color_7' );

    $theme_gd_color_1 = cs_get_option( 'theme_gd_color_1' );
    $theme_gd_color_2 = cs_get_option( 'theme_gd_color_2' );
    $theme_gd_color_3 = cs_get_option( 'theme_gd_color_3' );
    $theme_gd_color_4 = cs_get_option( 'theme_gd_color_4' );

    if (
        $theme_primary_color ||
        $theme_color_2 ||
        $theme_color_3 ||
        $theme_color_4 ||
        $theme_color_5 ||
        $theme_color_6 ||
        $theme_color_7
    ) {
        $custom_css = '';
        $custom_css .= '
            :root {
                --theme-color: ' . esc_attr( $theme_primary_color ) . ';
                --base-color: ' . esc_attr( $theme_color_2 ) . ';
                --theme-light-color-2: ' . esc_attr( $theme_color_3 ) . ';
                --theme-yellow: ' . esc_attr( $theme_color_4 ) . ';
                --base-color-3: ' . esc_attr( $theme_color_4 ) . ';
                --tna-pr-1: ' . esc_attr( $theme_color_5 ) . ';
                --tna-pr-2: ' . esc_attr( $theme_color_6 ) . ';
                --tna-sd-1: ' . esc_attr( $theme_color_7 ) . ';
            }
        ';

        wp_add_inline_style( 'telnet-primary-color', $custom_css );
    }

    if ( isset( $theme_gd_color_1['color_1'] ) || isset( $theme_gd_color_1['color_2'] ) ) {
        $custom_css = '';
        $custom_css .= '
            :root {
                --gly-pr-1: linear-gradient(90deg, ' . esc_attr( $theme_gd_color_1['color_1'] ) . ' 0%, ' . esc_attr( $theme_gd_color_1['color_2'] ) . ' 100%);
                --base-gradient-4: linear-gradient(90deg, ' . esc_attr( $theme_gd_color_1['color_1'] ) . ' 0%, ' . esc_attr( $theme_gd_color_1['color_2'] ) . ' 100%);
                --tna-gd-1: linear-gradient(90deg, ' . esc_attr( $theme_gd_color_1['color_1'] ) . ' 0%, ' . esc_attr( $theme_gd_color_1['color_2'] ) . ' 100%);
            }
        ';

        wp_add_inline_style( 'telnet-primary-color', $custom_css );
    }

    if ( isset( $theme_gd_color_2['color_1'] ) || isset( $theme_gd_color_2['color_2'] ) ) {
        $custom_css = '';
        $custom_css .= '
            :root {
                --base-gradient-3: linear-gradient(45deg, ' . esc_attr( $theme_gd_color_2['color_1'] ) . ' 0%, ' . esc_attr( $theme_gd_color_2['color_1'] ) . ' 100%);
            }
        ';

        wp_add_inline_style( 'telnet-primary-color', $custom_css );
    }

    if ( isset( $theme_gd_color_3['color_1'] ) || isset( $theme_gd_color_3['color_2'] ) ) {
        $custom_css = '';
        $custom_css .= '
            :root {
                --tna-gd-2: linear-gradient(90deg, ' . esc_attr( $theme_gd_color_3['color_1'] ) . ' 0%, ' . esc_attr( $theme_gd_color_3['color_2'] ) . ' 100%);
            }
        ';

        wp_add_inline_style( 'telnet-primary-color', $custom_css );
    }

    if ( isset( $theme_gd_color_4['color_1'] ) || isset( $theme_gd_color_4['color_2'] ) || isset( $theme_gd_color_4['color_3'] ) ) {
        $custom_css = '';
        $custom_css .= '
            :root {
                --base-gradient-5: linear-gradient(90deg, ' . esc_attr( $theme_gd_color_4['color_1'] ) . ' 0%, ' . esc_attr( $theme_gd_color_4['color_2'] ) . ' 50%, ' . esc_attr( $theme_gd_color_4['color_3'] ) . ');
            }
        ';

        wp_add_inline_style( 'telnet-primary-color', $custom_css );
    }
}
add_action( 'wp_enqueue_scripts', 'telnet_primary_color' );