<?php
session_start();
require 'dbconnect.php';
if (!isset($_SESSION['isLoggedIn'])) {
    header('Location:page_HOME.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styleSCHEDULEEVENT.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Font Awesome Icon Script -->
    <script src="https://kit.fontawesome.com/678a3c402d.js" crossorigin="anonymous"></script>
    <title>The SJCP - Schedule Event</title>
	<link rel="icon" type="image/png" href="tabicon.png">
</head>

<body>
    <div class="content-wrapper">
         <!-- Login Form -->
        <div class="login-cover" id="login">
            <div class="login-form">
                <i class="fa-solid fa-xmark close-icon" onclick="openLogin()"></i>
                <div class="login-header">
                    Log-In
                </div>
                <div class="error-message">
                    <?php
                    if (!isset($_SESSION['isValidEmail'])) {
                    } else if ($_SESSION['isValidEmail'] == false) {
                        echo '<span class="error-dialogue"> This email address is not connected to an account! Please double-check or register first.</span>';
                    } else if (!isset($_SESSION['isValidPass'])) {
                    } else if ($_SESSION['isValidPass'] == false) {
                        echo '<span class="error-dialogue"> Your password is incorrect! Please try again.</span>';
                    } 
                    ?>
                </div>
                <div class="loginform-wrapper">
                    <form action="validateLOGIN.php" method="post">
                        <span>Email:</span>
                        <div class="form-input">
                            <input type="text" name="user_email" id="" required>
                        </div>
                        <span>Password: </span>
                        <div class="form-input">
                            <input type="password" name="user_pass" id="" required>
                            <i class="fa-solid fa-eye" id="pass-icon"></i>
                        </div>
                        <span><a href="page_FORGOTPASS.php" target="_self" rel="noopener noreferrer">Forgot Password?</a></span>
                        <button type="submit" name="submit">Log-in</button>
                        <span>Don't have an account yet? <a href="page_REGISTER.php" target="_self" rel="noopener noreferrer">Register Now</a></span>
                    </form>
                </div>
            </div>
        </div>
        <!-- Reusable Nav -->
        <nav class="nav-wrapper">
            <div class="navicon-wrapper">
                <div class="icon-container">
                    <i class="fa-solid fa-church"></i> SJCP
                </div>
            </div>
            <div class="nav-content">
                <div class="top-icon" onclick="triggerSideNav()">
                    <i class="fa-solid fa-bars"></i>
                </div>
                <div onclick="window.location.href='page_HOME.php'" class="nav-item">Home</div>
                <div onclick="window.location.href='page_FAQ.php'" class="nav-item">FAQs</div>
                <div class="nav-item dropdown active">
                    <span class="dp-title">Services <i class="fa-solid fa-angle-down"></i></span>
                    <div class="dropdown-content">
                        <div onclick="window.location.href='page_SERVICES.php'" class="nav-item">
                            Services
                        </div>
                        <div class="nav-item active" <?php if (!isset($_SESSION['isLoggedIn']) || $_SESSION['isLoggedIn'] == false) {
                                                    echo 'onclick="openLogin()"';
                                                } else {?>
													onclick="window.location.href='page_SCHEDULEEVENT.php'"
                                               <?php } ?>>
                            Schedule Event
                        </div>
                        <div class="nav-item" <?php if (!isset($_SESSION['isLoggedIn']) || $_SESSION['isLoggedIn'] == false) {
                                                    echo 'onclick="openLogin()"';
                                                } else {?>
													onclick="window.location.href='page_APPOINTMENTS.php'"
                                               <?php } ?>>
                            My Appointment
                        </div>
                        <div onclick="window.location.href='page_SEARCH.php'" class="nav-item" <?php if (!isset($_SESSION['isLoggedIn']) || $_SESSION['isLoggedIn'] == false) {
                                                    echo 'onclick="openLogin()"';
                                                } else {?>
													onclick="window.location.href='page_SEARCH.php'" 
                                               <?php } ?>>
                            Search Records
                        </div>
                    </div>
                </div>
                <div class="nav-item dropdown">
                    <span class="dp-title">Events <i class="fa-solid fa-angle-down"></i></span>
                    <div class="dropdown-content">
                        <div onclick="window.location.href='page_VIEWANNOUNCEMENT.php'" class="nav-item">Announcements</div>
                        <div onclick="window.location.href='page_VIEwSCHEDULES.php'" class="nav-item">Available Time Slots</div>
                    </div>
                </div>
                <div onclick="window.location.href='page_ABOUTUS.php'" class="nav-item">About Us</div>
                <?php
                if (!isset($_SESSION['isLoggedIn']) || $_SESSION['isLoggedIn'] == false) {
                    echo '<div class="nav-item" onclick="openLogin()">Login</div>';
                } else if ($_SESSION['isLoggedIn'] == true) {
                    echo '<div class="nav-item dropdown">' ?>
                    <span class="dp-title">Profile <i class="fa-solid fa-angle-down"></i></span>
                    <div class="dropdown-content">
                        <div onclick="window.location.href='page_PROFILE.php'" class="nav-item active">Profile</div>
                        <div class="nav-item" onclick="openForm(logoutForm)">Log-Out</div>
                    </div>
                <?php '</div>';
                }
                ?>
                <div id="logoutForm">
                    <form action="logoutCall.php" method="post">
                        <div class="popupFormLogout">
                            <div class="header-cont">
                                <div class="icon-box">
                                    <i class="fa-solid fa-right-from-bracket" style="font-size: 4rem; background-color: transparent"></i>
                                </div>
                                <div class="headertext-box">
                                    <h3>Confirm Logout?</h3>
                                    <p>Are you sure you want to log-out?</p>
                                </div>
                            </div>
                            <div class="form-btnarea">
                                <button class="buttonno" type="button" onclick="openForm(logoutForm)">No</button>
                                <button class="buttonyes" type="submit" name="submit" value="delete">Yes</button>
                            </div>
                         </div>
                    </form>
                </div>
            </div>
        </nav>


        <!-- FAQ content -->
        <div class="main-body-wrapper">
			<section class="main-header">
				<h1 class="main-content-title">Schedule Event</h1>
			</section>
            <section class="main-content">
                <!--<div class="main-header">
                    <span><strong>Set Schedules</strong></span>
                </div>-->
                <div class="schedule-container">
                    <div class="events-preference">
				
						<!-- SELECT EVENT AND DATE FORM -->
						<form action="page_SCHEDULEEVENT.php" method="post">
							<div class="select-cont">
								<?php 
									if(!isset($_POST["submit"])){
										?> <div class="events-select-container" id="events-select-container" style="display:flex">
												<label for="ddEvent"><strong> Select to Appoint: </strong></label>
												<select class="dropdown" id="ddEvent" name="ddEvent" onchange="chooseEvent()">
													<option value="default" disabled selected hidden></option>
													<option value="Special Event">Special Event</option>											
													<option value="Mass Intention">Mass Intention</option>
													<option value="Blessing">Blessing</option>
													<option value="Document Request">Document Request</option>
												</select>
											</div> <?php
									} else {
										?> <div class="events-select-container" id="events-select-container" style="display:none">
												<label for="ddEvent"><strong> Select to Appoint: </strong></label>
												<select class="dropdown" id="ddEvent" name="ddEvent" onchange="chooseEvent()">
													<option value="default" disabled selected hidden></option>
													<option value="Special Event">Special Event</option>											
													<option value="Mass Intention">Mass Intention</option>
													<option value="Blessing">Blessing</option>
													<option value="Document Request">Document Request</option>
												</select>
											</div> <?php
									}
									?>
									<div class="events-select-container" id="specificSpecial" style="display: none;">
										<label for="ddSpecialEvent"><strong>Select Special Event:</strong></label>
										<select class="dropdown" id="ddSpecialEvent" name="Event" onchange="openCalendarSpe();">
											<option value="" disabled selected hidden>Special Events</option>
											<option value="Wedding">Private Wedding</option>
											<option value="Baptism">Private Baptism</option>
											<option value="Funeral Mass/Blessing">Funeral Mass/Blessing</option>
										</select>
									</div>
									<div class="events-select-container" id="specificDocument" style="display: none;">
										<label for="ddDocument"><strong>Select Document </strong></label>
										<select class="dropdown" id="ddDocument" name="Event" onchange="openCalendarDoc();">
											<option value="defaultDoc" disabled selected hidden>Documents</option>
											<option value="Baptismal Certificate">Baptismal Certificate</option>
											<option value="Wedding Certificate">Wedding Certificate</option>
											<option value="Confirmation Certificate">Confirmation Certificate</option>
											<option value="Good Moral Certificate">Good Moral Certificate</option>
											<option value="Permit and No Record">Permit and No Record</option>
										</select>
									</div>
									<div class="events-select-container" id="chooseCalWed" style="display: none">
										<div class="cal-container">
											<label for="calDateWed"><strong>Select Date:</strong></label>
											<input type="date" id="calDateWed" name="calDateWed" title="You must schedule your wedding 1-6 months in advance." min="<?= date('Y-m-d', strtotime('+1 month')); ?>" max="<?= date('Y-m-d', strtotime('+6 months')); ?>" required>
										</div>
									</div>
									<div class="events-select-container" id="chooseCalBap" style="display: none">
										<div class="cal-container">
											<label for="calDateBap"><strong>Select Date:</strong></label>
											<input type="date" id="calDateBap" name="calDateBap" title="You must schedule your baptism at least 1 week before the event." min="<?= date('Y-m-d', strtotime('+1 week')); ?>" max="<?= date('Y-m-d', strtotime('+6 months')); ?>" required>
										</div>
									</div>
									<div class="events-select-container" id="chooseCalFuner" style="display: none">
										<div class="cal-container">
											<label for="calDateFuner"><strong>Select Date:</strong></label>
											<input type="date" id="calDateFuner" name="calDateFuner" title="You must schedule the funeral mass or blessing at least three days before the event." min="<?= date('Y-m-d', strtotime('+3 days')); ?>" max="<?= date('Y-m-d', strtotime('+6 weeks')); ?>" required>
										</div>
									</div>
									<div class="events-select-container" id="chooseCalIntBless" style="display: none">
										<div class="cal-container">
											<label for="calDateIntBless"><strong>Select Date:</strong></label>
											<input type="date" id="calDateIntBless" name="calDateIntBless" min="<?= date('Y-m-d', strtotime('+1 day')); ?>" max="<?= date('Y-m-d', strtotime('+6 months')); ?>" required>
										</div>
									</div>
									<div class="events-select-container" id="submitButton" style="display: none">
										<button type="submit" value="submit" name="submit" id="submitbtn"> View Available Time</button>
									</div>
							</div>
						</form>

						<?php
							if(isset($_POST["submit"])){
								?>
								<div class="back-icon-cont" onclick="location.href='page_SCHEDULEEVENT.php'">
									<i class="fa-solid fa-arrow-left"> </i>
									Back
								</div>
								<?php
							}
						?>
                    </div>
                </div>
				<div class="form-container">
					<?php
						if(isset($_POST["submit"])){
							$type = $_POST["ddEvent"];
							if($type == "Special Event") {
								$event = $_POST["Event"];
								if ($event == "Wedding") {
									$date = $_POST["calDateWed"];
								}
								else if ($event == "Baptism") {
									$date = $_POST["calDateBap"];
								}
								else {
									$date = $_POST["calDateFuner"];
								}
							}
							else {
								$date = $_POST["calDateIntBless"];
							}
							$day = date('l', strtotime($date));
							$_SESSION['type'] = $type;
							$_SESSION['date'] = $date;
							//change date format from yyyy-mm-dd to month day, year
							$formated_date = date('F d, Y', strtotime($date));
							if($type != "Mass Intention" && $type != "Blessing"){
								$event = $_POST["Event"];
								$_SESSION['event'] = $event;
								?> 
								
								<div class="Event-grid-cont">
									<div><h1> Event: <?php echo $event?></h1></div>
									<div><h1> Date: <?php echo $formated_date?></h1></div>
								</div>
								<?php	
								// WEDDING FORM
								if($event == "Wedding"){
									
									$weddingst = array("09:00:00", "10:30:00", "14:00:00", "15:30:00");
									$weddinget = array("10:15:00", "11:45:00", "15:15:00", "16:45:00");
									//query for retrieving appointments in the same day
									$query = "SELECT event_timeStart, event_timeEnd FROM appointment_details WHERE appointment_status = 'Accepted' AND event_date = '$date'";
									$result = mysqli_query($conn, $query);
									////////
									$starttime = array();
									$endtime = array();
									$counter = 0;
									while ($row = mysqli_fetch_assoc($result)){
										$starttime[$counter] = $row['event_timeStart'];
										$endtime[$counter] = $row['event_timeEnd'];
										$counter++;
									}
									
									$avtime = $weddingst;
									$count =0;
									$break = false;
									for ($x = 0; $x < count($weddingst); $x++){
										for($y = 0; $y < count($starttime); $y++) {
											if(strtotime($weddingst[$x]) == strtotime($starttime[$y])){
												unset($avtime[$x]);
												break;
											}else if(strtotime($weddingst[$x]) > strtotime($starttime[$y]) && strtotime($weddingst[$x]) < strtotime($endtime[$y])) {
												unset($avtime[$x]);
												break;
											}else if(strtotime($weddinget[$x]) > strtotime($starttime[$y]) && strtotime($weddinget[$x]) < strtotime($endtime[$y])){
												unset($avtime[$x]);
												break;
											} else {
												
											}
										}
									}
									$count_time = 0;?>
									<form action="page_LANDING.php" method="post" enctype="multipart/form-data">
										<div> <strong> Select Available Time:</strong> </div>
										<div class="avtime-container">
											<?php
												$event_endtime = "";
												$_SESSION['eventendtime'] = $event_endtime;
												if(count($avtime) == 0){
													echo "No Available Time";
												} else { ?>
													<div class="rd-cont">
													<?php foreach ($avtime as $i){
														for($y = 0; $y < count($weddingst); $y++){
															if(strtotime($i) == strtotime($weddingst[$y])){
																$event_endtime = $weddinget[$y];
															}
														}
														?><div style="margin-right: 2rem">
															<input type="radio" id="<?php echo 'rtime'.$count_time ?>" name="rdtime" value="<?php echo $i." ".$event_endtime?>" required>
															<label for="<?php echo 'rtime'.$count_time ?>"><?php echo date("h:i A", strtotime($i)) ?></label><br>
														</div>
														<?php
														$count_time++;
													} ?>
													</div>
													<div class="contents-cont">
														<div class="req-cont">
															<br>
															<b> Requirements: </b>
															<div>
																<ul>
																	<li> PSA Birth Certificate </li>
																	<li> 2x2 ID picture</li>		
																	<li> Baptismal Certificate (Original copy)</li>		
																	<li> Confirmation Certificate (Original copy)</li>		
																	<li> CENOMAR (Certificate of No Marriage - photocopy) </li>
																	<li> Publication of Wedding Banns</li>
																	<li> Pre-Cana Seminar </li>		
																	<li> Marriage License or Live-In License (article 34) or Marriage Contract (Civil Marriage) </li>
																	<li> Wedding Interview </li>
																	<li> Confession </li>
																	<li> Long Brown Envelope </li>	
																</ul>
															</div>
															
															<b> Notes: </b>
															<div>
																<ul> The couple must submit and accomplish all the requirements before the date of the event. </ul>
															</div>
															<br>
														</div>
															<div class="form-cont">
																<div class="form-content">
																	<div class="form-title">
																		<h2> Groom's Information </h2>
																	</div>
																	<div>
																		<b>Name</b>
																		<div class="form-grid-cont">
																			<div class="input-box">
																				<label for="groom_lastName"><strong>Last Name* </strong></label>
																				<input type="text" id="groom_lastName" name="groom_lastName" placeholder="Dela Cruz" maxlength="40" pattern="[A-Za-zÀ-ÖØ-öø-ÿ.\s\-]*" required><br>
																			</div>
																			<div class="input-box">
																				<label for="groom_firstName"><strong>First Name* </strong></label>
																				<input type="text" id="groom_firstName" name="groom_firstName" placeholder="Juan" maxlength="40" pattern="[A-Za-zÀ-ÖØ-öø-ÿ.\s\-]*" required><br>
																			</div>
																			<div class="input-box">
																				<label for="groom_middleName"><strong>Middle Name </strong></label>
																				<input type="text" id="groom_middleName" name="groom_middleName" placeholder="Tomas" maxlength="40" pattern="[A-Za-zÀ-ÖØ-öø-ÿ.\s\-]*"><br>
																			</div>
																		</div>
																	</div>
																	<div class="form-grid-cont">
																		<div class="input-box">
																			<label for="groom_contactNum"><strong>Contact Number* </strong></label>
																			<div class="contactnum">
																				<input type="text" name ="mobile1" value="+63" id="" disabled>
																				<input type="tel" id="groom_contactNum" name="groom_contactNum" placeholder="9123456789" onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57" maxlength="10" pattern="[9]{1}[0-9]{9}" required><br>
																			</div>
																		</div>
																		<div class="input-box">
																			<label for="groom_dob"><strong>Birth Date* </strong></label>
																			<input type="date" id="groom_dob" name="groom_dob" min="<?= date('Y-m-d', strtotime('-100 years')); ?>" max="<?= date('Y-m-d', strtotime('-18 years')); ?>" required><br>
																		</div>
																		<div class="input-box">
																			<label for="groom_pob"><strong>Birth Place* </strong> </label>
																			<input type="text" id="groom_pob" name="groom_pob" placeholder="Taguig City" maxlength="120" required><br>
																		</div>
																	</div>
																	<div>
																		<div class="input-box">
																			<label for="groom_address"><strong>Present Address* </strong> </label>
																			<input type="text" id="groom_address" name="groom_address" placeholder="9 Sampaguita St., Brgy. Pembo, Taguig City" maxlength="120" required><br>
																		</div>
																	</div>
																	<div class="form-grid-cont">
																		<div class="input-box">
																			<label for="groom_fatherName"><strong>Father's Name* </strong> </label>
																			<input type="text" id="groom_fatherName" name="groom_fatherName" placeholder="Joseph Dela Cruz" title="Format: FirstName LastName" maxlength="100" pattern="[A-Za-zÀ-ÖØ-öø-ÿ.\s\-]*" required><br>
																		</div>
																		<div class="input-box"> 
																			<label for="groom_motherName"><strong>Mother's Maiden Name* </strong> </label>
																			<input type="text" id="groom_motherName" name="groom_motherName" placeholder="Maria Tomas" title="Format: FirstName LastName" maxlength="100" pattern="[A-Za-zÀ-ÖØ-öø-ÿ.\s\-]*" required><br>
																		</div>
																		<div class="input-box">
																			<label for="groom_religion"><strong>Religion* </strong> </label>
																			<select class="dropdown" id="groom_religion" name="groom_religion">
																				<option value="" disabled selected hidden>Select Religion</option>
																				<option value="Roman Catholic">Roman Catholic</option>
																				<option value="Catholic">Catholic</option>	
																				<option value="Protestant">Protestant</option>
																				<option value="Iglesia ni Cristo">Iglesia ni Cristo</option>											
																				<option value="Jehovah&lsquo;s Witness">Jehovah&lsquo;s Witness</option>
																				<option value="Seventh Day Adventist">Seventh Day Adventist</option>											
																				<option value="Islam">Islam</option>
																			</select>
																		</div>
																	</div>
																	<div>
																		<h2>Soft Copy of Requirements</h2>
																	</div>
																	<div class="form-grid-cont">
																		<div class="input-box">
																			<label for="groom_idpic"><strong>2x2 ID Picture* </strong> </label>
																			<input type="file" id="groom_idpic" name="groom_idpic" accept="image/*" onchange="validateFileType(this.id)" required><br>
																		</div>
																		<div class="input-box">
																			<label for="groom_psa"><strong>PSA Birth Certificate* </strong> </label>
																			<input type="file" id="groom_psa" name="groom_psa" accept="image/*" onchange="validateFileType(this.id)" required><br>
																		</div>
																		<div class="input-box">
																			<label for="groom_cenomar"><strong>CENOMAR (Certificate of No Marriage)* </strong> </label>
																			<input type="file" id="groom_cenomar" name="groom_cenomar" accept="image/*" onchange="validateFileType(this.id)" required><br>
																		</div>
																		<div class="input-box">
																			<label for="groom_baptismal"><strong>Baptismal Certificate* </strong> </label>
																			<input type="file" id="groom_baptismal" name="groom_baptismal" accept="image/*" onchange="validateFileType(this.id)" required><br>
																		</div>
																		<div class="input-box">
																			<label for="groom_confirmation"><strong>Confirmation Certificate* </strong> </label>
																			<input type="file" id="groom_confirmation" name="groom_confirmation" accept="image/*" onchange="validateFileType(this.id)" required><br>
																		</div>
																	</div>
																</div>
																
																<div class="form-content">
																	<div class="form-title">
																		<h2> Bride's Information </h2>
																	</div>
																	<div>
																		<b>Name</b>
																		<div class="form-grid-cont">
																			<div class="input-box">
																				<label for="bride_lastName"><strong>Last Name* </strong></label>
																				<input type="text" id="bride_lastName" name="bride_lastName" placeholder="San Pedro" maxlength="40" pattern="[A-Za-zÀ-ÖØ-öø-ÿ.\s\-]*" required><br>
																			</div>
																			<div class="input-box">
																				<label for="bride_firstName"><strong>First Name* </strong></label>
																				<input type="text" id="bride_firstName" name="bride_firstName" placeholder="Juana" maxlength="40" pattern="[A-Za-zÀ-ÖØ-öø-ÿ.\s\-]*" required><br>
																			</div>
																			<div class="input-box">
																				<label for="bride_middleName"><strong>Middle Name </strong></label>
																				<input type="text" id="bride_middleName" name="bride_middleName" placeholder="Agustin" maxlength="40" pattern="[A-Za-zÀ-ÖØ-öø-ÿ.\s\-]*"><br>
																			</div>
																		</div>
																	</div>
																	<div class="form-grid-cont">
																		<div class="input-box">
																			<label for="bride_contactNum"><strong>Contact Number* </strong></label>
																			<div class="contactnum">
																				<input type="text" name ="mobile1" value="+63" id="" disabled>
																				<input type="tel" id="bride_contactNum" name="bride_contactNum" placeholder="9123456789" onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57" maxlength="10" pattern="[9]{1}[0-9]{9}" required><br>
																			</div>
																		</div>
																		<div class="input-box">
																			<label for="bride_dob"><strong>Birth Date* </strong></label>
																			<input type="date" id="bride_dob" name="bride_dob" min="<?= date('Y-m-d', strtotime('-100 years')); ?>" max="<?= date('Y-m-d', strtotime('-18 years')); ?>" required><br>
																		</div>
																		<div class="input-box">
																			<label for="bride_pob"><strong>Birth Place* </strong> </label>
																			<input type="text" id="bride_pob" name="bride_pob" maxlength="120" placeholder="Taguig City" required><br>
																		</div>
																	</div>
																	<div>
																		<div class="input-box">
																			<label for="bride_address"><strong>Present Address* </strong> </label>
																			<input type="text" id="bride_address" name="bride_address" placeholder="9 Sampaguita St., Brgy. Pembo, Taguig City" maxlength="120" required><br>
																		</div>
																	</div>
																	<div class="form-grid-cont">
																		<div class="input-box">
																			<label for="bride_fatherName"><strong>Father's Name* </strong> </label>
																			<input type="text" id="bride_fatherName" name="bride_fatherName" placeholder="Francis San Pedro" title="Format: FirstName LastName" maxlength="100" pattern="[A-Za-zÀ-ÖØ-öø-ÿ.\s\-]*" required><br>
																		</div>
																		<div class="input-box"> 
																			<label for="bride_motherName"><strong>Mother's Maiden Name* </strong> </label>
																			<input type="text" id="bride_motherName" name="bride_motherName" placeholder="Teresa Agustin" title="Format: FirstName LastName" maxlength="100" pattern="[A-Za-zÀ-ÖØ-öø-ÿ.\s\-]*" required><br>
																		</div>
																		<div class="input-box">
																			<label for="bride_religion"><strong>Religion* </strong> </label>
																			<select id="bride_religion" name="bride_religion">
																				<option value="" disabled selected hidden>Select Religion</option>
																				<option value="Roman Catholic">Roman Catholic</option>											
																				<option value="Protestant">Protestant</option>
																				<option value="Iglesia ni Cristo">Iglesia ni Cristo</option>											
																				<option value="Jehovah&lsquo;s Witness">Jehovah&lsquo;s Witness</option>
																				<option value="Seventh Day Adventist">Seventh Day Adventist</option>											
																				<option value="Islam">Islam</option>
																			</select>
																		</div>
																	</div>
																	<div>
																		<h2>Soft Copy of Requirements</h2>
																	</div>
																	<div class="form-grid-cont">
																		<div class="input-box">
																			<label for="bride_idpic"><strong>2x2 ID Picture* </strong> </label>
																			<input type="file" id="bride_idpic" name="bride_idpic" accept="image/*" onchange="validateFileType(this.id)" required><br>
																		</div>
																		<div class="input-box">
																			<label for="bride_psa"><strong>PSA Birth Certificate* </strong> </label>
																			<input type="file" id="bride_psa" name="bride_psa" accept="image/*" onchange="validateFileType(this.id)" required><br>
																		</div>
																		<div class="input-box">
																			<label for="bride_cenomar"><strong>CENOMAR (Certificate of No Marriage)* </strong> </label>
																			<input type="file" id="bride_cenomar" name="bride_cenomar" accept="image/*" onchange="validateFileType(this.id)" required><br>
																		</div>
																		<div class="input-box">
																			<label for="bride_baptismal"><strong>Baptismal Certificate* </strong> </label>
																			<input type="file" id="bride_baptismal" name="bride_baptismal" accept="image/*" onchange="validateFileType(this.id)" required><br>
																		</div>
																		<div class="input-box">
																			<label for="bride_confirmation"><strong>Confirmation Certificate* </strong> </label>
																			<input type="file" id="bride_confirmation" name="bride_confirmation" accept="image/*" onchange="validateFileType(this.id)" required><br>
																		</div>
																	</div>
																</div>
																<div class="form-content">
																	<div class="form-title">
																		<h2>For Couple</h2>
																	</div>
																	<div class="form-grid-cont">
																		<div class="input-box">
																			<label for="couple_contract"><strong>Marriage License or Live-In License (Article 34) or Marriage Contract (Civil Marriage)* </strong> </label>
																			<input type="file" id="couple_contract" name="couple_contract" title="Please submit only one (1) of the listed documents." accept="image/*" onchange="validateFileType(this.id)" required><br>
																		</div>
																	</div>
																</div>
																<div class="lower-form">
																	<div class="form-btnarea">
																		<button class="buttonno" type="reset" class="clear" onclick="openForm(clearForm)" id="clear">Clear</button>
																		<button class="buttonyes" type="button" class="submit" onclick="openForm(submitForm)" id="submit">Submit</button>
																	</div>
																</div>
															</div>
														</div>
													</div>
												<?php }
											?> 
										</div>
										
										
										<!-- confirmation pop up -->
										<div class="popupCover" id="clearForm">
											<div class="popupForm">
												<div class="header-cont">
													<div class="icon-box"><i class="fa fa-question-circle" style="font-size: 4rem"></i></div>
													<div class="headertext-box">
														<h3>Are you sure you want to clear?</h3>
														<p>The information you entered will be discarded</p>
													</div>
												</div>
												<div class="form-btnarea">
													<button class="buttonno" type="button" onclick="openForm(clearForm)">No</button>
													<button class="buttonyes" type="reset" onclick="openForm(clearForm), clearReq()">Yes</button>
												</div>
											</div>
										</div>
										<div class="popupCover" id="submitForm">
											<div class="popupForm">
												<div class="header-cont">
													<div class="icon-box"><i class="fa fa-question-circle" style="font-size: 4rem"></i></div>
													<div class="headertext-box">
														<h3>Are you sure you want to submit?</h3>
														<p>Please ensure that your details are correct before submission to avoid any issues. After submission, your event schedule request will be submitted for approval.</p>
													</div>
												</div>
												<div class="form-btnarea">
													<button class="buttonno" type="button" onclick="openForm(submitForm)">No</button>
													<button class="buttonyes" type="Submit" name="submitform">Yes</button>
												</div>
											</div>
										</div>
									</form>
									
									<?php
									
								} else if($event == "Baptism"){ ?> 
										<?php
										$baptismst = array("09:00:00", "10:00:00", "11:00:00", "14:00:00", "15:00:00");
										$baptismet = array("09:45:00", "10:45:00", "11:45:00", "14:45:00", "15:45:00");
										//query for retrieving appointments in the same day
										$query = "SELECT event_timeStart, event_timeEnd FROM appointment_details WHERE appointment_status = 'Accepted' AND event_date = '$date'";
										$result = mysqli_query($conn, $query);
										////////
										$starttime = array();
										$endtime = array();
										$counter = 0;
										while ($row = mysqli_fetch_assoc($result)){
											$starttime[$counter] = $row['event_timeStart'];
											$endtime[$counter] = $row['event_timeEnd'];
											$counter++;
										}
										
										$avtime = $baptismst;
										$count =0;
										$break = false;
										for ($x = 0; $x < count($baptismst); $x++){
											for($y = 0; $y < count($starttime); $y++) {
												if(strtotime($baptismst[$x]) == strtotime($starttime[$y]) || strtotime($baptismst[$x]) == strtotime($endtime[$y])){
													unset($avtime[$x]);
													break;	
												}else if(strtotime($baptismst[$x]) > strtotime($starttime[$y]) && strtotime($baptismst[$x]) < strtotime($endtime[$y])) {
													unset($avtime[$x]);
													break;
												}else if(strtotime($baptismet[$x]) > strtotime($starttime[$y]) && strtotime($baptismet[$x]) < strtotime($endtime[$y])){
													unset($avtime[$x]);
													break;
												} else {
													
												}
											}
										}
										$count_time = 0;?>
										<form action="page_LANDING.php" method="post" enctype="multipart/form-data">
											<div> <strong> Select Available Time:</strong> </div>
											<div class="avtime-container">
												<?php
													$event_endtime = "";
													if(count($avtime) == 0){
														echo "No Available Time";
													} else { ?>
														<div class="rd-cont">
														<?php
															foreach ($avtime as $i){
																for($y = 0; $y < count($baptismst); $y++){
																	if(strtotime($i) == strtotime($baptismst[$y])){
																		$event_endtime = $baptismet[$y];
																	}
																}
																?><div style="margin-right: 2rem">
																	<input type="radio" id="<?php echo 'rtime'.$count_time ?>" name="rdtime" value="<?php echo $i." ". $event_endtime?>">
																	<label for="<?php echo 'rtime'.$count_time ?>"><?php echo date("h:iA", strtotime($i)) ?></label><br>
																</div>
																<?php
																$count_time++;
															} ?>
														</div>
														<div class="req-cont">
															<br>
															<b> Requirements: </b>
															<div>
																<div>
																	<ul>
																		<li>Child's PSA/Local Birth Certificate (photocopy) </li>
																		<li>Marriage Contract of parents (photocopy) </li>
																	</ul>
																</div>
															</div>
															
															<b> Notes: </b>
															<div>
																<div>
																	<ul>
																		<li>Parents and Sponsors are required to attend the seminar</li>
																		<li>White dress or polo and pants for the child</li>
																		<li>Any colors for the parents and sponsors</li>
																		<li>The Godfather (Ninong) and Godmother (Ninang) must be at least 18 years of age. </li>
																		<li>Only baptized Catholics are eligible to be chosen as Godfathers (Ninong) and Godmothers (Ninang). </li>
																	</ul>
																</div>
															</div>
															<br>
														</div>
														<div class="form-cont">
															<div class="form-content">
																<div class="form-title">
																	<b>To be baptized's information</b>
																</div>
																<div>
																	<b>Name</b>
																	<div class="form-grid-cont">
																		<div class="input-box">
																			<label for="lastName">Last Name* </label>
																			<input type="text" id="lastName" name="lastName" maxlength="40" placeholder="Dela Cruz" pattern="[A-Za-zÀ-ÖØ-öø-ÿ.\s\-]*" required><br>
																		</div>
																		<div class="input-box">
																			<label for="firstName">First Name* </label>
																			<input type="text" id="firstName" name="firstName" maxlength="40" placeholder="Juan" pattern="[A-Za-zÀ-ÖØ-öø-ÿ.\s\-]*" required><br>
																		</div>
																		<div class="input-box">
																			<label for="middleName">Middle Name </label>
																			<input type="text" id="middleName" name="middleName" maxlength="40" placeholder="Tomas" pattern="[A-Za-zÀ-ÖØ-öø-ÿ.\s\-]*"><br>
																		</div>
																	</div>
																</div>
																<div class="form-grid-cont">
																	<div>
																		<b>Gender*</b>
																		<div style="display: flex">
																			<div>
																				<input type="radio" id="genderMale" name="gender" value="Male" required>
																				<label for="genderMale">Male </label> <br>
																			</div>
																			<div>
																				<input type="radio" id="genderFemale" name="gender" value="Female" required>
																				<label for="genderFemale">Female </label> <br>
																			</div>
																		</div>
																	</div>
																	<div class="input-box">
																		<label for="dob"><strong>Birth Date*</strong> </label>
																		<input type="date" id="dob" name="dob" min="<?= date('Y-m-d', strtotime('-100 years')); ?>" max="<?= date('Y-m-d', strtotime('-1 month')); ?>" required><br>
																	</div>
																	<div class="input-box">
																		<label for="pob"><strong>Birth Place*</strong> </label>
																		<input type="text" id="pob" name="pob" maxlength="120" placeholder="Taguig City" required><br>
																	</div>
																</div>
																<div>
																	<div class="input-box">
																		<label for="address"><strong>Present Address*</strong> </label>
																		<input type="text" id="address" name="address" maxlength="120" placeholder="9 Sampaguita St., Brgy. Pembo, Taguig City" required><br>
																	</div>
																</div>
																<div class="grid-cont">
																	<div class="input-box">
																		<label for="fatherName"><strong>Father's Name*</strong> </label>
																		<input type="text" id="fatherName" name="fatherName" maxlength="100" placeholder="Joseph Dela Cruz" title="Format: FirstName LastName" pattern="[A-Za-zÀ-ÖØ-öø-ÿ.\s\-]*" required><br>
																	</div>
																	<div class="input-box">
																		<label for="fatherPob"><strong>Father's Birth Place*</strong> </label>
																		<input type="text" id="fatherPob" name="fatherPob" maxlength="120" placeholder="Taguig City" required><br>
																	</div>
																</div>
																<div class="grid-cont">
																	<div class="input-box">
																		<label for="motherName"><strong>Mother's Maiden Name*</strong> </label>
																		<input type="text" id="motherName" name="motherName" maxlength="100" placeholder="Maria Tomas" title="Format: FirstName LastName" pattern="[A-Za-zÀ-ÖØ-öø-ÿ.\s\-]*" required><br>
																	</div>
																	<div class="input-box">
																		<label for="motherPob"><strong>Mother's Birth Place*</strong> </label>
																		<input type="text" id="motherPob" name="motherPob" maxlength="120" placeholder="Makati City" required><br>
																	</div>
																</div>
																<div class="grid-cont">
																	<div class="input-box">
																		<label for="contactNum"><strong>Parent/Guardian's Contact Number*</strong></label>
																		<div class="contactnum">
																			<input type="text" name ="mobile1" value="+63" id="" disabled>
																			<input type="tel" id="contactNum" name="contactNum" maxlength="10" onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57" placeholder="9123456789" pattern="[9]{1}[0-9]{9}" required><br>
																		</div>
																	</div>
																	<div class="input-box">
																		<label for="marriage_type"><strong>Parents' Type of Marriage*</strong> </label>
																		<select id="marriage_type" name="marriage_type">
																			<option value="default" disabled selected hidden></option>
																			<option value="Catholic Marriage" title="Catholic Marriage = married in church and officiated by a priest">Catholic Marriage</option>											
																			<option value="Civil Marriage" title="Civil Marriage = married in court and officiated by a lawyer">Civil Marriage</option>
																		</select>
																	</div>
																</div>
																<div class="grid-cont">
																	<div class="input-box">
																		<label for="godfatherName"><strong>Godfather's Name*</strong> </label>
																		<input type="text" id="godfatherName" name="godfatherName" placeholder="Francis Dela Cruz" title="Format: FirstName LastName" maxlength="100" pattern="[A-Za-zÀ-ÖØ-öø-ÿ.\s\-]*" required><br>
																	</div>
																	<div class="input-box">
																		<label for="godfatherAddress"><strong>Godfather's Address*</strong> </label>
																		<input type="text" id="godfatherAddress" name="godfatherAddress" placeholder="Taguig City" maxlength="120" required><br>
																	</div>
																</div>
																<div class="grid-cont">
																	<div class="input-box">
																		<label for="godmotherName"><strong>Godmother's Name*</strong></label>
																		<input type="text" id="godmotherName" name="godmotherName" maxlength="100" placeholder="Teresa Tomas" title="Format: FirstName LastName" pattern="[A-Za-zÀ-ÖØ-öø-ÿ.\s\-]*" required><br>
																	</div>
																	<div class="input-box">
																		<label for="godmotherAddress"><strong>Godmother's Address*</strong></label>
																		<input type="text" id="godmotherAddress" name="godmotherAddress" placeholder="Makati City" maxlength="120" required><br>
																	</div>
																</div>
																<div>
																		<h2>Soft Copy of Requirements</h2>
																	</div>
																	<div class="grid-cont">
																		<div class="input-box">
																			<label for="psa"><strong>Child's PSA Birth Certificate*</strong> </label>
																			<input type="file" id="psa" name="psa" accept="image/*" onchange="validateFileType(this.id)" required><br>
																		</div>
																		<div class="input-box">
																			<label for="marriage_contract"><strong>Marriage Contract of Parents* </strong> </label>
																			<input type="file" id="marriage_contract" name="marriage_contract" accept="image/*" onchange="validateFileType(this.id)" required><br>
																		</div>
																	</div>
																</div>
																<div class="lower-form">
																	<div class="form-btnarea">
																		<button class="buttonno" type="reset" class="clear" onclick="openForm(clearForm)" id="clear">Clear</button>
																		<button class="buttonyes" type="button" class="submit" onclick="openForm(submitForm)" id="submit">Submit</button>
																	</div>
																</div>
															</div>
														</div>

														<div class="popupCover" id="clearForm">
															<div class="popupForm">
																<div class="header-cont">
																	<div class="icon-box"><i class="fa fa-question-circle" style="font-size: 4rem"></i></div>
																	<div class="headertext-box">
																		<h3>Are you sure you want to clear?</h3>
																		<p>The information you entered will be discarded</p>
																	</div>
																</div>
																<div class="form-btnarea">
																	<button class="buttonno" type="button" onclick="openForm(clearForm)">No</button>
																	<button class="buttonyes" type="reset" onclick="openForm(clearForm), clearReq()">Yes</button>
																</div>
															</div>
														</div>
														<div class="popupCover" id="submitForm">
															<div class="popupForm">
																<div class="header-cont">
																	<div class="icon-box"><i class="fa fa-question-circle" style="font-size: 4rem"></i></div>
																	<div class="headertext-box">
																		<h3>Are you sure you want to submit?</h3>
																		<p>Please ensure that your details are correct before submission to avoid any issues. After submission, your event schedule request will be submitted for approval.</p>
																	</div>
																</div>
																<div class="form-btnarea">
																	<button class="buttonno" type="button" onclick="openForm(submitForm)">No</button>
																	<button class="buttonyes" type="Submit" name="submitform">Yes</button>
																</div>
															</div>
														</div>
													<?php }?>
											</div>
											
										</form>
									<?php
								}
								
								// FUNERAL MASS AND BLESSING FORM
								else if($event == "Funeral Mass/Blessing"){
									?>
									<form action="page_LANDING.php" method="post" enctype="multipart/form-data">
										
										<?php
											$funeralst = array("08:00:00", "13:00:00");
											
											//query for retrieving appointments in the same day
											$query = "SELECT event_timeStart, event_timeEnd FROM appointment_details WHERE appointment_status = 'Accepted' AND event_date = '$date' AND appointment_type = 'Funeral Mass/Blessing'";
											$result = mysqli_query($conn, $query);
											////////
											$starttime = array();
											$counter = 0;
											while ($row = mysqli_fetch_assoc($result)){
												$starttime[$counter] = $row['event_timeStart'];
												$counter++;
											}
											
											$avtime = $funeralst;
											$count =0;
											$break = false;
											for ($x = 0; $x < count($funeralst); $x++){
												for($y = 0; $y < count($starttime); $y++) {
													if(strtotime($funeralst  [$x]) == strtotime($starttime[$y])){
														unset($avtime[$x]);
														break;	
													}
												}
											}
											$count_time = 0;?>
											<div> <strong> Select Available Time:</strong> </div>
											<div class="avtime-container">
												<?php
												if(count($avtime) == 0){
													echo "No Available Time";
												} else {
													foreach ($avtime as $i){
														if($day == "Sunday"){
															if($i == "08:00:00"){
																//discarding 8:00 schedule
															} else {
																?><div>
																	<input type="radio" id="<?php echo 'rtime'.$count_time ?>" name="rdtime" value="<?php echo $i?>">
																	<label for="<?php echo 'rtime'.$count_time ?>"><?php echo date("h:ia", strtotime($i)) ?></label><br>
																</div>
																<?php
															}
														} else {
															?><div>
																<input type="radio" id="<?php echo 'rtime'.$count_time ?>" name="rdtime" value="<?php echo $i?>">
																<label for="<?php echo 'rtime'.$count_time ?>"><?php echo date("h:ia", strtotime($i)) ?></label><br>
															</div>
															<?php
														}
														$count_time++;
													} ?>
													<b> Requirements: </b>
													<ul>
														<li>Death certificate of the deceased</li>
													</ul>
														
													<b> Notes: </b>
													<ul>
														<li>Funeral masses are held at the church while funeral blessings are held at the wake.</li>
														<li>Funeral mass - Php 1,000.00 </li>
														<li>Funeral blessing - Donation</li>
													</ul>
													<div class="form-cont">
														<div class="form-content">
															<div class="form-title">
																<h2>Deceased's Information</h2>
															</div>
															<div>
																<b>Name</b>
																<div class="form-grid-cont">
																	<div class="input-box">
																		<label for="lastName">Last Name* </label>
																		<input type="text" id="lastName" name="lastName" maxlength="40" placeholder="Dela Cruz" pattern="[A-Za-zÀ-ÖØ-öø-ÿ.\s\-]*" required><br>
																	</div>
																	<div class="input-box">
																		<label for="firstName">First Name* </label>
																		<input type="text" id="firstName" name="firstName" maxlength="40" placeholder="Juan" pattern="[A-Za-zÀ-ÖØ-öø-ÿ.\s\-]*" required><br>
																	</div>
																	<div class="input-box">
																		<label for="middleName">Middle Name </label>
																		<input type="text" id="middleName" name="middleName" maxlength="40" placeholder="Tomas" pattern="[A-Za-zÀ-ÖØ-öø-ÿ.\s\-]*"><br>
																	</div>
																</div>
															</div>
															<div class="form-grid-cont">
																<div class="input-box">
																	<label for="age"><strong>Age*</strong> </label>
																	<input type="num" id="age" name="age" min="0" placeholder="30" onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57" max="120" maxlength="3" required><br>
																</div>
																<div>
																	<b>Gender*</b>
																	<div style="display: flex">
																		<div>
																			<input type="radio" id="genderMale" name="gender" value="Male" required>
																			<label for="genderMale">Male </label> <br>
																		</div>
																		<div>
																			<input type="radio" id="genderFemale" name="gender" value="Female" required>
																			<label for="genderFemale">Female </label> <br>
																		</div>
																	</div>
																</div>
																<div class="input-box">
																	<label for="cause_of_death"><strong>Cause of Death*</strong></label>
																	<input type="text" id="cause_of_death" name="cause_of_death" placeholder="Ischaemic heart disease" title="Please indicate the cause stated on the deceased's death certificate." maxlength="120" required><br>
																</div>
																<div class="input-box">
																	<label for="date_of_death"><strong>Date of Death*</strong></label>
																	<input type="date" name="date_of_death" min="<?= date('Y-m-d', strtotime('-1 month')); ?>" max="<?php echo date("Y-m-d"); ?>" required><br>
																</div>
																<div class="input-box">
																	<label for="date_of_internment"><strong>Date of Internment*</strong> </label>
																	<input type="date" id="date_of_internment" name="date_of_internment" min="<?php echo date("Y-m-d"); ?>" max="<?= date('Y-m-d', strtotime('+1 month')); ?>" required><br>
																</div>
																<div class="input-box">
																	<label for="place_of_cemetery"><strong>Place of Cemetery*</strong> </label>
																	<input type="text" id="place_of_cemetery" name="place_of_cemetery" placeholder="Manila American Cemetery and Memorial" maxlength="120" required><br>
																</div>
															</div>
															<div class="grid-cont">
																<div>
																	<b>Sacrament Received*</b>
																	<div style="display: flex">
																		<div>
																			<input type="radio" id="sacramentYes" name="sacrament" value="Yes" required>
																			<label for="sacramentYes">Yes </label><br>
																		</div>
																		<div>
																			<input type="radio" id="sacramentNo" name="sacrament" value="No" required>
																			<label for="sacramentNo">No </label><br>
																		</div>
																	</div>
																</div>
																<div>
																	<b>Casket or Urn*</b>
																	<div style="display: flex" title="Casket is for funeral masses while Urn is for funeral blessings">
																		<div>
																			<input type="radio" id="burialCasket" name="burial" value="Casket" title="Funeral Mass" required>
																			<label for="burialCasket">Casket </label>
																		</div>
																		<div>
																			<input type="radio" id="burialUrn" name="burial" value="Urn" title="Funeral Blessing" required>
																			<label for="burialUrn">Urn </label>
																		</div>
																	</div>
																</div>
															</div>
															<div>
																<h2>Soft Copy of Requirements</h2>
															</div>
															<div class="form-grid-cont">
																<div class="input-box">
																	<label for="deathcert"><strong>Death Certificate* </strong> </label>
																	<input type="file" id="deathcert" name="deathcert" accept="image/*" onchange="validateFileType(this.id)" required><br>
																</div>
															</div>
															<div class="form-title">
																<h2 title="Informant = person who gave the deceased's death certificate information to the church">Informant's Information</h2>
															</div>
															<div>
																<b>Name</b>
																<div class="form-grid-cont">
																	<div class="input-box">
																		<label for="informantLastName">Last Name* </label>
																		<input type="text" id="informantLastName" name="informantLastName" placeholder="San Pedro" maxlength="40" pattern="[A-Za-zÀ-ÖØ-öø-ÿ.\s\-]*" required><br>
																	</div>
																	<div class="input-box">
																		<label for="informantFirstName">First Name* </label>
																		<input type="text" id="informantFirstName" name="informantFirstName" placeholder="Juana" maxlength="40" pattern="[A-Za-zÀ-ÖØ-öø-ÿ.\s\-]*" required><br>
																	</div>
																	<div class="input-box">
																	<label for="informantMiddleName">Middle Name </label>
																	<input type="text" id="informantMiddleName" name="informantMiddleName" placeholder="Agustin" maxlength="40" pattern="[A-Za-zÀ-ÖØ-öø-ÿ.\s\-]*"><br>
																	</div>
																</div>
															</div>
															<div class="grid-cont">
																<div class="input-box">
																	<label for="contactNum"><strong>Contact Number*</strong></label>
																	<div class="contactnum">
																		<input type="text" name ="mobile1" value="+63" id="" disabled>
																		<input type="tel" id="contactNum" name="informantContactNum" maxlength="10" placeholder="9123456789" onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57" pattern="[9]{1}[0-9]{9}" required><br>
																	</div>
																</div>
																<div class="input-box">
																	<label for="address"><strong>Present Address*</strong> </label>
																	<input type="text" id="address" name="informantAddress" placeholder="9 Sampaguita St., Brgy. Pembo, Taguig City" maxlength="120" required><br>
																</div>
															</div>
														</div>
														<div class="lower-form">
															<div class="form-btnarea">
																<button class="buttonno" type="reset" class="clear" onclick="openForm(clearForm)" id="clear">Clear</button>
																<button class="buttonyes" type="button" class="submit" onclick="openForm(submitForm)" id="submit">Submit</button>
															</div>
														</div>
													</div>
													
													<div class="popupCover" id="clearForm">
															<div class="popupForm">
																<div class="header-cont">
																	<div class="icon-box"><i class="fa fa-question-circle" style="font-size: 4rem"></i></div>
																	<div class="headertext-box">
																		<h3>Are you sure you want to clear?</h3>
																		<p>The information you entered will be discarded</p>
																	</div>
																</div>
																<div class="form-btnarea">
																	<button class="buttonno" type="button" onclick="openForm(clearForm)">No</button>
																	<button class="buttonyes" type="reset" onclick="openForm(clearForm), clearReq()">Yes</button>
																</div>
															</div>
														</div>
														<div class="popupCover" id="submitForm">
															<div class="popupForm">
																<div class="header-cont">
																	<div class="icon-box"><i class="fa fa-question-circle" style="font-size: 4rem"></i></div>
																	<div class="headertext-box">
																		<h3>Are you sure you want to submit?</h3>
																		<p>Please ensure that your details are correct before submission to avoid any issues. After submission, your event schedule request will be submitted for approval.</p>
																	</div>
																</div>
																<div class="form-btnarea">
																	<button class="buttonno" type="button" onclick="openForm(submitForm)">No</button>
																	<button class="buttonyes" type="Submit" name="submitform">Yes</button>
																</div>
															</div>
														</div>
									</form>
								<?php } 
								}else if($event == "Baptismal Certificate" || $event == "Wedding Certificate" || $event == "Confirmation Certificate"){
									?> 
									<div>
										<div>
										<b> Requirements for <?php echo $event?>: </b>
											<div class="grid-cont">
												<div>
													<ul>
														<li> Birth Certificate</li>		
														<li>Php 100.00</li>
													</ul>
												</div>		
											</div>
											<b> Notes: </b>
											<div>
												<div>
													<ul>
														<li>Another person may claim your document as long as they have a copy of your valid ID and an authorization letter. </li>
														<li>The document must be claimed during office hours within the scheduled date. </li>
														<li>Office hours: </li>
														<li>Tuesday-Saturday: 8:00 - 11:30 AM || 1:30 - 5:00 PM </li>
														<li>Sunday: 8:00 - 12:00 NN </li>
													</ul>
												</div>
											</div>
										</div>
										<form action="page_LANDING.php" method="post" enctype="multipart/form-data">
											<div class="form-cont">
												<div class="form-content">
													<div class="form-title">
														<h2>
														<?php 
															if($event == "Baptismal Certificate"){
																echo"<b>Child's</b>";
															}else {
																echo"<b>Requester's</b>";
															}
														?>
														</h2>
													</div>
													<div>
														<b>Name</b>
														<div class="form-grid-cont">
															<div class="input-box">
																<label for="lastName">Last Name* </label>
																<input type="text" id="lastName" name="lastName" maxlength="40" placeholder="Dela Cruz" pattern="[A-Za-zÀ-ÖØ-öø-ÿ.\s\-]*" required><br>
															</div>
															<div class="input-box">
																<label for="firstName">First Name* </label>
																<input type="text" id="firstName" name="firstName" maxlength="40" placeholder="Juan" pattern="[A-Za-zÀ-ÖØ-öø-ÿ.\s\-]*" required><br>
															</div>
															<div class="input-box">
																<label for="middleName">Middle Name </label>
																<input type="text" id="middleName" name="middleName" maxlength="40" placeholder="Tomas" pattern="[A-Za-zÀ-ÖØ-öø-ÿ.\s\-]*"><br>
															</div>
														</div>
													</div>
													<div class="grid-cont">
														<div class="input-box">
															<label for="dob"><strong>Birth Date*</strong></label>
															<input type="date" id="dob" name="dob" min="<?= date('Y-m-d', strtotime('-100 years')); ?>" max="<?= date('Y-m-d', strtotime('-1 month')); ?>" required> <br>
														</div>
														<div class="input-box">
															<label for="contactNum"><strong>Contact Number*</strong></label>
															<div class="contactnum">
																<input type="text" name ="mobile1" value="+63" id="" disabled>
																<input type="tel" id="contactNum" name="ContactNum" maxlength="10" placeholder="9123456789" onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57" pattern="[9]{1}[0-9]{9}" required><br>
															</div>
														</div>
														<div class="input-box">
															<label for="fname"><strong>Father's Name*</strong> </label>
															<input type="text" id="fname" name="fname" maxlength="100" placeholder="Joseph Dela Cruz" title="Format: FirstName LastName" pattern="[A-Za-zÀ-ÖØ-öø-ÿ.\s\-]*" required><br>
														</div>
														<div class="input-box">
															<label for="mname"><strong>Mother's Name*</strong> </label>
															<input type="text" id="mname" name="mname" maxlength="100" placeholder="Maria Tomas" title="Format: FirstName LastName" pattern="[A-Za-zÀ-ÖØ-öø-ÿ.\s\-]*" required><br>
														</div>
														<div class="input-box">
															<label for="purpose"><strong>Purpose*</strong> </label>
															<input type="text" id="purpose" name="purpose" placeholder="Wedding Requirement" maxlength="120" required><br>
														</div>
													</div>
													<div>
														<h2>Soft Copy of Requirements</h2>
													</div>
													<div class="form-grid-cont">
														<div class="input-box">
															<label for="birthcert"><strong>Birth Certificate* </strong> </label>
															<input type="file" id="birthcert" name="birthcert" accept="image/*" onchange="validateFileType(this.id)" required><br>
														</div>
													</div>
													<div class="lower-form">
														<div class="form-btnarea">
															<button class="buttonno" type="reset" class="clear" onclick="openForm(clearForm)" id="clear">Clear</button>
															<button class="buttonyes" type="button" class="submit" onclick="openForm(submitForm)" id="submit">Submit</button>
														</div>
													</div>
												</div>
											</div>
											<div class="popupCover" id="clearForm">
												<div class="popupForm">
													<div class="header-cont">
														<div class="icon-box"><i class="fa fa-question-circle" style="font-size: 4rem"></i></div>
														<div class="headertext-box">
															<h3>Are you sure you want to clear?</h3>
															<p>The information you entered will be discarded</p>
														</div>
													</div>
													<div class="form-btnarea">
														<button class="buttonno" type="button" onclick="openForm(clearForm)">No</button>
														<button class="buttonyes" type="reset" onclick="openForm(clearForm), clearReq()">Yes</button>
													</div>
												</div>
											</div>
											<div class="popupCover" id="submitForm">
												<div class="popupForm">
													<div class="header-cont">
														<div class="icon-box"><i class="fa fa-question-circle" style="font-size: 4rem"></i></div>
														<div class="headertext-box">
															<h3>Are you sure you want to submit?</h3>
															<p>Please ensure that your details are correct before submission to avoid any issues. After submission, your event schedule request will be submitted for approval.</p>
														</div>
													</div>
													<div class="form-btnarea">
														<button class="buttonno" type="button" onclick="openForm(submitForm)">No</button>
														<button class="buttonyes" type="Submit" name="submitform">Yes</button>
													</div>
												</div>
											</div>
										</form>
									</div>
											</div>
									
									<?php
								} else if($event == "Good Moral Certificate"){
								?>
									<div>
										<div>
										<b> Requirements for <?php echo $event?>: </b>
											<div>
												<div>
													<ul>
														<li>Birth Certificate</li>
														<li>Barangay Certificate</li>
														<li>Kawan Certificate</li>
														<li>Php 100.00</li>
													</ul>
												</div>				
											</div>
											<b> Notes: </b>
											<div>
												<div>
													<ul>
														<li>Another person may claim your document as long as they have a copy of your valid ID and an authorization letter. </li>
														<li>The document must be claimed during office hours within the scheduled date.</li>
														<li>Office hours: </li>
														<li>Tuesday-Saturday: 8:00 - 11:30 AM || 1:30 - 5:00 PM </li>
														<li>Sunday: 8:00 - 12:00 NN </li>
													</ul>
												</div>
											</div>
										</div>
										<form action="page_LANDING.php" method="post" enctype="multipart/form-data">
											<div class="form-cont">
												<div class="form-content">
													<div class="form-title">
														<h2><b>Requester's</b></h2>
													</div>
													<div>
														<b>Name</b>
														<div class="form-grid-cont">
															<div class="input-box">
																<label for="lastName">Last Name* </label>
																<input type="text" id="lastName" name="lastName" placeholder="Dela Cruz" maxlength="40" pattern="[A-Za-zÀ-ÖØ-öø-ÿ.\s\-]*" required><br>
															</div>
															<div class="input-box">
																<label for="firstName">First Name* </label>
																<input type="text" id="firstName" name="firstName" placeholder="Juan" maxlength="40" pattern="[A-Za-zÀ-ÖØ-öø-ÿ.\s\-]*" required><br>
															</div>
															<div class="input-box">
																<label for="middleName">Middle Name </label>
																<input type="text" id="middleName" name="middleName" placeholder="Tomas" maxlength="40" pattern="[A-Za-zÀ-ÖØ-öø-ÿ.\s\-]*"><br>
															</div>
														</div>
													</div>
													<div class="grid-cont">
														<div class="input-box">
															<label for="dob"><strong>Birth Date*</strong></label>
															<input type="date" id="dob" name="dob" min="<?= date('Y-m-d', strtotime('-100 years')); ?>" max="<?= date('Y-m-d', strtotime('-18 years')); ?>" required> <br>
														</div>
														<div class="input-box">
															<label for="contactNum"><strong>Contact Number*</strong></label>
															<div class="contactnum">
																<input type="text" name ="mobile1" value="+63" id="" disabled>
																<input type="tel" id="contactNum" name="ContactNum" maxlength="10" placeholder="9123456789" onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57" pattern="[9]{1}[0-9]{9}" required><br>
															</div>
														</div>
														<div class="input-box">
															<label for="purpose"><strong>Purpose*</strong> </label>
															<input type="text" id="purpose" name="purpose" placeholder="Board Exam Requirement" maxlength="100" required><br>
														</div>
													</div>
													<div>
														<h2>Soft Copy of Requirements</h2>
													</div>
													<div class="form-grid-cont">
														<div class="input-box">
															<label for="birthcert"><strong>Birth Certificate* </strong> </label>
															<input type="file" id="birthcert" name="birthcert" accept="image/*" onchange="validateFileType(this.id)" required><br>
														</div>
														<div class="input-box">
															<label for="barangaycert"><strong>Barangay Certificate* </strong> </label>
															<input type="file" id="barangaycert" name="barangaycert" accept="image/*" onchange="validateFileType(this.id)" required><br>
														</div>
														<div class="input-box">
															<label for="kawancert"><strong>Kawan Certificate* </strong> </label>
															<input type="file" id="kawancert" name="kawancert" accept="image/*" onchange="validateFileType(this.id)" required><br>
														</div>
													</div>
													<div class="lower-form">
														<div class="form-btnarea">
															<button class="buttonno" type="reset" class="clear" onclick="openForm(clearForm)" id="clear">Clear</button>
															<button class="buttonyes" type="button" class="submit" onclick="openForm(submitForm)" id="submit">Submit</button>
														</div>
													</div>
												</div>
											</div>
											<div class="popupCover" id="clearForm">
												<div class="popupForm">
													<div class="header-cont">
														<div class="icon-box"><i class="fa fa-question-circle" style="font-size: 4rem"></i></div>
														<div class="headertext-box">
															<h3>Are you sure you want to clear?</h3>
															<p>The information you entered will be discarded</p>
														</div>
													</div>
													<div class="form-btnarea">
														<button class="buttonno" type="button" onclick="openForm(clearForm)">No</button>
														<button class="buttonyes" type="reset" onclick="openForm(clearForm), clearReq()">Yes</button>
													</div>
												</div>
											</div>
											<div class="popupCover" id="submitForm">
												<div class="popupForm">
													<div class="header-cont">
														<div class="icon-box"><i class="fa fa-question-circle" style="font-size: 4rem"></i></div>
														<div class="headertext-box">
															<h3>Are you sure you want to submit?</h3>
															<p>Please ensure that your details are correct before submission to avoid any issues. After submission, your event schedule request will be submitted for approval.</p>
														</div>
													</div>
													<div class="form-btnarea">
														<button class="buttonno" type="button" onclick="openForm(submitForm)">No</button>
														<button class="buttonyes" type="Submit" name="submitform">Yes</button>
													</div>
												</div>
											</div>
										</form>
									</div>
									
								<?php
								} else if($event == "Permit and No Record"){
									?> 
									<div>
										<div>
										<b> Requirements for <?php echo $event?>: </b>
											<div>
												<div>
													<ul>
														<li>Birth Certificate</li>
														<li>Php 100.00</li>
													</ul>
												</div>			
											</div>
											<b> Notes: </b>
											<div>
												<div>
													<ul>
														<li>Another person may claim your document as long as they have a copy of your valid ID and an authorization letter.</li>
														<li>The document must be claimed during office hours within the scheduled date.</li>
														<li>Office hours:</li>
														<li>Tuesday-Saturday: 8:00 - 11:30 AM || 1:30 - 5:00 PM</li>
														<li>Sunday: 8:00 - 12:00 NN</li>
													</ul>
												</div>
											</div>
										</div>
										<form action="page_LANDING.php" method="post" enctype="multipart/form-data">
											<div class="form-cont">
												<div class="form-content">
													<div class="form-title">
														<h2><b>Requester's</b></h2>
													</div>
													<div>
														<b>Name</b>
														<div class="form-grid-cont">
															<div class="input-box">
																<label for="lastName">Last Name* </label>
																<input type="text" id="lastName" name="lastName" placeholder="Dela Cruz" maxlength="40" pattern="[A-Za-zÀ-ÖØ-öø-ÿ.\s\-]*" required><br>
															</div>
															<div class="input-box">
																<label for="firstName">First Name* </label>
																<input type="text" id="firstName" name="firstName" placeholder="Juan" maxlength="40" pattern="[A-Za-zÀ-ÖØ-öø-ÿ.\s\-]*" required><br>
															</div>
															<div class="input-box">
																<label for="middleName">Middle Name </label>
																<input type="text" id="middleName" name="middleName" placeholder="Tomas" maxlength="40" pattern="[A-Za-zÀ-ÖØ-öø-ÿ.\s\-]*"><br>
															</div>
														</div>
													</div>
													<div class="grid-cont">
														<div class="input-box">
															<label for="dob"><strong>Birth Date*</strong></label>
															<input type="date" id="dob" name="dob" min="<?= date('Y-m-d', strtotime('-100 years')); ?>" max="<?= date('Y-m-d', strtotime('-1 month')); ?>" required> <br>
														</div>
														<div class="input-box">
															<label for="contactNum"><strong>Contact Number*</strong></label>
															<div class="contactnum">
																<input type="text" name ="mobile1" value="+63" id="" disabled>
																<input type="tel" id="contactNum" name="ContactNum" maxlength="10" placeholder="9123456789" onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57" pattern="[9]{1}[0-9]{9}" required><br>
															</div>
														</div>
														<div class="input-box">
															<label for="address"><strong>Present Address*</strong> </label>
															<input type="text" id="address" name="address" placeholder="9 Sampaguita St., Brgy. Pembo, Taguig City" maxlength="150" required><br>
														</div>
														<div class="input-box">
															<label for="purpose"><strong>Purpose*</strong> </label>
															<input type="text" id="purpose" name="purpose" placeholder="Baptism at another church" maxlength="120" required><br>
														</div>
													</div>
													<div>
														<h2>Soft Copy of Requirements</h2>
													</div>
													<div class="form-grid-cont">
														<div class="input-box">
															<label for="birthcert"><strong>Birth Certificate* </strong> </label>
															<input type="file" id="birthcert" name="birthcert" accept="image/*" onchange="validateFileType(this.id)" required><br>
														</div>
													</div>
													<div class="lower-form">
														<div class="form-btnarea">
															<button class="buttonno" type="reset" class="clear" onclick="openForm(clearForm)" id="clear">Clear</button>
															<button class="buttonyes" type="button" class="submit" onclick="openForm(submitForm)" id="submit">Submit</button>
														</div>
													</div>
												</div>
											</div>
											<div class="popupCover" id="clearForm">
												<div class="popupForm">
													<div class="header-cont">
														<div class="icon-box"><i class="fa fa-question-circle" style="font-size: 4rem"></i></div>
														<div class="headertext-box">
															<h3>Are you sure you want to clear?</h3>
															<p>The information you entered will be discarded</p>
														</div>
													</div>
													<div class="form-btnarea">
														<button class="buttonno" type="button" onclick="openForm(clearForm)">No</button>
														<button class="buttonyes" type="reset" onclick="openForm(clearForm), clearReq()">Yes</button>
													</div>
												</div>
											</div>
											<div class="popupCover" id="submitForm">
												<div class="popupForm">
													<div class="header-cont">
														<div class="icon-box"><i class="fa fa-question-circle" style="font-size: 4rem"></i></div>
														<div class="headertext-box">
															<h3>Are you sure you want to submit?</h3>
															<p>Please ensure that your details are correct before submission to avoid any issues. After submission, your event schedule request will be submitted for approval.</p>
														</div>
													</div>
													<div class="form-btnarea">
														<button class="buttonno" type="button" onclick="openForm(submitForm)">No</button>
														<button class="buttonyes" type="Submit" name="submitform">Yes</button>
													</div>
												</div>
											</div>
										</form>
									</div>
									
									<?php
								} else {
									//do notihing
								}
							}
							else if($type == "Mass Intention"){ 
								?>
								<div class="Event-grid-cont">
									<div><h1> Event: <?php echo $type?></h1></div>
									<div><h1> Date: <?php echo $formated_date?></h1></div>
								</div>
								<?php
								$intention = array("06:00:00","07:30:00","09:00:00","16:30:00","17:00:00", "18:00:00","18:10:00","19:15:00");
								$count_time = 0; ?>
								<form action="page_LANDING.php" method="post">
									<div><b>Time Available: </b></div>
									<div class="rd-cont">
										<?php 
											foreach ($intention as $i){
												if($day != "Sunday" && $day != "Saturday"){
													if($i == "18:00:00"){
														?><div style="margin-right: 4rem">
															<input type="radio" id="<?php echo 'rtime'.$count_time ?>" name="rdtime" value="<?php echo $i?>">
															<label for="<?php echo 'rtime'.$count_time ?>"><?php echo date("h:ia", strtotime($i)) ?></label><br>
														</div>
														<?php
													} 
												} else if($day == "Saturday"){
													if($i == "06:00:00" || $i == "17:00:00" || $i == "18:10:00" || $i == "19:15:00" ){
														?><div style="margin-right: 4rem">
															<input type="radio" id="<?php echo 'rtime'.$count_time ?>" name="rdtime" value="<?php echo $i?>">
															<label for="<?php echo 'rtime'.$count_time ?>"><?php echo date("h:ia", strtotime($i)) ?></label><br>
														</div>
														<?php
													} 
												} else if($day == "Sunday"){
													if($i != "18:10:00" && $i != "19:15:00" ){
														?><div style="margin-right: 4rem">
															<input type="radio" id="<?php echo 'rtime'.$count_time ?>" name="rdtime" value="<?php echo $i?>">
															<label for="<?php echo 'rtime'.$count_time ?>"><?php echo date("h:ia", strtotime($i)) ?></label><br>
														</div>
														<?php
													} 
												} else {
												}
												$count_time++;
											}
										?> 
									</div>
									<br>
									<b> Notes: </b>
									<ul><li>Mass Intention Fee: Donation</li></ul> <br>
									
									<div class="form-cont">
										<div class="form-content">
											<div class="grid-cont">
												<div class="input-box">
													<label for="contactNum"><strong>Contact Number*</strong></label>
													<div class="contactnum">
														<input type="text" name ="mobile1" value="+63" id="" disabled>
														<input type="tel" id="contactNum" name="contactNum" maxlength="10" placeholder="9123456789" onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57" pattern="[9]{1}[0-9]{9}" required><br>
													</div>
												</div>
												<div>
													<b> Purpose* </b>
													<div class="input-box">
														<div>
															<input type="radio" name="purposes" id="Thanksgiving" value="Thanksgiving">
															<label for="Thanksgiving">Thanksgiving</label><br>
														</div>
														<div>
															<input type="radio" name="purposes" id="Healing" value="Healing/Recovery">
															<label for="Healing">Healing/Recovery</label><br>
														</div>
														<div>
															<input type="radio" name="purposes" id="SpecialInt" value="Special Intention">
															<label for="SpecialInt">Special Intention</label><br>
														</div>
														<div>
															<input type="radio" name="purposes" id="Soul" value="Soul">
															<label for="Soul">Soul</label><br>
														</div>
													</div>
												</div>
											</div>
											<div>
												<div class="input-box">
													<label for="names"><strong>Name/s</strong></label>
													<textarea name="names" rows="3" style="resize: none" placeholder="Name/s of for whom the mass intention is for"></textarea>
												</div>
											</div>
											<br>
											<div class="lower-form">
														<div class="form-btnarea">
															<button class="buttonno" type="reset" class="clear" onclick="openForm(clearForm)" id="clear">Clear</button>
															<button class="buttonyes" type="button" class="submit" onclick="openForm(submitForm)" id="submit">Submit</button>
														</div>
													</div>
										</div>
									</div>
									
									<div class="popupCover" id="clearForm">
										<div class="popupForm">
											<div class="header-cont">
												<div class="icon-box"><i class="fa fa-question-circle" style="font-size: 4rem"></i></div>
												<div class="headertext-box">
													<h3>Are you sure you want to clear?</h3>
													<p>The information you entered will be discarded</p>
												</div>
											</div>
											<div class="form-btnarea">
												<button class="buttonno" type="button" onclick="openForm(clearForm)">No</button>
												<button class="buttonyes" type="reset" onclick="openForm(clearForm), clearReq()">Yes</button>
											</div>
										</div>
									</div>
									<div class="popupCover" id="submitForm">
										<div class="popupForm">
											<div class="header-cont">
												<div class="icon-box"><i class="fa fa-question-circle" style="font-size: 4rem"></i></div>
												<div class="headertext-box">
													<h3>Are you sure you want to submit?</h3>
													<p>Please ensure that your details are correct before submission to avoid any issues. After submission, your event schedule request will be submitted for approval.</p>
												</div>
											</div>
											<div class="form-btnarea">
												<button class="buttonno" type="button" onclick="openForm(submitForm)">No</button>
												<button class="buttonyes" type="Submit" name="submitform">Yes</button>
											</div>
										</div>
									</div>
								</form>
							
								<?php
							} 
										// BLESSINGS FORM
							else if ($type == "Blessing"){
								?> 
								<div class="Event-grid-cont">
									<div><h1> Event: <?php echo $type?></h1></div>
									<div><h1> Date: <?php echo $formated_date?></h1></div>
								</div>
								<form action="page_LANDING.php" method="post">
									<b> Notes: </b>
									<ul>
										<li>Since blessings are based on the priest's schedule, the church will contact you on the final time of your blessing.</li>
										<li>If scheduling a Car or Motorcycle Blessing, please bring your vehicle to the church at the agreed upon time.</li>
										<li>Blessing Fee: Donation</li>
									</ul>
									
									<div class="form-cont">
										<div class="form-content">
											<div class="grid-cont">
												<div class="input-box">
													<label for="contactNum"><strong>Contact Number*</strong></label>
													<div class="contactnum">
														<input type="text" name ="mobile1" value="+63" id="" disabled>
														<input type="tel" id="contactNum" name="contactNum" maxlength="10" placeholder="9123456789" onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57" pattern="[9]{1}[0-9]{9}" required><br>
													</div>
												</div>
											</div>
											<br>
											<div>
												<b> Type of Blessing* </b>
												<div class="grid-cont-four">
													<div class="input-box">
														<div>
															<input type="radio" id="HouseBlessing" name="blessingType" value="House Blessing" onclick="showDiv()" required>
															<label for="HouseBlessing">House Blessing </label> <br>
														</div>
													</div>
													<div class="input-box">
														<div>
															<input type="radio" id="CarBlessing" name="blessingType" value="Car Blessing" onclick="showDiv()" required>
															<label for="CarBlessing">Car Blessing </label> <br>
														</div>
													</div>
													<div class="input-box">
														<div>
															<input type="radio" id="MotorcycleBlessing" name="blessingType" value="Motorcycle Blessing" onclick="showDiv()" required>
															<label for="MotorcycleBlessing">Motorcycle Blessing </label> <br>
														</div>
													</div>
													<div class="input-box">
														<div>
															<input type="radio" id="StoreBlessing" name="blessingType" value="Store Blessing" onclick="showDiv()" required>
															<label for="StoreBlessing">Store Blessing </label> <br>
														</div>
													</div>
												</div>
												<div class="grid-cont-four">
													<div class="input-box" id="houseAddDiv" style="display: none">
														<div>
															<label for="address">House Address* </label> <br>
															<textarea id="addressHouse" rows="3" cols="30" style="resize: none" placeholder="9 Sampaguita St., Brgy. Pembo, Taguig City" name="address" required></textarea>
														</div>
													</div>
													<div class="input-box" id="emptyDiv1" style="display: none">
														<div>
														</div>
													</div>
													<div class="input-box" id="emptyDiv2" style="display: none">
														<div>
														</div>
													</div>
													<div class="input-box" id="emptyDiv3" style="display: none">
														<div>
														</div>
													</div>
													<div class="input-box" id="storeAddDiv"style="display: none">
														<div>
															<label for="address">Store Address* </label> <br>
															<textarea id="addressStore" rows="3" cols="30" style="resize: none" placeholder="9 Sampaguita St., Brgy. Pembo, Taguig City" name="address" required></textarea>
														</div>
													</div>
												</div>
											</div>
											<br>
											<div class="lower-form">
												<div class="form-btnarea">
													<button class="buttonno" type="reset" class="clear" onclick="openForm(clearForm)" id="clear">Clear</button>
													<button class="buttonyes" type="button" class="submit" onclick="openForm(submitForm)" id="submit">Submit</button>
												</div>
											</div>
										</div>
									</div>
									<div class="popupCover" id="clearForm">
										<div class="popupForm">
											<div class="header-cont">
												<div class="icon-box"><i class="fa fa-question-circle" style="font-size: 4rem"></i></div>
												<div class="headertext-box">
													<h3>Are you sure you want to clear?</h3>
													<p>The information you entered will be discarded</p>
												</div>
											</div>
											<div class="form-btnarea">
												<button class="buttonno" type="button" onclick="openForm(clearForm)">No</button>
												<button class="buttonyes" type="reset" onclick="openForm(clearForm), clearReq()">Yes</button>
											</div>
										</div>
									</div>
									<div class="popupCover" id="submitForm">
										<div class="popupForm">
											<div class="header-cont">
												<div class="icon-box"><i class="fa fa-question-circle" style="font-size: 4rem"></i></div>
												<div class="headertext-box">
													<h3>Are you sure you want to submit?</h3>
													<p>Please ensure that your details are correct before submission to avoid any issues. After submission, your event schedule request will be submitted for approval.</p>
												</div>
											</div>
											<div class="form-btnarea">
												<button class="buttonno" type="button" onclick="openForm(submitForm)">No</button>
												<button class="buttonyes" type="Submit" name="submitform">Yes</button>
											</div>
										</div>
									</div>
								</form>
									<?php
								} 
						} 
						else {
							//do nothing
						}
					?>

				</div>
				<?php if(isset($_SESSION['inserted'])){ 
					$message1 = $_SESSION['m1'];
					$message2 = $_SESSION['m2'];
					?>
					<div class="popupCover-message">
						<div class="popupMessage">
							<div class="header-cont">
								<div class="icon-box">
									<div> <i class="fa fa-check-circle" style="font-size: 4rem"></i> </div>
								</div>
								<div>
									<h3> <?php echo $message1?></h3>
									<p><?php echo $message2?> </p>
								</div>
							</div> 
							<div class="form-btnarea">
								<button type="button" class="buttonback" onclick="location.href='page_APPOINTMENTS.php'"> <b>View Appointments</b></button> </div>
							</div>
						</div>
					</div>
			 <?php unset($_SESSION['inserted']); }	?> 
            </section>
        </div>

        <!-- Reusable Footer -->
        <footer class="footer-wrapper">
            <div class="footer-logo">
                <div class="footer-logowrap">
                    <i class="fa-solid fa-church"></i> SJCP
                </div>
                <div class="footer-addwrap">
                    <span>Catholic Rectory, 9 Sampaguita St, Taguig, 1218 Kalakhang Maynila</span>
                    <span><i class="fa-solid fa-copyright"></i>All rights reserved.</span>
                </div>
            </div>
            <div class="footer-contact">
                <div class="foot-item">
                    <div class="foot-icon">
                        <i class="fa-brands fa-facebook"></i>
                    </div>
                    <div class="foot-info">
                        <span>St. John of the Cross Parish Pembo</span>
                    </div>
                </div>
                <div class="foot-item">
                    <div class="foot-icon">
                        <i class="fa-solid fa-phone"></i>
                    </div>
                    <div class="foot-info">
                        <span>Contact Number: 8527-7925</span>
                    </div>
                </div>
                <div class="foot-item">
                    <div class="foot-icon">
                        <i class="fa-solid fa-fax"></i>
                    </div>
                    <div class="foot-info">
                        <span>Fax: 7799-5429</span>
                    </div>
                </div>
                <div class="foot-item">
                    <div class="foot-icon">
                        <i class="fa-solid fa-envelope"></i>
                    </div>
                    <div class="foot-info">
                        <span>stjohn_ofthecrosspembo@yahoo.com</span>
                        <span>juandelacruzpembo@gmail.com</span>
                    </div>
                </div>
            </div>
        </footer>
    </div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/	2.1.1/jquery.min.js"></script>
	<script src="jsSCHEDULEEVENT.js"></script>
</body>

</html>
