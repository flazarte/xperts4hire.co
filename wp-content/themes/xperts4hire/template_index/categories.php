<?php 
$args = [
	'taxonomy'   => 'jobpost_category',
	'hide_empty' => false,
];
$job_categories = get_categories($args);
?>
<?php if(count($job_categories) > 0) : ?>
<div class="section margin-top-65">
	<div class="container">
		<div class="row">
			<div class="col-xl-12">

				<div class="section-headline centered margin-bottom-15">
					<h3>Popular Job Categories</h3>
				</div>
				<!-- Category Boxes Container -->
				<div class="categories-container">
				<?php 
				 foreach($job_categories as $key => $category) :
					if($key == 8){
						break;
					}
					//icon set in custom fields				
					$icon  = get_field('icon', 'category_'.$category->term_id);
				 ?>
					<!-- Category Box -->
					<a href="#" class="category-box">
						<div class="category-box-icon">
							<?php echo $icon;?>
						</div>
						<div class="category-box-counter"><?php echo $category->count;?></div>
						<div class="category-box-content">
							<h3><?php echo htmlspecialchars_decode($category->name);?></h3>
							<p><?php echo htmlspecialchars_decode($category->description);?></p>
						</div>
					</a>
					<?php endforeach;wp_reset_query();?>
				</div><!-- End of Category Box -->
			</div>
		</div>
	</div>
</div>
<?php endif;?>