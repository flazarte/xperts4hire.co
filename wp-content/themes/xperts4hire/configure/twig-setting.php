<?php
function cpt_archive_posts_per_page( $query ) {

    // for cpt or any post type main archive
    if ( $query->is_main_query() && ! is_admin() ) {
        $query->set( 'posts_per_page', '10' );   
    }
}
add_action( 'pre_get_posts', 'cpt_archive_posts_per_page' );

//get total page views
function xperts_page_views($post_id){
    global $wpdb;
    $result = [];
    $nowisnow = date('Y-m-d');

	$total = $wpdb->prepare( "SELECT postcount AS total FROM ". $wpdb->prefix . "pvc_total
		WHERE postnum = %s", $post_id );
    $total_views =  $wpdb->get_var($total);
      

	$today = $wpdb->prepare( "SELECT postcount AS today FROM ". $wpdb->prefix . "pvc_daily
		WHERE postnum = %s AND time = %s", $post_id, $nowisnow );
    $today_views = $wpdb->get_var($today);
    $result = [
        'total' => $total_views,
        'today' => $today_views,
    ];
    
return  $result;
}

/**
 * My custom get Page Views in  Twig functionality.
 *
 * @param \Twig\Environment $twig
 * @return \Twig\Environment
 */
function views_stats( $twig ) {

    $twig->addFunction( new Timber\Twig_Function( 'get_views', 'xperts_page_views' ) );
    
    return $twig;
}
add_filter( 'timber/twig', 'views_stats' );

function get_employer($id){
    $class    = new xperts4Hire();
    $employer = json_decode($class->xperts_employers($id), true);

return $employer;
}

/**
 * My custom get employer in  Twig functionality.
 *
 * @param \Twig\Environment $twig
 * @return \Twig\Environment
 */
function get_employer_data( $twig ) {

    $twig->addFunction( new Timber\Twig_Function( 'get_employer', ' get_employer' ) );
    
    return $twig;
}
add_filter( 'timber/twig', 'get_employer_data' );