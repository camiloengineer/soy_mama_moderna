(function($){
$(document).ready(function() {

	'use strict';

	// Welcome message
	$('#mgt-welcome-message-show-steps').on('click', function(e){
		$('.mgt-welcome-message-show-steps').slideUp();
		$('.mgt-welcome-message-steps-wrapper').slideDown();
		$('div.mgt-welcome-message.updated').css('border-color', '#0091CD');
	});

	function setCookie (name, value, expires, path, domain, secure) {
	      document.cookie = name + "=" + escape(value) +
	        ((expires) ? "; expires=" + expires : "") +
	        ((path) ? "; path=" + path : "") +
	        ((domain) ? "; domain=" + domain : "") +
	        ((secure) ? "; secure" : "");
	}
	function getCookie(name) {
		var cookie = " " + document.cookie;
		var search = " " + name + "=";
		var setStr = null;
		var offset = 0;
		var end = 0;
		if (cookie.length > 0) {
			offset = cookie.indexOf(search);
			if (offset != -1) {
				offset += search.length;
				end = cookie.indexOf(";", offset)
				if (end == -1) {
					end = cookie.length;
				}
				setStr = unescape(cookie.substring(offset, end));
			}
		}
		return(setStr);
	}
	
});
})(jQuery);