<?php
/** 
 * Template Name: User Profile Template
 */ 
get_header();
//profile id
$id        = um_profile_id();
$handlers  = new xperts4Hire();
$data      = $handlers->xperts_users($id);
$user_data = json_decode($data , true);
?>
<!-- Titlebar
================================================== -->
<div class="single-page-header freelancer-header" data-background-image="<?php bloginfo('stylesheet_directory');?>/images/single-freelancer.jpg">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="single-page-header-inner">
					<div class="left-side">
						<div class="header-image freelancer-avatar"><img src="<?php echo $user_data['image_url']; ?>" alt="<?php echo $user_data['display_name'];?>"></div>
						<div class="header-details">
							<h3><?php echo $user_data['display_name']; ?><span><?php echo $user_data['position']; ?></span></h3>
							<ul>
								<!-- <li><div class="star-rating" data-rating="5.0"></div></li> -->
								<li><img class="flag" src="<?php echo bloginfo('stylesheet_directory').$user_data['flag_url'];?>" alt="<?php echo $user_data['country_name'];?>"><?php echo $user_data['country_name'];?></li>
                                <?php
                                  $status =  ($user_data['status'] == 'approved') ? TRUE : FALSE;
                                  if($status){
                                      echo '<li><div class="verified-badge-with-title">Verified</div></li>';
                                  }
                                ?>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<!-- Page Content
