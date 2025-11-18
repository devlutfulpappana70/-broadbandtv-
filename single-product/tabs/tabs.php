<?php
/**
 * Single Product tabs
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/tabs/tabs.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see    https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 4.3.1
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Filter tabs and allow third parties to add their own.
 *
 * Each tab is an array containing title, callback and priority.
 * @see woocommerce_default_product_tabs()
 */
$tabs = apply_filters('woocommerce_product_tabs', array());
$i = $j = 0;
if (!empty($tabs)) : ?>

<div class="tx-productTabWrapper mt-60">
    <div class="row">
        <div class="col-12">
            <nav class="nav tx-productTabNav d-flex align-items-center" id="pinfo-tab" role="tablist">
                <?php foreach ($tabs as $key => $tab) : ?>
                <?php $cl = ($j == 0) ? ' active' : ''; ?>
                <?php $true = ($j == 0) ? 'true' : ''; ?>

                <a class="nav-link <?php print esc_html($cl); ?>" id="pinfo-<?php echo esc_attr($key); ?>-tab" data-bs-toggle="tab" href="#pinfo-<?php echo esc_attr($key); ?>" role="tab" aria-controls="pinfo-<?php echo esc_attr($key); ?>" aria-selected="<?php echo esc_attr($true); ?>">
                    <?php echo apply_filters('woocommerce_product_' . $key . '_tab_title', esc_html($tab['title']), $key); ?>
                </a>

                <?php $j++; endforeach; ?>
            </nav>

            <div class="tx-productTabContent tab-content pt-30" id="pinfoContent">
                <?php foreach ($tabs as $key => $tab) : ?>
                <?php $cl = ($i == 0) ? 'show active' : ''; ?>
                <div class="tab-pane fade <?php print esc_html($cl); ?>" id="pinfo-<?php echo esc_attr($key); ?>" role="tabpanel" aria-labelledby="pinfo-<?php echo esc_attr($key); ?>-tab">
                    <?php if (isset($tab['callback'])) {
                        call_user_func($tab['callback'], $key, $tab);
                    } ?>

                </div>
                <?php $i++; endforeach; ?>
            </div>
        </div>
    </div>
</div>

<?php endif; ?>
