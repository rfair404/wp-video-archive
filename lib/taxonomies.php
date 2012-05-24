<?php

class VAR_Taxonomies {

	function VAR_Taxonomies()
	{
		$this->__construct();
	} // end VAR_Taxonomies
	
	function __construct()
	{
		add_action( 'init', array( &$this, '_init' ) );
	} // end __construct
	
	function _init()
	{	
            register_taxonomy( 'subject', VAR_POST_TYPE, /* if you change the name of register_post_type( 'custom_type', then you have to change this */
	    	array('hierarchical' => false,    /* if this is false, it acts like tags */                
	    		'labels' => array(
	    			'name' => __( 'Subjects' ), /* name of the custom taxonomy */
	    			'singular_name' => __( 'Subject' ), /* single taxonomy name */
	    			'search_items' =>  __( 'Search Subjects' ), /* search title for taxomony */
	    			'all_items' => __( 'All Subjects' ), /* all title for taxonomies */
	    			'parent_item' => __( 'Parent Subject' ), /* parent title for taxonomy */
	    			'parent_item_colon' => __( 'Parent Subject:' ), /* parent taxonomy title */
	    			'edit_item' => __( 'Edit Subject' ), /* edit custom taxonomy title */
	    			'update_item' => __( 'Update Subject' ), /* update title for taxonomy */
	    			'add_new_item' => __( 'Add New Subject' ), /* add new title for taxonomy */
	    			'new_item_name' => __( 'New Subject' ) /* name title for taxonomy */
	    		),
	    		'show_ui' => true,
	    		'query_var' => true,
	    		'rewrite' => array(
	    			'slug' => 'subject',
	    			'with_front' => false
	    		)
	    	)
	    );
            
            register_taxonomy( 'genere', VAR_POST_TYPE, /* if you change the name of register_post_type( 'custom_type', then you have to change this */
	    	array('hierarchical' => true,    /* if this is false, it acts like tags */                
	    		'labels' => array(
	    			'name' => __( 'Generes' ), /* name of the custom taxonomy */
	    			'singular_name' => __( 'Genere' ), /* single taxonomy name */
	    			'search_items' =>  __( 'Search Generes' ), /* search title for taxomony */
	    			'all_items' => __( 'All Generes' ), /* all title for taxonomies */
	    			'parent_item' => __( 'Parent Genere' ), /* parent title for taxonomy */
	    			'parent_item_colon' => __( 'Parent Genere:' ), /* parent taxonomy title */
	    			'edit_item' => __( 'Edit Genere' ), /* edit custom taxonomy title */
	    			'update_item' => __( 'Update Genere' ), /* update title for taxonomy */
	    			'add_new_item' => __( 'Add New Genere' ), /* add new title for taxonomy */
	    			'new_item_name' => __( 'New Genere' ) /* name title for taxonomy */
	    		),
	    		'show_ui' => true,
	    		'query_var' => true,
	    		'rewrite' => array(
	    			'slug' => 'genere',
	    			'with_front' => false
	    		)
	    	)
	    );
		
	} // end VAR_init


		
} // end VAR_Taxonomies

