<?php

	// Utilities

	include( 'configure/utilities.php' );

	// CONFIG

	include( 'configure/configure.php' );

	// JAVASCRIPT & CSS

	include( 'configure/js-css.php' );

	// SHORTCODES

	include( 'configure/shortcodes.php' );

	// ACF

	include( 'configure/acf.php' );

	// BLOG

	include( 'configure/blog-func.php' );

	// HOOKS ADMIN

	if( is_admin() )
	{
		include( 'configure/admin.php' );
	}


// function shapeSpace_popular_posts($post_id) {
//     $count_key = 'popular_posts';
//     $count = get_post_meta($post_id, $count_key, true);
//     if ($count == '') {
//         $count = 0;
//         delete_post_meta($post_id, $count_key);
//         add_post_meta($post_id, $count_key, '0');
//     } else {
//         $count++;
//         update_post_meta($post_id, $count_key, $count);
//     }
// }
// function shapeSpace_track_posts($post_id) {
//     if (!is_single()) return;
//     if (empty($post_id)) {
//         global $post;
//         $post_id = $post->ID;
//     }
//     shapeSpace_popular_posts($post_id);
// }
// add_action('wp_head', 'shapeSpace_track_posts');

// function change_wp_search_size($query) {
//     if ( $query->is_search )
//         $query->query_vars['posts_per_page'] = -1;

//     return $query;
// }

// add_filter('pre_get_posts', 'change_wp_search_size');

// @ini_set( 'upload_max_size' , '64M' );
// @ini_set( 'post_max_size', '64M');
// @ini_set( 'max_execution_time', '300' );

//CUSTOM MENU
// function wp_get_footer_array($current_menu) {

//     $array_menu = wp_get_nav_menu_items($current_menu);

//     foreach ($array_menu as $m) {
//         if (empty($m->menu_item_parent)) {
//  			echo '<li><a href="';
//  			echo $m->url;
//  			echo '">';
//             echo  $m->title;
//             echo '</a></li>';

//         }
//     }

//     return $menu;
// }

// function time_elapsed_string($datetime, $full = false) {
// 	$now = new DateTime;
// 	$ago = new DateTime($datetime);
// 	$diff = $now->diff($ago);

// 	$diff->w = floor($diff->d / 7);
// 	$diff->d -= $diff->w * 7;

// 	$string = array(
// 			'y' => 'year',
// 			'm' => 'month',
// 			'w' => 'week',
// 			'd' => 'day',
// 			'h' => 'hour',
// 			'i' => 'minute',
// 			's' => 'second',
// 	);
// 	foreach ($string as $k => &$v) {
// 			if ($diff->$k) {
// 					$v = $diff->$k . $v . ($diff->$k > 1 ? 's' : '');
// 			} else {
// 					unset($string[$k]);
// 			}
// 	}

// 	if (!$full) $string = array_slice($string, 0, 1);
// 	return $string ? implode(', ', $string) : 'just now';
// }

// robots.txt filter.
// add_filter('robots_txt', 'wpse_248124_robots_txt', 10,  2);

// function wpse_248124_robots_txt($output, $public) {
//   return 'User-agent: *
//   Disallow: /';
// }
