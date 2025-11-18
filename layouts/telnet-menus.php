<?php


/**
 * [telnet_header_menu description]
 * @return [type] [description]
 */
function telnet_header_menu() {
    ?>
    <?php
        wp_nav_menu( [
            'theme_location' => 'main-menu',
            'menu_class'     => 'navigation clearfix',
            'container'      => '',
            'fallback_cb'    => 'Navwalker_Class::fallback',
            'walker'         => class_exists( 'Telnet_Mega_Menu_Walker' ) ? new Telnet_Mega_Menu_Walker : '',
        ] );
    ?>
    <?php
}