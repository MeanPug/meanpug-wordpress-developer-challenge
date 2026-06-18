jQuery(document).ready(function($){

	// Mobile menu trigger
	$('#menu_trigger').on('click', function() {
		$('body').toggleClass('menu_open');
	});

	// Add float_active class to body when #header_wrapper touches top of screen
	function checkHeaderPosition() {
		var $headerWrapper = $('#main_header_wrapper');
		var $body = $('body');
		var adminBar = $('#wpadminbar').length ? $('#wpadminbar').height() - 1 : 0;
		
		if ($headerWrapper.length) {
			var headerTop = $headerWrapper.offset().top - adminBar;
			var scrollTop = $(window).scrollTop();
			
			if (scrollTop >= headerTop) {
				$body.addClass('float_active');
			} else {
				$body.removeClass('float_active');
			}
		}
	}
	
	// Check on scroll
	$(window).on('scroll', function() {
		checkHeaderPosition();
	});
	
	// Check on load and resize
	$(window).on('load resize', function() {
		checkHeaderPosition();
	});
	
	// Initial check
	checkHeaderPosition();
});