<?php


/**
 * Returns a "Continue Reading" link for excerpts
 * Based on the function from the Twenty Ten theme
 *
 * @since Hipoul 1.0
 * @return string "Continue Reading" link
 */
if (!function_exists( 'hipoul_continue_reading_link' ) ) :
  function hipoul_continue_reading_link() {
    if (!is_page()) {
      return '<p></p><a class="btn btn-primary" href="'.get_permalink().'">Read more &raquo;</a>';
    }
  }
endif;


/**
 * Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis and hipoul_continue_reading_link().
 * Based on the function from Twenty Ten theme.
 *
 * To override this in a child theme, remove the filter and add your own
 * function tied to the excerpt_more filter hook.
 *
 * @since Hipoul 1.0
 * @return string An ellipsis
 */
function hipoul_auto_excerpt_more( $more) {
  return apply_filters( 'hipoul_auto_excerpt_more', ' &hellip; '.hipoul_continue_reading_link() );
}
add_filter( 'excerpt_more', 'hipoul_auto_excerpt_more' );


/**
 * Add the Read More link to manual excerpts
 *
 * @since Hipoul 1.0
*/
function hipoul_manual_excerpt_more( $text){
  if (has_excerpt()){
    $text = explode( '</p>', $text);
    $text[count( $text)-2] .= hipoul_continue_reading_link();
    $text = implode( '</p>', $text);
  }
  return $text;
}
if ( $hipoul_settings['show_excerpt_more']) {
  add_filter( 'the_excerpt', 'hipoul_manual_excerpt_more' );
}


/**
 * Generates the posts navigation links
*/
if (!function_exists( 'hipoul_posts_nav' ) ) :
  function hipoul_posts_nav(){ 
    $query = $GLOBALS['wp_query'];
    
    if (function_exists( 'wp_pagenavi' ) ) :  ?>
      <div class="post-nav">
        <?php wp_pagenavi(); ?>
          </div>
        <?php 
    
    elseif ( $query->max_num_pages > 1) : ?>
      <div class="post-nav">
        <?php if (!is_search() ) : ?>
          <p id="previous"><?php next_posts_link(__( 'Older posts &laquo;', 'hipoul' ) ) ?></p>
          <p id="next-post"><?php previous_posts_link(__( '&raquo; Newer posts', 'hipoul' ) ) ?></p>
        <?php else : ?>
          <p id="next-post"><?php next_posts_link(__( 'Next page &raquo;', 'hipoul' ) ) ?></p>
          <p id="previous"><?php previous_posts_link(__( '&laquo; Previous page', 'hipoul' ) ) ?></p>
        <?php endif; ?>
      </div>
    <?php
    endif;
  }
endif;


/**
 * Generates the post navigation links
*/
if ( ! function_exists( 'hipoul_post_nav' ) ) :
  function hipoul_post_nav(){
    if ( is_singular() ) :
    ?>
    <div class="post-nav clearfix">
      <p class="previous"><?php previous_post_link(); ?></p>
      <p class="next-post"><?php next_post_link(); ?></p>
      <?php do_action( 'hipoul_post_nav' ); ?>
    </div>
    <?php
    endif;
  }
endif;


/**
 * Control the excerpt length
*/
function hipoul_modify_excerpt_length( $length ) {
  global $hipoul_settings;
 
  return apply_filters( 'hipoul_modify_excerpt_length', $hipoul_settings['excerpt_length'] );
}
add_filter( 'excerpt_length', 'hipoul_modify_excerpt_length' );


/**
 * Set the excerpt length
 *
 * @param int $length Excerpt length
 *
 * @package Hipoul
 * @since 1.0
*/
function hipoul_set_excerpt_length( $length ){
  if ( ! $length ) return;
  global $hipoul_settings;
  $hipoul_settings['excerpt_length'] = $length;
}


/**
 * Reset the excerpt length
 *
 * @package Hipoul
 * @since 1.0
*/
function hipoul_reset_excerpt_length(){
  global $hipoul_settings, $hipoul_defaults;
  $hipoul_settings['excerpt_length'] = $hipoul_defaults['excerpt_length'];
}


/**
 * This function gets the first image (as ordered in the post's media gallery) attached to
 * the current post. It outputs the complete <img> tag, with height and width attributes.
 * The function returns the thumbnail of the original image, linked to the post's 
 * permalink. Returns FALSE if the current post has no image.
 *
 * This function requires the post ID to get the image from to be supplied as the
 * argument. If no post ID is supplied, it outputs an error message. An optional argument
 * size can be used to determine the size of the image to be used.
 *
 * Based on code snippets by John Crenshaw 
 * (http://www.rlmseo.com/blog/get-images-attached-to-post/)
 *
 * @package Hipoul
 * @since Hipoul 1.0
*/
if ( ! function_exists( 'hipoul_get_post_image' ) ) :
  function hipoul_get_post_image( $post_id = NULL, $size = 'thumbnail', $context = '', $urlonly = false ){
    
    /* Display error message if no post ID is supplied */
    if ( $post_id == NULL ){
      _e( '<strong>ERROR: You must supply the post ID to get the image from as an argument when calling the hipoul_get_post_image() function.</strong>', 'hipoul' );
      return;
    }
    
    /* Get the images */
    $images = get_children( array( 
                'post_type'     => 'attachment',
                'post_mime_type'  => 'image',
                'post_parent'     => $post_id,
                'orderby'     => 'menu_order',
                'order'       => 'ASC',
                'numberposts'   => 1,
                   ), ARRAY_A );
    
    $html = '';
    
    /* Returns generic image if there is no image to show */
    if ( empty( $images ) && $context != 'excerpt' && ! $urlonly ) {
      $html .= apply_filters( 'hipoul_generic_post_img', '' );
    }
    
    /* Build the <img> tag if there is an image */
    foreach ( $images as $image ){
      if (!$urlonly) {
        if ( $context == 'excerpt' ) {$html .= '<div class="excerpt-thumb">';};
        $html .= '<a href="'.get_permalink( $post_id).'">';
        $html .= wp_get_attachment_image( $image['ID'], $size);
        $html .= '</a>';
        if ( $context == 'excerpt' ) {$html .= '</div>';};
      } else {
        $html = wp_get_attachment_image_src( $image['ID'], $size);
      }
    }
    
    /* Returns the image HTMl */
    return $html;
}
endif;


