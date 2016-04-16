// IIFE - Immediately Invoked Function Expression
(function($, window, document) {

	// The $ is now locally scoped 

   	// Listen for the jQuery ready event on the document
   	$(function() {

   		// The DOM is ready!

   	});

	//new role form validation
	$('form#newUserForm').on("submit", function(){
	
		var wereGood = 1;

		if( $(this).find('#firstname').val() == '' ) {
		
			$(this).find('#firstname').parent().addClass('has-error');
			
			wereGood = 0;
		
		} else {
		
			$(this).find('#firstname').parent().removeClass('has-error');
			
			wereGood = 1;
		
		}
		
		if( $(this).find('#lastname').val() == '' ) {
		
			$(this).find('#lastname').parent().addClass('has-error');
			
			wereGood = 0;
		
		} else {
		
			$(this).find('#lastname').parent().removeClass('has-error');
			
			wereGood = 1;
		
		}
		
		if( $(this).find('#email').val() == '' ) {
		
			$(this).find('#email').parent().addClass('has-error');
			
			wereGood = 0;
		
		} else {
		
			$(this).find('#email').parent().removeClass('has-error');
			
			wereGood = 1;
		
		}
		
		if( $(this).find('#password').val() == '' ) {
		
			$(this).find('#password').parent().addClass('has-error');
			
			wereGood = 0;
		
		} else {
		
			$(this).find('#password').parent().removeClass('has-error');
			
			wereGood = 1;
		
		}
		
		if( $(this).find('#group').val() == '' ) {
		
			$(this).find('#group').parent().addClass('has-error');
			
			wereGood = 0;
		
		} else {
		
			$(this).find('#group').parent().removeClass('has-error');
			
			wereGood = 1;
		
		}
		
		
		if(wereGood == 0) {
		
			alert('There are some values missing. Please double check.');
			
			return false;
		
		}

	})

}(window.jQuery, window, document));
// The global jQuery object is passed as a parameter