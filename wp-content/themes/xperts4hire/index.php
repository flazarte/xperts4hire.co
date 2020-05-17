<?php
/** 
 * Template Name: Default Page 1
 */ 
get_header();
?>


<!-- Intro Banner
================================================== -->
<!-- add class "disable-gradient" to enable consistent background overlay -->
<div class="intro-banner" data-background-image="<?php bloginfo('stylesheet_directory');?>/images/home-background.jpg">
	<div class="container">
		
		<!-- Intro Headline -->
		<div class="row">
			<div class="col-md-12">
				<div class="banner-headline">
					<h3>
						<strong>Hire experts or be hired for any job, any time.</strong>
						<br>
						<span>Thousands of small businesses use <strong class="color">Xperts4Hire</strong> to turn their ideas into reality.</span>
					</h3>
				</div>
			</div>
		</div>
		
		<!-- Search Bar -->
		<div class="row">
			<div class="col-md-12">
				<div class="intro-banner-search-form margin-top-95">

					<!-- Search Field -->
					<div class="intro-search-field with-autocomplete">
						<label for="autocomplete-input" class="field-title ripple-effect">Where?</label>
						<div class="input-with-icon">
							<input id="autocomplete-input" type="text" placeholder="Online Job">
							<i class="icon-material-outline-location-on"></i>
						</div>
					</div>

					<!-- Search Field -->
					<div class="intro-search-field">
						<label for ="intro-keywords" class="field-title ripple-effect">What job you want?</label>
						<input id="intro-keywords" type="text" placeholder="Job Title or Keywords">
					</div>

					<!-- Button -->
					<div class="intro-search-button">
						<button class="button ripple-effect" onclick="window.location.href='jobs-list-layout-full-page-map.html'">Search</button>
					</div>
				</div>
			</div>
		</div>

		<!-- Stats -->
		<div class="row">
			<div class="col-md-12">
				<ul class="intro-stats margin-top-45 hide-under-992px">
					<li>
						<strong class="counter">1,586</strong>
						<span>Jobs Posted</span>
					</li>
					<li>
						<strong class="counter">3,543</strong>
						<span>Tasks Posted</span>
					</li>
					<li>
						<strong class="counter">1,232</strong>
						<span>Freelancers</span>
					</li>
				</ul>
			</div>
		</div>

	</div>
</div>


<!-- Content
================================================== -->
<!-- Category Boxes -->
<?php get_template_part( 'template_index/categories'); ?>
<!-- Category Boxes / End -->


<!-- Features Jobs -->
<?php get_template_part( 'template_index/jobs'); ?>
<!-- Featured Jobs / End -->


<!-- Features Cities -->
<?php get_template_part( 'template_index/location'); ?>
<!-- Features Cities / End -->

<!-- Info section -->
<?php get_template_part( 'template_index/photo-section'); ?>
<!-- Info section / End -->


<!-- Highest Rated Freelancers -->
<?php get_template_part( 'template_index/freelancers'); ?>
<!-- Highest Rated Freelancers / End-->

<!-- Recent Blog Posts -->
<?php get_template_part( 'template_index/blog'); ?>
<!-- Recent Blog Posts / END -->

<!-- Membership Plans -->
<?php //get_template_part( 'template_index/membership'); ?>
<!-- Membership Plans / End-->

<!-- Companies -->
<?php get_template_part( 'template_index/company-logo'); ?>
<!-- Companies / End-->

<?php
get_footer();