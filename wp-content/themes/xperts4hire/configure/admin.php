<?php

class xperts4Hire{

    public function xperts_users($id){
        $result     = [];
        $user_data  = get_userdata( $id );
        $data_user  = get_user_meta( $id );
        $position   = (!empty($data_user['user-position'][0])) ? $data_user['user-position'][0] : '';
        $url        = esc_url( get_avatar_url( $id ) );
        $flags      = (!empty($data_user['country'][0])) ? $data_user['country'][0] : 'ph';
        $rate       = (!empty($data_user['hourly_rate'][0])) ? $data_user['hourly_rate'][0] : 0;
        $resume     = (!empty($data_user['resume__cv'][0])) ? $data_user['resume__cv'][0] : '';
        $cover      = (!empty($data_user['cover_letter'][0])) ? $data_user['cover_letter'][0] : '';
        $user_page  = get_author_posts_url($id);
        $country    = user_country();
            foreach($country as $key => $name){
                if($key == $flags){
                    $country_name =  $name;
                }
            }
        $result = json_encode([
            'id'            => $id,
            'image_url'     => $url,
            'display_name'  => $user_data->data->display_name,
            'position'      => $position,
            'country_name'  => $country_name,
            'country_abbr'  => $flags,
            'flag_url'      => '/images/flags/'.$flags.'.'.'svg',
            'status'        => $data_user['account_status'][0],
            'description'   => $data_user['description'][0],
            'rate'          => $rate,
            'resume_cv'     => $resume,
            'cover_letter'  => $cover,
            'user_url'      => $user_page,
            'role'          => $user_data->roles[0],
            'nice_name'     => $data_user['nickname'][0],
            'first_name'    => $data_user['first_name'][0],
            'last_name'     => $data_user['last_name'][0],
            'email'         => $user_data->data->user_email,
        ]);

    return $result;
    }

    public function jobs_listing($post_per_page){
        $args = [
            'post_type'      => 'jobpost',
            'posts_per_page' => $post_per_page,
        ];
        $job_post            = get_posts($args);
        $result              = [];
        foreach($job_post as $key => $job){
            $job_type         = sjb_get_the_job_type($job->ID);
            $job_location     = sjb_get_the_job_location($job->ID);
            $job_posting_time = get_post_time('j F Y','true',$job->ID,'false');
            //$company_logo     = sjb_the_company_logo('thumbnail', '', '', $job->ID);
            $company_name     = sjb_get_the_company_name($job->ID);
            $id               = $job->ID;

            $result[] = [
                'id'           => $id,
                'company_name' => $company_name,
                'title'        => $job->post_title,
                'location'     => $job_location[0]->name,
                'type'         => $job_type[0]->name,
                'post_date'    => $job_posting_time,
            ];
        }
    return $result;
    }

    public function xperts_employers($id){
        $result     = [];
        $user_data  = get_userdata( $id );
        $data_user  = get_user_meta( $id );
        $url        = esc_url( get_avatar_url( $id ) );
        $flags      = (!empty($data_user['country'][0])) ? $data_user['country'][0] : 'ph';
        $user_page  = get_author_posts_url($id);
        $country    = user_country();
            foreach($country as $key => $name){
                if($key == $flags){
                    $country_name =  $name;
                }
            }
        $result = json_encode([
            'id'            => $id,
            'image_url'     => $url,
            'display_name'  => $user_data->data->display_name,
            'country_name'  => $country_name,
            'country_abbr'  => $flags,
            'flag_url'      => '/images/flags/'.$flags.'.'.'svg',
            'status'        => $data_user['account_status'][0],
            'description'   => $data_user['description'][0],
            'user_url'      => $user_page,
            'role'          => $user_data->roles[0],
            'nice_name'     => $data_user['nickname'][0],
        ]);
        
    return $result;
    }
}

