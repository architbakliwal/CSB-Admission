function handleColumnResponse(str) {

	response = jQuery.parseJSON(str);
	
	//re-enable button
	$('#columnModal_savecolumn').removeClass('disabled').text("Update column");
	
	if(response.response_code == 2) {
			   				
		$('#editColumnModal .modal-body > .alert').each(function(){ $(this).remove() })
			
		$('#editColumnModal .modal-body').prepend($(response.message));
					
		return false;
		
	} 
	
	//all good :)
		
	//update the view
		
	$('#editColumnModal .modal-body').prepend($(response.message));
		
	window.setTimeout(function() { $("#editColumnModal .modal-body .alert-success").fadeOut(1000, function(){$(this).remove()}); }, 3000);
		
		
	$('#columnEditWrapper > *').each(function(){ $(this).remove() })
		
	$('#columnEditWrapper').append($(response.column)).find(':checkbox').checkbox();
	$('#columnEditWrapper').find("select.default").selectpicker({style: 'btn-default'});
	
	$('#theColumnName').text(response.columnName);
	
	
	
	//column table
	
	theContainer = $('#columnTable').parent();
	
	$('#columnTable').remove();
	
	$(response.columns).insertAfter(theContainer.find('.alert:first')).find(":checkbox").checkbox();
				
	//ajaxify new form
	$('#columnEditForm').ajaxForm(function(responseText) {
	
		handleColumnResponse(responseText)
		
	});

}


