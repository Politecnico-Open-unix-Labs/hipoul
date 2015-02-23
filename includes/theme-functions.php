<?php


/**
 * Add the social-icons-nav
*/
function hipoul_social_bar(){
  global $hipoul_settings;

  /* Loop through the registered custom social modia */
  $social_profiles = $hipoul_settings['social_profiles'];
  if ( in_array( false, $social_profiles) ) return;

  ?>

  <div class="social-footer">
    <ul class="social-icons-nav">

  <?php
  foreach ( $social_profiles as $social_key => $social_profile ) : 
    if ( !empty( $social_profile['url'] ) || $social_profile['type'] == 'rss' ) : 
      $icon = $social_profile['title'];
      $extra = $hipoul_settings['social_media_new_window'] ?  ' target="_blank"' : '';
      $url = ($social_profile['type'] == 'rss' && empty($social_profile['url'])) ? get_bloginfo('rss2_url') : $social_profile['url'];
      $extra .= ($social_profile['type'] == 'custom') ? ' data-toggle="tooltip" data-placement="right" title="Join our mailinglist!"' : '';
      ?>
      <li class="<?php echo $icon; ?>"><a href="<?php echo $url; ?>" <?php echo $extra; ?>><i class="fa fa-<?php echo $icon; ?>"></i></a></li><?php echo $tooltip ?>            
  <?php endif;
  endforeach;

  echo "</ul></div>";
}
add_action( 'hipoul_social_profiles', 'hipoul_social_bar' );


if ( ! function_exists( 'hipoul_get_avatar_uri' ) ) :
/**
 * Retrieve the avatar URL for a user who provided a user ID or email address.
 *
 * @uses WordPress' get_avatar() function, except that it
 * returns the URL to the gravatar image only, without the <img> tag.
 *
 * @param int|string|object $id_or_email A user ID,  email address, or comment object
 * @param int $size Size of the avatar image
 * @param string $default URL to a default image to use if no avatar is available
 * @param string $alt Alternate text to use in image tag. Defaults to blank
 * @return string URL for the user's avatar
 *
 * @package Hipoul
 * @since 1.0
*/
function hipoul_get_avatar_uri( $id_or_email, $size = '96', $default = '', $alt = false ) {
  
  // Silently fails if < PHP 5
  if ( ! function_exists( 'simplexml_load_string' ) ) return;
  
  $avatar = get_avatar( $id_or_email, $size, $default, $alt );
  if ( ! $avatar ) return false;
  
  $avatar_xml = simplexml_load_string( $avatar );
  $attr = $avatar_xml->attributes();
  $src = $attr['src'];

  return apply_filters( 'hipoul_get_avatar_url', $src, $id_or_email, $size, $default, $alt );
}
endif;


function hipoul_feed_link($output, $feed) {
    global $hipoul_settings;
    
    if ( ( $feed == 'rss2' || $feed == 'rss' ) 
            && $hipoul_settings['use_custom_rss_feed'] && ! empty( $hipoul_settings['custom_rss_feed_url'] ) ) {
        $output = $hipoul_settings['custom_rss_feed_url'];    
    }
    return $output;
}
add_filter( 'feed_link', 'hipoul_feed_link', 1, 2 );

?>