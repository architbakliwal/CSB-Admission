// IIFE - Immediately Invoked Function Expression
(function($, window, document) {

	// The $ is now locally scoped 

   	// Listen for the jQuery ready event on the document
   	$(function() {

   		// The DOM is ready!

   	});

	//new role form validation
	$('form#newRoleForm').on("submit", function(){

		if( $(this).find('#role').val() == '' ) {
	
			$(this).find('#role').parent().addClass('has-error');
		
			return false;
	
		} else {
		
			$(this).find('#role').parent().removeClass('has-error');
	
		}

	})

}(window.jQuery, window, document));
// The global jQuery object is passed as a parameter