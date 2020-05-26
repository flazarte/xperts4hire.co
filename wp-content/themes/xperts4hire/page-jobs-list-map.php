<?php
/** 
 * Template Name: Job Listing + Street Map
 */ 
get_header();
global $paged;
if (!isset($paged) || !$paged){
    $paged = 1;
}
$class = new xperts4Hire();
$context = Timber::context();
$args = array(
	'post_type' => 'jobpost',
	'posts_per_page' => 10,
	'paged' => $paged,	
);
$context['job_list'] = new Timber\PostQuery($args);
Timber::render( 'template/job_listing_map/post.twig', $context );
get_footer();