	

	<div class="form">
		<div class="header inner_header">
			<div class="grid-container">
				<div class="column-twelve">
					<h4 style="margin-bottom:15px;"><?php echo $lang['section_additional_info'];?></h4>
				</div>							
			</div>
		</div>
		<div class="section inner_section">
			<form method="post" action="<?php echo $baseurl;?>php/processor-additional_info.php?lang=<?php echo $_GET['lang'];?>" id="section_additional_info">
				<fieldset>
					<div class="grid-container">
						<div class="column-twelve">
							<div class="input-group">
								<?php echo CSRF::make('section_additional_info-form')->protect();?>                                      
							</div>
						</div>
						<div class="column-twelve">
						    <div class="box">
							    <div class="box-header" style="text-align:left">
								    <h3>Additional Information</h3>
								</div>
								<div class="box-section center">
								    <div class="column-twelve">
										<div class="textarea-group irequire">
										    <label for="aftermbaplan" class="group label-textarea">
				                                <textarea rows="5" id="aftermbaplan" name="aftermbaplan" class="textarea resisable" placeholder="What do you plan to do after your MBA. (Max 200 words)"></textarea>
											</label>
									    </div>
									</div>
								</div>
							</div>
						</div>
						<div class="column-two">
							<button type="button" id="back-button-additional" class="button button-large button-blue">Back</button>
						</div>
						<div class="column-two">
							<button type="button" id="save-button-additional" class="button button-large button-blue">Save</button>
						</div>
						<div class="column-two">
							<button type="button" id="continue-button-additional" class="button button-large button-green">Save and Continue</button>
						</div>						
					</div>
				</fieldset>
			</form>
		</div>	
	</div>