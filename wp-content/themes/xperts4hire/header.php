<!doctype html>
<html lang="<?php language_attributes(); ?>">
<head>
<!-- Basic Page Needs
================================================== -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<?php wp_head(); ?>
</head>
<body>
<!-- Wrapper -->
<div id="wrapper">

<!-- Header Container
================================================== -->
<header id="header-container" class="fullwidth">

	<!-- Header -->
	<div id="header">
		<div class="container">
			
			<!-- Left Side Content -->
			<div class="left-side">
				
				<!-- Logo -->
				<div id="logo">
					<a href="<?php echo home_url();?>">
						<img src="<?php bloginfo('stylesheet_directory');?>/images/logo/cover.png" alt="xperts4hire.co">
					</a>
				</div>

				<!-- Main Navigation -->
				<nav id="navigation">
					<ul id="responsive">

						<li><a href="<?php echo home_url();?>" <?php echo is_active();?>>Home</a>
						</li>

						<li><a href="#">Find Work</a>
							<ul class="dropdown-nav">
								<li><a href="#">Browse Jobs</a>
									<ul class="dropdown-nav">
										<!-- <li><a href="<?php //echo home_url('job-list-map');?>">Search + Map</a></li> -->
										<!-- <li><a href="<?php //echo home_url('job-listing');?>">Search List</a></li> -->
									</ul>
								</li>
								<!-- <li><a href="#">Browse Tasks</a>
									<ul class="dropdown-nav">
										<li><a href="tasks-list-layout-1.html">List Layout 1</a></li>
										<li><a href="tasks-list-layout-2.html">List Layout 2</a></li>
										<li><a href="tasks-grid-layout.html">Grid Layout</a></li>
										<li><a href="tasks-grid-layout-full-page.html">Full Page Grid</a></li>
									</ul>
								</li> -->
								<!-- <li><a href="<?php //echo home_url('browse-companies');?>">Browse Companies</a></li>
								<li><a href="single-job-page.html">Job Page</a></li>
								<li><a href="single-task-page.html">Task Page</a></li>
								<li><a href="single-company-profile.html">Company Profile</a></li> -->
							</ul>
						</li>

						<li><a href="#">For Employers</a>
							<ul class="dropdown-nav">
								<li><a href="#">Find a Freelancer</a>
									<ul class="dropdown-nav">
										<!-- <li><a href="<?php //echo home_url('freelancer-profile');?>">List of Freelancers</a></li> -->
									</ul>
								</li>
								<!-- <li><a href="single-freelancer-profile.html">Freelancer Profile</a></li>
								<li><a href="dashboard-post-a-job.html">Post a Job</a></li>
								<li><a href="dashboard-post-a-task.html">Post a Task</a></li> -->
							</ul>
						</li>

						<!-- <li><a href="#">Dashboard</a>
							<ul class="dropdown-nav">
								<li><a href="dashboard.html">Dashboard</a></li>
								<li><a href="dashboard-messages.html">Messages</a></li>
								<li><a href="dashboard-bookmarks.html">Bookmarks</a></li>
								<li><a href="dashboard-reviews.html">Reviews</a></li>
								<li><a href="dashboard-manage-jobs.html">Jobs</a>
									<ul class="dropdown-nav">
										<li><a href="dashboard-manage-jobs.html">Manage Jobs</a></li>
										<li><a href="dashboard-manage-candidates.html">Manage Candidates</a></li>
										<li><a href="dashboard-post-a-job.html">Post a Job</a></li>
									</ul>
								</li>
								<li><a href="dashboard-manage-tasks.html">Tasks</a>
									<ul class="dropdown-nav">
										<li><a href="dashboard-manage-tasks.html">Manage Tasks</a></li>
										<li><a href="dashboard-manage-bidders.html">Manage Bidders</a></li>
										<li><a href="dashboard-my-active-bids.html">My Active Bids</a></li>
										<li><a href="dashboard-post-a-task.html">Post a Task</a></li>
									</ul>
								</li>
								<li><a href="dashboard-settings.html">Settings</a></li>
							</ul>
						</li> -->

						<li><a href="#">Pages</a>
							<ul class="dropdown-nav">
							    <?php if( !is_user_logged_in()) :?>
								<li><a href="<?php echo home_url('login');?>">Login</a></li>
								<li><a href="<?php echo home_url('register');?>">Register</a></li>
								<?php endif;?>
								<li><a href="<?php echo home_url('blog');?>">Blog</a></li>
								<li><a href="<?php echo home_url('contact');?>">Contact</a></li>
							</ul>
						</li>

					</ul>
				</nav>
				<div class="clearfix"></div>
				<!-- Main Navigation / End -->
				
			</div>
			<!-- Left Side Content / End -->


			<!-- Right Side Content / End -->
			<?php 
		    $header = _logout_header();
			echo $header;		
			?>
			<!-- Right Side Content / End -->

		</div>
	</div>
	<!-- Header / End -->

</header>
<div class="clearfix"></div>
<!-- Header Container / End -->