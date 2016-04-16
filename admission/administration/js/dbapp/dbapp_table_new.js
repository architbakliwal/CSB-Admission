//new table

//new table column name update
$('#newTableModal').on("keyup", "input.columName", function(){
		
	if($(this).val() != '') {	
		$(this).closest('.panel-collapse').prev().find('.panel-title a b').text($(this).val())
	} else {
		$(this).closest('.panel-collapse').prev().find('.panel-title a b').text("New Column")
	}
	
});


//show/hide options section

$('#newTableModal, #build').on("change", 'select.columnType', function(){

	if( $(this).val() == "select" ) {
	
		$(this).closest('.form-group').next().fadeIn();
	
	} else {
	
		$(this).closest('.form-group').next().fadeOut();
	
	}

})


//new table add column link/button
$('#addColumnLink').on("click", function(){

	newColumnSection = $('#newColumn_templ').clone();
	
	newColumnSection.find('.panel-title a > b').text("Column "+$('#columnAccordion .panel').size());
	
	newColumnSection.find('.panel-title a').attr('href', '#newCol_'+($(this).prev().find('.panel').size()+1) );
	
	newColumnSection.find('.panel-collapse').attr('id', 'newCol_'+($(this).prev().find('.panel').size()+1));
	
	
	//setup form names
	newColumnSection.find('.columName').attr('name', "columns["+$(this).prev().find('.panel').size()+"][columnName]");
	newColumnSection.find('.columnType').attr('name', "columns["+$(this).prev().find('.panel').size()+"][columnType]");
	newColumnSection.find('.columnSelect').attr('name', "columns["+$(this).prev().find('.panel').size()+"][columnSelect]");
	newColumnSection.find('.columnDefault').attr('name', "columns["+$(this).prev().find('.panel').size()+"][columnDefault]");
	newColumnSection.find('.columnIndex').attr('name', "columns["+$(this).prev().find('.panel').size()+"][columnIndex]");
	
	//dropdowns
	newColumnSection.find('.btn-group.select').each(function(){ $(this).remove(); });
	newColumnSection.find('select.default').selectpicker({style: 'btn-default'});
	
	$(this).prev().append(newColumnSection.css('display', 'block').attr('id', ''));
	
	newColumnSection.find('.panel-heading h4 > a').click();
	
	return false;

});


$('#newTableModal_addtable').on("click", function(){

	//disable button
	$(this).addClass("disabled").text('Adding table ...');
	
	//submit form
	$('form#newTableForm').submit();
})


$('form#newTableForm').ajaxForm(function(responseText){

	//re-enable button
	$('#newTableModal_addtable').removeClass('disabled').text('Add table');
	
	response = jQuery.parseJSON(responseText);
	
	if(response.response_code == 2) {
	
		$('#newTableForm > .alert').each(function(){ $(this).remove() })
			
		$('#newTableForm').prepend($(response.message));
			
		return false;
	
	}
	
	$('#newTableForm > .alert').each(function(){ $(this).remove() })
		
	$('#newTableForm').prepend($(response.message));

})

//modal submit/save buttons

$('#newTableModal').on('show.bs.modal', function (e) {

	$('#newTableModal #newTableModal_import').hide();

})

//field modal tab events
$('#newTableModal .nav-tabs a').on('show.bs.tab', function (e) {

	//default hide all except close button
	$('#newTableModal .modal-footer > *:not(#newTableModal_close)').hide();

	if($(e.target).parent().index() == 0) {
	
		$('#newTableModal .modal-footer #newTableModal_addtable').show();
	
	}
	
	if($(e.target).parent().index() == 1) {
	
		$('#newTableModal .modal-footer #newTableModal_import').show();
	
	}
	
});


//upload CSV files
$('#newTableModal').on("click", "#newTableModal_import", function(){

	$(this).text("Importing file and creating table...").addClass('disabled');

	$('#newTableModal form#uploadForm').submit();
		
})

$('#newTableModal').on("submit", "form#uploadForm", function(){
	
	var form = $(this);
	var formdata = false;
	
	if (window.FormData){
		formdata = new FormData(form[0]);
	}
	
	var formAction = form.attr('action');
	
	$.ajax({
		url         : formAction,
		data        : formdata ? formdata : form.serialize(),
		cache       : false,
		contentType : false,
		processData : false,
		dataType: "json",
		type        : 'POST'
		
	}).done(function(response){
	
		$("#newTableModal_import").text("Import file and create table").removeClass('disabled');
	
		if(response.response_code == 2) {
				
			$('#newTableModal #import > .alert').each(function(){ $(this).remove() })
				
			$('#newTableModal #import').prepend($(response.message));
			
			return false;
					
		}
	
		$('#newTableModal #import > .alert').each(function(){ $(this).remove() })
			
		$('#newTableModal #import').prepend($(response.message));
	
	})
	
	return false;

})


//data import

$('#importDataModal').on("click", "#importDataModal_import", function(){

	$(this).text('Importing data...').addClass('disabled');

	$('#importDataModal form#import_uploadForm').submit();
		
})

$('#importDataModal').on("submit", "form#import_uploadForm", function(){
	
	var form = $(this);
	var formdata = false;
	
	if (window.FormData){
		formdata = new FormData(form[0]);
	}
	
	var formAction = form.attr('action');
	
	$.ajax({
		url         : formAction,
		data        : formdata ? formdata : form.serialize(),
		cache       : false,
		contentType : false,
		processData : false,
		dataType: "json",
		type        : 'POST'
		
	}).done(function(response){
	
		$('#importDataModal_import').text('Import data').removeClass('disabled');
	
		if(response.response_code == 2) {
				
			$('#importDataModal .modal-body > .alert').each(function(){ $(this).remove() })
				
			$('#importDataModal .modal-body').prepend($(response.message));
			
			return false;
					
		}
	
		$('#importDataModal .modal-body > .alert').each(function(){ $(this).remove() })
			
		$('#importDataModal .modal-body').prepend($(response.message));
	
	})
	
	return false;

})