<?php

function telnet_default_footer() {
    $id = get_the_ID();
    $page_meta = get_post_meta($id, 'telnet_page_meta', true) ? get_post_meta($id, 'telnet_page_meta', true) : [];
    $footer_columns = 0;
    $footer_widgets = cs_get_option( 'footer_widget_number' );

    switch ( $footer_columns ) {
    case '1':
        $footer_class[1] = 'col-lg-12';
        break;
    case '2':
        $footer_class[1] = 'col-lg-6 col-md-6';
        $footer_class[2] = 'col-lg-6 col-md-6';
        break;
    case '3':
        $footer_class[1] = 'col-lg-4 col-md-6 col-sm-6';
        $footer_class[2] = 'col-lg-4 col-md-6 col-sm-6';
        $footer_class[3] = 'col-lg-4 col-md-6 col-sm-6';
        break;
    case '4':
        $footer_class[1] = 'col-lg-3 col-md-6 col-sm-6';
        $footer_class[2] = 'col-lg-3 col-md-6 col-sm-6';
        $footer_class[3] = 'col-lg-3 col-md-6 col-sm-6';
        $footer_class[4] = 'col-lg-3 col-md-6 col-sm-6';
        break;
    case '5':
        $footer_class[1] = 'col-xl-2 col-lg-4 col-md-4 col-sm-6';
        $footer_class[2] = 'col-xl-2 col-lg-4 col-md-4 col-sm-6';
        $footer_class[3] = 'col-xl-2 col-lg-4 col-md-4 col-sm-6';
        $footer_class[4] = 'col-xl-2 col-lg-4 col-md-4 col-sm-6';
        $footer_class[5] = 'col-xl-2 col-lg-4 col-md-4 col-sm-6';
        break;
    default:
        $footer_class = 'col-xl-3 col-lg-6 col-md-6';
        break;
    }


    ?>

    <footer class="tx-footer tx-footer__styleDefault tx-bb2px tx-dark-bg">
        <div class="container">
        <?php if ( is_active_sidebar('footer-1') OR is_active_sidebar('footer-2') OR is_active_sidebar('footer-3') ) : ?>
            <div class="tx-wrapper pt-85 pb-40">
                <div class="row mt-none-30">
                    <?php
                        if ( $footer_columns < $footer_widgets ) {
                            print '<div class="col-lg-4 col-md-6 col-sm-6">';
                            dynamic_sidebar( 'footer-1');
                            print '</div>';

                            print '<div class="col-lg-4 col-md-6 col-sm-6">';
                            dynamic_sidebar( 'footer-2');
                            print '</div>';

                            print '<div class="col-lg-4 col-md-6 col-sm-6">';
                            dynamic_sidebar( 'footer-3');
                            print '</div>';

                        }
                        else {
                            for( $num=1; $num <= $footer_columns; $num++ ) {
                                if ( !is_active_sidebar( 'footer-'. $num ) ) continue;
                                print '<div class="' . esc_attr( $footer_class[$num] ) . '">';
                                    dynamic_sidebar( 'footer-'. $num );
                                print '</div>';
                            }
                        }
                    ?>
                </div>
            </div>
            <?php endif; ?>
            <div class="row">
                <div class="col-xl-12 text-center">
                    <div class="tx-copyright tx-copyright__styleDefault">
                        <p> <?php telnet_copyright_text(); ?> </p>
                    </div>
                </div>
            </div>
        </div>
    </footer>

<?php

}