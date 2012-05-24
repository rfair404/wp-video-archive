<?php 

class VAR_Theme_Integration{

	function VAR_Theme_Integration() {
		$this->__construct();
	}

	function __construct() {
		add_action('genesis_before_post_title', array(&$this , '_player_above_title') ); 
		/** Remove the post meta function */
		//remove_action( 'genesis_after_post_content', 'genesis_post_meta' );
		add_filter( 'genesis_post_info', array(&$this, '_post_info_filter' ) );
		add_filter( 'genesis_post_meta', array(&$this, '_post_meta_filter' ) );
		//add_action('genesis_post_meta', array(&$this, '_video_post_meta') );
	}
	
	function _player_above_title($content) {
		global $post;
		global $video_meta;
		$videourl = $video_meta->get_the_value('url');
		echo '<div class="fitvideo">' . apply_filters('the_content', $videourl) . '</div>';
	}
	/** Customize the post info function */
	function _post_info_filter($post_info) {
		if ( is_archive() && get_post_type() == VAR_POST_TYPE || is_singular(VAR_POST_TYPE)  ) {
			return $post_info . '<span class="attribution">[videometaurl key="producer-link" label="Produced By: "][videometa key="producer" label=""][/videometaurl]</span>'; 
		}
		elseif (!is_page()) {
	    		return $post_info;
		}
	}

	/** Customize the post meta function */
	function _post_meta_filter($post_meta) {
		if ( is_archive() && get_post_type() == VAR_POST_TYPE || is_singular(VAR_POST_TYPE) ) {
			return '[videotaxony tax="genere" lable="Generes: "][videotaxony tax="subject" lable="Subjects: "]'; 
		}
		elseif (!is_page()) {
	    		return $post_meta;
		}
	}
}
