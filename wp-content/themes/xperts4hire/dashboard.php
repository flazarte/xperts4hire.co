<?php
/** 
 * Template Name: Main Dashboard
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
				<h3>Howdy, <?php echo ucfirst($user_data['nice_name']);?>!</h3>
				<span>We are glad to see you again!</span>

				<!-- Breadcrumbs -->
				<nav id="breadcrumbs" class="dark">
					<ul>
						<li><a href="<?php echo home_url('dashboard');?>">Home</a></li>
						<li>Dashboard</li>
					</ul>
				</nav>
			</div>
	
			<!-- Fun Facts Container -->
			<div class="fun-facts-container">
				<div class="fun-fact" data-fun-fact-color="#36bd78">
					<div class="fun-fact-text">
						<span>Task Bids Won</span>
						<h4>0</h4>
					</div>
					<div class="fun-fact-icon"><i class="icon-material-outline-gavel"></i></div>
				</div>
				<div class="fun-fact" data-fun-fact-color="#b81b7f">
					<div class="fun-fact-text">
						<span>Jobs Applied</span>
						<h4>0</h4>
					</div>
					<div class="fun-fact-icon"><i class="icon-material-outline-business-center"></i></div>
				</div>
				<div class="fun-fact" data-fun-fact-color="#efa80f">
					<div class="fun-fact-text">
						<span>Reviews</span>
						<h4>0</h4>
					</div>
					<div class="fun-fact-icon"><i class="icon-material-outline-rate-review"></i></div>
				</div>

				<!-- Last one has to be hidden below 1600px, sorry :( -->
				<div class="fun-fact" data-fun-fact-color="#2a41e6">
					<div class="fun-fact-text">
						<span>This Month Views</span>
						<h4>0</h4>
					</div>
					<div class="fun-fact-icon"><i class="icon-feather-trending-up"></i></div>
				</div>
			</div>
			
			<!-- Row -->
			<div class="row">

				<div class="col-xl-8">
					<!-- Dashboard Box -->
					<div class="dashboard-box main-box-in-row">
						<div class="headline">
							<h3><i class="icon-feather-bar-chart-2"></i> Your Profile Views</h3>
							<div class="sort-by">
								<select class="selectpicker hide-tick">
									<option>Last 6 Months</option>
									<option>This Year</option>
									<option>This Month</option>
								</select>
							</div>
						</div>
						<div class="content">
							<!-- Chart -->
							<div class="chart">
								<canvas id="chart" width="100" height="45"></canvas>
							</div>
						</div>
					</div>
					<!-- Dashboard Box / End -->
				</div>
				<div class="col-xl-4">

					<!-- Dashboard Box -->
					<!-- If you want adjust height of two boxes 
						 add to the lower box 'main-box-in-row' 
						 and 'child-box-in-row' to the higher box -->
					<div class="dashboard-box child-box-in-row"> 
						<div class="headline">
							<h3><i class="icon-material-outline-note-add"></i> Notes</h3>
						</div>	

						<div class="content with-padding">
							<!-- Note -->
							<div class="dashboard-note">
								<p>Meeting with candidate at 3pm who applied for Bilingual Event Support Specialist</p>
								<div class="note-footer">
									<span class="note-priority high">High Priority</span>
									<div class="note-buttons">
										<a href="#" title="Edit" data-tippy-placement="top"><i class="icon-feather-edit"></i></a>
										<a href="#" title="Remove" data-tippy-placement="top"><i class="icon-feather-trash-2"></i></a>
									</div>
								</div>
							</div>
							<!-- Note -->
							<div class="dashboard-note">
								<p>Extend premium plan for next month</p>
								<div class="note-footer">
									<span class="note-priority low">Low Priority</span>
									<div class="note-buttons">
										<a href="#" title="Edit" data-tippy-placement="top"><i class="icon-feather-edit"></i></a>
										<a href="#" title="Remove" data-tippy-placement="top"><i class="icon-feather-trash-2"></i></a>
									</div>
								</div>
							</div>
							<!-- Note -->
							<div class="dashboard-note">
								<p>Send payment to David Peterson</p>
								<div class="note-footer">
									<span class="note-priority medium">Medium Priority</span>
									<div class="note-buttons">
										<a href="#" title="Edit" data-tippy-placement="top"><i class="icon-feather-edit"></i></a>
										<a href="#" title="Remove" data-tippy-placement="top"><i class="icon-feather-trash-2"></i></a>
									</div>
								</div>
							</div>
						</div>
							<div class="add-note-button">
								<a href="#small-dialog" class="popup-with-zoom-anim button full-width button-sliding-icon">Add Note <i class="icon-material-outline-arrow-right-alt"></i></a>
							</div>
					</div>
					<!-- Dashboard Box / End -->
				</div>
			</div>
			<!-- Row / End -->

			<!-- Row -->
			<?php //get_template_part( 'template_dashboard/notifications'); ?>
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