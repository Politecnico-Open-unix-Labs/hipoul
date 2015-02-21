<?php

/**
 * Defines the callback function for use with wp_list_comments(). This function controls
 * how comments are displayed.
*/

if (!function_exists('hipoul_comment')):
  function hipoul_comment( $comment, $args, $depth) {
    $GLOBALS['comment'] = $comment; ?>
    <li id="comment-<?php comment_ID(); ?>" <?php comment_class(''); ?>>
      <?php do_action( 'hipoul_before_comment' ); ?>
        
      <div class="comment-wrap">
        <div class="comment-meta">
          <span class="post-author author vcard">
            <div class="post-avatar-wrap"><?php echo get_avatar( $comment, apply_filters( 'hipoul_gravatar_size', 40) ); ?></div>
            <span class="fn nickname"><?php comment_author_link(); ?></span>
          </span>

          <i class="fa fa-lg fa-clock-o"></i><?php echo get_comment_date(); ?> at <?php echo get_comment_time(); ?>
          <span class="timezone"><?php echo '(UTC '.get_option( 'gmt_offset' ).')'; ?></span>
          <i class="fa fa-lg fa-pencil"></i><?php edit_comment_link('Edit comment'); ?>
          <span class="comment-permalink"><i class="fa fa-lg fa-link"></i><a href="<?php echo get_comment_link(); ?>">Link to this comment</a></span>
                        
          <?php do_action( 'hipoul_comment_meta' ); ?>
        </div>
                  
        <div class="comment-entry">
          <?php do_action( 'hipoul_before_commententry' ); 

          if ($comment->comment_approved != '0')
            comment_text();
                        
          do_action( 'hipoul_after_commententry' ); ?>

        </div>
      </div>
              
      <?php do_action( 'hipoul_after_comment' );
  }
endif;


/**
 * Customise the comment form
*/
function hipoul_comment_form_fields(){
	
	$req = get_option( 'require_name_email' );
	$aria_req = ( $req ? ' aria-required="true"' : '' );
	$req_mark = ( $req ? ' <span class="required">*</span>' : '' );
	$commenter = wp_get_current_commenter();
	
	$fields =  array( 
		'author' => 
					'<p class="comment-form-author clearfix">
						<label for="author">' . __( 'Name:', 'hipoul' ) . $req_mark . '</label>
						<input id="author" name="author" type="text" class="form-control"' . $aria_req . ' value="' . esc_attr( $commenter['comment_author'] ) . '" />
					</p>',
		'email'  => 
					'<p class="comment-form-email clearfix">
						<label for="email">' . __( 'Email:', 'hipoul' ) . $req_mark . '</label>
						<input id="email" name="email" type="text" class="form-control"' . $aria_req . ' value="' . esc_attr( $commenter['comment_author_email'] ) . '" />
					</p>',
		'url'    => 
					'<p class="comment-form-url clearfix">
						<label for="url">' . __( 'Website:', 'hipoul' ) . ' </label>
						<input id="url" name="url" type="text" class="form-control" value="' . esc_attr( $commenter['comment_author_url'] ) . '" />
					</p>',
	);
	
	$fields = apply_filters( 'hipoul_comment_form_fields', $fields );
	
	return $fields;
}

// The comment field textarea
function hipoul_comment_textarea(){
	$html =  
		'<p class="comment-form-message">
			<label>Message: <span class="required">*</span></label>
			<div class="row">
        <div class="col-md-6">
          <textarea name="comment" id="comment" class="form-control" rows="3" aria-required="true"></textarea>
        </div>
      </div>
		 </p>';
	echo apply_filters( 'hipoul_comment_textarea', $html );
	
	do_action( 'hipoul_comment_textarea' );
}

// Add all the filters we defined
add_filter( 'comment_form_default_fields', 'hipoul_comment_form_fields' );
add_filter( 'comment_form_field_comment', 'hipoul_comment_textarea' );


function hipoul_get_comment_count(){
  global $wpdb;

  $result = $wpdb->get_var( '
    SELECT
        COUNT(comment_ID)
    FROM
        '.$wpdb->comments.'
    WHERE
        comment_type = "" AND comment_approved="1" AND           
        comment_post_ID= '.get_the_ID() );

	return $result;
}


if (!function_exists('hipoul_should_show_comments')):
function hipoul_should_show_comments() {
  global $hipoul_settings, $post;
    
	if ( $hipoul_settings['comments_setting'] == 'disabled_completely' )
    return false;
    
	if ( $hipoul_settings['comments_setting'] == 'disabled_pages' && get_post_type( $post->ID) == 'page' )
    return false;

	if (!comments_open())
		return false;
	
  return true;
}

endif;
?>