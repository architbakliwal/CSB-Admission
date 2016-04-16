// IIFE - Immediately Invoked Function Expression
(function($, window, document) {

	// The $ is now locally scoped 

   	// Listen for the jQuery ready event on the document
   	$(function() {

   		// The DOM is ready!

   	});
   	
   	
   	
   	
   	//load a single cell
   	$('#zeTable').on("click", "div.cell", function(){
   	   	   	
   		_theDIV = $(this);
   		
   		//column name
   		fieldName = $(this).parent().closest('table').find('th').eq($(this).parent().index()).text();
   		_fieldName = fieldName;
   		
   		//row index name
   		temp = $(this).parent().closest('tr').find('td').eq(0).find('span.recordID').attr('id');
   		ttemp = temp.split("_");
   		   		
   		if( ttemp.length == 3 ) {
   		
   			rowIndex = ttemp[1]+"_"+ttemp[2];
   		
   		} else {
   		
   			rowIndex = ttemp[1];
   		
   		}
   		   		
   		_rowIndex = rowIndex;
   		   		    	       		    	    
   		//only allow if this is NOT the first column
   		
   		if($(this).parent().index() != 0) {
   			
   			//update modal header
   			$('#fieldModalLabel span').text(fieldName);
   			
   			/*theData = $(this).html().replace(/&lt;/g, "<").replace(/&gt;/g, ">");
   			
   			var redactorArea = $('#redactorArea');
   			
   			
   			//implement max character if needed
   			if(allFields[fieldName].max_length != 0) {
   			
   				redactorArea.attr('maxlength', allFields[fieldName].max_length);
   				    	    	
   			} else {
   				
   				redactorArea.removeAttr('maxlength');
   			
   			};
   			
   			if(/<[a-z][\s\S]*>/i.test(theData)) {
   			
   				//data contains HTML
   				redactorArea.redactor();
   				redactorArea.redactor('set', theData);
   			
   			} else {
   			
   				//data does not contain HTML
   				redactorArea.redactor();
   				redactorArea.redactor('destroy');
   			
   				redactorArea.val(theData);
   			
   			};*/
   			
   			//empty out the tab
   			$('#cellWrapper > *').each(function(){
   			
   				$(this).remove();
   			
   			})
   			   			
   			//get the field data
   			$.ajax({
   				type: "GET",
   				dataType: "json",
   			  	url: _BASE_URL+"/db/getCell/"+_theTable+"/"+_fieldName+"/"+_rowIndex
   			}).done(function(response){
   			
   				if(response.response_code == 2) {
   				
   					$('#fieldModalLabel_tab1 > .alert-error').each(function(){ $(this).remove() })
   						
   					$('#fieldModalLabel_tab1').prepend($(response.message));
   					
   					return false;
   					
   					return false;
   				
   				}
   								
   				$('#cellWrapper').append( $(response.cell) )
   				
   				//setup the chosen select boxes
   				$('#cellWrapper select').chosen({width: '100%'});
   				
   				//setup the checkboxes
   				$('#cellWrapper').find(':checkbox').checkbox();
   				
   				//setup possible datepicker
   				// jQuery UI Datepicker
   				var datepickerSelector = '#datepicker-99';
   				
   				$(datepickerSelector).datepicker({
   					showOtherMonths: true,
   				  	selectOtherMonths: true,
   				  	dateFormat: "yy-mm-dd",
   				  	yearRange: '-1:+1'
   				}).prev('.btn').on('click', function (e) {
   				  e && e.preventDefault();
   				  $(datepickerSelector).focus();
   				});
   				
   				//auto-resize for text boxes
   				$('#cellWrapper textarea').autosize();
   			
   			});
   			
   			//show modal;
   			$('#fieldModal').modal();
   						
   		}
   	
   	})
   	
   	var _theRow = '';
   	
   	//field saving
   	$('#fieldModal_save').click(function(){
   	
   		//disable button
   		$(this).attr('disabled', true).text("Saving changes ...");
   		
   		//does redactor exist?
   		if($('#fieldModalLabel_tab1').find('.redactor_box').size() > 0) {
   		
   			_fieldValue = $('#redactorArea').redactor('get');
   			   		
   		} else {//nope
   		
   			if( $('#cellWrapper textarea').size() > 0 ) {//regular textarea
   			
   				_fieldValue = $('#cellWrapper textarea').val();
   			
   			} else {//dropdown select for FK values
   		
   				_fieldValue = $('#cellWrapper [name=val]').val();
   			
   			}
   		}
   		
   		$.ajax({
   			type: "POST",
   			dataType: "json",
   		  	url: _BASE_URL+"/db/saveField/"+_theTable+"/"+_fieldName,
   		  	data: { val: _fieldValue, indexName: _tablePrimaryKey, index: _rowIndex, _token: _TOKEN}
   		}).done(function(response){
   		
   			//re-enable the button
   			$('#fieldModal_save').removeAttr('disabled').text("Save changes");
   		
   			if(response.response_code == 2) {
   				
   				$('#fieldModalLabel_tab1 > .alert-error').each(function(){ $(this).remove() })
   					
   				$('#fieldModalLabel_tab1').prepend($(response.message));
   					   				
   			
   			} else if(response.response_code == 1) {
   			
   				//update table cell
   				
   				_theDIV.text(_fieldValue);
   				   			
   				//show message
   				$('#fieldModal .tab-pane:first').prepend($(response.success_message));
   			
   				//auto destruct the success message
   				window.setTimeout(function() { $("#fieldModalLabel_tab1 > .alert").fadeOut(1000, function(){$(this).remove()}); }, 3000);
   				
   				window.location.hash = '#fieldModalLabel_tab1';
   			
   			}
   		
   		})
   	
   	});
      	   	   	   	   	   	   	
   	//field modal event
   	fieldModal.on('show.bs.modal', function (e) {
   		
   		//show first tab when modal opens
   		$(this).find('.nav-tabs a:first').tab('show');
   		
   		$('#fieldModal .modal-footer > *:not(#fieldModal_close)').hide();
   		
   		//first tab's open, show the correct button
   		$('#fieldModal .modal-footer > label, #fieldModal .modal-footer #fieldModal_save').show();
   		
   	})
   	
   	//field modal tab events
   	$('#fieldModal .nav-tabs a').on('show.bs.tab', function (e) {
   	
   		//default hide all except close button
   		$('#fieldModal .modal-footer > *:not(#fieldModal_close)').hide();
   	
   		if($(e.target).parent().index() == 0) {
   		
   			$('#fieldModal .modal-footer > label, #fieldModal .modal-footer #fieldModal_save').show();
   		
   		}
   		
   	});
   	
   	
   	
   	
 }(window.jQuery, window, document));
 // The global jQuery object is passed as a parameter