function _loginPopUp(){
    if(!is_user_logged_in()) {
    ?>
<div id="sign-in-dialog" class="zoom-anim-dialog mfp-hide dialog-with-tabs">

    <!--Tabs -->
    <div class="sign-in-form">

        <ul class="popup-tabs-nav">
            <li><a href="#login">Log In</a></li>
            <li><a href="#register">Register</a></li>
        </ul>

        <div class="popup-tabs-container">

            <!-- Login -->
            <div class="popup-tab-content" id="login">

                <!-- Welcome Text -->
                <div class="welcome-text">
                    <h3>We re glad to see you again!</h3>
                    <span>Don t have an account? <a href="#" class="register-tab">Sign Up!</a></span>
                </div>

                <!-- Form -->
                <form method="post" action="<?php echo home_url('login');?>" id="login-form">
                    <div class="input-with-icon-left">
                        <i class="icon-material-baseline-mail-outline"></i>
                        <input type="text" class="input-text with-border" name="user_login" id="user_login"
                            placeholder="Email Address" required />
                    </div>

                    <div class="input-with-icon-left">
                        <i class="icon-material-outline-lock"></i>
                        <input type="password" class="input-text with-border" name="user_password" id="user_password"
                            placeholder="Password" required />
                    </div>
                    <a href="#" class="forgot-password">Forgot Password?</a>
                </form>

                <!-- Button -->
                <button class="button full-width button-sliding-icon ripple-effect" type="submit" form="login-form" name="login_Sbumit" id="login_Sbumit">Log
                    In <i class="icon-material-outline-arrow-right-alt"></i></button>

                <!-- Social Login -->
                <div class="social-login-separator"><span>or</span></div>
                <div class="social-login-buttons">
                    <button class="facebook-login ripple-effect"><i class="icon-brand-facebook-f"></i> Log In via
                        Facebook</button>
                    <button class="google-login ripple-effect"><i class="icon-brand-google-plus-g"></i> Log In via
                        Google+</button>
                </div>

            </div>

            <!-- Register -->
            <div class="popup-tab-content" id="register">

                <!-- Welcome Text -->
                <div class="welcome-text">
                    <h3>Let s create your account!</h3>
                </div>

                <!-- Account Type -->
                <div class="account-type">
                    <div>
                        <input type="radio" name="account-type-radio" id="freelancer-radio" class="account-type-radio"
                            checked />
                        <label for="freelancer-radio" class="ripple-effect-dark"><i
                                class="icon-material-outline-account-circle"></i> Freelancer</label>
                    </div>

                    <div>
                        <input type="radio" name="account-type-radio" id="employer-radio" class="account-type-radio" />
                        <label for="employer-radio" class="ripple-effect-dark"><i
                                class="icon-material-outline-business-center"></i> Employer</label>
                    </div>
                </div>

                <!-- Form -->
                <form method="post" id="register-account-form">
                    <div class="input-with-icon-left">
                        <i class="icon-material-baseline-mail-outline"></i>
                        <input type="text" class="input-text with-border" name="emailaddress-register"
                            id="emailaddress-register" placeholder="Email Address" required />
                    </div>

                    <div class="input-with-icon-left" title="Should be at least 8 characters long"
                        data-tippy-placement="bottom">
                        <i class="icon-material-outline-lock"></i>
                        <input type="password" class="input-text with-border" name="password-register"
                            id="password-register" placeholder="Password" required />
                    </div>

                    <div class="input-with-icon-left">
                        <i class="icon-material-outline-lock"></i>
                        <input type="password" class="input-text with-border" name="password-repeat-register"
                            id="password-repeat-register" placeholder="Repeat Password" required />
                    </div>
                </form>

                <!-- Button -->
                <button class="margin-top-10 button full-width button-sliding-icon ripple-effect" type="submit"
                    form="register-account-form">Register <i class="icon-material-outline-arrow-right-alt"></i></button>

                <!-- Social Login -->
                <div class="social-login-separator"><span>or</span></div>
                <div class="social-login-buttons">
                    <button class="facebook-login ripple-effect"><i class="icon-brand-facebook-f"></i> Register via
                        Facebook</button>
                    <button class="google-login ripple-effect"><i class="icon-brand-google-plus-g"></i> Register via
                        Google+</button>
                </div>

            </div>

        </div>
    </div>
</div>
<?php
    }
}

