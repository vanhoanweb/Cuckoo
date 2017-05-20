(function($) {	
	/* Responsive Menu */
	$(".nav-primary .zb-nav-menu, .nav-secondary .zb-nav-menu").addClass("responsive-menu").before('<div class="responsive-menu-icon"></div>');
	
	$(".responsive-menu-icon").click(function() {
		$(this).next(".nav-primary .zb-nav-menu, .nav-secondary .zb-nav-menu").slideToggle();
	});

	$(window).resize(function() {
		if(window.innerWidth > 767) {
			$(".nav-primary .zb-nav-menu, .nav-secondary .zb-nav-menu, nav .sub-menu").removeAttr("style");
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
			$('.scroll-top').addClass('fixed');
		} else {
			$('.scroll-top').removeClass('fixed');
		}
	});
}(jQuery));
