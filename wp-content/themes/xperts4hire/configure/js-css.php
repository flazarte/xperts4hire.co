<?php
	function _add_javascripts()
	{
		
		wp_enqueue_script('3.4.1-min-js', get_template_directory_uri() . '/js/jquery-3.4.1.min.js', array(), null, true );
		wp_enqueue_script('3.1.0-min-js', get_template_directory_uri() . '/js/jquery-migrate-3.1.0.min.js', array(), null, true );
		wp_enqueue_script('mmenu-js', get_template_directory_uri() . '/js/mmenu.min.js', array(), null, true );
		wp_enqueue_script('tippy-js', get_template_directory_uri() . '/js/tippy.all.min.js', array(), null, true );
		wp_enqueue_script('simple-js', get_template_directory_uri() . '/js/simplebar.min.js', array(), null, true );
		wp_enqueue_script('slider-js', get_template_directory_uri() . '/js/bootstrap-slider.min.js', array(), null, true );
		wp_enqueue_script('select-js', get_template_directory_uri() . '/js/bootstrap-select.min.js', array(), null, true );
		wp_enqueue_script('snackbar-js', get_template_directory_uri() . '/js/snackbar.js', array(), null, true );
		wp_enqueue_script('clipboard-js', get_template_directory_uri() . '/js/clipboard.min.js', array(), null, true );
		wp_enqueue_script('counterup-js', get_template_directory_uri() . '/js/counterup.min.js', array(), null, true );
		wp_enqueue_script('magnific-popup-js', get_template_directory_uri() . '/js/magnific-popup.min.js', array(), null, true );
		wp_enqueue_script('slick-js', get_template_directory_uri() . '/js/slick.min.js', array(), null, true );
		wp_enqueue_script('custom-script-js', get_template_directory_uri() .'/js/custom.js', array(), null, true );
		wp_enqueue_script('chart-min-js', get_template_directory_uri() . '/js/chart.min.js', array(), null, true );
	}
	add_action('wp_enqueue_scripts', '_add_javascripts', 100);

	function _add_stylesheets()
	{	
		wp_enqueue_style('style-css', get_template_directory_uri() . '/css/style.css', array(), null, 'all' );
		wp_enqueue_style('blue-css', get_template_directory_uri() . '/css/colors/blue.css', array(), null, 'all' );
		wp_enqueue_style('custom-style-css', get_template_directory_uri() . '/style.css', array(), null, 'all' );
	}
	add_action('wp_enqueue_scripts', '_add_stylesheets');
	