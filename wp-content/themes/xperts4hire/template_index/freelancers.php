<?php 
$handlers = new xperts4Hire();
$users    = get_users( 'role=employee');
?>
<?php if(count($users) > 0) : ?>
<div class="section gray padding-top-65 padding-bottom-70 full-width-carousel-fix">
	<div class="container">
		<div class="row">

			<div class="col-xl-12">
				<!-- Section Headline -->
				<div class="section-headline margin-top-0 margin-bottom-25">
					<h3>Highest Rated Freelancers</h3>
					<a href="freelancers-grid-layout.html" class="headline-link">Browse All Freelancers</a>
				</div>
			</div>

			<div class="col-xl-12">
				<div class="default-slick-carousel freelancers-container freelancers-grid-layout">
                     
					<!--Freelancer -->
                    <?php foreach($users as $key => $user) :
                       $data          = $handlers->xperts_users($user->ID);
                       $users_data    = json_decode($data , true);
                       $profile_image = (!empty($users_data['image_url'])) ? $users_data['image_url'] : bloginfo('stylesheet_directory').'/images/user-avatar-placeholder.png';
                    ?>
					<div class="freelancer">

						<!-- Overview -->
						<div class="freelancer-overview">
							<div class="freelancer-overview-inner">
								
								<!-- Bookmark Icon -->
								<span class="bookmark-icon"></span>
								
								<!-- Avatar -->
								<div class="freelancer-avatar">
                                <?php 
                                    //verified badge
                                    if($users_data['status'] == 'approved'){
                                        echo '<div class="verified-badge"></div>';
                                    }
                                ?>
									<a href="single-freelancer-profile.html"><img src="<?php echo $profile_image; ?>" alt="<?php echo $users_data['display_name'];?>"></a>
								</div>

								<!-- Name -->
								<div class="freelancer-name">
									<h4><a href="single-freelancer-profile.html"><?php echo $users_data['display_name'];?><img class="flag" src="<?php echo bloginfo('stylesheet_directory').$users_data['flag_url'];?>" alt="<?php echo $users_data['country_name'];?>" title="<?php echo $users_data['country_name'];?>" data-tippy-placement="top"></a></h4>
									<span><?php echo $users_data['position'];?></span>
								</div>

								<!-- Rating -->
								<div class="freelancer-rating">
									<div class="star-rating" data-rating="4.1"></div>
								</div>
							</div>
						</div>
						
						<!-- Details -->
						<div class="freelancer-details">
							<div class="freelancer-details-list">
								<ul>
									<li>Location <strong><i class="icon-material-outline-location-on"></i><?php echo strtoupper($users_data['country_abbr']);?></strong></li>
									<li>Rate <strong>$<?php echo $users_data['rate'];?> / hr</strong></li>
									<li>Job Success <strong>95%</strong></li>
								</ul>
							</div>
							<a href="single-freelancer-profile.html" class="button button-sliding-icon ripple-effect">View Profile <i class="icon-material-outline-arrow-right-alt"></i></a>
						</div>
					</div>
                    <?php endforeach;wp_reset_query();?>
					<!-- Freelancer / End -->
				</div>
			</div>

		</div>
	</div>
</div>
<?php endif;?>