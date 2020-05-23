<?php
if(is_page('dashboard') || is_page('dashboard-setting') ){
	get_template_part( 'template_footer/dashboard');
}else{
	get_template_part( 'template_footer/default');
}