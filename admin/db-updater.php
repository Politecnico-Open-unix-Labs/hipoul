<?php 
/**
 * This script updates the theme's settings in the database to use the Settings API,
 * introduced in the theme since version 1.1.5
*/
function graphene_update_db(){
	global $hipoul_defaults;
        
	if ( get_option( 'graphene_ga_code' ) === '' ){       
		wp_die('updating to 1.0');
		graphene_update_db_to_1_0();
	}
	
	$current_settings = get_option( 'graphene_settings', array() );
	if ( empty( $current_settings['db_version'] ) || $current_settings['db_version'] === '1.0') {            
		graphene_update_db_to_1_1();
	}
        
        $current_settings = get_option( 'graphene_settings', array() );
	if ( empty( $current_settings['db_version'] ) || $current_settings['db_version'] === '1.1') {            
		graphene_update_db_to_1_2();
	}
}

function graphene_update_db_to_1_0(){
    global $hipoul_defaults;
        
	// Get the current options from the database
	$hipoul_settings['slider_cat'] = get_option('graphene_slider_cat');
	$hipoul_settings['slider_postcount'] = get_option('graphene_slider_postcount');
	$hipoul_settings['slider_img'] = (get_option('graphene_slider_img')) ? get_option('graphene_slider_img') : 'featured_image';
	$hipoul_settings['slider_imgurl'] = get_option('graphene_slider_imgurl');
	$hipoul_settings['slider_height'] = get_option('graphene_slider_height');
	$hipoul_settings['slider_speed'] = get_option('graphene_slider_speed');
	$hipoul_settings['slider_position'] = get_option('graphene_slider_position');
	$hipoul_settings['slider_disable'] = get_option('graphene_slider_disable');
	
	$hipoul_settings['frontpage_posts_cats'] = get_option('graphene_frontpage_posts_cats');
	
	$hipoul_settings['custom_feed_url'] = get_option('graphene_custom_feed_url');
	$hipoul_settings['hide_feed_icon'] = get_option('graphene_hide_feed_icon');
	
	$hipoul_settings['show_adsense'] = get_option('graphene_show_adsense');
	$hipoul_settings['adsense_code'] = get_option('graphene_adsense_code');
	$hipoul_settings['adsense_show_frontpage'] = get_option('graphene_adsense_show_frontpage');
	
	$hipoul_settings['show_addthis'] = get_option('graphene_show_addthis');
	$hipoul_settings['show_addthis_page'] = get_option('graphene_show_addthis_page');
	$hipoul_settings['addthis_code'] = get_option('graphene_addthis_code');
	
	$hipoul_settings['show_ga'] = get_option('graphene_show_ga');
	$hipoul_settings['ga_code'] = get_option('graphene_ga_code');
	
	$hipoul_settings['alt_home_sidebar'] = get_option('graphene_alt_home_sidebar');
	$hipoul_settings['alt_home_footerwidget'] = get_option('graphene_alt_home_footerwidget');
	
	$hipoul_settings['show_cc'] = get_option('graphene_show_cc');
	$hipoul_settings['copy_text'] = get_option('graphene_copy_text');
	$hipoul_settings['hide_copyright'] = get_option('graphene_hide_copyright');
	
	$hipoul_settings['light_header'] = get_option('graphene_light_header');
	$hipoul_settings['link_header_img'] = get_option('graphene_link_header_img');
	$hipoul_settings['featured_img_header'] = get_option('graphene_featured_img_header');
	$hipoul_settings['use_random_header_img'] = get_option('graphene_use_random_header_img');
	$hipoul_settings['hide_top_bar'] = get_option('graphene_hide_top_bar');
	$hipoul_settings['hide_feed_icon'] = get_option('graphene_hide_feed_icon');
	$hipoul_settings['search_box_location'] = get_option('graphene_search_box_location');
	
	if (get_option('graphene_hide_sidebar')) {
		$hipoul_settings['column_mode'] = 'one-col';
	} else {
		$hipoul_settings['column_mode'] = get_option('graphene_content_sidebar_position')  == 'left' ? 'two-col-right' : 'two-col-left';
	}
	
	$hipoul_settings['posts_show_excerpt'] = get_option('graphene_posts_show_excerpt');
	$hipoul_settings['hide_post_author'] = get_option('graphene_hide_post_author');
        
	if (get_option(graphene_hide_post_date)) { // hide the date
		$hipoul_settings['post_date_display'] = 'hidden';
	} elseif (get_option('graphene_show_post_year')) { // show the date and the year
		$hipoul_settings['post_date_display'] = 'icon_plus_year';
	} else { // show the date but not the year (default)
		$hipoul_settings['post_date_display'] = 'icon_no_year';
	}
	
	$hipoul_settings['hide_post_commentcount'] = get_option('graphene_hide_post_commentcount');
	$hipoul_settings['hide_post_cat'] = get_option('graphene_hide_post_cat');
	$hipoul_settings['hide_post_tags'] = get_option('graphene_hide_post_tags');
	$hipoul_settings['show_post_avatar'] = get_option('graphene_show_post_avatar');
	$hipoul_settings['show_post_author'] = get_option('graphene_show_post_author');
	$hipoul_settings['show_excerpt_more'] = get_option('graphene_show_excerpt_more');
	
	$hipoul_settings['footerwidget_column'] = get_option('graphene_footerwidget_column');
	$hipoul_settings['alt_footerwidget_column'] = get_option('graphene_alt_footerwidget_column');
	
	$hipoul_settings['navmenu_child_width'] = get_option('graphene_navmenu_child_width');
	
	$hipoul_settings['header_title_font_type'] = get_option('graphene_header_title_font_type');
	$hipoul_settings['header_title_font_size'] = get_option('graphene_header_title_font_size');
	$hipoul_settings['header_title_font_lineheight'] = get_option('graphene_header_title_font_lineheight');
	$hipoul_settings['header_title_font_weight'] = get_option('graphene_header_title_font_weight');
	$hipoul_settings['header_title_font_style'] = get_option('graphene_header_title_font_style');
	
	$hipoul_settings['header_desc_font_type'] = get_option('graphene_header_desc_font_type');
	$hipoul_settings['header_desc_font_size'] = get_option('graphene_header_desc_font_size');
	$hipoul_settings['header_desc_font_lineheight'] = get_option('graphene_header_desc_font_lineheight');
	$hipoul_settings['header_desc_font_weight'] = get_option('graphene_header_desc_font_weight');
	$hipoul_settings['header_desc_font_style'] = get_option('graphene_header_desc_font_style');
	
	$hipoul_settings['content_font_type'] = get_option('graphene_content_font_type');
	$hipoul_settings['content_font_size'] = get_option('graphene_content_font_size');
	$hipoul_settings['content_font_lineheight'] = get_option('graphene_content_font_lineheight');
	$hipoul_settings['content_font_colour'] = get_option('graphene_content_font_colour');
	
	$hipoul_settings['link_colour_normal'] = get_option('graphene_link_colour_normal');
	$hipoul_settings['link_colour_visited'] = get_option('graphene_link_colour_visited');
	$hipoul_settings['link_colour_hover'] = get_option('graphene_link_colour_hover');
	$hipoul_settings['link_decoration_normal'] = get_option('graphene_link_decoration_normal');
	$hipoul_settings['link_decoration_hover'] = get_option('graphene_link_decoration_hover');
	
	$hipoul_settings['hide_allowedtags'] = get_option('graphene_hide_allowedtags');
	$hipoul_settings['custom_css'] = get_option('graphene_custom_css');
	
	/* Merge current settings with the default settings */
	$hipoul_settings = array_merge($hipoul_defaults, $hipoul_settings);
	
	/* Update the database, and delete the old settings if update successful */
	if (update_option('graphene_settings', $hipoul_settings)) {
		
		delete_option('graphene_light_header');	
		delete_option('graphene_link_header_img');	
		delete_option('graphene_featured_img_header');
		delete_option('graphene_use_random_header_img');
		delete_option('graphene_hide_top_bar');
		delete_option('graphene_hide_feed_icon');
		delete_option('graphene_search_box_location');
		delete_option('graphene_content_sidebar_position');
		delete_option('graphene_hide_sidebar');
		delete_option('graphene_posts_show_excerpt');
		delete_option('graphene_hide_post_author');
		delete_option('graphene_hide_post_date');
		delete_option('graphene_show_post_year');
		delete_option('graphene_hide_post_commentcount');
		delete_option('graphene_hide_post_cat');
		delete_option('graphene_hide_post_tags');
		delete_option('graphene_show_post_avatar');
		delete_option('graphene_show_post_author');
		delete_option('graphene_show_excerpt_more');
		delete_option('graphene_header_title_font_type');
		delete_option('graphene_header_title_font_size');
		delete_option('graphene_header_title_font_lineheight');
		delete_option('graphene_header_title_font_weight');
		delete_option('graphene_header_title_font_style');
		delete_option('graphene_header_desc_font_type');
		delete_option('graphene_header_desc_font_size');
		delete_option('graphene_header_desc_font_lineheight');
		delete_option('graphene_header_desc_font_weight');
		delete_option('graphene_header_desc_font_style');
		delete_option('graphene_content_font_type');
		delete_option('graphene_content_font_size');
		delete_option('graphene_content_font_lineheight');
		delete_option('graphene_content_font_colour');
		delete_option('graphene_link_colour_normal');
		delete_option('graphene_link_colour_visited');
		delete_option('graphene_link_colour_hover');
		delete_option('graphene_link_decoration_normal');
		delete_option('graphene_link_decoration_hover');
		delete_option('graphene_footerwidget_column');
		delete_option('graphene_alt_footerwidget_column');
		delete_option('graphene_navmenu_child_width');
		delete_option('graphene_hide_allowedtags');
		delete_option('graphene_swap_title');
		delete_option('graphene_custom_css');
		delete_option('graphene_slider_cat');
		delete_option('graphene_slider_postcount');
		delete_option('graphene_slider_img');
		delete_option('graphene_slider_imgurl');
		delete_option('graphene_slider_height');
		delete_option('graphene_slider_speed');
		delete_option('graphene_slider_position');
		delete_option('graphene_slider_disable');
		delete_option('graphene_frontpage_posts_cats');
		delete_option('graphene_custom_feed_url');
		delete_option('graphene_hide_feed_icon');
		delete_option('graphene_show_adsense');
		delete_option('graphene_adsense_code');
		delete_option('graphene_adsense_show_frontpage');
		delete_option('graphene_show_addthis');
		delete_option('graphene_show_addthis_page');
		delete_option('graphene_addthis_code');
		delete_option('graphene_show_ga');
		delete_option('graphene_ga_code');
		delete_option('graphene_alt_home_sidebar');
		delete_option('graphene_alt_home_footerwidget');
		delete_option('graphene_show_cc');
		delete_option('graphene_copy_text');
		delete_option('graphene_hide_copyright');
                
                /* Delete DB Version from the database. This value is now included in the $hipoul_defaults array */
		delete_option( 'graphene_dbversion' );
		
		return true;
		
	} else {
		return false;
	}
}

