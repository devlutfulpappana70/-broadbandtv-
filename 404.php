<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package telnet
 */

get_header();

$telnet_error_image = cs_get_option( 'telnet_error_image', get_template_directory_uri() . '/assets/img/illustration/404.svg' );
if(isset($telnet_error_image['url'])) {
	$image_url = $telnet_error_image['url'];
} else {
	$image_url = get_template_directory_uri() . '/assets/img/illustration/404.svg';
}
$telnet_error_title = cs_get_option('telnet_error_title', __('Oops! Page Not found.', 'telnet'));
$telnet_error_link_text = cs_get_option('telnet_error_link_text', __('Back To Home Page', 'telnet'));

?>

<div class="telnet-error-page pt-120 pb-120">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-xl-10">
				<div class="tx-wrapper text-center">
					<?php if(!empty( $image_url )) : ?>
					<div class="tx-thumb">
						<img src="<?php echo esc_url($image_url); ?>" alt="">
					</div>
					<?php endif; ?>
					<div class="tx-content mt-65">
						<h2 class="tx-title"><?php print esc_html($telnet_error_title);?></h2>
						<div class="mt-45">
							<a href="<?php print esc_url( home_url( '/' ) );?>" class="tx-button tx-button__styleTheme m-auto">
								<?php print esc_html($telnet_error_link_text);?>
							</a>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>
</div>

<?php
get_footer();
