	

	<div class="form">
		<div class="header inner_header">
			<div class="grid-container">
				<div class="column-twelve">
					<h4 style="margin-bottom:15px;"><?php echo $lang['section_academic'];?></h4>
				</div>							
			</div>
		</div>
		<div class="section inner_section" id="academic-clone">
			<form method="post" action="<?php echo $baseurl;?>php/processor-academic.php?lang=<?php echo $_GET['lang'];?>" id="section_academic">
				<fieldset>
					<div class="grid-container">
						<div class="column-twelve">
							<div class="input-group">
								<?php echo CSRF::make('section_academic-form')->protect();?>                                      
							</div>
						</div>
						<div class="column-twelve">
						    <div class="box">
							    <div class="box-header" style="text-align:left">
								    <h3>Add all qualifications from 10th onwards</h3>
								</div>
								<div class="box-section center toclone">
									<div class="column-six">
										<div class="input-group-right irequire">
											<label for="qualification" class="group label-input">
				                                <input type="text" id="qualification" name="qualification" class="input-right" placeholder="Qualification">
											</label>
									    </div>
									</div>
									<div class="column-six">
										<div class="input-group-right irequire">
											<label for="institute" class="group label-input">
				                                <input type="text" id="institute" name="institute" class="input-right" placeholder="Institute">
											</label>
									    </div>
									</div>
									<div class="column-four">
										<div class="input-group-right irequire">
											<label for="board" class="group label-input">
				                                <input type="text" id="board" name="board" class="input-right" placeholder="Board">
											</label>
									    </div>
									</div>
									<div class="column-four">
										<div class="select-group irequire">
											<label for="yearofpassing" class="group custom-select">
												<?php
													$current_year = date("Y");
													$range = range(1950, $current_year+1);
													echo '<select id="yearofpassing" name="yearofpassing" class="select">';
													echo '<option value="">Year of passing</option>';
													 
													foreach($range as $r)
													{
													echo '<option value="'.$r.'">'.$r.'</option>';
													}
													 
													echo '</select>';
												?>
											</label>
								        </div>
									</div>
									<div class="column-four">
										<div class="input-group-right irequire">
										    <label for="aggregate" class="group label-input">
				                                <input type="text" id="aggregate" name="aggregate" class="input-right" placeholder="Aggregate Marks (% or GPA)">
											</label>
									    </div>
									</div>
									<div class="column-eight">
										<div class="textarea-group">
										    <label for="academicachivements" class="group label-textarea">
				                                <textarea rows="5" id="academicachivements" name="academicachivements" class="textarea no-resisable" placeholder="Please enter you academic awards, extra-curricular achievements and positions of responsibility held, if any. (Max 200 words)"></textarea>
											</label>
									    </div>
									</div>
									<div class="column-four hiddencontainer">
										<div class="input-group-right">
											<label for="hiddencontainer" class="group label-textarea">
												<textarea rows="5" id="hiddencontainer" name="hiddencontainer" class="textarea resisable" placeholder=""></textarea>
											</label>
									    </div>
									</div>
									<div class="column-four">
										<button type="button" id="add-extra-academicextra" class="button button-large button-orange clone">Add another academic qualification</button>
									</div>
									<div class="column-four">
										<button type="button" id="add-extra-academicextra-delete" class="button button-large button-red delete">Remove</button>
									</div>
									<div class="column-twelve hiddencontainer">
										<div class="input-group-right">
											<label for="extraacademiccount" class="group label-input">
				                                <input type="hidden" id="extraacademiccount" name="extraacademiccount" class="input-right" placeholder="" title="">
											</label>
									    </div>
									</div>
								</div>
							</div>
						</div>
						</br></br>
						<div class="column-two">
							<button type="button" id="back-button-academic" class="button button-large button-blue">Back</button>
						</div>
						<div class="column-two">
							<button type="button" id="save-button-academic" class="button button-large button-blue">Save</button>
						</div>
						<div class="column-two">
							<button type="button" id="continue-button-academic" class="button button-large button-green">Save and Continue</button>
						</div>
					</div>
				</fieldset>
			</form>
		</div>	
	</div>