function graphene_update_db_to_1_1(){
    global $hipoul_defaults;
        
    $hipoul_settings = get_option( 'graphene_settings', array() );
    $hipoul_settings['db_version'] = '1.1';
    $hipoul_settings['social_profiles'] = $hipoul_defaults['social_profiles'];
    
    if ( ! empty( $hipoul_settings['custom_feed_url'] ) ) {
		$hipoul_settings['social_profiles'][0]['url'] = $hipoul_settings['custom_feed_url'];;
        unset( $hipoul_settings['custom_feed_url'] );
    }
    
    // Remove the RSS profile if it is hidden
    if ( isset ( $hipoul_settings['hide_feed_icon'] ) ) {
        unset( $hipoul_settings['social_profiles'][0] );
        unset( $hipoul_settings['hide_feed_icon'] );
    }
    
    // Add the Twitter profile if the url is set
    if ( ! empty( $hipoul_settings['twitter_url'] ) ) {
        $hipoul_settings['social_profiles'][] = array (  
            'type' 	=> 'twitter',
			'name' => 'Twitter',
			'title'	=> sprintf( __( 'Follow %s on Twitter', 'graphene' ), get_bloginfo( 'name' ) ),
            'url' 	=> $hipoul_settings['twitter_url']
        );        
        unset( $hipoul_settings['twitter_url'] );
    }
    
    // Add the Facebook url if the url is set
    if ( !empty( $hipoul_settings['facebook_url'] ) ) {
        $hipoul_settings['social_profiles'][] = array (  
            'type' => 'facebook',
			'name'	=> 'Facebook',
            'title' => sprintf( __( "Visit %s's Facebook page", 'graphene' ), get_bloginfo( 'name' ) ),
            'url' => $hipoul_settings['facebook_url']
        );        
        unset( $hipoul_settings['facebook_url'] );
    }
	
	// Convert the custom social media to social media of "Custom" type
	$social_media = $hipoul_settings['social_media'];
	if ( ! empty( $social_media ) ){
		foreach ( $social_media as $slug => $social_medium ){
			$hipoul_settings['social_profiles'][] = array(
				'type'		=> 'custom',
				'name'		=> 'Custom',
				'title'		=> $social_medium['title'],
				'url'		=> $social_medium['url'],
				'icon_url' 	=> $social_medium['icon'],
			);
		}
	}
	
	// If there is no social media (including RSS), set the setting to false
	if ( empty( $hipoul_settings['social_profiles'] ) )
		$hipoul_settings['social_profiles'] = array( 0 => false );
    
    /* Merge current settings with the default settings */
    $hipoul_settings = array_merge($hipoul_defaults, $hipoul_settings);
	
	/* Only save options that have different values than the default values */
	foreach ( $hipoul_settings as $key => $value ){
		if ( ( $hipoul_defaults[$key] === $value || $value === '' ) && $key != 'db_version' ) {
			unset( $hipoul_settings[$key] );
		}
	}
	
    update_option('graphene_settings', $hipoul_settings);        
}

function graphene_update_db_to_1_2(){    
        
    $hipoul_settings = get_option( 'graphene_settings', array() );
    $hipoul_settings['db_version'] = '1.2';
    
    /* because the column modus have been renamed we need to update the DB! */
    if ( isset( $hipoul_settings['column_mode'] ) ) {
        $hipoul_settings['column_mode'] = str_replace( '-', '_', $hipoul_settings['column_mode'] );
    }     
    if ( isset( $hipoul_settings['bbp_column_mode'] ) ) {
        $hipoul_settings['bbp_column_mode'] = str_replace( '-', '_', $hipoul_settings['bbp_column_mode'] );
    } 
    
    if ( isset( $hipoul_settings['column_width'] ) && is_array( $hipoul_settings['column_width'] ) ) {
        $two_col = $hipoul_settings['column_width']['two-col'];
        $three_col = $hipoul_settings['column_width']['three-col'];
        $hipoul_settings['column_width'] = array(
            'two_col' => $two_col,
            'three_col' => $three_col 
        );
    }    
    
    update_option('graphene_settings', $hipoul_settings);        
}
?>