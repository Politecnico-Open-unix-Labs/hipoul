<?php 

global $hipoul_settings; 
$post_type = get_post_type_object( get_post_type() );

/**
 * Check if the post has a post format. Load a post-format specific loop file,
 * if it has. Continue with standard loop otherwise.
*/ 
if ( function_exists( 'get_post_format' ) ) {
  global $post_format;
  $post_format = get_post_format();
  
  // Get the post formats supported by the theme
  $supported_formats = get_theme_support( 'post-formats' );
  if(is_array($supported_formats)) $supported_formats = $supported_formats[0]; 
  
  if(in_array($post_format, $supported_formats)){
    // Get the post format loop file
    get_template_part( 'loop-post-formats', $post_format );
    
    // Stop this default posts loop
    return;
  }
}
?>

<?php /* Post navigation */ ?>
<?php hipoul_post_nav(); ?>
        
<div id="post-<?php the_ID(); ?>" <?php post_class( 'post' ); ?>>
  
  <?php do_action( 'hipoul_before_post' ); ?>
  
  <div class="entry">
    <h1 class="post-title entry-title">
      <?php if ( get_the_title() == '' ) { _e( '(No title)', 'hipoul' ); } else { the_title(); } ?>
      <?php do_action( 'hipoul_post_title' ); ?>
    </h1>
    
    <div class="post-meta">
      <?php
      /* Edit post link, if user is logged in */ ?>
      <?php if ( is_user_logged_in() ) : ?>
      <span class="edit-post">
        <?php edit_post_link( sprintf( __( 'Edit', 'hipoul' ), $post_type->labels->singular_name ), ' ', '' ); ?>
      </span>
      <?php endif; 

      /* Post author, not shown if this is a Page post or if admin decides to hide it */
      if ( $post_type->name != 'page' && $hipoul_settings['hide_post_author'] != true ) : ?>
        <span class="post-author author vcard">
        <?php
        /* Show the post author's gravatar */
        echo '<div class="post-avatar-wrap">' . get_avatar( get_the_author_meta( 'user_email' ), 45 ) . '</div>';

        $author_url = '<a href="' . get_author_posts_url( get_the_author_meta( 'ID' ) ) . '" class="url" rel="author">' . get_the_author_meta( 'display_name' ) . '</a>';
        printf( '<span class="fn nickname">' . $author_url . '</span>' );
        ?>
        </span>
      <?php endif;

      /* Post date is not shown if this is a Page post */ 
      if (hipoul_should_show_date())
        hipoul_post_date(get_permalink());

      /* Display comments number */
      if (hipoul_should_show_comments()): ?>
      <span class="comments-span">
        <i class="fa fa-lg fa-comments"></i>
        <a href="<?php echo the_permalink() ?>#comments"><?php echo get_comments_number(); ?> Comments</a>
      </span>
      <?php endif;

      do_action( 'hipoul_post_meta' ); ?>
    </div>
    
    <?php /* Post content */ ?>
    <div class="entry-content">
      <?php do_action( 'hipoul_before_post_content' ); ?>
      
      <?php /* The full content */ ?>
      <?php the_content(); ?>
      
      <?php wp_link_pages( array( 'before' => '<div class="link-pages"><p><strong>' . __( 'Pages:','hipoul' ) . '</strong> ', 'after' => '</p></div>', 'next_or_number' => 'number' ) ); ?>
      
      <?php do_action( 'hipoul_after_post_content' ); ?> 
    </div>
  </div>
</div>

<?php /* Get the comments template for single post pages */ ?>
<?php comments_template(); ?>

<?php do_action( 'hipoul_loop_footer' ); ?>