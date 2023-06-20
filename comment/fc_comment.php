<?php 
// Add class reply comments
add_filter('comment_reply_link', 'replace_reply_link_class');
function replace_reply_link_class($class) {
  $class = str_replace("class='comment-reply-link'", "class='comment-reply-link reply-btn'", $class);
  return $class;
}
add_filter('comment_flood_filter', '__return_false');
// Custom callback comments
function your_theme_slug_comments($comment, $args, $depth) {
  $GLOBALS['comment'] = $comment; 
  ?>
    <div class="single-comment" <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
      <div class="commenter-img">
        <?php echo get_avatar($comment, $args['avatar_size'], null, null, array('class' => array('img-responsive', 'img-circle'))); ?>
      </div>
      <div class="comment">
        <h4 class="commenter-name"><?php echo get_comment_author(); ?></h4>
        <div class="date-reply">
          <span class="comment-date"><?php echo get_comment_date(); ?></span>
          <?php comment_reply_link(array_merge($args, array('reply_text' => __('Reply', 'theme_tenten'), 'depth' => $depth, 'max_depth' => $args['max_depth'])), $comment->comment_ID); ?>
        </div>
        <?php if ($comment->comment_approved == '0') { ?>
          <em><?php _e('Comments are being reviewed', 'theme_tenten'); ?>.</em><br/>
        <?php } ?>
        <p class="comment-content"><?php comment_text(); ?></p>
      </div>
    </div>
  <?php 
}
// Enqueue comment-reply
add_action('wp_enqueue_scripts', 'your_theme_slug_public_scripts');
function your_theme_slug_public_scripts() {
  if (!is_admin()) {
    if (is_singular() && get_option('thread_comments')) {
      wp_enqueue_script('comment-reply'); 
    }
  }
}
// add_filter( 'pre_comment_approved', 'wpse_prevent_comment_auto_approval', '99', 2 );
// function wpse_prevent_comment_auto_approval() {
//   return '0';
// }
// Validate comment
function comment_validation_init() {
  ?>
  <script>
    document.getElementById("commentform").addEventListener("submit", function(event){
      validateCommentForm(event);
    });
    function validateCommentForm(event) {
      // Lấy giá trị các trường thông tin trong form
      var nameField = document.getElementById("author");
      var emailField = document.getElementById("email");
      var commentField = document.getElementById("comment");
      if($('p.error')) {
        $('p.error').remove();
      }
      // Kiểm tra trường "name" không được bỏ trống
      if (commentField.value.trim() == "") {
        $('#comment').after('<p class="error" style="color:red">Please enter your comment!</p>');
        commentField.focus();
        event.preventDefault();
        commentField.value = "";
      } else if (commentField.value.trim().length < 10) {
        $('#comment').after('<p class="error" style="color:red">Please enter a comment of at least 10 characters!</p>');
        commentField.focus();
        event.preventDefault();
        commentField.value = "";
      }
            
      // Kiểm tra trường "email" không được bỏ trống và đúng định dạng email
      var emailPattern = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/; 
      if (emailField.value.trim() == "") {
        $('#email').after('<p class="error" style="color:red">Please enter your email!</p>');
        emailField.focus();
        event.preventDefault();
        emailField.value = "";
      } else if(!emailPattern.test(emailField.value)) {
        $('#email').after('<p class="error" style="color:red">Please enter the correct email format!</p>');
        emailField.focus();
        event.preventDefault();
        emailField.value = "";
      }
      // Kiểm tra trường "name" không được bỏ trống
      if (nameField.value.trim() == "") {
        $('#author').after('<p class="error" style="color:red">Please enter your name!</p>');
        nameField.focus();
        event.preventDefault();
        nameField.value = "";
      } else if (nameField.value.trim().length < 2) {
        $('#author').after('<p class="error" style="color:red">Please enter Name at least 2 characters!</p>');
        nameField.focus();
        event.preventDefault();
        nameField.value = "";
      }
      // Nếu các trường thông tin đều hợp lệ, tiếp tục submit form
      return true;
    }
  </script>
  <?php
}
add_action('wp_footer', 'comment_validation_init');