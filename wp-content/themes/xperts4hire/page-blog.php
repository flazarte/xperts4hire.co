<?php
/** 
 * Template Name: Blog List Template
 */ 
get_header();
global $paged;
if (!isset($paged) || !$paged){
    $paged = 1;
}
$context = Timber::context();
$blogs = array( 
	'post_type'    => 'post',
	'post_status'  => 'publish',
);

$args = array(
	'post_type' => 'post',
	'posts_per_page' => 10,
	'paged' => $paged	
);
//get the featured blog list
$context['blogs'] = Timber::get_posts($blogs);
$context['posts'] = new Timber\PostQuery($args);
Timber::render( 'template/blog/blog.twig', $context );
get_footer();