function _logout_header() {

    if(!is_user_logged_in() ) { ?>
<div class="right-side">

    <div class="header-widget">
        <a href="#sign-in-dialog" class="popup-with-zoom-anim log-in-button"><i class="icon-feather-log-in"></i>
            <span>Log In / Register</span></a>
    </div>

    <!-- Mobile Navigation Button -->
    <span class="mmenu-trigger">
        <button class="hamburger hamburger--collapse" type="button">
            <span class="hamburger-box">
                <span class="hamburger-inner"></span>
            </span>
        </button>
    </span>

</div><?php
    }else{?>
<?php 
$handler             = new xperts4Hire(); 
$current_user_id     = get_current_user_id();
$users_data_login    = $handler->xperts_users($current_user_id);
$users_current_data  = json_decode($users_data_login  , true);
?>
<div class="right-side">

    <!--  User Notifications -->
    <div class="header-widget hide-on-mobile">

        <!-- Notifications -->
        <div class="header-notifications">

            <!-- Trigger -->
            <div class="header-notifications-trigger">
                <a href="#"><i class="icon-feather-bell"></i><span>4</span></a>
            </div>

            <!-- Dropdown -->
            <div class="header-notifications-dropdown">

                <div class="header-notifications-headline">
                    <h4>Notifications</h4>
                    <button class="mark-as-read ripple-effect-dark" title="Mark all as read"
                        data-tippy-placement="left">
                        <i class="icon-feather-check-square"></i>
                    </button>
                </div>

                <div class="header-notifications-content">
                    <div class="header-notifications-scroll" data-simplebar>
                        <ul>
                            <!-- Notification -->
                            <li class="notifications-not-read">
                                <a href="dashboard-manage-candidates.html">
                                    <span class="notification-icon"><i class="icon-material-outline-group"></i></span>
                                    <span class="notification-text">
                                        <strong>Michael Shannah</strong> applied for a job <span class="color">Full
                                            Stack Software Engineer</span>
                                    </span>
                                </a>
                            </li>

                            <!-- Notification -->
                            <li>
                                <a href="dashboard-manage-bidders.html">
                                    <span class="notification-icon"><i class=" icon-material-outline-gavel"></i></span>
                                    <span class="notification-text">
                                        <strong>Gilbert Allanis</strong> placed a bid on your <span class="color">iOS
                                            App Development</span> project
                                    </span>
                                </a>
                            </li>

                            <!-- Notification -->
                            <li>
                                <a href="dashboard-manage-jobs.html">
                                    <span class="notification-icon"><i
                                            class="icon-material-outline-autorenew"></i></span>
                                    <span class="notification-text">
                                        Your job listing <span class="color">Full Stack PHP Developer</span> is
                                        expiring.
                                    </span>
                                </a>
                            </li>

                            <!-- Notification -->
                            <li>
                                <a href="dashboard-manage-candidates.html">
                                    <span class="notification-icon"><i class="icon-material-outline-group"></i></span>
                                    <span class="notification-text">
                                        <strong>Sindy Forrest</strong> applied for a job <span class="color">Full Stack
                                            Software Engineer</span>
                                    </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>

        </div>

        <!-- Messages -->
        <div class="header-notifications">
            <div class="header-notifications-trigger">
                <a href="#"><i class="icon-feather-mail"></i><span>3</span></a>
            </div>

            <!-- Dropdown -->
            <div class="header-notifications-dropdown">

                <div class="header-notifications-headline">
                    <h4>Messages</h4>
                    <button class="mark-as-read ripple-effect-dark" title="Mark all as read"
                        data-tippy-placement="left">
                        <i class="icon-feather-check-square"></i>
                    </button>
                </div>

                <div class="header-notifications-content">
                    <div class="header-notifications-scroll" data-simplebar>
                        <ul>
                            <!-- Notification -->
                            <li class="notifications-not-read">
                                <a href="dashboard-messages.html">
                                    <span class="notification-avatar status-online"><img
                                            src="<?php bloginfo('stylesheet_directory');?>/images/user-avatar-small-03.jpg"
                                            alt=""></span>
                                    <div class="notification-text">
                                        <strong>David Peterson</strong>
                                        <p class="notification-msg-text">Thanks for reaching out. I m quite busy right
                                            now on many...</p>
                                        <span class="color">4 hours ago</span>
                                    </div>
                                </a>
                            </li>

                            <!-- Notification -->
                            <li class="notifications-not-read">
                                <a href="dashboard-messages.html">
                                    <span class="notification-avatar status-offline"><img
                                            src="<?php bloginfo('stylesheet_directory');?>/images/user-avatar-small-02.jpg"
                                            alt=""></span>
                                    <div class="notification-text">
                                        <strong>Sindy Forest</strong>
                                        <p class="notification-msg-text">Hi Tom! Hate to break it to you, but I m
                                            actually on vacation until...</p>
                                        <span class="color">Yesterday</span>
                                    </div>
                                </a>
                            </li>

                            <!-- Notification -->
                            <li class="notifications-not-read">
                                <a href="dashboard-messages.html">
                                    <span class="notification-avatar status-online"><img
                                            src="<?php bloginfo('stylesheet_directory');?>/images/user-avatar-placeholder.png"
                                            alt=""></span>
                                    <div class="notification-text">
                                        <strong>Marcin Kowalski</strong>
                                        <p class="notification-msg-text">I received payment. Thanks for cooperation!</p>
                                        <span class="color">Yesterday</span>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                <a href="dashboard-messages.html"
                    class="header-notifications-button ripple-effect button-sliding-icon">View All Messages<i
                        class="icon-material-outline-arrow-right-alt"></i></a>
            </div>
        </div>

    </div>
    <!--  User Notifications / End -->

    <!-- User Menu -->
    <div class="header-widget">

        <!-- Messages -->
        <div class="header-notifications user-menu">
            <div class="header-notifications-trigger">
                <a href="#">
                    <div class="user-avatar status-online"><img
                            src="<?php echo $users_current_data['image_url'];?>" alt="<?php echo $users_current_data['display_name'];?>">
                    </div>
                </a>
            </div>

            <!-- Dropdown -->
            <div class="header-notifications-dropdown">

                <!-- User Status -->
                <div class="user-status">

                    <!-- User Name / Avatar -->
                    <div class="user-details">
                        <div class="user-avatar status-online"><img
                                src="<?php echo $users_current_data['image_url'];?>" alt="<?php echo $users_current_data['display_name'];?>">
                        </div>
                        <div class="user-name">
                        <?php echo $users_current_data['display_name'];?> <span><?php echo ucfirst($users_current_data['role']);?></span>
                        </div>
                    </div>

                    <!-- User Status Switcher -->
                    <div class="status-switch" id="snackbar-user-status">
                        <label class="user-online current-status">Online</label>
                        <label class="user-invisible">Invisible</label>
                        <!-- Status Indicator -->
                        <span class="status-indicator" aria-hidden="true"></span>
                    </div>
                </div>

                <ul class="user-menu-small-nav">
                    <li><a href="<?php echo home_url('profile');?>"><i class="icon-material-outline-account-circle"></i>View Profile</a></li>
                    <li><a href="<?php echo home_url('dashboard');?>"><i class="icon-material-outline-dashboard"></i> Dashboard</a></li>
                    <li><a href="<?php echo home_url('dashboard-setting');?>"><i class="icon-material-outline-settings"></i> Settings</a>
                    </li>
                    <li><a href="<?php echo wp_logout_url();?>"><i class="icon-material-outline-power-settings-new"></i>
                            Logout</a></li>
                </ul>

            </div>
        </div>

    </div>
    <!-- User Menu / End -->

    <!-- Mobile Navigation Button -->
    <span class="mmenu-trigger">
        <button class="hamburger hamburger--collapse" type="button">
            <span class="hamburger-box">
                <span class="hamburger-inner"></span>
            </span>
        </button>
    </span>

</div>

<?php }

}

