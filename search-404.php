<div class="post post_404">
  <div class="entry">
    <h2 class="post-title entry-title"><?php _e( 'Error 404 - Page Not Found', 'hipoul' ); ?></h2>
    <div class="entry-content">
      <p><?php _e( "Sorry, I've looked everywhere but I can't find the page you're looking for.", 'hipoul' ); ?></p>
      <p><?php _e( "If you follow the link from another website, I may have removed or renamed the page some time ago. You may want to try searching for the page:", 'hipoul' ); ?></p>
      
      <?php get_search_form(); ?>
    </div>
  </div>
</div>
<div class="post post_404_search">
  <div class="entry"> 
    <h2 class="post-title entry-title"><?php _e( 'Suggested results', 'hipoul' ); ?></h2>   
    <div class="entry-content">
    <p>
      <?php printf( __( "I've done a courtesy search for the term %s for you. See if you can find what you're looking for in the list below.", 'hipoul' ), '<code>' . get_search_query() . '</code>' ); ?>
    </p>
    <?php if ( have_posts() ) : ?>    
      <ul class="search-404-results">
      <?php while ( have_posts() ) : the_post(); ?>
        <li>
          <h3><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php printf( esc_attr__( 'Permalink Link to %s', 'hipoul' ), the_title_attribute( 'echo=0' ) ); ?>"><?php the_title(); ?></a></h3>
          <?php the_excerpt(); ?>
        </li>
      <?php endwhile; ?>
      </ul>
    </div>
  </div>
</div>
    <?php /* Posts navigation. See functions.php for the function definition */ ?>
    <?php hipoul_posts_nav(); ?>
    <?php else : ?>
      <p><?php _e("<strong>Sorry, couldn't find anything.</strong> Try searching for alternative terms using the search form above.", 'hipoul' ); ?></p>
    </div>
  </div>
</div>
<?php endif; ?>