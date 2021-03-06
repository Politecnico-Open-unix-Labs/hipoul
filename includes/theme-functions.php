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


function get_map() {
  ?>
  <div id="map" class="map">
    <div class="overlay" onClick="style.pointerEvents='none'"></div>
    <iframe scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=Politecnico+Open+unix+Labs,+Milan,+Italy&amp;aq=0&amp;sll=45.477156,9.229814&amp;sspn=0.128789,0.264187&amp;ie=UTF8&amp;hq=Politecnico+Open+unix+Labs,+Milan,+Italy&amp;t=m&amp;z=15&amp;iwloc=A&amp;output=embed" width="100%" frameborder="0" height="100%"></iframe>
    <br>
    <small>
        <a href="https://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=Politecnico+Open+unix+Labs,+Milan,+Italy&amp;aq=0&amp;sll=45.477156,9.229814&amp;sspn=0.128789,0.264187&amp;ie=UTF8&amp;hq=Politecnico+Open+unix+Labs,+Milan,+Italy&amp;t=m&amp;z=15&amp;iwloc=A&amp;output=embed"></a>
    </small>
  <?php
}


function get_events() {
  ?>
    <div class="container row">
      <div class="col-md-5 col-md-offset-1">
        <h2>Latest Events</h2>
        <div class="list-group">
        <?php 
        $args = array(
          'numberposts' => 5,
          'offset' => 0,
          'category' => get_cat_ID( "Events" ),
          'orderby' => 'post_date',
          'order' => 'DESC',
          'post_status' => 'publish',
          'suppress_filters' => true );

        $recent_posts = wp_get_recent_posts( $args, ARRAY_A );

        foreach( $recent_posts as $recent ){ 
          ?>
          <a href="<?php echo get_permalink($recent["ID"]) ?>" class="list-group-item">
            <h5 class="row">
              <div class="col-md-3">
                <i class="fa fa-calendar-o"></i> <b><?php echo get_the_time("m/y",$recent["ID"]) ?></b>
              </div>
              <div class="col-md-9">
                <?php echo $recent["post_title"] ?>
              </div>
            </h5>
          </a>
        <?php } ?> 
        </div>
      </div>

      <div class="col-md-5">
      <h2>Past Events</h2>
        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
        <?php 
            $args = array(
              'parent'                 => get_category_by_slug('events')->term_id,
              'orderby'                  => 'id',
              'order'                    => 'ASC',
              'hide_empty'               => 0,
            ); 
            $cats = get_categories($args); 
            foreach( $cats as $cat ){
              ?>
              <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="heading<?php echo $cat->slug ?>">
                  <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $cat->slug ?>" aria-expanded="true" aria-controls="collapse<?php echo $cat->slug ?>">
                      <?php echo $cat->name ?>
                    </a>
                  </h4>
                </div>
                <div id="collapse<?php echo $cat->slug ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading<?php echo $cat->slug ?>">
                  <?php
                  $args = array(
                    'offset' => 0,
                    'category' => $cat->term_id,
                    'orderby' => 'post_date',
                    'order' => 'DESC',
                    'post_status' => 'publish',
                    'suppress_filters' => true );

                  $recent_posts = wp_get_recent_posts( $args, ARRAY_A );

                  foreach( $recent_posts as $recent ){ 
                    ?>
                    <a href="<?php echo get_permalink($recent["ID"]) ?>" class="list-group-item">
                      <h5 class="row">
                        <div class="col-md-3">
                          <i class="fa fa-calendar-o"></i> <b><?php echo get_the_time("m/y",$recent["ID"]) ?></b>
                        </div>
                        <div class="col-md-9">
                          <?php echo $recent["post_title"] ?>
                        </div>
                      </h5>
                    </a>
                  <?php }
                  ?>
                </div>
              </div>
            <?php 
          }
          ?>
        </div>
      </div>
    </div>
  <?php
}


?>