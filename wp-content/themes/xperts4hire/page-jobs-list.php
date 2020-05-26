<?php
/** 
 * Template Name: Job Listing List
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
$context['job_list_2'] = new Timber\PostQuery($args);
Timber::render( 'template/job_list/jobs.twig', $context );
get_footer();
