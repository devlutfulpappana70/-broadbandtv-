<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package telnet
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function telnet_body_classes( $classes ) {
    // Adds a class of hfeed to non-singular pages.
    if ( !is_singular() ) {
        $classes[] = 'hfeed';
    }
    // Adds a class of no-sidebar when there is no sidebar present.
    if ( !is_active_sidebar( 'sidebar-1' ) ) {
        $classes[] = 'no-sidebar';
    }
    return $classes;
}
add_filter( 'body_class', 'telnet_body_classes' );

/**
 * Get tags.
 */
function telnet_get_tag() {
    $html = '';
    if ( has_tag() ) {
        $html .= '<div class="tx-wrapper">';
        $html .= '<h4 class="tx-title">' . esc_html__( 'Tags:', 'telnet' ) . '</h4>';
        $html .= '<div class="tagcloud">';
        $html .= get_the_tag_list( '', ' ', '' );
        $html .= '</div>';
        $html .= '</div>';
    }
    return $html;
}

/**
 * Get categories.
 */
function telnet_get_category() {

    $categories = get_the_category( get_the_ID() );
    $x = 0;
    foreach ( $categories as $category ) {
        if ( $x == 1 ) {
            break;
        }
        $x++;
     print '<a class="blog-cat" href="' . get_category_link( $category->term_id ) . '">' . esc_html( $category->name ) . '</a>';

    }
}

/** img alt-text **/
function telnet_img_alt_text( $img_er_id = null ) {
    $image_id = $img_er_id;
    $image_alt = get_post_meta( attachment_url_to_postid( $image_id ), '_wp_attachment_image_alt', true );
    $image_title = get_the_title( $image_id );

    if ( !empty( $image_id ) ) {
        if ( $image_alt ) {
            $alt_text = get_post_meta( attachment_url_to_postid( $image_id ), '_wp_attachment_image_alt', true );
        } else {
            $alt_text = get_the_title( $image_id );
        }
    } else {
        $alt_text = esc_html__( 'Image Alt Text', 'telnet' );
    }

    return $alt_text;
}



// telnet_ofer_sidebar_func
function telnet_offer_sidebar_func() {
    if ( is_active_sidebar( 'offer-sidebar' ) ) {

        dynamic_sidebar( 'offer-sidebar' );
    }
}
add_action( 'telnet_offer_sidebar', 'telnet_offer_sidebar_func', 20 );

// telnet_service_sidebar
function telnet_service_sidebar_func() {
    if ( is_active_sidebar( 'services-sidebar' ) ) {

        dynamic_sidebar( 'services-sidebar' );
    }
}
add_action( 'telnet_service_sidebar', 'telnet_service_sidebar_func', 20 );

// telnet_portfolio_sidebar
function telnet_portfolio_sidebar_func() {
    if ( is_active_sidebar( 'portfolio-sidebar' ) ) {

        dynamic_sidebar( 'portfolio-sidebar' );
    }
}
add_action( 'telnet_portfolio_sidebar', 'telnet_portfolio_sidebar_func', 20 );

// telnet_faq_sidebar
function telnet_faq_sidebar_func() {
    if ( is_active_sidebar( 'faq-sidebar' ) ) {

        dynamic_sidebar( 'faq-sidebar' );
    }
}
add_action( 'telnet_faq_sidebar', 'telnet_faq_sidebar_func', 20 );

// mega menu filter
add_filter( 'telnet_enable_megamenu', 'telnet_enable_megamenu' );
function telnet_enable_megamenu() {
	return true;
}

/* ------Disable Lazy loading---- */
add_filter( 'wp_lazy_loading_enabled', '__return_false' );


// post view function
function telnet_post_view($postID) {
    $countKey = 'post_views_count';
    $count = get_post_meta($postID, $countKey, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $countKey);
        add_post_meta($postID, $countKey, '1');
    }else{
        $count++;
        update_post_meta($postID, $countKey, $count);
    }
}


// enable mega menu
add_filter( 'ct_enable_megamenu', 'itfirm_enable_megamenu' );
function itfirm_enable_megamenu() {
	return true;
}


