<?php 
/*
* template name: sign up
*/
get_header();

if(isset($_POST['register'])){
	$logo           = site_url()."/wp-content/uploads/2017/09/logo.png";
	$first_name     = $_POST['first_name'];
	$last_name      = $_POST['last_name'];
	$email          = $_POST['email'];
	$business_type  = $_POST['business_type'];
	$business_name  = $_POST['business_name'];
	$address_1      = $_POST['address_1'];
	$address_2      = $_POST['address_2'];
	$city           = $_POST['city'];
	$state          = $_POST['state'];
	$postal_code    = $_POST['postal_code'];
	$date_of_birth  = $_POST['date_of_birth'];
	$ssn            = $_POST['ssn'];
	$phone_number   = $_POST['phone_number'];
	$routing_number = $_POST['routing_number'];
	$account_number = $_POST['account_number'];
	$account_type   = $_POST['account_type'];
	$account_name   = $_POST['account_name'];
	$super_user   ="0";
	$status   = "active";
	$full_name = $first_name.' '.$last_name;
	
	//auto populate pdf
	$pdf_title = get_user_meta( 5, 'pdf_title', true );
	$pdf_body_title = get_user_meta( 5, 'pdf_body_title', true );
	$pdf_body_content = get_user_meta( 5, 'pdf_body_content', true );
	$pdf_footer_note = get_user_meta( 5, 'pdf_footer_note', true );
	
	//auto populate TAX percent
	$tax = get_user_meta( 5, 'product_vat', true );
	
	//auto populate pdf
	$mail_subject = get_user_meta( 5, 'mail_subject', true );
	$email_body = get_user_meta( 5, 'email_body', true );
	
	
  if(
    isset($logo) &&
    isset($first_name) &&
    isset($last_name) &&
    isset($email) &&
    isset($business_type) &&
    isset($business_name) &&
    isset($address_1) &&
    isset($city) &&
    isset($state) &&
    isset($postal_code) &&
    isset($date_of_birth) &&
    isset($ssn) &&
    isset($phone_number) &&
    isset($routing_number) &&
    isset($account_number) &&
    isset($account_type) &&
    isset($account_name)
  ){

    $user_id = username_exists( $email );

    if ( !$user_id ) {

      $random_password = wp_generate_password( $length=12, $include_standard_special_chars=false );

      $user_id = wp_create_user( $email, $random_password, $email );

      if ( !is_wp_error( $user_id ) ) {

        wp_update_user( array( 'ID' => $user_id, 'first_name' => $first_name, 'last_name' => $last_name ) );
        update_user_meta( $user_id, 'logo', $logo );
        update_user_meta( $user_id, 'business_type', $business_type );
        update_user_meta( $user_id, 'business_name', $business_name );
        update_user_meta( $user_id, 'address_1', $address_1 );
        update_user_meta( $user_id, 'address_2', $address_2 );
        update_user_meta( $user_id, 'city', $city );
        update_user_meta( $user_id, 'state', $state );
        update_user_meta( $user_id, 'postal_code', $postal_code );
        update_user_meta( $user_id, 'date_of_birth', $date_of_birth );
        update_user_meta( $user_id, 'ssn', $ssn );
        update_user_meta( $user_id, 'phone_number', $phone_number );
        update_user_meta( $user_id, 'routing_number', $routing_number );
        update_user_meta( $user_id, 'account_number', $account_number );
        update_user_meta( $user_id, 'account_type', $account_type );
        update_user_meta( $user_id, 'account_name', $account_name );
        update_user_meta( $user_id, 'super_user', $super_user );
        update_user_meta( $user_id, 'status', $status );
		
		update_user_meta( $user_id, 'pdf_title', $pdf_title );
		update_user_meta( $user_id, 'pdf_body_title', $pdf_body_title );
		update_user_meta( $user_id, 'pdf_body_content', $pdf_body_content );
		update_user_meta( $user_id, 'pdf_footer_note', $pdf_footer_note );
		update_user_meta( $user_id, 'product_vat', $product_vat );
		update_user_meta( $user_id, 'mail_from_email', $email );
		update_user_meta( $user_id, 'mail_from_name', $full_name );
		update_user_meta( $user_id, 'mail_subject', $mail_subject );
		update_user_meta( $user_id, 'email_body', $email_body );

        $u = new WP_User( $user_id );
		$u->set_role( 'client' );
		

        createClientMailcontent($full_name, $email, $random_password);
        
        $response = array('message' => 'New Account Successfully created.', 'status' => 'success');

      } else {
        $response = array('message' => 'Failed to save information, please try again.', 'status' => 'error');
      }

    } else {
      $response = array('message' => 'Email already exist.', 'status' => 'error');
    }


  } else {
    $response = array('message' => 'Failed to save information, please try again.', 'status' => 'error');
  }
}
?>
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/css/bootstrap.css?ver=4.7.4" type="text/css" media="all">
<div class="inner-page-container ">
<div class="inner-content">

