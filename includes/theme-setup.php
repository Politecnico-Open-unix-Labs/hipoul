<?php
/**
 * Run the database updater if necessary
*/
if ( ! function_exists( 'graphene_db_init' ) ) :
	function graphene_db_init(){
		global $hipoul_settings, $hipoul_defaults;
		
		/* Run DB updater if needed */
                include( get_template_directory() . '/admin/db-updater.php' );
                graphene_update_db();
                $hipoul_settings = array_merge( $hipoul_defaults, get_option( 'graphene_settings', array() ) );        
	}
endif;
add_action( 'init', 'graphene_db_init' );


if ( ! function_exists( 'graphene_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 */
function graphene_setup() {
	global $hipoul_settings, $hipoul_defaults;
	
	// Add support for editor syling
	if ( ! $hipoul_settings['disable_editor_style'] ){
		global $content_width;
		add_editor_style();
		add_editor_style( 'admin/editor.css.php?content_width=' . $content_width );
	}
	
	// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );
	
	// Add support for post thumbnail / featured image
	add_theme_support( 'post-thumbnails' );
	
	// Add supported post formats
	add_theme_support( 'post-formats', array( 'status', 'link', 'audio', 'image', 'video' ) );

	// Make theme available for translation
	load_theme_textdomain( 'graphene', get_template_directory() . '/languages' );
	
	// Register the custom menu location
	register_nav_menu('header-menu',__( 'Header Menu' ));

	// Register default custom headers packaged with the theme. %s is a placeholder for the theme template directory URI.
	register_default_headers( graphene_get_default_headers() );
        
    do_action( 'graphene_setup' );
}
endif;
add_action( 'after_setup_theme', 'graphene_setup' );


if ( ! function_exists( 'graphene_get_default_headers' ) ) {
	function graphene_get_default_headers() {
		$headers = array( 
			'Schematic' => array( 'url' => '%s/images/headers/schematic.jpg',
				'thumbnail_url' => '%s/images/headers/schematic-thumb.jpg',
				'description' => __( 'Header image by Syahir Hakim', 'graphene' ) ),
			
			'Flow' => array( 'url' => '%s/images/headers/flow.jpg',
				'thumbnail_url' => '%s/images/headers/flow-thumb.jpg',
				'description' => __( 'This is the default Graphene theme header image, cropped from image by Quantin Houyoux at sxc.hu', 'graphene' ) ),
			
			'Fluid' => array( 'url' => '%s/images/headers/fluid.jpg',
				'thumbnail_url' => '%s/images/headers/fluid-thumb.jpg',
				'description' => __( 'Header image cropped from image by Ilco at sxc.hu', 'graphene' ) ),
			
			'Techno' => array( 'url' => '%s/images/headers/techno.jpg',
				'thumbnail_url' => '%s/images/headers/techno-thumb.jpg',
				'description' => __( 'Header image cropped from image by Ilco at sxc.hu', 'graphene' ) ),
			
			'Fireworks' => array( 'url' => '%s/images/headers/fireworks.jpg',
				'thumbnail_url' => '%s/images/headers/fireworks-thumb.jpg',
				'description' => __( 'Header image cropped from image by Ilco at sxc.hu', 'graphene' ) ),
			
			'Nebula' => array( 'url' => '%s/images/headers/nebula.jpg',
				'thumbnail_url' => '%s/images/headers/nebula-thumb.jpg',
				'description' => __( 'Header image cropped from image by Ilco at sxc.hu', 'graphene' ) ),
			
			'Sparkle' => array( 'url' => '%s/images/headers/sparkle.jpg',
				'thumbnail_url' => '%s/images/headers/sparkle-thumb.jpg',
				'description' => __( 'Header image cropped from image by Ilco at sxc.hu', 'graphene' ) ),
		);
		
		return apply_filters( 'graphene_default_header_images', $headers );
	}
}


if ( ! function_exists( 'graphene_admin_header_style' ) ) :
/**
 * Styles the header image displayed on the Appearance > Header admin panel.
*/
function graphene_admin_header_style(){ 
	global $hipoul_settings;
	?>
	<style type="text/css">
	.appearance_page_custom-header #headimg {
		min-height: 0;
	}
    #headimg h1 {
		position: relative;
		top: 110px;
		text-decoration: none;
    }
	#headimg h1 a {
		text-decoration: none;
	}
    #headimg #desc {
        color: #000;
        border-bottom: none;
        position: relative;
        top: 110px;
    }
	#headimg {
		background-position: center top;
		background-repeat: no-repeat;
	}
    </style>
    
	<?php
	do_action( 'graphene_admin_header_style' );
}
endif;


/**
 * Register widgetized areas
 *
 * To override graphene_widgets_init() in a child theme, remove the action hook and add your own
 * function tied to the init hook.
 *
 * @since Graphene 1.0
 * @uses register_sidebar
 */
