<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package telnet
 */

get_header();

$blog_column = is_active_sidebar( 'blog-sidebar' ) ? 8 : 12;
?>

<div class="tx-blog-area pt-120 pb-120">
    <div class="container">
        <div class="row tx-column-gap-30">
			<div class="col-xl-<?php print esc_attr( $blog_column );?> blog-post-items blog-padding">
				<div class="blog__wrapper mt-none-30">
					<?php
						if ( have_posts() ):
    					if ( is_home() && !is_front_page() ):
    				?>
					<header>
						<h1 class="page-title screen-reader-text"><?php single_post_title();?></h1>
					</header>

					<?php
						endif;
							/* Start the Loop */
							while ( have_posts() ): the_post();
								get_template_part( 'post-formats/content', get_post_format() );
							endwhile;
						?>

						<div class="tx-pagination">
							<?php telnet_pagination( '<i class="fas fa-chevrons-left"></i>', '<i class="fas fa-chevrons-right"></i>', '', ['class' => ''] );?>
						</div>

						<?php
						else:
							get_template_part( 'post-formats/content', 'none' );
						endif;
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
