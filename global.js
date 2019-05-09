(function( $ ) {

	$(document).ready(function(){

		$('<div class="top-bar-content"><div class="x-container max width"><div class="give-a-call"><p>GIVE US A CALL <span><a href="tel:18446663900">1.844.666.3900</a></span></p></div><div class="top-login"><a href="https://empstand.wpengine.com/wp-login.php">LOGIN</a></div></div></div>').insertBefore('.x-navbar-wrap');

		$('<div class="nav-border"></div>').insertAfter('.x-navbar-inner');

		new WOW().init();

		// back to top
		$('<a href="javascript:void(0);" class="cd-top fa">Top</a>').insertAfter('#top');
		var offset = 300,
		offset_opacity = 1200,
		scroll_top_duration = 700,
		$back_to_top = $('.cd-top');

		$(window).scroll(function(){
			( $(this).scrollTop() > offset ) ? $back_to_top.addClass('cd-is-visible') : $back_to_top.removeClass('cd-is-visible cd-fade-out');
			if( $(this).scrollTop() > offset_opacity ) {
				$back_to_top.addClass('cd-fade-out');
			}
		});
		$back_to_top.on('click', function(event){
			event.preventDefault();
			$('body,html').animate({
				scrollTop: 0 ,
			 	}, scroll_top_duration
			);
		});

		$('.home .x-container.max.width.offset').addClass('home-container');

		$('.inner-pages .x-container.max.width.offset').addClass('inner-page-container');

		if ( $( ".wpcf7-form" ).length ){
			$( ".wpcf7-form" ).ajaxComplete( function( event, request, settings ) {
				var $cf7 = $( event.target );

				if ( $cf7.hasClass( 'sent' ) ) {
					// form sent successfully
				} else if ( $cf7.hasClass( 'invalid' ) ) {
					// form has errors
				} else {
					// assume form has failed
				}

				$cf7.find( '.wpcf7-response-output' ).delay( 4000 ).fadeOut( 500 );
			});
		}

	});

	$( document ).on( 'mouseover', ".wpcf7-form input", function(e) {
		$(this).next().fadeOut( 'fast', function() {
			if ( $(this).next().prev().length ) {
				$(this).next().prev().focus();
			}
		});
	});
	$( document ).on( 'mouseover', ".g-recaptcha.wpcf7-recaptcha", function(e) {
		$(this).next().next().fadeOut( 'fast', function() {
			if ( $(this).next().next().prev().length ) {
				$(this).next().next().prev().focus();
			}
		});
	});

})( jQuery );
