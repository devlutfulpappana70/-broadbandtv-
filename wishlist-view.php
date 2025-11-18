<?php

if ( ! defined( 'YITH_WCWL' ) ) {
	exit;
} // Exit if accessed directly
?>

<!-- WISHLIST TABLE -->
<div class="telnet-cart-wrapper telnet-wishlist-wrapper">
    <table
        class="shop_table cart wishlist_table wishlist_view traditional responsive <?php echo esc_attr($no_interactions) ? 'no-interactions' : ''; ?> <?php echo esc_attr($enable_drag_n_drop) ? 'sortable' : ''; ?> "
        data-pagination="<?php echo esc_attr( $pagination ); ?>" data-per-page="<?php echo esc_attr( $per_page ); ?>" data-page="<?php echo esc_attr( $current_page ); ?>"
        data-id="<?php echo esc_attr( $wishlist_id ); ?>" data-token="<?php echo esc_attr( $wishlist_token ); ?>">

        <?php $column_count = 2; ?>

        <thead>
        <tr>
            <?php if ( $show_cb ) : ?>
                <?php $column_count ++; ?>
                <th class="product-checkbox">
                    <input type="checkbox" value="" name="" id="bulk_add_to_cart"/>
                </th>
            <?php endif; ?>

            <?php if ( $show_remove_product ) : ?>
                <?php $column_count ++; ?>
                <th class="product-remove">
                    <span class="nobr">
                        <?php echo esc_html( apply_filters( 'yith_wcwl_wishlist_view_remove_heading', '', $wishlist ) ); ?>
                    </span>
                </th>
            <?php endif; ?>

            <th class="product-name text-start">
                <span class="nobr">
                    <?php echo esc_html( apply_filters( 'yith_wcwl_wishlist_view_name_heading', __( 'Product', 'telnet' ), $wishlist ) ); ?>
                </span>
            </th>

            <?php if ( $show_price || $show_price_variations ) : ?>
                <?php $column_count ++; ?>
                <th class="product-price text-start">
                    <span class="nobr">
                        <?php
                            echo esc_html( apply_filters( 'yith_wcwl_wishlist_view_price_heading', __( 'Unit price', 'telnet' ), $wishlist ) );
                        ?>
                    </span>
                </th>
            <?php endif; ?>

            <?php if ( $show_quantity ) : ?>
                <?php $column_count ++; ?>
                <th class="product-quantity text-start">
                    <span class="nobr">
                        <?php
                            echo esc_html( apply_filters( 'yith_wcwl_wishlist_view_quantity_heading', __( 'Quantity', 'telnet' ), $wishlist ) );
                        ?>
                    </span>
                </th>
            <?php endif; ?>

            <?php if ( $show_stock_status ) : ?>
                <?php $column_count ++; ?>
                <th class="product-stock-status text-start">
                    <span class="nobr">
                        <?php
                            echo esc_html( apply_filters( 'yith_wcwl_wishlist_view_stock_heading', __( 'Stock status', 'telnet' ), $wishlist ) );
                        ?>
                    </span>
                </th>
            <?php endif; ?>

            <?php if ( $show_last_column ) : ?>
                <?php $column_count ++; ?>
                <th class="product-add-to-cart text-start">
                    <span class="nobr">
                        <?php
                            echo esc_html( apply_filters( 'yith_wcwl_wishlist_view_cart_heading', '', $wishlist ) );
                        ?>
                    </span>
                </th>
            <?php endif; ?>

            <?php if ( $enable_drag_n_drop ) : ?>
                <?php $column_count ++; ?>
                <th class="product-arrange">
                    <span class="nobr">
                        <?php
                            echo esc_html( apply_filters( 'yith_wcwl_wishlist_view_arrange_heading', __( 'Arrange', 'telnet' ), $wishlist ) );
                        ?>
                    </span>
                </th>
            <?php endif; ?>
        </tr>
        </thead>

        <tbody class="wishlist-items-wrapper">
        <?php
        if ( $wishlist && $wishlist->has_items() ) :
            foreach ( $wishlist_items as $item ) :
                /**
                 * Each of the wishlist items
                 *
                 * @var $item \YITH_WCWL_Wishlist_Item
                 */
                global $product;

                $product = $item->get_product();

                if ( $product && $product->exists() ) :
                    ?>
                    <tr id="yith-wcwl-row-<?php echo esc_attr( $item->get_product_id() ); ?>" data-row-id="<?php echo esc_attr( $item->get_product_id() ); ?>">
                        <?php if ( $show_cb ) : ?>
                            <td class="product-checkbox">
                                <input type="checkbox" value="yes" name="items[<?php echo esc_attr( $item->get_product_id() ); ?>][cb]"/>
                            </td>
                        <?php endif ?>

                        <td class="product-thumbnail">
                            <?php do_action( 'yith_wcwl_table_before_product_thumbnail', $item, $wishlist ); ?>

                            <a href="<?php echo esc_url( get_permalink( apply_filters( 'woocommerce_in_cart_product', $item->get_product_id() ) ) ); ?>">
                                <?php echo wp_kses_post( $product->get_image() ); ?>
                            </a>

                            <?php
                            /**
                             * DO_ACTION: yith_wcwl_table_after_product_thumbnail
                             *
                             * Allows to render some content or fire some action after the product thumbnail in the wishlist table.
                             *
                             * @param YITH_WCWL_Wishlist_Item $item     Wishlist item object
                             * @param YITH_WCWL_Wishlist      $wishlist Wishlist object
                             */
                            do_action( 'yith_wcwl_table_after_product_thumbnail', $item, $wishlist );
                            ?>
                        </td>

                        <td class="product-name text-start">
                            <?php do_action( 'yith_wcwl_table_before_product_name', $item, $wishlist ); ?>

                            <a href="<?php echo esc_url( get_permalink( apply_filters( 'woocommerce_in_cart_product', $item->get_product_id() ) ) ); ?>">
                                <?php echo wp_kses_post( apply_filters( 'woocommerce_in_cartproduct_obj_title', $product->get_title(), $product ) ); ?>
                            </a>

                            <?php
                            if ( $show_variation && $product->is_type( 'variation' ) ) {
                                /**
                                 * Product is a Variation
                                 *
                                 * @var $product \WC_Product_Variation
                                 */
                                echo wp_kses_post( wc_get_formatted_variation( $product ) );
                            }
                            ?>

                            <?php if ( $show_remove_product ) : ?>
                            <a href="<?php echo esc_url( $item->get_remove_url() ); ?>" class="remove product-remove remove_from_wishlist" title="<?php echo esc_html( apply_filters( 'yith_wcwl_remove_product_wishlist_message_title', __( 'Remove this product', 'telnet' ) ) ); ?>"><?php echo esc_html__( 'Remove', 'telnet' ); ?></a>
                            <?php endif; ?>

                            <?php do_action( 'yith_wcwl_table_after_product_name', $item, $wishlist ); ?>
                        </td>

                        <?php if ( $show_price || $show_price_variations ) : ?>
                            <td class="product-price text-start">
                                <?php do_action( 'yith_wcwl_table_before_product_price', $item, $wishlist ); ?>

                                <?php
                                if ( $show_price ) {
                                    echo wp_kses_post( $item->get_formatted_product_price() );
                                }

                                if ( $show_price_variations ) {
                                    echo wp_kses_post( $item->get_price_variation() );
                                }
                                ?>

                                <?php do_action( 'yith_wcwl_table_after_product_price', $item, $wishlist ); ?>
                            </td>
                        <?php endif ?>

                        <?php if ( $show_quantity ) : ?>
                            <td class="product-quantity text-start">
                                <?php do_action( 'yith_wcwl_table_before_product_quantity', $item, $wishlist ); ?>

                                <?php if ( ! $no_interactions && $wishlist->current_user_can( 'update_quantity' ) ) : ?>
                                    <input type="number" min="1" step="1" name="items[<?php echo esc_attr( $item->get_product_id() ); ?>][quantity]" value="<?php echo esc_attr( $item->get_quantity() ); ?>"/>
                                <?php else : ?>
                                    <?php echo esc_html( $item->get_quantity() ); ?>
                                <?php endif; ?>

                                <?php

                                do_action( 'yith_wcwl_table_after_product_quantity', $item, $wishlist );
                                ?>
                            </td>
                        <?php endif; ?>

                        <?php if ( $show_stock_status ) : ?>
                            <td class="product-stock-status text-start">
                                <?php

                                do_action( 'yith_wcwl_table_before_product_stock', $item, $wishlist );
                                ?>

                                <?php
                                echo 'out-of-stock' === $item->get_stock_status() ? '<span class="wishlist-out-of-stock">' . esc_html( apply_filters( 'yith_wcwl_out_of_stock_label', __( 'Out of stock', 'telnet' ) ) ) . '</span>' : '<span class="wishlist-in-stock">' . esc_html( apply_filters( 'yith_wcwl_in_stock_label', __( 'In Stock', 'telnet' ) ) ) . '</span>';
                                ?>

                                <?php

                                do_action( 'yith_wcwl_table_after_product_stock', $item, $wishlist );
                                ?>
                            </td>
                        <?php endif ?>

                        <?php if ( $show_last_column ) : ?>
                            <td class="product-add-to-cart text-start">
                                <?php

                                do_action( 'yith_wcwl_table_before_product_cart', $item, $wishlist );
                                ?>

                                <!-- Date added -->
                                <?php
                                if ( $show_dateadded && $item->get_date_added() ) :
                                    // translators: date added label: 1 date added.
                                    echo '<span class="dateadded">' . esc_html( sprintf( __( 'Added on: %s', 'telnet' ), $item->get_date_added_formatted() ) ) . '</span>';
                                endif;
                                ?>

                                <?php

                                do_action( 'yith_wcwl_table_product_before_add_to_cart', $item, $wishlist );
                                ?>

                                <?php

                                $show_add_to_cart = apply_filters( 'yith_wcwl_table_product_show_add_to_cart', $show_add_to_cart, $item, $wishlist );
                                ?>
                                <?php if ( $show_add_to_cart && $item->is_purchasable() && 'out-of-stock' !== $item->get_stock_status() ) : ?>
                                    <?php woocommerce_template_loop_add_to_cart( array( 'quantity' => $show_quantity ? $item->get_quantity() : 1 ) ); ?>
                                <?php endif ?>

                                <?php

                                do_action( 'yith_wcwl_table_product_after_add_to_cart', $item, $wishlist );
                                ?>

                                <!-- Change wishlist -->
                                <?php

                                $move_to_another_wishlist = apply_filters( 'yith_wcwl_table_product_move_to_another_wishlist', $move_to_another_wishlist, $item, $wishlist );
                                ?>
                                <?php if ( $move_to_another_wishlist && $available_multi_wishlist && count( $users_wishlists ) > 1 ) : ?>
                                    <?php if ( 'select' === $move_to_another_wishlist_type ) : ?>
                                        <select class="change-wishlist selectBox">
                                            <option value=""><?php esc_html_e( 'Move', 'telnet' ); ?></option>
                                            <?php
                                            foreach ( $users_wishlists as $wl ) :
                                                /**
                                                 * Each of customer's wishlists
                                                 *
                                                 * @var $wl \YITH_WCWL_Wishlist
                                                 */
                                                if ( $wl->get_token() === $wishlist_token ) {
                                                    continue;
                                                }
                                                ?>
                                                <option value="<?php echo esc_attr( $wl->get_token() ); ?>">
                                                    <?php echo sprintf( '%s - %s', esc_html( $wl->get_formatted_name() ), esc_html( $wl->get_formatted_privacy() ) ); ?>
                                                </option>
                                                <?php
                                            endforeach;
                                            ?>
                                        </select>
                                    <?php else : ?>
                                        <a href="#move_to_another_wishlist" class="move-to-another-wishlist-button" data-rel="prettyPhoto[move_to_another_wishlist]">
                                            <?php
                                            echo esc_html( apply_filters( 'yith_wcwl_move_to_another_list_label', __( 'Move to another list &rsaquo;', 'telnet' ) ) );
                                            ?>
                                        </a>
                                    <?php endif; ?>

                                    <?php

                                    do_action( 'yith_wcwl_table_product_after_move_to_another_wishlist', $item, $wishlist );
                                    ?>

                                <?php endif; ?>

                                <!-- Remove from wishlist -->
                                <?php
                                if ( $repeat_remove_button ) :

                                    ?>
                                    <a href="<?php echo esc_url( $item->get_remove_url() ); ?>" class="remove_from_wishlist button" title="<?php echo esc_html( apply_filters( 'yith_wcwl_remove_product_wishlist_message_title', __( 'Remove this product', 'telnet' ) ) ); ?>"><?php esc_html_e( 'Remove', 'telnet' ); ?></a>
                                <?php endif; ?>

                                <?php do_action( 'yith_wcwl_table_after_product_cart', $item, $wishlist ); ?>
                            </td>
                        <?php endif; ?>

                        <?php if ( $enable_drag_n_drop ) : ?>
                            <td class="product-arrange ">
                                <i class="fa fa-arrows"></i>
                                <input type="hidden" name="items[<?php echo esc_attr( $item->get_product_id() ); ?>][position]" value="<?php echo esc_attr( $item->get_position() ); ?>"/>
                            </td>
                        <?php endif; ?>
                    </tr>
                    <?php
                endif;
            endforeach;
        else :
            ?>
            <tr>
                <td colspan="<?php echo esc_attr( $column_count ); ?>" class="wishlist-empty"><?php echo esc_html( apply_filters( 'yith_wcwl_no_product_to_remove_message', __( 'No products added to the wishlist', 'telnet' ), $wishlist ) ); ?></td>
            </tr>
            <?php
        endif;

        if ( ! empty( $page_links ) ) :
            ?>
            <tr class="pagination-row wishlist-pagination">
                <td colspan="<?php echo esc_attr( $column_count ); ?>">
                    <?php echo wp_kses_post( $page_links ); ?>
                </td>
            </tr>
        <?php endif ?>
        </tbody>

    </table>
</div>
