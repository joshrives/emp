<?php
$uid = get_current_user_id();
get_the_ID();
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

// =============================================================================
// HEADER.PHP
// -----------------------------------------------------------------------------
// The site header.
// =============================================================================

?>

<?php x_get_view( 'header', 'base' ); ?>