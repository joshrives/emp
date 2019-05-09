<?php

// =============================================================================
// FUNCTIONS.PHP
// -----------------------------------------------------------------------------
// Overwrite or add your own custom functions to X in this file.
// =============================================================================

// =============================================================================
// TABLE OF CONTENTS
// -----------------------------------------------------------------------------
//   01. Enqueue Parent Stylesheet
//   02. Additional Functions
// =============================================================================

// Enqueue Parent Stylesheet
// =============================================================================

if ( ! current_user_can( 'manage_options' ) ) {
    show_admin_bar( false );
}

register_sidebar( array(
    'id'          => 'top-default-sidebar',
    'name'        => __( 'Top Sidebar - Default','x'),
    'description' => 'This is the Sidebar section of the default page.',
    'before_widget' => '<div class="sidebar-default">',
    'after_widget'  => '</div>',
    'before_title'  => '<h2 class="widgettitle">',
    'after_title'   => '</h2>'
) );

register_sidebar( array(
    'id'          => 'bottom-default-sidebar',
    'name'        => __( 'Bottom Sidebar - Default','x'),
    'description' => 'This is the Sidebar section of the default page.',
    'before_widget' => '<div class="sidebar-default">',
    'after_widget'  => '</div>',
    'before_title'  => '<h2 class="widgettitle">',
    'after_title'   => '</h2>'
) );

add_filter( 'x_enqueue_parent_stylesheet', '__return_true' );

//add_filter( 'body_class', 'emp_custom_class' );
add_filter( 'add_role_to_body', 'emp_custom_class' );
function emp_custom_class( $classes ) {
	$current_user = wp_get_current_user();
	$role_name = $current_user->roles[0];
    $classes[] = 'user-logged-'.$role_name;
    return $classes;
}

function my_theme_enqueue_styles() {
    $parent_style = 'parent-style'; // This is 'twentyfifteen-style' for the Twenty Fifteen theme.

    // wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
    //wp_enqueue_style( 'animate-style', get_stylesheet_directory_uri().'/css/bootstrap.css' );
    wp_enqueue_style( 'animate-style', get_stylesheet_directory_uri().'/animate.css', false, '1.0', 'all' );
    wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css', array( $parent_style ), wp_get_theme()->get('Version'));
    wp_enqueue_style( 'media-style', get_stylesheet_directory_uri().'/media.css', false, '1.0', 'all' );

    wp_enqueue_script( 'wow-js', get_theme_file_uri( '/wow.min.js' ), array(), '1.0', true );
    wp_enqueue_script( 'global-js', get_theme_file_uri( '/global.js' ), array(), '1.0', true );

}
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles', 999 );

function emp_adminpage_css(){
	$current_user = wp_get_current_user();
	$role_name = $current_user->roles[0];
	if($role_name == "client" || $role_name == "sales_person" || $role_name == "shop_admin"){
		//wp_enqueue_style( 'backend-user', get_stylesheet_directory_uri().'/css/emp-backend-user.css' );

	}
	wp_register_style( 'emp_admin_css',  get_stylesheet_directory_uri(). '/css/emp-admin.css', false, '1.0.0' );
		wp_enqueue_style( 'emp_admin_css' );
}
//add_action( 'admin_enqueue_scripts', 'emp_adminpage_css', 999 );

// EMP higher functionality for finances
//include_once 'emp/functions.php';

function my_page_template_redirect(){
    if(is_page('secure') && !is_user_logged_in()){
        wp_redirect( 'https://earnestmoney.staging.wpengine.com/wp-login.php' );
        exit();
    }
}
//add_action( 'template_redirect', 'my_page_template_redirect' );

function my_login_logo() { ?>
    <style type="text/css">
        #login h1 a, .login h1 a {
		background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/img/logo.png);
		height:59px;
		width:256px;
		background-size: 256px 59px;
		background-repeat: no-repeat;
        }
    </style>
<?php }
//add_action( 'login_enqueue_scripts', 'my_login_logo' );

//add_role( 'sales_person', 'Sales Person', array( 'read' => true, 'level_0' => true, 'upload_files' => true ) );