// //required featured image
// function featured_image_requirement() {

//     if(!has_post_thumbnail()) {

//          wp_die( 'You forgot to set the featured image. Click the back button on your browser and set it.' ); 

//     } 

// }

// add_action( 'pre_post_update', 'featured_image_requirement' );

//country abbreviations for flags selection
function user_country(){
$country = [
'ac' => 'Ascension Island',
'ad' => 'Andorra',
'ae' => 'United Arab Emirates',
'af' => 'Afghanistan',
'ag' => 'Antigua And Barbuda',
'ai' => 'Anguilla',
'al' => 'Albania',
'am' => 'Armenia',
'an' => 'Netherlands Antilles',
'ao' => 'Angola',
'aq' => 'Antarctica',
'ar' => 'Argentina',
'as' => 'American Samoa',
'at' => 'Austria',
'au' => 'Australia',
'aw' => 'Aruba',
'ax' => 'Åland',
'az' => 'Azerbaijan',
'ba' => 'Bosnia And Herzegovina',
'bb' => 'Barbados',
'be' => 'Belgium',
'bd' => 'Bangladesh',
'bf' => 'Burkina Faso',
'bg' => 'Bulgaria',
'bh' => 'Bahrain',
'bi' => 'Burundi',
'bj' => 'Benin',
'bm' => 'Bermuda',
'bn' => 'Brunei Darussalam',
'bo' => 'Bolivia',
'br' => 'Brazil',
'bs' => 'Bahamas',
'bt' => 'Bhutan',
'bv' => 'Bouvet Island',
'bw' => 'Botswana',
'by' => 'Belarus',
'bz' => 'Belize',
'ca' => 'Canada',
'cc' => 'Cocos (Keeling) Islands',
'cd' => 'Congo (Democratic Republic)',
'cf' => 'Central African Republic',
'cg' => 'Congo (Republic)',
'ch' => 'Switzerland',
'ci' => 'Cote D’Ivoire',
'ck' => 'Cook Islands',
'cl' => 'Chile',
'cm' => 'Cameroon',
'cn' => 'People’s Republic of China',
'co' => 'Colombia',
'cr' => 'Costa Rica',
'cu' => 'Cuba',
'cv' => 'Cape Verde',
'cx' => 'Christmas Island',
'cy' => 'Cyprus',
'cz' => 'Czech Republic',
'de' => 'Germany',
'dj' => 'Djibouti',
'dk' => 'Denmark',
'dm' => 'Dominica',
'do' => 'Dominican Republic',
'dz' => 'Algeria',
'ec' => 'Ecuador',
'ee' => 'Estonia',
'eg' => 'Egypt',
'er' => 'Eritrea',
'es' => 'Spain',
'et' => 'Ethiopia',
'eU' => 'European Union',
'fi' => 'Finland',
'fj' => 'Fiji',
'fk' => 'Falkland Islands (Malvinas)',
'fm' => 'Federated States Of Micronesia',
'fo' => 'Faroe Islands',
'fr' => 'France',
//shortcut
'ph' => 'Philippines',
'us' => 'United States',

		
	

// ga	Gabon
// gb	United Kingdom (no new registrations, see also UK)
// gd	Grenada
// ge	Georgia
// gf	French Guiana
// gg	Guernsey
// gh	Ghana
// gi	Gibraltar
// gl	Greenland
// gm	Gambia
// gn	Guinea
// gp	Guadeloupe
// gq	Equatorial Guinea
// gr	Greece
// gs	South Georgia And The South Sandwich Islands
// gt	Guatemala
// gu	Guam
// gw	Guinea-Bissau
// gy	Guyana
// hk	Hong Kong
// hm	Heard And Mc Donald Islands
// hn	Honduras
// hr	Croatia (local name: Hrvatska)
// ht	Haiti
// hu	Hungary
// id	Indonesia
// ie	Ireland
// il	Israel
// im	Isle of Man
// in	India
// io	British Indian Ocean Territory
// iq	Iraq
// ir	Iran (Islamic Republic Of)
// is	Iceland
// it	Italy
// je	Jersey
// jm	Jamaica
// jo	Jordan
// jp	Japan
// ke	Kenya
// kg	Kyrgyzstan
// kh	Cambodia
// ki	Kiribati
// km	Comoros
// kn	Saint Kitts And Nevis
// kr	Korea, Republic Of
// kw	Kuwait
// ky	Cayman Islands
// kz	Kazakhstan
// la	Lao People’s Democratic Republic
// lb	Lebanon
// lc	Saint Lucia
// li	Liechtenstein
// lk	Sri Lanka
// lr	Liberia
// ls	Lesotho
// lt	Lithuania
// lu	Luxembourg
// lv	Latvia
// ly	Libyan Arab Jamahiriya
// ma	Morocco
// mc	Monaco
// md	Moldova, Republic Of
// me	Montenegro
// mg	Madagascar
// mh	Marshall Islands
// mk	Macedonia, The Former Yugoslav Republic Of
// ml	Mali
// mm	Myanmar
// mn	Mongolia
// mo	Macau
// mp	Northern Mariana Islands
// mq	Martinique
// mr	Mauritania
// ms	Montserrat
// mt	Malta
// mu	Mauritius
// mv	Maldives
// mw	Malawi
// mx	Mexico
// my	Malaysia
// mz	Mozambique
// na	Namibia
// nc	New Caledonia
// ne	Niger
// nf	Norfolk Island
// ng	Nigeria
// ni	Nicaragua
// nl	Netherlands
// no	Norway
// np	Nepal
// nr	Nauru
// nu	Niue
// nz	New Zealand
// om	Oman
// pa	Panama
// pe	Peru
// pf	French Polynesia
// pg	Papua New Guinea
// ph	Philippines, Republic of the
// pk	Pakistan
// pl	Poland
// pm	St. Pierre And Miquelon
// pn	Pitcairn
// pr	Puerto Rico
// ps	Palestine
// pt	Portugal
// pw	Palau
// py	Paraguay
// qa	Qatar
// re	Reunion
// ro	Romania
// rs	Serbia
// ru	Russian Federation
// rw	Rwanda
// sa	Saudi Arabia
// uk	Scotland
// sb	Solomon Islands
// sc	Seychelles
// sd	Sudan
// se	Sweden
// sg	Singapore
// sh	St. Helena
// si	Slovenia
// sj	Svalbard And Jan Mayen Islands
// sk	Slovakia (Slovak Republic)
// sl	Sierra Leone
// sm	San Marino
// sn	Senegal
// so	Somalia
// sr	Suriname
// st	Sao Tome And Principe
// su	Soviet Union
// sv	El Salvador
// sy	Syrian Arab Republic
// sz	Swaziland
// tc	Turks And Caicos Islands
// td	Chad
// tf	French Southern Territories
// tg	Togo
// th	Thailand
// tj	Tajikistan
// tk	Tokelau
// ti	East Timor (new code)
// tm	Turkmenistan
// tn	Tunisia
// to	Tonga
// tp	East Timor (old code)
// tr	Turkey
// tt	Trinidad And Tobago
// tv	Tuvalu
// tw	Taiwan
// tz	Tanzania, United Republic Of
// ua	Ukraine
// ug	Uganda
// uk	United Kingdom
// um	United States Minor Outlying Islands
// us	United States
// uy	Uruguay
// uz	Uzbekistan
// va	Vatican City State (Holy See)
// vc	Saint Vincent And The Grenadines
// ve	Venezuela
// vg	Virgin Islands (British)
// vi	Virgin Islands (U.S.)
// vn	Vietnam
// vu	Vanuatu
// wf	Wallis And Futuna Islands
// ws	Samoa
// ye	Yemen
// yt	Mayotte
// za	South Africa
// zm	Zambia
// zw	Zimbabwe
    ];
return $country;
}

