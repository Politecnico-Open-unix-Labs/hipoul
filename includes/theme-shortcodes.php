<?php
/**
 * Shortcode handlers
 */
function warning_block_shortcode_handler( $atts, $content=null, $code="" ) {
  return '<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <strong>Warning!</strong> '.hipoul_first_p( do_shortcode( $content ) ).'</div>';
}
add_shortcode( 'warning', 'warning_block_shortcode_handler' );

function error_block_shortcode_handler( $atts, $content=null, $code="" ) {
  return '<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <strong>Error!</strong> '. hipoul_first_p( do_shortcode( $content ) ) . '</div>';
}
add_shortcode( 'error', 'error_block_shortcode_handler' );

function notice_block_shortcode_handler( $atts, $content=null, $code="" ) {
  return '<div class="alert alert-warning"><i class="fa fa-exclamation-triangle"></i> <strong>Notice</strong> '. hipoul_first_p( do_shortcode( $content ) ) . '</div>';
}
add_shortcode( 'notice', 'notice_block_shortcode_handler' );

function important_block_shortcode_handler( $atts, $content=null, $code="" ) {
  return '<div class="alert alert-success"><i class="fa fa-bell"></i> <strong>Important!</strong> '. hipoul_first_p( do_shortcode( $content ) ) . '</div>';
}
add_shortcode( 'important', 'important_block_shortcode_handler' );


/**
 * Hook the shortcode buttons to the TinyMCE editor
*/
class Hipoul_Shortcodes_Buttons{
  
  function Hipoul_Shortcodes_Buttons(){
    if ( current_user_can( 'edit_posts' ) &&  current_user_can( 'edit_pages' ) ) {
      add_filter( 'mce_external_plugins', array(&$this, 'hipoul_add_plugin' ) );  
      add_filter( 'mce_buttons_2', array(&$this, 'hipoul_register_button' ) );  
     }
  }
  
  function hipoul_register_button( $buttons){
    array_push( $buttons, "separator", "warning", "error", "notice", "important");
    return $buttons;
  }
  
  function hipoul_add_plugin( $plugin_array){
    $plugin_array['hipoulshortcodes'] = get_template_directory_uri().'/js/mce-shortcodes.js';
    return $plugin_array; 
  }
}
add_action( 'init', 'Hipoul_Shortcodes_Buttons' );

function Hipoul_Shortcodes_Buttons(){
  global $Hipoul_Shortcodes_Buttons;
  $Hipoul_Shortcodes_Buttons = new Hipoul_Shortcodes_Buttons();
}
?>