<?php 

/**
 * Custom Database installation for Xperts4hire
 */

global $wpdb;
$charset_collate = $wpdb->get_charset_collate();

/**
 * Create user notes table if not exist
 */
$table_name = $wpdb->base_prefix.'users_notes';
$user_notes_table = $wpdb->get_var("SHOW TABLES LIKE '$table_name'");
if ( ! $user_notes_table == $table_name ) {
    $sql = "CREATE TABLE `{$table_name }` (
        id bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
        user_id bigint(20) UNSIGNED NOT NULL,
        user_priority varchar(191) NOT NULL,
        note_description varchar(191) NOT NULL,
        created_at datetime NOT NULL,
        PRIMARY KEY  (id)
      ) $charset_collate;";
      
      require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
      dbDelta($sql);
}

/**
 * Insert user notes table if not exist
 */
function add_notes($priority, $description){
    global $wpdb;
    $user_id = get_current_user_id();
    $sql = $wpdb->insert("{$wpdb->base_prefix}users_notes", [
        'user_id' => $user_id,
        'user_priority' => $priority,
        'note_description' => $description,
        'created_at' => gmdate('Y-m-d H:i:s'),
    ]);
   
    if( $sql ){
        return TRUE;
    }else{
        return FALSE;
    }
}

/**
 * Set Priority value and key
 */
function notes_priority($note){
    $priority = [
        'high-priority' => '<span class="note-priority high" data-val="high-priority">High Priority</span>',
        'low-priority'  => '<span class="note-priority low"  data-val="low-priority">Low Priority</span>',
        'medium-priority' => '<span class="note-priority medium" data-val="medium-priority">Medium Priority</span>',
    ];
    
    foreach ($priority as $key => $prior) {
        if( $key == $note){
            return $prior;
        }
    }
}

/**
 * Select user notes table with value
 */
function select_notes(){
    global $wpdb;
    $user_id = get_current_user_id();
    $sql = $wpdb->get_results( "SELECT * FROM {$wpdb->base_prefix}users_notes WHERE user_id = $user_id" , ARRAY_A);
   
    if( $sql ){
        return $sql;
    }else{
        return FALSE;
    }
}

/**
 * Add Notes
 */
function add_user_notes(){
     if (isset($_POST['add_note'])) {
        $result = '';
        $priority = $_POST['priority'];  
        $description = $_POST['description'];
        $x = add_notes($priority, $description);                 
            if ($x) {
                $result =  "true";	
            }else{
                $result =  "false";
            }
        echo $result;
    }
    die();
}
add_action( 'wp_ajax_nopriv_add_user_notes', 'add_user_notes' );
add_action( 'wp_ajax_add_user_notes', 'add_user_notes' );

/**
 * Create user employment history table if not exist
 */
 $table_history = $wpdb->base_prefix.'users_employment_history';
 $user_history_table = $wpdb->get_var("SHOW TABLES LIKE '$table_history'");
 if ( ! $user_history_table == $table_history ) {
     $sql = "CREATE TABLE `{$table_history }` (
         id bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
         user_id bigint(20) UNSIGNED NOT NULL,
         position varchar(191) NOT NULL,
         company varchar(191) NOT NULL,
         image_name varchar(100) NOT NULL,
         company_image  longblob NOT NULL,
         job_description varchar(191) NOT NULL,
         start_date date NOT NULL,
         end_date date,
         PRIMARY KEY  (id)
       ) $charset_collate;";
       
       require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
       dbDelta($sql);
 }

 /**
 * Insert user employment history data if not exist
 */
function add_employment($company, $position, $image_name, $company_image, $job_description, $start_date, $end_date=null){
    global $wpdb;
    $user_id = get_current_user_id();
    $sql = $wpdb->insert("{$wpdb->base_prefix}users_employment_history", [
        'user_id' => $user_id,
        'position' => $position,
        'company' => $company,
        'image_name' => $image_name,
        'company_image' => $company_image,
        'job_description' => $job_description,
        'start_date' => $start_date,
        'end_date' => $end_date,
    ]);
   
    if( $sql ){
        return TRUE;
    }else{
        return FALSE;
    }
}


/**
 * Select work history table with value
 */
 function select_work_history(){
    global $wpdb;
    $user_id = get_current_user_id();
    $sql = $wpdb->get_results( "SELECT * FROM {$wpdb->base_prefix}users_employment_history WHERE user_id = $user_id" , ARRAY_A);
   
    if( $sql ){
        return $sql;
    }else{
        return FALSE;
    }
}


/**
 * Select work history table in page profile
 */
 function select_work_history_user($user_id){
    global $wpdb;
    $sql = $wpdb->get_results( "SELECT * FROM {$wpdb->base_prefix}users_employment_history WHERE user_id = $user_id" , ARRAY_A);
   
    if( $sql ){
        return $sql;
    }else{
        return FALSE;
    }
}