//additional user profile
add_action( 'show_user_profile', 'extra_user_profile_fields' );
add_action( 'edit_user_profile', 'extra_user_profile_fields' );

function extra_user_profile_fields( $user ) { ?>
<h3><?php _e("Extra profile information", "blank"); ?></h3>

<table class="form-table">
    <tr>
        <th><label for="address"><?php _e("Address"); ?></label></th>
        <td>
            <input type="text" name="address" id="address"
                value="<?php echo esc_attr( get_the_author_meta( 'address', $user->ID ) ); ?>"
                class="regular-text" /><br />
            <span class="description"><?php _e("Please enter your address."); ?></span>
        </td>
    </tr>
    <tr>
        <th><label for="city"><?php _e("City"); ?></label></th>
        <td>
            <input type="text" name="city" id="city"
                value="<?php echo esc_attr( get_the_author_meta( 'city', $user->ID ) ); ?>"
                class="regular-text" /><br />
            <span class="description"><?php _e("Please enter your city."); ?></span>
        </td>
    </tr>
    <tr>
        <th><label for="postalcode"><?php _e("Postal Code"); ?></label></th>
        <td>
            <input type="text" name="postalcode" id="postalcode"
                value="<?php echo esc_attr( get_the_author_meta( 'postalcode', $user->ID ) ); ?>"
                class="regular-text" /><br />
            <span class="description"><?php _e("Please enter your postal code."); ?></span>
        </td>
    </tr>
    <tr>
        <th><label for="country"><?php _e("Country"); ?></label></th>
        <td>
            <select name="country" id="country" class="regular-text" value="<?php echo $default_value = esc_attr( get_the_author_meta( 'country', $user->ID ) ); ?>">
                <option value="">Select</option>
                <?php
                  //kunin natin country
                    $country = user_country();
                    foreach($country as $key => $name){
                        //set value if already set
                        $selected = ($default_value == $key) ? 'selected' : '';                                  
                         echo '<option value="'.$key.'" '.$selected.'>'. $name.'</option>';

                     }
                    ?>
            </select>
        </td>
    </tr>
</table>
<?php }

add_action( 'personal_options_update', 'save_extra_user_profile_fields' );
add_action( 'edit_user_profile_update', 'save_extra_user_profile_fields' );

function save_extra_user_profile_fields( $user_id ) {
    if ( !current_user_can( 'edit_user', $user_id ) ) { 
        return false; 
    }
    update_user_meta( $user_id, 'address', $_POST['address'] );
    update_user_meta( $user_id, 'city', $_POST['city'] );
    update_user_meta( $user_id, 'postalcode', $_POST['postalcode'] );
    update_user_meta( $user_id, 'country', $_POST['country'] );
}

