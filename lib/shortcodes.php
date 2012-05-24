<?php

class VAR_Shortcodes {

	function VAR_Shortcodes()
	{
		$this->__construct();
	} // end VAR_Shortcodes
	
	function __construct()
	{
		add_action( 'init', array( &$this, '_init' ) );
	} // end __construct
	
	function _init()
	{	
		add_shortcode( 'va_video' , array(&$this, '_the_video'));
		add_shortcode( 'va_videometa', array(&$this, '_the_video_meta' ));	
		add_shortcode( 'va_videometaurl', array(&$this, '_the_video_meta_url' ));	
		add_shortcode( 'va_videotaxony', array(&$this, '_the_video_taxonomies' ));	
	} // end VAR_init
	
	function _the_video($atts) {
		//global $post;
		global $video_meta;
		extract( shortcode_atts( array(
			'id' => ''
		), $atts ) );

		$meta = get_post_meta($id, VAR_POST_TYPE . '_custom_meta', TRUE);

		$videourl = $meta;

		$videourl = (!empty($videourl['url'])) ? $videourl['url'] : false;
		if (empty($videourl)) : return;
		else : 
			$markup = apply_filters('the_content' , $videourl );
			//$markup = wp_oembed_get( $videourl );
			return $markup;
		endif;
	}
	
	function _the_video_meta($atts) {
		global $post;
		global $video_meta;
		
		extract( shortcode_atts( array(
			'id' => $post->ID, 
			'key' => '', 
			'label' => ''
			
		), $atts ) );

			$data = $video_meta->get_the_value($key);
			if (!empty($data)) return $label . $data;

	}

	function _the_video_meta_url($atts, $content = null) {
		global $post;
		global $video_meta;
		
		extract( shortcode_atts( array(
			'id' => $post->ID, 
			'key' => '', 
			'label' => ''
			
		), $atts ) );

			$url = $video_meta->get_the_value($key);
			if (!empty($url)) return $label . '<a href="' . $url . '">' . do_shortcode( $content ) . '</a>';



		
	
	}

	function _the_video_taxonomies($atts) {

		global $post;
		global $video_meta;
		$tax = $atts['tax'];

		extract( shortcode_atts( array(
			'id' => $post->ID,
			'tax' => $tax,
			'lable' => ''
		), $atts ) );
		if (0 < count($tax) ) {
			$markup = '<ul class="taxonomyinfo '. $tax . '">';
				$markup .= '<li class="taxonomylink ' . $tax . '">' . $lable;		
				$tag_s = wp_get_post_terms($id, $tax);
				if (0 < count($tag_s) ) {
					foreach ($tag_s as $tag) {
						$markup .= '<a href="' . get_term_link($tag->slug, $tax) . '">' . $tag->name . ' </a>';
					}
				}
				$markup .= '</li>';
			$markup .= '</ul><!--close taxonomy list-->';
		}

		return $markup;
	}


} // end VAR_Shortcodes

new VAR_Shortcodes();
