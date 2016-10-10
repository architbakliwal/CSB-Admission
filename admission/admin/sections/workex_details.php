	

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
											<div class="input-group-right irequire">
											    <label for="organizationname" class="group label-input">
					                                <input type="text" id="organizationname" name="organizationname" class="input-right" placeholder="Name of the organisation">
												</label>
										    </div>
										</div>
										<div class="column-four">
											<div class="input-group-right irequire">
											    <label for="location" class="group label-input">
					                                <input type="text" id="location" name="location" class="input-right" placeholder="Location (city)">
												</label>
										    </div>
										</div>
										<div class="column-four">
											<div class="input-group-right irequire">
											    <label for="designation" class="group label-input">
					                                <input type="text" id="designation" name="designation" class="input-right" placeholder="Designation">
												</label>
										    </div>
										</div>
										<div class="column-four">
											<div class="input-group-right irequire">
											    <label for="workstarted" class="group label-input">
				                                    <input type="text" id="workstarted" name="workstarted" class="input-right workstarted" placeholder="Started work in (YYYY-MM-DD)">
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
											    <label for="ctc" class="group label-input">
					                                <input type="text" id="ctc" name="ctc" class="input-right" placeholder="Total CTC in INR (Numeric)">
												</label>
										    </div>
										</div>
										<div class="column-eight">
											<div class="textarea-group irequire">
											    <label for="rolesandresponsibility" class="group label-textarea">
					                                <textarea rows="5" id="rolesandresponsibility" name="rolesandresponsibility" class="textarea no-resisable" placeholder="Please give a brief description of your role and achievements in the organisation (Max 200 words)"></textarea>
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
									<div class="column-twelve" style="margin:20px 0px;">
										<div class="column-four" style="padding-top: 10px;">
											<h3>Current notice period</h3>
										</div>
										<div class="column-four">
											<div class="input-group-right irequire">
												<label for="noticeperiod" class="group label-input">
					                                <input type="text" id="noticeperiod" name="noticeperiod" class="input-right" placeholder="Current notice period in days">
												</label>
											</div>
										</div>
										<div class="column-four">
											<div class="input-group-right">
												<p>If currently not working, please enter 0.</p>
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