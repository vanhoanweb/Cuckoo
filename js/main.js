( function( $ ) {
	/* Responsive Menu */
	$(".nav-primary .menu").addClass("responsive-menu").before('<button class="responsive-menu-icon"></button>');

	$(".responsive-menu-icon").click(function() {
		$(this).next(".nav-primary .menu").slideToggle();
	});

	$(window).resize(function() {
		if(window.innerWidth > 767) {
			$(".nav-primary .menu, nav .sub-menu").removeAttr("style");
			$(".responsive-menu > .menu-item").removeClass("menu-open");
		}
	});

	$(".responsive-menu > .menu-item").click(function(event) {
		if (event.target !== this) return;
		$(this).find(".sub-menu:first").slideToggle(function() {
			$(this).parent().toggleClass("menu-open");
		});
	});

	/* Page scrolling feature - requires jQuery Easing plugin */
	$('.scroll-top').bind('click', function(event) {
		var $anchor = $(this);
		$('html, body').stop().animate({
			scrollTop: $($anchor.attr('href')).offset().top - 100
		}, 1500, 'easeInOutExpo');
		event.preventDefault();
	});

	/* Menu bar fixed on top when scrolled */
	$(window).bind('scroll', function(event) {
		if ($(window).scrollTop() > 100) {
			$('.scroll-top').addClass('show');
		} else {
			$('.scroll-top').removeClass('show');
		}
	});
}( jQuery ) );
