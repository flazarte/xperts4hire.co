<?php
/** 
 * Template Name: Freelancers List Layout 2
 */ 
get_header();
$context = Timber::context();
$number   = 10;
$paged    = (get_query_var('paged')) ? get_query_var('paged') : 1;
$offset   = ($paged - 1) * $number;
$users    = get_users('role=employee');
$query    = get_users('role=employee&offset='.$offset.'&number='.$number);
$total_users = count($users);
$total_query = count($query);
$total_pages = intval($total_users / $number);
function user_pagination($total_users, $total_query, $total_pages){
    $page = '';
    if ($total_users > $total_query) {
        $current_page = max(1, get_query_var('paged'));
        $page =  custom_paginate_links(array(
          'base' => get_pagenum_link(1) . '%_%',
          'format' => 'page/%#%/',
          'current' => $current_page,
          'total' => $total_pages,
          'prev_next'    => true,
         'type'         => 'plain',
        ));
  }
return $page;
}

$context['pages'] = user_pagination($total_users, $total_query, $total_pages); 
$context['list_users'] = $query;
Timber::render( 'template/freelancers_list/index.twig', $context );
get_footer();