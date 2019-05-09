<?php
/**
 * Template Name: Payment
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 *
 */

get_header('payment'); ?>

	<div id="primary" class="content-area payment-body">
		<div class="wrap group">

			<?php while ( have_posts() ) : the_post();
				the_content();
			endwhile; // end of the loop. ?>
			<div class="payment-terms">
				<p>By using our service for payment you are agreeing to our <a href = "<?php bloginfo('template_directory'); ?>/cust_tos.pdf" target="_blank">Terms of Service</a> and <a href = "<?php bloginfo('template_directory'); ?>/privacy_policy.pdf" target="_blank">Privacy Policy</a>.</p>
			</div>
		</div><!-- #wrap -->
	</div><!-- #primary -->
<script>
	jQuery(window).load(function() {
		$("button:contains('ACH')").text('ACH (check)');
	});
</script>
<?php //get_sidebar(); ?>
<?php get_footer('payment'); ?>