function _make_offer(){
    if(is_page('profile')){
        ?>
        <!-- Make an Offer Popup
================================================== -->
<div id="small-dialog" class="zoom-anim-dialog mfp-hide dialog-with-tabs">

<!--Tabs -->
<div class="sign-in-form">

    <ul class="popup-tabs-nav">
        <li><a href="#tab">Make an Offer</a></li>
    </ul>

    <div class="popup-tabs-container">

        <!-- Tab -->
        <div class="popup-tab-content" id="tab">
            
            <!-- Welcome Text -->
            <div class="welcome-text">
                <h3>Discuss your project with David</h3>
            </div>
                
            <!-- Form -->
            <form method="post">

                <div class="input-with-icon-left">
                    <i class="icon-material-outline-account-circle"></i>
                    <input type="text" class="input-text with-border" name="name" id="name" placeholder="First and Last Name"/>
                </div>

                <div class="input-with-icon-left">
                    <i class="icon-material-baseline-mail-outline"></i>
                    <input type="text" class="input-text with-border" name="emailaddress" id="emailaddress" placeholder="Email Address"/>
                </div>

                <textarea name="textarea" cols="10" placeholder="Message" class="with-border"></textarea>

                <div class="uploadButton margin-top-25">
                    <input class="uploadButton-input" type="file" accept="image/*, application/pdf" id="upload" multiple/>
                    <label class="uploadButton-button ripple-effect" for="upload">Add Attachments</label>
                    <span class="uploadButton-file-name">Allowed file types: zip, pdf, png, jpg <br> Max. files size: 50 MB.</span>
                </div>

            </form>
            
            <!-- Button -->
            <button class="button margin-top-35 full-width button-sliding-icon ripple-effect" type="submit">Make an Offer <i class="icon-material-outline-arrow-right-alt"></i></button>

        </div>
        <!-- Login -->
        <div class="popup-tab-content" id="loginn">
            
            <!-- Welcome Text -->
            <div class="welcome-text">
                <h3>Discuss Your Project With Tom</h3>
            </div>
                
            <!-- Form -->
            <form method="post" id="make-an-offer-form">

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

            </form>
            
            <!-- Button -->
            <button class="button full-width button-sliding-icon ripple-effect" type="submit" form="make-an-offer-form">Make an Offer <i class="icon-material-outline-arrow-right-alt"></i></button>

        </div>

    </div>
</div>
</div>
<!-- Make an Offer Popup / End -->

        <?php
    }
}

function is_active(){
    $attr = '';
    if(is_home() || is_front_page()){
        $attr = 'class="current"';

    }
return $attr;
}

function _add_javascript_register()
	{
		
		  wp_enqueue_script('ajax-script', get_template_directory_uri() . '/configure/register.js', array(), null, true );
		  wp_localize_script( 'ajax-script', 'xperts_register', array( 'ajaxurl' =>   admin_url( 'admin-ajax.php' ) ) );
		
	}
    add_action('wp_enqueue_scripts', '_add_javascript_register', 100);
   
    

function username_check(){
    //real tme validation for username with jquery
    if (isset($_POST)) {
            $username = $_POST['username'];                   
                if(username_exists($username)) {
                    $result =  "taken";	
                }else{
                    $result =  "not_taken";
                }
            echo  $result;
    }
die();
}
add_action( 'wp_ajax_nopriv_username_check', 'username_check' );
add_action( 'wp_ajax_username_check', 'username_check' );

function email_check(){
        //real tme validation for email with jquery
        if (isset($_POST)) {
            $email = $_POST['email'];                   
                if (email_exists($email)) {
                    $result =  "taken";	
                }else{
                    $result =  "not_taken";
                }
            echo  $result;
        }
        die();
}
add_action( 'wp_ajax_nopriv_email_check', 'email_check' );
add_action( 'wp_ajax_email_check', 'email_check' );

//restrict current user to register page
function redirect_register_page() {

    if( is_page( 'register' ) && is_user_logged_in() ) {
        wp_redirect( home_url() );
        exit;
    }

}
add_action( 'template_redirect', 'redirect_register_page' );

function update_account(){
    //registration Query
    if (isset($_POST['update_account'])) {

        if(!empty( $_POST['profile_name'] )){
            update_user_meta( $_POST['user_id'], 'first_name', $_POST['profile_name'] );
        }

        if(!empty( $_POST['last_name'] )){
            update_user_meta( $_POST['user_id'], 'last_name', $_POST['last_name'] );
        }

        if(!empty( $_POST['description'] )){
            update_user_meta( $_POST['user_id'], 'description', $_POST['description'] );
        }

        if(!empty( $_POST['country'] )){
            update_user_meta( $_POST['user_id'], 'country', $_POST['country'] );
        }

        if(!empty( $_POST['rate'] )){
            update_user_meta( $_POST['user_id'], 'hourly_rate', $_POST['rate'] );
        }

        if(!empty( $_POST['position'] )){
            update_user_meta( $_POST['user_id'], 'user-position', $_POST['position'] );
        }

        if(!empty( $_POST['cover_letter'] )){
            $resume_id = my_upload_function(  $_POST['cover_letter'], 0 , false );
            update_user_meta( $_POST['user_id'], 'cover_letter', $resume_id );
        }

        if(!empty( $_POST['resume'] )){
            $resume_id = my_upload_function(  $_POST['resume'], 0 , false );    
            update_user_meta( $_POST['user_id'], 'resume__cv', $resume_id );
        }

        if(!empty( $_POST['skills'] )){
            //update_user_meta( $_POST['user_id'], 'rate', $_POST['rate'] );
        }

        if(!empty( $_POST['address'] )){
            update_user_meta( $_POST['user_id'], 'address', $_POST['address'] );;
        }

        if(!empty( $_POST['city'] )){
            update_user_meta( $_POST['user_id'], 'city', $_POST['city'] );;
        }

        if(!empty( $_POST['postalcode'] )){
            update_user_meta( $_POST['user_id'], 'postalcode', $_POST['postalcode'] );;
        }

     echo  'success';
    }
    die();
}
add_action( 'wp_ajax_nopriv_update_account', 'update_account' );
add_action( 'wp_ajax_update_account', 'update_account' );

