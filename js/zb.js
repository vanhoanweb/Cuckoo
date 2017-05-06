var $j = jQuery.noConflict();

$j(function() {
	
	//responsive menu
	$j(".nav-primary .zb-nav-menu, .nav-secondary .zb-nav-menu").addClass("responsive-menu").before('<div class="responsive-menu-icon"></div>');

	$j(".responsive-menu-icon").click(function(){
		$j(this).next(".nav-primary .zb-nav-menu, .nav-secondary .zb-nav-menu").slideToggle();
	});

	$j(window).resize(function(){
		if(window.innerWidth > 767) {
			$j(".nav-primary .zb-nav-menu, .nav-secondary .zb-nav-menu, nav .sub-menu").removeAttr("style");
			$j(".responsive-menu > .menu-item").removeClass("menu-open");
		}
	});

	$j(".responsive-menu > .menu-item").click(function(event){
		if (event.target !== this) return;
		$j(this).find(".sub-menu:first").slideToggle(function() {
			$j(this).parent().toggleClass("menu-open");
		});
	});
});
