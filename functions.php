<?php

// DEFINE CONSTANTS
define( 'TELNET_THEME_DIR', get_template_directory() );
define( 'TELNET_THEME_URI', get_template_directory_uri() );
define( 'TELNET_THEME_CSS_DIR', TELNET_THEME_URI . '/assets/css/' );
define( 'TELNET_THEME_JS_DIR', TELNET_THEME_URI . '/assets/js/' );
define( 'TELNET_THEME_INC', TELNET_THEME_DIR . '/inc/' );
define( 'TELNET_CORE_PLUG_DIR', plugins_url( 'telnet-core/assets/' ) );
define( 'TELNET_CORE', in_array( 'telnet-core/telnet-core.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) );

// INCLUDE CS FRAMEWORK FILE
require TELNET_THEME_INC . 'csf-functions.php';

if ( !defined( 'TELNET_WOOCOMMERCE_ACTIVED' ) ) {
    define( 'TELNET_WOOCOMMERCE_ACTIVED', in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) );
}

if ( site_url() == "https://themexriver.com/wp/telnet-wp" OR site_url() == 'http://localhost:10510' ) {
    define( 'VERSION', time() );
} else {
    define( 'VERSION', wp_get_theme()->get( 'Version' ) );
}

if ( TELNET_WOOCOMMERCE_ACTIVED ) {
    require_once TELNET_THEME_INC . '/woocommerce/woo-actions.php';
    require_once TELNET_THEME_INC . '/woocommerce/woo-pagination.php';
    require_once TELNET_THEME_INC . '/woocommerce/woo-mini-cart.php';
    require_once TELNET_THEME_INC . '/woocommerce/telnet-woocommerce.php';
}

// INCLUDE TELNET AFTER SETUP
require TELNET_THEME_INC . 'telnet-after-setup.php';

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function telnet_content_width() {
    // This variable is intended to be overruled from themes.
    // Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
    // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
    $GLOBALS['content_width'] = apply_filters( 'telnet_content_width', 640 );
}
add_action( 'after_setup_theme', 'telnet_content_width', 0 );

// INCLUDE TELNET REGISTER WIDGETS
require TELNET_THEME_INC . 'telnet-register-widgets.php';

// INCLUDE TELNET ENQUEUE SCRIPTS
require TELNET_THEME_INC . 'telnet-enqueue-scripts.php';

// INCLUDE CUSTOM HEADER
require TELNET_THEME_INC . 'custom-header.php';

// INCLUDE CUSTOM FUNCTIONS FILE
require TELNET_THEME_INC . 'telnet-functions.php';

// INCLUDE CUSTOM CSS
require TELNET_THEME_INC . 'telnet-custom-css.php';

// INCLUDE DEFAULT COMMENT
require TELNET_THEME_INC . 'telnet-comment.php';

// INCLUDE LOGO FILE
require TELNET_THEME_INC . 'layouts/telnet-logos.php';

// INCLUDE MENU FILE
require TELNET_THEME_INC . 'layouts/telnet-menus.php';

// INCLUDE DEFAULT BREADCRUMB
require TELNET_THEME_INC . 'layouts/telnet-breadcrumb.php';

// INCLUDE MENU FILE
require TELNET_THEME_INC . 'layouts/telnet-sideinfo.php';

// INCLUDE ALL ACTION FILE
require TELNET_THEME_INC . 'layouts/telnet-actions.php';

// INCLUDE SOCIAL LINKS FILE
require TELNET_THEME_INC . 'layouts/telnet-social-links.php';

// INCLUDE DEFAULT HEADER
require TELNET_THEME_INC . 'layouts/telnet-default-header.php';

// INCLUDE FOOTER FILE
require TELNET_THEME_INC . 'layouts/telnet-default-footer.php';

// INCLUDE SEARCH WIDGET FILE
require TELNET_THEME_INC . 'telnet-search-widget.php';

// LOAD JETPACK COMPATIBILITY FILE
if ( defined( 'JETPACK__VERSION' ) ) {
    require TELNET_THEME_INC . 'jetpack.php';
}

// ALL CLASS FILE
include_once TELNET_THEME_INC . 'classes/class-telnet-helper.php';
require_once TELNET_THEME_INC . 'classes/class-breadcrumb.php';
require_once TELNET_THEME_INC . 'classes/class-navwalker.php';
require_once TELNET_THEME_INC . 'classes/class-tgm-plugin-activation.php';
require_once TELNET_THEME_INC . 'required-plugin.php';
