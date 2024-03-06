<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styleSERVICES.css">
    <!-- Font Awesome Icon Script -->
    <script src="https://kit.fontawesome.com/678a3c402d.js" crossorigin="anonymous"></script>
    <title>The SJCP - Services</title>
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
                        <span><a href="" target="_self" rel="noopener noreferrer">Forgot Password?</a></span>
                        <button type="submit" name="submit">Log-in</button>
                        <span>Don't have an account yet? <a href="" target="_self" rel="noopener noreferrer">Register Now</a></span>
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
        <!-- Filler Body - No need to Copy -->
        <div class="main-body-wrapper">
            <section class="main-content"> 
                <div class="main-content-title"> 
                    <h1> Church Services </h1>
                </div> 
            </section>
            <section class="main-content-body">
                <div class="main-content-services">
                    <div class="services-title" onclick="triggerServicesContent(service1)"> 
                        <b>Private Wedding <i>(Pribadong Kasal)</i> </b> 
                        <div class="services-icon">  
                            <i class="fa-solid fa-chevron-down"></i>
                        </div>
                    </div>
                    <div class="services-content" id="service1" style="background: url(Photos/privatewed.jpg)center/cover no-repeat;">
                        <div class="services-row"> 
                            <h3> Schedule: </h3>
                            <p>Tuesday to Saturday (9:00 AM, 10:30 AM, 2:00 PM, 3:30 PM)</p>
                            <br>
                            <h3> Requirements (for both Groom and Bride): </h3>
                            <p> 1. PSA Birth Certificate (Photocopy) 
                                <br>2. 2x2 ID picture  
                                <br>3. Photocopy of CENOMAR (Certificate of No Marriage)
                                <br>4. Baptismal Certificate (Original Copy) - with validity of 4 months prior to wedding and bears the notation "FOR MARRIAGE PURPOSES."
                                <br>5. Confirmation Certificate (Original Copy) - with validity of 4 months prior to wedding and bears the notation "FOR MARRIAGE PURPOSES."
                                <br>6. Publication of Wedding Banns - posted for 3 consecutive Sundays in the parishes where the couple resides.
                                <br>7. Pre-Cana Seminar - Every last Saturday of the month from 8:00 AM - 5:00 PM @ SJCP Conference Room
                                <br>8. Photocopy of Marriage License (from the City or Municipal Hall) / Marriage Contract (for Civilly Married couples) / Live-In License (for more than 5 years Live-In couples - from City Hall)
                                <br>11. Wedding Interview - to be scheduled and conducted by the SJCP Priest
                                <br>12. Confession
                                <br>13. Long Brown Envelope
                            </p>
                            <br>
                            <h3> Wedding Package: </h3>
                            <p> - Eucharist (Wedding Mass)
                                <br>- Tulle Decor (In the Sanctuary [Altar] and 10 pots along the nave)
                                <br>- Altar Candles (for candle sponsors)
                                <br>- Red Carpet
                                <br>- Choir (Mass and Pictorial)
                                <br>- Lighted Chandeliers
                                <br>- Availability of Church Staff as Wedding Coordinator
                                <br>- Use of Church for 1 Hour and 15 minutes
                                <br>- Civil Registration of Marriage Contract
                            </p>
                            <br>
                            <h3> Notes: </h3>
                            <p> - Maximum of eight (8) pairs of Principal Sponsors
                                <br>- Extra charge for video electrical consumption: Php 300.00 (per spotlight)
                            </p>
                        </div>
                    </div>
                </div>
            </section>
            <section class="main-content-body">
                <div class="main-content-services">
                <div class="services-title" onclick="triggerServicesContent(service2)"> 
                        <b>Communal Wedding <i>(Kasalang Parokya)</i> </b> 
                        <div class="services-icon">  
                            <i class="fa-solid fa-chevron-down"></i>
                        </div>
                    </div>
                    <div class="services-content" id="service2" style="background: url(Photos/masswed.jpg)center/cover no-repeat;">
                        <div class="services-row"> 
                            <h3> Schedule: </h3>
                            <p>To be announced</p>
                            <br>
                            <h3> Requirements (for both Groom and Bride): </h3>
                            <p> 1. PSA Birth Certificate (Photocopy) 
                                <br>2. 2x2 ID picture  
                                <br>3. Photocopy of CENOMAR (Certificate of No Marriage)
                                <br>4. Baptismal Certificate (Original Copy) - with validity of 4 months prior to wedding and bears the notation "FOR MARRIAGE PURPOSES."
                                <br>5. Confirmation Certificate (Original Copy) - with validity of 4 months prior to wedding and bears the notation "FOR MARRIAGE PURPOSES."
                                <br>6. Publication of Wedding Banns - posted for 3 consecutive Sundays in the parishes where the couple resides.
                                <br>7. Pre-Cana Seminar - Every last Saturday of the month from 8:00 AM - 5:00 PM @ SJCP Conference Room
                                <br>8. Photocopy of Marriage License (from the City or Municipal Hall) / Marriage Contract (for Civilly Married couples) / Live-In License (for more than 5 years Live-In couples - from City Hall)
                                <br>11. Wedding Interview - to be scheduled and conducted by the SJCP Priest
                                <br>12. Confession
                                <br>13. Long Brown Envelope
                            </p>
                            <br>
                            <h3> Notes: </h3>
                            <p> - Mass weddings are usually scheduled on the 2nd/3rd Saturday of May and December. Please check the Announcements Page for more details.
                                <br>- Mass weddings are free of charge.
                            </p>
                        </div>
                    </div>
                </div>
            </section>
            <section class="main-content-body">
                <div class="main-content-services">
                <div class="services-title" onclick="triggerServicesContent(service3)"> 
                        <b>Confirmation <i>(Kumpil)</i> </b> 
                        <div class="services-icon">  
                            <i class="fa-solid fa-chevron-down"></i>
                        </div>
                    </div>
                    <div class="services-content" id="service3" style="background: url(Photos/kumpil.jpg)center/cover no-repeat;">
                        <div class="services-row"> 
                            <h3> Schedule: </h3>
                            <p>To be announced</p>
                            <br>
                            <h3> Requirements: </h3>
                            <p> 1. PSA Birth Certificate (Photocopy) 
                            <br>2. Baptismal Certificate (Original Copy)
                            </p>
                            <br>
                            <h3> Notes: </h3>
                            <p> - Cut-off date for registration is one (1) month before the event.
                                <br>- Confirmations are usually scheduled on May and December. Please check the Announcements Page for more details.
                            </p>
                        </div>
                    </div>
                </div>
            </section>
            <section class="main-content-body">
                <div class="main-content-services">
                <div class="services-title" onclick="triggerServicesContent(service4)"> 
                        <b>Private Baptism <i>(Pribadong Binyag)</i> </b> 
                        <div class="services-icon">  
                            <i class="fa-solid fa-chevron-down"></i>
                        </div>
                    </div>
                    <div class="services-content" id="service4" style="background: url(Photos/solobap.jpg)center/cover no-repeat;">
                        <div class="services-row"> 
                            <h3> Schedule: </h3>
                            <p>Tuesday to Saturday (9:00 AM, 10:00 AM, 11:00 AM, 2:00 PM, 3:00 PM - Baptism Ceremony)</p>
                            <br>
                            <h3> Requirements: </h3>
                            <p> 1. Child's PSA Birth Certificate (Photocopy) 
                                <br>2. Marriage Contract of Parents (Photocopy) 
                                <br>3. Seminar (No Seminar, No Baptism)
                                <br>4. Baptismal Donation: Php 3,000.00
                            </p>
                            <br>
                            <h3> Note: </h3>
                            <p> - Included in the Baptism Package: Big Candle, Baptismal Cloth, 4 pcs. Guide, 2 pcs. Small Candle, and Unlimited Sponsors.
                                <br>- Parents and Sponsors are required to attend the seminar.
                                <br>- White dress or polo and pants for the child.
                                <br>- Any colors for the parents and sponsors.
                            </p>
                        </div>
                    </div>
                </div>
            </section>
            <section class="main-content-body">
                <div class="main-content-services">
                <div class="services-title" onclick="triggerServicesContent(service5)"> 
                        <b>Communal Baptism <i>(Parokyang Binyagan)</i> </b> 
                        <div class="services-icon">  
                            <i class="fa-solid fa-chevron-down"></i>
                        </div>
                    </div>
                    <div class="services-content" id="service5" style="background: url(Photos/massbap.jpg)center/cover no-repeat;">
                        <div class="services-row"> 
                            <h3> Schedule: </h3>
                            <p> Every Sunday Only</p>
                            <p>- 10:00 AM - Seminar</p>
                            <p>- 11:00 AM - Baptism Ceremony</p>
                            <br>
                            <h3> Requirements: </h3>
                            <p> 1. Child's PSA birth certificate (Photocopy) 
                                <br>2. Marriage Contract of Parents (Photocopy) 
                                <br>3. Seminar (No Seminar, No Baptism)
                                <br>4. Baptismal Donation: Not less than Php 500.00
                            </p>
                            <br>
                            <h3> Note: </h3>
                            <p> - Included in the Baptism Package: Big Candle, Baptismal Cloth, 4 pcs. Guide, 2 pcs. Small Candle, 1 Pair of Sponsor.
                                <br>- Additional Sponsor: Php 50.00 per head.
                                <br>- Parents and Sponsors are required to attend the seminar.
                                <br>- White dress or polo and pants for the child.
                                <br>- Any colors for the parents and sponsors.
                            </p>
                        </div>
                    </div>
                </div>
            </section>
            <section class="main-content-body">
                <div class="main-content-services">
                <div class="services-title" onclick="triggerServicesContent(service6)"> 
                        <b>Funeral Mass and Funeral Blessing <i>(Padasal at Basbas sa Patay)</i></b> 
                        <div class="services-icon">  
                            <i class="fa-solid fa-chevron-down"></i>
                        </div>
                    </div>
                    <div class="services-content" id="service6" style="background: url(Photos/funeral.jpg)center/cover no-repeat;">
                        <div class="services-row"> 
                            <h3> Schedule for Funeral Mass: </h3>
                            <p>Tuesday to Saturday (8:00 AM, 1:00 PM)</p>
                            <p>Sunday (1:00 PM)</p>
                            <br>
                            <h3> Requirements: </h3>
                            <p> 1. Death certificate (Photocopy)
                                <br>2. Funeral Mass Fee: Php 1,000.00
                                <br>3. Funeral Blessing Fee: Donation
                            </p>
                            <br>
                            <h3> Note: </h3>
                            <p> - Appointments for Funeral Blessings are accepted based on the priest's schedule from Tuesday to Sunday.
                            </p>
                        </div>
                    </div>
                </div>
            </section>
            <section class="main-content-body">
                <div class="main-content-services">
                <div class="services-title" onclick="triggerServicesContent(service7)"> 
                        <b>Mass Intention<i>(Intensyon ng Misa)</i></b> 
                        <div class="services-icon">  
                            <i class="fa-solid fa-chevron-down"></i>
                        </div>
                    </div>
                    <div class="services-content" id="service7" style="background: url(Photos/massintention.jpg)center/cover no-repeat;">
                        <div class="services-row"> 
                            <h3> Schedule: </h3>
                            <p>Monday to Friday</p>
                            <p>- 6:00 PM</p>
                            <p>Saturday</p>
                            <p>- 5:00 PM - San Pancratio Chapel</p>
                            <p>- 6:10 PM - Fatima Chapel</p>    
                            <p>- 7:15 PM - San Isidro Chapel</p>
                            <p>Sunday</p>
                            <p>- 6:00 AM - Tagalog <br>
                                - 7:30 AM - English <br>
                                - 9:00 AM - Children's Mass <br>
                                - 4:30 PM - Tagalog <br>
                                - 5:00 PM - Sto. Nino Chapel <br>
                                - 6:00 PM - Youth and Adult Mass <br>
                            </p>
                            <br>
                            <h3> Purposes: </h3>
                            <p> - Thanksgiving
                                <br>- Healing and Recovery
                                <br>- Special Intention
                                <br>- Soul
                            </p>
                            <br>
                            <h3> Note: </h3>
                            <p> - Mass Intention Fee: Donation
                            </p>
                        </div>
                    </div>
                </div>
            </section>
            <section class="main-content-body">
                <div class="main-content-services">
                <div class="services-title" onclick="triggerServicesContent(service8)"> 
                        <b>Blessing <i>(Basbas)</i></b> 
                        <div class="services-icon">  
                            <i class="fa-solid fa-chevron-down"></i>
                        </div>
                    </div>
                    <div class="services-content" id="service8" style="background: url(Photos/blessing.jpg)center/cover no-repeat;">
                        <div class="services-row"> 
                            <h3> Schedule: </h3>
                            <p>Tuesday to Saturday (8:00 AM-5:00 PM)</p>
                            <br>
                            <h3> Types of Blessing: </h3>
                            <p> - House Blessing
                                <br>- Car Blessing
                                <br>- Motorcycle Blessing
                                <br>- Store Blessing
                            </p>
                            <br>
                            <h3> Note: </h3>
                            <p> - Appointments for blessings are accepted based on the priest's schedule.
                                <br>- Blessing Fee: Donation
                            </p>
                        </div>
                    </div>
                </div>
            </section>
            <section class="main-content-body">
                <div class="main-content-services">
                <div class="services-title" onclick="triggerServicesContent(service9)"> 
                        <b>Document Request <i>(Paghingi ng Dokumento)</i></b> 
                        <div class="services-icon">  
                            <i class="fa-solid fa-chevron-down"></i>
                        </div>
                    </div>
                    <div class="services-content" id="service9" style="background: url(Photos/docureq.jpg)center/cover no-repeat;">
                        <div class="services-row"> 
                            <h3> Schedule: </h3>
                            <p>Tuesday to Saturday (8:00-11:30 AM || 1:30-5:00 PM)</p>
                            <p>Sunday (8:00-12:00 NN) </p>                            
                            <br>
                            <h3> Types of Documents: </h3>
                            <p> - Baptismal Certificate - Php 100.00
                                <br>- Confirmation Certificate - Php 100.00
                                <br>- Wedding Certificate - Php 100.00
                                <br>- Good Moral Certificate - Php 100.00
                                <br>- Banns and Permit - Php 300.00
                                <br>- Permit and No Record - Php 100.00
                            </p>
                            <br>
                            <h3> Note: </h3>
                            <p> - Banns and Permit are provided three weeks after publication.
                                <br>- Other documents can be claimed one day after the request's approval on the website.
                                <br>- Another person may claim your document as long as they have a copy of your valid ID and an authorization letter.
                            </p>
                        </div>
                    </div>
                </div>
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
    <script src="jsSERVICES.js"></script>
</body>

</html>