<?php 
$handlers = new xperts4Hire();
$company   = get_users('role=um_employer');
?>
<?php if(count($company) > 7) : ?>
<div class="section border-top padding-top-45 padding-bottom-45">
	<!-- Logo Carousel -->
	<div class="container">
		<div class="row">
			<div class="col-xl-12">
				<!-- Carousel -->
				<div class="col-md-12">
					<div class="logo-carousel">
					<?php foreach($company as $key => $employer) :
                       $data          = $handlers->xperts_employers($employer->ID);
                       $users_data    = json_decode($data , true);
					   $profile_image = (!empty($users_data['image_url'])) ? $users_data['image_url'] : bloginfo('stylesheet_directory').'/images/user-avatar-placeholder.png';
                    ?>
						<div class="carousel-item">
							<a href="<?php echo $users_data['user_url'];?>" target="_blank" title="<?php echo $users_data['display_name'];?>"><img src="<?php echo $profile_image;?>" alt="<?php echo $users_data['display_name'];?>"></a>
						</div>
					<?php endforeach;?>						
					</div>
				</div>
				<!-- Carousel / End -->
			</div>
		</div>
	</div>
</div>
<?php endif;?>