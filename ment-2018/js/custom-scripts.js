// These are the scripts that make the Homepage work
	var $j = jQuery.noConflict();
	(function($) {
 	$(function() {
	$(document).ready(function() {		

		
		
// Add additional class for sidebar "recent post" links
    jQuery(document).ready(function($){
        // Select an a element that has the matching href and apply a class of 'active'. Also prepend a - to the content of the link
        var url = window.location.href;
        $('.widget_recent_entries a[href="'+url+'"]').closest('li').addClass('current-menu-item');
    });
			
	
	});
	});
	})(jQuery);