<form method="post" action="" id="registration">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <h2 class="modal-title">Registration</h2>
         </div>
         <div class="modal-body">
            <div id="addClient-wizard">
			<?php if(!empty($response)){ $ms = $response['status']?>
				<div class="nofitication <?php echo $ms; ?>"><?php echo $response['message']; ?></div>
			<?php } ?>
               <div>
                  <div id="step-1" class="">
					<h4>Account Information</h4>
                     <div class="form" style="margin-top: 1em;">

                        <div class="col-md-12" style="display:none;">
                           <div class="row">
                              <div class="col-md-3">
                                 <p>Logo</p>
                              </div>
                              <div class="col-md-9 custom-file-upload">
                                 <input type="file" id="file" class="form-control" name="logo">
                              </div>
                           </div>
                        </div>

                        <div class="col-md-12">
                           <div class="row">
                              <div class="col-md-3">
                                 <p>Name</p>
                              </div>
                              <div class="col-md-9">
                                 <div class="col-md-6 no-padding-l padding-half-r">
                                    <input type="text" class="form-control" name="first_name" placeholder="First Name">
                                 </div>
                                 <div class="col-md-6 no-padding-r padding-half-l">
                                    <input type="text" class="form-control" name="last_name" placeholder="Last Name">
                                 </div>
                              </div>
                           </div>
                        </div>

                        <div class="col-md-12">
                           <div class="row">
                              <div class="col-md-3">
                                 <p>Email</p>
                              </div>
                              <div class="col-md-9">
                                 <input type="text" class="form-control" name="email">
                              </div>
                           </div>
                        </div>

                        <div class="col-md-12">
                           <div class="row">
                              <div class="col-md-3">
                                 <p>Business Type</p>
                              </div>
                               <div class="col-md-9">
                                 <div class="form-group">
                                    <select class="form-control" name="business_type">
                                       <option value="corporation">Corporation</option>
                                       <option value="llc">LLC</option>
                                       <option value="partnership">Partnership</option>
                                       <option value="soleproprietorship">Soleproprietorship</option>
                                    </select>
                                 </div>
                              </div>
                           </div>
                        </div>

                        <div class="col-md-12">
                           <div class="row">
                              <div class="col-md-3">
                                 <p>Business Name</p>
                              </div>
                              <div class="col-md-9">
                                 <input type="text" class="form-control" name="business_name">
                              </div>
                           </div>
                        </div>

                        <div class="col-md-12">
                           <div class="row">
                              <div class="col-md-3">
                                 <p>Address 1</p>
                              </div>
                              <div class="col-md-9">
                                 <input type="text" class="form-control" name="address_1">
                              </div>
                           </div>
                        </div>

                        <div class="col-md-12">
                           <div class="row">
                              <div class="col-md-3">
                                 <p>Address 2</p>
                              </div>
                              <div class="col-md-9">
                                 <input type="text" class="form-control" name="address_2">
                              </div>
                           </div>
                        </div>

                        <div class="col-md-12">
                           <div class="row">
                              <div class="col-md-4">
                                 <p>City</p>
								 <input type="text" class="form-control" name="city">
                              </div>
                              <div class="col-md-4">
                                 <p>State</p> <input type="text" class="form-control" name="state">
                              </div>
							  <div class="col-md-4">
                                 <p>Postal Code</p><input type="text" class="form-control" name="postal_code" maxlength="5" id="form-number">
                              </div>
                           </div>
                        </div>

                        <div class="col-md-12">
                           <div class="row">
                              <div class="col-md-4">
                                 <p>Date of Birth</p><input type="text" class="form-control datetimepicker" name="date_of_birth">
                              </div>
                              <div class="col-md-4">
                                 <p>EIN <small>(last 4)</small></p><input type="text" class="form-control" name="ssn" maxlength="4" id="input-number">
                              </div>
							  <div class="col-md-4">
                                 <p>Phone</p><input type="text" class="form-control" name="phone_number" maxlength="14" id="form-phone" placeholder="(123) 456-7890">
                              </div>
                           </div>
                        </div>

                        <div class="clearfix"></div>
                     </div>
                  </div>

                  <div id="step-2" class="">
					<h4>Bank Information</h4>
                     <div class="form" style="margin-top: 1em;">
                        <div class="col-md-12">
                           <div class="row">
                              <div class="col-md-4">
                                 <p>Routing Number</p>
                              </div>
                              <div class="col-md-8">
                                 <input type="text" class="form-control" name="routing_number" maxlength="9" id="form-number">
                              </div>
                           </div>
                        </div>

                        <div class="col-md-12">
                           <div class="row">
                              <div class="col-md-4">
                                 <p>Account Number</p>
                              </div>
                              <div class="col-md-8">
                                 <input type="text" class="form-control" name="account_number" maxlength="20" id="form-number">
                              </div>
                           </div>
                        </div>

                        <div class="col-md-12">
                           <div class="row">
                              <div class="col-md-4">
                                 <p>Account Type</p>
                              </div>
                              <div class="col-md-8">
                                 <div class="form-group">
                                    <select class="form-control" name="account_type">
                                       <option value="checking">Checking</option>
                                       <option value="savings">Savings</option>
                                    </select>
                                 </div>
                              </div>
                           </div>
                        </div>

                        <div class="col-md-12">
                           <div class="row">
                              <div class="col-md-4">
                                 <p>Name of Account</p>
                              </div>
                              <div class="col-md-8">
                                 <input type="text" class="form-control" name="account_name">
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
				  <div style="clear:both;"></div>
					<div class="col-md-12">
                           <div class="row"><input type="submit" name="register" value="Register Now" /></div>
					</div>
					<div style="clear:both;"></div>
               </div>
            </div>
         </div>
      </div>
   </div>
</form>
</div>
</div>
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri()."/css/bootstrap-datetimepicker.css"; ?>" type="text/css" media="all">
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri()."/css/summernote.css"; ?>" type="text/css" media="all">
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri()."/js/emp_media_uploader.js"; ?>"></script>
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri()."/js/moment.min.js"; ?>"></script>
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri()."/js/summernote.min.js"; ?>"></script>
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri()."/js/bootstrap-datetimepicker.min.js"; ?>"></script>
<script>
jQuery('.datetimepicker').datetimepicker({
	viewMode: 'years',
	format: 'YYYY-MM-DD'
});
</script>
<?php get_footer(); ?>