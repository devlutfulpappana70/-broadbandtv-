<?php
// header logos
function telnet_header_logo() {
    ?>
    <?php
        $telnet_site_logo = cs_get_option( 'telnet_logo', get_template_directory_uri() . '/assets/img/logo/logo.png');
        if(isset($telnet_site_logo['url'])) {
            $logo_url = $telnet_site_logo['url'];
        } else {
            $logo_url = get_template_directory_uri() . '/assets/img/logo/logo.png';
        }
            if ( has_custom_logo() ) {
                the_custom_logo();
            } else {

            ?>
                <a class="tx-logo" href="<?php print esc_url( home_url( '/' ) );?>">
                    <img src="<?php echo esc_url($logo_url); ?>" alt="<?php if(function_exists('telnet_img_alt_text')) { echo telnet_img_alt_text($logo_url); } ?>" />
                </a>
            <?php

            }
        ?>
    <?php
}



// side info logo
function telnet_side_info_logo() {
    $telnet_side_info_logo = cs_get_option( 'telnet_side_info_logo', get_template_directory_uri() . '/assets/img/logo/logo-white.png');
    if(isset($telnet_side_info_logo['url'])) {
        $logo_url = $telnet_side_info_logo['url'];
    } else {
        $logo_url = get_template_directory_uri() . '/assets/img/logo/logo-white.png';
    }

    ?>
    <a class="tx-logo" href="<?php print esc_url( home_url( '/' ) );?>">
        <img src="<?php print esc_url( $logo_url );?>" alt="<?php if(function_exists('logo_url')) { echo telnet_img_alt_text($logo_url); } ?>" />
    </a>


<?php }