<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package telnet
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'tx-blog-box mt-30 format-quote'); ?>>
    <div class="tx-blog-box__tx-content-wrapper tx-pd-30 position-relative tx-radious-25">
        <div class="tx-blog-box__tx-excerpt">
            <?php the_content();?>
        </div>
    </div>
</article>