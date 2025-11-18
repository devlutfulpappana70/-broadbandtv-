<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-layouts
 *
 * @package telnet
 */

$preloader_enable = cs_get_option( 'preloader_enable', true );
$enable_scroll_up = cs_get_option( 'enable_scroll_up', true );
$preloader_image = cs_get_option( 'preloader_image', get_template_directory_uri() . '/assets/img/loader.svg');

if(!empty($preloader_image['url'])) {
    $image_url = $preloader_image['url'];
} else {
    $image_url = get_template_directory_uri() . '/assets/img/loader.svg';
}

?>

<!doctype html>
<html <?php language_attributes();?> <?php print telnet_enable_rtl(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' );?>">
    <?php if ( is_singular() && pings_open( get_queried_object() ) ): ?>
    <?php endif;?>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head();?>
</head>

<body <?php body_class();?>>
<?php wp_body_open();?>

<div class="inner-wrapper fix">

    <!-- preloader start -->
    <?php if( $preloader_enable == true ) : ?>
    <div id="tx-preloader">
        <img src="<?php echo esc_url($image_url); ?>" alt="" class="loader-img">
    </div>
    <?php endif; ?>
    <!-- preloader end -->

    <!-- back to top start -->
    <?php if( $enable_scroll_up == true ) : ?>
    <div class="up">
		<a href="#" class="tx-scrollup text-center"><i class="fas fa-chevron-up"></i></a>
	</div>
    <?php endif; ?>
    <!-- back to top end -->

    <!-- overlay start -->
    <div class="tx-overlay" data-txOverlay></div>
    <!-- overlay end -->

    <!-- header start -->
    <?php do_action( 'telnet_header_style' );?>
    <!-- header end -->

    <!-- wrapper-box start -->
    <?php do_action( 'telnet_before_main_content' );?>

    <!-- side info -->
    <?php function_exists('telnet_side_info') ? telnet_side_info() : ''; ?>
    <?php function_exists('telnet_search_popup_form') ? telnet_search_popup_form() : ''; ?>

    <?php
        if (TELNET_WOOCOMMERCE_ACTIVED) {
            function_exists('telnet_mini_cart') ? print telnet_mini_cart() : '';
        }
    ?>