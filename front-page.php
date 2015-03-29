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

    <?php do_action('hipoul_social_profiles'); ?>
  </div><!--/#landing -->
  <div class="front-page">
  <?php get_events(); ?>
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

<?php get_map(); ?>
<?php get_footer(); ?>