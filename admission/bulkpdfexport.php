<?php
    
	include dirname(__FILE__).'/php/csrf_protection/csrf-token.php';
	include dirname(__FILE__).'/php/csrf_protection/csrf-class.php';
    
	include dirname(__FILE__).'/php/config/config.php';
	include dirname(__FILE__).'/php/config/functions.php';
	
	$language = array('en' => 'en','pt' => 'pt');

	if (isset($_GET['lang']) AND array_key_exists($_GET['lang'], $language)){
		include dirname(__FILE__).'/php/language/'.$language[$_GET['lang']].'.php';
	} else {
		include dirname(__FILE__).'/php/language/en.php';
	}

?>
<!doctype html>
<html>
    <head>

        <?php include dirname(__FILE__).'/header.php'; ?>
        <script>
        jQuery.noConflict()(function($){
			$(document).ready(function(){
	        	$("#submit-button-pdf").click(function(){
			    	jQuery('#bulkpdfexport').ajaxSubmit({
		                beforeSubmit:function(){ 
							$.blockUI();
						},
						success:function(responseText, statusText, xhr, $form){
							$.unblockUI();
							if($( "#bulkpdfexport" ).valid()) {
								$('#bulk-message').html(responseText);
								alert(responseText);
							} else {
								alert("Please choose a file")
							}
							$('#bulkpdfexport').each(function(){
		                        this.reset();
		                    });				
						},
						error:function() {
							$('#bulkpdfexport').each(function(){
		                        this.reset();
		                    });
							$.unblockUI();
						}
					});
			    });
			});
		});
        </script>

    </head>
	
    <body>

		<div class="wrapper"> 
		    <div class="form-bar">
				<div class="top-bar bar-orange"></div>
			</div>
	        <div class="header dashboard_header">
			    <div class="grid-container">
			    	<div class="column-twelve">
						<img src="images/logo.JPG"/>
					</div>
			    	<div class="column-twelve">
						<h4><?php echo $lang['dashboard_title'];?></h4>
					</div>
				</div>
			</div>
			<div class="section">
				<div class="grid-container">
					<div class="form">
						<div class="section inner_section">
							<form method="post" id="bulkpdfexport" action="<?php echo $baseurl;?>php/processor-pdf.php?lang=<?php echo $_GET['lang'];?>">
								<fieldset>
									<div class="grid-container">
										<div class="column-twelve">
										    <div class="box">
											    <div class="box-header" style="text-align: left;">
												    <h3 id='bulk-message'>Bulk PDF Export</h3>
												</div>
												<div class="box-section center" style="text-align: left;">
													<div class="column-twelve" style="margin: 10px 0px;">
														<div class="file-group irequire">
															<label for="pdfsheet" class="group label-file">
																<span class="button-upload blue">Choose</span>
																<input type="file" id="pdfsheet" name="pdfsheet" class="file" onchange="document.getElementById('ddsheet1').value = this.value;" accept="application/vnd.ms-excel" required>
																<input type="text" id="ddsheet1" class="input" placeholder="No file selected">
															</label>
														</div>														
													</div>
													<div class="column-two">
														<button type="button" id="submit-button-pdf" class="button button-large button-green">Submit</button>
													</div>
												</div>
											</div>
										</div>
									</div>
								</fieldset>
							</form>
						</div>
					</div>
				</div>
			</div>
			<div class="copyright">
				<div class="grid-container">
					<div class="column-twelve">
						<p><?php echo $lang['dashboard_copyright_info'];?></p>
					</div>
				</div>
            </div>
		</div>

    </body>
</html>