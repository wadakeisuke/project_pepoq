jQuery(function(){

	/* boxlink */
	var boxLink = jQuery(".box-link, .box-half, .box-full");
	jQuery(boxLink).click(function(){
      window.location = jQuery(this).find("a").attr("href");
    });


    /* EqualHeight */
	var biggestHeight = 0;
	jQuery('.equal-height').each(function() {
	    if (jQuery(this).height() > biggestHeight) {
	        biggestHeight = jQuery(this).height();
	    }
	}).height(biggestHeight);


    /* Scroll to top */
    jQuery('a[href*=#]:not(#tabs li > a)').click(function() {
		if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
			var target = jQuery(this.hash);
				target = target.length && target || jQuery('[name=' + this.hash.slice(1) +']');
			if (target.length) {
				var targetOffset = target.offset().top;
				jQuery('html, body').animate({scrollTop: targetOffset}, 1000);
				return false;
			}
		}
	});
	

	/* jQuery UI Tabs */
	jQuery('#tabs').tabs();
});