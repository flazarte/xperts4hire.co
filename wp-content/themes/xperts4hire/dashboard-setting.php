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
								 <form action="" method="post" id="p_image" enctype="multipart/form-data">
									<div class="avatar-wrapper" data-tippy-placement="bottom" title="Change Avatar">
										<!-- <img class="profile-pic" src="images/user-avatar-placeholder.png" alt="" /> -->
										<img class="profile-pic" src="<?php echo $user_data['image_url'];?>" alt="<?php echo $user_data['display_name'];?>" />
										<div class="upload-button"></div>
										<input class="file-upload" name="user_pic" id="user_pic" type="file" accept="image/*"/ >
									</div>		 
								 </form>									
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
												<form action="" method="post" id="c_cover" enctype="multipart/form-data">
												<div class="uploadButton margin-top-0">						
													<input class="uploadButton-input" name="cover_letter" id="cover_letter" type="file" accept="application/msword, application/pdf"  single/>
													<label class="uploadButton-button ripple-effect" id="cover_button" for="cover_letter">Upload Cover Letter</label>
													<span class="uploadButton-file-name" id="cover_field">Maximum file size: 10 MB</span>		
												</div>
												</form>
												<?php
												}
												
												//resume / cv
												if(!empty($user_data['resume_cv'])){
													$url_resume = wp_get_attachment_url($user_data['resume_cv']);
													$url_info = pathinfo($url_resume);
													echo '
													<div class="attachment-box ripple-effect">
													<span>Resume/CV</span>
													<i>'.strtoupper($url_info['extension']).'</i>
													<button class="remove-attachment" data-tippy-placement="top" title="Remove"></button>
												    </div>';
												}else{
												?>
												<form action="" method="post" id="c_resume" enctype="multipart/form-data">
													<div class="uploadButton margin-top-0">
														<input class="uploadButton-input" type="file"  name="resume" id="resume"  accept="application/msword, application/pdf"single/>
														<label class="uploadButton-button ripple-effect" id="resume_button" for="resume">Upload Resume/CV</label>
														<span class="uploadButton-file-name" id="resume_field">Maximum file size: 10 MB</span>
													</div>
												</form>
												<?php
												}		
											   ?>																
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

				<!-- employment history -->
				<div class="col-xl-12">
					<div id="employment" class="dashboard-box">
                        <!-- Headline -->
						<div class="headline" id="employment">
						<h3><i class="icon-material-outline-business"></i> Employment History</h3> 				
						</div>
						
	                     <!-- start history -->
						 <ul class="fields-ul">
						 <?php $work_history = select_work_history();
						    if(!empty($work_history)) :
							  if(count($work_history) > 0 ) :
							  foreach($work_history as $history) : 
							  $end_date = ( strtotime($history['end_date']) > 0) ?  date('j F Y', strtotime($history['end_date'])) : 'Present';		 		
							  ?>
					<li>
						<div class="boxed-list-item">
							<!-- Avatar -->
							<div class="item-image">
								<img src=<?php echo 'data:image;base64,'.$history["company_image"].'' ?> alt="<?php echo  $history['company'];?>">
							</div>
							
							<!-- Content -->
							<div class="item-content">
								<h4><?php echo strtoupper(htmlspecialchars_decode($history['position']));?></h4>
								<div class="item-details margin-top-7">
									<div class="detail-item"><a href="#"><i class="icon-material-outline-business"></i><?php echo strtoupper(htmlspecialchars_decode($history['company']));?></a></div>
									<div class="detail-item"><i class="icon-material-outline-date-range"></i><?php echo date('j F Y', strtotime($history['start_date']));?> - <?php echo $end_date;?></div>
								</div>
								<div class="item-description">
									<p><?php echo  htmlspecialchars_decode($history['job_description']);?></p>
								</div>
							</div>
						</div>
					</li>
							  <?php endforeach;endif; endif;?>

					<!-- add new history -->
					<li>
					<div class="boxed-list-item">
					<a href="#small-dialog" class="button ripple-effect popup-with-zoom-anim  button-sliding-icon">Add Employment <i class="icon-material-outline-add"></i></a>
					</div>
					</li>					
					<!-- end of add button -->
				</ul>
						 <!-- end of history -->




					</div>
				</div>
				<!-- end of employment history -->

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
<!-- employment pop up -->
<div id="small-dialog" class="zoom-anim-dialog mfp-hide dialog-with-tabs">

	<!--Tabs -->
	<div class="sign-in-form">

		<ul class="popup-tabs-nav">
			<li><a href="#tab">Add History</a></li>
		</ul>

		<div class="popup-tabs-container">

			<!-- Tab -->
			<div class="popup-tab-content" id="tab">
				
				<!-- Welcome Text -->
				<div class="welcome-text">
					<h3>Add Your Employment Work History</h3>
				</div>
					
				<!-- Form -->
				<form  action="" method="post" enctype="multipart/form-data" id="history_form">

					<div class="input-with-icon-left">
						<i class="icon-material-outline-business-center"></i>
						<input type="text" class="input-text with-border" name="company_position" id="company_position" placeholder="Position" required/>
					</div>

					<div class="input-with-icon-left">
						<i class="icon-material-outline-business"></i>
						<input type="text" class="input-text with-border" name="company" id="company" placeholder="company" required/>
					</div>

					<!-- Start date -->
					<div>
						<label for="Start Date">Start Date:</label>
						<div class="input-with-icon-left">					   
							<i class="icon-material-outline-date-range"></i>
							<input type="date" class="input-text with-border" name="start_date" id="start_date" placeholder="Start Date" required/>
						</div>
					</div>
					
                    	<!-- End date -->
					<div id="end_date_form">
						<label for="Start Date">End Date:</label>
						<div class="input-with-icon-left">
							<i class="icon-material-outline-date-range"></i>
							<input type="date" class="input-text with-border" value="" name="end_date" id="end_date" placeholder="End Date" required/>
						</div>
					</div>

					<!-- present working -->
					<div class="checkbox">
						<input type="checkbox" id="present" name="present">
						<label for="present"><span class="checkbox-icon"></span>Currently Working?</label>
			       </div>

					<textarea  cols="10" placeholder="Job Description Summary" name="job_description" id="job_description" class="with-border" required></textarea>

					<div class="uploadButton margin-top-25">
						<input class="uploadButton-input" name="history_company" type="file" accept="image/*" id="upload" single required/>
						<label class="uploadButton-button ripple-effect" name="submit" for="upload">Upload Company Image</label>
						<span class="uploadButton-file-name">Allowed file types: png, jpg <br> Max. files size: 50 MB.</span>
					</div>
                 	<!-- Button -->
				<button class="button margin-top-35 full-width button-sliding-icon" type="submit" name="Employment_history" id="Employment_history">Add History<i class="icon-material-outline-arrow-right-alt"></i></button>
				</form>
				
			
		
			</div>
			<!-- Login -->
			<!-- <div class="popup-tab-content" id="loginn"> -->
				
				<!-- Welcome Text -->
				<!-- <div class="welcome-text">
					<h3>Discuss Your Project With Tom</h3>
				</div> -->
					
				<!-- Form -->
				<!-- <form method="post" id="make-an-offer-form">

					<div class="input-with-icon-left">
						<i class="icon-material-outline-account-circle"></i>
						<input type="text" class="input-text with-border" name="name2" id="name2" placeholder="First and Last Name" required/>
					</div>

					<div class="input-with-icon-left">
						<i class="icon-material-baseline-mail-outline"></i>
						<input type="text" class="input-text with-border" name="emailaddress2" id="emailaddress2" placeholder="Email Address" required/>
					</div>

					<textarea name="textarea" cols="10" placeholder="Message" class="with-border"></textarea>

					<div class="uploadButton margin-top-25">
						<input class="uploadButton-input" type="file" accept="image/*, application/pdf" id="upload-cv" multiple/>
						<label class="uploadButton-button" for="upload-cv">Add Attachments</label>
						<span class="uploadButton-file-name">Allowed file types: zip, pdf, png, jpg <br> Max. files size: 50 MB.</span>
					</div>

				</form> -->
				
				<!-- Button -->
				<!-- <button class="button full-width button-sliding-icon ripple-effect" type="submit" form="make-an-offer-form">Make an Offer <i class="icon-material-outline-arrow-right-alt"></i></button> -->

			<!-- </div> -->

		</div>
	</div>
</div>
<!-- Make an Offer Popup / End -->
<!-- end of employment -->
<?php
get_footer();
