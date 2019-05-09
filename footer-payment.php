	<!--<footer id="colophon" class="payment-footer" role="contentinfo">
		<div class="contact-container">
			<h3>Have any questions?</h3>
			<ul class="contact-options group">
				<?php
					$email = get_field('company_email','option');
					if($email):
				?>
				<li><a href = "mailto:<?php echo $email; ?>"><?php include('_svg/icon-mail.php'); ?><?php echo $email; ?></a></li>
				<?php
					endif;
					$phone = get_field('company_phone','option');
					if($phone):
				?>
				<li><a href = "tel:<?php echo $phone; ?>"><?php include('_svg/icon-phone.php'); ?><?php echo $phone; ?></a></li>
				<?php endif; ?>
			</ul>
		</div>
	</footer>-->
</div>
<?php wp_footer(); ?>
<script>
jQuery(document).ready(function() {
    jQuery('#place_order').text('Pay Now');
});
</script>
<!-- Start Visual Website Optimizer Asynchronous Code -->
<script type='text/javascript'>
var _vwo_code=(function(){
var account_id=335938,
settings_tolerance=2000,
library_tolerance=2500,
use_existing_jquery=false,
/* DO NOT EDIT BELOW THIS LINE */
f=false,d=document;return{use_existing_jquery:function(){return use_existing_jquery;},library_tolerance:function(){return library_tolerance;},finish:function(){if(!f){f=true;var a=d.getElementById('_vis_opt_path_hides');if(a)a.parentNode.removeChild(a);}},finished:function(){return f;},load:function(a){var b=d.createElement('script');b.src=a;b.type='text/javascript';b.innerText;b.onerror=function(){_vwo_code.finish();};d.getElementsByTagName('head')[0].appendChild(b);},init:function(){settings_timer=setTimeout('_vwo_code.finish()',settings_tolerance);var a=d.createElement('style'),b='body{opacity:0 !important;filter:alpha(opacity=0) !important;background:none !important;}',h=d.getElementsByTagName('head')[0];a.setAttribute('id','_vis_opt_path_hides');a.setAttribute('type','text/css');if(a.styleSheet)a.styleSheet.cssText=b;else a.appendChild(d.createTextNode(b));h.appendChild(a);this.load('//dev.visualwebsiteoptimizer.com/j.php?a='+account_id+'&u='+encodeURIComponent(d.URL)+'&r='+Math.random());return settings_timer;}};}());_vwo_settings_timer=_vwo_code.init();
</script>
<!-- End Visual Website Optimizer Asynchronous Code -->
</body>
</html>