/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function telnet_pingback_header() {
    if ( is_singular() && pings_open() ) {
        printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
    }
}
add_action( 'wp_head', 'telnet_pingback_header' );

/**
 * shortcode supports for removing extra p, spance etc
 *
 */
add_filter( 'the_content', 'telnet_shortcode_extra_content_remove' );
function telnet_shortcode_extra_content_remove( $content ) {

    $array = [
        '<p>['    => '[',
        ']</p>'   => ']',
        ']<br />' => ']',
    ];
    return strtr( $content, $array );

}

// enable_rtl
function telnet_enable_rtl() {
    if ( cs_get_option( 'enable_rtl', false ) ) {
        return ' dir="rtl" ';
    } else {
        return '';
    }
}

function telnet_fonts_url() {
    $font_url = '';
    /**
    * Translators: If there are characters in your language that are not supported
    * by chosen font(s), translate this to 'off'. Do not translate into your own language.
    */
    if ( 'off' !== _x( 'on', 'Google font: on or off', 'telnet' ) ) {
        $font_url = 'https://fonts.googleapis.com/css2?family=Poppins:wght@100;300;400;500;600;700;800;900&family=Unbounded:wght@300;400;500;600;700;800;900&family=Kanit:wght@300;400;500;600;700;800;900&family=Livvic:wght@300;400;500;600;700;900&family=Catamaran:wght@300;400;500;600;700;800;900&display=swap';
    }
    return $font_url;
}

// wp_body_open
if ( !function_exists( 'wp_body_open' ) ) {
    function wp_body_open() {
        do_action( 'wp_body_open' );
    }
}

/**
 *
 * pagination
 */
if ( !function_exists( 'telnet_pagination' ) ) {

    function _telnet_pagi_callback( $pagination ) {
        return $pagination;
    }

    //page navegation
    function telnet_pagination( $prev, $next, $pages, $args ) {
        global $wp_query, $wp_rewrite;
        $menu = '';
        $wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;

        if ( $pages == '' ) {
            global $wp_query;
            $pages = $wp_query->max_num_pages;

            if ( !$pages ) {
                $pages = 1;
            }

        }

        $pagination = [
            'base'      => add_query_arg( 'paged', '%#%' ),
            'format'    => '',
            'total'     => $pages,
            'current'   => $current,
            'prev_text' => $prev,
            'next_text' => $next,
            'type'      => 'array',
        ];

        //rewrite permalinks
        if ( $wp_rewrite->using_permalinks() ) {
            $pagination['base'] = user_trailingslashit( trailingslashit( remove_query_arg( 's', get_pagenum_link( 1 ) ) ) . 'page/%#%/', 'paged' );
        }

        if ( !empty( $wp_query->query_vars['s'] ) ) {
            $pagination['add_args'] = ['s' => get_query_var( 's' )];
        }

        $pagi = '';
        if ( paginate_links( $pagination ) != '' ) {
            $paginations = paginate_links( $pagination );
            $pagi .= '<ul class="mt-50 list-unstyled d-flex align-items-center justify-content-center">';
            foreach ( $paginations as $key => $pg ) {
                $pagi .= '<li>' . $pg . '</li>';
            }
            $pagi .= '</ul>';
        }

        print _telnet_pagi_callback( $pagi );
    }
}

// rtl_enable
function rtl_enable() {
    $my_current_lang = apply_filters( 'wpml_current_language', NULL );
    $rtl_enable = cs_get_option( 'enable_rtl', false );
    if ( $my_current_lang != 'en' && $rtl_enable ) {
        return true;
    } else {
        return false;
    }
}

function telnet_get_allowed_html_tags( $level = 'basic' ) {
    $allowed_html = [
        'b'      => [],
        'i'      => [],
        'u'      => [],
        'em'     => [],
        'br'     => [],
        'abbr'   => [
            'title' => [],
        ],
        'span'   => [
            'class' => [],
        ],
        'strong' => [],
        'a'      => [
            'href'  => [],
            'title' => [],
            'class' => [],
            'id'    => [],
        ]
    ];

    if ($level === 'intermediate') {
        $allowed_html['a'] = [
        'href' => [],
        'title' => [],
        'class' => [],
        'id' => [],
        ];
        $allowed_html['div'] = [
        'class' => [],
        'id' => [],
        ];
        $allowed_html['img'] = [
        'src' => [],
        'class' => [],
        'alt' => [],
        ];
        $allowed_html = [
            'bdi' => [],
            'br' => [],
        ];
    }

    return $allowed_html;
}

