	
	<div class="form">
		<div class="header inner_header">
			<div class="grid-container">
				<div class="column-twelve">
					<h4 style="margin-bottom:15px;"><?php echo $lang['section_reference'];?></h4>
				</div>							
			</div>
		</div>
		<div class="section inner_section">
			<form method="post" action="<?php echo $baseurl;?>php/processor-reference.php?lang=<?php echo $_GET['lang'];?>" id="section_reference">
				<fieldset>
					<div class="grid-container">
						<div class="column-twelve">
							<div class="input-group">
								<?php echo CSRF::make('section_reference-form')->protect();?>                                      
							</div>
						</div>
						<div class="column-four">
							<div class="select-group irequire">
								<label for="refreetitle" class="group custom-select">
									<select id="refreetitle" name="refreetitle" class="select">
									    <option value="">Select title of the referee</option>
										<option value="Mr">Mr.</option>
										<option value="Ms">Ms.</option>
										<option value="Mrs">Mrs.</option>
										<option value="Dr">Dr.</option>
										<option value="Prof">Prof.</option>
									</select>
								</label>
					        </div>
						</div>
						<div class="column-four">
							<div class="input-group-right irequire">
								<label for="refreename" class="group label-input">
	                                <input type="text" id="refreename" name="refreename" class="input-right" placeholder="Name of the referee">
								</label>
						    </div>
						</div>
						<div class="column-four">
							<div class="input-group-right irequire">
								<label for="refreeorganization" class="group label-input">
	                                <input type="text" id="refreeorganization" name="refreeorganization" class="input-right" placeholder="Organisation">
								</label>
						    </div>
						</div>
						<div class="column-four">
							<div class="input-group-right irequire">
								<label for="refreedesignation" class="group label-input">
	                                <input type="text" id="refreedesignation" name="refreedesignation" class="input-right" placeholder="Designation">
								</label>
						    </div>
						</div>
						<div class="column-four">
							<div class="input-group-right irequire">
								<label for="refreecontact" class="group label-input">
	                                <input type="text" id="refreecontact" name="refreecontact" class="input-right" placeholder="Contact number">
								</label>
						    </div>
						</div>
						<div class="column-four">
							<div class="input-group-right irequire">
								<label for="refreeemail" class="group label-input">
	                                <input type="text" id="refreeemail" name="refreeemail" class="input-right" placeholder="Email address">
								</label>
						    </div>
						</div>
						<div class="column-eight">
							<div class="textarea-group irequire">
							    <label for="refreeknowing" class="group label-textarea">
							    	<h4 style="text-align: left; margin: 20px 0px;">In what capacity does he/she know you?</h4>
	                                <textarea rows="5" id="refreeknowing" name="refreeknowing" class="textarea no-resisable" placeholder="Please state your relation with the referee (Max 200 words)"></textarea>
								</label>
						    </div>
						</div>
						<div class="column-four hiddencontainer">
							<div class="input-group-right">
								<label for="hiddencontainer" class="group label-textarea">
									<h4 style="text-align: left; margin: 20px 0px;">Hidden label</h4>
									<textarea rows="5" id="hiddencontainer" name="hiddencontainer" class="textarea no-resisable" placeholder=""></textarea>
								</label>
						    </div>
						</div>
						
						<div class="column-two">
							<button type="button" id="back-button-refree" class="button button-large button-blue">Back</button>
						</div>
						<div class="column-two">
							<button type="button" id="save-button-refree" class="button button-large button-blue">Save</button>
						</div>
						<div class="column-two">
							<button type="button" id="continue-button-refree" class="button button-large button-green">Save and Continue</button>
						</div>
					</div>
				</fieldset>
			</form>
		</div>	
	</div>
