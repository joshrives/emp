<link rel="stylesheet" type="text/css" href="<?php bloginfo('wpurl'); ?>/wp-content/plugins/emp/admin/styles.css">
<script defer src="https://use.fontawesome.com/releases/v5.0.9/js/all.js" integrity="sha384-8iPTk2s/jMVj81dnzb/iFR2sdA7u06vHJyyLlAd4snFpCl/SnyUjRrbdJsw1pGIl" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<!---<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>--->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<div class="mainHeader">
	<nav class="navbar navbar-expand-md navbar-dark bg-dark emp-style">
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse justify-content-md-center" id="navbarsExample04">
			<div class="littleLogo" style="position:absolute; left:0; margin-left:20px;">
				<img class="empLogo" src="<?php bloginfo('wpurl'); ?>/wp-content/plugins/emp/admin/empadminlogo.png">
			</div>
			<ul class="navbar-nav">
				<li class="nav-item">
					<a class="nav-link" href="<?php bloginfo('wpurl'); ?>/wp-admin/admin.php?page=emp-menu"><i class="fas fa-home"></i><br />Home</a>
				</li>
				<li class="nav-item">
					<?php
						$user_id = get_current_user_id();
						
						if($user_id == 2){
							?>
							<a class="nav-link" href="<?php bloginfo('wpurl'); ?>/wp-admin/admin.php?page=emp-client"><i class="fas fa-users"></i><br />Manage</a>
							<?php
						}else{
							?>
							<a class="nav-link" href="<?php bloginfo('wpurl'); ?>/wp-admin/admin.php?page=manage-sales-person"><i class="fas fa-users"></i><br />Manage</a>
							<?php
						}
					?>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?php bloginfo('wpurl'); ?>/wp-admin/admin.php?page=invoice-list"><i class="fas fa-file-alt"></i><br />Invoice List</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?php bloginfo('wpurl'); ?>/wp-admin/admin.php?page=emp-reports&searchstring&type=user"><i class="fas fa-chart-bar"></i><br />Reports</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?php bloginfo('wpurl'); ?>/wp-admin/admin.php?page=emp-settings"><i class="fas fa-cogs"></i><br />Settings</a>
				</li>
			</ul>
			<div class="loggedInAs">
				<?php 
					global $current_user;
					get_currentuserinfo();
				?>
				<i class="fas fa-address-card"></i> Logged In As: <?php echo $current_user->user_firstname; ?> <?php $current_user->user_lastname; ?><br />
				<a href="<?php echo wp_logout_url(); ?>" class="logoutButton">(Log Out)</a>
			</div>
		</div>
	</nav>
	<nav class="navbar navbar-expand-md navbar-dark bg-dark emp-main-style">
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample05" aria-controls="navbarsExample05" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse justify-content-md-center" id="navbarsExample05">
			<ul class="navbar-nav">
				<li class="nav-item">
					<a class="nav-link" href="<?php bloginfo('wpurl'); ?>/wp-admin/admin.php?page=emp-menu"><i class="fas fa-plus-circle"></i> Make New Request</a>
				</li>
				<li class="nav-item">
					<?php
						if($user_id == 2){
							?>
							<a class="nav-link" href="<?php bloginfo('wpurl'); ?>/wp-admin/admin.php?page=emp-client"><i class="fas fa-clipboard-list"></i> Add A New User</a>
							<?php
						}else{
							?>
							<a class="nav-link" href="<?php bloginfo('wpurl'); ?>/wp-admin/admin.php?page=manage-sales-person"><i class="fas fa-clipboard-list"></i> Add A New User</a>
							<?php
						}
					?>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?php bloginfo('wpurl'); ?>/wp-admin/admin.php?page=invoice-list"><i class="fas fa-retweet"></i> Process Refund</a>
				</li>
			</ul>
		</div>
	</nav>
</div>

