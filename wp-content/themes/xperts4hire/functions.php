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

	// Xperts4Hire Setting
	include( 'configure/admin.php' );
	
	//MAP SETTINGS JS
	include( 'configure/js-sreet-map.php' );

	//Registration setting
	include( 'configure/register.php' );

	//TWIG setting
	include( 'configure/twig-setting.php' );

	//custom db update
	include( 'configure/db.php' );
		
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


//upload work employment history
if (isset($_POST['Employment_history'])) {
	if (getimagesize($_FILES['history_company']['tmp_name']) == false) {
	echo '
	<script type="text/javascript">
	confirm("Please Select An Image!");
	event.preventDefault(); die();
	</script>
	';
	} else {
		$image = $_FILES['history_company'];
		$file_type = array(
			 'image/jpeg',
			 'image/png',
		);
		if(!in_array( $image['type'], $file_type )){
			$message = "File type is not supported!";
			echo "<script type='text/javascript'>confirm('$message');
			event.preventDefault(); die();
			</script>";
			die;
		}
			//declare variables
			$end_date = (!empty($_POST['end_date'])) ? $_POST['end_date'] : '';
			$image = $_FILES['history_company']['tmp_name'];
			$name = $_FILES['history_company']['name'];
			$image = base64_encode(file_get_contents(addslashes($image)));
			$sqlInsertimageintodb = add_employment($_POST['company'], $_POST['company_position'], $name, $image, $_POST['job_description'], $_POST['start_date'], $end_date);
			if ($sqlInsertimageintodb == true) {
			echo '<script type="text/javascript">					
			confirm("Employment History Added!");
			if ( window.history.replaceState ) {
				window.history.replaceState( null, null, window.location.href );
			}								
			</script>';
			} else {
			echo '
			<script type="text/javascript">
			confirm("Failed, Please try again!");
			event.preventDefault(); die();
			</script>
			';
		}
	}
unset($POST);
}

//upload user profile image
if (isset($_FILES['user_pic'])) {
	my_upload_avatar($_FILES['user_pic']);
	echo '
	<script type="text/javascript">					
		confirm("Profile Picture Updated!");
		if ( window.history.replaceState ) {
			window.history.replaceState( null, null, window.location.href );
		}								
	</script>';
unset($POST);
}
   
function my_upload_avatar($avatar_url) {
	$user_id = get_current_user_id();
	$upload = wp_upload_bits( $avatar_url['name'], null, file_get_contents( $avatar_url['tmp_name'] ) );
    $wp_filetype = wp_check_filetype( basename( $upload['file'] ), null );
    $wp_upload_dir = wp_upload_dir();
    $attachment = array(
        'guid' => $wp_upload_dir['url'] . _wp_relative_upload_path( $upload['file'] ),
        'post_mime_type' => $wp_filetype['type'],
        'post_title' => preg_replace('/\.[^.]+$/', '', basename( $upload['file'] )),
        'post_content'   => '',
        'post_status'    => 'inherit'
    );
    $attach_id = wp_insert_attachment( $attachment, $upload['file']);
    require_once(ABSPATH . 'wp-admin/includes/image.php');
    $attach_data = wp_generate_attachment_metadata( $attach_id, $upload['file'] );
    wp_update_attachment_metadata( $attach_id, $attach_data );
    update_user_meta($user_id, "wp_user_avatar", $attach_id);
}

//upload documents
function my_upload_function( $file ) {
    $upload = wp_upload_bits( $file['name'], null, file_get_contents( $file['tmp_name'] ) );
    $wp_filetype = wp_check_filetype( basename( $upload['file'] ), null );  
    $wp_upload_dir = wp_upload_dir();

    $attachment = array(
        'guid' => $wp_upload_dir['url'] . _wp_relative_upload_path( $upload['file'] ),
        'post_mime_type' => $wp_filetype['type'],
        'post_title' => preg_replace('/\.[^.]+$/', '', basename( $upload['file'] )),
        'post_content' => '',
        'post_status' => 'inherit'
    );
   
	$attach_id = wp_insert_attachment( $attachment, $upload['file']);
    require_once(ABSPATH . 'wp-admin/includes/image.php');
    $attach_data = wp_generate_attachment_metadata( $attach_id, $upload['file'] );
    wp_update_attachment_metadata( $attach_id, $attach_data );

return $attach_id;
}

//upload user cover letter
if (isset($_FILES['cover_letter'])) {
	$user_id = get_current_user_id();
	$id = my_upload_function($_FILES['cover_letter']);
	update_user_meta( $user_id, 'cover_letter', $id);
	echo '
	<script type="text/javascript">					
		confirm("Cover Letter Updated!");
		if ( window.history.replaceState ) {
			window.history.replaceState( null, null, window.location.href );
		}								
	</script>';
unset($POST);
}

//upload user resume
if (isset($_FILES['resume'])) {
	$user_id = get_current_user_id();
	$id = my_upload_function($_FILES['resume']);
	update_user_meta( $user_id, 'resume__cv', $id);
	echo '
	<script type="text/javascript">					
		confirm("Resume Updated!");
		if ( window.history.replaceState ) {
			window.history.replaceState( null, null, window.location.href );
		}								
	</script>';
unset($POST);
}
