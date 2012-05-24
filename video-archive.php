<?php

/*
* Plugin Name: Video Archive
* Author: Russell Fair
* Version: 0.1.0
*/

	/*set up our constants*/
	define('VAR_VER', '010');
	define('VAR_TRANS_VER', '010');
	define('VAR_DIR', WP_PLUGIN_DIR.'/'.str_replace(basename( __FILE__),"",plugin_basename(__FILE__)));
	define('VAR_URL', WP_PLUGIN_URL.'/'.str_replace(basename( __FILE__),"",plugin_basename(__FILE__)));
	define('VAR_LIB_DIR', VAR_DIR.'lib');
	define('VAR_JS_URL', VAR_URL.'lib/js');
	define('VAR_CSS_URL', VAR_URL.'lib/css');
	define('VAR_IMG_URL', VAR_URL.'lib/img');
	define('VAR_POST_TYPE', 'video');

	require_once (VAR_LIB_DIR . '/activate-deactivate.php');/*get our activation and deactivation hooks first*/ 
	$activation = new VAR_Plugin_Activate();

	// translation support
	load_plugin_textdomain( 'videoarchive', false, VAR_LIB_DIR . '/languages/' );

	/*import the class files and fire each class*/
	require_once (VAR_LIB_DIR . '/post-types.php');/*get our custom post types*/ 
	$post_types = new VAR_Post_Types();

	require_once (VAR_LIB_DIR . '/taxonomies.php');/*get our custom taxonomies*/ 
	$taxonomies = new VAR_Taxonomies();

	/*gets the WPAlchemy class and registers new meta box for video*/
	if(!class_exists('WPAlchemy_MetaBox'))
		require_once(VAR_LIB_DIR . '/ext/MetaBox.php');
	$video_meta = new WPAlchemy_MetaBox(array(
	    		'id' => VAR_POST_TYPE . '_custom_meta',
	    		'title' => ucwords(VAR_POST_TYPE) . ' Meta Information',
	    		'template' => VAR_LIB_DIR . '/metaboxes/videoinfo.php', 
				'types' => array(VAR_POST_TYPE),
				'context' => 'advanced',
				'priority' => 'high',
				'lock' => WPALCHEMY_LOCK_TOP,
				'view' => WPALCHEMY_VIEW_START_OPENED
		));

	require_once (VAR_LIB_DIR . '/metaboxes.php');/*get our custom metaboxes*/ 
	$metaboxes = new VAR_Metaboxes_Css();

	require_once (VAR_LIB_DIR . '/shortcodes.php');/*get our custom shortcodes*/ 
	$shorcodes = new VAR_Shortcodes();

	require_once (VAR_LIB_DIR . '/styles.php');/*get our custom shortcodes*/ 
	//$styles = new VAR_Styles();

	require_once (VAR_LIB_DIR . '/content-filter.php');/*get our custom content filter 9perhaps more useful later?*/ 
	$content_filter = new VAR_Content_Filter();

	require_once (VAR_LIB_DIR . '/widgets.php');/*get our widget*/ 
	add_action('widgets_init', create_function('', "register_widget('VAR_Video_Archive');"));

	require_once (VAR_LIB_DIR . '/search.php');/*get our custom search and rss feed stuff*/ 
	$search = new VAR_Search();

	require_once (VAR_LIB_DIR . '/theme-integration.php');/*get our (genesis) theme support*/ 
	$theme_integration = new VAR_Theme_Integration();

	//enjoy this plugin more with the FitVids, FitText and Lettering JS (3-in1) plugin and a responsive theme. 		
