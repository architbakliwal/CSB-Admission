	

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
								    <h3>Class Xth</h3>
								</div>
								<div class="box-section center">
									<div class="column-four">
										<div class="input-group-right irequire">
										    <label for="tenthinstitutename" class="group label-input">
				                                <input type="text" id="tenthinstitutename" name="tenthinstitutename" class="input-right" placeholder="Name of Institution">
											</label>
									    </div>
									</div>
									<div class="column-four">
										<div class="select-group irequire">
											<label for="tenthboard" class="group custom-select">
												<select id="tenthboard" name="tenthboard" class="select">
												    <option value="">Select Board</option>
													<option value="ICSE">ICSE</option>
													<option value="CBSE">CBSE</option>
													<option value="IGCSE">IGCSE</option>
													<option value="NOIS">NOIS</option>
													<option value="Matriculation Board">Matriculation Board</option>
													<option value="Aligargh Muslim University">Aligargh Muslim University</option>
													<option value="IB">IB</option>
													<option value="State Board">State Board</option>
													<option value="Others">Others</option>
												</select>
											</label>
								        </div>
									</div>
									<div class="column-four">
										<div class="input-group-right" id="tenthboardothers-div">
											<label for="tenthboardothers" class="group label-input">
				                                <input type="text" id="tenthboardothers" name="tenthboardothers" class="input-right" placeholder="If State Board/Others, please specify" disabled="disabled">
											</label>
									    </div>
									</div>
									<div class="column-four">
										<div class="input-group-right irequire">
										    <label for="tenthaggregate" class="group label-input">
				                                <input type="text" id="tenthaggregate" name="tenthaggregate" class="input-right" placeholder="Xth aggregate percentage">
											</label>
									    </div>
									</div>
									<div class="column-four">
										<div class="select-group irequire">
											<label for="tenthcompletion" class="group custom-select">
												<?php
													$current_year = date("Y");
													$range = range(1950, $current_year+1);
													echo '<select id="tenthcompletion" name="tenthcompletion" class="select">';
													echo '<option value="">Year of completion</option>';
													 
													foreach($range as $r)
													{
													echo '<option value="'.$r.'">'.$r.'</option>';
													}
													 
													echo '</select>';
												?>
											</label>
								        </div>
									</div>
								</div>
							</div>
						</div>
						<div class="column-twelve">
						    <div class="box">
							    <div class="box-header" style="text-align:left">
								    <h3>Class XIIth / Diploma</h3>
								</div>
								<div class="box-header" style="text-align:left; border-bottom:0; background-color: white;">
								    <div class="column-four">
										<h3 style="color:#777;">Select one</h3>
									</div>
									<div class="column-four">
										<div class="input-group-right irequire">
											<div class="radio-group" style="margin-left: 20px;">
												<label for="twelfth-radio" class="group space-right">
													<input type="radio" name="twelfthordiploma" class="radio" value="XIIth" id="twelfth-radio">
													<span class="label space-right">XIIth</span>
												</label>
												<label for="diploma-radio" class="group space-right">
													<input type="radio" name="twelfthordiploma" class="radio" value="Diploma" id="diploma-radio">
													<span class="label space-right">Diploma</span>
												</label>
											</div>
									    </div>
									</div>
								</div>
								<div class="box-section center">
									<div class="column-four">
										<div class="input-group-right irequire">
										    <label for="twelfthinstitutename" class="group label-input">
				                                <input type="text" id="twelfthinstitutename" name="twelfthinstitutename" class="input-right" placeholder="Name of Institution">
											</label>
									    </div>
									</div>
									<div class="column-four">
										<div class="select-group irequire">
										<label for="twelfthboard" class="group custom-select">
											<select id="twelfthboard" name="twelfthboard" class="select">
											    <option value="">Select Board</option>
												<option value="CBSE">CBSE</option>
												<option value="ISC">ISC</option>
												<option value="NOIS">NOIS</option>
												<option value="Matriculation Board">Matriculation Board</option>
												<option value="Aligargh Muslim University">Aligargh Muslim University</option>
												<option value="IB">IB</option>
												<option value="State Board">State Board</option>
												<option value="Others">Others</option>
											</select>
										</label>
							        </div>
									</div>
									<div class="column-four">
										<div class="input-group-right" id="twelfthboardothers-div">
											<label for="twelfthboardothers" class="group label-input">
				                                <input type="text" id="twelfthboardothers" name="twelfthboardothers" class="input-right" placeholder="If State Board/Others, please specify" disabled="disabled">
											</label>
									    </div>
									</div>
									<div class="column-four">
										<div class="input-group-right irequire">
										    <label for="twelfthaggregate" class="group label-input">
				                                <input type="text" id="twelfthaggregate" name="twelfthaggregate" class="input-right" placeholder="XIIth aggregate percentage">
											</label>
									    </div>
									</div>
									<div class="column-four">
										<div class="select-group irequire">
											<label for="twelfthcompletion" class="group custom-select">
												<?php
													$current_year = date("Y");
													$range = range(1950, $current_year+1);
													echo '<select id="twelfthcompletion" name="twelfthcompletion" class="select">';
													echo '<option value="">Year of completion</option>';
													 
													foreach($range as $r)
													{
													echo '<option value="'.$r.'">'.$r.'</option>';
													}
													 
													echo '</select>';
												?>
											</label>
								        </div>
									</div>
								</div>
							</div>
						</div>
						<div class="column-twelve">
						    <div class="box">
							    <div class="box-header" style="text-align:left">
								    <h3>Graduation</h3>
								</div>
								<div class="box-section center">
									<div class="column-four">
										<div class="input-group-right irequire">
										    <label for="gradutationcollegename" class="group label-input">
				                                <input type="text" id="gradutationcollegename" name="gradutationcollegename" class="input-right" placeholder="Name of college">
											</label>
									    </div>
									</div>
									<div class="column-four">
										<div class="select-group irequire">
											<label for="gradutationunversity" class="group custom-select">
												<select id="gradutationunversity" name="gradutationunversity" class="select">
													<option value="">Select University Name</option>
												    <option value="099">International</option>
													<option value="101">Andhra Pradesh, ACHARYA N.G. RANGA AGRICULTURAL</option>
													<option value="102">Andhra Pradesh, ACHARYA NAGARJUNA</option>
													<option value="104">Andhra Pradesh, ANDHRA</option>
													<option value="103">Andhra Pradesh, ANDHRA PRADESH UNIVERSITY OF HEALTH SCIENCES</option>
													<option value="105">Andhra Pradesh, CENTRAL INSTITUTE OF ENGLISH & FOREIGN LANGUAGES</option>
													<option value="106">Andhra Pradesh, DR. B.R. AMBEDKAR OPEN (HYDERABAD)</option>
													<option value="107">Andhra Pradesh, DRAVIDIAN</option>
													<option value="108">Andhra Pradesh, HYDERABAD</option>
													<option value="109">Andhra Pradesh, INTERNATIONAL INSTITUTE OF INFORMATION TECHNOLOGY</option>
													<option value="110">Andhra Pradesh, J.N.T.U.</option>
													<option value="111">Andhra Pradesh, KAKATIYA</option>
													<option value="112">Andhra Pradesh, MAULANA AZAD NATIONAL URDU</option>
													<option value="113">Andhra Pradesh, NAGARJUNA</option>
													<option value="114">Andhra Pradesh, NATIONAL ACADEMY OF LEGAL STUDIES AND RESEARCH</option>
													<option value="115">Andhra Pradesh, NATIONAL INSTITUTE OF TECHNOLOGY, WARANGAL</option>
													<option value="116">Andhra Pradesh, NIZAMS INSTITUTE OF MEDICAL SCIENCES</option>
													<option value="117">Andhra Pradesh, OSMANIA</option>
													<option value="118">Andhra Pradesh, POTTI SREERAMULU TELUGU</option>
													<option value="119">Andhra Pradesh, RASHTRIYA SANSKRIT VIDYAPEETHA</option>
													<option value="120">Andhra Pradesh, SRI KRISHNADEVARAYA</option>
													<option value="121">Andhra Pradesh, SRI PADMAVATHI MAHILA</option>
													<option value="122">Andhra Pradesh, SRI SATHYA SAI INSTITUTE OF HIGHER LEARNING</option>
													<option value="123">Andhra Pradesh, SRI VENKATESWARA</option>
													<option value="124">Andhra Pradesh, SRI VENKATESWARA INSTITUTE OF MEDICAL SCIENCES</option>
													<option value="125">Andhra Pradesh, ANY OTHER</option>
													<option value="126">Arunachal Pradesh, ARUNACHAL</option>
													<option value="128">Arunachal Pradesh, NORTH EASTERN REGIONAL INSTITUTE OF SCIENCE AND TECHNOLOGY</option>
													<option value="127">Arunachal Pradesh, RAJIV GANDHI</option>
													<option value="129">Arunachal Pradesh, ANY OTHER</option>
													<option value="131">Assam, ASSAM</option>
													<option value="130">Assam, ASSAM AGRICULTURAL</option>
													<option value="132">Assam, DIBRUGARH</option>
													<option value="133">Assam, GAUHATI</option>
													<option value="134">Assam, INDIAN INSTITUTE OF TECHNOLOGY GUWAHATI</option>
													<option value="135">Assam, NATIONAL INSTITUTE OF TECHNOLOGY, SILCHAR</option>
													<option value="136">Assam, TEZPUR</option>
													<option value="137">Assam, ANY OTHER</option>
													<option value="138">Bihar, BABASAHEB BHIMRAO AMBEDKAR BIHAR (MUZAFFARPUR)</option>
													<option value="139">Bihar, BHUPENDRA NARAYAN MANDAL</option>
													<option value="140">Bihar, BIHAR YOGA BHARATI</option>
													<option value="141">Bihar, CHANAKYA NATIONAL LAW</option>
													<option value="142">Bihar, INDIRA GANDHI INSTITUTE OF MEDICAL SCIENCES</option>
													<option value="143">Bihar, JAI PRAKASH</option>
													<option value="144">Bihar, KAMESHWHAR</option>
													<option value="515">Bihar, Kameshwar Singh Darbhanga Sanskrit</option>
													<option value="145">Bihar, LALIT NARAYAN MITHILA</option>
													<option value="146">Bihar, MAGADH</option>
													<option value="147">Bihar, MAULANA NAZARUL HAQ</option>
													<option value="516">Bihar, Maulana Mazharul Haque Arabic & Persian</option>
													<option value="148">Bihar, NALANDA OPEN</option>
													<option value="149">Bihar, PATNA</option>
													<option value="150">Bihar, RAJENDRA AGRICULTURAL (SAMASTIPUR)</option>
													<option value="151">Bihar, TILKA MANJHI BHAGALPUR</option>
													<option value="152">Bihar, VEER KUNWAR SINGH</option>
													<option value="153">Bihar, ANY OTHER</option>
													<option value="154">Chandigarh, PANJAB (CHANDIGARH)</option>
													<option value="155">Chandigarh, POSTGRADUATE INSTITUTE OF MEDICAL EDUCATION AND RESEARCH</option>
													<option value="156">Chandigarh, PUNJAB ENGINEERING COLLEGE</option>
													<option value="157">Chandigarh, ANY OTHER</option>
													<option value="158">Chhattisgarh, Chhattisgarh Swami Vivekanand Technical University</option>
													<option value="159">Chhattisgarh, GURU GHASIDAS</option>
													<option value="160">Chhattisgarh, HIDAYATULLAH NATIONAL LAW UNIVERSITY</option>
													<option value="161">Chhattisgarh, INDIRA GANDHI KRISHI VISHWAVIDYALAYA</option>
													<option value="162">Chhattisgarh, Indira Kala Sangeet</option>
													<option value="163">Chhattisgarh, KUSHABHAU THACKERY</option>
													<option value="164">Chhattisgarh, PANDIT RAVISHANKAR SHUKLA</option>
													<option value="165">Chhattisgarh, PANDIT SUNDARLAL SHARMA</option>
													<option value="166">Chhattisgarh, ANY OTHER</option>
													<option value="167">Delhi, ALL INDIA INSTITUTE OF MEDICAL SCIENCES</option>
													<option value="168">Delhi, DELHI</option>
													<option value="169">Delhi, GURU GOVIND SINGH INDRAPRASTHA</option>
													<option value="170">Delhi, INDIAN AGRICULTURAL RESEARCH INSTITUTE</option>
													<option value="171">Delhi, INDIAN INSTITUTE OF FOREIGN TRADE</option>
													<option value="172">Delhi, INDIAN INSTITUTE OF TECHNOLOGY DELHI</option>
													<option value="173">Delhi, INDIAN LAW INSTITUTE</option>
													<option value="174">Delhi, INDIRA GANDHI NATIONAL OPEN</option>
													<option value="175">Delhi, JAMIA HAMDARD</option>
													<option value="176">Delhi, JAMIA MILLIA ISLAMIA</option>
													<option value="177">Delhi, JAWAHARLAL NEHRU</option>
													<option value="179">Delhi, NATIONAL MUSUEM INSTITUTE</option>
													<option value="178">Delhi, NATIONAL SCHOOL OF DRAMA</option>
													<option value="180">Delhi, NATIONAL UNIVERSITY OF EDUCATIONAL PLANNING & ADMINISTRATION</option>
													<option value="181">Delhi, RASHTRIYA SANSKRIT SANSTHANA</option>
													<option value="182">Delhi, SCHOOL OF PLANNING AND ARCHITECTURE</option>
													<option value="183">Delhi, SRI LAL BAHADUR SHASTRI</option>
													<option value="517">Delhi, Shri Lal Bahadur Shastri Rashtriya Sanskrit Vidyapeeth</option>
													<option value="184">Delhi, TERI SCHOOL OF ADVANCED STUDIES</option>
													<option value="525">Delhi, THE INSTITUTION OF CIVIL ENGINEERS</option>
													<option value="185">Delhi, ANY OTHER</option>
													<option value="186">Goa, GOA</option>
													<option value="187">Goa, ANY OTHER</option>
													<option value="188">Gujarat, BHAVNAGAR</option>
													<option value="189">Gujarat, CENTRE FOR ENVIRONMENTAL PLANNING & TECHNOLOGY</option>
													<option value="190">Gujarat, DHARMSINH DESAI</option>
													<option value="191">Gujarat, DHIRUBHAI AMBANI INSTITUTE OF INFORMATION & COMMUNICATION TECHNOLOGY</option>
													<option value="192">Gujarat, DR. BABASAHEB AMBEDKAR OPEN (AHMEDABAD)</option>
													<option value="193">Gujarat, GANPAT</option>
													<option value="196">Gujarat, GUJARAT</option>
													<option value="194">Gujarat, GUJARAT AGRICULTURAL</option>
													<option value="195">Gujarat, GUJARAT AYURVED</option>
													<option value="197">Gujarat, GUJARAT NATIONAL LAW</option>
													<option value="198">Gujarat, GUJARAT VIDYAPEETH</option>
													<option value="199">Gujarat, HEMCHANDRACHARYA NORTH GUJARAT</option>
													<option value="200">Gujarat, KRANTIGURU SHYAMJI KRISHNAVERMA KACHCH</option>
													<option value="201">Gujarat, MS UNIVERSITY OF BARODA</option>
													<option value="202">Gujarat, NIRMA UNIVERSITY OF SCIENCE & TECHNOLOGY</option>
													<option value="203">Gujarat, SARDAR PATEL</option>
													<option value="204">Gujarat, SARDAR VALLABHBHAI NATIONAL INSTITUTE OF TECHNOLOGY, SURAT</option>
													<option value="205">Gujarat, SAURASHTRA</option>
													<option value="206">Gujarat, SHREE SOMNATH SANSKRIT</option>
													<option value="207">Gujarat, SUMANDEEP VIDYAPEETH</option>
													<option value="208">Gujarat, VEER NARMAD SOUTH GUJARAT</option>
													<option value="209">Gujarat, ANY OTHER</option>
													<option value="210">Haryana, CHAUDHARY CHARAN SINGH HARYANA AGRICULTURAL</option>
													<option value="211">Haryana, CHAUDHARY DEVI LAL, SIRSA</option>
													<option value="212">Haryana, GURU JAMBESHWAR</option>
													<option value="213">Haryana, KURUKSHETRA</option>
													<option value="214">Haryana, MAHARSHI DAYANAND</option>
													<option value="215">Haryana, NATIONAL BRAIN RESEARCH CENTRE, GURGAON</option>
													<option value="216">Haryana, NATIONAL DAIRY RESEARCH INSTITUTE, KARNAL</option>
													<option value="217">Haryana, NATIONAL INSTITUTE OF TECHNOLOGY, KURUKSHETRA</option>
													<option value="218">Haryana, ANY OTHER</option>
													<option value="219">Himachal Pradesh, CHAUDHARY SARWAN KUMAR HIMACHAL PRADESH KRISHI</option>
													<option value="220">Himachal Pradesh, DR. Y.S. PARMAR UNIVERSITY OF HORTICULTURE & FORESTRY, NAUNI</option>
													<option value="221">Himachal Pradesh, HIMACHAL PRADESH</option>
													<option value="222">Himachal Pradesh, JAYPEE UNIVERSITY OF INFORMATION TECHNOLOGY, SOLAN</option>
													<option value="223">Himachal Pradesh, NATIONAL INSTITUTE OF TECHNOLOGY, HAMIRPUR</option>
													<option value="224">Himachal Pradesh, ANY OTHER</option>
													<option value="225">Jammu & Kashmir, BABA GHULAM SHAH BADSHAH</option>
													<option value="226">Jammu & Kashmir, JAMMU</option>
													<option value="227">Jammu & Kashmir, KASHMIR</option>
													<option value="228">Jammu & Kashmir, NATIONAL INSTITUTE OF TECHNOLOGY, SRINAGAR</option>
													<option value="230">Jammu & Kashmir, SHER-E-KASHMIR UNIVERSITY OF AGRICULTURAL SCIENCES & TECHNOLOGY</option>
													<option value="229">Jammu & Kashmir, SHER-E-KASHMIR UNIVERSITY OF MEDICAL SCIENCES</option>
													<option value="231">Jammu & Kashmir, SHRI MATA VAISHNO DEVI</option>
													<option value="232">Jammu & Kashmir, ANY OTHER</option>
													<option value="234">Jharkhand, BIRSA AGRICULTURAL</option>
													<option value="520">Jharkhand, BIT Ranchi</option>
													<option value="235">Jharkhand, INDIAN SCHOOL OF MINES</option>
													<option value="236">Jharkhand, NATIONAL INSTITUTE OF TECHNOLOGY, JAMSHEDPUR</option>
													<option value="237">Jharkhand, RANCHI</option>
													<option value="238">Jharkhand, SIDO-KANHU MURMU</option>
													<option value="239">Jharkhand, VINOBA BHAVE</option>
													<option value="240">Jharkhand, ANY OTHER</option>
													<option value="241">Karnataka, BANGALORE</option>
													<option value="242">Karnataka, GULBARGA</option>
													<option value="243">Karnataka, INDIAN INSTITUTE OF SCIENCE</option>
													<option value="244">Karnataka, INTERNATIONAL INSTITUTE OF INFORMATION TECHNOLOGY</option>
													<option value="245">Karnataka, JAWAHARLAL NEHRU CENTRE FOR ADVANCED SCIENTIFIC RESEARCH</option>
													<option value="246">Karnataka, KANNADA</option>
													<option value="250">Karnataka, KARNATAKA</option>
													<option value="247">Karnataka, KARNATAKA STATE OPEN</option>
													<option value="248">Karnataka, KARNATAKA STATE WOMEN, BIJAPUR</option>
													<option value="249">Karnataka, KARNATAKA VETERINARY ANIMAL & FISHERIES SCIENCES</option>
													<option value="252">Karnataka, KLE ACADEMY OF HIGHER EDUCATION & RESEARCH</option>
													<option value="251">Karnataka, KUVEMPU</option>
													<option value="253">Karnataka, MANGALORE</option>
													<option value="254">Karnataka, MANIPAL ACADEMY OF HIGHER EDUCATION</option>
													<option value="255">Karnataka, MYSORE</option>
													<option value="257">Karnataka, NATIONAL INSTITUTE OF TECHNOLOGY, SURATHKAL</option>
													<option value="258">Karnataka, NATIONAL LAW SCHOOL OF INDIA UNIVERSITY</option>
													<option value="256">Karnataka, NIMHANS</option>
													<option value="259">Karnataka, RAJIV GANDHI UNIVERSITY OF HEALTH SCIENCES</option>
													<option value="260">Karnataka, SWAMI VIVEKANANDA YOGA</option>
													<option value="518">Karnataka, Swami Vivekananda Yog Anusandhana Samsthana</option>
													<option value="261">Karnataka, TUMKUR</option>
													<option value="262">Karnataka, UNIVERSITY OF AGRICULTURAL SCIENCES (BANGALORE)</option>
													<option value="263">Karnataka, UNIVERSITY OF AGRICULTURAL SCIENCES (DHARWAD)</option>
													<option value="264">Karnataka, VISVESWARAIAH TECHNOLOGICAL UNIVERSITY</option>
													<option value="265">Karnataka, ANY OTHER</option>
													<option value="266">Kerala, CALICUT</option>
													<option value="267">Kerala, COCHIN UNIVERSITY OF SCIENCE & TECHNOLOGY</option>
													<option value="268">Kerala, KANNUR</option>
													<option value="269">Kerala, KERALA</option>
													<option value="270">Kerala, KERALA AGRICULTURAL</option>
													<option value="271">Kerala, KERALA KALAMANDALAM</option>
													<option value="272">Kerala, MAHATMA GANDHI (KOTTAYAM)</option>
													<option value="273">Kerala, NATIONAL INSTITUTE OF TECHNOLOGY, CALICUT</option>
													<option value="275">Kerala, SREE SANKARACHARYA UNIVERSITY OF SANSKRIT</option>
													<option value="274">Kerala, Sree Chitra Tirunal Institute for Medical Sciences and Technology</option>
													<option value="276">Kerala, ANY OTHER</option>
													<option value="277">Madhya Pradesh, AWADHESH PRATAP SINGH</option>
													<option value="278">Madhya Pradesh, BARKATULLAH</option>
													<option value="279">Madhya Pradesh, DEVI AHILYA</option>
													<option value="280">Madhya Pradesh, DR. HARISINGH GOUR</option>
													<option value="281">Madhya Pradesh, INDIAN INSTITUTE OF INFORMATION TECHNOLOGY AND MANAGEMENT</option>
													<option value="282">Madhya Pradesh, JAWAHARLAL NEHRU KRISHI (JABALPUR)</option>
													<option value="283">Madhya Pradesh, JIWAJI</option>
													<option value="284">Madhya Pradesh, LAKSHMI BAI NATIONAL INST OF PHYSICAL EDUCATION</option>
													<option value="285">Madhya Pradesh, MADHYA PRADESH BHOJ (OPEN)</option>
													<option value="286">Madhya Pradesh, MAHARISHI MAHESH YOGI VEDIC</option>
													<option value="287">Madhya Pradesh, MAHATMA GANDHI CHITRAKOOT GRAMODAY</option>
													<option value="288">Madhya Pradesh, MAKHANLAL CHATURVEDI RASHTRIYA PATRAKARITA</option>
													<option value="289">Madhya Pradesh, MAULANA AZAD NATIONAL INSTITUTE OF TECHNOLOGY, BHOPAL</option>
													<option value="290">Madhya Pradesh, NATIONAL LAW INSTITUTE</option>
													<option value="519">Madhya Pradesh, Punjab Technical</option>
													<option value="291">Madhya Pradesh, RAJIV GANDHI PROUDYOGIKI</option>
													<option value="292">Madhya Pradesh, RANI DURGAVATI</option>
													<option value="293">Madhya Pradesh, VIKRAM (UJJAIN)</option>
													<option value="294">Madhya Pradesh, ANY OTHER</option>
													<option value="295">Maharashtra, AMRAVATI</option>
													<option value="296">Maharashtra, BHARATI VIDYAPEETH</option>
													<option value="233">Maharashtra, BIT RANCHI</option>
													<option value="297">Maharashtra, Central Institute of Fisheries Education</option>
													<option value="304">Maharashtra, DATTA MEGHE INSTITUTE OF MEDICAL SCIENCES</option>
													<option value="299">Maharashtra, DEFENCE INSTITUTE OF ADVANCED TECHNOLOGY</option>
													<option value="300">Maharashtra, DR. BABASAHEB AMBEDKAR MARATHWADA (AURANGABAD)</option>
													<option value="301">Maharashtra, DR. BABASAHEB AMBEDKAR TECHNOLOGICAL</option>
													<option value="302">Maharashtra, DR. D.Y. PATIL EDUCATION SOCIETY</option>
													<option value="303">Maharashtra, DR. D.Y. PATIL VIDYAPEETH</option>
													<option value="305">Maharashtra, DR. PANJABRAO DESHMUKH KRISHI VIDYAPEETH</option>
													<option value="298">Maharashtra, Deccan College Post Graduate and Research Institute</option>
													<option value="306">Maharashtra, GOKHALE INSTITUTE OF POLITICS & ECONOMICS</option>
													<option value="307">Maharashtra, Homi Bhabha National Institute</option>
													<option value="308">Maharashtra, INDIAN INSTITUTE OF TECHNOLOGY BOMBAY</option>
													<option value="309">Maharashtra, INDIRA GANDHI INSTITUTE OF DEVELOPMENT RESEARCH</option>
													<option value="310">Maharashtra, INSTITUTE OF ARMAMENT TECH</option>
													<option value="311">Maharashtra, INTERNATIONAL INSTITUTE OF POPULATION SCIENCES</option>
													<option value="312">Maharashtra, KAVIKULGURU KALIDAS SANSKRIT</option>
													<option value="313">Maharashtra, KONKAN KRISHI VIDYAPEETH</option>
													<option value="314">Maharashtra, KRISHNA INST OF MEDICAL SCIENCES</option>
													<option value="315">Maharashtra, MAHARASHTRA ANIMAL & FISHERY SCIENCES</option>
													<option value="316">Maharashtra, MAHARASHTRA UNIVERSITY OF HEALTH SCIENCES</option>
													<option value="318">Maharashtra, MAHATMA PHULE KRISHI VIDYAPEETH</option>
													<option value="319">Maharashtra, MARATHWADA AGRICULTURAL</option>
													<option value="513">Maharashtra, MUMBAI UNIVERSITY</option>
													<option value="317">Maharashtra, Mahatma Gandhi Antarrashtriya Hindi</option>
													<option value="321">Maharashtra, NAGPUR</option>
													<option value="322">Maharashtra, NARSEE MONJEE INSTITUTE OF MANAGEMENT STUDIES</option>
													<option value="323">Maharashtra, NORTH MAHARASHTRA</option>
													<option value="324">Maharashtra, PADMASHREE DR. D.Y. PATIL VIDYAPEETH (MUMBAI)</option>
													<option value="325">Maharashtra, PRAVARA INSTITUTE OF MEDICAL SCIENCES</option>
													<option value="326">Maharashtra, PUNE</option>
													<option value="514">Maharashtra, PUNE UIVERSITY</option>
													<option value="327">Maharashtra, RASHTRASANT TUKADOJI MAHARAJ NAGPUR</option>
													<option value="328">Maharashtra, SANT GADGE BABA AMRAVATI</option>
													<option value="329">Maharashtra, SHIVAJI</option>
													<option value="331">Maharashtra, SNDT WOMEN'S</option>
													<option value="330">Maharashtra, SOLAPUR</option>
													<option value="332">Maharashtra, SWAMI RAMANAND TEERTH MARATHWADA</option>
													<option value="333">Maharashtra, SYMBIOSIS INTERNATIONAL EDUCATION CENTRE</option>
													<option value="336">Maharashtra, TILAK MAHARASHTRA VIDYAPEETH</option>
													<option value="334">Maharashtra, Tata Institute of Fundamental Research</option>
													<option value="521">Maharashtra, Tata Institute of Social Sciences</option>
													<option value="337">Maharashtra, VISVESVARAYA NATIONAL INSTITUTE OF TECHNOLOGY, NAGPUR</option>
													<option value="338">Maharashtra, YASHWANTRAO CHAVAN MAHARASHTRA OPEN</option>
													<option value="339">Maharashtra, ANY OTHER</option>
													<option value="340">Manipur, CENTRAL AGRICULTURAL (IMPHAL)</option>
													<option value="341">Manipur, MANIPUR</option>
													<option value="342">Manipur, ANY OTHER</option>
													<option value="343">Meghalaya, NORTH EASTERN HILL (SHILLONG)</option>
													<option value="344">Meghalaya, ANY OTHER</option>
													<option value="345">Mizoram, MIZORAM (AIZWAL)</option>
													<option value="346">Mizoram, ANY OTHER</option>
													<option value="347">Nagaland, NAGALAND (KOHIMA)</option>
													<option value="348">Nagaland, ANY OTHER</option>
													<option value="349">Orissa, BERHAMPUR</option>
													<option value="350">Orissa, BIJU PATNAIK UNIVERSITY OF TECHNOLOGY</option>
													<option value="351">Orissa, FAKIR MOHAN</option>
													<option value="524">Orissa, INSTITUTE OF TECHNICAL EDUCATION AND RESEARCH</option>
													<option value="352">Orissa, KALINGA INSITUTE OF INDUSTRIAL TECHNOLOGY</option>
													<option value="353">Orissa, NATIONAL INSTITUTE OF TECHNOLOGY, ROURKELA</option>
													<option value="354">Orissa, NORTH ORISSA</option>
													<option value="355">Orissa, ORISSA UNIVERSITY OF AGRICULTURE AND TECHNOLOGY</option>
													<option value="356">Orissa, RAVENSHAW</option>
													<option value="357">Orissa, SAMBALPUR</option>
													<option value="358">Orissa, SHRI JAGANNATH SANSKRIT</option>
													<option value="359">Orissa, UTKAL</option>
													<option value="360">Orissa, UTKAL UNIVERSITY OF CULTURE</option>
													<option value="361">Orissa, ANY OTHER</option>
													<option value="362">Puducherry, PONDICHERRY</option>
													<option value="363">Puducherry, ANY OTHER</option>
													<option value="364">Punjab, BABA FARID UNIVERSITY OF HEALTH SCIENCES</option>
													<option value="365">Punjab, DR. B.R. AMBEDKAR NATIONAL INSTITUTE OF TECHNOLOGY, JALANDHAR</option>
													<option value="366">Punjab, GURU ANGAD DEV VETERINARY & ANIMAL SCIENCES</option>
													<option value="367">Punjab, GURU NANAK DEV</option>
													<option value="368">Punjab, LOVELY PROFESSIONAL</option>
													<option value="369">Punjab, NATIONAL INSTITUTE OF PHARMACEUTICAL EDUCATION AND RESEARCH</option>
													<option value="372">Punjab, PUNJAB</option>
													<option value="370">Punjab, PUNJAB AGRICULTURAL</option>
													<option value="371">Punjab, PUNJAB TECHNICAL</option>
													<option value="373">Punjab, THAPAR INSTITUTE OF ENGINEERING AND TECHNOLOGY</option>
													<option value="374">Punjab, ANY OTHER</option>
													<option value="375">Rajasthan, BANASTHALI VIDHYAPITH</option>
													<option value="376">Rajasthan, BIKANER</option>
													<option value="377">Rajasthan, BITS PILANI</option>
													<option value="378">Rajasthan, INSTITUTE OF ADVANCED STUDIES IN EDUCATION</option>
													<option value="379">Rajasthan, JAI NARAIN VYAS</option>
													<option value="380">Rajasthan, JAIN VISHWA BARATHI INST</option>
													<option value="381">Rajasthan, JANARDAN RAI NAGAR RAJASTHAN VIDYAPEETH</option>
													<option value="382">Rajasthan, KOTA</option>
													<option value="383">Rajasthan, KOTA OPEN</option>
													<option value="384">Rajasthan, LNM INSTITUTE OF INFORMATION TECHNOLOGY</option>
													<option value="385">Rajasthan, MAHARANA PRATAP UNIVERSITY OF AGRICULTURE & TECHNOLOGY</option>
													<option value="386">Rajasthan, MAHARSHI DAYANAND SARASWATI</option>
													<option value="387">Rajasthan, MALVIYA NATIONAL INSTITUTE OF TECHNOLOGY, JAIPUR</option>
													<option value="388">Rajasthan, MODY INSTITUTE OF TECHNOLOGY AND SCIENCE</option>
													<option value="389">Rajasthan, MOHANLAL SUKHADIA</option>
													<option value="390">Rajasthan, NATIONAL LAW UNIVERSITY</option>
													<option value="391">Rajasthan, RAJASTHAN</option>
													<option value="392">Rajasthan, RAJASTHAN AGRICULTURAL</option>
													<option value="393">Rajasthan, RAJASTHAN AYURVEDA</option>
													<option value="394">Rajasthan, RAJASTHAN SANSKRIT</option>
													<option value="395">Rajasthan, RAJASTHAN TECHNICAL</option>
													<option value="396">Rajasthan, ANY OTHER</option>
													<option value="397">Sikkim, SIKKIM-MANIPAL UNIVERSITY OF HEALTH, MEDICAL & TECHNOLOGICAL SCIENCES</option>
													<option value="398">Sikkim, ANY OTHER</option>
													<option value="399">Tamil Nadu, ALAGAPPA</option>
													<option value="400">Tamil Nadu, AMRITA VISHWA VIDYAPEETHAM</option>
													<option value="401">Tamil Nadu, ANNA</option>
													<option value="402">Tamil Nadu, ANNAMALAI</option>
													<option value="403">Tamil Nadu, ARULMIGU KALASALINGAM COLLEGE OF ENGINEERING</option>
													<option value="404">Tamil Nadu, AVINASHILINGAM INSTITUTE FOR HOME SCIENCE & HIGHER EDUCATION FOR WOMEN</option>
													<option value="405">Tamil Nadu, BHARAT INSTITUTE OF HIGHER EDUCATION & RESEARCH</option>
													<option value="406">Tamil Nadu, BHARATHIAR</option>
													<option value="407">Tamil Nadu, BHARATHIDASAN</option>
													<option value="408">Tamil Nadu, CHENNAI MATHEMATICAL INSTITUTE</option>
													<option value="409">Tamil Nadu, DAKSHIN BHARATHI HINDI PRACHAR SABHA</option>
													<option value="410">Tamil Nadu, GANDHIGRAM RURAL INSTITUTE</option>
													<option value="411">Tamil Nadu, INDIAN INSTITUTE OF TECHNOLOGY MADRAS</option>
													<option value="412">Tamil Nadu, KARUNYA</option>
													<option value="413">Tamil Nadu, M.G.R. EDUCATIONAL AND RESEARCH INSTITUTE</option>
													<option value="414">Tamil Nadu, MADRAS</option>
													<option value="415">Tamil Nadu, MADURAI KAMARAJ</option>
													<option value="416">Tamil Nadu, MANONMANIAM SUNDARANAR</option>
													<option value="418">Tamil Nadu, MOTHER TERESA WOMEN'S</option>
													<option value="417">Tamil Nadu, Meenakshi Academy of Higher Education and Research</option>
													<option value="419">Tamil Nadu, NATIONAL INSTITUTE OF TECHNOLOGY, TIRUCHIRAPALLI</option>
													<option value="420">Tamil Nadu, PERIYAR</option>
													<option value="426">Tamil Nadu, S.R.M. INSTITUTE OF SCIENCE & TECHNOLOGY</option>
													<option value="421">Tamil Nadu, SATHYABAMA INSTITUTE OF SCIENCE AND TECHNOLOGY</option>
													<option value="422">Tamil Nadu, SAVEETHA INSTITUTE OF MEDICAL AND TECHNICAL SCIENCES</option>
													<option value="423">Tamil Nadu, SHANMUGHA ARTS, SCIENCE, TECHNOLOGY & RESEARCH ACADEMY</option>
													<option value="424">Tamil Nadu, SRI CHANDRASEKHARENDRA SARASWATHI VISWA MAHAVIDYALAYA</option>
													<option value="425">Tamil Nadu, SRI RAMACHANDRA MEDICAL COLLEGE AND RESEARCH INSTITUTE</option>
													<option value="430">Tamil Nadu, TAMIL</option>
													<option value="427">Tamil Nadu, TAMIL NADU AGRICULTURAL</option>
													<option value="428">Tamil Nadu, TAMIL NADU DR. M G R MEDICAL</option>
													<option value="429">Tamil Nadu, TAMIL NADU OPEN</option>
													<option value="431">Tamil Nadu, TAMILNADU VETERINARY AND ANIMAL SCIENCES</option>
													<option value="432">Tamil Nadu, THE TAMILNADU DR. AMBEDKAR LAW</option>
													<option value="433">Tamil Nadu, THIRUVALLUVAR</option>
													<option value="434">Tamil Nadu, VELLORE INSTITUTE OF TECHNOLOGY</option>
													<option value="435">Tamil Nadu, VINAYAKA MISSION'S RESEARCH FOUNDATION</option>
													<option value="436">Tamil Nadu, ANY OTHER</option>
													<option value="437">Tripura, THE INSTITUTE OF CHARTERED FINANCIAL ANALYSTS OF INDIA</option>
													<option value="438">Tripura, TRIPURA</option>
													<option value="439">Tripura, ANY OTHER</option>
													<option value="441">Uttar Pradesh, ALIGARH MUSLIM</option>
													<option value="440">Uttar Pradesh, ALLAHABAD</option>
													<option value="442">Uttar Pradesh, ALLAHABAD AGRICULTURAL INSTITUTE</option>
													<option value="443">Uttar Pradesh, BABASAHEB BHIMRAO AMBEDKAR (LUCKNOW)</option>
													<option value="444">Uttar Pradesh, BANARAS HINDU</option>
													<option value="445">Uttar Pradesh, BHATKHANDE MUSIC INST</option>
													<option value="446">Uttar Pradesh, BUNDELKHAND, JHANSI</option>
													<option value="447">Uttar Pradesh, CENTRAL INSTITUTE OF HIGHER TIBETAN STUDIES</option>
													<option value="448">Uttar Pradesh, CH. CHARAN SINGH</option>
													<option value="449">Uttar Pradesh, CHANDRA SHEKHAR AZAD UNIVERSITY OF AGRICULTURE & TECHNOLOGY</option>
													<option value="450">Uttar Pradesh, CHHATRAPATI SHAHU JI MAHARAJ</option>
													<option value="451">Uttar Pradesh, DAYALBAGH EDUCATIONAL INSTITUTE</option>
													<option value="452">Uttar Pradesh, DEENDAYAL UPADHYAYA GORAKHPUR</option>
													<option value="453">Uttar Pradesh, DR. BHIM RAO AMBEDKAR (AGRA)</option>
													<option value="455">Uttar Pradesh, DR. RAM MAHOHAR LOHIA NATIONAL LAW</option>
													<option value="454">Uttar Pradesh, DR. RAM MANOHAR LOHIA AVADH</option>
													<option value="456">Uttar Pradesh, INDIAN INSTITUTE OF INFORMATION TECHNOLOGY</option>
													<option value="457">Uttar Pradesh, INDIAN INSTITUTE OF TECHNOLOGY KANPUR</option>
													<option value="458">Uttar Pradesh, INDIAN VETERINARY RESEARCH INSTITUTE</option>
													<option value="459">Uttar Pradesh, INTEGRAL UNIVERSITY</option>
													<option value="460">Uttar Pradesh, JAGADGURU RAMBHADRACHARYA HANDICAPPED</option>
													<option value="461">Uttar Pradesh, JAYPEE INSTITUTE OF INFORMATION TECHNOLOGY</option>
													<option value="462">Uttar Pradesh, KING GEORGE'S MEDICAL</option>
													<option value="463">Uttar Pradesh, LUCKNOW</option>
													<option value="464">Uttar Pradesh, M.J.P. ROHILKHAND</option>
													<option value="465">Uttar Pradesh, MAHATMA GANDHI KASHI VIDYAPEETH</option>
													<option value="466">Uttar Pradesh, MOTILAL NEHRU NATIONAL INSTITUTE OF TECHNOLOGY, ALLAHABAD</option>
													<option value="467">Uttar Pradesh, NARENDRA DEV UNIVERSITY OF AGRICULTURE & TECHNOLOGY</option>
													<option value="468">Uttar Pradesh, SAMPURNANAND SANSKRIT</option>
													<option value="469">Uttar Pradesh, SANJAY GANDHI NATIONAL INSTIT</option>
													<option value="470">Uttar Pradesh, SARDAR VALLABH BHAI PATEL UNIVERSITY OF AGRICULTURE & TECHNOLOGY</option>
													<option value="471">Uttar Pradesh, SHOBHIT INSTITUTE OF ENGINEERING & TECHNOLOGY</option>
													<option value="472">Uttar Pradesh, U.P. King George's University of Dental Sciences</option>
													<option value="473">Uttar Pradesh, U.P. RAJARSHI TANDON OPEN</option>
													<option value="474">Uttar Pradesh, UTTAR PRADESH TECHNICAL</option>
													<option value="475">Uttar Pradesh, V B S PURVANCHAL</option>
													<option value="476">Uttar Pradesh, ANY OTHER</option>
													<option value="477">Uttaranchal, DEV SANSKRITI</option>
													<option value="478">Uttaranchal, Forest Research Institute, Dehradun</option>
													<option value="479">Uttaranchal, GOVIND BALLABH PANT UNIVERSITY OF AGRICULTURE & TECHNOLOGY</option>
													<option value="480">Uttaranchal, GURUKULA KANGRI</option>
													<option value="481">Uttaranchal, HEMWATI NANDAN BAHUGUNA GARHWAL</option>
													<option value="482">Uttaranchal, INDIAN INSTITUTE OF TECHNOLOGY ROORKEE</option>
													<option value="483">Uttaranchal, KUMAUN</option>
													<option value="484">Uttaranchal, THE INSTITUTE OF CHARTERED FINANCIAL ANALYSTS OF INDIA</option>
													<option value="485">Uttaranchal, UNIVERSITY OF PETROLEUM AND ENERGY STUDIES</option>
													<option value="486">Uttaranchal, UTTARANCHAL SANSKRIT</option>
													<option value="487">Uttaranchal, ANY OTHER</option>
													<option value="488">West Bengal, BIDHAN CHANDRA KRISHI</option>
													<option value="489">West Bengal, BURDWAN</option>
													<option value="490">West Bengal, CALCUTTA</option>
													<option value="491">West Bengal, INDIAN INSTITUTE OF TECHNOLOGY KHARAGPUR</option>
													<option value="492">West Bengal, INDIAN STATISTICAL INSTITUTE</option>
													<option value="493">West Bengal, JADAVPUR</option>
													<option value="494">West Bengal, KALYANI</option>
													<option value="495">West Bengal, NATIONAL INSTITUTE OF TECHNOLOGY, DURGAPUR</option>
													<option value="496">West Bengal, NETAJI SUBHASH OPEN</option>
													<option value="497">West Bengal, NORTH BENGAL</option>
													<option value="498">West Bengal, RABINDRA BHARATI</option>
													<option value="499">West Bengal, RAMAKRSHINA MISSION VIVEKANADA EDUCATION AND RESEARCH INST</option>
													<option value="500">West Bengal, THE BENGAL ENGINEERING & SCIENCE UNIVERSITY</option>
													<option value="501">West Bengal, THE WEST BENGAL UNIVERSITY OF HEALTH SCIENCES</option>
													<option value="502">West Bengal, UTTAR BANGA KRISHI</option>
													<option value="503">West Bengal, VIDYASAGAR</option>
													<option value="504">West Bengal, VISVA BHARTI, SANTINIKETAN</option>
													<option value="505">West Bengal, WEST BENGAL NATIONAL UNIVERSITY OF JURIDICAL SCIENCES</option>
													<option value="506">West Bengal, WEST BENGAL UNIVERSITY OF ANIMAL & FISHERY SCIENCES</option>
													<option value="507">West Bengal, WEST BENGAL UNIVERSITY OF TECHNOLOGY</option>
													<option value="508">West Bengal, ANY OTHER</option>
													<option value="523">Any Other, NAGPUR</option>
													<option value="335">Any Other, Tata Institute of Social Sciences</option>
													<option value="100">Any Other, Any Other</option>
												</select>
											</label>
								        </div>
								    </div>
							        <div class="column-four">
										<div class="input-group-right" id="graduationuniversityothers-div">
											<label for="graduationuniversityothers" class="group label-input">
				                                <input type="text" id="graduationuniversityothers" name="graduationuniversityothers" class="input-right" placeholder="If Any other, please specify">
											</label>
									    </div>
									</div>
									<div class="column-four">
										<div class="input-group-right irequire">
										    <label for="graduatindegreename" class="group label-input">
				                                <input type="text" id="graduatindegreename" name="graduatindegreename" class="input-right" placeholder="Degree name">
											</label>
									    </div>
									</div>
									<div class="column-four">
										<div class="select-group irequire">
											<label for="graduationdiscipline" class="group custom-select">
												<select id="graduationdiscipline" name="graduationdiscipline" class="select">
												    <option value="">Select Discipline</option>
													<option value="02">Agricultural Engineering</option>
													<option value="01">Agriculture</option>
													<option value="03">Animal Husbandry</option>
													<option value="04">Architecture</option>
													<option value="05">Arts/Humanities</option>
													<option value="07">Chartered Accountancy</option>
													<option value="06">Commerce/Economics/ Banking/Finance/ Secretarial Practices</option>
													<option value="09">Company Secretaryship</option>
													<option value="10">Computer Science/Computer Application/Information Technology</option>
													<option value="08">Cost And Works Accountancy</option>
													<option value="11">Dairy Science/Technology</option>
													<option value="12">Education (Including Physical Education And Sports)</option>
													<option value="13">Engineering/Technology</option>
													<option value="14">Fisheries</option>
													<option value="16">Food Technology</option>
													<option value="15">Forestry</option>
													<option value="17">Horticulture</option>
													<option value="18">Hotel & Tourism Management</option>
													<option value="19">Law</option>
													<option value="24">Life Science: Biology, Biochemistry, Bio-Technology, Botany, Life Science, Zoology</option>
													<option value="20">Management (Business Administration/Business Management/Business Studies/Management Studies)</option>
													<option value="21">Medicine/Dentistry</option>
													<option value="22">Pharmacology/Pharmacy</option>
													<option value="25">PhysicalScience: Chemistry, Mathematics, Physics, Statistics, Electronics</option>
													<option value="23">Rural Studies/Rural Sociology/Rural Cooperatives/Rural Banking</option>
													<option value="26">Science (others): Home Science, Nursing &all other branches of Science not explicitly mentioned elsewhere in this List</option>
													<option value="27">Veterinary Science</option>
													<option value="28">Any other</option>
												</select>
											</label>
								        </div>
									</div>
									<div class="column-four">
										<div class="input-group-right" id="graduationdisciplineother-div">
											<label for="graduationdisciplineother" class="group label-input">
				                                <input type="text" id="graduationdisciplineother" name="graduationdisciplineother" class="input-right" placeholder="If Any other, please specify">
											</label>
									    </div>
									</div>
									<div class="column-four">
										<div class="input-group-right">
											<label for="graduationspecialization" class="group label-input">
				                                <input type="text" id="graduationspecialization" name="graduationspecialization" class="input-right" placeholder="Specialization">
											</label>
									    </div>
									</div>
									<div class="column-four">
										<div class="select-group irequire">
											<label for="graduationdegreemode" class="group custom-select">
												<select id="graduationdegreemode" name="graduationdegreemode" class="select">
												    <option value="">Graduation degree mode</option>
													<option value="Full Time">Full Time</option>
													<option value="Part Time">Part Time</option>
													<option value="Diploma">Diploma</option>
												</select>
											</label>
								        </div>
									</div>
									<div class="column-four">
										<div class="select-group irequire">
											<label for="graduationcompleted" class="group custom-select">
												<select id="graduationcompleted" name="graduationcompleted" class="select">
												    <option value="">Degree completed</option>
													<option value="Yes">Yes</option>
													<option value="No">No</option>
												</select>
											</label>
								        </div>
									</div>
									<div class="column-four">
										<div class="select-group" id="gradationcompletionyear-div">
											<label for="gradationcompletionyear" class="group custom-select">
												<?php
													$current_year = date("Y");
													$range = range(1950, $current_year+1);
													echo '<select id="gradationcompletionyear" name="gradationcompletionyear" class="select" >';
													echo '<option value="">Year of completion</option>';
													 
													foreach($range as $r)
													{
													echo '<option value="'.$r.'">'.$r.'</option>';
													}
													 
													echo '</select>';
												?>
											</label>
								        </div>
									</div>
									<div class="column-eight hiddencontainer">
										<div class="input-group-right">
											<label for="hiddencontainer" class="group label-input">
				                                <input type="text" id="hiddencontainer" name="hiddencontainer" class="input-right" placeholder="">
											</label>
									    </div>
									</div>
									<div class="column-four" style="text-align:left">
										<h3>Grading System?</h3>
									</div>
									<div class="column-four">
										<div class="input-group-right">
											<div class="radio-group irequire">
												<label for="percentage" class="group space-right">
													<input type="radio" name="graduationgpaorpercentage" class="radio" value="Percentage" id="percentage">
													<span class="label space-right">Percentage</span>
												</label>
												<label for="gpa" class="group space-right">
													<input type="radio" name="graduationgpaorpercentage" class="radio" value="GPA" id="gpa">
													<span class="label space-right">CGPA</span>
												</label>
											</div>
									    </div>
									</div>
									<div class="column-four">
										<div class="input-group-right">
											<label for="aggregatenote" class="group label-input">
				                                Final aggregate % should be calculated as the average of percentages obtained in all years of the bachelors. For students in their final year, please mention the average of percentage obtained in all years prior to the final year.
											</label>
									    </div>
									</div>
									<div class="box-section center" style="padding-top: 0px;">
										<div id="graduationpercentage-div">
											<div class="column-four">
												<div class="select-group irequire">
													<label for="graduationclass" class="group custom-select">
														<select id="graduationclass" name="graduationclass" class="select">
														    <option value="">Select Class</option>
															<option value="Disctinction">Disctinction</option>
															<option value="First Class">First Class</option>
															<option value="Second Class">Second Class</option>
															<option value="Pass Class">Pass Class</option>
														</select>
													</label>
										        </div>
											</div>
											<div class="column-four">
												<div class="input-group-right irequire">
												    <label for="graduationpercentage" class="group label-input">
						                                <input type="text" id="graduationpercentage" name="graduationpercentage" class="input-right" placeholder="Final aggregate %">
													</label>
											    </div>
											</div>
											<div class="column-four hiddencontainer">
												<div class="input-group-right">
													<label for="hiddencontainer" class="group label-input">
						                                <input type="text" id="hiddencontainer" name="hiddencontainer" class="input-right" placeholder="">
													</label>
											    </div>
											</div>
										</div>
										<div id="graduationgpa-div">
											<div class="column-four">
												<div class="input-group-right irequire">
												    <label for="graduationgpaobtained" class="group label-input">
						                                <input type="text" id="graduationgpaobtained" name="graduationgpaobtained" class="input-right" placeholder="Final CGPA obtained">
													</label>
											    </div>
											</div>
											<div class="column-four">
												<div class="input-group-right irequire">
													<label for="graduationgpamax" class="group label-input">
						                                <input type="text" id="graduationgpamax" name="graduationgpamax" class="input-right" placeholder="Max GPA possible">
													</label>
											    </div>
											</div>
											<div class="column-four hiddencontainer">
												<div class="input-group-right">
													<label for="hiddencontainer" class="group label-input">
						                                <input type="text" id="hiddencontainer" name="hiddencontainer" class="input-right" placeholder="">
													</label>
											    </div>
											</div>
										</div>
									</div>
									<div class="column-four">
										<button type="button" id="add-extra-academic" class="button button-large button-orange">Add another academic qualification</button>
									</div>
									<div class="column-four">
										<button type="button" id="add-extra-academic-delete" class="button button-large button-red">Remove</button>
									</div>
									<div class="column-eight hiddencontainer">
										<div class="input-group-right">
											<label for="hiddencontainer" class="group label-input">
				                                <input type="text" id="hiddencontainer" name="hiddencontainer" class="input-right" placeholder="">
											</label>
									    </div>
									</div>
								</div>
								<!-- Bakliwal -->
								<div class="box-section center toclone" style="display: none;">
									<div class="column-four">
									    <div class="select-group">
											<label for="academicextradegreelevel" class="group custom-select">
												<select id="academicextradegreelevel" name="academicextradegreelevel" class="select">
												    <option value="">Select Degree Level</option>
													<option value="Bachelors Degree">Bachelors Degree</option>
													<option value="Masters Degree">Masters Degree</option>
													<option value="Professional degree">Professional degree (CA, CS, CFA, ICWA)</option>
													<option value="Doctoral degree">Doctoral degree</option>
													<option value="Integrated degree">Integrated degree</option>
													<option value="Other degree">Other degree</option>
												</select>
											</label>
								        </div>
									</div>
									<div class="column-four">
										<div class="input-group-right">
											<label for="academicextradegreeother" class="group label-input">
				                                <input type="text" id="academicextradegreeother" name="academicextradegreeother" class="input-right" placeholder="If Others, please specify" title="If Others, please specify">
											</label>
									    </div>
									</div>
									<div class="column-four hiddencontainer">
										<div class="input-group-right">
											<label for="hiddencontainerextra" class="group label-input">
				                                <input type="text" id="hiddencontainerextra" name="hiddencontainerextra" class="input-right" placeholder="" title="">
											</label>
									    </div>
									</div>
									<div class="column-four">
										<div class="input-group-right">
										    <label for="gradutationcollegenameextra" class="group label-input">
				                                <input type="text" id="gradutationcollegenameextra" name="gradutationcollegenameextra" class="input-right" placeholder="Name of college" title="Name of college">
											</label>
									    </div>
									</div>
									<div class="column-four">
										<div class="select-group">
											<label for="gradutationunversityextra" class="group custom-select">
												<select id="gradutationunversityextra" name="gradutationunversityextra" class="select">
													<option value="">Select University Name</option>
												    <option value="099">International</option>
													<option value="101">Andhra Pradesh, ACHARYA N.G. RANGA AGRICULTURAL</option>
													<option value="102">Andhra Pradesh, ACHARYA NAGARJUNA</option>
													<option value="104">Andhra Pradesh, ANDHRA</option>
													<option value="103">Andhra Pradesh, ANDHRA PRADESH UNIVERSITY OF HEALTH SCIENCES</option>
													<option value="105">Andhra Pradesh, CENTRAL INSTITUTE OF ENGLISH &amp; FOREIGN LANGUAGES</option>
													<option value="106">Andhra Pradesh, DR. B.R. AMBEDKAR OPEN (HYDERABAD)</option>
													<option value="107">Andhra Pradesh, DRAVIDIAN</option>
													<option value="108">Andhra Pradesh, HYDERABAD</option>
													<option value="109">Andhra Pradesh, INTERNATIONAL INSTITUTE OF INFORMATION TECHNOLOGY</option>
													<option value="110">Andhra Pradesh, J.N.T.U.</option>
													<option value="111">Andhra Pradesh, KAKATIYA</option>
													<option value="112">Andhra Pradesh, MAULANA AZAD NATIONAL URDU</option>
													<option value="113">Andhra Pradesh, NAGARJUNA</option>
													<option value="114">Andhra Pradesh, NATIONAL ACADEMY OF LEGAL STUDIES AND RESEARCH</option>
													<option value="115">Andhra Pradesh, NATIONAL INSTITUTE OF TECHNOLOGY, WARANGAL</option>
													<option value="116">Andhra Pradesh, NIZAMS INSTITUTE OF MEDICAL SCIENCES</option>
													<option value="117">Andhra Pradesh, OSMANIA</option>
													<option value="118">Andhra Pradesh, POTTI SREERAMULU TELUGU</option>
													<option value="119">Andhra Pradesh, RASHTRIYA SANSKRIT VIDYAPEETHA</option>
													<option value="120">Andhra Pradesh, SRI KRISHNADEVARAYA</option>
													<option value="121">Andhra Pradesh, SRI PADMAVATHI MAHILA</option>
													<option value="122">Andhra Pradesh, SRI SATHYA SAI INSTITUTE OF HIGHER LEARNING</option>
													<option value="123">Andhra Pradesh, SRI VENKATESWARA</option>
													<option value="124">Andhra Pradesh, SRI VENKATESWARA INSTITUTE OF MEDICAL SCIENCES</option>
													<option value="125">Andhra Pradesh, ANY OTHER</option>
													<option value="126">Arunachal Pradesh, ARUNACHAL</option>
													<option value="128">Arunachal Pradesh, NORTH EASTERN REGIONAL INSTITUTE OF SCIENCE AND TECHNOLOGY</option>
													<option value="127">Arunachal Pradesh, RAJIV GANDHI</option>
													<option value="129">Arunachal Pradesh, ANY OTHER</option>
													<option value="131">Assam, ASSAM</option>
													<option value="130">Assam, ASSAM AGRICULTURAL</option>
													<option value="132">Assam, DIBRUGARH</option>
													<option value="133">Assam, GAUHATI</option>
													<option value="134">Assam, INDIAN INSTITUTE OF TECHNOLOGY GUWAHATI</option>
													<option value="135">Assam, NATIONAL INSTITUTE OF TECHNOLOGY, SILCHAR</option>
													<option value="136">Assam, TEZPUR</option>
													<option value="137">Assam, ANY OTHER</option>
													<option value="138">Bihar, BABASAHEB BHIMRAO AMBEDKAR BIHAR (MUZAFFARPUR)</option>
													<option value="139">Bihar, BHUPENDRA NARAYAN MANDAL</option>
													<option value="140">Bihar, BIHAR YOGA BHARATI</option>
													<option value="141">Bihar, CHANAKYA NATIONAL LAW</option>
													<option value="142">Bihar, INDIRA GANDHI INSTITUTE OF MEDICAL SCIENCES</option>
													<option value="143">Bihar, JAI PRAKASH</option>
													<option value="144">Bihar, KAMESHWHAR</option>
													<option value="515">Bihar, Kameshwar Singh Darbhanga Sanskrit</option>
													<option value="145">Bihar, LALIT NARAYAN MITHILA</option>
													<option value="146">Bihar, MAGADH</option>
													<option value="147">Bihar, MAULANA NAZARUL HAQ</option>
													<option value="516">Bihar, Maulana Mazharul Haque Arabic &amp; Persian</option>
													<option value="148">Bihar, NALANDA OPEN</option>
													<option value="149">Bihar, PATNA</option>
													<option value="150">Bihar, RAJENDRA AGRICULTURAL (SAMASTIPUR)</option>
													<option value="151">Bihar, TILKA MANJHI BHAGALPUR</option>
													<option value="152">Bihar, VEER KUNWAR SINGH</option>
													<option value="153">Bihar, ANY OTHER</option>
													<option value="154">Chandigarh, PANJAB (CHANDIGARH)</option>
													<option value="155">Chandigarh, POSTGRADUATE INSTITUTE OF MEDICAL EDUCATION AND RESEARCH</option>
													<option value="156">Chandigarh, PUNJAB ENGINEERING COLLEGE</option>
													<option value="157">Chandigarh, ANY OTHER</option>
													<option value="158">Chhattisgarh, Chhattisgarh Swami Vivekanand Technical University</option>
													<option value="159">Chhattisgarh, GURU GHASIDAS</option>
													<option value="160">Chhattisgarh, HIDAYATULLAH NATIONAL LAW UNIVERSITY</option>
													<option value="161">Chhattisgarh, INDIRA GANDHI KRISHI VISHWAVIDYALAYA</option>
													<option value="162">Chhattisgarh, Indira Kala Sangeet</option>
													<option value="163">Chhattisgarh, KUSHABHAU THACKERY</option>
													<option value="164">Chhattisgarh, PANDIT RAVISHANKAR SHUKLA</option>
													<option value="165">Chhattisgarh, PANDIT SUNDARLAL SHARMA</option>
													<option value="166">Chhattisgarh, ANY OTHER</option>
													<option value="167">Delhi, ALL INDIA INSTITUTE OF MEDICAL SCIENCES</option>
													<option value="168">Delhi, DELHI</option>
													<option value="169">Delhi, GURU GOVIND SINGH INDRAPRASTHA</option>
													<option value="170">Delhi, INDIAN AGRICULTURAL RESEARCH INSTITUTE</option>
													<option value="171">Delhi, INDIAN INSTITUTE OF FOREIGN TRADE</option>
													<option value="172">Delhi, INDIAN INSTITUTE OF TECHNOLOGY DELHI</option>
													<option value="173">Delhi, INDIAN LAW INSTITUTE</option>
													<option value="174">Delhi, INDIRA GANDHI NATIONAL OPEN</option>
													<option value="175">Delhi, JAMIA HAMDARD</option>
													<option value="176">Delhi, JAMIA MILLIA ISLAMIA</option>
													<option value="177">Delhi, JAWAHARLAL NEHRU</option>
													<option value="179">Delhi, NATIONAL MUSUEM INSTITUTE</option>
													<option value="178">Delhi, NATIONAL SCHOOL OF DRAMA</option>
													<option value="180">Delhi, NATIONAL UNIVERSITY OF EDUCATIONAL PLANNING &amp; ADMINISTRATION</option>
													<option value="181">Delhi, RASHTRIYA SANSKRIT SANSTHANA</option>
													<option value="182">Delhi, SCHOOL OF PLANNING AND ARCHITECTURE</option>
													<option value="183">Delhi, SRI LAL BAHADUR SHASTRI</option>
													<option value="517">Delhi, Shri Lal Bahadur Shastri Rashtriya Sanskrit Vidyapeeth</option>
													<option value="184">Delhi, TERI SCHOOL OF ADVANCED STUDIES</option>
													<option value="525">Delhi, THE INSTITUTION OF CIVIL ENGINEERS</option>
													<option value="185">Delhi, ANY OTHER</option>
													<option value="186">Goa, GOA</option>
													<option value="187">Goa, ANY OTHER</option>
													<option value="188">Gujarat, BHAVNAGAR</option>
													<option value="189">Gujarat, CENTRE FOR ENVIRONMENTAL PLANNING &amp; TECHNOLOGY</option>
													<option value="190">Gujarat, DHARMSINH DESAI</option>
													<option value="191">Gujarat, DHIRUBHAI AMBANI INSTITUTE OF INFORMATION &amp; COMMUNICATION TECHNOLOGY</option>
													<option value="192">Gujarat, DR. BABASAHEB AMBEDKAR OPEN (AHMEDABAD)</option>
													<option value="193">Gujarat, GANPAT</option>
													<option value="196">Gujarat, GUJARAT</option>
													<option value="194">Gujarat, GUJARAT AGRICULTURAL</option>
													<option value="195">Gujarat, GUJARAT AYURVED</option>
													<option value="197">Gujarat, GUJARAT NATIONAL LAW</option>
													<option value="198">Gujarat, GUJARAT VIDYAPEETH</option>
													<option value="199">Gujarat, HEMCHANDRACHARYA NORTH GUJARAT</option>
													<option value="200">Gujarat, KRANTIGURU SHYAMJI KRISHNAVERMA KACHCH</option>
													<option value="201">Gujarat, MS UNIVERSITY OF BARODA</option>
													<option value="202">Gujarat, NIRMA UNIVERSITY OF SCIENCE &amp; TECHNOLOGY</option>
													<option value="203">Gujarat, SARDAR PATEL</option>
													<option value="204">Gujarat, SARDAR VALLABHBHAI NATIONAL INSTITUTE OF TECHNOLOGY, SURAT</option>
													<option value="205">Gujarat, SAURASHTRA</option>
													<option value="206">Gujarat, SHREE SOMNATH SANSKRIT</option>
													<option value="207">Gujarat, SUMANDEEP VIDYAPEETH</option>
													<option value="208">Gujarat, VEER NARMAD SOUTH GUJARAT</option>
													<option value="209">Gujarat, ANY OTHER</option>
													<option value="210">Haryana, CHAUDHARY CHARAN SINGH HARYANA AGRICULTURAL</option>
													<option value="211">Haryana, CHAUDHARY DEVI LAL, SIRSA</option>
													<option value="212">Haryana, GURU JAMBESHWAR</option>
													<option value="213">Haryana, KURUKSHETRA</option>
													<option value="214">Haryana, MAHARSHI DAYANAND</option>
													<option value="215">Haryana, NATIONAL BRAIN RESEARCH CENTRE, GURGAON</option>
													<option value="216">Haryana, NATIONAL DAIRY RESEARCH INSTITUTE, KARNAL</option>
													<option value="217">Haryana, NATIONAL INSTITUTE OF TECHNOLOGY, KURUKSHETRA</option>
													<option value="218">Haryana, ANY OTHER</option>
													<option value="219">Himachal Pradesh, CHAUDHARY SARWAN KUMAR HIMACHAL PRADESH KRISHI</option>
													<option value="220">Himachal Pradesh, DR. Y.S. PARMAR UNIVERSITY OF HORTICULTURE &amp; FORESTRY, NAUNI</option>
													<option value="221">Himachal Pradesh, HIMACHAL PRADESH</option>
													<option value="222">Himachal Pradesh, JAYPEE UNIVERSITY OF INFORMATION TECHNOLOGY, SOLAN</option>
													<option value="223">Himachal Pradesh, NATIONAL INSTITUTE OF TECHNOLOGY, HAMIRPUR</option>
													<option value="224">Himachal Pradesh, ANY OTHER</option>
													<option value="225">Jammu &amp; Kashmir, BABA GHULAM SHAH BADSHAH</option>
													<option value="226">Jammu &amp; Kashmir, JAMMU</option>
													<option value="227">Jammu &amp; Kashmir, KASHMIR</option>
													<option value="228">Jammu &amp; Kashmir, NATIONAL INSTITUTE OF TECHNOLOGY, SRINAGAR</option>
													<option value="230">Jammu &amp; Kashmir, SHER-E-KASHMIR UNIVERSITY OF AGRICULTURAL SCIENCES &amp; TECHNOLOGY</option>
													<option value="229">Jammu &amp; Kashmir, SHER-E-KASHMIR UNIVERSITY OF MEDICAL SCIENCES</option>
													<option value="231">Jammu &amp; Kashmir, SHRI MATA VAISHNO DEVI</option>
													<option value="232">Jammu &amp; Kashmir, ANY OTHER</option>
													<option value="234">Jharkhand, BIRSA AGRICULTURAL</option>
													<option value="520">Jharkhand, BIT Ranchi</option>
													<option value="235">Jharkhand, INDIAN SCHOOL OF MINES</option>
													<option value="236">Jharkhand, NATIONAL INSTITUTE OF TECHNOLOGY, JAMSHEDPUR</option>
													<option value="237">Jharkhand, RANCHI</option>
													<option value="238">Jharkhand, SIDO-KANHU MURMU</option>
													<option value="239">Jharkhand, VINOBA BHAVE</option>
													<option value="240">Jharkhand, ANY OTHER</option>
													<option value="241">Karnataka, BANGALORE</option>
													<option value="242">Karnataka, GULBARGA</option>
													<option value="243">Karnataka, INDIAN INSTITUTE OF SCIENCE</option>
													<option value="244">Karnataka, INTERNATIONAL INSTITUTE OF INFORMATION TECHNOLOGY</option>
													<option value="245">Karnataka, JAWAHARLAL NEHRU CENTRE FOR ADVANCED SCIENTIFIC RESEARCH</option>
													<option value="246">Karnataka, KANNADA</option>
													<option value="250">Karnataka, KARNATAKA</option>
													<option value="247">Karnataka, KARNATAKA STATE OPEN</option>
													<option value="248">Karnataka, KARNATAKA STATE WOMEN, BIJAPUR</option>
													<option value="249">Karnataka, KARNATAKA VETERINARY ANIMAL &amp; FISHERIES SCIENCES</option>
													<option value="252">Karnataka, KLE ACADEMY OF HIGHER EDUCATION &amp; RESEARCH</option>
													<option value="251">Karnataka, KUVEMPU</option>
													<option value="253">Karnataka, MANGALORE</option>
													<option value="254">Karnataka, MANIPAL ACADEMY OF HIGHER EDUCATION</option>
													<option value="255">Karnataka, MYSORE</option>
													<option value="257">Karnataka, NATIONAL INSTITUTE OF TECHNOLOGY, SURATHKAL</option>
													<option value="258">Karnataka, NATIONAL LAW SCHOOL OF INDIA UNIVERSITY</option>
													<option value="256">Karnataka, NIMHANS</option>
													<option value="259">Karnataka, RAJIV GANDHI UNIVERSITY OF HEALTH SCIENCES</option>
													<option value="260">Karnataka, SWAMI VIVEKANANDA YOGA</option>
													<option value="518">Karnataka, Swami Vivekananda Yog Anusandhana Samsthana</option>
													<option value="261">Karnataka, TUMKUR</option>
													<option value="262">Karnataka, UNIVERSITY OF AGRICULTURAL SCIENCES (BANGALORE)</option>
													<option value="263">Karnataka, UNIVERSITY OF AGRICULTURAL SCIENCES (DHARWAD)</option>
													<option value="264">Karnataka, VISVESWARAIAH TECHNOLOGICAL UNIVERSITY</option>
													<option value="265">Karnataka, ANY OTHER</option>
													<option value="266">Kerala, CALICUT</option>
													<option value="267">Kerala, COCHIN UNIVERSITY OF SCIENCE &amp; TECHNOLOGY</option>
													<option value="268">Kerala, KANNUR</option>
													<option value="269">Kerala, KERALA</option>
													<option value="270">Kerala, KERALA AGRICULTURAL</option>
													<option value="271">Kerala, KERALA KALAMANDALAM</option>
													<option value="272">Kerala, MAHATMA GANDHI (KOTTAYAM)</option>
													<option value="273">Kerala, NATIONAL INSTITUTE OF TECHNOLOGY, CALICUT</option>
													<option value="275">Kerala, SREE SANKARACHARYA UNIVERSITY OF SANSKRIT</option>
													<option value="274">Kerala, Sree Chitra Tirunal Institute for Medical Sciences and Technology</option>
													<option value="276">Kerala, ANY OTHER</option>
													<option value="277">Madhya Pradesh, AWADHESH PRATAP SINGH</option>
													<option value="278">Madhya Pradesh, BARKATULLAH</option>
													<option value="279">Madhya Pradesh, DEVI AHILYA</option>
													<option value="280">Madhya Pradesh, DR. HARISINGH GOUR</option>
													<option value="281">Madhya Pradesh, INDIAN INSTITUTE OF INFORMATION TECHNOLOGY AND MANAGEMENT</option>
													<option value="282">Madhya Pradesh, JAWAHARLAL NEHRU KRISHI (JABALPUR)</option>
													<option value="283">Madhya Pradesh, JIWAJI</option>
													<option value="284">Madhya Pradesh, LAKSHMI BAI NATIONAL INST OF PHYSICAL EDUCATION</option>
													<option value="285">Madhya Pradesh, MADHYA PRADESH BHOJ (OPEN)</option>
													<option value="286">Madhya Pradesh, MAHARISHI MAHESH YOGI VEDIC</option>
													<option value="287">Madhya Pradesh, MAHATMA GANDHI CHITRAKOOT GRAMODAY</option>
													<option value="288">Madhya Pradesh, MAKHANLAL CHATURVEDI RASHTRIYA PATRAKARITA</option>
													<option value="289">Madhya Pradesh, MAULANA AZAD NATIONAL INSTITUTE OF TECHNOLOGY, BHOPAL</option>
													<option value="290">Madhya Pradesh, NATIONAL LAW INSTITUTE</option>
													<option value="519">Madhya Pradesh, Punjab Technical</option>
													<option value="291">Madhya Pradesh, RAJIV GANDHI PROUDYOGIKI</option>
													<option value="292">Madhya Pradesh, RANI DURGAVATI</option>
													<option value="293">Madhya Pradesh, VIKRAM (UJJAIN)</option>
													<option value="294">Madhya Pradesh, ANY OTHER</option>
													<option value="295">Maharashtra, AMRAVATI</option>
													<option value="296">Maharashtra, BHARATI VIDYAPEETH</option>
													<option value="233">Maharashtra, BIT RANCHI</option>
													<option value="297">Maharashtra, Central Institute of Fisheries Education</option>
													<option value="304">Maharashtra, DATTA MEGHE INSTITUTE OF MEDICAL SCIENCES</option>
													<option value="299">Maharashtra, DEFENCE INSTITUTE OF ADVANCED TECHNOLOGY</option>
													<option value="300">Maharashtra, DR. BABASAHEB AMBEDKAR MARATHWADA (AURANGABAD)</option>
													<option value="301">Maharashtra, DR. BABASAHEB AMBEDKAR TECHNOLOGICAL</option>
													<option value="302">Maharashtra, DR. D.Y. PATIL EDUCATION SOCIETY</option>
													<option value="303">Maharashtra, DR. D.Y. PATIL VIDYAPEETH</option>
													<option value="305">Maharashtra, DR. PANJABRAO DESHMUKH KRISHI VIDYAPEETH</option>
													<option value="298">Maharashtra, Deccan College Post Graduate and Research Institute</option>
													<option value="306">Maharashtra, GOKHALE INSTITUTE OF POLITICS &amp; ECONOMICS</option>
													<option value="307">Maharashtra, Homi Bhabha National Institute</option>
													<option value="308">Maharashtra, INDIAN INSTITUTE OF TECHNOLOGY BOMBAY</option>
													<option value="309">Maharashtra, INDIRA GANDHI INSTITUTE OF DEVELOPMENT RESEARCH</option>
													<option value="310">Maharashtra, INSTITUTE OF ARMAMENT TECH</option>
													<option value="311">Maharashtra, INTERNATIONAL INSTITUTE OF POPULATION SCIENCES</option>
													<option value="312">Maharashtra, KAVIKULGURU KALIDAS SANSKRIT</option>
													<option value="313">Maharashtra, KONKAN KRISHI VIDYAPEETH</option>
													<option value="314">Maharashtra, KRISHNA INST OF MEDICAL SCIENCES</option>
													<option value="315">Maharashtra, MAHARASHTRA ANIMAL &amp; FISHERY SCIENCES</option>
													<option value="316">Maharashtra, MAHARASHTRA UNIVERSITY OF HEALTH SCIENCES</option>
													<option value="318">Maharashtra, MAHATMA PHULE KRISHI VIDYAPEETH</option>
													<option value="319">Maharashtra, MARATHWADA AGRICULTURAL</option>
													<option value="513">Maharashtra, MUMBAI UNIVERSITY</option>
													<option value="317">Maharashtra, Mahatma Gandhi Antarrashtriya Hindi</option>
													<option value="321">Maharashtra, NAGPUR</option>
													<option value="322">Maharashtra, NARSEE MONJEE INSTITUTE OF MANAGEMENT STUDIES</option>
													<option value="323">Maharashtra, NORTH MAHARASHTRA</option>
													<option value="324">Maharashtra, PADMASHREE DR. D.Y. PATIL VIDYAPEETH (MUMBAI)</option>
													<option value="325">Maharashtra, PRAVARA INSTITUTE OF MEDICAL SCIENCES</option>
													<option value="326">Maharashtra, PUNE</option>
													<option value="514">Maharashtra, PUNE UIVERSITY</option>
													<option value="327">Maharashtra, RASHTRASANT TUKADOJI MAHARAJ NAGPUR</option>
													<option value="328">Maharashtra, SANT GADGE BABA AMRAVATI</option>
													<option value="329">Maharashtra, SHIVAJI</option>
													<option value="331">Maharashtra, SNDT WOMEN'S</option>
													<option value="330">Maharashtra, SOLAPUR</option>
													<option value="332">Maharashtra, SWAMI RAMANAND TEERTH MARATHWADA</option>
													<option value="333">Maharashtra, SYMBIOSIS INTERNATIONAL EDUCATION CENTRE</option>
													<option value="336">Maharashtra, TILAK MAHARASHTRA VIDYAPEETH</option>
													<option value="334">Maharashtra, Tata Institute of Fundamental Research</option>
													<option value="521">Maharashtra, Tata Institute of Social Sciences</option>
													<option value="337">Maharashtra, VISVESVARAYA NATIONAL INSTITUTE OF TECHNOLOGY, NAGPUR</option>
													<option value="338">Maharashtra, YASHWANTRAO CHAVAN MAHARASHTRA OPEN</option>
													<option value="339">Maharashtra, ANY OTHER</option>
													<option value="340">Manipur, CENTRAL AGRICULTURAL (IMPHAL)</option>
													<option value="341">Manipur, MANIPUR</option>
													<option value="342">Manipur, ANY OTHER</option>
													<option value="343">Meghalaya, NORTH EASTERN HILL (SHILLONG)</option>
													<option value="344">Meghalaya, ANY OTHER</option>
													<option value="345">Mizoram, MIZORAM (AIZWAL)</option>
													<option value="346">Mizoram, ANY OTHER</option>
													<option value="347">Nagaland, NAGALAND (KOHIMA)</option>
													<option value="348">Nagaland, ANY OTHER</option>
													<option value="349">Orissa, BERHAMPUR</option>
													<option value="350">Orissa, BIJU PATNAIK UNIVERSITY OF TECHNOLOGY</option>
													<option value="351">Orissa, FAKIR MOHAN</option>
													<option value="524">Orissa, INSTITUTE OF TECHNICAL EDUCATION AND RESEARCH</option>
													<option value="352">Orissa, KALINGA INSITUTE OF INDUSTRIAL TECHNOLOGY</option>
													<option value="353">Orissa, NATIONAL INSTITUTE OF TECHNOLOGY, ROURKELA</option>
													<option value="354">Orissa, NORTH ORISSA</option>
													<option value="355">Orissa, ORISSA UNIVERSITY OF AGRICULTURE AND TECHNOLOGY</option>
													<option value="356">Orissa, RAVENSHAW</option>
													<option value="357">Orissa, SAMBALPUR</option>
													<option value="358">Orissa, SHRI JAGANNATH SANSKRIT</option>
													<option value="359">Orissa, UTKAL</option>
													<option value="360">Orissa, UTKAL UNIVERSITY OF CULTURE</option>
													<option value="361">Orissa, ANY OTHER</option>
													<option value="362">Puducherry, PONDICHERRY</option>
													<option value="363">Puducherry, ANY OTHER</option>
													<option value="364">Punjab, BABA FARID UNIVERSITY OF HEALTH SCIENCES</option>
													<option value="365">Punjab, DR. B.R. AMBEDKAR NATIONAL INSTITUTE OF TECHNOLOGY, JALANDHAR</option>
													<option value="366">Punjab, GURU ANGAD DEV VETERINARY &amp; ANIMAL SCIENCES</option>
													<option value="367">Punjab, GURU NANAK DEV</option>
													<option value="368">Punjab, LOVELY PROFESSIONAL</option>
													<option value="369">Punjab, NATIONAL INSTITUTE OF PHARMACEUTICAL EDUCATION AND RESEARCH</option>
													<option value="372">Punjab, PUNJAB</option>
													<option value="370">Punjab, PUNJAB AGRICULTURAL</option>
													<option value="371">Punjab, PUNJAB TECHNICAL</option>
													<option value="373">Punjab, THAPAR INSTITUTE OF ENGINEERING AND TECHNOLOGY</option>
													<option value="374">Punjab, ANY OTHER</option>
													<option value="375">Rajasthan, BANASTHALI VIDHYAPITH</option>
													<option value="376">Rajasthan, BIKANER</option>
													<option value="377">Rajasthan, BITS PILANI</option>
													<option value="378">Rajasthan, INSTITUTE OF ADVANCED STUDIES IN EDUCATION</option>
													<option value="379">Rajasthan, JAI NARAIN VYAS</option>
													<option value="380">Rajasthan, JAIN VISHWA BARATHI INST</option>
													<option value="381">Rajasthan, JANARDAN RAI NAGAR RAJASTHAN VIDYAPEETH</option>
													<option value="382">Rajasthan, KOTA</option>
													<option value="383">Rajasthan, KOTA OPEN</option>
													<option value="384">Rajasthan, LNM INSTITUTE OF INFORMATION TECHNOLOGY</option>
													<option value="385">Rajasthan, MAHARANA PRATAP UNIVERSITY OF AGRICULTURE &amp; TECHNOLOGY</option>
													<option value="386">Rajasthan, MAHARSHI DAYANAND SARASWATI</option>
													<option value="387">Rajasthan, MALVIYA NATIONAL INSTITUTE OF TECHNOLOGY, JAIPUR</option>
													<option value="388">Rajasthan, MODY INSTITUTE OF TECHNOLOGY AND SCIENCE</option>
													<option value="389">Rajasthan, MOHANLAL SUKHADIA</option>
													<option value="390">Rajasthan, NATIONAL LAW UNIVERSITY</option>
													<option value="391">Rajasthan, RAJASTHAN</option>
													<option value="392">Rajasthan, RAJASTHAN AGRICULTURAL</option>
													<option value="393">Rajasthan, RAJASTHAN AYURVEDA</option>
													<option value="394">Rajasthan, RAJASTHAN SANSKRIT</option>
													<option value="395">Rajasthan, RAJASTHAN TECHNICAL</option>
													<option value="396">Rajasthan, ANY OTHER</option>
													<option value="397">Sikkim, SIKKIM-MANIPAL UNIVERSITY OF HEALTH, MEDICAL &amp; TECHNOLOGICAL SCIENCES</option>
													<option value="398">Sikkim, ANY OTHER</option>
													<option value="399">Tamil Nadu, ALAGAPPA</option>
													<option value="400">Tamil Nadu, AMRITA VISHWA VIDYAPEETHAM</option>
													<option value="401">Tamil Nadu, ANNA</option>
													<option value="402">Tamil Nadu, ANNAMALAI</option>
													<option value="403">Tamil Nadu, ARULMIGU KALASALINGAM COLLEGE OF ENGINEERING</option>
													<option value="404">Tamil Nadu, AVINASHILINGAM INSTITUTE FOR HOME SCIENCE &amp; HIGHER EDUCATION FOR WOMEN</option>
													<option value="405">Tamil Nadu, BHARAT INSTITUTE OF HIGHER EDUCATION &amp; RESEARCH</option>
													<option value="406">Tamil Nadu, BHARATHIAR</option>
													<option value="407">Tamil Nadu, BHARATHIDASAN</option>
													<option value="408">Tamil Nadu, CHENNAI MATHEMATICAL INSTITUTE</option>
													<option value="409">Tamil Nadu, DAKSHIN BHARATHI HINDI PRACHAR SABHA</option>
													<option value="410">Tamil Nadu, GANDHIGRAM RURAL INSTITUTE</option>
													<option value="411">Tamil Nadu, INDIAN INSTITUTE OF TECHNOLOGY MADRAS</option>
													<option value="412">Tamil Nadu, KARUNYA</option>
													<option value="413">Tamil Nadu, M.G.R. EDUCATIONAL AND RESEARCH INSTITUTE</option>
													<option value="414">Tamil Nadu, MADRAS</option>
													<option value="415">Tamil Nadu, MADURAI KAMARAJ</option>
													<option value="416">Tamil Nadu, MANONMANIAM SUNDARANAR</option>
													<option value="418">Tamil Nadu, MOTHER TERESA WOMEN'S</option>
													<option value="417">Tamil Nadu, Meenakshi Academy of Higher Education and Research</option>
													<option value="419">Tamil Nadu, NATIONAL INSTITUTE OF TECHNOLOGY, TIRUCHIRAPALLI</option>
													<option value="420">Tamil Nadu, PERIYAR</option>
													<option value="426">Tamil Nadu, S.R.M. INSTITUTE OF SCIENCE &amp; TECHNOLOGY</option>
													<option value="421">Tamil Nadu, SATHYABAMA INSTITUTE OF SCIENCE AND TECHNOLOGY</option>
													<option value="422">Tamil Nadu, SAVEETHA INSTITUTE OF MEDICAL AND TECHNICAL SCIENCES</option>
													<option value="423">Tamil Nadu, SHANMUGHA ARTS, SCIENCE, TECHNOLOGY &amp; RESEARCH ACADEMY</option>
													<option value="424">Tamil Nadu, SRI CHANDRASEKHARENDRA SARASWATHI VISWA MAHAVIDYALAYA</option>
													<option value="425">Tamil Nadu, SRI RAMACHANDRA MEDICAL COLLEGE AND RESEARCH INSTITUTE</option>
													<option value="430">Tamil Nadu, TAMIL</option>
													<option value="427">Tamil Nadu, TAMIL NADU AGRICULTURAL</option>
													<option value="428">Tamil Nadu, TAMIL NADU DR. M G R MEDICAL</option>
													<option value="429">Tamil Nadu, TAMIL NADU OPEN</option>
													<option value="431">Tamil Nadu, TAMILNADU VETERINARY AND ANIMAL SCIENCES</option>
													<option value="432">Tamil Nadu, THE TAMILNADU DR. AMBEDKAR LAW</option>
													<option value="433">Tamil Nadu, THIRUVALLUVAR</option>
													<option value="434">Tamil Nadu, VELLORE INSTITUTE OF TECHNOLOGY</option>
													<option value="435">Tamil Nadu, VINAYAKA MISSION'S RESEARCH FOUNDATION</option>
													<option value="436">Tamil Nadu, ANY OTHER</option>
													<option value="437">Tripura, THE INSTITUTE OF CHARTERED FINANCIAL ANALYSTS OF INDIA</option>
													<option value="438">Tripura, TRIPURA</option>
													<option value="439">Tripura, ANY OTHER</option>
													<option value="441">Uttar Pradesh, ALIGARH MUSLIM</option>
													<option value="440">Uttar Pradesh, ALLAHABAD</option>
													<option value="442">Uttar Pradesh, ALLAHABAD AGRICULTURAL INSTITUTE</option>
													<option value="443">Uttar Pradesh, BABASAHEB BHIMRAO AMBEDKAR (LUCKNOW)</option>
													<option value="444">Uttar Pradesh, BANARAS HINDU</option>
													<option value="445">Uttar Pradesh, BHATKHANDE MUSIC INST</option>
													<option value="446">Uttar Pradesh, BUNDELKHAND, JHANSI</option>
													<option value="447">Uttar Pradesh, CENTRAL INSTITUTE OF HIGHER TIBETAN STUDIES</option>
													<option value="448">Uttar Pradesh, CH. CHARAN SINGH</option>
													<option value="449">Uttar Pradesh, CHANDRA SHEKHAR AZAD UNIVERSITY OF AGRICULTURE &amp; TECHNOLOGY</option>
													<option value="450">Uttar Pradesh, CHHATRAPATI SHAHU JI MAHARAJ</option>
													<option value="451">Uttar Pradesh, DAYALBAGH EDUCATIONAL INSTITUTE</option>
													<option value="452">Uttar Pradesh, DEENDAYAL UPADHYAYA GORAKHPUR</option>
													<option value="453">Uttar Pradesh, DR. BHIM RAO AMBEDKAR (AGRA)</option>
													<option value="455">Uttar Pradesh, DR. RAM MAHOHAR LOHIA NATIONAL LAW</option>
													<option value="454">Uttar Pradesh, DR. RAM MANOHAR LOHIA AVADH</option>
													<option value="456">Uttar Pradesh, INDIAN INSTITUTE OF INFORMATION TECHNOLOGY</option>
													<option value="457">Uttar Pradesh, INDIAN INSTITUTE OF TECHNOLOGY KANPUR</option>
													<option value="458">Uttar Pradesh, INDIAN VETERINARY RESEARCH INSTITUTE</option>
													<option value="459">Uttar Pradesh, INTEGRAL UNIVERSITY</option>
													<option value="460">Uttar Pradesh, JAGADGURU RAMBHADRACHARYA HANDICAPPED</option>
													<option value="461">Uttar Pradesh, JAYPEE INSTITUTE OF INFORMATION TECHNOLOGY</option>
													<option value="462">Uttar Pradesh, KING GEORGE'S MEDICAL</option>
													<option value="463">Uttar Pradesh, LUCKNOW</option>
													<option value="464">Uttar Pradesh, M.J.P. ROHILKHAND</option>
													<option value="465">Uttar Pradesh, MAHATMA GANDHI KASHI VIDYAPEETH</option>
													<option value="466">Uttar Pradesh, MOTILAL NEHRU NATIONAL INSTITUTE OF TECHNOLOGY, ALLAHABAD</option>
													<option value="467">Uttar Pradesh, NARENDRA DEV UNIVERSITY OF AGRICULTURE &amp; TECHNOLOGY</option>
													<option value="468">Uttar Pradesh, SAMPURNANAND SANSKRIT</option>
													<option value="469">Uttar Pradesh, SANJAY GANDHI NATIONAL INSTIT</option>
													<option value="470">Uttar Pradesh, SARDAR VALLABH BHAI PATEL UNIVERSITY OF AGRICULTURE &amp; TECHNOLOGY</option>
													<option value="471">Uttar Pradesh, SHOBHIT INSTITUTE OF ENGINEERING &amp; TECHNOLOGY</option>
													<option value="472">Uttar Pradesh, U.P. King George's University of Dental Sciences</option>
													<option value="473">Uttar Pradesh, U.P. RAJARSHI TANDON OPEN</option>
													<option value="474">Uttar Pradesh, UTTAR PRADESH TECHNICAL</option>
													<option value="475">Uttar Pradesh, V B S PURVANCHAL</option>
													<option value="476">Uttar Pradesh, ANY OTHER</option>
													<option value="477">Uttaranchal, DEV SANSKRITI</option>
													<option value="478">Uttaranchal, Forest Research Institute, Dehradun</option>
													<option value="479">Uttaranchal, GOVIND BALLABH PANT UNIVERSITY OF AGRICULTURE &amp; TECHNOLOGY</option>
													<option value="480">Uttaranchal, GURUKULA KANGRI</option>
													<option value="481">Uttaranchal, HEMWATI NANDAN BAHUGUNA GARHWAL</option>
													<option value="482">Uttaranchal, INDIAN INSTITUTE OF TECHNOLOGY ROORKEE</option>
													<option value="483">Uttaranchal, KUMAUN</option>
													<option value="484">Uttaranchal, THE INSTITUTE OF CHARTERED FINANCIAL ANALYSTS OF INDIA</option>
													<option value="485">Uttaranchal, UNIVERSITY OF PETROLEUM AND ENERGY STUDIES</option>
													<option value="486">Uttaranchal, UTTARANCHAL SANSKRIT</option>
													<option value="487">Uttaranchal, ANY OTHER</option>
													<option value="488">West Bengal, BIDHAN CHANDRA KRISHI</option>
													<option value="489">West Bengal, BURDWAN</option>
													<option value="490">West Bengal, CALCUTTA</option>
													<option value="491">West Bengal, INDIAN INSTITUTE OF TECHNOLOGY KHARAGPUR</option>
													<option value="492">West Bengal, INDIAN STATISTICAL INSTITUTE</option>
													<option value="493">West Bengal, JADAVPUR</option>
													<option value="494">West Bengal, KALYANI</option>
													<option value="495">West Bengal, NATIONAL INSTITUTE OF TECHNOLOGY, DURGAPUR</option>
													<option value="496">West Bengal, NETAJI SUBHASH OPEN</option>
													<option value="497">West Bengal, NORTH BENGAL</option>
													<option value="498">West Bengal, RABINDRA BHARATI</option>
													<option value="499">West Bengal, RAMAKRSHINA MISSION VIVEKANADA EDUCATION AND RESEARCH INST</option>
													<option value="500">West Bengal, THE BENGAL ENGINEERING &amp; SCIENCE UNIVERSITY</option>
													<option value="501">West Bengal, THE WEST BENGAL UNIVERSITY OF HEALTH SCIENCES</option>
													<option value="502">West Bengal, UTTAR BANGA KRISHI</option>
													<option value="503">West Bengal, VIDYASAGAR</option>
													<option value="504">West Bengal, VISVA BHARTI, SANTINIKETAN</option>
													<option value="505">West Bengal, WEST BENGAL NATIONAL UNIVERSITY OF JURIDICAL SCIENCES</option>
													<option value="506">West Bengal, WEST BENGAL UNIVERSITY OF ANIMAL &amp; FISHERY SCIENCES</option>
													<option value="507">West Bengal, WEST BENGAL UNIVERSITY OF TECHNOLOGY</option>
													<option value="508">West Bengal, ANY OTHER</option>
													<option value="523">Any Other, NAGPUR</option>
													<option value="335">Any Other, Tata Institute of Social Sciences</option>
													<option value="100">Any Other, Any Other</option>
												</select>
											</label>
								        </div>
								    </div>
							        <div class="column-four">
										<div class="input-group-right" id="graduationuniversityothers-divextra">
											<label for="graduationuniversityothersextra" class="group label-input">
				                                <input type="text" id="graduationuniversityothersextra" name="graduationuniversityothersextra" class="input-right" placeholder="If Any other, please specify" title="If Any other, please specify">
											</label>
									    </div>
									</div>
									<div class="column-four">
										<div class="input-group-right">
										    <label for="graduatindegreenameextra" class="group label-input">
				                                <input type="text" id="graduatindegreenameextra" name="graduatindegreenameextra" class="input-right" placeholder="Degree name" title="Degree name">
											</label>
									    </div>
									</div>
									<div class="column-four">
										<div class="select-group">
											<label for="graduationdisciplineextra" class="group custom-select">
												<select id="graduationdisciplineextra" name="graduationdisciplineextra" class="select">
												    <option value="">Select Discipline</option>
													<option value="02">Agricultural Engineering</option>
													<option value="01">Agriculture</option>
													<option value="03">Animal Husbandry</option>
													<option value="04">Architecture</option>
													<option value="05">Arts/Humanities</option>
													<option value="07">Chartered Accountancy</option>
													<option value="06">Commerce/Economics/ Banking/Finance/ Secretarial Practices</option>
													<option value="09">Company Secretaryship</option>
													<option value="10">Computer Science/Computer Application/Information Technology</option>
													<option value="08">Cost And Works Accountancy</option>
													<option value="11">Dairy Science/Technology</option>
													<option value="12">Education (Including Physical Education And Sports)</option>
													<option value="13">Engineering/Technology</option>
													<option value="14">Fisheries</option>
													<option value="16">Food Technology</option>
													<option value="15">Forestry</option>
													<option value="17">Horticulture</option>
													<option value="18">Hotel &amp; Tourism Management</option>
													<option value="19">Law</option>
													<option value="24">Life Science: Biology, Biochemistry, Bio-Technology, Botany, Life Science, Zoology</option>
													<option value="20">Management (Business Administration/Business Management/Business Studies/Management Studies)</option>
													<option value="21">Medicine/Dentistry</option>
													<option value="22">Pharmacology/Pharmacy</option>
													<option value="25">PhysicalScience: Chemistry, Mathematics, Physics, Statistics, Electronics</option>
													<option value="23">Rural Studies/Rural Sociology/Rural Cooperatives/Rural Banking</option>
													<option value="26">Science (others): Home Science, Nursing &amp;all other branches of Science not explicitly mentioned elsewhere in this List</option>
													<option value="27">Veterinary Science</option>
													<option value="28">Any other</option>
												</select>
											</label>
								        </div>
									</div>
									<div class="column-four">
										<div class="input-group-right" id="graduationdisciplineother-divextra">
											<label for="graduationdisciplineotherextra" class="group label-input">
				                                <input type="text" id="graduationdisciplineotherextra" name="graduationdisciplineotherextra" class="input-right" placeholder="If Any other, please specify" title="If Any other, please specify">
											</label>
									    </div>
									</div>
									<div class="column-four">
										<div class="input-group-right">
											<label for="graduationspecializationextra" class="group label-input">
				                                <input type="text" id="graduationspecializationextra" name="graduationspecializationextra" class="input-right" placeholder="Specialization" title="Specialization">
											</label>
									    </div>
									</div>
									<div class="column-four">
										<div class="select-group">
											<label for="graduationdegreemodeextra" class="group custom-select">
												<select id="graduationdegreemodeextra" name="graduationdegreemodeextra" class="select">
												    <option value="">Graduation degree mode</option>
													<option value="Full Time">Full Time</option>
													<option value="Part Time">Part Time</option>
													<option value="Diploma">Diploma</option>
												</select>
											</label>
								        </div>
									</div>
									<div class="column-four">
										<div class="select-group">
											<label for="graduationcompletedextra" class="group custom-select">
												<select id="graduationcompletedextra" name="graduationcompletedextra" class="select">
												    <option value="">Degree completed</option>
													<option value="Yes">Yes</option>
													<option value="No">No</option>
												</select>
											</label>
								        </div>
									</div>
									<div class="column-four">
										<div class="select-group" id="gradationcompletionyear-divextra">
											<label for="gradationcompletionyearextra" class="group custom-select">
												<?php
													$current_year = date("Y");
													$range = range(1950, $current_year+1);
													echo '<select id="gradationcompletionyearextra" name="gradationcompletionyearextra" class="select" >';
													echo '<option value="">Year of completion</option>';
													 
													foreach($range as $r)
													{
													echo '<option value="'.$r.'">'.$r.'</option>';
													}
													 
													echo '</select>';
												?>
											</label>
								        </div>
									</div>
									<div class="column-eight hiddencontainer">
										<div class="input-group-right">
											<label for="hiddencontainerextra" class="group label-input">
				                                <input type="text" id="hiddencontainerextra" name="hiddencontainerextra" class="input-right" placeholder="" title="">
											</label>
									    </div>
									</div>
									<div class="column-four" style="text-align:left">
										<h3>Grading System?</h3>
									</div>
									<div class="column-four">
										<div class="input-group-right">
											<div class="radio-group">
												<label for="percentageextra" class="group space-right">
													<input type="radio" name="graduationgpaorpercentageextra" class="radio" value="Percentage" id="percentageextra">
													<span class="label space-right">Percentage</span>
												</label>
												<label for="gpaextra" class="group space-right">
													<input type="radio" name="graduationgpaorpercentageextra" class="radio" value="GPA" id="gpaextra">
													<span class="label space-right">CGPA</span>
												</label>
											</div>
									    </div>
									</div>
									<div class="column-four">
										<div class="input-group-right">
											<label for="aggregatenote" class="group label-input">
				                                Final aggregate % should be calculated as the average of percentages obtained in all years of the bachelors. For students in their final year, please mention the average of percentage obtained in all years prior to the final year.
											</label>
									    </div>
									</div>
									<div class="box-section center" style="padding-top: 0px;">
										<div id="graduationpercentage-divextra">
											<div class="column-four">
												<div class="select-group">
													<label for="graduationclassextra" class="group custom-select">
														<select id="graduationclassextra" name="graduationclassextra" class="select">
														    <option value="">Select Class</option>
															<option value="Disctinction">Disctinction</option>
															<option value="First Class">First Class</option>
															<option value="Second Class">Second Class</option>
															<option value="Pass Class">Pass Class</option>
														</select>
													</label>
										        </div>
											</div>
											<div class="column-four">
												<div class="input-group-right">
												    <label for="graduationpercentageextra" class="group label-input">
						                                <input type="text" id="graduationpercentageextra" name="graduationpercentageextra" class="input-right" placeholder="Final aggregate %" title="Final aggregate %">
													</label>
											    </div>
											</div>
											<div class="column-four hiddencontainer">
												<div class="input-group-right">
													<label for="hiddencontainerextra" class="group label-input">
						                                <input type="text" id="hiddencontainerextra" name="hiddencontainerextra" class="input-right" placeholder="" title="">
													</label>
											    </div>
											</div>
										</div>
										<div id="graduationgpa-divextra">
											<div class="column-four">
												<div class="input-group-right">
												    <label for="graduationgpaobtainedextra" class="group label-input">
						                                <input type="text" id="graduationgpaobtainedextra" name="graduationgpaobtainedextra" class="input-right" placeholder="Final CGPA obtained" title="Final CGPA obtained">
													</label>
											    </div>
											</div>
											<div class="column-four">
												<div class="input-group-right">
													<label for="graduationgpamaxextra" class="group label-input">
						                                <input type="text" id="graduationgpamaxextra" name="graduationgpamaxextra" class="input-right" placeholder="Max GPA possible" title="Max GPA possible">
													</label>
											    </div>
											</div>
											<div class="column-four hiddencontainer">
												<div class="input-group-right">
													<label for="hiddencontainerextra" class="group label-input">
						                                <input type="text" id="hiddencontainerextra" name="hiddencontainerextra" class="input-right" placeholder="" title="">
													</label>
											    </div>
											</div>
										</div>
									</div>
									<div class="column-four">
										<button type="button" id="add-extra-academicextra" class="button button-large button-orange clone">Add another academic qualification</button>
									</div>
									<div class="column-four">
										<button type="button" id="add-extra-academicextra-delete" class="button button-large button-red delete">Remove</button>
									</div>
									<div class="column-eight hiddencontainer">
										<div class="input-group-right">
											<label for="hiddencontainerextra" class="group label-input">
				                                <input type="hidden" id="extraacademiccount" name="extraacademiccount" class="input-right" placeholder="" title="">
											</label>
									    </div>
									</div>
								</div>
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