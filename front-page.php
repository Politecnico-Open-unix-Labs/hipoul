<?php

global $hipoul_settings;
get_header(); ?>

    <div class="text-vertical-center col-md-6 col-md-offset-3">
      <div id="landing-middle">
        <img src="<?php bloginfo('template_directory'); ?>/img/newlogo.svg" alt="Politecnico Open unix Labs Logo" id="landing-logo">
        <h3>We are a student organization and hacking community located in the “Politecnico di Milano”, the largest technical university in Italy.<br>
        <br>We organize lectures, conferences and workshops about hacking, GNU/Linux, programming and open source projects.</h3>
        <a class="btn btn-primary btn-lg" href="#joinus" style="width: 30%; margin-top: 1em;" id="join-button">Join Us.</a>
      </div>
    </div>
  </div><!--/#landing -->
  <div class="front-page">
    <div class="container row">

      <div class="col-md-5 col-md-offset-1">
        <h2>Latest Events</h2>
        <div class="list-group">
        <?php 
        $args = array(
          'numberposts' => 5,
          'offset' => 0,
          'category' => get_cat_ID( "Eventi" ),
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
        <h2>Latest News</h2>
        <div class="list-group">
        <?php 
        $args = array(
          'numberposts' => 5,
          'offset' => 0,
          'category' => get_cat_ID( "Varie" ),
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
                <i class="fa fa-newspaper-o"></i> <b><?php echo get_the_time("m/y",$recent["ID"]) ?></b>
              </div>
              <div class="col-md-9">
                <?php echo $recent["post_title"] ?>
              </div>
            </h5>
          </a>
        <?php } ?> 
        </div>
      </div>
    </div>
  </div>
  <div class="front-page" id="joinus">
    <div class="container">
      <h1>JOIN US!</h1>
      <h3><b>Step 1:</b> join our <a href="https://www.poul.org/cgi-bin/mailman/listinfo/mailinglist">mailing list</a> <i class="fa fa-envelope-o fa-joinus"></i></h3>
      <h3><b>Step 2:</b> visit us! <i class="fa fa-map-marker fa-joinus"></i></h3>
      <h4>But first check if POuL is open.<br><b>Current state:</b></h4>
      <a class="btn btn-danger btn-lg" id="bits-status" href="https://bits.poul.org"><i class="fa fa-times"></i> Closed</a>
    </div>
  </div>
  <div id="map" class="map">
      <iframe scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=Politecnico+Open+unix+Labs,+Milan,+Italy&amp;aq=0&amp;sll=45.477156,9.229814&amp;sspn=0.128789,0.264187&amp;ie=UTF8&amp;hq=Politecnico+Open+unix+Labs,+Milan,+Italy&amp;t=m&amp;z=15&amp;iwloc=A&amp;output=embed" width="100%" frameborder="0" height="100%"></iframe>
      <br>
      <small>
          <a href="https://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=Politecnico+Open+unix+Labs,+Milan,+Italy&amp;aq=0&amp;sll=45.477156,9.229814&amp;sspn=0.128789,0.264187&amp;ie=UTF8&amp;hq=Politecnico+Open+unix+Labs,+Milan,+Italy&amp;t=m&amp;z=15&amp;iwloc=A&amp;output=embed"></a>
      </small>
      
<?php get_footer(); ?>