<?php

class VAR_Search {

	function VAR_Search()
	{
		$this->__construct();
	} // end VAR_Taxonomies
	
	function __construct()
	{
		add_filter('request', array(&$this, '_feed_request'));

	} // end __construct

	function _feed_request($qv) {
		if (isset($qv['feed']) && !isset($qv['post_type']))
			$qv['post_type'] = array('post', VAR_POST_TYPE	);
		return $qv;
	}
}
