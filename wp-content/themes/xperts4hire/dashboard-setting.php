<?php
/** 
 * Template Name: Dashboard Setting
 */ 
get_header();
$id        = get_current_user_id();
$handlers  = new xperts4Hire();
$data      = $handlers->xperts_users($id);
$user_data = json_decode($data , true);
?>
<!-- Dashboard Container -->
<div class="dashboard-container">

	<!-- Dashboard Sidebar
	================================================== -->
	<div class="dashboard-sidebar">
		<div class="dashboard-sidebar-inner" data-simplebar>
			<div class="dashboard-nav-container">

				<!-- Responsive Navigation Trigger -->
				<a href="#" class="dashboard-responsive-nav-trigger">
					<span class="hamburger hamburger--collapse" >
						<span class="hamburger-box">
							<span class="hamburger-inner"></span>
						</span>
					</span>
					<span class="trigger-title">Dashboard Navigation</span>
				</a>
				
				<!-- Navigation -->
				<?php get_template_part( 'template_dashboard/navigation'); ?>
				<!-- Navigation / End -->

			</div>
		</div>
	</div>
	<!-- Dashboard Sidebar / End -->


	<!-- Dashboard Content
	================================================== -->
	<div class="dashboard-content-container" data-simplebar>
		<div class="dashboard-content-inner" >
			
			<!-- Dashboard Headline -->
			<div class="dashboard-headline">
				<h3>Settings</h3>

				<!-- Breadcrumbs -->
				<nav id="breadcrumbs" class="dark">
					<ul>
						<li><a href="<?php echo home_url();?>">Home</a></li>
						<li><a href="<?php echo home_url('dashboard');?>">Dashboard</a></li>
						<li>Settings</li>
					</ul>
				</nav>
			</div>
	
			<!-- Row -->
			<div class="row">

				<!-- Dashboard Box -->
				<div class="col-xl-12">
					<div class="dashboard-box margin-top-0">

						<!-- Headline -->
						<div class="headline">
							<h3><i class="icon-material-outline-account-circle"></i> My Account</h3>
						</div>

						<div class="content with-padding padding-bottom-0">

							<div class="row">

								<div class="col-auto">
									<div class="avatar-wrapper" data-tippy-placement="bottom" title="Change Avatar">
										<!-- <img class="profile-pic" src="images/user-avatar-placeholder.png" alt="" /> -->
										<img class="profile-pic" src="<?php echo $user_data['image_url'];?>" alt="<?php echo $user_data['display_name'];?>" />
										<div class="upload-button"></div>
										<input class="file-upload" type="file" accept="image/*"/>
									</div>
								</div>

								<div class="col">
									<div class="row">
										<div class="col-xl-6">
											<div class="submit-field">
												<h5>First Name</h5>
												<input type="text" class="with-border" value="<?php echo $user_data['first_name'];?>" id="p_name" required>
											</div>
										</div>

										<div class="col-xl-6">
											<div class="submit-field">
												<h5>Last Name</h5>
												<input type="text" class="with-border" value="<?php echo $user_data['last_name'];?>" id="p_last" required>
											</div>
										</div>

										<div class="col-xl-6">
											<!-- Account Type -->
											<div class="submit-field">
												<h5>Account Type</h5>
												<div class="account-type">
												<?php if($user_data['role'] == 'employee') :?>
													<div>
														<input type="radio" name="account-type-radio" id="employer-radio" class="account-type-radio" value="<?php echo $id;?>" checked/>
														<label for="freelancer-radio" class="ripple-effect-dark"><i class="icon-material-outline-account-circle"></i> Freelancer</label>
													</div>
												<?php elseif($user_data['role'] == 'employer'):?>
													<div>
														<input type="radio" name="account-type-radio" id="employer-radio" class="account-type-radio" value="<?php echo $id;?>" checked/>
														<label for="employer-radio" class="ripple-effect-dark"><i class="icon-material-outline-business-center"></i> Employer</label>
													</div>
												<?php else :?>
													<div>
														<input type="radio" name="account-type-radio" id="employer-radio" class="account-type-radio" value="<?php echo $id;?>" checked/>
														<label for="employer-radio" class="ripple-effect-dark"><i class="icon-material-outline-business-center"></i>Management</label>
													</div>
													<?php endif;?>
												</div>
											</div>
										</div>

										<div class="col-xl-6">
											<div class="submit-field">
												<h5>Email</h5>
												<input type="text" class="with-border" value="<?php echo $user_data['email'];?>" readonly>
											</div>
										</div>

									</div>
								</div>
							</div>

						</div>
					</div>
				</div>

				<!-- Dashboard Box -->
				<div class="col-xl-12">
					<div class="dashboard-box">

						<!-- Headline -->
						<div class="headline">
							<h3><i class="icon-material-outline-face"></i> My Profile</h3>
						</div>

						<div class="content">
							<ul class="fields-ul">
							<li>
								<div class="row">
									<div class="col-xl-4">
										<div class="submit-field">
											<div class="bidding-widget">
												<!-- Headline -->
												<span class="bidding-detail">Set your <strong>minimal hourly rate</strong></span>

												<!-- Slider -->
												<div class="bidding-value margin-bottom-10">$<span id="biddingVal"></span></div>
												<input class="bidding-slider" type="text" value="<?php echo $user_data['rate'];?>" id="rate" data-slider-handle="custom" data-slider-currency="$" data-slider-min="5" data-slider-max="150" data-slider-value="<?php echo $user_data['rate'];?>" data-slider-step="1" data-slider-tooltip="hide" />
											</div>
										</div>
									</div>

									<div class="col-xl-4">
										<div class="submit-field">
											<h5>Skills <i class="help-icon" data-tippy-placement="right" title="Add up to 10 skills"></i></h5>

											<!-- Skills List -->
											<div class="keywords-container">
												<div class="keyword-input-container">
													<input type="text" class="keyword-input with-border" id="skills" placeholder="e.g. Angular, Laravel"/>
													<button class="keyword-input-button ripple-effect"><i class="icon-material-outline-add"  id="skills_button"></i></button>
												</div>
												<div class="keywords-list">
												<?php if(!empty($user_data['skills'])){
													foreach($user_data['skills'] as $skill){
														echo '<span class="keyword"><span class="keyword-remove"></span><span class="keyword-text" data-value="'.$skill.'">'.ucfirst($skill).'</span></span>';
													}
												}?>	
												</div>
												<div class="clearfix"></div>
											</div>
										</div>
									</div>

									<div class="col-xl-4">
										<div class="submit-field">
											<h5>Attachments</h5>
											
											<!-- Attachments -->
											<div class="attachments-container margin-top-0 margin-bottom-0">
											<?php 
											   //cover letter
												if(!empty($user_data['cover_letter'])){
													$url_cover = wp_get_attachment_url($user_data['cover_letter']);
													$cover_info = pathinfo($url_cover); 
													echo '
													<div class="attachment-box ripple-effect">
													<span>Cover Letter</span>
													<i>'.strtoupper($cover_info['extension']).'</i>
													<button class="remove-attachment" data-tippy-placement="top" title="Remove"></button>
												   </div>';
												}else{
												?>
												<div class="uploadButton margin-top-0">
													<input class="uploadButton-input cover" type="file" accept="application/msword, application/pdf" id="upload" single/>
													<label class="uploadButton-button ripple-effect" for="upload">Upload Cover Letter</label>
													<span class="uploadButton-file-name cover" id="cover">Maximum file size: 10 MB</span>
												</div>
												<?php
												}
												
												//resume / cv
												if(!empty($user_data['resume_cv'])){
													$url_resume = wp_get_attachment_url($user_data['resume_cv']);
													$url_info = pathinfo($url_resume);
													echo '
													<div class="attachment-box ripple-effect">
													<span>Contract</span>
													<i>'.strtoupper($url_info['extension']).'</i>
													<button class="remove-attachment" data-tippy-placement="top" title="Remove"></button>
												    </div>';
												}else{
												?>
												<!-- <div class="uploadButton margin-top-0">
													<input class="uploadButton-input resume" type="file" accept="image/*, application/pdf" id="upload" single/>
													<label class="uploadButton-button ripple-effect" for="upload">Upload Resume/CV</label>
													<span class="uploadButton-file-name resume" id="resume">Maximum file size: 10 MB</span>
											    </div> -->
												<?php
												}		
											   ?>
																
											</div>
											<div class="clearfix"></div>
											<!-- Upload Button -->
											<!-- <form method="post" id="adduser" enctype='multipart/form-data'>
											<div class="uploadButton margin-top-0">
												<input class="uploadButton-input" type="file" accept="application/msword, application/pdf" name="recover" id="upload" single/>
												<label class="uploadButton-button ripple-effect" for="upload">Upload Files</label>
												<span class="uploadButton-file-name">Maximum file size: 10 MB</span>
											</div>
											</form> -->
										</div>
									</div>
								</div>
							</li>
							<li>
								<div class="row">
									<div class="col-xl-6">
										<div class="submit-field">
											<h5>Tagline</h5>
											<input type="text" class="with-border" value="<?php echo $user_data['position'];?>" id="position">
										</div>
									</div>

									<div class="col-xl-6">
										<div class="submit-field">
											<h5>Nationality</h5>
											<select class="selectpicker with-border" data-size="7" title="Select Country" data-live-search="true" id="country">
												<?php 
												   $country_list = user_country();
												   foreach ($country_list as $key => $country) {?>
												   		<?php $default = ($user_data['country_abbr'] == $key) ? 'selected' : ''; ?>
													  <option value="<?php echo $key;?>" <?php  echo $default;?>><?php echo $country;?></option>
												  <?php }				
												?>																							
											</select>
										</div>
									</div>

									<div class="col-xl-12">
										<div class="submit-field">
											<h5>Introduce Yourself</h5>
											<textarea cols="30" rows="5" class="with-border" id="description"><?php echo $user_data['description'];?></textarea>
										</div>
									</div>

								</div>
							</li>
						</ul>
						</div>
					</div>
				</div>

				<!-- Dashboard Box -->
				<div class="col-xl-12">
					<div id="test1" class="dashboard-box">

						<!-- Headline -->
						<div class="headline">
							<h3><i class="icon-material-outline-lock"></i> Password & Security</h3>
						</div>

						<div class="content with-padding">
							<div class="row">
								<div class="col-xl-4">
									<div class="submit-field">
										<h5>Current Password</h5>
										<input type="password" class="with-border" id="c_password" placeholder="Enter Current Password">
									</div>
								</div>

								<div class="col-xl-4">
									<div class="submit-field">
										<h5>New Password</h5>
										<input type="password" class="with-border" id="n_password" placeholder="Enter New Password" required>
									</div>
								</div>

								<div class="col-xl-4" >
									<div class="submit-field">
										<h5>Repeat New Password</h5>
										<input type="password" class="with-border" id="r_password" placeholder="Confirm Password" required>
									</div>
								</div>

								<!-- <div class="col-xl-12">
									<div class="checkbox">
										<input type="checkbox" id="two-step" checked>
										<label for="two-step"><span class="checkbox-icon"></span> Enable Two-Step Verification via Email</label>
									</div>
								</div> -->
							</div>
						</div>
					</div>
				</div>
				
				<!-- Button -->
				<div class="col-xl-12">
					<a type="submit" class="button ripple-effect big margin-top-30 white" name="update_account" id="update_account">Save Changes</a>
				</div>

			</div>
			<!-- Row / End -->
             <!-- Footer -->
			<?php get_template_part( 'template_dashboard/footer'); ?>
			<!-- Footer / End -->
		</div>
	</div>
	<!-- Dashboard Content / End -->

</div>
<!-- Dashboard Container / End -->

</div>
<!-- Wrapper / End -->
<?php
get_footer();
