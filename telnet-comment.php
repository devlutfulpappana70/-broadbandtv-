<?php

add_filter( 'comment_form_default_fields', 'telnet_comment_form_default_fields_func' );

function telnet_comment_form_default_fields_func( $default ) {

    $default['author'] = '
            <div class="row tx-column-gap-20 tx-input-field">
                <div class="col-xl-6">
                    <div class="form-group mt-20">
                        <input type="text" name="author" placeholder="' . esc_attr__( 'Full Name', 'telnet' ) . '">
                    </div>
                </div>';

    $default['email'] = '
                <div class="col-xl-6">
                    <div class="form-group mt-20">
                        <input type="text" name="email" placeholder="' . esc_attr__( 'Email address', 'telnet' ) . '">
                    </div>
                </div>
        ';

    $default['url'] = '
                <div class="col-xl-12 comment-from-right">
                    <div class="form-group mt-20">
                        <input type="text" name="url" placeholder="' . esc_attr__( 'Your Website...', 'telnet' ) . '">
                    </div>
                </div>
            </div>
        ';
    return $default;
}

add_action( 'comment_form_top', 'telnet_add_comments_textarea' );
function telnet_add_comments_textarea() {
    if ( !is_user_logged_in() && function_exists( 'is_product' ) ) {
        echo '<div class="col-xl-12 hideOn-product-details"><div class="tx-input-field"><textarea id="comment" name="comment" cols="60" rows="6" placeholder="' . esc_attr__( 'Write your message here..', 'telnet' ) . '" aria-required="true"></textarea></div></div>';
    }
}

add_filter( 'comment_form_defaults', 'telnet_comment_form_defaults_func' );

function telnet_comment_form_defaults_func( $info ) {
    if ( !is_user_logged_in() ) {

        $info['comment_field'] = '';

        $info['submit_field'] = '%1$s %2$s';
    } else {
        $info['comment_field'] = '

        <div class="row">
            <div class="col-xl-12">
                <div class="tx-input-field">
                    <textarea id="comment" name="comment" cols="30" rows="10" placeholder="' . esc_attr__( 'Your comments...', 'telnet' ) . '"></textarea></div></div>';
        $info['submit_field'] = '%1$s %2$s</div>
        ';
    }

    $form_wrapper = 'logged-in';
    if ( !is_user_logged_in() ) {
        $form_wrapper = 'not-logged';
    }

    $info['submit_button'] = '
    <div class="col-xl-12 submit-button mt-30 ' . esc_attr( $form_wrapper ) . '">
        <button class="tx-button tx-button__styleTheme" type="submit">' . esc_html__( 'Send Message', 'telnet' ) . '</button>
    </div>';

    // check if number of comments is zero
    $comments_number = get_comments_number();

    if( $comments_number == 0 ) {
        $title_class = "mt-0";
    } else {
        $title_class = "mt-0";
    }


    $info['title_reply_before'] = '<h3 class="tx-title mb-30 '.esc_attr($title_class).'">';
    $info['title_reply_after'] = '</h3>';
    $info['comment_notes_before'] = '';

    return $info;
}

// comment view function

if ( !function_exists( 'telnet_comment' ) ) {
    function telnet_comment( $comment, $args, $depth ) {
        $GLOBAL['comment'] = $comment;
        extract( $args, EXTR_SKIP );
        $args['reply_text'] = '' . esc_html__( 'Reply', 'telnet' ) . '';
        $replayClass = 'comment-depth-' . esc_attr( $depth );
        ?>
        <li id="comment-<?php comment_ID();?>">
            <div class="tx-comment-box tx-border-bottom tx-border-op-10 pb-30">
                <?php if( get_avatar($comment, 78, null, null, ['class' => []]) == true ) : ?>
                <div class="comment-avatar">
                    <?php print get_avatar( $comment, 78, null, null, ['class' => []] );?>
                </div>
                <?php endif; ?>
                <div class="comment-text">
                    <div class="position-relative">
                        <h5 class="avatar-name"><?php print get_comment_author_link();?></h5>
                        <span class="date"> <?php comment_time( get_option( 'date_format' ) );?></span>
                    </div>
                    <div class="comment-desc pt-10">
                        <?php comment_text();?>
                        <?php comment_reply_link( array_merge( $args, ['depth' => $depth, 'max_depth' => $args['max_depth']] ) );?>
                    </div>
                </div>
            </div>
        </li>
		<?php
}
}