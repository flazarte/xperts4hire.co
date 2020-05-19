<?php
/** 
 * Template Name: Job Listing + Street Map
 */ 
get_header();
$class = new xperts4Hire();
?>
<!-- Page Content
================================================== -->
<div class="full-page-container with-map">

    <div class="full-page-sidebar hidden-sidebar">
        <div class="full-page-sidebar-inner" data-simplebar>

            <div class="sidebar-container">
                <!-- Keywords -->
                <div class="sidebar-widget">
                    <h3>Keywords</h3>
                    <div class="keywords-container">
                        <div class="keyword-input-container">
                            <input type="text" class="keyword-input" placeholder="e.g. job title" />
                            <button class="keyword-input-button ripple-effect"><i
                                    class="icon-material-outline-add"></i></button>
                        </div>
                        <div class="keywords-list">
                            <!-- keywords go here -->
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>

                <!-- Category -->
                <div class="sidebar-widget">
                    <h3>Category</h3>
                    <select class="selectpicker default" multiple data-selected-text-format="count" data-size="7"
                        title="All Categories">
                        <option>Admin Support</option>
                        <option>Customer Service</option>
                        <option>Data Analytics</option>
                        <option>Design & Creative</option>
                        <option>Legal</option>
                        <option>Software Developing</option>
                        <option>IT & Networking</option>
                        <option>Writing</option>
                        <option>Translation</option>
                        <option>Sales & Marketing</option>
                    </select>
                </div>

                <!-- Job Types -->
                <div class="sidebar-widget">
                    <h3>Job Type</h3>

                    <div class="switches-list">
                        <div class="switch-container">
                            <label class="switch"><input type="checkbox"><span class="switch-button"></span>
                                Freelance</label>
                        </div>

                        <div class="switch-container">
                            <label class="switch"><input type="checkbox"><span class="switch-button"></span> Full
                                Time</label>
                        </div>

                        <div class="switch-container">
                            <label class="switch"><input type="checkbox"><span class="switch-button"></span> Part
                                Time</label>
                        </div>

                        <div class="switch-container">
                            <label class="switch"><input type="checkbox"><span class="switch-button"></span>
                                Internship</label>
                        </div>
                        <div class="switch-container">
                            <label class="switch"><input type="checkbox"><span class="switch-button"></span>
                                Temporary</label>
                        </div>
                    </div>

                </div>

                <!-- Salary -->
                <div class="sidebar-widget">
                    <h3>Salary</h3>
                    <div class="margin-top-55"></div>

                    <!-- Range Slider -->
                    <input class="range-slider" type="text" value="" data-slider-currency="$" data-slider-min="1500"
                        data-slider-max="15000" data-slider-step="100" data-slider-value="[1500,15000]" />
                </div>

                <!-- Tags -->
                <div class="sidebar-widget">
                    <h3>Tags</h3>

                    <div class="tags-container">
                        <div class="tag">
                            <input type="checkbox" id="tag1" />
                            <label for="tag1">front-end dev</label>
                        </div>
                        <div class="tag">
                            <input type="checkbox" id="tag2" />
                            <label for="tag2">angular</label>
                        </div>
                        <div class="tag">
                            <input type="checkbox" id="tag3" />
                            <label for="tag3">react</label>
                        </div>
                        <div class="tag">
                            <input type="checkbox" id="tag4" />
                            <label for="tag4">vue js</label>
                        </div>
                        <div class="tag">
                            <input type="checkbox" id="tag5" />
                            <label for="tag5">web apps</label>
                        </div>
                        <div class="tag">
                            <input type="checkbox" id="tag6" />
                            <label for="tag6">design</label>
                        </div>
                        <div class="tag">
                            <input type="checkbox" id="tag7" />
                            <label for="tag7">wordpress</label>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>

            </div>
            <!-- Sidebar Container / End -->

            <!-- Search Button -->
            <div class="sidebar-search-button-container">
                <button class="button ripple-effect">Search</button>
            </div>
            <!-- Search Button / End-->

        </div>
    </div>
    <!-- Full Page Sidebar / End -->


    <!-- Full Page Content -->
    <div class="full-page-content-container" data-simplebar>
        <div class="full-page-content-inner">

            <h3 class="page-title">Search Results</h3>

            <div class="notify-box margin-top-15">
                <div class="switch-container">
                    <label class="switch"><input type="checkbox"><span class="switch-button"></span><span
                            class="switch-text">Turn on email alerts for this search</span></label>
                </div>

                <div class="sort-by">
                    <span>Sort by:</span>
                    <select class="selectpicker hide-tick">
                        <option>Relevance</option>
                        <option>Newest</option>
                        <option>Oldest</option>
                        <option>Random</option>
                    </select>
                </div>
            </div>

            <div class="listings-container grid-layout margin-top-35">
                <?php 
                 $data_listing = $class->jobs_listing(0);
                 foreach($data_listing as $key => $job){
                ?>
                <!-- Job Listing -->
                <a href="single-job-page.html" class="job-listing">

                    <!-- Job Listing Details -->
                    <div class="job-listing-details">
                        <!-- Logo -->
                        <div class="job-listing-company-logo">
                        <?php sjb_the_company_logo('thumbnail', '', '', $job['id']);?>
                        </div>

                        <!-- Details -->
                        <div class="job-listing-description">
                            <h4 class="job-listing-company"><?php echo $job['company_name'];?><span class="verified-badge"
                                    title="Verified Employer" data-tippy-placement="top"></span></h4>
                            <h3 class="job-listing-title"><?php echo $job['title'];?></h3>
                        </div>
                    </div>

                    <!-- Job Listing Footer -->
                    <div class="job-listing-footer">
                        <span class="bookmark-icon"></span>
                        <ul>
                            <li><i class="icon-material-outline-location-on"></i><?php echo $job['location'];?></li>
                            <li><i class="icon-material-outline-business-center"></i><?php echo $job['type'];?></li>
                            <li><i class="icon-material-outline-account-balance-wallet"></i> $35000-$38000</li>
                            <li><i class="icon-material-outline-access-time"></i><?php echo $job['post_date'];?></li>
                        </ul>
                    </div>
                </a>

                <?php }
                
                ?>
            </div>

            <!-- Pagination -->
            <div class="clearfix"></div>
            <div class="pagination-container margin-top-20 margin-bottom-20">
                <nav class="pagination">
                    <ul>
                        <li class="pagination-arrow"><a href="#" class="ripple-effect"><i
                                    class="icon-material-outline-keyboard-arrow-left"></i></a></li>
                        <li><a href="#" class="ripple-effect">1</a></li>
                        <li><a href="#" class="ripple-effect current-page">2</a></li>
                        <li><a href="#" class="ripple-effect">3</a></li>
                        <li><a href="#" class="ripple-effect">4</a></li>
                        <li class="pagination-arrow"><a href="#" class="ripple-effect"><i
                                    class="icon-material-outline-keyboard-arrow-right"></i></a></li>
                    </ul>
                </nav>
            </div>
            <div class="clearfix"></div>
            <!-- Pagination / End -->

        </div>
    </div>
    <!-- Full Page Content / End -->


    <!-- Full Page Map -->
    <div class="full-page-map-container">

        <!-- Enable Filters Button -->
        <div class="filter-button-container">
            <button class="enable-filters-button">
                <i class="enable-filters-button-icon"></i>
                <span class="show-text">Show Filters</span>
                <span class="hide-text">Hide Filters</span>
            </button>
            <div class="filter-button-tooltip">Click to expand sidebar with filters!</div>
        </div>

        <!-- Map -->
        <div id="map" data-map-zoom="12" data-map-scroll="true"></div>
    </div>
    <!-- Full Page Map / End -->

</div>


</div>
<!-- Wrapper / End -->
<?php
get_footer();