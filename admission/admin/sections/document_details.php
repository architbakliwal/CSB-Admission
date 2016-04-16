	

	<div class="form">
		<div class="header inner_header">
			<div class="grid-container">
				<div class="column-twelve">
					<h4 style="margin-bottom:15px;"><?php echo $lang['section_docs'];?></h4>
				</div>							
			</div>
		</div>
		<div class="section inner_section">
			<form method="post" action="<?php echo $baseurl;?>php/processor-docs.php?lang=<?php echo $_GET['lang'];?>" id="section_docs">
				<fieldset>
					<div class="grid-container">
						<div class="column-twelve">
							<div class="input-group">
								<?php echo CSRF::make('section_docs-form')->protect();?>                                      
							</div>
						</div>
						<div class="column-twelve">
						    <div class="box">
							    <div class="box-header" style="text-align:left">
								    <h3>Document Uploads</h3>
								</div>
								<div class="box-section center">
									<div class="column-twelve" style="text-align: left; margin-bottom: 30px;">
										<h3 style="margin-bottom: 10px;">Instruction for uploads</h3>
										<ul>
											<li style="margin-bottom: 10px;"><b>Photo</b> Digital or scanned passport size photograph. Dimension: 2 by 2 inches. Resolution: Min 600 x 600 pixels, Max 1200 x 1200 pixels. File Formats Supported: GIF, JPEG, JPG & PNG. Maximum file size : 400 Kb</li>
											<li style="margin-bottom: 10px;"><b>Resume/CV</b> File Formats Supported: DOC, DOCX & PDF. Maximum file size : 400 Kb</li>
										</ul>
									</div>
									<div class="column-two">
										<p><b>Photo</b></p>
									</div>
									<div class="column-ten">
										<?php if($upload == true){ ?>
										<div class="file-group irequire">
											<label for="passportphoto" class="group label-file">
												<span class="button-upload blue">Choose</span>								
												<input type="file" id="passportphoto" name="passportphoto" class="file" onchange="document.getElementById('passportphotofake1').value = this.value.replace(/C:\\fakepath\\/i, '');"/>
												<input type="text" id="passportphotofake1" name="passportphotofake1" class="input" placeholder="No file selected"/>
											</label>
										</div>
										<?php } ?>
									</div>
									<!-- <div class="column-two">
										<p title="Digital xels. File Formats Supported: GIF, JPEG, JPG & PNG<br>Maximum file size : 400 Kb" id="tooltip-help"><b>Academic Transcripts</b></p>
									</div>
									<div class="column-ten">
										<?php if($upload == true){ ?>
										<div class="file-group irequire">
											<label for="transcripts" class="group label-file">
												<span class="button-upload blue">Choose</span>								
												<input type="file" id="transcripts" name="transcripts[]" class="file" onchange="document.getElementById('transcriptsfake1').value = this.value.replace(/C:\\fakepath\\/i, '');" title="D file size : 400 Kb" multiple=""/>
												<input type="text" id="transcriptsfake1" name="transcriptsfake1" class="input" placeholder="No file selected"/>
											</label>
										</div>
										<?php } ?>
									</div> -->
									<div class="column-two">
										<p><b>Resume/CV</b></p>
									</div>
									<div class="column-ten">
										<?php if($upload == true){ ?>
										<div class="file-group irequire">
											<label for="resume" class="group label-file">
												<span class="button-upload blue">Choose</span>								
												<input type="file" id="resume" name="resume" class="file" onchange="document.getElementById('resumefake1').value = this.value.replace(/C:\\fakepath\\/i, '');"/>
												<input type="text" id="resumefake1" name="resumefake1" class="input" placeholder="No file selected"/>
											</label>
										</div>
										<?php } ?>
									</div>
									<!-- <div class="column-two">
										<p title="Digital or scanned pls. File Formats Supported: GIF, JPEG, JPG & PNG<br>Maximum file size : 400 Kb" id="tooltip-help"><b>Additional Certificates</b></p>
									</div>
									<div class="column-ten">
										<?php if($upload == true){ ?>
										<div class="file-group irequire">
											<label for="certificates" class="group label-file">
												<span class="button-upload blue">Choose</span>
												<input type="file" id="certificates" name="certificates[]" class="file" onchange="document.getElementById('certificatesfake1').value = this.value.replace(/C:\\fakepath\\/i, '');" title="400 Kb" />
												<input type="text" id="certificatesfake1" name="certificatesfake1" class="input" placeholder="No file selected"/>
											</label>
										</div>
										<?php } ?>
									</div> -->
								</div>
							</div>
						</div>
						<div class="column-two">
							<button type="button" id="back-button-doc" class="button button-large button-blue">Back</button>
						</div>
						<div class="column-two">
							<button type="button" id="save-button-doc" class="button button-large button-green">Upload & Save</button>
						</div>
						<div class="column-two">
							<button type="button" id="continue-button-doc" class="button button-large button-orange">Submit</button>
						</div>						
					</div>
				</fieldset>
			</form>
		</div>	
	</div>