function graphene_widgets_init() {
	if (function_exists( 'register_sidebar' ) ) {
		global $hipoul_settings;
		
		register_sidebar(array( 'name' => __( 'Sidebar Widget Area', 'graphene' ),
			'id' => 'sidebar-widget-area',
			'description' => __( 'The first sidebar widget area (will always be displayed on the right hand side).', 'graphene' ),
			'before_widget' => '<div id="%1$s" class="sidebar-wrap clearfix %2$s">',
			'after_widget' => '</div>',
			'before_title' => "<h3>",
			'after_title' => "</h3>",
		) );
                
		register_sidebar(array( 'name' => __( 'Sidebar Two Widget Area', 'graphene' ),
			'id' => 'sidebar-two-widget-area',
			'description' => __( 'The second sidebar widget area (will always be displayed on the left hand side).', 'graphene' ),
			'before_widget' => '<div id="%1$s" class="sidebar-wrap clearfix %2$s">',
			'after_widget' => '</div>',
			'before_title' => "<h3>",
			'after_title' => "</h3>",
		) );
		
		register_sidebar(array( 'name' => __( 'Footer Widget Area', 'graphene' ),
			'id' => 'footer-widget-area',
			'description' => __( "The footer widget area. Leave empty to disable. Set the number of columns to display at the theme's Display Options page.", 'graphene' ),
			'before_widget' => '<div id="%1$s" class="sidebar-wrap clearfix %2$s">',
			'after_widget' => '</div>',
			'before_title' => "<h3>",
			'after_title' => "</h3>",
		) );
		
		/**
		 * Register alternate widget areas to be displayed on the front page, if enabled
		 *
		 * @package Graphene
		 * @subpackage Graphene
		 * @since Graphene 1.0.8
		*/
		if ( $hipoul_settings['alt_home_sidebar']) {
			register_sidebar(array( 'name' => __( 'Front Page Sidebar Widget Area', 'graphene' ),
				'id' => 'home-sidebar-widget-area',
				'description' => __( 'The first sidebar widget area that will only be displayed on the front page.', 'graphene' ),
				'before_widget' => '<div id="%1$s" class="sidebar-wrap clearfix %2$s">',
				'after_widget' => '</div>',
				'before_title' => "<h3>",
				'after_title' => "</h3>",
			) );
			
			register_sidebar(array( 'name' => __( 'Front Page Sidebar Two Widget Area', 'graphene' ),
				'id' => 'home-sidebar-two-widget-area',
				'description' => __( 'The second sidebar widget area that will only be displayed on the front page.', 'graphene' ),
				'before_widget' => '<div id="%1$s" class="sidebar-wrap clearfix %2$s">',
				'after_widget' => '</div>',
				'before_title' => "<h3>",
				'after_title' => "</h3>",
			) );
		}
		
		if ( $hipoul_settings['alt_home_footerwidget']) {
			register_sidebar(array( 'name' => __( 'Front Page Footer Widget Area', 'graphene' ),
				'id' => 'home-footer-widget-area',
				'description' => __( "The footer widget area that will only be displayed on the front page. Leave empty to disable. Set the number of columns to display at the theme's Display Options page.", 'graphene' ),
				'before_widget' => '<div id="%1$s" class="sidebar-wrap clearfix %2$s">',
				'after_widget' => '</div>',
				'before_title' => "<h3>",
				'after_title' => "</h3>",
			) );
		}
		
		/* Header widget area */
		if ( $hipoul_settings['enable_header_widget']) :
			register_sidebar(array( 'name' => __( 'Header Widget Area', 'graphene' ),
				'id' => 'header-widget-area',
				'description' => __("The header widget area.", 'graphene' ),
				'before_widget' => '<div id="%1$s" class="sidebar-wrap clearfix %2$s">',
				'after_widget' => '</div>',
				'before_title' => "<h3>",
				'after_title' => "</h3>",
			) );
		endif;
                
		/* Action hooks widget areas */
		if ( count( $hipoul_settings['widget_hooks'] ) > 0 ) {
			$available_hooks = graphene_get_action_hooks( true );
			
			foreach ($hipoul_settings['widget_hooks'] as $hook) {
				if (in_array($hook, $available_hooks)) {
					register_sidebar(array(
						'name' => ucwords( str_replace('_', ' ', $hook) ),
						'id' => $hook,
						'description' => sprintf( __("Dynamically added widget area. This widget area is attached to the %s action hook.", 'graphene'), "'$hook'" ),
						'before_widget' => '<div id="%1$s" class="sidebar-wrap clearfix %2$s">',
						'after_widget' => '</div>',
						'before_title' => "<h3>",
						'after_title' => "</h3>",
					));
					// to display the widget dynamically attach the dynamic method
					add_action( $hook, 'graphene_display_dynamic_widget_hooks' );
				}
				
			}                    
		}
	}
	
	do_action( 'graphene_widgets_init' );
}
add_action( 'widgets_init', 'graphene_widgets_init' );


/**
 * Display a dynamic widget area, this is hooked to the user selected do_action() hooks available in Graphene.
 * @global array $hipoul_settings 
 */
function graphene_display_dynamic_widget_hooks(){
    global $hipoul_settings;
	
    // to find the current action
    $actionhook_id = current_filter();
    if ( in_array( $actionhook_id, $hipoul_settings['widget_hooks'])  && is_active_sidebar( $actionhook_id ) ) : ?>
    <div class="graphene-dynamic-widget" id="graphene-dynamic-widget-<?php echo $actionhook_id; ?>">
        <?php dynamic_sidebar( $actionhook_id ); ?>
    </div>
    <?php endif;
}

?>