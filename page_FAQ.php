<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styleFAQ.css">
    <!-- Font Awesome Icon Script -->
    <script src="https://kit.fontawesome.com/678a3c402d.js" crossorigin="anonymous"></script>
    <title>The SJCP - FAQs </title>
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
                <div onclick="window.location.href='page_FAQ.php'" class="nav-item active">FAQs</div>
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
            <section class="main-content"> 
                <div class="main-content-title"> 
                    <h1> Frequently Asked Question/s </h1>
                </div> 
            </section>
            <section class="main-content-body">
                <div class="main-content-services">
                    <div class="services-title" onclick="triggerServicesContent(service1)"> 
                        <b>What are your office hours?</b>
                        <div class="services-icon">  
                            <i class="fa-solid fa-chevron-down"></i>
                        </div>
                    </div>
                    <div class="services-content" id="service1">
                        <div class="services-row"> 
                            <span>Monday: No office</span>
                            <span>Tuesday - Saturday: 8:00 - 11:30 AM | 1:30 - 5:00 PM</span>
                            <span>Sunday: 8:00 AM - 12:00 NN</span>
                        </div>
                    </div>
                </div>
                <div class="main-content-services">
                    <div class="services-title" onclick="triggerServicesContent(service2)"> 
                        <b>Do you entertain walk-in appointments?</b>
                        <div class="services-icon">  
                            <i class="fa-solid fa-chevron-down"></i>
                        </div>
                    </div>
                    <div class="services-content" id="service2">
                        <div class="services-row"> 
                            <span>Yes, we do! However, those who make appointments online will be prioritized over walk-ins. </span>
                        </div>
                    </div>
                </div>
                <div class="main-content-services">
                    <div class="services-title" onclick="triggerServicesContent(service3)"> 
                        <b>What are the schedules of the daily masses?</b>
                        <div class="services-icon">  
                            <i class="fa-solid fa-chevron-down"></i>
                        </div>
                    </div>
                    <div class="services-content" id="service3">
                        <div class="services-row"> 
                            <div class="mass-sched">
                                <div class="parish-masses">
                                    <span><strong>St. John of the Cross Parish Masses</strong></span>
                                    <span>Monday - Friday: 6:00 PM</span>
                                    <span>Saturday: 6:00 AM</span>
                                    <span>Sunday:</span>
                                    <span>6:00 AM - Tagalog</span>
                                    <span>7:30 AM - English</span>
                                    <span>9:00 AM - Children’s Mass</span>
                                    <span>4:30 PM - Tagalog</span>
                                    <span>6:00 PM - Youth and Young Adult Mass</span>
                                </div>
                                <div class="chapel-masses">
                                    <span><strong>Masses at Partner Chapels</strong></span>
                                    <span>Saturday:</span>
                                    <span>5:00 PM - San Pancratio Chapel</span>
                                    <span>6:10 PM - Fatima Chapel</span>
                                    <span>7:15 PM - San Isidro Chapel</span>
                                    <span>Sunday:</span>
                                    <span>5:00 PM - Sto. Niño Chapel</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="main-content-services">
                    <div class="services-title" onclick="triggerServicesContent(service4)"> 
                        <b>How can I set appointments online?</b>
                        <div class="services-icon">  
                            <i class="fa-solid fa-chevron-down"></i>
                        </div>
                    </div>
                    <div class="services-content" id="service4">
                        <div class="services-row"> 
                            <span>1. First, visit our <a href="page_VIEWCHEDULES.php">Calendar</a> under the Events tab to view the available dates and times.</span>
                            <span>2. Next, go to our <a href="page_SCHEDULEEVENT.php">Set Appointents</a> page and select the type of appointment you want to make.</span>
                            <span>3. Fill out the corresponding form and take note of the requirements and notes displayed for your appointment.</span>
                            <span>4. Confirm your details and submit the form.</span>
                            <span>5. Wait for 1-3 business days for updates regarding your appointment. Updates could be seen in the View Appointments page under our Services tab and also sent to your email address.</span>
                        </div>
                    </div>
                </div>
                <div class="main-content-services">
                    <div class="services-title" onclick="triggerServicesContent(service5)"> 
                        <b>What services do you offer? What requirements are needed for those services?</b>
                        <div class="services-icon">  
                            <i class="fa-solid fa-chevron-down"></i>
                        </div>
                    </div>
                    <div class="services-content" id="service5">
                        <div class="services-row"> 
                            <p>We offer the following services in our church: private and mass weddings; mass confirmations; private and mass baptisms; funeral masses and blessings; mass intentions;
                                house, car, and motorcycle blessings; and document requests for baptismal, wedding, confirmation, and good moral certificates, and permit and no records. To view the
                                requirements for a specific service, please check out our <a href="Services.php">Services page</a>.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="main-content-services">
                    <div class="services-title" onclick="triggerServicesContent(service6)"> 
                        <b>Who can avail your services?</b>
                        <div class="services-icon">  
                            <i class="fa-solid fa-chevron-down"></i>
                        </div>
                    </div>
                    <div class="services-content" id="service6">
                        <div class="services-row"> 
                            <p>Anyone, including non-Pembo and Rizal residents, can avail our services.</p>
                        </div>
                    </div>
                </div>
                <div class="main-content-services">
                    <div class="services-title" onclick="triggerServicesContent(service7)"> 
                        <b>Can I have someone else claim my document on my behalf?</b>
                        <div class="services-icon">  
                            <i class="fa-solid fa-chevron-down"></i>
                        </div>
                    </div>
                    <div class="services-content" id="service7">
                        <div class="services-row"> 
                            <span>
                                Yes, another person may claim your document as long as they have a copy of your valid ID
                                and an authorization letter saying that you are allowing this person to claim your document.
                            </span>
                        </div>
                    </div>
                </div>
                <div class="main-content-services">
                    <div class="services-title" onclick="triggerServicesContent(service8)"> 
                        <b>Where is the church located?</b>
                        <div class="services-icon">  
                            <i class="fa-solid fa-chevron-down"></i>
                        </div>
                    </div>
                    <div class="services-content" id="service8">
                        <div class="services-row"> 
                            <span>
                                We are located at <a href="https://www.google.com/maps/place/Saint+John+of+the+Cross+Parish/@14.5457358,121.0602532,18.44z/data=!4m6!3m5!1s0x3397c856c8cbba23:0x2635dc1bb8337aa6!8m2!3d14.5457731!4d121.0614389!16s%2Fg%2F1tdwmmjl?entry=ttu"> 
                                    Catholic Rectory, 9 Sampaguita St, Brgy. Pembo, Taguig City, 1218 Kalakhang Maynila</a>.
                                Nearby landmarks are Ospital ng Makati, Pembo Elementary School, and St. Therese Hospital..
                            </span>
                        </div>
                    </div>
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
                        <span onclick="window.location.href='https://www.facebook.com/SJCPOfficial'">St. John of the Cross Parish Pembo</span>
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
    <script src="jsFAQS.js"></script>
</body>

</html>