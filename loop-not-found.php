<div>
  <div class="entry" style="padding-top: 3em; padding-bottom: 3em; text-align: center;">
    <h2 class="post-title entry-title" style="text-align:center;"><?php _e('Not found','hipoul'); ?></h2>
    <div class="entry-content">
      <p>
      <?php 
        if ( ! is_search() )
          _e( "Sorry, but you are looking for something that isn't here. Wanna try a search?", "hipoul" ); 
        else
          _e( "Sorry, but no results were found for that keyword. Wanna try an alternative keyword search?", "hipoul" ); 
      ?>
      </p>
      <?php get_search_form(); ?>
    </div>
  </div>
</div>

<?php do_action('hipoul_not_found'); ?>