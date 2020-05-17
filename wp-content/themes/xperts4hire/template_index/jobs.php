<?php 
$args = [
    'post_type'      => 'jobpost',
    'posts_per_page' => 5,
];
$job_post = get_posts($args);
?>
<?php if(count($job_post) > 0) : ?>
<div class="section gray margin-top-45 padding-top-65 padding-bottom-75">
	<div class="container">
		<div class="row">
			<div class="col-xl-12">
				
				<!-- Section Headline -->
				<div class="section-headline margin-top-0 margin-bottom-35">
					<h3>Featured Jobs</h3>
					<a href="jobs-list-layout-full-page-map.html" class="headline-link">Browse All Jobs</a>
				</div>
				
				<!-- Jobs Container -->
				<div class="listings-container compact-list-layout margin-top-35">
                    <?php
                    foreach($job_post as $key => $job):
                        $job_type         = sjb_get_the_job_type($job->ID);
                        $job_location     = sjb_get_the_job_location($job->ID);
                        $company          = sjb_get_the_company_name($job->ID);
                        $job_posting_time = get_post_time('j F Y','true',$job->ID,'false');
                    ?>				
					<!-- Job Listing -->
					<a href="single-job-page.html" class="job-listing with-apply-button">

						<!-- Job Listing Details -->
						<div class="job-listing-details">

							<!-- Logo -->
							<div class="job-listing-company-logo">
                                <?php sjb_the_company_logo('thumbnail', '', '', $job->ID);?>
							</div>

							<!-- Details -->
							<div class="job-listing-description">
								<h3 class="job-listing-title"><?php echo htmlspecialchars_decode($job->post_title);?></h3>

								<!-- Job Listing Footer -->
								<div class="job-listing-footer">
									<ul>
										<li><i class="icon-material-outline-business"></i><?php echo $company;?><div class="verified-badge" title="Verified Employer" data-tippy-placement="top"></div></li>
										<li><i class="icon-material-outline-location-on"></i><?php echo $job_location[0]->name;?></li>
										<li><i class="icon-material-outline-business-center"></i><?php echo $job_type[0]->name;?></li>
										<li><i class="icon-material-outline-access-time"></i><?php echo $job_posting_time;?></li>
									</ul>
								</div>
							</div>

							<!-- Apply Button -->
							<span class="list-apply-button ripple-effect">Apply Now</span>
						</div>
					</a>
                    <?php endforeach;wp_reset_query();?>	

				</div>
				<!-- Jobs Container / End -->

			</div>
		</div>
	</div>
</div>
<?php endif;?>