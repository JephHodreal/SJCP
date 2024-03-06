<?php
session_start();
require 'dbconnect.php';
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
    <title>The SJCP - View Available Time Slots</title>
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
                            <input type="password" name="user_pass" id="password" required>
                            <i class="fa-solid fa-eye" id="icon" onclick="toggle(password,icon)"></i>
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
                <div class="nav-item dropdown">
                    <span class="dp-title">Services <i class="fa-solid fa-angle-down"></i></span>
                    <div class="dropdown-content">
                        <div onclick="window.location.href='page_SERVICES.php'" class="nav-item active">
                            Services
                        </div>
                        <div class="nav-item" <?php if (!isset($_SESSION['isLoggedIn']) || $_SESSION['isLoggedIn'] == false) {
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
                <div class="nav-item dropdown active">
                    <span class="dp-title">Events <i class="fa-solid fa-angle-down"></i></span>
                    <div class="dropdown-content">
                        <div onclick="window.location.href='page_VIEWANNOUNCEMENT.php'" class="nav-item">Announcements</div>
                        <div onclick="window.location.href='page_VIEwSCHEDULES.php'" class="nav-item active">Available Time Slots</div>
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
                        <div class="popupForm">
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
				<h1 class="main-content-title">View Available Time Slots</h1>
			</section>
            <section class="main-content">
                <!--<div class="main-header">
                    <span><strong>Set Schedules</strong></span>
                </div>-->
                <div class="schedule-container">
                    <div class="events-preference">
				
						<!-- SELECT EVENT AND DATE FORM -->
						<form action="page_VIEWSCHEDULES.php" method="post">
							<div class="select-cont">
								<?php 
									if(!isset($_POST["submit"])){
										?> <div class="events-select-container" id="events-select-container" style="display:flex">
												<label for="ddEvent"><strong> Select to Appoint: </strong></label>
												<select class="dropdown" id="ddEvent" name="ddEvent" onchange="chooseEventView()">
													<option value="default" disabled selected hidden></option>
													<option value="Special Event">Special Event</option>											
													<option value="Mass Intention">Mass Intention</option>
													<option value="Blessing">Blessing</option>
												</select>
											</div> <?php
									} else {
										?> <div class="events-select-container" id="events-select-container" style="display:none">
												<label for="ddEvent"><strong> Select to Appoint: </strong></label>
												<select class="dropdown" id="ddEvent" name="ddEvent" onchange="chooseEventView()">
													<option value="default" disabled selected hidden></option>
													<option value="Special Event">Special Event</option>											
													<option value="Mass Intention">Mass Intention</option>
													<option value="Blessing">Blessing</option>
												</select>
											</div> <?php
									}
									?>
									<div class="events-select-container" id="specificSpecial" style="display: none;">
										<label for="ddSpecialEvent"><strong>Select Special Event:</strong></label>
										<select class="dropdown" id="ddSpecialEvent" name="Event" onchange="openCalendarSpeView();">
											<option value="" disabled selected hidden>Special Events</option>
											<option value="Wedding">Private Wedding</option>
											<option value="Baptism">Private Baptism</option>
											<option value="Funeral Mass/Blessing">Funeral Mass/Blessing</option>
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
											<input type="date" id="calDateFuner" name="calDateFuner" min="<?= date('Y-m-d', strtotime('+3 days')); ?>" max="<?= date('Y-m-d', strtotime('+6 weeks')); ?>" required>
										</div>
									</div>
									<div class="events-select-container" id="chooseCalIntBless" style="display: none">
										<div class="cal-container">
											<label for="calDateIntBless"><strong>Select Date:</strong></label>
											<input type="date" id="calDateIntBless" name="calDateIntBless" min="<?= date('Y-m-d', strtotime('+1 day')); ?>" max="<?= date('Y-m-d', strtotime('+6 months')); ?>" required>
										</div>
									</div>
									<div class="events-select-container" id="submitButton" style="display: none">
										<div class="cal-container">
											<button type="submit" value="submit" name="submit" id="submitbtn"> View Available Time</button>
										</div>
									</div>
							</div>
						</form>

						<?php
							if(isset($_POST["submit"])){
								?>
								<div class="back-icon-cont" onclick="location.href='page_VIEWSCHEDULES.php'">
									<i class="fa-solid fa-arrow-left"> Back </i>
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
									
									<div> <strong> Select Available Time:</strong> </div>
									<div class="avtime-container">
										<?php
											$event_endtime = "";
											$_SESSION['eventendtime'] = $event_endtime;
											if(count($avtime) == 0){
												echo "No Available Time Slots";
											} else {
												foreach ($avtime as $i){
													for($y = 0; $y < count($weddingst); $y++){
														if(strtotime($i) == strtotime($weddingst[$y])){
															$event_endtime = $weddinget[$y];
														}
													}
													?><div>
														<input type="radio" id="<?php echo 'rtime'.$count_time ?>" name="rdtime" value="<?php echo $i." ".$event_endtime?>" required>
														<label for="<?php echo 'rtime'.$count_time ?>"><?php echo date("h:ia", strtotime($i)) ?></label><br>
													</div>
													<?php
													$count_time++;
												}
											}
									
										?> 
									</div>
									
									<div class="contents-cont">
										<div class="req-cont">
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
									</div>
									<?php
								}
								
								// BAPTISM FORM
								else if($event == "Baptism"){ ?> 
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
										<form action="page_ViewAvailableTimeSlots.php">
											<div> <strong> Select Available Time:</strong> </div>
											<div class="avtime-container">
												<?php
													$event_endtime = "";
													if(count($avtime) == 0){
														echo "No Available Time Slots";
													} else {
														foreach ($avtime as $i){
															for($y = 0; $y < count($baptismst); $y++){
																if(strtotime($i) == strtotime($baptismst[$y])){
																	$event_endtime = $baptismet[$y];
																}
															}
															?><div>
																<input type="radio" id="<?php echo 'rtime'.$count_time ?>" name="rdtime" value="<?php echo $i." ". $event_endtime?>">
																<label for="<?php echo 'rtime'.$count_time ?>"><?php echo date("h:ia", strtotime($i)) ?></label><br>
															</div>
															<?php
															$count_time++;
														}
													}
											
												?> 
											</div>
											<div class="req-cont">
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
											</div>
										</form>
									<?php
								}
								
								// FUNERAL MASS AND BLESSING FORM
								else if($event == "Funeral Mass/Blessing"){
									?>
									<form action="page_ViewAvailableTimeSlots.php">
										
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
														echo "No Available Time Slots";
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
														}
													}
												?> 
											</div>

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
									</form>
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
										if(count($intention) == 0){
											echo "No Available Time Slots";
										} else {
											foreach ($intention as $i){
												if($day != "Sunday" && $day != "Saturday"){
													if($i == "18:00:00"){
														?><div>
															<input type="radio" id="<?php echo 'rtime'.$count_time ?>" name="rdtime" value="<?php echo $i?>">
															<label for="<?php echo 'rtime'.$count_time ?>"><?php echo date("h:ia", strtotime($i)) ?></label><br>
														</div>
														<?php
													} 
												} else if($day == "Saturday"){
													if($i == "06:00:00" || $i == "17:00:00" || $i == "18:10:00" || $i == "19:15:00" ){
														?><div>
															<input type="radio" id="<?php echo 'rtime'.$count_time ?>" name="rdtime" value="<?php echo $i?>">
															<label for="<?php echo 'rtime'.$count_time ?>"><?php echo date("h:ia", strtotime($i)) ?></label><br>
														</div>
														<?php
													} 
												} else if($day == "Sunday"){
													if($i != "18:10:00" && $i != "19:15:00" ){
														?><div>
															<input type="radio" id="<?php echo 'rtime'.$count_time ?>" name="rdtime" value="<?php echo $i?>">
															<label for="<?php echo 'rtime'.$count_time ?>"><?php echo date("h:ia", strtotime($i)) ?></label><br>
														</div>
														<?php
													} 
												} else {
												}
												$count_time++;
											}
										}
									?> 
								</div>
								<b> Notes: </b>
								<ul> Mass Intention Fee: Donation </ul>
								<ul> You may give your donation before or after the mass. </ul>
								<?php
							} 
					// BLESSINGS FORM
							else if ($type == "Blessing"){
								?> 
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
								<form action="page_LANDING.php" method="post">
									<b> Notes: </b>
									<ul> Since blessings are based on the priest's schedule, the church will contact you on the final time of your blessing. </ul>
									<ul> If scheduling a Car or Motorcycle Blessing, please bring your vehicle to the church at the agreed upon time. </ul>
									<ul> Blessing Fee: Donation </ul>
								</form>
									<?php
								} 
						} 
						else {
							//do nothing
						}
					?>

				</div>
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
    <script src="jsSCHEDULEEVENT.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
</body>

</html>