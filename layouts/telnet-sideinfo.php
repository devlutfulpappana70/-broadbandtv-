<?php

// telnet_side_info
function telnet_side_info() {

    $header_contact_info_enable = cs_get_option( 'header_contact_info_enable', false );
    $enable_button = cs_get_option( 'enable_button', false );
    $button = cs_get_option( 'button_url', [
        'url'         => '#',
        'is_external' => false,
        'nofollow'    => false,
    ]);

    $button_url = isset($button['url']) ? $button['url'] : '#';
    $button_text = isset($button['text']) ? $button['text'] : 'Get Started';
    $target = isset($button['is_external']) ? $button['is_external'] : false;

    $header_contact_info_icon = cs_get_option( 'header_contact_info_icon' );
    $header_contact_info_label = cs_get_option( 'header_contact_info_label' );
    $header_contact_info_number = cs_get_option( 'header_contact_info_number' );

    if ( has_nav_menu( 'main-menu' ) ) {
        $no_menu_class = 'has-menu';
    } else {
        $no_menu_class = 'no-menu';
    }

    ?>
    <div class="tx-sideInfoWrapper" data-txSideInfoWrapper>
        <div class="top-wrapper d-flex align-items-center justify-content-between">
            <?php function_exists('telnet_side_info_logo') ? telnet_side_info_logo() : ''; ?>
            <button class="tx-close-btn" data-txClose>+</button>
        </div>
        <div class="tx-mobileMmenu mt-50"></div>

        <?php if( $enable_button == true ) : ?>
        <a href="<?php echo esc_url($button_url); ?>" class="tx-button tx-button__styleTheme mt-30" target="<?php echo esc_attr($target); ?>">
            <?php echo esc_html($button_text); ?>
        </a>
        <?php endif; ?>

        <?php if( $header_contact_info_enable == true ) : ?>
        <div class="tx-contact-info tx-contact-info__horizntal mt-30">
            <div class="tx-icon bg-white tx-radious-50 mr-15 tx-rotate-45">
                <i class="<?php echo esc_attr($header_contact_info_icon); ?> fa-beat"></i>
            </div>
            <div class="tx-content">
                <p class="tx-label tx-white">
                    <?php echo esc_html($header_contact_info_label); ?>
                </p>
                <a class="tx-number tx-white" href="tel:<?php echo esc_attr($header_contact_info_number); ?>">
                    <?php echo esc_html($header_contact_info_number); ?>
                </a>
            </div>
        </div>
        <?php endif; ?>

    </div>
<?php }