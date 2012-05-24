<?php

class VAR_Styles{
	function VAR_Styles() {
		$this->__contsruct();
	}

	function __construct() {
		add_action('init' , array(&$this, '_register_css'));
		add_action('wp_print_styles' , array(&$this, '_enqueue_css'));
	}

	function _register_css() {
		wp_register_style('videoarchive', VAR_CSS_URL . '/videoarchive.css', array(), VAR_VER, 'all');
	}

	function _enqueue_css() {
		wp_enqueue_style('videoarchive');
	}
}