<div class="dashboard-nav">
					<div class="dashboard-nav-inner">

						<ul data-submenu-title="Start">
							<li><a href="<?php echo home_url('dashboard');?>"><i class="icon-material-outline-dashboard"></i> Dashboard</a></li>
							<li><a href="#"><i class="icon-material-outline-question-answer"></i> Messages <!--<span class="nav-tag">2</span> --></a></li>
							<li><a href="#"><i class="icon-material-outline-star-border"></i> Bookmarks</a></li>
							<li><a href="#"><i class="icon-material-outline-rate-review"></i> Reviews</a></li>
						</ul>
						
						<ul data-submenu-title="Organize and Manage">
							<li><a href="#"><i class="icon-material-outline-business-center"></i> Jobs</a>
								<!-- <ul>
									<li><a href="#">Manage Jobs <span class="nav-tag">3</span></a></li>
									<li><a href="#">Manage Candidates</a></li>
									<li><a href="#">Post a Job</a></li>
								</ul>	 -->
							</li>
							<li><a href="#"><i class="icon-material-outline-assignment"></i> Tasks</a>
								<!-- <ul>
									<li><a href="#">Manage Tasks <span class="nav-tag">2</span></a></li>
									<li><a href="#">Manage Bidders</a></li>
									<li><a href="#">My Active Bids <span class="nav-tag">4</span></a></li>
									<li><a href="#">Post a Task</a></li>
								</ul>	 -->
							</li>
						</ul>

						<ul data-submenu-title="Account">
							<li class="active"><a href="<?php echo home_url('dashboard-setting');?>"><i class="icon-material-outline-settings"></i> Settings</a></li>
							<li><a href="<?php echo wp_logout_url();?>"><i class="icon-material-outline-power-settings-new"></i> Logout</a></li>
						</ul>
						
					</div>
				</div>