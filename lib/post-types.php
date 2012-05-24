<?php

class VAR_Post_Types {

	function VAR_Post_Types()
	{
            $this->__construct();
	} // end VAR_Post_Types
	
	function __construct()
	{
            add_action( 'init', array( &$this, '_register_post_type' ) );
	} // end __construct
	
	function _register_post_type()
	{	
            /*set up our Video Post Type*/
            register_post_type(VAR_POST_TYPE,array( 
                'labels'    => $this::_post_type_labels(ucfirst(VAR_POST_TYPE), ucfirst(VAR_POST_TYPE . 's') ) ,
                'description' => __( ucfirst(VAR_POST_TYPE) ), /* Custom Type Description */
                    'public' => true,
                    'publicly_queryable' => true,
                    'exclude_from_search' => false,
                    'show_ui' => true,
                    'query_var' => true,
                    'menu_position' => 4, /* this is what order you want it to appear in on the left hand side menu */ 
                    'menu_icon' => VAR_IMG_URL . VAR_POST_TYPE .'-icon.png', /* the icon for the custom post type menu */
                    'rewrite' => array('slug' => VAR_POST_TYPE, 'with_front' => false ),
                    'capability_type' => 'post',
                    'hierarchical' => false,
                    'has_archive' => true,
                    /* the next one is important, it tells what's enabled in the post editor */
                    'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'custom-fields', 'comments', 'revisions', 'sticky')
                )
            );	
	} 
    public static function _post_type_labels($singular,$plural=false,$args=array()) {
    if ($plural===false)            $plural = $singular . 's'; 
    elseif ($plural===true)         $plural = $singular;
    $defaults = array(
        'name'              =>_x($plural,'post type general name'),
        'singular_name'         =>_x($singular,'post type singular name'), 
        'add_new'           =>_x('Add New',$singular),
        'add_new_item'          =>__("Add New $singular"),
        'edit_item'         =>__("Edit $singular"),
        'new_item'          =>__("New $singular"),
        'view_item'         =>__("View $singular"), 
        'search_items'          =>__("Search $plural"),
        'not_found'         =>__("No $plural Found"),
        'not_found_in_trash'        =>__("No $plural Found in Trash"),
        'parent_item_colon'         =>'',
    ); 
    return wp_parse_args($args,$defaults);

    } // end make_post_type_lables
		
} // end VAR_Post_Types



