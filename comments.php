<?php
/**
 * The template for displaying Comments.
 *
 * @package Hipoul
 * @since Hipoul 1.0
 */
global $hipoul_settings;
?>

<?php 
/* Only show comments depending on the theme setting */
if ( !hipoul_should_show_comments() ) : 
    return;
endif;

if ( post_password_required() && ( comments_open() || have_comments() ) ) : ?>
	<div id="comments">
		<p class="nopassword">'This post is password protected. Enter the password to view any comments.</p>        
	</div><!-- #comments -->
  <?php

	return;
endif;

/* Lists all the comments for the current post */
if (have_comments()): ?>

<script type="text/javascript">
	jQuery(document).ready(function($){
		$('li.comment .comment-permalink').hide();
		$('.comment-wrap').hover( function(){ $('.comment-permalink', this).fadeIn(200); }, function(){ $('.comment-permalink:eq(0)', this).fadeOut(200); });
	});
</script>

<div id="comments">
	<?php /* Get the comments count */ 
	$comments_num = hipoul_get_comment_count();
	if ($comments_num):
    $comment_count = '<i class="fa fa-comments"></i> ';
		$comment_count .= sprintf( _n( '1 comment', '%d comments', $comments_num, 'hipoul' ), number_format_i18n( $comments_num ) ); ?>
  	<h3 class="comments"><?php echo $comment_count; ?></h3>
  <?php endif;

  if ($comments_num): ?>
    <ol id="comments-list">
      <?php
       $args = array( 'callback' => 'hipoul_comment', 'style' => 'ol', 'type' => 'comment' );
       wp_list_comments( apply_filters( 'hipoul_comments_list_args', $args ) ); ?>
       
      <?php // Are there comments to navigate through? ?>
      <?php if (get_comment_pages_count() > 1 && get_option( 'page_comments' )) : ?>
      <div class="comment-nav clearfix">
        <?php if ( function_exists( 'wp_commentnavi' ) ) : ?>
          <?php wp_commentnavi(); ?>
          <p class="commentnavi-view-all"><?php wp_commentnavi_all_comments_link(); ?></p>
        <?php else : ?> 
            <p><?php paginate_comments_links(); ?>&nbsp;</p>
        <?php endif; ?>
        <?php do_action( 'hipoul_comments_pagination' ); ?>
      </div>
      <?php endif; // Ends the comment navigation ?>
    </ol>
  <?php endif; ?>
    
</div>
<?php endif; // Ends the comment listing 

/* Display the comment form if comment is open */
if (comments_open()): ?>

	<div id="comment-form-wrap">
		<?php do_action( 'hipoul_before_commentform' );
        
    /* Get the comment form. */ 
    $args = array(
      'comment_notes_after'  => '',
      'title_reply'          => 'Leave a Reply',
      'id_form'              => 'commentform',
      'class_submit'         => 'submit btn btn-primary',
      'label_submit'         => 'Submit Comment',
    );
    comment_form( apply_filters( 'hipoul_comment_form_args', $args ) ); 

    do_action( 'hipoul_after_commentform' );  ?>
	</div>
    
<?php endif; // Ends the comment status ?>