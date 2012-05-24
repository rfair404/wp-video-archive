<?php

class VAR_Plugin_Activate {

	function VAR_Plugin_Activate()
	{
		$this->__construct();
	} // end VAR_Plugin_Activate
	
	function __construct()
	{
	//activation hook
        register_activation_hook( __FILE__, array ( &$this, '_activate' ) );

        //deactivation hook
        register_deactivation_hook( __FILE__, array( &$this, '_deactivate') );

	} // end __construct
	

    function _activate() {
        flush_rewrite_rules(); 
    }

    function _deactivate() {
        flush_rewrite_rules();
    }
		
} // end VAR_Plugin_Activate

