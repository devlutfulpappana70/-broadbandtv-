<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package telnet
 */
    $id = get_the_ID();
    $post_audio_metabox = get_post_meta($id, 'telnet_post_audio_meta', true) ? get_post_meta($id, 'telnet_post_audio_meta', true) : [];
    $post_audio_link = array_key_exists('post_audio_link', $post_audio_metabox) ? $post_audio_metabox['post_audio_link'] : '';

    $author_bio_avatar_size = 40;
    $telnet_enable_social_share = cs_get_option( 'telnet_enable_social_share' );
    $tag_wrapper_class = $telnet_enable_social_share ? 'col-md-6' : 'col-md-12';
    if ( is_single() ):
?>

    <article id="post-<?php the_ID(); ?>"  <?php post_class( 'tx-blog-box tx-blogDetails-box'); ?>>

        <?php if ( !empty( $post_audio_link ) ): ?>
        <div class="tx-blog-box__tx-thumb tx-thumb-zoom pb-30">
            <div class="postbox__audio embed-responsive">
                <?php echo wp_oembed_get( $post_audio_link ); ?>
            </div>
        </div>
        <?php endif; ?>

        <div class="tx-blogDetails-box__wrapper">
            <ul class="tx-blog-box__meta d-flex align-items-center list-unstyled pl-0 mb-0 mt-0">
                <li>
                <a href="<?php print esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) );?>" class="tx-blog-box__tx-authorWrapper d-flex justify-content-center align-items-center">
                    <span class="tx-authorThumb tx-radious-50 tx-border-all tx-border-theme mr-20">
                        <?php echo get_avatar( get_the_author_meta( 'ID' ), $author_bio_avatar_size ); ?>
                    </span>
                    <span class="tx-authorName"><?php print ucfirst(get_the_author()); ?></span>
                </a>
                </li>
                <li>
                    <a href="<?php the_permalink(); ?>#comments">
                        <i class="far fa-comments"></i>
                        <?php comments_number( '0', '1', '%' ); ?>
                        <?php
                            $comment_count = get_comments_number();
                            if ($comment_count === 1) {
                                echo __('Comment', 'telnet');
                            } else {
                                echo __('Comments', 'telnet');
                            }
                        ?>
                    </a>
                </li>
                <li>
                    <a href="<?php echo get_day_link(get_the_time('Y'), get_the_time('M'), get_the_time('j'));?>">
                        <i class="fa-light fa-calendar-days"></i>
                        <?php the_time( get_option( 'date_format' ) );?>
                    </a>
                </li>
            </ul>
            <div class="post-details-content mt-25">
                <?php the_content(); ?>

                <?php if( TELNET_CORE ) : ?>
                <div class="tx-tagSocial-wrapper pt-15">
                    <div class="row">
                        <div class="<?php echo esc_attr($tag_wrapper_class); ?>">
                            <?php if(function_exists('telnet_get_tag')) {
                                    print telnet_get_tag();
                                }
                            ?>
                        </div>
                        <?php if( $telnet_enable_social_share == true ) : ?>
                        <div class="col-md-6 text-end">
                            <?php if(function_exists('telnet_social_share')) {
                                    print telnet_social_share();
                                }
                            ?>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endif; ?>
            </div>
            <div class="post-page-wrapper">
                <?php
                    wp_link_pages( [
                        'before'      => '<div class="page-links mt-40 mb-55">' . esc_html__( 'Pages:', 'telnet' ),
                        'after'       => '</div>',
                        'link_before' => '<span class="page-number">',
                        'link_after'  => '</span>',
                    ] );
                ?>
            </div>
        </div>
    </article>
    <?php else: ?>

    <article id="post-<?php the_ID(); ?>"  <?php post_class( 'tx-blog-box tx-radious-25 tx-border-all tx-border-op-10 mt-30 format-audio'); ?>>

        <?php if ( !empty( $post_audio_link ) ): ?>
        <div class="tx-blog-box__tx-thumb tx-thumb-zoom tx-pd-30 pb-0">
            <div class="postbox__audio embed-responsive">
                <?php echo wp_oembed_get( $post_audio_link ); ?>
            </div>
        </div>
        <?php endif; ?>

        <div class="tx-blog-box__tx-content-wrapper tx-pd-30 position-relative pt-20 pb-35">
            <h2 class="tx-blog-box__tx-title tx-border-effect">
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            </h2>
            <ul class="tx-blog-box__meta d-flex align-items-center list-unstyled pl-0 mb-0 pt-15">
                <li>
                    <a href="<?php the_permalink(); ?>#comments">
                        <i class="far fa-comments"></i>
                        <?php comments_number( '0', '1', '%' ); ?>
                        <?php
                            $comment_count = get_comments_number();
                            if ($comment_count === 1) {
                                echo __('Comment', 'telnet');
                            } else {
                                echo __('Comments', 'telnet');
                            }
                        ?>
                    </a>
                </li>
                <li>
                    <a href="<?php echo get_day_link(get_the_time('Y'), get_the_time('M'), get_the_time('j'));?>">
                        <i class="fa-light fa-calendar-days"></i>
                        <?php the_time( get_option( 'date_format' ) );?>
                    </a>
                </li>
            </ul>
            <div class="tx-blog-box__tx-excerpt mt-30">
                <?php the_excerpt();?>
            </div>
        </div>
        <div class="tx-blog-box__tx-bottomWrapper tx-border-op-10 tx-border-top pt-20 pb-20 pl-30 pr-30 d-flex justify-content-between align-items-center">
            <a href="<?php print esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) );?>" class="tx-blog-box__tx-authorWrapper d-flex justify-content-center align-items-center">
                <span class="tx-authorThumb tx-radious-50 tx-border-all tx-border-theme mr-20">
                    <?php echo get_avatar( get_the_author_meta( 'ID' ), $author_bio_avatar_size ); ?>
                </span>
                <span class="tx-authorName"><?php print ucfirst(get_the_author()); ?></span>
            </a>
            <a href="<?php the_permalink(); ?>" class="tx-inline-btn">
                <?php echo esc_html__('READ MORE', 'telnet'); ?>
                <i class="fas fa-long-arrow-right ml-15"></i>
            </a>
        </div>
    </article>

<?php
endif;?>
