<?php
    $enable_author_box = get_user_meta( 'telnet_enable_author_box', false );
    $user_id  = get_current_user_id();
    $user_meta = get_user_meta( $user_id, 'telnet_user_option', true );
    $telnet_user_social = isset( $user_meta['telnet_user_social'] ) ? $user_meta['telnet_user_social'] : [];
    $author_avatar_size = 140;
    if ( $enable_author_box ) :
?>
<div class="tx-border-top tx-border-op-10 mt-40 fix"></div>
<div class="tx-author-box d-flex align-items-center pt-30">
    <div class="tx-author-box__tx-thumb tx-radious-50 mr-30">
        <a href="<?php print esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) )?>">
            <?php print get_avatar( get_the_author_meta( 'user_email' ), $author_avatar_size, '', '', [ 'class' => 'media-object img-circle' ] );?>
        </a>
    </div>
    <div class="tx-author-box__tx-content">
        <h4 class="tx-name">
            <a href="<?php print esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) )?>"><?php print get_the_author();?></a>
        </h4>
        <p class="mt-15 mb-0"><?php the_author_meta( 'description' );?></p>
        <div class="tx-social-links tx-social-links__styleTheme mt-15 d-flex align-items-center">
            <?php foreach( $telnet_user_social as $userSocail ) : ?>
            <a href="<?php echo esc_url($userSocail['telnet_user_social_link']); ?>"><i class="<?php echo esc_attr($userSocail['telnet_user_social_icon']); ?>"></i></a>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<div class="tx-border-top tx-border-op-10 mt-30"></div>
<?php
    endif;