<?php

/**
 * header style 1 + default
 */
function telnet_default_header() {

    if(has_nav_menu ('main-menu')) {
        $no_menu_class = '';
    } else {
        $no_menu_class = 'no-menu ';
    }

    ?>
    <header class="tx-header tx-header__styleDefault pt-30 tx-headerUnit <?php echo esc_attr($no_menu_class); ?>">
        <div class="container-fluid tx-container-fluid">
            <div class="row">
                <div class="col-xl-12">
                    <div class="tx-wrapper position-relative pl-65 pr-65">
                        <div class="row">
                            <div class="col-lg-12 align-self-center">
                                <div class="tx-wraper d-flex align-items-center">
                                    <div class="tx-logo-wrapper mr-125">
                                        <?php function_exists('telnet_header_logo') ? telnet_header_logo() : ''; ?>
                                    </div>
                                    <div class="tx-menu-wrapper">
                                        <div class="tx-main-menu">
                                            <div id="tx-navbar">
                                                <?php function_exists('telnet_header_menu') ? telnet_header_menu('main-menu') : null; ?>
                                            </div>
                                        </div>
                                        <button class="tx-sideInfo-btn d-flex align-items-center flex-column d-xl-none" data-txSideInfoTrigger>
                                            <span></span>
                                            <span></span>
                                            <span></span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <?php
}
