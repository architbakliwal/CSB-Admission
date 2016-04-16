	

	<div class="form">
		<div class="header inner_header">
			<div class="grid-container">
				<div class="column-twelve">
					<h4 style="margin-bottom:15px;"><?php echo $lang['section_workex'];?></h4>
				</div>							
			</div>
		</div>
		<div class="section inner_section" id="workex-clone">
			<form method="post" action="<?php echo $baseurl;?>php/processor-workex.php?lang=<?php echo $_GET['lang'];?>" id="section_workex">
				<fieldset>
					<div class="grid-container">
						<div class="column-twelve">
							<div class="input-group">
								<?php echo CSRF::make('section_workex-form')->protect();?>                                      
							</div>
						</div>
						<div class="column-twelve">
						    <div class="box">
								<div class="box-header" style="text-align:left; border-bottom:0; background-color: white; margin-bottom: 25px;">
								    <div class="column-four">
										<h3 style="color:#777;">Do you have any work-experience?</h3>
									</div>
									<div class="column-four">
										<div class="input-group-right irequire">
											<div class="radio-group" style="margin-left: 20px;">
												<label for="workexyes-radio" class="group space-right">
													<input type="radio" name="isworkex" class="radio" value="Yes" id="workexyes-radio">
													<span class="label space-right">Yes</span>
												</label>
												<label for="workexno-radio" class="group space-right">
													<input type="radio" name="isworkex" class="radio" value="No" id="workexno-radio">
													<span class="label space-right">No</span>
												</label>
											</div>
									    </div>
									</div>
								</div>
								<div id="workex-super-div" style="display:none;">
									<div class="box-header" style="text-align:left">
									    <h3>Work Experience</h3>
									</div>
									<div class="box-section center toclone">
										<div class="column-four">
											<div class="select-group irequire">
												<label for="employementtype" class="group custom-select">
													<select id="employementtype" name="employementtype" class="select">
													    <option value="">Employement Type</option>
														<option value="Full Time">Full Time</option>
														<option value="Part Time">Part Time</option>
														<option value="Internship">Internship</option>
													</select>
												</label>
									        </div>
										</div>
										<div class="column-four">
											<div class="input-group-right irequire">
											    <label for="organizationname" class="group label-input">
					                                <input type="text" id="organizationname" name="organizationname" class="input-right" placeholder="Name of the organisation">
												</label>
										    </div>
										</div>
										<div class="column-four">
											<div class="select-group irequire">
												<label for="organizationtype" class="group custom-select">
													<select id="organizationtype" name="organizationtype" class="select">
													    <option value="">Select Organisation Type</option>
														<option value="06">Autonomous</option>
														<option value="01">Government (Central / State / Local bodies)</option>
														<option value="05">NGO</option>
														<option value="03">Private Sector</option>
														<option value="02">Public Sector</option>
														<option value="04">Self Employed</option>
														<option value="07">Any Other</option>
													</select>
												</label>
									        </div>
										</div>
										<div class="column-four">
											<div class="input-group-right" id="organizationtypeother-div">
												<label for="organizationtypeother" class="group label-input">
					                                <input type="text" id="organizationtypeother" name="organizationtypeother" class="input-right" placeholder="If other, please specify">
												</label>
										    </div>
										</div>
										<div class="column-four">
											<div class="input-group-right irequire">
											    <label for="workstarted" class="group label-input">
				                                    <input type="text" id="workstarted" name="workstarted" class="input-right workstarted" placeholder="Started work in (YYYY-MM-DD">
				                                </label>
										    </div>
										</div>
										<div class="column-four">
											<div class="input-group-right irequire">
											    <label for="workcompleted" class="group label-input">
				                                    <input type="text" id="workcompleted" name="workcompleted" class="input-right workcompleted" placeholder="Completed work in (YYYY-MM-DD)">
												</label>
										    </div>
										</div>
										<div class="column-four">
											<div class="input-group-right irequire">
											    <label for="comapnyjoinedas" class="group label-input">
					                                <input type="text" id="comapnyjoinedas" name="comapnyjoinedas" class="input-right" placeholder="Joined as">
												</label>
										    </div>
										</div>
										<div class="column-four">
											<div class="input-group-right irequire">
											    <label for="currentdesignation" class="group label-input">
					                                <input type="text" id="currentdesignation" name="currentdesignation" class="input-right" placeholder="Current designation">
												</label>
										    </div>
										</div>
										<div class="column-four">
											<div class="input-group-right">
											    <label for="annualrenumeration" class="group label-input">
					                                <input type="text" id="annualrenumeration" name="annualrenumeration" class="input-right" placeholder="Annual Remuneration in INR (Numeric)">
												</label>
										    </div>
										</div>
										<div class="column-eight">
											<div class="textarea-group irequire">
											    <label for="rolesandresponsibility" class="group label-textarea">
					                                <textarea rows="5" id="rolesandresponsibility" name="rolesandresponsibility" class="textarea no-resisable" placeholder="Please give a brief description of your role and responsibilities in the organisation (Max 200 words)"></textarea>
												</label>
										    </div>
										</div>
										<div class="column-four hiddencontainer">
											<div class="input-group-right">
												<label for="hiddencontainer" class="group label-textarea">
													<textarea rows="5" id="hiddencontainer" name="hiddencontainer" class="textarea no-resisable" placeholder=""></textarea>
												</label>
										    </div>
										</div>
										<div class="column-four">
											<button type="button" id="add-extra-workex" class="button button-large button-orange clone">Add another work experience</button>
										</div>
										<div class="column-four">
	                                        <button type="button" id="add-extra-workex-delete" class="button button-large button-red delete">Remove</button>
	                                    </div>
										<div class="column-four hiddencontainer">
											<div class="input-group-right">
												<label for="hiddencontainer" class="group label-input">
					                                <input type="hidden" id="extraworkexcount" name="extraworkexcount" class="input-right" placeholder="" title="">
												</label>
										    </div>
										</div>
									</div>
									<div class="column-twelve" style="margin:20px 0px;">
										<div class="column-four" style="padding-top: 10px;">
											<h3>Total work experience</h3>
										</div>
										<div class="column-four">
											<div class="input-group-right irequire">
												<label for="totalworkex" class="group label-input">
					                                <input type="text" id="totalworkex" name="totalworkex" class="input-right" placeholder="Total work experience in months">
												</label>
											</div>
										</div>
										<div class="column-four">
											<div class="input-group-right">
												<p>If currently working, please calculate as of today.</p>
										    </div>
										</div>
									</div>
								</div>
							</div>
						</div>
						
						<div class="column-two">
							<button type="button" id="back-button-workex" class="button button-large button-blue">Back</button>
						</div>
						<div class="column-two">
							<button type="button" id="save-button-workex" class="button button-large button-blue">Save</button>
						</div>
						<div class="column-two">
							<button type="button" id="continue-button-workex" class="button button-large button-green">Save and Continue</button>
						</div>
					</div>
				</fieldset>
			</form>
		</div>	
	</div>