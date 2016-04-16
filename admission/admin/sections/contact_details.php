	

	<div class="form">
		<div class="header inner_header">
			<div class="grid-container">
				<div class="column-twelve">
					<h4 style="margin-bottom:15px;"><?php echo $lang['section_contact'];?></h4>
				</div>							
			</div>
		</div>
		<div class="section inner_section">
			<form method="post" action="<?php echo $baseurl;?>php/processor-contact.php?lang=<?php echo $_GET['lang'];?>" id="section_contact">
				<fieldset>
					<div class="grid-container">
						<div class="column-twelve">
							<div class="input-group">
								<?php echo CSRF::make('section_contact-form')->protect();?>                                      
							</div>
						</div>
						<div class="column-four">
							<div class="input-group-right irequire">
							    <label for="email" class="group label-input">
								    <i class="icon-envelop"></i>
	                                <input type="text" id="email" name="email" maxlength="30" class="input-right" placeholder="Email Address">
								</label>
						    </div>
						</div>
						<div class="column-four">
							<div class="input-group-right irequire">
								<label for="mobilenumber" class="group label-input">
								    <i class="icon-mobile-3"></i>
	                                <input type="text" id="mobilenumber" name="mobilenumber" class="input-right" placeholder="Mobile Number">
								</label>
						    </div>
						</div>
						<div class="column-four">
							<div class="input-group-right">
								<label for="phonenumber" class="group label-input">
								    <i class="icon-phone"></i>
	                                <input type="text" id="phonenumber" name="phonenumber" class="input-right" placeholder="Phone Number (Eg 912212345678)">
								</label>
						    </div>
						</div>
						<div class="column-twelve">
						    <div class="box">
							    <div class="box-header" style="text-align:left">
								    <h3>Current Address</h3>
								</div>
								<div class="box-section center">
									<div class="column-four">
										<div class="input-group-right irequire">
										    <label for="currentaddress1" class="group label-input">
				                                <input type="text" id="currentaddress1" name="currentaddress1" class="input-right" placeholder="Address line 1">
											</label>
									    </div>
									</div>
									<div class="column-four">
										<div class="input-group-right">
											<label for="currentaddress2" class="group label-input">
				                                <input type="text" id="currentaddress2" name="currentaddress2" class="input-right" placeholder="Address line 2">
											</label>
									    </div>
									</div>
									<div class="column-four">
										<div class="input-group-right">
											<label for="currentaddress3" class="group label-input">
				                                <input type="text" id="currentaddress3" name="currentaddress3" class="input-right" placeholder="Address line 3">
											</label>
									    </div>
									</div>
									<div class="column-four">
										<div class="input-group-right irequire">
										    <label for="currentcity" class="group label-input">
				                                <input type="text" id="currentcity" name="currentcity" class="input-right" placeholder="City">
											</label>
									    </div>
									</div>
									<div class="column-eight">
										<div class="select-group irequire">
											<label for="currentcountry" class="group custom-select">
				                                <select id="currentcountry" name="currentcountry" class="select">
													<option value="">Select Country</option>
													<option value="Afganistan">Afghanistan</option>
													<option value="Albania">Albania</option>
													<option value="Algeria">Algeria</option>
													<option value="American Samoa">American Samoa</option>
													<option value="Andorra">Andorra</option>
													<option value="Angola">Angola</option>
													<option value="Anguilla">Anguilla</option>
													<option value="Antigua &amp; Barbuda">Antigua &amp; Barbuda</option>
													<option value="Argentina">Argentina</option>
													<option value="Armenia">Armenia</option>
													<option value="Aruba">Aruba</option>
													<option value="Australia">Australia</option>
													<option value="Austria">Austria</option>
													<option value="Azerbaijan">Azerbaijan</option>
													<option value="Bahamas">Bahamas</option>
													<option value="Bahrain">Bahrain</option>
													<option value="Bangladesh">Bangladesh</option>
													<option value="Barbados">Barbados</option>
													<option value="Belarus">Belarus</option>
													<option value="Belgium">Belgium</option>
													<option value="Belize">Belize</option>
													<option value="Benin">Benin</option>
													<option value="Bermuda">Bermuda</option>
													<option value="Bhutan">Bhutan</option>
													<option value="Bolivia">Bolivia</option>
													<option value="Bonaire">Bonaire</option>
													<option value="Bosnia &amp; Herzegovina">Bosnia &amp; Herzegovina</option>
													<option value="Botswana">Botswana</option>
													<option value="Brazil">Brazil</option>
													<option value="British Indian Ocean Ter">British Indian Ocean Ter</option>
													<option value="Brunei">Brunei</option>
													<option value="Bulgaria">Bulgaria</option>
													<option value="Burkina Faso">Burkina Faso</option>
													<option value="Burundi">Burundi</option>
													<option value="Cambodia">Cambodia</option>
													<option value="Cameroon">Cameroon</option>
													<option value="Canada">Canada</option>
													<option value="Canary Islands">Canary Islands</option>
													<option value="Cape Verde">Cape Verde</option>
													<option value="Cayman Islands">Cayman Islands</option>
													<option value="Central African Republic">Central African Republic</option>
													<option value="Chad">Chad</option>
													<option value="Channel Islands">Channel Islands</option>
													<option value="Chile">Chile</option>
													<option value="China">China</option>
													<option value="Christmas Island">Christmas Island</option>
													<option value="Cocos Island">Cocos Island</option>
													<option value="Colombia">Colombia</option>
													<option value="Comoros">Comoros</option>
													<option value="Congo">Congo</option>
													<option value="Cook Islands">Cook Islands</option>
													<option value="Costa Rica">Costa Rica</option>
													<option value="Cote DIvoire">Cote D'Ivoire</option>
													<option value="Croatia">Croatia</option>
													<option value="Cuba">Cuba</option>
													<option value="Curaco">Curacao</option>
													<option value="Cyprus">Cyprus</option>
													<option value="Czech Republic">Czech Republic</option>
													<option value="Denmark">Denmark</option>
													<option value="Djibouti">Djibouti</option>
													<option value="Dominica">Dominica</option>
													<option value="Dominican Republic">Dominican Republic</option>
													<option value="East Timor">East Timor</option>
													<option value="Ecuador">Ecuador</option>
													<option value="Egypt">Egypt</option>
													<option value="El Salvador">El Salvador</option>
													<option value="Equatorial Guinea">Equatorial Guinea</option>
													<option value="Eritrea">Eritrea</option>
													<option value="Estonia">Estonia</option>
													<option value="Ethiopia">Ethiopia</option>
													<option value="Falkland Islands">Falkland Islands</option>
													<option value="Faroe Islands">Faroe Islands</option>
													<option value="Fiji">Fiji</option>
													<option value="Finland">Finland</option>
													<option value="France">France</option>
													<option value="French Guiana">French Guiana</option>
													<option value="French Polynesia">French Polynesia</option>
													<option value="French Southern Ter">French Southern Ter</option>
													<option value="Gabon">Gabon</option>
													<option value="Gambia">Gambia</option>
													<option value="Georgia">Georgia</option>
													<option value="Germany">Germany</option>
													<option value="Ghana">Ghana</option>
													<option value="Gibraltar">Gibraltar</option>
													<option value="Great Britain">Great Britain</option>
													<option value="Greece">Greece</option>
													<option value="Greenland">Greenland</option>
													<option value="Grenada">Grenada</option>
													<option value="Guadeloupe">Guadeloupe</option>
													<option value="Guam">Guam</option>
													<option value="Guatemala">Guatemala</option>
													<option value="Guinea">Guinea</option>
													<option value="Guyana">Guyana</option>
													<option value="Haiti">Haiti</option>
													<option value="Hawaii">Hawaii</option>
													<option value="Honduras">Honduras</option>
													<option value="Hong Kong">Hong Kong</option>
													<option value="Hungary">Hungary</option>
													<option value="Iceland">Iceland</option>
													<option value="India">India</option>
													<option value="Indonesia">Indonesia</option>
													<option value="Iran">Iran</option>
													<option value="Iraq">Iraq</option>
													<option value="Ireland">Ireland</option>
													<option value="Isle of Man">Isle of Man</option>
													<option value="Israel">Israel</option>
													<option value="Italy">Italy</option>
													<option value="Jamaica">Jamaica</option>
													<option value="Japan">Japan</option>
													<option value="Jordan">Jordan</option>
													<option value="Kazakhstan">Kazakhstan</option>
													<option value="Kenya">Kenya</option>
													<option value="Kiribati">Kiribati</option>
													<option value="Korea North">Korea North</option>
													<option value="Korea Sout">Korea South</option>
													<option value="Kuwait">Kuwait</option>
													<option value="Kyrgyzstan">Kyrgyzstan</option>
													<option value="Laos">Laos</option>
													<option value="Latvia">Latvia</option>
													<option value="Lebanon">Lebanon</option>
													<option value="Lesotho">Lesotho</option>
													<option value="Liberia">Liberia</option>
													<option value="Libya">Libya</option>
													<option value="Liechtenstein">Liechtenstein</option>
													<option value="Lithuania">Lithuania</option>
													<option value="Luxembourg">Luxembourg</option>
													<option value="Macau">Macau</option>
													<option value="Macedonia">Macedonia</option>
													<option value="Madagascar">Madagascar</option>
													<option value="Malaysia">Malaysia</option>
													<option value="Malawi">Malawi</option>
													<option value="Maldives">Maldives</option>
													<option value="Mali">Mali</option>
													<option value="Malta">Malta</option>
													<option value="Marshall Islands">Marshall Islands</option>
													<option value="Martinique">Martinique</option>
													<option value="Mauritania">Mauritania</option>
													<option value="Mauritius">Mauritius</option>
													<option value="Mayotte">Mayotte</option>
													<option value="Mexico">Mexico</option>
													<option value="Midway Islands">Midway Islands</option>
													<option value="Moldova">Moldova</option>
													<option value="Monaco">Monaco</option>
													<option value="Mongolia">Mongolia</option>
													<option value="Montserrat">Montserrat</option>
													<option value="Morocco">Morocco</option>
													<option value="Mozambique">Mozambique</option>
													<option value="Myanmar">Myanmar</option>
													<option value="Nambia">Nambia</option>
													<option value="Nauru">Nauru</option>
													<option value="Nepal">Nepal</option>
													<option value="Netherland Antilles">Netherland Antilles</option>
													<option value="Netherlands">Netherlands (Holland, Europe)</option>
													<option value="Nevis">Nevis</option>
													<option value="New Caledonia">New Caledonia</option>
													<option value="New Zealand">New Zealand</option>
													<option value="Nicaragua">Nicaragua</option>
													<option value="Niger">Niger</option>
													<option value="Nigeria">Nigeria</option>
													<option value="Niue">Niue</option>
													<option value="Norfolk Island">Norfolk Island</option>
													<option value="Norway">Norway</option>
													<option value="Oman">Oman</option>
													<option value="Pakistan">Pakistan</option>
													<option value="Palau Island">Palau Island</option>
													<option value="Palestine">Palestine</option>
													<option value="Panama">Panama</option>
													<option value="Papua New Guinea">Papua New Guinea</option>
													<option value="Paraguay">Paraguay</option>
													<option value="Peru">Peru</option>
													<option value="Phillipines">Philippines</option>
													<option value="Pitcairn Island">Pitcairn Island</option>
													<option value="Poland">Poland</option>
													<option value="Portugal">Portugal</option>
													<option value="Puerto Rico">Puerto Rico</option>
													<option value="Qatar">Qatar</option>
													<option value="Republic of Montenegro">Republic of Montenegro</option>
													<option value="Republic of Serbia">Republic of Serbia</option>
													<option value="Reunion">Reunion</option>
													<option value="Romania">Romania</option>
													<option value="Russia">Russia</option>
													<option value="Rwanda">Rwanda</option>
													<option value="St Barthelemy">St Barthelemy</option>
													<option value="St Eustatius">St Eustatius</option>
													<option value="St Helena">St Helena</option>
													<option value="St Kitts-Nevis">St Kitts-Nevis</option>
													<option value="St Lucia">St Lucia</option>
													<option value="St Maarten">St Maarten</option>
													<option value="St Pierre &amp; Miquelon">St Pierre &amp; Miquelon</option>
													<option value="St Vincent &amp; Grenadines">St Vincent &amp; Grenadines</option>
													<option value="Saipan">Saipan</option>
													<option value="Samoa">Samoa</option>
													<option value="Samoa American">Samoa American</option>
													<option value="San Marino">San Marino</option>
													<option value="Sao Tome &amp; Principe">Sao Tome &amp; Principe</option>
													<option value="Saudi Arabia">Saudi Arabia</option>
													<option value="Senegal">Senegal</option>
													<option value="Serbia">Serbia</option>
													<option value="Seychelles">Seychelles</option>
													<option value="Sierra Leone">Sierra Leone</option>
													<option value="Singapore">Singapore</option>
													<option value="Slovakia">Slovakia</option>
													<option value="Slovenia">Slovenia</option>
													<option value="Solomon Islands">Solomon Islands</option>
													<option value="Somalia">Somalia</option>
													<option value="South Africa">South Africa</option>
													<option value="Spain">Spain</option>
													<option value="Sri Lanka">Sri Lanka</option>
													<option value="Sudan">Sudan</option>
													<option value="Suriname">Suriname</option>
													<option value="Swaziland">Swaziland</option>
													<option value="Sweden">Sweden</option>
													<option value="Switzerland">Switzerland</option>
													<option value="Syria">Syria</option>
													<option value="Tahiti">Tahiti</option>
													<option value="Taiwan">Taiwan</option>
													<option value="Tajikistan">Tajikistan</option>
													<option value="Tanzania">Tanzania</option>
													<option value="Thailand">Thailand</option>
													<option value="Togo">Togo</option>
													<option value="Tokelau">Tokelau</option>
													<option value="Tonga">Tonga</option>
													<option value="Trinidad &amp; Tobago">Trinidad &amp; Tobago</option>
													<option value="Tunisia">Tunisia</option>
													<option value="Turkey">Turkey</option>
													<option value="Turkmenistan">Turkmenistan</option>
													<option value="Turks &amp; Caicos Is">Turks &amp; Caicos Is</option>
													<option value="Tuvalu">Tuvalu</option>
													<option value="Uganda">Uganda</option>
													<option value="Ukraine">Ukraine</option>
													<option value="United Arab Erimates">United Arab Emirates</option>
													<option value="United Kingdom">United Kingdom</option>
													<option value="United States of America">United States of America</option>
													<option value="Uraguay">Uruguay</option>
													<option value="Uzbekistan">Uzbekistan</option>
													<option value="Vanuatu">Vanuatu</option>
													<option value="Vatican City State">Vatican City State</option>
													<option value="Venezuela">Venezuela</option>
													<option value="Vietnam">Vietnam</option>
													<option value="Virgin Islands (Brit)">Virgin Islands (Brit)</option>
													<option value="Virgin Islands (USA)">Virgin Islands (USA)</option>
													<option value="Wake Island">Wake Island</option>
													<option value="Wallis &amp; Futana Is">Wallis &amp; Futana Is</option>
													<option value="Yemen">Yemen</option>
													<option value="Zaire">Zaire</option>
													<option value="Zambia">Zambia</option>
													<option value="Zimbabwe">Zimbabwe</option>
												</select>
											</label>
									    </div>
									</div>
									<div class="column-four">
										<div class="select-group irequire">
											<label for="currentstate" class="group custom-select">
				                                <select id="currentstate" name="currentstate" class="select">
													<option value="">Select State</option>
													<option value='Andaman and Nicobar Islands'>Andaman and Nicobar Islands</option>
													<option value='Andhra Pradesh'>Andhra Pradesh</option>
													<option value='Arunachal Pradesh'>Arunachal Pradesh</option>
													<option value='Assam'>Assam</option>
													<option value='Bihar'>Bihar</option>
													<option value='Chandigarh'>Chandigarh</option>
													<option value='Chhattisgarh'>Chhattisgarh</option>
													<option value='Dadra and Nagar Haveli'>Dadra and Nagar Haveli</option>
													<option value='Daman and Diu'>Daman and Diu</option>
													<option value='Delhi'>Delhi</option>
													<option value='Goa'>Goa</option>
													<option value='Gujarat'>Gujarat</option>
													<option value='Haryana'>Haryana</option>
													<option value='Himachal Pradesh'>Himachal Pradesh</option>
													<option value='Jammu and Kashmir'>Jammu and Kashmir</option>
													<option value='Jharkhand'>Jharkhand</option>
													<option value='Karnataka'>Karnataka</option>
													<option value='Kerala'>Kerala</option>
													<option value='Lakshadweep'>Lakshadweep</option>
													<option value='Madhya Pradesh'>Madhya Pradesh</option>
													<option value='Maharashtra'>Maharashtra</option>
													<option value='Manipur'>Manipur</option>
													<option value='Meghalaya'>Meghalaya</option>
													<option value='Mizoram'>Mizoram</option>
													<option value='Nagaland'>Nagaland</option>
													<option value='Odisha'>Odisha</option>
													<option value='Puducherry'>Puducherry</option>
													<option value='Punjab'>Punjab</option>
													<option value='Rajasthan'>Rajasthan</option>
													<option value='Sikkim'>Sikkim</option>
													<option value='Tamil Nadu'>Tamil Nadu</option>
													<option value='Telengana'>Telengana</option>
													<option value='Tripura'>Tripura</option>
													<option value='Uttar Pradesh'>Uttar Pradesh</option>
													<option value='Uttarakhand'>Uttarakhand</option>
													<option value='West Bengal'>West Bengal</option>
													<option value='Other'>Other State</option>
												</select>
											</label>
									    </div>
									</div>
									<div class="column-four">
										<div class="input-group-right" id="currentstateother-div">
										    <label for="currentstateother" class="group label-input">
				                                <input type="text" id="currentstateother" name="currentstateother" class="input-right" placeholder="Specify Other State" disabled="disabled">
											</label>
									    </div>
									</div>
									<div class="column-four">
										<div class="input-group-right irequire">
											<label for="currentzip" class="group label-input">
				                                <input type="text" id="currentzip" name="currentzip" class="input-right" placeholder="Pin/Zip code">
											</label>
									    </div>
									</div>
								</div>
							</div>
						</div>
						<div class="column-twelve">
						    <div class="box">
							    <div class="box-header" style="text-align:left">
								    <h3>Permanent Address</h3>
								</div>
								<div class="box-header" style="text-align:left; border-bottom:0; background-color: white;">
								    <div class="column-four">
										<h3 style="color:#777;">Same as current address?</h3>
									</div>
									<div class="column-four">
										<div class="input-group-right irequire">
											<div class="radio-group" style="margin-left:20px;">
												<label for="Yes" class="group space-right">
													<input type="radio" name="permanentsameascurrent" class="radio" value="Yes" id="Yes">
													<span class="label space-right">Yes</span>
												</label>
												<label for="No" class="group space-right">
													<input type="radio" name="permanentsameascurrent" class="radio" value="No" id="No">
													<span class="label space-right">No</span>
												</label>
											</div>
									    </div>
									</div>
								</div>
								<div class="box-section center">
									<div class="column-four">
										<div class="input-group-right irequire">
										    <label for="permanentaddress1" class="group label-input">
				                                <input type="text" id="permanentaddress1" name="permanentaddress1" class="input-right" placeholder="Address line 1">
											</label>
									    </div>
									</div>
									<div class="column-four">
										<div class="input-group-right">
											<label for="permanentaddress2" class="group label-input">
				                                <input type="text" id="permanentaddress2" name="permanentaddress2" class="input-right" placeholder="Address line 2">
											</label>
									    </div>
									</div>
									<div class="column-four">
										<div class="input-group-right">
											<label for="permanentaddress3" class="group label-input">
				                                <input type="text" id="permanentaddress3" name="permanentaddress3" class="input-right" placeholder="Address line 3">
											</label>
									    </div>
									</div>
									<div class="column-four">
										<div class="input-group-right irequire">
										    <label for="permanentcity" class="group label-input">
				                                <input type="text" id="permanentcity" name="permanentcity" class="input-right" placeholder="City">
											</label>
									    </div>
									</div>
									<div class="column-eight">
										<div class="select-group irequire">
											<label for="permanentcountry" class="group custom-select">
				                                <select id="permanentcountry" name="permanentcountry" class="select">
													<option value="">Select Country</option>
													<option value="Afganistan">Afghanistan</option>
													<option value="Albania">Albania</option>
													<option value="Algeria">Algeria</option>
													<option value="American Samoa">American Samoa</option>
													<option value="Andorra">Andorra</option>
													<option value="Angola">Angola</option>
													<option value="Anguilla">Anguilla</option>
													<option value="Antigua &amp; Barbuda">Antigua &amp; Barbuda</option>
													<option value="Argentina">Argentina</option>
													<option value="Armenia">Armenia</option>
													<option value="Aruba">Aruba</option>
													<option value="Australia">Australia</option>
													<option value="Austria">Austria</option>
													<option value="Azerbaijan">Azerbaijan</option>
													<option value="Bahamas">Bahamas</option>
													<option value="Bahrain">Bahrain</option>
													<option value="Bangladesh">Bangladesh</option>
													<option value="Barbados">Barbados</option>
													<option value="Belarus">Belarus</option>
													<option value="Belgium">Belgium</option>
													<option value="Belize">Belize</option>
													<option value="Benin">Benin</option>
													<option value="Bermuda">Bermuda</option>
													<option value="Bhutan">Bhutan</option>
													<option value="Bolivia">Bolivia</option>
													<option value="Bonaire">Bonaire</option>
													<option value="Bosnia &amp; Herzegovina">Bosnia &amp; Herzegovina</option>
													<option value="Botswana">Botswana</option>
													<option value="Brazil">Brazil</option>
													<option value="British Indian Ocean Ter">British Indian Ocean Ter</option>
													<option value="Brunei">Brunei</option>
													<option value="Bulgaria">Bulgaria</option>
													<option value="Burkina Faso">Burkina Faso</option>
													<option value="Burundi">Burundi</option>
													<option value="Cambodia">Cambodia</option>
													<option value="Cameroon">Cameroon</option>
													<option value="Canada">Canada</option>
													<option value="Canary Islands">Canary Islands</option>
													<option value="Cape Verde">Cape Verde</option>
													<option value="Cayman Islands">Cayman Islands</option>
													<option value="Central African Republic">Central African Republic</option>
													<option value="Chad">Chad</option>
													<option value="Channel Islands">Channel Islands</option>
													<option value="Chile">Chile</option>
													<option value="China">China</option>
													<option value="Christmas Island">Christmas Island</option>
													<option value="Cocos Island">Cocos Island</option>
													<option value="Colombia">Colombia</option>
													<option value="Comoros">Comoros</option>
													<option value="Congo">Congo</option>
													<option value="Cook Islands">Cook Islands</option>
													<option value="Costa Rica">Costa Rica</option>
													<option value="Cote DIvoire">Cote D'Ivoire</option>
													<option value="Croatia">Croatia</option>
													<option value="Cuba">Cuba</option>
													<option value="Curaco">Curacao</option>
													<option value="Cyprus">Cyprus</option>
													<option value="Czech Republic">Czech Republic</option>
													<option value="Denmark">Denmark</option>
													<option value="Djibouti">Djibouti</option>
													<option value="Dominica">Dominica</option>
													<option value="Dominican Republic">Dominican Republic</option>
													<option value="East Timor">East Timor</option>
													<option value="Ecuador">Ecuador</option>
													<option value="Egypt">Egypt</option>
													<option value="El Salvador">El Salvador</option>
													<option value="Equatorial Guinea">Equatorial Guinea</option>
													<option value="Eritrea">Eritrea</option>
													<option value="Estonia">Estonia</option>
													<option value="Ethiopia">Ethiopia</option>
													<option value="Falkland Islands">Falkland Islands</option>
													<option value="Faroe Islands">Faroe Islands</option>
													<option value="Fiji">Fiji</option>
													<option value="Finland">Finland</option>
													<option value="France">France</option>
													<option value="French Guiana">French Guiana</option>
													<option value="French Polynesia">French Polynesia</option>
													<option value="French Southern Ter">French Southern Ter</option>
													<option value="Gabon">Gabon</option>
													<option value="Gambia">Gambia</option>
													<option value="Georgia">Georgia</option>
													<option value="Germany">Germany</option>
													<option value="Ghana">Ghana</option>
													<option value="Gibraltar">Gibraltar</option>
													<option value="Great Britain">Great Britain</option>
													<option value="Greece">Greece</option>
													<option value="Greenland">Greenland</option>
													<option value="Grenada">Grenada</option>
													<option value="Guadeloupe">Guadeloupe</option>
													<option value="Guam">Guam</option>
													<option value="Guatemala">Guatemala</option>
													<option value="Guinea">Guinea</option>
													<option value="Guyana">Guyana</option>
													<option value="Haiti">Haiti</option>
													<option value="Hawaii">Hawaii</option>
													<option value="Honduras">Honduras</option>
													<option value="Hong Kong">Hong Kong</option>
													<option value="Hungary">Hungary</option>
													<option value="Iceland">Iceland</option>
													<option value="India">India</option>
													<option value="Indonesia">Indonesia</option>
													<option value="Iran">Iran</option>
													<option value="Iraq">Iraq</option>
													<option value="Ireland">Ireland</option>
													<option value="Isle of Man">Isle of Man</option>
													<option value="Israel">Israel</option>
													<option value="Italy">Italy</option>
													<option value="Jamaica">Jamaica</option>
													<option value="Japan">Japan</option>
													<option value="Jordan">Jordan</option>
													<option value="Kazakhstan">Kazakhstan</option>
													<option value="Kenya">Kenya</option>
													<option value="Kiribati">Kiribati</option>
													<option value="Korea North">Korea North</option>
													<option value="Korea Sout">Korea South</option>
													<option value="Kuwait">Kuwait</option>
													<option value="Kyrgyzstan">Kyrgyzstan</option>
													<option value="Laos">Laos</option>
													<option value="Latvia">Latvia</option>
													<option value="Lebanon">Lebanon</option>
													<option value="Lesotho">Lesotho</option>
													<option value="Liberia">Liberia</option>
													<option value="Libya">Libya</option>
													<option value="Liechtenstein">Liechtenstein</option>
													<option value="Lithuania">Lithuania</option>
													<option value="Luxembourg">Luxembourg</option>
													<option value="Macau">Macau</option>
													<option value="Macedonia">Macedonia</option>
													<option value="Madagascar">Madagascar</option>
													<option value="Malaysia">Malaysia</option>
													<option value="Malawi">Malawi</option>
													<option value="Maldives">Maldives</option>
													<option value="Mali">Mali</option>
													<option value="Malta">Malta</option>
													<option value="Marshall Islands">Marshall Islands</option>
													<option value="Martinique">Martinique</option>
													<option value="Mauritania">Mauritania</option>
													<option value="Mauritius">Mauritius</option>
													<option value="Mayotte">Mayotte</option>
													<option value="Mexico">Mexico</option>
													<option value="Midway Islands">Midway Islands</option>
													<option value="Moldova">Moldova</option>
													<option value="Monaco">Monaco</option>
													<option value="Mongolia">Mongolia</option>
													<option value="Montserrat">Montserrat</option>
													<option value="Morocco">Morocco</option>
													<option value="Mozambique">Mozambique</option>
													<option value="Myanmar">Myanmar</option>
													<option value="Nambia">Nambia</option>
													<option value="Nauru">Nauru</option>
													<option value="Nepal">Nepal</option>
													<option value="Netherland Antilles">Netherland Antilles</option>
													<option value="Netherlands">Netherlands (Holland, Europe)</option>
													<option value="Nevis">Nevis</option>
													<option value="New Caledonia">New Caledonia</option>
													<option value="New Zealand">New Zealand</option>
													<option value="Nicaragua">Nicaragua</option>
													<option value="Niger">Niger</option>
													<option value="Nigeria">Nigeria</option>
													<option value="Niue">Niue</option>
													<option value="Norfolk Island">Norfolk Island</option>
													<option value="Norway">Norway</option>
													<option value="Oman">Oman</option>
													<option value="Pakistan">Pakistan</option>
													<option value="Palau Island">Palau Island</option>
													<option value="Palestine">Palestine</option>
													<option value="Panama">Panama</option>
													<option value="Papua New Guinea">Papua New Guinea</option>
													<option value="Paraguay">Paraguay</option>
													<option value="Peru">Peru</option>
													<option value="Phillipines">Philippines</option>
													<option value="Pitcairn Island">Pitcairn Island</option>
													<option value="Poland">Poland</option>
													<option value="Portugal">Portugal</option>
													<option value="Puerto Rico">Puerto Rico</option>
													<option value="Qatar">Qatar</option>
													<option value="Republic of Montenegro">Republic of Montenegro</option>
													<option value="Republic of Serbia">Republic of Serbia</option>
													<option value="Reunion">Reunion</option>
													<option value="Romania">Romania</option>
													<option value="Russia">Russia</option>
													<option value="Rwanda">Rwanda</option>
													<option value="St Barthelemy">St Barthelemy</option>
													<option value="St Eustatius">St Eustatius</option>
													<option value="St Helena">St Helena</option>
													<option value="St Kitts-Nevis">St Kitts-Nevis</option>
													<option value="St Lucia">St Lucia</option>
													<option value="St Maarten">St Maarten</option>
													<option value="St Pierre &amp; Miquelon">St Pierre &amp; Miquelon</option>
													<option value="St Vincent &amp; Grenadines">St Vincent &amp; Grenadines</option>
													<option value="Saipan">Saipan</option>
													<option value="Samoa">Samoa</option>
													<option value="Samoa American">Samoa American</option>
													<option value="San Marino">San Marino</option>
													<option value="Sao Tome &amp; Principe">Sao Tome &amp; Principe</option>
													<option value="Saudi Arabia">Saudi Arabia</option>
													<option value="Senegal">Senegal</option>
													<option value="Serbia">Serbia</option>
													<option value="Seychelles">Seychelles</option>
													<option value="Sierra Leone">Sierra Leone</option>
													<option value="Singapore">Singapore</option>
													<option value="Slovakia">Slovakia</option>
													<option value="Slovenia">Slovenia</option>
													<option value="Solomon Islands">Solomon Islands</option>
													<option value="Somalia">Somalia</option>
													<option value="South Africa">South Africa</option>
													<option value="Spain">Spain</option>
													<option value="Sri Lanka">Sri Lanka</option>
													<option value="Sudan">Sudan</option>
													<option value="Suriname">Suriname</option>
													<option value="Swaziland">Swaziland</option>
													<option value="Sweden">Sweden</option>
													<option value="Switzerland">Switzerland</option>
													<option value="Syria">Syria</option>
													<option value="Tahiti">Tahiti</option>
													<option value="Taiwan">Taiwan</option>
													<option value="Tajikistan">Tajikistan</option>
													<option value="Tanzania">Tanzania</option>
													<option value="Thailand">Thailand</option>
													<option value="Togo">Togo</option>
													<option value="Tokelau">Tokelau</option>
													<option value="Tonga">Tonga</option>
													<option value="Trinidad &amp; Tobago">Trinidad &amp; Tobago</option>
													<option value="Tunisia">Tunisia</option>
													<option value="Turkey">Turkey</option>
													<option value="Turkmenistan">Turkmenistan</option>
													<option value="Turks &amp; Caicos Is">Turks &amp; Caicos Is</option>
													<option value="Tuvalu">Tuvalu</option>
													<option value="Uganda">Uganda</option>
													<option value="Ukraine">Ukraine</option>
													<option value="United Arab Erimates">United Arab Emirates</option>
													<option value="United Kingdom">United Kingdom</option>
													<option value="United States of America">United States of America</option>
													<option value="Uraguay">Uruguay</option>
													<option value="Uzbekistan">Uzbekistan</option>
													<option value="Vanuatu">Vanuatu</option>
													<option value="Vatican City State">Vatican City State</option>
													<option value="Venezuela">Venezuela</option>
													<option value="Vietnam">Vietnam</option>
													<option value="Virgin Islands (Brit)">Virgin Islands (Brit)</option>
													<option value="Virgin Islands (USA)">Virgin Islands (USA)</option>
													<option value="Wake Island">Wake Island</option>
													<option value="Wallis &amp; Futana Is">Wallis &amp; Futana Is</option>
													<option value="Yemen">Yemen</option>
													<option value="Zaire">Zaire</option>
													<option value="Zambia">Zambia</option>
													<option value="Zimbabwe">Zimbabwe</option>
												</select>
											</label>
									    </div>
									</div>
									<div class="column-four">
										<div class="select-group irequire">
											<label for="permanentstate" class="group custom-select">
				                                <select id="permanentstate" name="permanentstate" class="select">
													<option value="">Select State</option>
													<option value='Andaman and Nicobar Islands'>Andaman and Nicobar Islands</option>
													<option value='Andhra Pradesh'>Andhra Pradesh</option>
													<option value='Arunachal Pradesh'>Arunachal Pradesh</option>
													<option value='Assam'>Assam</option>
													<option value='Bihar'>Bihar</option>
													<option value='Chandigarh'>Chandigarh</option>
													<option value='Chhattisgarh'>Chhattisgarh</option>
													<option value='Dadra and Nagar Haveli'>Dadra and Nagar Haveli</option>
													<option value='Daman and Diu'>Daman and Diu</option>
													<option value='Delhi'>Delhi</option>
													<option value='Goa'>Goa</option>
													<option value='Gujarat'>Gujarat</option>
													<option value='Haryana'>Haryana</option>
													<option value='Himachal Pradesh'>Himachal Pradesh</option>
													<option value='Jammu and Kashmir'>Jammu and Kashmir</option>
													<option value='Jharkhand'>Jharkhand</option>
													<option value='Karnataka'>Karnataka</option>
													<option value='Kerala'>Kerala</option>
													<option value='Lakshadweep'>Lakshadweep</option>
													<option value='Madhya Pradesh'>Madhya Pradesh</option>
													<option value='Maharashtra'>Maharashtra</option>
													<option value='Manipur'>Manipur</option>
													<option value='Meghalaya'>Meghalaya</option>
													<option value='Mizoram'>Mizoram</option>
													<option value='Nagaland'>Nagaland</option>
													<option value='Odisha'>Odisha</option>
													<option value='Puducherry'>Puducherry</option>
													<option value='Punjab'>Punjab</option>
													<option value='Rajasthan'>Rajasthan</option>
													<option value='Sikkim'>Sikkim</option>
													<option value='Tamil Nadu'>Tamil Nadu</option>
													<option value='Telengana'>Telengana</option>
													<option value='Tripura'>Tripura</option>
													<option value='Uttar Pradesh'>Uttar Pradesh</option>
													<option value='Uttarakhand'>Uttarakhand</option>
													<option value='West Bengal'>West Bengal</option>
													<option value='Other'>Other State</option>
												</select>
											</label>
									    </div>
									</div>
									<div class="column-four">
										<div class="input-group-right" id="permanentstateother-div">
										    <label for="permanentstateother" class="group label-input">
				                                <input type="text" id="permanentstateother" name="permanentstateother" class="input-right" placeholder="Specify Other State" disabled="disabled">
											</label>
									    </div>
									</div>
									<div class="column-four">
										<div class="input-group-right irequire">
											<label for="permanentzip" class="group label-input">
				                                <input type="text" id="permanentzip" name="permanentzip" class="input-right" placeholder="Pin/Zip code">
											</label>
									    </div>
									</div>
								</div>
							</div>
						</div>
						<div class="column-twelve">
						    <div class="box">
							    <div class="box-header" style="text-align:left">
								    <h3>Parent’s/Guardian’s Details</h3>
								</div>
								<div class="box-section center">
									<div class="column-four">
										<div class="input-group-right">
										    <label for="parentname" class="group label-input">
				                                <input type="text" id="parentname" name="parentname" class="input-right" placeholder="Full Name">
											</label>
									    </div>
									</div>
									<div class="column-four">
										<div class="input-group-right">
											<label for="parentmobile" class="group label-input">
				                                <input type="text" id="parentmobile" name="parentmobile" class="input-right" placeholder="Mobile number">
											</label>
									    </div>
									</div>
									<div class="column-four">
										<div class="input-group-right">
											<label for="parentrelation" class="group label-input">
				                                <input type="text" id="parentrelation" name="parentrelation" class="input-right" placeholder="Your relation to the contact">
											</label>
									    </div>
									</div>
									<div class="column-four">
										<div class="input-group-right">
										    <label for="parentorganisation" class="group label-input">
				                                <input type="text" id="parentorganisation" name="parentorganisation" class="input-right" placeholder="Organisation">
											</label>
									    </div>
									</div>
									<div class="column-four">
										<div class="input-group-right">
											<label for="parentdesignation" class="group label-input">
				                                <input type="text" id="parentdesignation" name="parentdesignation" class="input-right" placeholder="Designation">
											</label>
									    </div>
									</div>
									<div class="column-four">
										<div class="input-group-right">
											<label for="parentqualification" class="group label-input">
				                                <input type="text" id="parentqualification" name="parentqualification" class="input-right" placeholder="Academic Qualification">
											</label>
									    </div>
									</div>
								</div>
							</div>
						</div>
						<div class="column-two">
							<button type="button" id="back-button-contact" class="button button-large button-blue">Back</button>
						</div>
						<div class="column-two">
							<button type="button" id="save-button-contact" class="button button-large button-blue">Save</button>
						</div>
						<div class="column-two">
							<button type="button" id="continue-button-contact" class="button button-large button-green">Save and Continue</button>
						</div>
					</div>
				</fieldset>
			</form>
		</div>	
	</div>