function createClientMailcontent($full_name, $email, $password){
    $to        = $email;
    $subject   = 'Earnest Money Pro: Registration';
    $headers[] = 'From: Earnest Money Pro <info@earnestmoneypro.com>';
    $headers[] = 'Content-Type: text/html; charset=UTF-8';
    $body      =
    	  '<html>'.
          '<head>'.
            '<title></title>'.
            '<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>'.
          '</head>'.
          '<body style="margin: 0; padding: 0;background-color: #f3f3f3;">'.
          '<table border="0" cellpadding="0" cellspacing="0" width="100%">'.
          '<tr>'.
          '<td style="padding: 0;">'.
          '<table align="center" border="0" cellpadding="0" cellspacing="0" width="700" style="margin: 20px auto 0 auto; border: 0px solid #dbdbdb; border-collapse: collapse; box-shadow: 0px 0px 15px #888888; border-radius: 7px 7px 7px 7px; -webkit-border: 7px 7px 7px 7px; -moz-border: 7px 7px 7px 7px;">'.
          '<tr>'.
          '<td align="center" bgcolor="white" style="border-radius: 7px 7px 0 0; -webkit-border: 7px 7px 0 0; -moz-border: 7px 7px 0 0; background-color: #fff; padding: 26px 0; border-bottom: 5px solid #0d4d95;">'.
          '<table border="0" cellpadding="0" cellspacing="0" width="100%">'.
          '<tr>'.
          '<td align="center"><img src="http://earnestmoney.staging.wpengine.com/wp-content/uploads/2017/02/logo.png" title="Earnest Money Pro" alt="Earnest Money Pro" style="margin: 0 auto;"></td>'.
          '</tr>'.
          '</table>'.
          '</td>'.
          '</tr>'.
          '<tr>'.
          '<td bgcolor="#ffffff" style="padding: 37px 42px 65px 42px; border-radius: 0 0 7px 7px; -webkit-border: 0 0 7px 7px; -moz-border: 0 0 7px 7px;">'.
          '<table border="0" cellpadding="0" cellspacing="0" width="100%">'.
          '<tr>'.
          '<td style="padding: 0; color: #323232; line-height: 20px; text-align: left;">'.
          			'<p> Hello '.$full_name.',</p>'.
    				'<p> Thank you for registering with Earnest Money Pro.  Your account has been created.</p>'.
					'<p>You can login with the following credentials by visiting <a href="'.site_url().'" rel="nofollow">Earnest Money Pro</a></p>'.
					'<p>Username: '.$email.'</p>'.
					'<p>Password: '.$password.'</p>'.
					'<p>Sincerely,</p>'.
					'<p>Earnest Money Pro</p>'.
          '</td>'.
          '</tr>'.
          '</table>'.
          '</td>'.
          '</tr>'.
          '</table>'.
          '</td>'.
          '</tr>'.
          '<tr>'.
          '<td align="center" align="center" border="0" cellpadding="0" cellspacing="0" width="700">'.
          '<table>'.
          '<tr>'.
          '<td align="center">'.
          '<p style="font-family:"Century Gothic", sans-serif; font-size:14px; color:#4b4b4b; padding:0;  margin: 20px 0 0px 0;">'.
          'Copyright &copy; 2017 &#8226; <span style="color: #0d4d95; text-decoration: none;">Earnest Money Pro</span> &#8226; Allrights Reserved'.
          '</p>'.
          '</td>'.
          '</tr>'.
          '</table>'.
          '</td>'.
          '</tr>'.
          '</table>'.
          '</body>'.
          '</html>';
    return wp_mail( $to, $subject, $body, $headers );
}





function cm_redirect_disable_user() {

	$uid = get_current_user_id();
	if($uid){
		$user = new WP_User($uid);
		$role = $user->roles[0];
		$status = get_user_meta($uid,'status',true);
		$p70 = get_the_permalink(70);
		if($role == "sales_person" || $role == "client" ){
			if($status == "removed" && get_the_ID() != 70){
			wp_redirect( $p70 ); exit;
			}
		}
	}

} // cm_redirect_disable_user
add_action( 'admin_init', 'cm_redirect_disable_user' );