/**
 * Improves the WordPress default excerpt output. This function will retain HTML tags inside the excerpt.
 * Based on codes by Aaron Russell at http://www.aaronrussell.co.uk/blog/improving-wordpress-the_excerpt/
*/
function hipoul_improved_excerpt( $text ){
  global $hipoul_settings, $post;
  
  $raw_excerpt = $text;
  if ( '' == $text ) {
    $text = get_the_content( '' );
    $text = strip_shortcodes( $text );
    $text = apply_filters( 'the_content', $text);
    $text = str_replace( ']]>', ']]&gt;', $text);
    
    /* Remove unwanted JS code */
    $text = preg_replace( '@<script[^>]*?>.*?</script>@si', '', $text);
    
    /* Strip HTML tags, but allow certain tags */
    $text = strip_tags( $text, $hipoul_settings['excerpt_html_tags']);

    $excerpt_length = apply_filters( 'excerpt_length', 55);
    $excerpt_more = apply_filters( 'excerpt_more', ' ' . '[...]' );
    $words = preg_split("/[\n\r\t ]+/", $text, $excerpt_length + 1, PREG_SPLIT_NO_EMPTY);
    if ( count( $words) > $excerpt_length ) {
      array_pop( $words);
      $text = implode( ' ', $words);
      $text = $text . $excerpt_more;
    } else {
      $text = implode( ' ', $words);
    }
  }
  
  // Try to balance the HTML tags
  $text = force_balance_tags( $text );
  
  return apply_filters( 'wp_trim_excerpt', $text, $raw_excerpt);
}

/**
 * Only use the custom excerpt trimming function if user decides to retain html tags.
*/
if ( $hipoul_settings['excerpt_html_tags'] ) {
  remove_filter( 'get_the_excerpt', 'wp_trim_excerpt' );
  add_filter( 'get_the_excerpt', 'hipoul_improved_excerpt' );
}


/**
 * Determine if date should be displayed. Returns true if it should, or false otherwise.
*/
if ( ! function_exists( 'hipoul_should_show_date' ) ) :
  function hipoul_should_show_date(){
    
    // Check post type
    $allowed_posttypes = apply_filters( 'hipoul_date_display_posttype', array( 'post' ) );
    if ( ! in_array( get_post_type(), $allowed_posttypes ) )
      return false;
    
    // Check per-post settings
    global $post;
    $post_setting = get_post_meta( $post->ID, '_hipoul_post_date_display', true );
    if ( $post_setting == 'hide' )
      return false;
      
    // Check global setting
    global $hipoul_settings;
    if ( $hipoul_settings['post_date_display'] == 'hidden' )
      return false;
    
    return true;
  }
endif;


/**
 * This functions adds additional classes to the post element. The additional classes
 * are added by filtering the WordPress post_class() function.
*/
function hipoul_post_class( $classes ){
    global $hipoul_settings;
    
  if ( in_array( $hipoul_settings['post_date_display'], array( 'hidden', 'text' ) ) || ! hipoul_should_show_date() ) {
    $classes[] = 'nodate';
  }

    // Prints the body class
    return $classes;
}
add_filter( 'post_class', 'hipoul_post_class' );


/**
 * Allows post queries to sort the results by the order specified in the post__in parameter. 
 * Just set the orderby parameter to post__in!
 *
 * Based on the Sort Query by Post In plugin by Jake Goldman (http://www.get10up.com)
*/
add_filter( 'posts_orderby', 'hipoul_sort_query_by_post_in', 10, 2 );
function hipoul_sort_query_by_post_in( $sortby, $thequery ) {
  if ( ! empty( $thequery->query['post__in'] ) && isset( $thequery->query['orderby'] ) && $thequery->query['orderby'] == 'post__in' )
    $sortby = "find_in_set(ID, '" . implode( ',', $thequery->query['post__in'] ) . "')";
  
  return $sortby;
}


/**
 * Displays the date. Must be used inside the loop.
 *
 * Accepts 1 argument, $style, which is the style of date to display, which is either 'icon'
 * or 'inline'.
*/
function hipoul_post_date($href){
  global $hipoul_settings;
  ?>
  <span class="date-span">
    <i class="fa fa-lg fa-clock-o"></i>
    <a href="<?php echo $href ?>"><?php the_time('d/m/Y'); ?></a>
  </span>
  <?php do_action( 'hipoul_post_date' );
}


/**
 * Add .first-p class to the first <p> element in a text block
 *
 * @param string $text A text block
 * @return string $text The text block with the .first-p class added to the first <p> element
 *
 * @package Hipoul
 * @since 1.0
 */
function hipoul_first_p( $text ){
  $text = preg_replace('/<p([^>]+)?>/', '<p$1 class="first-p">', $text , 1);
  return apply_filters( 'hipoul_first_p', $text );
}
?>