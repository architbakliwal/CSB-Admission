	

	<div class="form">
		<div class="header inner_header">
			<div class="grid-container">
				<div class="column-twelve">
					<h4 style="margin-bottom:15px;"><?php echo $lang['section_personal'];?></h4>
				</div>							
			</div>
		</div>
		<div class="section inner_section">
			<form method="post" action="<?php echo $baseurl;?>php/processor-personal.php?lang=<?php echo $_GET['lang'];?>" id="section_personal">
				<fieldset>
					<div class="grid-container">
						<div class="column-twelve">
							<div class="input-group">
								<?php echo CSRF::make('section_personal-form')->protect();?>                                      
							</div>
						</div>
						<div class="column-four">
							<div class="input-group-right irequire">
							    <label for="firstname" class="group label-input">
								    <i class="icon-user-3"></i>
	                                <input type="text" id="firstname" name="firstname" maxlength="30" class="input-right" placeholder="First Name">
								</label>
						    </div>
						</div>
						<div class="column-four">
							<div class="input-group-right">
								<label for="middlename" class="group label-input">
								    <i class="icon-user-3"></i>
	                                <input type="text" id="middlename" name="middlename" maxlength="30" class="input-right" placeholder="Middle Name">
								</label>
						    </div>
						</div>
						<div class="column-four">
							<div class="input-group-right irequire">
								<label for="lastname" class="group label-input">
								    <i class="icon-user-3"></i>
	                                <input type="text" id="lastname" name="lastname" maxlength="30" class="input-right" placeholder="Last Name">
								</label>
						    </div>
						</div>
						<div class="column-six">
							<div class="input-group-right irequire">
							    <label for="dob" class="group label-input">
								    <i class="icon-calendar"></i>
                                    <input type="text" id="dob" name="dob" class="input-right" placeholder="Date of Birth">
								</label>
						    </div>
						</div>
						<div class="column-six">
							<div class="select-group irequire">
								<label for="gender" class="group custom-select">
									<select id="gender" name="gender" class="select">
									    <option value="">Gender</option>
										<option value="M">Male</option>
										<option value="F">Female</option>
										<option value="O">Others</option>
									</select>
								</label>
					        </div>
						</div>
						<div class="column-six">
							<div class="select-group irequire">
								<label for="hearaboutcsb" class="group custom-select">
									<select id="hearaboutcsb" name="hearaboutcsb" class="select">
										<option value="">How did you hear of CSB?</option>
									    <option value="Email">Email</option>
									    <option value="Social media">Social media - Please specify the platform</option>
									    <option value="Newspaper">Newspaper - Please specify which newspaper</option>
									    <option value="Friend">Friend</option>
									    <option value="College Alumni Network">College Alumni Network</option>
									    <option value="Others">Other - Please specify</option>
									</select>
								</label>
					        </div>
					    </div>
					    <div class="column-six">
							<div class="input-group-right">
								<label for="hearaboutcsbother" class="group label-input">
	                                <input type="text" id="hearaboutcsbother" name="hearaboutcsbother" class="input-right" placeholder="Please Specify">
								</label>
						    </div>
						</div>
						<div class="column-two">
							<button type="button" id="save-button-personal" class="button button-large button-blue">Save</button>
						</div>
						<div class="column-two">
							<button type="button" id="continue-button-personal" class="button button-large button-green">Save and Continue</button>
						</div>
					</div>
				</fieldset>
			</form>
		</div>	
	</div>