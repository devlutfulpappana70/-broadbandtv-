<?php
$telnet_enable_blog_navigation = cs_get_option('telnet_enable_blog_navigation');
$telnet_prev_post = get_previous_post();
$telnet_next_post = get_next_post();
if( $telnet_enable_blog_navigation == true ) {
    if(!empty(get_previous_post() || get_next_post()) ) {
        ?>
        <div class="tx-nextPrev-post-wrapper pt-40">
            <div class="row">
                <div class="col-md-6">
                    <a href="<?php print get_the_permalink($telnet_prev_post); ?>" class="tx-nextPrev-post tx-prevPost">
                        <i class="fas fa-long-arrow-left mr-10"></i>
                        <span class="tx-uppercase"><?php echo esc_html__('Previous Post', 'telnet'); ?></span>
                    </a>
                </div>
                <div class="col-md-6 text-end">
                    <a href="<?php print get_the_permalink($telnet_next_post); ?>" class="tx-nextPrev-post tx-nextPost">
                        <span class="tx-uppercase"><?php echo esc_html__('NEXT POST', 'telnet'); ?></span>
                        <i class="fas fa-long-arrow-right ml-10"></i>
                    </a>
                </div>
            </div>
        </div>
    <?php
    }
}
?>