// telnet_kses_basic
function telnet_kses_basic( $string = '' ) {
    return wp_kses( $string, telnet_get_allowed_html_tags( 'basic' ) );
}

// telnet_kses_intermediate
function telnet_kses_intermediate( $string = '' ) {
    return wp_kses( $string, telnet_get_allowed_html_tags( 'intermediate' ) );
}


// telnet_search_form
function telnet_search_popup_form() {
    ?>
    <div class="search-popup-wrapper" data-txSearchPopupWrapper>
        <div class="inner-wrapper">
            <button class="close-button" data-search-close><i class="far fa-times"></i></button>
            <form method="get" action="<?php print esc_url( home_url( '/' ) );?>">
                <div class="ta-search-box">
                    <input type="search" name="s" placeholder="<?php print esc_attr__( 'Search Here...', 'telnet' );?>" value="<?php print esc_attr( get_search_query() )?>">
                    <button type="submit"><i class="fal fa-search"></i></button>
                </div>
            </form>
        </div>
    </div>
    <?php
}

// telnet product search_form
function telnet_woo_search_form() {
    ?>
    <form method="get" action="<?php print esc_url(home_url('/')); ?>">
        <div class="telnet-woo-search">
            <input type="hidden" name="post_type" value="product">
            <input type="search" name="s" placeholder="<?php print esc_attr__('Product name E. G.', 'telnet'); ?>">

            <?php $terms = (!empty(get_terms('product_cat'))) ? get_terms('product_cat') : ''; ?>
            <select class="telnet-woo-search__select" name="product_cat">
                <option selected disabled><?php print esc_html__('Categories', 'telnet'); ?></option>
                <?php foreach ($terms as $term): ?>
                <option value="<?php print esc_attr($term->slug); ?>"><?php print esc_html($term->name); ?></option>
                <?php endforeach; ?>
            </select>

            <button type="submit"><i class="fal fa-search"></i></button>
        </div>
    </form>
    <?php
}


function advanced_search_query($query) {

    if($query->is_search()) {
        // category terms search.
        if (isset($_GET['product_cat']) && !empty($_GET['product_cat'])) {
            $query->set('tax_query', array(array(
                'taxonomy' => 'product_cat',
                'field' => 'slug',
                'terms' => array($_GET['product_cat']) )
            ));
        }
    }
    return $query;
}
add_action('pre_get_posts', 'advanced_search_query', 1000);

function telnet_woo_search_popup() {
    ?>
    <div class="search-popup-wrapper">
        <div class="inner-wrapper">
            <button class="close-button" data-search-close><i class="fal fa-times"></i></button>
            <form method="get" action="<?php print esc_url(home_url('/')); ?>">
                <div class="telnet-woo-search telnet-woo-search__popup">
                    <input type="hidden" name="post_type" value="product">
                    <input type="search" name="s" placeholder="<?php print esc_attr__('Product name E. G.', 'telnet'); ?>">

                    <?php $terms = (!empty(get_terms('product_cat'))) ? get_terms('product_cat') : ''; ?>
                    <select class="telnet-woo-search__select" name="product_cat">
                        <option selected disabled><?php print esc_html__('Categories', 'telnet'); ?></option>
                        <?php foreach ($terms as $term): ?>
                        <option value="<?php print esc_attr($term->slug); ?>"><?php print esc_html($term->name); ?></option>
                        <?php endforeach; ?>
                    </select>

                    <button type="submit"><i class="fal fa-search"></i></button>
                </div>
            </form>
        </div>
    </div>
    <?php
}

// telnet_copyright_text
function telnet_copyright_text() {
    print cs_get_option( 'telnet_copyright', telnet_kses_basic( 'Copyright & Design By ThemeXriver', 'telnet' ) );
}
