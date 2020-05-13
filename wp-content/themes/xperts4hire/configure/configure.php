<?php

	// MENUS

	function _custom_theme_register_menu()
	{
  		register_nav_menus(
    		array(
      			'menu-main' => __( 'Menu principal' ),
      			//'menu-footer' => __( 'Menu footer' ),
    		)
  		);
	}
	add_action( 'init', '_custom_theme_register_menu' );

	// IMAGES

	add_theme_support( 'post-thumbnails' );

	function _custom_theme_init_images_size()
	{
		//add_image_size( 'sidebar-image', 185, 185, true );
		//add_image_size( 'post-list-row', 767, 555, true );
		//add_image_size( 'post-list-col', 767, 946, true );
		//add_image_size( 'homepage-hero', 1024, 400, true );
	}
	add_action( 'init', '_custom_theme_init_images_size' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );


	// Move Yoast to bottom
	function yoasttobottom() {
		return 'low';
	}
	add_filter( 'wpseo_metabox_prio', 'yoasttobottom');


	// delete jquery migrate
	function dequeue_jquery_migrate( &$scripts){
		if(!is_admin()){
			$scripts->remove( 'jquery');
			$scripts->add( 'jquery', false, array( 'jquery-core' ), '1.12.4', true );
		}
	}
	add_filter( 'wp_default_scripts', 'dequeue_jquery_migrate' );

	// force all scripts to load in footer
	function clean_header() {
		remove_action('wp_head', 'wp_print_scripts');
		remove_action('wp_head', 'wp_print_head_scripts', 9);
		remove_action('wp_head', 'wp_enqueue_scripts', 1);
	}
	add_action('wp_enqueue_scripts', 'clean_header');

	// add SVG to allowed file uploads
	function add_file_types_to_uploads($file_types){

		$new_filetypes = array();
		$new_filetypes['svg'] = 'image/svg+xml';
		$file_types = array_merge($file_types, $new_filetypes );

		return $file_types;
	}
	add_action('upload_mimes', 'add_file_types_to_uploads');

	//Page Slug Body Class
	function add_slug_body_class( $classes ) {
	global $post;
	if ( isset( $post ) ) {
	$classes[] = $post->post_type . '-' . $post->post_name;
	}
	return $classes;
	}
	add_filter( 'body_class', 'add_slug_body_class' );

	function my_custom_sidebar() {
	    register_sidebar(
	        array (
	            'name' => __( 'Custom', 'your-theme-domain' ),
	            'id' => 'custom-side-bar',
	            'description' => __( 'Custom Sidebar', 'your-theme-domain' ),
	            'before_widget' => '<div class="widget-content">',
	            'after_widget' => "</div>",
	            'before_title' => '<h3 class="widget-title">',
	            'after_title' => '</h3>',
	        )
	    );
	}
	add_action( 'widgets_init', 'my_custom_sidebar' );



	// reduce excerpt length
	add_filter( 'excerpt_length', function($length) {
		return 20;
	} );

	// change ellipsis style in the excerpt
	function new_excerpt_more($more) {
		return '...';
	}
	add_filter('excerpt_more', 'new_excerpt_more');

	function is_subcategory (){
		$cat = get_query_var('cat');
		$category = get_category($cat);
		$category->parent;
		return ( $category->parent == '1' ) ? false : true;
	}

	function get_primary_cat($postId){
        $perma_cat = get_post_meta($postId , '_category_permalink', true);
        if ( $perma_cat != null ) {
          $cat_id = $perma_cat['category'];
          $category = get_category($cat_id);
        } else {
          $categories = get_the_category();
          $category = $categories[0];
        }
        $category_link = get_category_link($category);
		$category_name = $category->name; 
		$category_id = $category->term_id;  

        $cat_info = array('link' => $category_link, 'name' => $category_name, 'id' => $category_id);
        return $cat_info;
    }

    // Register the sidebar
	add_action('widgets_init', 'post_menu_register_sidebar');
	function post_menu_register_sidebar(){
		register_sidebar(
		    array(
		      	'id'            => 'category-sidebar',
				'name'          => __('Category Sidebar'),
				'description'   => __('This sidebar will be shown on category pages exclusively'),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h2 class="widget-title">',
				'after_title'   => '</h2>',
		    )
	  	);
	}

	// Register the Category Custom Menu
	add_action('widgets_init', 'post_menu_register_sidebar2');
	function post_menu_register_sidebar2(){
		register_sidebar(
		    array(
		      	'id'            => 'category-custom-menu',
				'name'          => __('Category Custom Menu'),
				'description'   => __('This sidebar will be shown on category pages exclusively'),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h2 class="widget-title">',
				'after_title'   => '</h2>',
		    )
	  	);
	}


	

	
