<?php
if(is_page('dashboard')){
	get_template_part( 'template_footer/dashboard');
}else{
	get_template_part( 'template_footer/default');
}