function per_user_upload_dir( $original ){
    // use the original array for initial setup
    $modified = $original;
    // set our own replacements
    if ( is_user_logged_in() ) {
        $current_user = wp_get_current_user();
        $subdir = $current_user->user_login;
        $modified['subdir'] = $subdir;
        $modified['url'] = $original['baseurl'] . '/' . $subdir;
        $modified['path'] = $original['basedir'] . DIRECTORY_SEPARATOR . $subdir;
    }
    return $modified;
}
add_filter( 'upload_dir', 'per_user_upload_dir');

function my_upload_function( $file, $post_id = 0 , $set_as_featured = false ) {
    
    $wp_filetype = wp_check_filetype( basename( $file ), null );
   
    $wp_upload_dir = wp_upload_dir();

    $attachment = array(
        'guid' => $file,
        'post_mime_type' => $wp_filetype['type'],
        'post_title' => preg_replace('/\.[^.]+$/', '', basename( $file )),
        'post_content' => '',
        'post_status' => 'inherit'
    );
    $fileName  = $wp_upload_dir['url'].'/'.basename( $file );
    $attach_id = wp_insert_attachment( $attachment, $fileName, $post_id );

    require_once(ABSPATH . 'wp-admin/includes/image.php');

    $attach_data = wp_generate_attachment_metadata( $attach_id, $file );
    wp_update_attachment_metadata( $attach_id, $attach_data );

    if( $set_as_featured == true ) {
        update_post_meta( $post_id, '_thumbnail_id', $attach_id );
    }
return $attach_id;
}

//custom redirect
add_action('wp_logout','ps_redirect_after_logout');
function ps_redirect_after_logout(){
         wp_redirect( home_url('login') );
         exit();
}


// function to geocode address, it will return false if unable to geocode address
function geocode($address){

	$address = urlencode($address);
	
	// google map geocode api url used api key account ferdinandlazarte10@gmail.com xperts4hire project
	$url = "https://maps.googleapis.com/maps/api/geocode/json?address={$address}&key=AIzaSyDMiEoNc_TxfTfSov0xUy6typg_R8sref0";
   
	// get the json response
	$resp_json = file_get_contents($url);
	$resp = json_decode($resp_json, true);
	if($resp['status']=='OK'){

		$lati = isset($resp['results'][0]['geometry']['location']['lat']) ? $resp['results'][0]['geometry']['location']['lat'] : "";
		$longi = isset($resp['results'][0]['geometry']['location']['lng']) ? $resp['results'][0]['geometry']['location']['lng'] : "";
		$formatted_address = isset($resp['results'][0]['formatted_address']) ? $resp['results'][0]['formatted_address'] : "";
		
		if($lati && $longi && $formatted_address){
	
			$data_arr = array();			
			
			array_push(
				$data_arr, 
					$lati, 
					$longi, 
					$formatted_address
				);
			
			return $data_arr;
			
		}else{
			return false;
		}
		
	}
	else{
		echo "<strong>ERROR: {$resp['status']}</strong>";
		return false;
	}
}

