<?php
/** 
 * Template Name: Contact Page Template
 */ 
get_header();
$class = new xperts4Hire();
?>
<!-- Titlebar
================================================== -->
<div id="titlebar" class="gradient">
	<div class="container">
		<div class="row">
			<div class="col-md-12">

				<h2>Contact</h2>

				<!-- Breadcrumbs -->
				<nav id="breadcrumbs" class="dark">
					<ul>
						<li><a href="#">Home</a></li>
						<li><a href="#">Pages</a></li>
						<li>Contact</li>
					</ul>
				</nav>

			</div>
		</div>
	</div>
</div>


<!-- Content
================================================== -->


<!-- Container -->
<div class="container">
	<div class="row">

		<div class="col-xl-12">
			<div class="contact-location-info margin-bottom-50">
				<div class="contact-address">
					<ul>
						<li class="contact-address-headline">Our Office</li>
						<li>CJA Building B5-G L2 Bach St. Jade Ave. Jade Heights Tunasan,Muntinlupa,1773</li>
						<li>Phone (283) 726294</li>
						<li><a href="#">info@xperts4hire.co</a></li>
						<li>
							<div class="freelancer-socials">
								<ul>
									<li><a href="#" title="Dribbble" data-tippy-placement="top"><i class="icon-brand-dribbble"></i></a></li>
									<li><a href="#" title="Twitter" data-tippy-placement="top"><i class="icon-brand-twitter"></i></a></li>
									<li><a href="#" title="Behance" data-tippy-placement="top"><i class="icon-brand-behance"></i></a></li>
									<li><a href="#" title="GitHub" data-tippy-placement="top"><i class="icon-brand-github"></i></a></li>
								
								</ul>
							</div>
						</li>
					</ul>

				</div>
				<div id="single-job-map-container">
					<div id="singleListingMap" data-latitude="37.777842" data-longitude="-122.391805" data-map-icon="im im-icon-Hamburger"></div>
					<a href="#" id="streetView">Street View</a>
				</div>
			</div>
		</div>

		<div class="col-xl-8 col-lg-8 offset-xl-2 offset-lg-2">

			<section id="contact" class="margin-bottom-60">
				<h3 class="headline margin-top-15 margin-bottom-35">Any questions? Feel free to contact us!</h3>

				<form method="post" name="contactform" id="contactform" autocomplete="on">
					<div class="row">
						<div class="col-md-6">
							<div class="input-with-icon-left">
								<input class="with-border" name="name" type="text" id="name" placeholder="Your Name" required="required" />
								<i class="icon-material-outline-account-circle"></i>
							</div>
						</div>

						<div class="col-md-6">
							<div class="input-with-icon-left">
								<input class="with-border" name="email" type="email" id="email" placeholder="Email Address" pattern="^[A-Za-z0-9](([_\.\-]?[a-zA-Z0-9]+)*)@([A-Za-z0-9]+)(([\.\-]?[a-zA-Z0-9]+)*)\.([A-Za-z]{2,})$" required="required" />
								<i class="icon-material-outline-email"></i>
							</div>
						</div>
					</div>

					<div class="input-with-icon-left">
						<input class="with-border" name="subject" type="text" id="subject" placeholder="Subject" required="required" />
						<i class="icon-material-outline-assignment"></i>
					</div>

					<div>
						<textarea class="with-border" name="comments" cols="40" rows="5" id="comments" placeholder="Message" spellcheck="true" required="required"></textarea>
					</div>

					<input type="submit" class="submit button margin-top-15" id="submit" value="Submit Message" />

				</form>
			</section>

		</div>

	</div>
</div>
<!-- Container / End -->
<?php
get_footer();