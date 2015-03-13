<?php
/**
 * @package Hipoul
 */
get_header(); ?>

<h1 class="page-title archive-title">
    <?php
        printf( __( 'Search results for: %s', 'hipoul'), '<span>' . get_search_query() . '</span>' );
    ?>
</h1>

<?php 

if ( isset( $_GET['search_404'] ) ) {
  get_template_part('search', '404'); 
} else {
  
  if ( have_posts() ){
    while ( have_posts() ) {
      the_post(); 
      get_template_part( 'loop', 'search' );
    }
    
    /* Posts navigation. */ 
    hipoul_posts_nav();
  } else {
    get_template_part( 'loop', 'not-found' );
  }
}

get_footer(); ?>