function custom_paginate_links( $args = '' ) {
	global $wp_query, $wp_rewrite;

	// Setting up default values based on the current URL.
	$pagenum_link = html_entity_decode( get_pagenum_link() );
	$url_parts    = explode( '?', $pagenum_link );

	// Get max pages and current page out of the current query, if available.
	$total   = isset( $wp_query->max_num_pages ) ? $wp_query->max_num_pages : 1;
	$current = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;

	// Append the format placeholder to the base URL.
	$pagenum_link = trailingslashit( $url_parts[0] ) . '%_%';

	// URL base depends on permalink settings.
	$format  = $wp_rewrite->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
	$format .= $wp_rewrite->using_permalinks() ? user_trailingslashit( $wp_rewrite->pagination_base . '/%#%', 'paged' ) : '?paged=%#%';

	$defaults = array(
		'base'               => $pagenum_link, // http://example.com/all_posts.php%_% : %_% is replaced by format (below).
		'format'             => $format, // ?page=%#% : %#% is replaced by the page number.
		'total'              => $total,
		'current'            => $current,
		'aria_current'       => 'page',
		'show_all'           => false,
		'prev_next'          => true,
		'prev_text'          => __( '&laquo; Previous' ),
		'next_text'          => __( 'Next &raquo;' ),
		'end_size'           => 1,
		'mid_size'           => 2,
		'type'               => 'plain',
		'add_args'           => array(), // Array of query args to add.
		'add_fragment'       => '',
		'before_page_number' => '',
		'after_page_number'  => '',
	);

	$args = wp_parse_args( $args, $defaults );

	if ( ! is_array( $args['add_args'] ) ) {
		$args['add_args'] = array();
	}

	// Merge additional query vars found in the original URL into 'add_args' array.
	if ( isset( $url_parts[1] ) ) {
		// Find the format argument.
		$format       = explode( '?', str_replace( '%_%', $args['format'], $args['base'] ) );
		$format_query = isset( $format[1] ) ? $format[1] : '';
		wp_parse_str( $format_query, $format_args );

		// Find the query args of the requested URL.
		wp_parse_str( $url_parts[1], $url_query_args );

		// Remove the format argument from the array of query arguments, to avoid overwriting custom format.
		foreach ( $format_args as $format_arg => $format_arg_value ) {
			unset( $url_query_args[ $format_arg ] );
		}

		$args['add_args'] = array_merge( $args['add_args'], urlencode_deep( $url_query_args ) );
	}

	// Who knows what else people pass in $args.
	$total = (int) $args['total'];
	if ( $total < 2 ) {
		return;
	}
	$current  = (int) $args['current'];
	$end_size = (int) $args['end_size']; // Out of bounds? Make it the default.
	if ( $end_size < 1 ) {
		$end_size = 1;
	}
	$mid_size = (int) $args['mid_size'];
	if ( $mid_size < 0 ) {
		$mid_size = 2;
	}

	$add_args   = $args['add_args'];
	$r          = '';
	$page_links = array();
	$dots       = false;

	if ( $args['prev_next'] && $current && 1 < $current ) :
		$link = str_replace( '%_%', 2 == $current ? '' : $args['format'], $args['base'] );
		$link = str_replace( '%#%', $current - 1, $link );
		if ( $add_args ) {
			$link = add_query_arg( $add_args, $link );
		}
		$link .= $args['add_fragment'];

		$page_links[] = sprintf(
            '<li class="pagination-arrow"><a href="%s" class="ripple-effect"><i class="icon-material-outline-keyboard-arrow-left"></i></a></li>',
			//'<a class="prev page-numberss" href="%s">%s</a>',
			/**
			 * Filters the paginated links for the given archive pages.
			 *
			 * @since 3.0.0
			 *
			 * @param string $link The paginated link URL.
			 */
			esc_url( apply_filters( 'paginate_links', $link ) ),
			$args['prev_text']
		);
	endif;

	for ( $n = 1; $n <= $total; $n++ ) :
		if ( $n == $current ) :
			$page_links[] = sprintf(
                //'<span aria-current="%s" class="page-numbers current">%s</span>',
                '<li><a aria-current="%s" class="current-page ripple-effect">%s</a></li>',
				esc_attr( $args['aria_current'] ),
				$args['before_page_number'] . number_format_i18n( $n ) . $args['after_page_number']
			);

			$dots = true;
		else :
			if ( $args['show_all'] || ( $n <= $end_size || ( $current && $n >= $current - $mid_size && $n <= $current + $mid_size ) || $n > $total - $end_size ) ) :
				$link = str_replace( '%_%', 1 == $n ? '' : $args['format'], $args['base'] );
				$link = str_replace( '%#%', $n, $link );
				if ( $add_args ) {
					$link = add_query_arg( $add_args, $link );
				}
				$link .= $args['add_fragment'];

				$page_links[] = sprintf(
                   // '<a class="page-numbers" href="%s">%s</a>',
                    '<li><a href="%s" class="ripple-effect">%s</a></li>',
					/** This filter is documented in wp-includes/general-template.php */
					esc_url( apply_filters( 'paginate_links', $link ) ),
					$args['before_page_number'] . number_format_i18n( $n ) . $args['after_page_number']
				);

				$dots = true;
			elseif ( $dots && ! $args['show_all'] ) :
				$page_links[] = '<span class="page-numbers dots">' . __( '&hellip;' ) . '</span>';

				$dots = false;
			endif;
		endif;
	endfor;

	if ( $args['prev_next'] && $current && $current < $total ) :
		$link = str_replace( '%_%', $args['format'], $args['base'] );
		$link = str_replace( '%#%', $current + 1, $link );
		if ( $add_args ) {
			$link = add_query_arg( $add_args, $link );
		}
		$link .= $args['add_fragment'];

		$page_links[] = sprintf(
            //'<a class="next page-numbers" href="%s">%s</a>',
            '<li class="pagination-arrow"><a href="%s" class="ripple-effect"><i class="icon-material-outline-keyboard-arrow-right"></i></a></li>',
			/** This filter is documented in wp-includes/general-template.php */
			esc_url( apply_filters( 'paginate_links', $link ) ),
			$args['next_text']
		);
	endif;

	switch ( $args['type'] ) {
		case 'array':
			return $page_links;

		case 'list':
			$r .= "<ul class='page-numbers'>\n\t<li>";
			$r .= join( "</li>\n\t<li>", $page_links );
			$r .= "</li>\n</ul>\n";
			break;

		default:
			$r = join( "\n", $page_links );
			break;
	}

	return $r;
}