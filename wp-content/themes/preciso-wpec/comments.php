<?php

if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
    die ( _('Please do not load this page directly. Thanks!', PIXELART) );

if ( post_password_required() ) { ?>
    <p class="margin-bottom"><?php _e('This post is password protected. Enter the password to view comments.', PIXELART); ?></p>
    <?php
    return;
    }
?>

<!-- comments list -->
<div class="comments">

    <?php if ( have_comments() ) : ?>
        
        <h2><?php _e('COMMENTS', PIXELART)?></h2>
        <p class="half-margin"><?php comments_number( __('No comment for this post.', PIXELART), __('One comment for this post.', PIXELART), __('% Comments for this post.', PIXELART) );?> </p>
        <ul class="media-list">
            <?php wp_list_comments('type=comment&callback=pixelart_comment'); ?>
        </ul>
        <div class="pagination pagination-right">
            <?php paginate_comments_links() ?>
        </div>

    <?php else : ?>

        <?php if ( comments_open() ) : ?>

            <p class="margin-bottom"><em><?php _e('Sorry no comment yet.', PIXELART); ?></em></p>

        <?php else : ?>

            <p class="margin-bottom"><em><?php _e('Comments are closed.', PIXELART); ?></em></p>

        <?php endif; ?>

    <?php endif; ?>

</div>
<!-- comments list -->

<!-- comments form -->
<?php if ( comments_open() ) : ?>
    <hr />
    <div class="submit-comment">
        <div id="comment-form" class="leave_comment" <?php if(is_user_logged_in()){ echo 'class="loggedin  leave_comment "'; } ?>>

            <h2><?php _e('LEAVE A COMMENT', PIXELART); ?></h2>

            <?php if ( get_option('comment_registration') && !is_user_logged_in() ) : ?>
                <p class="half-margin"><?php _e('You must be <a href="'.wp_login_url( get_permalink() ).'">logged in </a>to post a comment.', PIXELART); ?></p>
            <?php
            else :

                $fields =  array(
                    '<div class="controls-row"><input type="text" class="field name span3" id="name" name="author" placeholder="'.__('Your Name', PIXELART).'" value="'.esc_attr($comment_author).'" />',
                    '<input type="text" class="field email span3" id="email" name="email" placeholder="'.__('Your Email', PIXELART).'" value="'.esc_attr($comment_author_email).'" /></div>'
                );

                $comments_args = array(
                    'fields' => $fields,
                    'title_reply' => '',
                    'title_reply_to' => '',
                    'comment_notes_after' => '',
                    'cancel_reply_link'	=> '',
                    'label_submit' => __('Submit', PIXELART),
                    'comment_field' => '<div class="clearfix"></div><textarea name="comment" class="textarea span6" id="comment-textarea" cols="30" rows="3" placeholder="'.__('Your Name', PIXELART).'"></textarea>',
                );

                comment_form($comments_args);

            endif;

            ?>

        </div>
    </div>
<?php endif; ?>
<!-- comments form -->