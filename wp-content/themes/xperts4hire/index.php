<?php
/** 
 * Template Name: Default Page 1
 */ 
get_header();
$class = new xperts4Hire();
$context = Timber::context();
$cat = [
	'taxonomy'   => 'jobpost_category',
	'hide_empty' => false,
];
$context['categories'] = Timber::get_terms($cat);
$jobs = array(
	'post_type' => 'jobpost',
	'posts_per_page' => 5,	
);
$context['jobs'] = Timber::get_posts($jobs);
$location = [
	'taxonomy'   => 'jobpost_location',
	'hide_empty' => false,
];
$context['locations'] = Timber::get_terms($location);
$context['employees'] = get_users( 'role=employee');
$blogs = [
    'post_type'      => 'post',
    'post_status'    => 'publish',
    'posts_per_page' => 3,
];
$context['home_blogs'] = Timber::get_posts($blogs);
$context['companies'] = get_users('role=um_employer');
Timber::render( 'template_index/index.twig', $context );
get_footer();