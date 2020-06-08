<?php
/*
* @Author 	:	PickPlugins
* Copyright	: 	2015 PickPlugins.com
*
* Version	:	1.0.3	
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 


if( ! class_exists( 'WPAdminMenu' ) ) {
	
class WPAdminMenu {
	
	public $data = array();
	
    public function __construct( $args ){
		
		$this->data = &$args;
	
		if( $this->add_in_menu() ) {
			add_action( 'admin_menu', array( $this, 'add_menu_in_admin_menu' ), 12 );
		}
		
		add_action( 'admin_init', array( $this, '_display_fields' ), 12 );
		add_filter( 'whitelist_options', array( $this, '_whitelist_options' ), 99, 1 );
		add_action( 'admin_enqueue_scripts', array( $this, 'pick_enqueue_color_picker' ) );
	}
	
	public function add_menu_in_admin_menu() {
		
		if( "main" == $this->get_menu_type() ) {
			add_menu_page( $this->get_menu_name(), $this->get_menu_title(), $this->get_capability(), $this->get_menu_slug(), array( $this, 'pick_settings_display' ), $this->get_menu_icon() );
		}
		
		if( "submenu" == $this->get_menu_type() ) {
			add_submenu_page( $this->get_parent_slug(), $this->get_page_title(), $this->get_menu_title(), $this->get_capability(), $this->get_menu_slug(), array( $this, 'pick_settings_display' ) );
		}
	}
	
	public function pick_enqueue_color_picker(){
		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_script( 'wp-color-picker' );
		wp_enqueue_script( 'jquery-ui-datepicker' );
	}
	
	public function _display_fields() {

 		foreach( $this->get_settings_fields() as $key => $setting ):
		
			add_settings_section(
				$key,
				isset( $setting['title'] ) ? $setting['title'] : "",
				array( $this, 'pick_settings_section' ),
				$this->get_current_page()
			);
			
			foreach( $setting['options'] as $option ) :
				
			add_settings_field( $option['id'], $option['title'], array($this,'_field_generator'), $this->get_current_page(), $key, $option );

			endforeach;
		
		endforeach;
	}
	
	public function _field_generator( $option ) {
			
		$id 		= isset( $option['id'] ) ? $option['id'] : "";
		$type 		= isset( $option['type'] ) ? $option['type'] : "";
		$details 	= isset( $option['details'] ) ? $option['details'] : "";
		
		if( empty( $id ) ) return;
		
		try{

		    //var_dump($type);


			if( isset($option['type']) && $option['type'] === 'select' ) 		    $this->_field_select( $option );
            elseif( isset($option['type']) && $option['type'] === 'select_multi')	$this->_field_select_multi( $option );
			elseif( isset($option['type']) && $option['type'] === 'checkbox')	    $this->_field_checkbox( $option );
			elseif( isset($option['type']) && $option['type'] === 'radio')		    $this->_field_radio( $option );
			elseif( isset($option['type']) && $option['type'] === 'textarea')	    $this->_field_textarea( $option );
			elseif( isset($option['type']) && $option['type'] === 'number' ) 	    $this->_field_number( $option );
			elseif( isset($option['type']) && $option['type'] === 'text' ) 		    $this->_field_text( $option );
            elseif( isset($option['type']) && $option['type'] === 'text_multi' ) 	$this->_field_text_multi( $option );
			elseif( isset($option['type']) && $option['type'] === 'colorpicker')    $this->_field_colorpicker( $option );
			elseif( isset($option['type']) && $option['type'] === 'datepicker')	    $this->_field_datepicker( $option );
            elseif( isset($option['type']) && $option['type'] === 'repeater')	    $this->_field_repeater( $option );
            elseif( isset($option['type']) && $option['type'] === 'faq')	        $this->_field_faq( $option );



			elseif( isset($option['type']) && $option['type'] === $type ) 	do_action( "pick_settings_action_custom_field_$type", $option );

			if( !empty( $details ) ) echo "<p class='description'>$details</p>";
		
		}
		catch(Pick_error $e) {
			echo $e->get_error_message();
		}
	}

	public function _field_datepicker( $option ){
		
		$id 			= isset( $option['id'] ) ? $option['id'] : "";
		$placeholder 	= isset( $option['placeholder'] ) ? $option['placeholder'] : "";
		$value 	 		= get_option( $id );
		

		echo "<input type='text' class='regular-text' name='$id' id='$id' placeholder='$placeholder' value='$value' />";
		
	
		echo "<script>jQuery(document).ready(function($) { $('#$id').datepicker();});</script>";
	}
	
	public function _field_colorpicker( $option ){
		
		$id 			= isset( $option['id'] ) ? $option['id'] : "";
		$placeholder 	= isset( $option['placeholder'] ) ? $option['placeholder'] : "";
		$value 	 		= get_option( $id );
		
		echo "<input type='text' class='regular-text' name='$id' id='$id' placeholder='$placeholder' value='$value' />";
		
		echo "<script>jQuery(document).ready(function($) { $('#$id').wpColorPicker();});</script>";
	}
	
	public function _field_text( $option ){
		
		$id 			= isset( $option['id'] ) ? $option['id'] : "";
		$placeholder 	= isset( $option['placeholder'] ) ? $option['placeholder'] : "";
		$value 	 		= get_option( $id );
		
		echo "<input type='text' class='regular-text' name='$id' id='$id' placeholder='$placeholder' value='$value' />";
	}

    public function _field_text_multi( $option ){

        $id 			= isset( $option['id'] ) ? $option['id'] : "";
        $placeholder 	= isset( $option['placeholder'] ) ? $option['placeholder'] : "";
        $values 	 		= get_option( $id );


        //var_dump($values);
        ?>

        <script>jQuery(document).ready(function($) {

                html_<?php echo $id; ?> = '<div class=""><input type="text" class="regular-text" name="<?php echo $id?>[]"  placeholder="<?php echo $placeholder; ?>" value="" /><span class="button" onclick="jQuery(this).parent().remove()">X</span></div>';


            });</script>

        <span class="button" onclick="jQuery('#<?php echo $id; ?>').append(html_<?php echo $id; ?>)">Add</span>
        <div class="field-list" id="<?php echo $id; ?>">

            <?php
            if(!empty($values)):

                foreach ($values as $value):

                    ?>
                    <div class="">
                        <input type='text' class='regular-text' name='<?php echo $id?>[]'  placeholder='<?php echo $placeholder; ?>' value='<?php echo $value; ?>' /><span class="button" onclick="jQuery(this).parent().remove()">X</span>
                    </div>
                    <?php

                endforeach;

            else:

                ?>
                <div class="">
                    <input type='text' class='regular-text' name='<?php echo $id?>[]'  placeholder='<?php echo $placeholder; ?>' value='' /><span class="button" onclick="jQuery(this).parent().remove()">X</span>
                </div>
                <?php

            endif;

            ?>



        </div>

        <?php

    }







    public function _field_number( $option ){
		
		$id 			= isset( $option['id'] ) ? $option['id'] : "";
		$placeholder 	= isset( $option['placeholder'] ) ? $option['placeholder'] : "";
		$value 	 		= get_option( $id );
		
		echo "<input type='number' class='regular-text' name='$id' id='$id' placeholder='$placeholder' value='$value' />";
	}
	
	public function _field_textarea( $option ){
		
		$id = isset( $option['id'] ) ? $option['id'] : "";
		$placeholder = isset( $option['placeholder'] ) ? $option['placeholder'] : "";
		
		$value 	 = get_option( $id );
		
		echo "<textarea name='$id' id='$id' cols='40' rows='5' placeholder='$placeholder'>$value</textarea>";
	}
	
	public function _field_select( $option ){
		
		$id 	= isset( $option['id'] ) ? $option['id'] : "";
		$args 	= isset( $option['args'] ) ? $option['args'] : array();	
		$args	= is_array( $args ) ? $args : $this->generate_args_from_string( $args );
		$value	= get_option( $id );
		
		echo "<select name='$id' id='$id'>";
		foreach( $args as $key => $name ):
			$selected = $value == $key ? "selected" : "";
			echo "<option $selected value='$key'>$name</option>";
		endforeach;
		echo "</select>";
	}




    public function _field_select_multi( $option ){

        $id				= isset( $option['id'] ) ? $option['id'] : "";
        $args			= isset( $option['args'] ) ? $option['args'] : array();
        $args			= is_array( $args ) ? $args : $this->generate_args_from_string( $args );
        $option_value	= get_option( $id );

        echo "<select multiple name='{$id}[]'>";
        foreach( $args as $key => $value ):
            $selected = is_array( $option_value ) && in_array( $key, $option_value ) ? "selected" : "";
            echo "<option value='$key' $selected>$value</option>";
        endforeach;
        echo "</select>";
    }



    public function _field_checkbox( $option ){
		
		$id				= isset( $option['id'] ) ? $option['id'] : "";
		$args			= isset( $option['args'] ) ? $option['args'] : array();
		$args			= is_array( $args ) ? $args : $this->generate_args_from_string( $args );
		$option_value	= get_option( $id );


		//var_dump($option_value);

		echo "<fieldset>";
		foreach( $args as $key => $value ):

			$checked = is_array( $option_value ) && in_array( $key, $option_value ) ? "checked" : "";
			echo "<label for='$id-$key'><input name='{$id}[]' type='checkbox' id='$id-$key' value='$key' $checked>$value</label><br>";
			
		endforeach;
		echo "</fieldset>";
	}



    public function _field_faq( $option ){

        $id				= isset( $option['id'] ) ? $option['id'] : "";
        $args			= isset( $option['args'] ) ? $option['args'] : array();
        $args			= is_array( $args ) ? $args : $this->generate_args_from_string( $args );
        $option_value	= get_option( $id );


        //var_dump($option_value);

        ?>
        <div class='faq-list'>
            <?php
            foreach( $args as $key => $value ):

                $title = $value['title'];
                $link = $value['link'];
                $content = $value['content'];

                ?>
                <div class="faq-item">
                    <div class="faq-header"><?php echo $title; ?></div>
                    <div class="faq-content"><?php echo $content; ?></div>

                </div>
                <?php

            endforeach;
            ?>

        </div>
        <style type="text/css">
            .faq-list{}
            .faq-list .faq-item{
                margin: 5px 0;
            }
            .faq-list .faq-header{
                padding: 10px;
                background: #ddd;
            }
            .faq-list .faq-content{
                padding: 10px;
                background: #e5e5e5;
            }
        </style>
        <?php


    }




    public function _field_repeater( $option ){

        $id				= isset( $option['id'] ) ? $option['id'] : "";
        $fields			= isset( $option['fields'] ) ? $option['fields'] : array();

        $option_value	= get_option( $id );


        //var_dump($option_value);

        ?>

        <fieldsets id="<?php echo $id; ?>">
            <button class="add">Add New</button>
            <?php
            foreach( $fields as $key => $field ):
                $type = isset($field['type']) ? $field['type'] : '';
                $title = isset($field['title']) ? $field['title'] : '';
                ?>
                <fieldset>
                    <label><?php echo $title; ?></label>
                    <?php

                    if($type == 'text'):
                        ?>
                        <input type="text" name="<?php echo $id; ?>[]" value="">
                        <?php

                    elseif ($type == 'textarea'):

                    endif;



                    ?>

                </fieldset>
                <?php
            endforeach;
            ?>

        </fieldsets>
        <?php



    }







	public function _field_radio( $option ){

		$id				= isset( $option['id'] ) ? $option['id'] : "";
		$args			= isset( $option['args'] ) ? $option['args'] : array();
		$args			= is_array( $args ) ? $args : $this->generate_args_from_string( $args );
		$option_value	= get_option( $id );

		echo "<fieldset>";
		foreach( $args as $key => $value ):

			$checked = is_array( $option_value ) && in_array( $key, $option_value ) ? "checked" : "";
			echo "<label for='$id-$key'><input name='{$id}[]' type='radio' id='$id-$key' value='$key' $checked>$value</label><br>";
				
		endforeach;
		echo "</fieldset>";
	}
	
	public function pick_settings_section( $section ) {
		
		$data = isset( $section['callback'][0]->data ) ? $section['callback'][0]->data : array();
		$description = isset( $data['pages'][$this->get_current_page()]['page_settings'][$section['id']]['description'] ) ? $data['pages'][$this->get_current_page()]['page_settings'][$section['id']]['description'] : "";
		
		echo $description;
	}
	
	public function _whitelist_options( $whitelist_options ){


		
		foreach( $this->get_pages() as $page_id => $page ): foreach( $page['page_settings'] as $section ):
			foreach( $section['options'] as $option ):
				$whitelist_options[$page_id][] = $option['id'];
			endforeach; endforeach;
		endforeach;
		
		return $whitelist_options;
	}
	
	public function pick_settings_display(){

		echo "<div class='wrap'>";
		echo "<h2>{$this->get_menu_page_title()}</h2><br>";
		
		parse_str( $_SERVER['QUERY_STRING'], $nav_menu_url_args );
		global $pagenow;

        $nav_menu_url_args_new = array();

		foreach ($nav_menu_url_args as $nav_Id => $nav){
            $nav_menu_url_args_new[$nav_Id] = sanitize_text_field($nav);
        }
		
		settings_errors();
		
		$tab_count 	 = 0;
		echo "<nav class='nav-tab-wrapper'>";
		foreach( $this->get_pages() as $page_id => $page ): $tab_count++;
			
			$active = $this->get_current_page() == $page_id ? 'nav-tab-active' : '';
            $nav_menu_url_args_new['tab'] = $page_id;
			$nav_menu_url = http_build_query( $nav_menu_url_args_new );

			$nav_url = $pagenow.'?'.$nav_menu_url;

			?>
            <a href='<?php echo esc_url_raw($nav_url); ?>' class='nav-tab <?php echo esc_attr($active); ?>'><?php echo esc_html($page['page_nav']); ?></a>
            <?php

		endforeach;
        echo "</nav>";

		echo "<form action='options.php' method='post'>";
		settings_fields( $this->get_current_page() );
		do_settings_sections( $this->get_current_page() );

		submit_button();
		echo "</form>";	
	
		echo "</div>";		
	}
	
	
	// Default Functions
	
	public function generate_args_from_string( $string ){
		
		if( strpos( $string, 'PICK_PAGES_ARRAY' ) !== false ) return $this->get_pages_array();
		if( strpos( $string, 'PICK_TAX_' ) !== false ) return $this->get_taxonomies_array( $string );
		
		
		return array();
	}
	
	public function get_taxonomies_array( $string ){
		
		$taxonomies = array();
		
		preg_match_all( "/\%([^\]]*)\%/", $string, $matches );
		
		if( isset( $matches[1][0] ) ) $taxonomy = $matches[1][0];
		else throw new Pick_error('Invalid taxonomy declaration !');
		
		if( ! taxonomy_exists( $taxonomy ) ) throw new Pick_error("Taxonomy <strong>$taxonomy</strong> doesn't exists !");
		
		$terms = get_terms( $taxonomy, array(
			'hide_empty' => false,
		) );
		
		foreach( $terms as $term ) $taxonomies[ $term->term_id ] = $term->name;
				
		return $taxonomies;		
	}
	
	public function get_pages_array(){
		
		$pages_array = array();
		foreach( get_pages() as $page ) $pages_array[ $page->ID ] = $page->post_title;
		
		return apply_filters( 'FILTER_PICK_PAGES_ARRAY', $pages_array );
	}
	
	
	// Get Data from Dataset //
	
	public function get_option_ids(){
		
		$option_ids = array();
		foreach( $this->get_pages() as $page ):
			$setting_sections = isset( $page['page_settings'] ) ? $page['page_settings'] : array();
			foreach( $setting_sections as $setting_section ):
		
				$options = isset( $setting_section['options'] ) ? $setting_section['options'] : array();
				foreach( $options as $option ) $option_ids[] = isset( $option['id'] ) ? $option['id'] : '';
				
			endforeach;
		endforeach;
		return $option_ids; 
	}
	
	public function get_current_page(){
		
		$all_pages 		= $this->get_pages();
		$page_keys 		= array_keys($all_pages);
		$default_tab 	= ! empty( $all_pages ) ? reset( $page_keys ) : "";
		
		return isset( $_GET['tab'] ) ? sanitize_text_field($_GET['tab']) : $default_tab;
	}
	private function get_menu_type(){
		if( isset( $this->data['menu_type'] ) ) return $this->data['menu_type'];
		else return "main";
	}
	private function get_pages(){

        //var_dump($this->data['pages']);

		if( isset( $this->data['pages'] ) ) return $this->data['pages'];
		else return array();
	}
	private function get_settings_fields(){

        //var_dump($this->get_pages()[$this->get_current_page()]['page_settings']);

		if( isset( $this->get_pages()[$this->get_current_page()]['page_settings'] ) ) return $this->get_pages()[$this->get_current_page()]['page_settings'];
		else return array();
	}
	private function get_settings_name(){
		if( isset( $this->data['settings_name'] ) ) return $this->data['settings_name'];
		else return "my_custom_settings";
	}
	private function get_menu_icon(){
		if( isset( $this->data['menu_icon'] ) ) return $this->data['menu_icon'];
		else return "";
	}
	private function get_menu_slug(){
		if( isset( $this->data['menu_slug'] ) ) return $this->data['menu_slug'];
		else return "my-custom-settings";
	}
	private function get_capability(){
		if( isset( $this->data['capability'] ) ) return $this->data['capability'];
		else return "manage_options";
	}
	private function get_menu_page_title(){
		if( isset( $this->data['menu_page_title'] ) ) return $this->data['menu_page_title'];
		else return "My Custom Menu";
	}
	private function get_menu_name(){
		if( isset( $this->data['menu_name'] ) ) return $this->data['menu_name'];
		else return "Menu Name";
	}
	private function get_menu_title(){
		if( isset( $this->data['menu_title'] ) ) return $this->data['menu_title'];
		else return "Menu Title";
	}
	private function get_page_title(){
		if( isset( $this->data['page_title'] ) ) return $this->data['page_title'];
		else return "Page Title";
	}
	private function add_in_menu(){
		if( isset( $this->data['add_in_menu'] ) && $this->data['add_in_menu'] ) return true;
		else return false;
	}
	private function get_parent_slug(){
		if( isset( $this->data['parent_slug'] ) && $this->data['parent_slug'] ) return $this->data['parent_slug'];
		else return "";
	}
	
}

}


if( ! class_exists( 'Pick_error' ) ) {
	class Pick_error extends Exception { 

		public function __construct($message, $code = 0, Exception $previous = null) {
			parent::__construct($message, $code, $previous);
		}
		
		public function get_error_message(){
			
			return "<p class='notice notice-error' style='padding: 10px;'>{$this->getMessage()}</p>";
		}
	}
}