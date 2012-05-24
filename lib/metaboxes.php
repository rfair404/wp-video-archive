<?php 

class VAR_Metaboxes_Css {

    	function VAR_Metaboxes_Css() {
        	$this->__construct();
    	}// end VAR_Metaboxes

	function __construct() {
		add_action('init', array(&$this, '_metabox_styles') );
	}
 
	function _metabox_styles()
	{
    		if ( is_admin() )
    		{
        		wp_enqueue_style( 'wpalchemy-metabox', VAR_CSS_URL . '/metaboxes.css' );
    		}
	}

}
