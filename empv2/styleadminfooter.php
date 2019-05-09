<div class="fixed-bottom admin-footer">
	<p>Copyright &copy; <?php echo date('Y'); ?> Earnest Money Pro, Inc.</p>
</div>

<?php
$api = getDwollaAPIKeys();
	$dwolla = dwollaRefreshToken();
	DwollaSwagger\Configuration::$access_token = $dwolla->access_token;
	$apiClient = new DwollaSwagger\ApiClient($api['api_url']);
	$customersApi = new DwollaSwagger\CustomersApi($apiClient);
	$dwolla_id = get_user_meta( get_current_user_id(), 'dwolla_id', true );
	$docs = get_user_meta( get_current_user_id(), 'dwolla_docs', true );
	$notified = get_user_meta( get_current_user_id(), 'notified', true );
	$customer = $customersApi->getCustomer($dwolla_id);
	if(!empty($docs)){
		?>
		<div class="notice-dwolla-error document" style="margin-bottom:5px;">
			<div>
				<p>
				<em><i class="fas fa-info-circle"></i></em>Your account is not ready to receive or send payments yet! you can check for account status <a href="<?php echo site_url(); ?>/wp-admin/admin.php?page=emp-settings#account_verification">here</a><span><i class="fas fa-times"></i></span>
				</p>
			</div>
		</div>
		<?php
	}else{
		if($customer->status == "document" || $customer->status == "retry"){
		?>
			<div class="notice-dwolla-error retry" style="margin-bottom:5px;">
			<div>
				<h2>Uh oh! We need more information to activate your account.</h2>
				<p><em><i class="fas fa-info-circle"></i></em><b>It seems your account is not ready to receive or send any payments yet!</b> <br /><br />Not to worry.  We just need a little bit more information about you to verify your account. <br /><br /><a href="<?php echo site_url(); ?>/wp-admin/admin.php?page=emp-settings#account_verification" class="ActivateAccountButton">Please activate your account here</a><span><i class="fas fa-times"></i></span></p>
			</div>
			</div>
		<?php
		}else if($customer->status == "suspended"){
		?>
			<div class="notice-dwolla-error suspended" style="margin-bottom:5px;">
				<div>
					<p><em><i class="fas fa-info-circle"></i></em>Your account is suspended! Please contact the administrator to resolve this issue.<span><i class="fas fa-times"></i></span></p>
				</div>
			</div>
		<?php
		}else if($customer->status == "verified" && empty($notified)){
		?>
			<div class="notice-dwolla-error verified" style="margin-bottom:5px;">
				<div>
					<p><em><i class="fas fa-info-circle"></i></em>Congratulations, Your account is verified.<br>Ready to receive or send payment request. <span><i class="fas fa-times"></i></span></p>
				</div>
			</div>
		<?php
		 update_user_meta( get_current_user_id(), 'notified', "yes" );
		}
	}
?>
<script>
jQuery(".notice-dwolla-error span").click(function(){
	jQuery(".notice-dwolla-error").fadeOut();
});
</script>