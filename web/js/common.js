$(document).ready(function() {
 
	$("#owl-main-slide").owlCarousel({
		// navigation : true, // Show next and prev buttons
		autoPlay: 5000,
		slideSpeed : 300,
		paginationSpeed : 400,
		singleItem:true,
		// transitionStyle: 'fade'
		// "singleItem:true" is a shortcut for:
		// items : 1,
		// itemsDesktop : false,
		// itemsDesktopSmall : false,
		// itemsTablet: false,
		// itemsMobile : false
		// items: 6,
		// singleItem: true,
		// navigation: false,
		// pagination: false,		 
	});

	$('#banner0').owlCarousel({
		items: 6,
		autoPlay: 3000,
		singleItem: true,
		navigation: false,
		pagination: false,
		transitionStyle: 'fade'
	});	

});
	


