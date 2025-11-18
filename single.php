<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package telnet
 */

get_header();

$blog_column = is_active_sidebar( 'blog-sidebar' ) ? 8 : 12;

if(!empty( TELNET_CORE )) {
	$blog_details_wrapper = 'tx-detailsWrapper__prev';
}else {
	$blog_details_wrapper = 'tx-detailsWrapper__unit';
}

?>

<div class="tx-blog-area pt-120 pb-120">
    <div class="container">
        <div class="row tx-column-gap-30">
			<div class="col-xl-<?php print esc_attr( $blog_column );?>">
				<div class="tx-detailsWrapper <?php echo esc_attr($blog_details_wrapper); ?>">
					<?php
						while ( have_posts() ):
						the_post();
						get_template_part( 'post-formats/content', get_post_format() );

						get_template_part( 'post-formats/content', 'author' );

						if(TELNET_CORE) {
							if(!empty(get_previous_post() || get_next_post()) ) {
								get_template_part( 'post-formats/content', 'related-post' );
							}
						} else if(comments_open() || get_comments_number()) {
							echo '<div class="mt-50"></div>';
						} else {
							echo '<div class="d-none"></div>';
						}

    				?>

					<?php
						// If comments are open or we have at least one comment, load up the comment template.
						if ( comments_open() || get_comments_number() ): ?>
						<div class="tx-commentsWrapper mt-40">
							<?php comments_template(); ?>
						</div>
						<?php
							endif;
							endwhile; // End of the loop.
						?>
				</div>
			</div>
			<?php if ( is_active_sidebar( 'blog-sidebar' ) ): ?>
			<div class="col-xl-4">
				<div class="tx-sidebarWrapper mt-none-30" data-sidebar-sticky>
					<?php get_sidebar();?>
				</div>
			</div>
			<?php endif;?>
		</div>
	</div>
</div>

<?php
get_footer();