================================================== -->
<div class="container">
	<div class="row">
		
		<!-- Content -->
		<div class="col-xl-8 col-lg-8 content-right-offset">
			
			<!-- Page Content -->
			<div class="single-page-section">
				<h3 class="margin-bottom-25">About Me</h3>
				<?php echo $user_data['description']; ?>
			</div>

			<!-- Boxed List -->
			<?php //get_template_part('template_dashboard/box-list');?>
			<!-- Boxed List / End -->
			
			<!-- Boxed List -->
			<?php get_template_part('template_dashboard/box-list-2');?>
			<!-- Boxed List / End -->

		</div>
		

		<!-- Sidebar -->
		<div class="col-xl-4 col-lg-4">
			<div class="sidebar-container">
				
				<!-- Profile Overview -->
				<div class="profile-overview">
					<div class="overview-item"><strong>$<?php echo $user_data['rate']; ?></strong><span>Hourly Rate</span></div>
					<div class="overview-item"><strong>0</strong><span>Jobs Done</span></div>
					<div class="overview-item"><strong>0</strong><span>Rehired</span></div>
				</div>
                       
				<!-- Button --> 
				<?php if($current = get_current_user_id() != $user_data['id']):?>
				<a href="#small-dialog" class="apply-now-button popup-with-zoom-anim margin-bottom-50">Make an Offer <i class="icon-material-outline-arrow-right-alt"></i></a>
                <?php endif;?>
				<!-- Freelancer Indicators -->
				<div class="sidebar-widget">
					<div class="freelancer-indicators">

						<!-- Indicator -->
						<div class="indicator">
							<strong>0%</strong>
							<div class="indicator-bar" data-indicator-percentage="0"><span></span></div>
							<span>Job Success</span>
						</div>

						<!-- Indicator -->
						<div class="indicator">
							<strong>0%</strong>
							<div class="indicator-bar" data-indicator-percentage="0"><span></span></div>
							<span>Recommendation</span>
						</div>
						
						<!-- Indicator -->
						<div class="indicator">
							<strong>0%</strong>
							<div class="indicator-bar" data-indicator-percentage="0"><span></span></div>
							<span>On Time</span>
						</div>	
											
						<!-- Indicator -->
						<div class="indicator">
							<strong>0%</strong>
							<div class="indicator-bar" data-indicator-percentage="0"><span></span></div>
							<span>On Budget</span>
						</div>
					</div>
				</div>
				
				<!-- Widget -->
				<!-- <div class="sidebar-widget">
					<h3>Social Profiles</h3>
					<div class="freelancer-socials margin-top-25">
						<ul>
							<li><a href="#" title="Dribbble" data-tippy-placement="top"><i class="icon-brand-dribbble"></i></a></li>
							<li><a href="#" title="Twitter" data-tippy-placement="top"><i class="icon-brand-twitter"></i></a></li>
							<li><a href="#" title="Behance" data-tippy-placement="top"><i class="icon-brand-behance"></i></a></li>
							<li><a href="#" title="GitHub" data-tippy-placement="top"><i class="icon-brand-github"></i></a></li>
						
						</ul>
					</div>
				</div> -->

				<!-- Widget -->
				<div class="sidebar-widget">
					<h3>Skills</h3>
					<div class="task-tags">
					<?php if(!empty($user_data['skills'])){
						foreach($user_data['skills'] as $skill){
						echo '<span>'.ucfirst($skill).'</span>';
					}
				   }else{
					   echo '<p>No skills yet!</p>';
				   } ?>	
					</div>
				</div>								
				<!-- Widget -->
				<div class="sidebar-widget">
					<h3>Attachments</h3>
					<div class="attachments-container">
					<?php

					    //cover letter
						if(!empty($user_data['cover_letter'])){
							$url_cover = wp_get_attachment_url($user_data['cover_letter']);
							$cover_info = pathinfo($url_cover);
							echo '<a href="'.$url_cover.'" target="_blank" class="attachment-box ripple-effect"><span>Cover Letter</span><i>'.strtoupper($cover_info['extension']).'</i></a>';
						}
						
					    //resume / cv
						if(!empty($user_data['resume_cv'])){
							$url_resume = wp_get_attachment_url($user_data['resume_cv']);
							$url_info = pathinfo($url_resume);
							echo '<a href="'.$url_resume.'" target="_blank" class="attachment-box ripple-effect"><span>Resume</span><i>'.strtoupper($url_info['extension']).'</i></a>';
						}
					?>
					</div>
				</div>

				<!-- Sidebar Widget -->
				<div class="sidebar-widget">
					<h3>Bookmark or Share</h3>

					<!-- Bookmark Button -->
					<button class="bookmark-button margin-bottom-25">
						<span class="bookmark-icon"></span>
						<span class="bookmark-text">Bookmark</span>
						<span class="bookmarked-text">Bookmarked</span>
					</button>

					<!-- Copy URL -->
					<div class="copy-url">
						<input id="copy-url" type="text" value="" class="with-border">
						<button class="copy-url-button ripple-effect" data-clipboard-target="#copy-url" title="Copy to Clipboard" data-tippy-placement="top"><i class="icon-material-outline-file-copy"></i></button>
					</div>

					<!-- Share Buttons -->
					<div class="share-buttons margin-top-25">
						<div class="share-buttons-trigger"><i class="icon-feather-share-2"></i></div>
						<div class="share-buttons-content">
							<span>Interesting? <strong>Share It!</strong></span>
							<ul class="share-buttons-icons">
							<li><a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo  $user_data['user_url'];?>" data-button-color="#3b5998" title="Share on Facebook" data-tippy-placement="top"><i class="icon-brand-facebook-f"></i></a></li>
								<li><a href="https://twitter.com/share?url=<?php echo  $user_data['user_url'];?>" data-button-color="#1da1f2" title="Share on Twitter" data-tippy-placement="top"><i class="icon-brand-twitter"></i></a></li>
								<li><a href="whatsapp://send?text=<?php echo  $user_data['user_url'];?>" data-button-color="#259a07" title="Share on WhatsApp" data-tippy-placement="top"><i class="icon-brand-whatsapp-square"></i></a></li>
								<li><a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo  $user_data['user_url'];?>" data-button-color="#0077b5" title="Share on LinkedIn" data-tippy-placement="top"><i class="icon-brand-linkedin-in"></i></a></li>
							</ul>
						</div>
					</div>
				</div>

			</div>
		</div>

	</div>
</div>


<!-- Spacer -->
<div class="margin-top-15"></div>
<!-- Spacer / End-->
<?php
get_footer();