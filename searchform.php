<form id="searchform" class="searchform form-inline" method="get" action="<?php echo get_home_url(); ?>">
  <div class="form-group default_searchform">
    <input type="text" name="s" class="form-control" placeholder="<?php _e('Search','hipoul'); ?>" />
    <button type="submit" class="btn btn-primary"><?php _e('Search', 'hipoul'); ?></button>
  </div>
  <?php do_action('hipoul_search_form'); ?>
</form>