<?php 

class VAR_Content_Filter{

	function VAR_Content_Filter() {
		$this->__construct();
	}

	function __construct() {
		add_action('the_content', array(&$this , '_content_filter') ); 

	}
	
	function _content_filter($content) {

			return $content;

	}

}
