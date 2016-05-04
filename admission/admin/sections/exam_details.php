	

	<div class="form">
		<div class="header inner_header">
			<div class="grid-container">
				<div class="column-twelve">
					<h4 style="margin-bottom:15px;"><?php echo $lang['section_exam_score'];?></h4>
				</div>							
			</div>
		</div>
		<div class="section inner_section">
			<form method="post" action="<?php echo $baseurl;?>php/processor-exam_score.php?lang=<?php echo $_GET['lang'];?>" id="section_exam_score">
				<fieldset>
					<div class="grid-container">
						<div class="column-twelve">
							<div class="input-group">
								<?php echo CSRF::make('section_exam_score-form')->protect();?>                                      
							</div>
						</div>
						<div class="column-twelve">
							<div class="textarea-group">
							    <label for="examscore" class="group label-textarea">
							    	<h4 style="text-align: left; margin: 20px 0px;">Enter on each line the entrance exam and its score.</h4>
	                                <textarea rows="5" id="examscore" name="examscore" class="textarea resisable" placeholder="e.g. CAT - 93 Percentile"></textarea>
								</label>
						    </div>
						</div>
						<div class="column-two">
							<button type="button" id="back-button-score" class="button button-large button-blue">Back</button>
						</div>
						<div class="column-two">
							<button type="button" id="save-button-score" class="button button-large button-blue">Save</button>
						</div>
						<div class="column-two">
							<button type="button" id="continue-button-score" class="button button-large button-green">Save and Continue</button>
						</div>						
					</div>
				</fieldset>
			</form>
		</div>	
	</div>