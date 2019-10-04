<?php
if ( post_password_required() ) {
    return;
}



function themeton_custom_comment($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment;

    if ( 'div' == $args['style'] ) {
        $tag = 'div';
        $add_below = 'comment';
    } else {
        $tag = 'li';
        $add_below = 'div-comment';
    }

    switch ( $comment->comment_type ) :
        case 'pingback' :
        case 'trackback' :
    ?>
    <<?php echo esc_attr($tag); ?> class="post pingback">
        <p><?php esc_html_e( 'Pingback:', 'acerola' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( esc_html__( 'Edit', 'acerola' ), '<span class="edit-link">', '</span>' ); ?></p>
    <?php
            break;
        default:
    ?>

    <<?php echo esc_attr($tag); ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ) ?> id="comment-<?php comment_ID() ?>">

    <div class="comm-block">
        <div class="comm-img">
            <?php echo get_avatar( $comment, 80 ); ?>
        </div>
        <div class="comm-txt">
            <div class="comment-meta clearfix">
                <h5 class="comment-title"><?php echo get_comment_author_link(); ?></h5>
                <div class="date-post">
                    <span class="fa fa-calendar"></span>
                    <h6><?php printf( esc_html__('%1$s', 'acerola'), get_comment_date() ); ?></h6>
                </div>
            </div>
            <?php comment_text(); ?>
            <?php comment_reply_link( array_merge( $args, array( 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
        </div>
    </div>

<?php
            break;
    endswitch;
}




?>

<div class="row comments-container">
    <div class="col-md-8 col-md-push-2">


        <div class="comments">

            <?php if ( have_comments() ) : ?>
                <h3>
                    <?php
                        printf( _nx( 'One comment', 'Comments (%1$s)', get_comments_number(), 'Comments number', 'acerola' ),
                            number_format_i18n( get_comments_number() ), get_the_title() );
                    ?>
                </h3>

                <?php tt_theme_comment_nav(); ?>

                <ol class="media-list comment-list">
                    <?php
                        wp_list_comments( array(
                            'style'       => 'ol',
                            'short_ping'  => true,
                            'avatar_size' => 56,
                            'callback'    => 'themeton_custom_comment'
                        ) );
                    ?>
                </ol><!-- .comment-list -->

                <?php tt_theme_comment_nav(); ?>

            <?php endif; // have_comments() ?>



            <?php
                // If comments are closed and there are comments, let's leave a little note, shall we?
                if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
            ?>
                <p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'acerola' ); ?></p>
            <?php endif; ?>


        </div>

    </div>
</div>

<div class="row">
    <div class="col-md-8 col-md-push-2">

        <div class="contact-form">
        <?php
            $req = get_option( 'require_name_email' );
            $aria_req = ( $req ? " aria-required='true'" : '' );
            comment_form(
                array(
                    'comment_notes_after' => '',
                    'class_submit' => '',
                    'fields' => array(
                        'author' => '<input id="author" name="author" type="text" placeholder="Name*" value="' . esc_attr( $commenter['comment_author'] ) .
                                            '" size="30"' . $aria_req . ' />',

                        'email' => '<input id="email" name="email" type="text" placeholder="Email*" value="' . esc_attr(  $commenter['comment_author_email'] ) .
                                        '" size="30"' . $aria_req . ' />',

                        'url' => '<input id="url" name="url" type="text" placeholder="Subject" value="' . esc_attr( $commenter['comment_author_url'] ) .
                                        '" size="30" />',
                    ),
                    'comment_field' => '<textarea id="comment" name="comment" placeholder="Message" cols="50" rows="6" tabindex="4" aria-required="true"></textarea>'
                )
            );
        ?>
        </div>

    </div>
    
</div>