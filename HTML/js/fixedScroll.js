/* Plugin Fixed Scroll */
(function($) {

	$.fn.fixedScroll    = function() {
	    
        curentElement   = this;
        
		item_position  = curentElement.position();
		navTopVal      = item_position.top;
        navLeftVal     = curentElement.offset().left;
		lastWidth      = curentElement.css('width');
        curentElement.css('transition', 'ease-in 0.1 all');
        
        jQuery(document).scroll(function() {
            screenTop   = document.documentElement.scrollTop;
            if(screenTop) {
                if (document.documentElement.scrollTop > navTopVal) {
					curentElement.css('position', 'fixed');
					curentElement.css('z-index', '200');
					curentElement.css('top', '0');
                    curentElement.css('left', navLeftVal);
					curentElement.css('width', lastWidth);
				} else {
					curentElement.css('position', 'relative');
					curentElement.css('width', lastWidth);
                    curentElement.css('left', 0);
				}
            } else {
                screenTop = jQuery(document).scrollTop();
				if (screenTop > navTopVal) {
					curentElement.css('position', 'fixed');
					curentElement.css('z-index', '200');
					curentElement.css('top', '0');
                    curentElement.css('left', navLeftVal);
					curentElement.css('width', lastWidth);
				} else {
					curentElement.css('position', 'static');
					curentElement.css('width', lastWidth);
                    curentElement.css('left', 0);
				}
            }
		});

		return this;
	};

}(jQuery));