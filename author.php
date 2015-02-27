<?php
/**
 * The author template file.
 *
 * @package Hipoul
 * @since Hipoul 1.0
 */

get_header(); 

/* Queue the first post, that way we know who
 * the author is when we try to get their name,
 * URL, description, avatar, etc.
 *
 * We reset this later so we can run the loop
 * properly with a call to rewind_posts().
 */
if ( have_posts() ) { the_post(); }

/* Run the loop to output the posts. */
get_template_part( 'loop', 'author' );

do_action( 'hipoul_before_authorpostlist' ); ?>

<h3 class="author-post-list"><?php _e("Author's posts listings", 'hipoul'); ?></h3>

<?php 

/* Start the loop again to list all of the author's posts with excerpt */
rewind_posts();

while ( have_posts() ) {
	the_post();
	get_template_part( 'loop', 'archive' );
}

/* Posts navigation. */ 
hipoul_posts_nav();

do_action('hipoul_after_authorpostlist');

get_footer(); ?>