function get_emp_role($role){
	switch($role){

		case "administrator":
		$r = "Admin";
		break;

		case "client":
		$r = "Builder";
		break;

		case "sales_person":
		$r = "Sales Person";
		break;

	}
	return $r;
}
function admin_style() {
    $user = wp_get_current_user();
    if ( in_array( 'shop_manager', (array) $user->roles ) || in_array( 'sales_person', (array) $user->roles ) || in_array( 'shop_admin', (array) $user->roles ) ) {
        wp_enqueue_style('admin-styles', get_stylesheet_directory_uri().'/css/admin.css');
    }


}
add_action('admin_enqueue_scripts', 'admin_style');
function custom_style() {
    if(is_page_template('page-payment.php')) {
        wp_enqueue_style('payment-styles', get_stylesheet_directory_uri().'/css/payment-min.css');
        wp_dequeue_style('child-style');
        wp_dequeue_style('animate-style');
        wp_dequeue_style('media-style');
    }
}
add_action( 'wp_enqueue_scripts', 'custom_style', 9999 );
function role_admin_body_class( $classes ) {
    global $current_user;
    foreach( $current_user->roles as $role )
        $classes .= ' role-' . $role;
    return trim( $classes );
}
add_filter( 'admin_body_class', 'role_admin_body_class' );
function adminMenu() {
    $user = wp_get_current_user();
    if ( in_array( 'shop_manager', (array) $user->roles ) || in_array( 'sales_person', (array) $user->roles ) || in_array( 'shop_admin', (array) $user->roles ) ) {
        echo '<header class="emp-admin-header">';
        echo '<div class="admin-logo"><img class="empLogo" src="'.get_stylesheet_directory_uri().'/_i/admin/empadminlogo.png"></div>';
        echo '<a href = "#" class="toggle-nav"><i>Menu</i><span>Close</span></a>';
        echo '<div class="nav-container">';
        echo '<nav>';
        echo '<a href="'.site_url().'/wp-admin/admin.php?page=newRequest">';
        include('_svg/icon-add.php');
        echo 'New Request</a>';
        echo '<a href="'.site_url().'/wp-admin/edit.php?post_type=shop_order">';
        include('_svg/icon-list.php');
        echo 'Transactions</a>';
        if ( in_array( 'shop_manager', (array) $user->roles ) ) {
            echo '<a href="'.site_url().'/wp-admin/users.php">';
            include('_svg/icon-users.php');
            echo 'Manage Users</a>';
            echo '<a href="'.site_url().'/wp-admin/admin.php?page=wc-reports">';
            include('_svg/icon-chart.php');
            echo 'Reports</a>';
            echo '<a href="'.site_url().'/wp-admin/admin.php?page=account-settings">';
            include('_svg/icon-settings.php');
            echo 'Settings</a>';
        }
        echo '</nav>';
        echo '<div class="admin-user">';
        include('_svg/icon-card.php');
        echo 'Logged In As: '.$user->user_firstname.'<a href="'.wp_logout_url().'" class="logoutButton">(Log Out)</a></div>';
        echo '<div>';
        echo '</header>';
        echo '<script>jQuery(document).ready(function(e) {jQuery(".toggle-nav").click(function(){jQuery("body").toggleClass("show-nav");e.preventDefault();});});</script>';
    }
}
add_action( 'in_admin_header', 'adminMenu' );
function get_orders_count_from_status( $status, $id ){
    global $wpdb;
    // We add 'wc-' prefix when is missing from order staus
    $status = 'wc-' . str_replace('wc-', '', $status);
    if($id == 'all') {
        return $wpdb->get_var("
            SELECT count(ID)  FROM {$wpdb->prefix}posts WHERE post_status LIKE '$status' AND `post_type` LIKE 'shop_order'
        ");
    } else {
        return $wpdb->get_var("
            SELECT count(ID)  FROM {$wpdb->prefix}posts WHERE post_status LIKE '$status' AND `post_type` LIKE 'shop_order' AND `post_author` LIKE '$id'
        ");
    }

}

function adminFooter() {
    echo '<footer class="emp-admin-footer">';
    echo '&copy; '.date('Y').' Earnest Money Pro';
    echo '</footer>';
}
add_action( 'in_admin_footer', 'adminFooter' );
function change_order_labels() {
    $p_object = get_post_type_object( 'shop_order' );

    if ( ! $p_object )
        return FALSE;

    // see get_post_type_labels()
    $p_object->labels->name               = 'Requests';
    $p_object->labels->singular_name      = 'Request';
    $p_object->labels->add_new            = 'Add request';
    $p_object->labels->add_new_item       = 'Add new request';
    $p_object->labels->all_items          = 'All requests';
    $p_object->labels->edit_item          = 'Edit request';
    $p_object->labels->name_admin_bar     = 'Request';
    $p_object->labels->menu_name          = 'Request';
    $p_object->labels->new_item           = 'New request';
    $p_object->labels->not_found          = 'No requests found';
    $p_object->labels->not_found_in_trash = 'No requests found in trash';
    $p_object->labels->search_items       = 'Search requests';
    $p_object->labels->view_item          = 'View request';

    return TRUE;
}
add_action( 'init', 'change_order_labels', 15 );

// Output a custom editable field in backend edit order pages under general section
add_action( 'woocommerce_admin_order_data_after_order_details', 'location_order_custom_field', 12, 1 );
function location_order_custom_field( $order ){
    echo '<script>jQuery(document).ready(function(e) {
            jQuery(".order_data_column h3:contains(\'Billing\')").text(\'Customer Details\');
        });</script>';
    echo '<h3 class="order-heading form-field-wide">New Home Information</h3>';
    // Loop through order items
    foreach( $order->get_items() as $item_id => $item ){
        // Get "customer reference" from order item meta data
        if( $item->get_meta('Locale Neighborhood') ){
            // The "customer reference"
            $item_value = $item->get_meta('Locale Neighborhood');

            // We output a hidden field with the Item ID (to be able to update this order item meta data later)
            echo '<input type="hidden" name="old_locale_neighborhood" value="' . $item_id . '">';

            //break; // We stop the loop
        }
        if( $item->get_meta('Locale Lot') ){
            // The "customer reference"
            $item_value = $item->get_meta('Locale Lot');

            // We output a hidden field with the Item ID (to be able to update this order item meta data later)
            echo '<input type="hidden" name="old_locale_lot" value="' . $item_id . '">';

            //break; // We stop the loop
        }
        if( $item->get_meta('Locale Block') ){
            // The "customer reference"
            $item_value = $item->get_meta('Locale Block');

            // We output a hidden field with the Item ID (to be able to update this order item meta data later)
            echo '<input type="hidden" name="old_locale_block" value="' . $item_id . '">';

            //break; // We stop the loop
        }
        if( $item->get_meta('Locale City') ){
            // The "customer reference"
            $item_value = $item->get_meta('Locale City');

            // We output a hidden field with the Item ID (to be able to update this order item meta data later)
            echo '<input type="hidden" name="old_locale_city" value="' . $item_id . '">';

            //break; // We stop the loop
        }
        if( $item->get_meta('Locale Zip') ){
            // The "customer reference"
            $item_value = $item->get_meta('Locale Zip');

            // We output a hidden field with the Item ID (to be able to update this order item meta data later)
            echo '<input type="hidden" name="old_locale_zip" value="' . $item_id . '">';

            //break; // We stop the loop
        }
    }

    // Get "customer reference" from meta data (not item meta data)
    $updated_neighborhood = $order->get_meta('_locale_neighborhood');

    // Replace "customer reference" value by the meta data if it exist
    $neighborhood = $updated_neighborhood ? $updated_neighborhood : ( isset($item_neighborhood) ? $item_neighborhood : '');
    // Display the custom editable field
    woocommerce_wp_text_input( array(
     'id'            => 'locale_neighborhood',
     'label'         => __("Neighborhood:", "woocommerce"),
     'value'         => $neighborhood,
     'wrapper_class' => 'form-field-wide',
    ) );

    // Get "customer reference" from meta data (not item meta data)
    $updated_lot = $order->get_meta('_locale_lot');

    // Replace "customer reference" value by the meta data if it exist
    $lot = $updated_lot ? $updated_lot : ( isset($item_lot) ? $item_lot : '');
    // Display the custom editable field
    woocommerce_wp_text_input( array(
     'id'            => 'locale_lot',
     'label'         => __("Lot:", "woocommerce"),
     'value'         => $lot,
     'wrapper_class' => 'form-field-wide',
    ) );

    // Get "customer reference" from meta data (not item meta data)
    $updated_block = $order->get_meta('_locale_block');
    // Replace "customer reference" value by the meta data if it exist
    $block = $updated_block ? $updated_block : ( isset($item_block) ? $item_block : '');
    // Display the custom editable field
    woocommerce_wp_text_input( array(
     'id'            => 'locale_block',
     'label'         => __("Block:", "woocommerce"),
     'value'         => $block,
     'wrapper_class' => 'form-field-wide',
    ) );
/*
    // Get "customer reference" from meta data (not item meta data)
    $updated_locale_city = $order->get_meta('_locale_city');
    // Replace "customer reference" value by the meta data if it exist
    $locale_city = $updated_locale_city ? $updated_locale_city : ( isset($item_locale_city) ? $item_locale_city : '');
    // Display the custom editable field
    woocommerce_wp_text_input( array(
     'id'            => 'locale_city',
     'label'         => __("City:", "woocommerce"),
     'value'         => $locale_city,
     'wrapper_class' => 'form-field-wide',
    ) );

    // Get "customer reference" from meta data (not item meta data)
    $updated_locale_zip = $order->get_meta('_locale_zip');
    // Replace "customer reference" value by the meta data if it exist
    $locale_zip = $updated_locale_zip ? $updated_locale_zip : ( isset($item_locale_zip) ? $item_locale_zip : '');
    // Display the custom editable field
    woocommerce_wp_text_input( array(
     'id'            => 'locale_zip',
     'label'         => __("Zip:", "woocommerce"),
     'value'         => $locale_zip,
     'wrapper_class' => 'form-field-wide',
    ) );
*/
}

// Save the custom editable field value as order meta data and update order item meta data
add_action( 'woocommerce_process_shop_order_meta', 'save_order_custom_field_meta_data', 12, 2 );
function save_order_custom_field_meta_data( $post_id, $post ){
    if( isset( $_POST[ 'locale_neighborhood' ] ) ){
        // Save "customer reference" as order meta data
        update_post_meta( $post_id, '_locale_neighborhood', sanitize_text_field( $_POST[ 'locale_neighborhood' ] ) );

        // Update the existing "customer reference" item meta data
        if( isset( $_POST[ 'old_locale_neighborhood' ] ) ) {
            wc_update_order_item_meta( $_POST[ 'old_locale_neighborhood' ], 'Locale Neighborhood', $_POST[ 'locale_neighborhood' ] );
        }
    }
    if( isset( $_POST[ 'locale_lot' ] ) ){
        // Save "customer reference" as order meta data
        update_post_meta( $post_id, '_locale_lot', sanitize_text_field( $_POST[ 'locale_lot' ] ) );

        // Update the existing "customer reference" item meta data
        if( isset( $_POST[ 'old_locale_lot' ] ) ) {
            wc_update_order_item_meta( $_POST[ 'old_locale_lot' ], 'Locale Lot', $_POST[ 'locale_lot' ] );
        }
    }
    if( isset( $_POST[ 'locale_block' ] ) ){
        // Save "customer reference" as order meta data
        update_post_meta( $post_id, '_locale_block', sanitize_text_field( $_POST[ 'locale_block' ] ) );

        // Update the existing "customer reference" item meta data
        if( isset( $_POST[ 'old_locale_block' ] ) ) {
            wc_update_order_item_meta( $_POST[ 'old_locale_block' ], 'Locale Block', $_POST[ 'locale_block' ] );
        }
    }
    if( isset( $_POST[ 'locale_city' ] ) ){
        // Save "customer reference" as order meta data
        update_post_meta( $post_id, '_locale_city', sanitize_text_field( $_POST[ 'locale_city' ] ) );

        // Update the existing "customer reference" item meta data
        if( isset( $_POST[ 'old_locale_city' ] ) ) {
            wc_update_order_item_meta( $_POST[ 'old_locale_city' ], 'Locale City', $_POST[ 'locale_city' ] );
        }
    }
    if( isset( $_POST[ 'locale_zip' ] ) ){
        // Save "customer reference" as order meta data
        update_post_meta( $post_id, '_locale_zip', sanitize_text_field( $_POST[ 'locale_zip' ] ) );

        // Update the existing "customer reference" item meta data
        if( isset( $_POST[ 'old_locale_zip' ] ) ) {
            wc_update_order_item_meta( $_POST[ 'old_locale_zip' ], 'Locale Zip', $_POST[ 'locale_zip' ] );
        }
    }
    if( isset( $_POST[ 'locale_dob' ] ) ){
        // Save "customer reference" as order meta data
        update_post_meta( $post_id, '_locale_dob', sanitize_text_field( $_POST[ 'locale_dob' ] ) );

        // Update the existing "customer reference" item meta data
        if( isset( $_POST[ 'old_locale_dob' ] ) ) {
            wc_update_order_item_meta( $_POST[ 'old_locale_dob' ], 'Locale DOB', $_POST[ 'locale_dob' ] );
        }
    }
    if( isset( $_POST[ 'locale_ssn' ] ) ){
        // Save "customer reference" as order meta data
        update_post_meta( $post_id, '_locale_ssn', sanitize_text_field( $_POST[ 'locale_ssn' ] ) );

        // Update the existing "customer reference" item meta data
        if( isset( $_POST[ 'old_locale_ssn' ] ) ) {
            wc_update_order_item_meta( $_POST[ 'old_locale_ssn' ], 'Locale SSN', $_POST[ 'locale_ssn' ] );
        }
    }
}

// Output a custom editable field in backend edit order pages under general section
//add_action( 'woocommerce_admin_order_data_after_billing_address', 'personal_order_custom_field', 12, 1 );
function personal_order_custom_field( $order ){
    // Loop through order items
    foreach( $order->get_items() as $item_id => $item ){
        // Get "customer reference" from order item meta data
        if( $item->get_meta('_locale_dob') ){
            // The "customer reference"
            $item_value = $item->get_meta('_locale_dob');

            // We output a hidden field with the Item ID (to be able to update this order item meta data later)
            echo '<input type="hidden" name="old_personal_dob" value="' . $item_id . '">';

            //break; // We stop the loop
        }
        if( $item->get_meta('_locale_ssn') ){
            // The "customer reference"
            $item_value = $item->get_meta('_locale_ssn');

            // We output a hidden field with the Item ID (to be able to update this order item meta data later)
            echo '<input type="hidden" name="old_personal_ssn" value="' . $item_id . '">';

            //break; // We stop the loop
        }
    }
    echo '<h3 class="order-heading form-field-wide">Personal Details</h3>';
    // Get "customer reference" from meta data (not item meta data)
    $updated_dob = $order->get_meta('_locale_dob');

    // Replace "customer reference" value by the meta data if it exist
    $dob = $updated_dob ? $updated_dob : ( isset($item_dob) ? $item_dob : '');
    // Display the custom editable field
    woocommerce_wp_text_input( array(
     'id'            => 'locale_dob',
     'label'         => __("Date of Birth:", "woocommerce"),
     'value'         => $dob,
     'wrapper_class' => 'form-field-wide',
    ) );

    // Get "customer reference" from meta data (not item meta data)
    $updated_ssn = $order->get_meta('_locale_ssn');

    // Replace "customer reference" value by the meta data if it exist
    $ssn = $updated_ssn ? $updated_ssn : ( isset($item_ssn) ? $item_ssn : '');
    // Display the custom editable field
    woocommerce_wp_text_input( array(
     'id'            => 'locale_ssn',
     'label'         => __("Social Security:", "woocommerce"),
     'value'         => $ssn,
     'wrapper_class' => 'form-field-wide',
     'placeholder'   => 'Last 4 digits'
    ) );
}
function newRequest() {
    wp_enqueue_media();
	wp_enqueue_style( 'backend-user', get_stylesheet_directory_uri().'/css/emp-backend-user.css' );
    $user = wp_get_current_user();
    echo '<div class="dash-container group"><aside class="emp-admin-dash">';
	echo '<h3 class="dash-welcome">Welcome back <strong>'.$user->user_firstname.'</strong>!<br />No Check, No Problem! Lets make a Sale!</h3>';
	echo '<div class="dash-overview"><h4>Overview</h4><ul class="dash-stats">';
    echo '<li><a href = "'.site_url().'/wp-admin/edit.php?post_status=wc-pending&post_type=shop_order"><span>';
    include('_svg/icon-clock.php');
    if(in_array( 'sales_person', (array) $user->roles )) {
        echo 'Pending Requests</span><b>'.get_orders_count_from_status('pending', $user->ID).'</b></a></li>';
    } else {
        echo 'Pending Requests</span><b>'.get_orders_count_from_status('pending', 'all').'</b></a></li>';
    }
    echo '<li><a href = "'.site_url().'/wp-admin/edit.php?post_status=wc-completed&post_type=shop_order"><span>';
    include('_svg/icon-shake.php');
    if(in_array( 'sales_person', (array) $user->roles )) {
        echo 'Completed Requests</span><b>'.get_orders_count_from_status('completed', $user->ID).'</b></a></li>';
    } else {
        echo 'Completed Requests</span><b>'.get_orders_count_from_status('completed', 'all').'</b></a></li>';
    }
    if(in_array( 'shop_manager', (array) $user->roles )) {
        echo '<li><a href = "'.site_url().'/wp-admin/users.php?role=sales_person"><span>';
        include('_svg/icon-users.php');
        $users = count_users();
        echo 'Sales People</span><b>';
        //print_r($users['avail_roles']);
        foreach($users['avail_roles'] as $role => $count) {
            if($role == 'sales_person') {
                echo $count;
            }
        }
        echo '</b></a></li>';

        echo '<li><a href = "'.site_url().'/wp-admin/users.php?role=shop_manager"><span>';
        include('_svg/icon-user.php');
        $users = count_users();
        echo 'Managers</span><b>';
        foreach($users['avail_roles'] as $role => $count) {
            if($role == 'shop_manager') {
                echo $count;
            }
        }
        echo '</b></a></li>';
    }

    echo '</ul></div>';
    echo '<div class="ssl-overview"><div class="ssl-images">';
    include('_svg/icon-lock.php');
	echo '<img src="'.get_stylesheet_directory_uri().'/_i/admin/greenbar_earnestmoneypro.png"></div>';
    echo '<div class="ssl-text"><p>SSL (Secure Sockets Layer) is a protocol that provides secure communications on the Internet for such things as web browsing, e-mail, instant messaging, and other data transfers.</p><p>The advantage of SSL is added security for you and your users.</p></div>';
    echo '</div></aside>';
    echo '<div class="postbox new-request-container">';
    echo '<h1>Send New Request</h1>';
    gravity_form_enqueue_scripts( 1, true );
    gravity_form( 1, false, true, false, null, false );
    echo '</div></div>';
}
function new_request_page() {
    add_menu_page(
        __( 'New Request Form', 'textdomain' ),
        'New Request Form',
        'publish_posts',
        'newRequest',
        'newRequest',
        'dashicons-plus-alt',
        80
    );
}
add_action( 'admin_menu', 'new_request_page' );

function create_new_request($entry, $form) {
    global $woocommerce;
    $customer_type = rgar( $entry, '22' );
    if($customer_type == "New Customer") {
        //Get form data
        $req_first = rgar( $entry, '1.3' );
        $req_last = rgar( $entry, '1.6' );
        $req_email = rgar( $entry, '2' );
        $req_address = rgar( $entry, '20.1' );
        $req_address2 = rgar( $entry, '20.2' );
        $req_city = rgar( $entry, '20.3' );
        $req_state = rgar( $entry, '20.4' );
        $req_zip = rgar( $entry, '20.5' );
        $req_phone = rgar( $entry, '16' );

        $password = wp_generate_password( 16, true );
        $user_name = $user_email = $req_email;
        $customer_id = wc_create_new_customer( $user_email, $user_name, $password );
        update_user_meta( $customer_id, "billing_first_name", $req_first );
        update_user_meta( $customer_id, "billing_last_name", $req_last );
        update_user_meta( $customer_id, "billing_address_1", $req_address );
        update_user_meta( $customer_id, "billing_address_2", $req_address2 );
        update_user_meta( $customer_id, "billing_city", $req_city );
        update_user_meta( $customer_id, "billing_postcode", $req_zip );
        update_user_meta( $customer_id, "billing_country", 'US' );
        update_user_meta( $customer_id, "billing_state", $req_state );
        update_user_meta( $customer_id, "billing_email", $req_email );
        update_user_meta( $customer_id, "billing_phone", $req_phone );
    } else {
        $customer_id = rgar( $entry, '21' );
        $req_first = get_user_meta( $customer_id, 'billing_first_name', true );
        $req_last = get_user_meta( $customer_id, 'billing_last_name', true );
        $req_email = get_user_meta( $customer_id, 'billing_email', true );
        $req_address = get_user_meta( $customer_id, 'billing_address_1', true );
        $req_address2 = get_user_meta( $customer_id, 'billing_address_2', true );
        $req_city = get_user_meta( $customer_id, 'billing_city', true );
        $req_state = get_user_meta( $customer_id, 'billing_state', true );
        $req_zip = get_user_meta( $customer_id, 'billing_postcode', true );
        $req_phone = get_user_meta( $customer_id, 'billing_phone', true );
    }
    //Fields not dependent on customer type
    $req_neighborhood = rgar( $entry, '9' );
    $req_lot = rgar( $entry, '10' );
    $req_block = rgar( $entry, '11' );
    $req_products = maybe_unserialize( rgar( $entry, '18' ) );
    $address = array(
        'first_name' => $req_first,
        'last_name'  => $req_last,
        'email'      => $req_email,
        'phone'      => $req_phone,
        'address_1'  => $req_address,
        'address_2'  => $req_address2,
        'city'       => $req_city,
        'state'      => $req_state,
        'postcode'   => $req_zip,
        'country'    => 'US'
    );
    /*echo '<pre>';
    var_dump($address);
    echo '</pre>';
    echo '<pre>';
    var_dump($req_products);
    echo '</pre>';*/
    //Get product links from options page
    $earnest = get_field('earnest_money','option');
    $appraisal = get_field('appraisal','option');
    $other = get_field('other','option');

    //create order
    $order = wc_create_order();
    $order->set_address( $address, 'billing' );
    //loop through and setup products
    foreach($req_products as $value) {
        //get the product and match to product in woo
        if($value['Description'] == 'Earnest Money') {
            $product = wc_get_product( $earnest );
        } elseif($value['Description'] == 'Option Money'){
            $product = wc_get_product( $appraisal );
        } else {
            $product = wc_get_product( $other );
        }
        $clean_price = str_replace(' ', '', $value['Price']);
        $clean_price = str_replace(',', '', $clean_price);
        $product->set_price( $clean_price );
        $order->add_product( $product, 1);
    }
    $order->update_meta_data( '_locale_neighborhood', $req_neighborhood );
    $order->update_meta_data( '_locale_lot', $req_lot );
    $order->update_meta_data( '_locale_block', $req_block );
    $order->update_meta_data( '_locale_address', $req_address );
    $order->update_meta_data( '_locale_city', $req_city );
    $order->update_meta_data( '_locale_zip', $req_zip );
    //$order->set_customer_id($customer_id);
    $order->calculate_totals();
    $order->save();

    $mailer = WC()->mailer();
    $mails = $mailer->get_emails();
    if ( ! empty( $mails ) ) {
        foreach ( $mails as $mail ) {
            if ( $mail->id == 'customer_invoice' ) {
               $mail->trigger( $order->get_order_number() );
            }
         }
    }
    $user = wp_get_current_user();
    $arg = array(
        'ID' => $order->get_order_number(),
        'post_author' => $user->ID,
    );
    wp_update_post( $arg );



    //$invoice = new WC_Email_Customer_Invoice();
    //$invoice->trigger($order->get_order_number());
    //WC()->mailer()->get_emails()['WC_Email_New_Order']->trigger( $order_id );
    //$order->update_status("Completed", 'Imported order', TRUE);

}
add_action( 'gform_after_submission_1', 'create_new_request', 10, 2 );

//Setup dropdown values of existing customers
add_filter( 'gform_pre_render_1', 'populate_posts' );
add_filter( 'gform_pre_validation_1', 'populate_posts' );
add_filter( 'gform_pre_submission_filter_1', 'populate_posts' );
add_filter( 'gform_admin_pre_render_1', 'populate_posts' );
function populate_posts( $form ) {

    foreach ( $form['fields'] as &$field ) {

        if ( $field->type != 'select' || strpos( $field->cssClass, 'customer-list' ) === false ) {
            continue;
        }

        // you can add additional parameters here to alter the posts that are retrieved
        // more info: http://codex.wordpress.org/Template_Tags/get_posts
        $customers = get_users( 'orderby=nicename&role=customer' );

        $choices = array();

        foreach ( $customers as $customer ) {
            $name = get_user_meta( $customer->ID, 'billing_first_name', true ).' '.get_user_meta( $customer->ID, 'billing_last_name', true );
            $choices[] = array( 'text' => $name, 'value' => $customer->ID );
        }

        // update 'Select a Post' to whatever you'd like the instructive option to be
        $field->placeholder = 'Select a Customer';
        $field->choices = $choices;

    }

    return $form;
}
if( function_exists('acf_add_options_page') ) {

	acf_add_options_page(array(
		'page_title' 	=> 'Global Options',
		'menu_title'	=> 'Global Options',
		'menu_slug' 	=> 'global-options',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));
    acf_add_options_page(array(
		'page_title' 	=> 'Account Settings',
		'menu_title'	=> 'Account Settings',
		'menu_slug' 	=> 'account-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));
}
//Reports
add_filter( 'woocommerce_reports_order_statuses', 'my_custom_order_status_for_reports', 10, 1 );
function my_custom_order_status_for_reports($order_statuses){
    if( isset($_GET['report']) ){
        if($_GET['report'] == 'pending') {
            $order_statuses = array('pending');
        } elseif($_GET['report'] == 'all') {
            $order_statuses = array('completed','pending');
        }
    }

    return $order_statuses;
}
add_filter( 'woocommerce_admin_reports', 'remove_admin_reports' );
function remove_admin_reports( $reports ) {
    unset( $reports['stock'] );
    unset( $reports['customers'] );
    unset( $reports['orders']['reports']['sales_by_category'] );
    unset( $reports['orders']['reports']['downloads'] );
    unset( $reports['orders']['reports']['coupon_usage'] );
    //echo '<pre>';var_dump($reports['orders']);echo '</pre>';
    $reports['orders']['title'] = 'Reports';
    $reports['orders']['reports']['sales_by_date']['title'] = 'Completed by date';
    $reports['orders']['reports']['sales_by_product']['title'] = 'Completed by product';
    $reports['orders']['reports']['pending'] = array(
        'title'       => __( 'Pending by date', 'woocommerce' ),
        'description' => '',
        'hide_title'  => true,
        'callback'    => 'orders_by_status',
    );
    $reports['orders']['reports']['all'] = array(
        'title'       => __( 'All by date', 'woocommerce' ),
        'description' => '',
        'hide_title'  => true,
        'callback'    => 'orders_by_status',
    );
    $reports['orders']['reports']['block'] = array(
        'title'       => __( 'By Block', 'woocommerce' ),
        'description' => '',
        'hide_title'  => true,
        'callback'    => 'by_block',
    );

    return $reports;
}
function get_daily_purchases_total(){
    global $wpdb;

    return $wpdb->get_var( "
        SELECT DISTINCT SUM(pm.meta_value)
        FROM {$wpdb->prefix}posts as p
        INNER JOIN {$wpdb->prefix}postmeta as pm ON p.ID = pm.post_id
        WHERE p.post_type LIKE 'shop_order'
        AND p.post_status IN ('wc-processing','wc-completed')
        AND pm.meta_key LIKE '_order_total'
    " );
}
function change_report_status($order_statuses) {
    $order_statuses = array('pending');
    return $order_statuses;
}
function by_block() {
    global $wpdb;
    global $woocommerce;
    echo '<table class="report-table" cellspacing="0" cellpadding="0">';
    echo '<thead><tr><th>Block Name</th><th>Requests</th><th>Total</th></tr></thead><tbody>';
    $blocks_lookup = $wpdb->get_results( 'SELECT DISTINCT meta_value FROM wp_postmeta WHERE meta_key = "_locale_block"' );
    $blocks = array();
    foreach ($blocks_lookup as $block) {
        $blocks[] =$block->meta_value;
    }
    foreach($blocks as $block) {
        $args = array(
            'post_type' => 'shop_order',
            'posts_per_page' => -1,
            'post_status' => 'any',
            'meta_query' => array(
                array(
                    'key' => '_locale_block',
                    'value' => $block
                )
            )
        );
        $query = new WP_Query( $args );
        $total = 0;
        foreach ($query->posts as $order) {
            //echo $order->ID;
            $current_order = wc_get_order( $order->ID );
            $total = $total + $current_order->get_total();
        }
        if($block == '') {
            $block = 'Empty';
        }
        $count = $query->found_posts;
        echo '<tr><td>'.$block.'</td>';
        echo '<td>'.$count.'</td>';
        echo '<td>$'.number_format((float)$total, 2, ".", "").'</td></tr>';
    }
    echo '</tbody></table>';
}
function orders_by_status(){
    echo WC_Admin_Reports::get_report('sales_by_date');
}
function redirect_admin( $redirect_to, $request, $user ){
    //is there a user to check?
    if ( isset( $user->roles ) && is_array( $user->roles ) ) {
        if ( in_array( 'shop_manager', $user->roles ) || in_array( 'sales_person', $user->roles ) ) {
            $redirect_to = admin_url().'admin.php?page=newRequest'; // Your redirect URL
        }
    }
    return $redirect_to;
}

add_filter( 'login_redirect', 'redirect_admin', 10, 3 );

/**
 * Add a custom field (in an order) to the emails
 */
add_filter( 'woocommerce_email_order_meta_fields', 'custom_woocommerce_email_order_meta_fields', 10, 3 );

function custom_woocommerce_email_order_meta_fields( $fields, $sent_to_admin, $order ) {
    $fields['_locale_neighborhood'] = array(
        'label' => __( 'Neighborhood' ),
        'value' => get_post_meta( $order->id, '_locale_neighborhood', true ),
    );
    $fields['_locale_lot'] = array(
        'label' => __( 'Lot' ),
        'value' => get_post_meta( $order->id, '_locale_lot', true ),
    );
    $fields['_locale_block'] = array(
        'label' => __( 'Block' ),
        'value' => get_post_meta( $order->id, '_locale_block', true ),
    );
    /*$fields['_locale_city'] = array(
        'label' => __( 'City' ),
        'value' => get_post_meta( $order->id, '_locale_city', true ),
    );
    $fields['_locale_zip'] = array(
        'label' => __( 'Zip Code' ),
        'value' => get_post_meta( $order->id, '_locale_zip', true ),
    );*/
    /*$fields['_locale_dob'] = array(
        'label' => __( 'Date of Birth' ),
        'value' => get_post_meta( $order->id, '_locale_dob', true ),
    );*/
    /*$fields['_locale_ssn'] = array(
        'label' => __( 'Social Security' ),
        'value' => get_post_meta( $order->id, '_locale_ssn', true ),
    );*/
    return $fields;
}
/*Remove Extra Roles*/
if( get_role('subscriber') ){
    remove_role( 'subscriber' );
}
if( get_role('wpseo_manager') ){
    remove_role( 'wpseo_manager' );
}
if( get_role('wpseo_editor') ){
    remove_role( 'wpseo_editor' );
}
if( get_role('editor') ){
    remove_role( 'editor' );
}
if( get_role('contributor') ){
    remove_role( 'contributor' );
}
if( get_role('client') ){
    remove_role( 'client' );
}
if( get_role('author') ){
    remove_role( 'author' );
}
/*Add columsn to order list*/

function sv_wc_cogs_add_order_profit_column_header( $columns ) {

    $new_columns = array();

    foreach ( $columns as $column_name => $column_info ) {

        $new_columns[ $column_name ] = $column_info;

        if ( 'order_number' === $column_name ) {
            $new_columns['order_neigh'] = __( 'Neighborhood', 'my-textdomain' );
        }
    }

    return $new_columns;
}
add_filter( 'manage_edit-shop_order_columns', 'sv_wc_cogs_add_order_profit_column_header', 20 );
if ( ! function_exists( 'sv_helper_get_order_meta' ) ) :

    /**
     * Helper function to get meta for an order.
     *
     * @param \WC_Order $order the order object
     * @param string $key the meta key
     * @param bool $single whether to get the meta as a single item. Defaults to `true`
     * @param string $context if 'view' then the value will be filtered
     * @return mixed the order property
     */
    function sv_helper_get_order_meta( $order, $key = '', $single = true, $context = 'edit' ) {

        // WooCommerce > 3.0
        if ( defined( 'WC_VERSION' ) && WC_VERSION && version_compare( WC_VERSION, '3.0', '>=' ) ) {

            $value = $order->get_meta( $key, $single, $context );

        } else {

            // have the $order->get_id() check here just in case the WC_VERSION isn't defined correctly
            $order_id = is_callable( array( $order, 'get_id' ) ) ? $order->get_id() : $order->id;
            $value    = get_post_meta( $order_id, $key, $single );
        }

        return $value;
    }

endif;
/**
 * Adds 'Profit' column content to 'Orders' page immediately after 'Total' column.
 *
 * @param string[] $column name of column being displayed
 */
function sv_wc_cogs_add_order_profit_column_content( $column ) {
    global $post;

    if ( 'order_neigh' === $column ) {

        $order    = wc_get_order( $post->ID );

        $neighborhood = sv_helper_get_order_meta( $order, '_locale_neighborhood' );

        echo $neighborhood;
    }
}
add_action( 'manage_shop_order_posts_custom_column', 'sv_wc_cogs_add_order_profit_column_content' );

function change_role_name() {
    global $wp_roles;

    if ( ! isset( $wp_roles ) )
        $wp_roles = new WP_Roles();

    //You can list all currently available roles like this...
    //$roles = $wp_roles->get_names();
    //print_r($roles);

    //You can replace "administrator" with any other role "editor", "author", "contributor" or "subscriber"...
    $wp_roles->roles['shop_manager']['name'] = 'Manager';
    $wp_roles->role_names['shop_manager'] = 'Manager';
}
add_action('init', 'change_role_name');

function add_author_support_to_orders() {
   add_post_type_support( 'shop_order', 'author' );
}
add_action( 'init', 'add_author_support_to_orders' );


add_action( 'pre_get_posts', 'filter_listing_by_author' );

function filter_listing_by_author( $wp_query_obj ) {
    // Front end, do nothing
    if( !is_admin() )
        return;

    global $current_user, $pagenow;
    $user = wp_get_current_user();

    // http://php.net/manual/en/function.is-a.php
    if( !is_a( $current_user, 'WP_User') )
        return;

    // Not the correct screen, bail out
    if( 'edit.php' != $pagenow )
        return;

    // Not the correct post type, bail out
    if( 'shop_order' != $wp_query_obj->query['post_type'] )
        return;

    // If the user is not administrator, filter the post listing
    if(in_array( 'sales_person', (array) $user->roles )) {
        $wp_query_obj->set('author', $user->ID );
    }
}
add_action('add_meta_boxes', 'change_author_metabox');
function change_author_metabox() {
    global $wp_meta_boxes;
    /*echo '<pre>';
    var_dump($wp_meta_boxes);
    echo '</pre>';*/
    $wp_meta_boxes['shop_order']['normal']['core']['authordiv']['title']= 'Creator';
}
