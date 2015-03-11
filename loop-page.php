<?php 
global $hipoul_settings; 
$post_type = get_post_type_object( get_post_type() );
?>

<?php if ( $hipoul_settings['hide_parent_content_if_empty'] && $post->post_content == '' ) : ?>

<h1 class="page-title">
  <?php if ( get_the_title() == '' ) { _e( '(No title)', 'hipoul' ); } else { the_title(); } ?>
</h1>

<?php else : ?>

<style type="text/css">

.post-meta{
  display: none;
}

.entry-content{
  border-bottom: 0px;
}

</style>
<div id="post-<?php the_ID(); ?>" <?php post_class( 'post' ); ?>>
  
  <?php do_action( 'hipoul_before_post' ); ?>
  
  <div class="entry">
    <?php /* Post title */ ?>
    <h1 class="post-title entry-title">
    <?php if ( get_the_title() == '' ) { _e( '(No title)', 'hipoul' ); } else { the_title(); } ?>
    <?php do_action( 'hipoul_page_title' ); ?>
    </h1>
    
    <?php /* Post meta */ ?>
    <div class="post-meta">
      
      <?php /* Edit post link, if user is logged in */ ?>
      <?php if ( is_user_logged_in() ) : ?>
      <p class="edit-post">
        <?php edit_post_link( sprintf( __( 'Edit %s', 'hipoul' ), $post_type->labels->singular_name ), ' (', ')' ); ?>
      </p>
      <?php endif; ?>
      <span class="updated">
        <span class="value-title" title="<?php the_time( 'Y-m-d\TH:i' ); ?>" />
      </span>
                            
      <?php do_action( 'hipoul_page_meta' ); ?>
    </div>
    
    <?php /* Post content */ ?>
    <div class="entry-content">
      <?php do_action( 'hipoul_before_page_content' ); ?>
        <?php /* The full content */ ?>
        <?php the_content(); ?>
      
      <?php wp_link_pages( array( 'before' => '<div class="link-pages"><p><strong>' . __( 'Pages:','hipoul' ) . '</strong> ', 'after' => '</p></div>', 'next_or_number' => 'number' ) ); ?>
      
      <?php do_action( 'hipoul_after_page_content' ); ?>
      
    </div>
    
  </div>
</div>
<?php endif; ?>

<?php /* List the child pages */ ?>
<?php get_template_part( 'loop', 'children' ); ?>

<?php /* Get the comments template */ ?>
<?php comments_template(); ?>

<?php do_action( 'hipoul_loop_footer' ); ?>