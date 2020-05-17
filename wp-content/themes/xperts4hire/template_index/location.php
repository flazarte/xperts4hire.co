<?php 
$args = [
	'taxonomy'   => 'jobpost_location',
	'hide_empty' => false,
];
$job_location = get_categories($args);
?>
<?php if(count($job_location ) > 0) : ?>
<div class="section margin-top-65 margin-bottom-65">
	<div class="container">
		<div class="row">

			<!-- Section Headline -->
			<div class="col-xl-12">
				<div class="section-headline centered margin-top-0 margin-bottom-45">
					<h3>Featured Cities</h3>
				</div>
			</div>
            
			<?php foreach($job_location as $key => $location):
			      if($key == 4){
				  	break;
				  } 
                  $featured_city        = get_field('featured-city', 'category_'.$location->term_id);
                  $featured_city_image  = get_field('featured_image_city', 'category_'.$location->term_id);
            ?>
            <?php if($featured_city == true):?>
			<div class="col-xl-3 col-md-6">
				<!-- Photo Box -->
				<a href="jobs-list-layout-1.html" class="photo-box" data-background-image="<?php echo $featured_city_image['sizes']['medium']; ?>">
					<div class="photo-box-content">
						<h3><?php echo $location->name;?></h3>
						<span><?php echo $location->count;?> Jobs</span>
					</div>
				</a>
			</div>
			<?php endif;endforeach;wp_reset_query(); ?>

		</div>
	</div>
</div>
<?php endif;?>