// IIFE - Immediately Invoked Function Expression
(function($, window, document) {

	// The $ is now locally scoped 

   	// Listen for the jQuery ready event on the document
   	$(function() {

   		// The DOM is ready!

   	});
   	
   	
   	columnTableList = $('table#columnTable');
   	
   	columnTableList.on('click', '.fieldNameLabel', function(){
   	
   		if($(this).find('input').is(':checked')) {
   		        		    
   			$.ajax({
   				type: "GET",
   				cache: false,
   			  	url: _BASE_URL+"/db/removeField",
   			  	data: { field: $(this).find('input:checkbox').val(), _token: _TOKEN}
   			})
   			
   		} else {
   		
   			$.ajax({
   				type: "GET",
   				cache: false,
   				dataType: 'json',
   			  	url: _BASE_URL+"/db/addField",
   			  	data: { field: $(this).find('input:checkbox').val(), _token: _TOKEN}
   			}).done(function(response){
   			
   				
   			
   			})
   		
   		}
   	
   	})
   	
   	
   	//select / deselect all
   	$('#fieldNameAllLabel').click(function(){
   	    	
   		if($(this).find('input').is(':checked')) {
   		    		
   			$.ajax({
   				type: "GET",
   				cache: false,
   			  	url: _BASE_URL+"/db/removeField",
   			  	data: { field: _theTable+".all", _token: _TOKEN}
   			})
   			
   		} else {
   			
   			$.ajax({
   				type: "GET",
   				cache: false,
   			  	url: _BASE_URL+"/db/addField",
   			  	data: { field: _theTable+".all", _token: _TOKEN}
   			})
   		
   		}
   	
   	})
   	
   	
   	
   	
   	
   	//load the edit column modal
   	$('#tab2').on("click", ".editColumn", function(){
   	
   		theID = $(this).attr('id');
   		
   		temp = theID.split("#");
   		
   		_columnToEdit = temp[1];
   		
   		//clear old view
   		$('#columnEditWrapper > *').each(function(){ $(this).remove(); });
   		$('#columnRestrictionsWrapper > *').each(function(){ $(this).remove(); });
   		
   		//clear out old error and success alerts
   		$('#editColumnModal .alert-error, #editColumnModal .alert-success').each(function(){ $(this).remove() })
   		
   		$.ajax({
   			type: "GET",
   			dataType: "json",
   		  	url: _BASE_URL+"/columns/getDetails/"+_theTable+"/"+_columnToEdit,
   		}).done(function(response){
   			
   			if(response.response_code == 2) {
   				
   				$('#column__tab1 > .alert-error').each(function(){ $(this).remove() })
   					
   				$('#column__tab1').prepend($(response.message));
   					
   				return false;
   				
   			}
   		
   			//update the view
   			   			
   			$('#columnEditWrapper').append($(response.column)).find(':checkbox').checkbox();
   			
   			$('#columnEditWrapper').find("select.default").selectpicker({style: 'btn-default'});
   			
   			$('#columnRestrictionsWrapper').append($(response.columnRestrictions));
   			
   			$('#columnRestrictionsWrapper').find("select.default").selectpicker({style: 'btn-default'});
   			
   			$('#theColumnName').text(response.columnName)
   				
   			//flat ui dropdowns
   			
   			   			
   			//update the table
   			
   			
   			$('#columnEditForm').ajaxForm(function(responseText) {
   			
   				handleColumnResponse(responseText);
   				
   			});
   			
   		});
   		
   	});
   	
   	
   	$('#editColumnModal').on("click", "#columnModal_savecolumn", function(){
   	
   		$(this).addClass('disabled').text("Updating column ...");
   	
   		$('form#columnEditForm').submit();
   	
   	})
   	
   	
   	//field modal event
   	$('#editColumnModal').on('show.bs.modal', function (e) {
   		
   		//show first tab when modal opens
   		$(this).find('.nav-tabs a:first').tab('show');
   		
   		$('#editColumnModal .modal-footer > *:not(#columnModal_close)').hide();
   		
   		//first tab's open, show the correct button
   		$('#editColumnModal .modal-footer > label, #editColumnModal .modal-footer #columnModal_savecolumn').show();
   		
   	})
   	
   	
   	//field modal tab events
   	$('#editColumnModal .nav-tabs a').on('show.bs.tab', function (e) {
   	
   		//default hide all except close button
   		$('#editColumnModal .modal-footer > *:not(#columnModal_close)').hide();
   	
   		if($(e.target).parent().index() == 0 || $(e.target).parent().index() == 1) {
   		
   			$('#editColumnModal .modal-footer > label, #editColumnModal .modal-footer #columnModal_savecolumn').show();
   		
   		}
   		
   	});   	
   	   	
   	
   	//delete a column
   	$('#tab2').on("click", ".deleteCloumn", function(){
   	
   		if( !confirm("Are you 100% sure about this?") ) {
   		
   			return false;
   		
   		}
   	
   	});
   	
   	
   	$('#newColumnModal_addcolumn').on("click", function(){
   	
   		$('#newColumnForm').submit();
   		
   		//disable button
   		$(this).addClass('disabled').text('Adding column ...');
   	
   	})
   	
   	
   	//create new column, ajaxify form
   	$('#newColumnForm').ajaxForm(function(responseText) {
   	
   		//re-enable button
   		$('#newColumnModal_addcolumn').removeClass('disabled').text('Add column');
   	
   		response = jQuery.parseJSON(responseText);
   		
   		if(response.response_code == 2) {
   		
   			$('#newColumnModal .modal-body > .alert-error').each(function(){ $(this).remove() })
   				
   			$('#newColumnModal .modal-body').prepend($(response.message));
   				
   			return false;
   		
   		}
   		
   		
   		$('#newColumnModal .modal-body > .alert').each(function(){ $(this).remove() })
   			
   		$('#newColumnModal .modal-body').prepend($(response.message));
   	
   	})
   	
   	
   	//column restrictions
	$('body').on("change", "select.restriction", function(){
	
		if( $(this).find(":selected").hasClass('value') ) {
		
			$(this).closest('.panel-body').find('input.value').attr('disabled', false)
		
		} else {
		
			$(this).closest('.panel-body').find('input.value').attr('disabled', true).val('');
		
		}
	
	});
	
	
	//add new restriction
	
	$('body').on("click", ".addRestrictionLink", function(){
	
		newRestriction = $(this).prev().find('.panel.template').clone();
						
		newRestriction.find('.panel-title a > b').text( $(this).prev().find('.panel').size() );
		
		
		newRestriction.find('.btn-group.select').each(function(){ $(this).remove(); });
		newRestriction.find('select.default').selectpicker({style: 'btn-default'});
		
		//setup form names
		newRestriction.find('.restriction').attr('name', "restrictions["+$(this).prev().find('.panel').size()+"][restriction]");
		newRestriction.find('.value').attr('name', "restrictions["+$(this).prev().find('.panel').size()+"][value]");
		
		$(this).prev().append(newRestriction.css('display', 'block').removeClass('template'));
		
		return false;
	
	})
	
	
	//remove restriction panel
	
	$('body').on("click", ".delRestriction", function(){
	
		columnRestrictions = $(this).closest('.columnRestrictions');
	
		$(this).closest('.panel').remove();
		
		//redo numbering
		columnRestrictions.find('.panel:not(.template)').each(function(index){
		
			$(this).find('.panel-title a > b').text( index+1 );
			
			$(this).find('.restriction').attr('name', "restrictions["+(index+1)+"][restriction]");
			$(this).find('.value').attr('name', "restrictions["+(index+1)+"][value]");
		
		})
	
	})
	
	
	//show/hide options section
	
	$('#newColumnModal_tab1, #column__tab1').on("change", 'select[name="columnType"]', function(){
	
		if( $(this).val() == "select" ) {
		
			$(this).closest('.form-group').next().fadeIn();
		
		} else {
		
			$(this).closest('.form-group').next().fadeOut();
		
		}
	
	})
   	
   	
 }(window.jQuery, window, document));
 // The global jQuery object is passed as a parameter