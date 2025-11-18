<?php
/**
 * Show options for ordering
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/orderby.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     4.3.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$shop_filter = cs_get_option('shop_filter');
?>

<div class="tx-rightWrapper d-flex">
	<?php if( $shop_filter == true ) : ?>
	<nav class="nav tx-sortingTabWrapper" id="shop-filter-tab" role="tablist">
		<a class="nav-link active" id="shop-tab-1-tab" data-bs-toggle="tab"
			href="#shop-tab-1" role="tab" aria-controls="shop-tab-1"
			aria-selected="true"><i class="fa-light fa-grid-2"></i></a>

		<a class="nav-link" id="shop-tab-2-tab" data-bs-toggle="tab" href="#shop-tab-2"
			role="tab" aria-controls="shop-tab-2" aria-selected="false"><i class="far fa-list-ul"></i></a>
	</nav>
	<?php endif; ?>

	<div class="tx-sortingWrapper">
		<form class="woocommerce-ordering mb-0" method="get">
			<select name="orderby" class="orderby" id="select">
				<?php foreach ( $catalog_orderby_options as $id => $name ) : ?>
					<option value="<?php echo esc_attr( $id ); ?>" <?php selected( $orderby, $id ); ?>><?php echo esc_html( $name ); ?></option>
				<?php endforeach; ?>
			</select>
			<input type="hidden" name="paged" value="1" />
			<?php wc_query_string_form_fields( null, array( 'orderby', 'submit', 'paged', 'product-page' ) ); ?>
		</form>
	</div>
</div>
