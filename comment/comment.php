<?php if (post_password_required()) { return; } ?>
<div id="comments" class="comment-section mb-50">
    <?php if (have_comments()) { ?>
        <h4 class="signle-comment-title mb-20">
            <?php comments_number(__('No comment', 'theme_tenten'), __('1 Comments', 'theme_tenten'), '% ' . __('Comments', 'theme_tenten')); ?>
        </h4>
        <span class="title-line"></span>
        <div class="comment-area">
            <?php wp_list_comments(array('avatar_size' => 50, 'style' => 'ul', 'callback' => 'your_theme_slug_comments', 'type' => 'all')); ?>
        </div>
        <?php the_comments_pagination(array('prev_text' => '&larr; <span class="screen-reader-text">' . __('Return', 'theme_tenten') . '</span>', 'next_text' => '<span class="screen-reader-text">' . __('Next', 'theme_tenten') . '</span> &rarr;',)); ?>
    <?php } ?>
    <?php if (!comments_open() && get_comments_number() && post_type_supports(get_post_type(), 'comments')) { ?>
        <p class="no-comments"><?php echo __('Comment has been closed', 'theme_tenten'); ?>.</p>
    <?php } ?>
    <!-- <php comment_form(); ?> -->
</div>
<?php if (comments_open()) : ?>
	<div id="respond" class="comment-form mb-50">
        <h4 class="signle-comment-title mb-20"><?php echo __('Leave A Comment', 'theme_tenten'); ?></h4>
	    <div class="cancel-comment-reply">
	    	<small><?php cancel_comment_reply_link(); ?></small>
	    </div>
	    <?php if (get_option('comment_registration') && !is_user_logged_in()) : ?>
	        <p><a href="<?php echo wp_login_url( get_permalink() ); ?>"><?php echo __('Login', 'theme_tenten'); ?></a> <?php echo __('to comment', 'theme_tenten'); ?>.</p>
	    <?php else : ?>
            <div class="form">
                <form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
                    <div class="row">
                              
                            <div class="col-md-6 mb-30">
                                <input type="text" name="author" id="author" class="form-control" placeholder="<?php echo __('Name', 'theme_tenten'); ?>" value="<?php echo esc_attr($comment_author); ?>" tabindex="1" <?php if ($req) echo "aria-required='true'"; ?>>
                            </div>
                            <div class="col-md-6 mb-30">
                                <input type="text" class="form-control" placeholder="<?php echo __('Email', 'theme_tenten'); ?>" name="email" id="email" value="<?php echo esc_attr($comment_author_email); ?>" size="22" tabindex="2" <?php if ($req) echo "aria-required='true'"; ?>>
                            </div>
                        <?php endif; ?>
                        <div class="col-md-12 mb-30">
                            <textarea name="comment" id="comment" class="form-control" placeholder="<?php echo __('Message', 'theme_tenten'); ?>"></textarea>
                        </div>
                        <div class="col-12">
                            <button type="submit" id="submit" class="custom-btn"><?php echo __('Submit Comment', 'theme_tenten'); ?></button>
                        </div>
                        <?php comment_id_fields(); ?>
                        <?php do_action('comment_form', $post->ID); ?>	
                    </div>
                </form>
            </div>
	    <?php endif; // If registration required and not logged in ?>	       
	</class=>
<?php endif; // if you delete this the sky will fall on your head ?>