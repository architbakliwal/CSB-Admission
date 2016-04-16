// IIFE - Immediately Invoked Function Expression
(function($, window, document) {

	// The $ is now locally scoped 

   	// Listen for the jQuery ready event on the document
   	$(function() {

   		// The DOM is ready!

   	});
   	
   	
   	//view record set
   	$('#zeTable').on("click", "a.crudView", function(e){
   	
   		temp = $(this).attr('id').split("_");
   		   		
   		recordID = temp[1];
   		
   		_rowIndex = recordID;
   		
   		//save the row element for later
   		_theRow = $(this).closest('tr');
   		
   		//set the heading
   		$('#recordViewModal .modal-header h4').text(_theTable+", record "+recordID);
   		
   		$.ajax({
   			type: "GET",
   			dataType: "json",
   		  	url: _BASE_URL+"/db/getRecord/"+_theTable+"/"+_tablePrimaryKey+"/"+recordID+"/viewrecord"
   		}).done(function(response){

   			if(response.response_code == 2) {
   			
   				$('#recordViewModal_tab1 > .alert-error').each(function(){ $(this).remove() })
   					
   				$('#recordViewModal_tab1').prepend($(response.message));
   				
   				return false;
   			
   			}
   			
   			//empty out the first tab
   			$('#recordViewModal_tab1 > *').each(function(){
   			
   				$(this).remove();
   			
   			});
   			
   			//update the view
   			$('#recordViewModal_tab1').append($(response.record));
   			
   			
   		})
   	
   	})
   	
   	
   	//load a record set
   	$('#zeTable').on("click", "a.crudEdit", function(e){
   	
   		temp = $(this).attr('id').split("_");
   		   				
   		recordID = temp[1];
   		
   		_rowIndex = recordID;
   		
   		//save the row element for later
   		_theRow = $(this).closest('tr');
   				
   		//set the heading
   		$('#recordModal .modal-header h4').text(_theTable+", record "+recordID);
   		
   		$.ajax({
   			type: "GET",
   			dataType: "json",
   		  	url: _BASE_URL+"/db/getRecord/"+_theTable+"/"+_tablePrimaryKey+"/"+recordID
   		}).done(function(response){
   		
   			if(response.response_code == 2) {
   			
   				$('#recordModal_tab1 > .alert-error').each(function(){ $(this).remove() })
   					
   				$('#recordModal_tab1').prepend($(response.message));
   				
   				return false;
   			
   			}
   			
   			$('#recordModal_tab1 > *').each(function(){
   			
   				$(this).remove();
   			
   			});
   			
   			//setup the flat ui checkboxes
   			$('#recordModal_tab1').append($(response.record)).find(":checkbox").checkbox();
   			
   			//setup the chosen select boxes
   			$('#recordModal_tab1 select').chosen({width: '100%'});
   			
   			//auto-resize for text areas
   			$('#recordModal_tab1 textarea').autosize();
   			
   			//setup possible datepicker
   			// jQuery UI Datepicker
   			var datepickerSelector = $('#recordModal_tab1').find('.date');

   			$(datepickerSelector).datepicker({
   				showOtherMonths: true,
   			  	selectOtherMonths: true,
   			  	dateFormat: "yy-mm-dd",
   			  	yearRange: '-1:+1'
   			}).prev('.btn').on('click', function (e) {
   			  e && e.preventDefault();
   			  $(datepickerSelector).focus();
   			});
   					
   			//ajax form for update record
   			$('#recordForm').ajaxForm(function(responseText) {
   			
   				$('#recordModal_save').removeClass('disabled').text('Update record');
   				
   				$('#recordModal_tab1 > .alert-error').each(function(){ $(this).remove() })
   			
   				response = jQuery.parseJSON(responseText);
   			
   				if(responseText.response_code == 2) {
   				
   					$('#recordModal_tab1 > .alert-error').each(function(){ $(this).remove() })
   						
   					$('#recordModal_tab1').prepend($(response.message));
   					
   					return false;
   				
   				} 
   			
   				window.location.hash = '#recordModal_tab1';
   				   				
   				$('#recordModal_tab1').prepend($(response.message));
   				
   				//setup the chosen select boxes
   				$('#recordModal_tab1 select').chosen({width: '100%'});
   				
   				//auto-resize for text areas
   				$('#recordModal_tab1 textarea').autosize();
   				   			
   				//setup possible datepicker
   				// jQuery UI Datepicker
   				var datepickerSelector = $('#recordModal_tab1').find('.date');
   				
   				$(datepickerSelector).datepicker({
   					showOtherMonths: true,
   				   	selectOtherMonths: true,
   				  	dateFormat: "yy-mm-dd",
   				   	yearRange: '-1:+1'
   				}).prev('.btn').on('click', function (e) {
   					e && e.preventDefault();
   				   $(datepickerSelector).focus();
   				});
   				
   				//message self destruct
   				window.setTimeout(function() { $("#recordModal_tab1 > .alert-success").fadeOut(1000, function(){$(this).remove()}); }, 3000);
   				
   				
   				//update the record in the table
   				zeTable.fnReloadAjax();
   				
   			});
   			
   		})
   	
   	});   		
   		
   	$('#recordModal_save').click(function(){
   	
   		//disable button
   		$(this).addClass('disabled').text('Updating record ...');
   		
   		$('form#recordForm').submit();
   	
   	});
   	
   	
   	//record modal event
   	$('#recordModal').on('show.bs.modal', function (e) {
   		
   		//show first tab when modal opens
   		$(this).find('.nav-tabs a:first').tab('show');
   		
   		$('#recordModal .modal-footer > *:not(#recordModal_close)').hide();
   		
   		//first tab's open, show the correct button
   		$('#recordModal .modal-footer > label, #recordModal .modal-footer #recordModal_save').show();
   		
   		
   		
   	});
   	
   	//record modal tab events
   	$('#recordModal .nav-tabs a').on('show.bs.tab', function (e) {
   	
   		//default hide all except close button
   		$('#recordModal .modal-footer > *:not(#recordModal_close)').hide();
   	
   		if($(e.target).parent().index() == 0) {
   		
   			$('#recordModal .modal-footer > label, #recordModal .modal-footer #recordModal_save').show();
   		
   		}
   		
   	});
   	
   	
 }(window.jQuery, window, document));
 // The global jQuery object is passed as a parameter