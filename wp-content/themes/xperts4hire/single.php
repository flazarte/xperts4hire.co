<?php
/** 
 * Template Name: Blog Post / Job Post Template
 */ 
get_header();
$context = Timber::context();
$class   = new xperts4Hire();
$post_id = get_the_id();
$post_type = get_post($post_id);

//get post-blogs
if($post_type->post_type == 'post'){

    //related post by categories
    $related = array( 
        'category__in' => wp_get_post_categories($post_id),
        'numberposts'  => 3,
        'post__not_in' => array($post_id),
    );
    
    //related post by categories
    $latest = array( 
        'post_type'    => 'post',
        'numberposts'  => 3,
        'post__not_in' => array($post_id),
        'post_status'  => 'publish',
    );
    
    //get the current post 
    $context['post']    = new Timber\Post();
    $context['related'] = Timber::get_posts($related);
    $context['latest']  = Timber::get_posts($latest);
    Timber::render( 'template/post/post.twig', $context );
  
}elseif ($post_type->post_type == 'jobpost') {
     
    $job_category = get_the_terms($post_id, 'jobpost_category');
     //similar post by categories
     $similar = array( 
        'post_type'     => 'jobpost',
        'numberposts'   => 3,
        'post__not_in'  => array($post_id),
        'orderby'       => 'rand',
    );

    //current job post
    $context['jobpost']   = new Timber\Post();
    $context['similar']   = Timber::get_posts($similar);
    $context['employer']  = json_decode($class->xperts_employers($context['jobpost']->post_author), true);
    Timber::render( 'template/jobpost/job-post.twig', $context );
    
}

get_footer();