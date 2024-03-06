<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styleABOUTUS.css">
    <!-- Font Awesome Icon Script -->
    <script src="https://kit.fontawesome.com/678a3c402d.js" crossorigin="anonymous"></script>
    <title>The SJCP - About Us</title>
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
                        <div onclick="window.location.href='page_SERVICES.php'" class="nav-item">
                            Services
                        </div>
                        <div class="nav-item active" <?php if (!isset($_SESSION['isLoggedIn']) || $_SESSION['isLoggedIn'] == false) {
                                                    echo 'onclick="openLogin()"';
                                                }
												else { ?>
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
                <div onclick="window.location.href='page_ABOUTUS.php'" class="nav-item active">About Us</div>
                <?php
                if (!isset($_SESSION['isLoggedIn']) || $_SESSION['isLoggedIn'] == false) {
                    echo '<div class="nav-item" onclick="openLogin()">Login</div>';
                } else if ($_SESSION['isLoggedIn'] == true) {
                    echo '<div class="nav-item dropdown">' ?>
                    <span class="dp-title">Profile <i class="fa-solid fa-angle-down"></i></span>
                    <div class="dropdown-content">
                        <div onclick="window.location.href='page_PROFILE.php'" class="nav-item">Profile</div>
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
        <!-- Filler Body - No need to Copy -->
        <div class="main-body-wrapper">
            <section class="main-content-start" style="background: linear-gradient(to bottom right, rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)), url(Photos/EDITED.jpg) center/cover no-repeat;">
                <div class ="content-history">
                    <h3>HISTORY</h3>
                    <p> The Parish of Saint John of the Cross, established on March 18, 1992, encompasses Barangays Pembo and Rizal in Makati. 
                        The church was located on the corner of Hasmin and Sampaguita Streets in Pembo. 
                        On July 30, 1999 a parish resolution affecting the start of the construction of a new Parish Church was passed and approved 
                        by the members of the Parish Pastoral Council, and the cornerstone was laid on August 2, 1999, with the presence of His Eminence Jaime Cardinal Sin, 
                        Archbishop of Manila. The parish, originating in the 1950's with members of the Scout Rangers Regiment, 
                        evolved from Panther's Enlisted Men's Barrio (PEMBO) into the largest barrio in Fort Bonifacio by the 1960s. 
                        Initially part of Mater Dolorosa Parish in 1987 brought significant changes to the community.
                    </p>
                </div>
            </section>
            <hr>
            <section class="main-content-end" >
                <div class ="content-history">
                    <h3>HISTORY</h3>
                    <p> PEMBO, COMEMBO and EAST REMBO were included in the territory of the new Parish. 
                        The new Parish was placed under the care of Amigonian fathers and Brothers with Rev. Fr. Donato Gatto as its first Parish Priest. 
                        PEMBO became the Chaplaincy of Saint Joseph the Worker in 1991. The conversion to the Parish of Saint John of 
                        the Cross took place on March 18, 1992, with Fr. Fernando S. Canicula as the appointed parish priest on March 24, 1992. 
                        In October 1996, the Basic Ecclesial Communities were formed in the parish. The first street mass was held on December 4 of the same year. 
                        Over the years (1992-2000), the parish witnessed the initiation of various religious practices, celebrations, and activities, including the 
                        formation of Basic Ecclesial Communities and participation in World Youth Day. 
                    </p>
                </div>
            </section>
            <hr>
            <section class="main-content-start" style="background: linear-gradient(to bottom right, rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)), url(Photos/aboutus4.jpg) center/cover no-repeat;">
                <div class ="content-history">
                    <h3>HISTORY</h3>
                    <p> In 1996, PEMBO was split into two barangays—PEMBO and RIZAL—while a change in leadership occurred on August 15, 1998, with Rev. Fr. Andy Ortega Lim succeeding Fr. Canicula. 
                            The parish continued to evolve with the formulation and approval of Mission and Vision Statements in June 1999. 
                            The year of the Jubilee was welcomed with great hopes by our parish. Various events in the Jubilee year were attended and participated by the people. 
                            It was also the start of the submission of plans and calendar of activities for the entire year. In 2000, it brought several memorable events, including fundraising projects, 
                            the visit of the Jubilee Cross, and the formation of the Charismatic Movement, showcasing the vibrant growth and development of the Parish of Saint John of the Cross.
                    </p>
                </div>
            </section>
            <section class = "main-content-priest">
                <div class = "content-priest">
                    <div class = "priest-img-cont"> <img src="Photos/FR.jpg" alt="priest" width="100%"></div>
                    <div class = "priest-desc-cont">
                        <h2> About the priest</h2>
                        <p>Rev. Fr. Clarito "Charlie" M. Jundis started preaching at St. John of the Cross Parish on November 23, 2022. 
                            Before preaching at there, he was preaching in America where started his journey of priesthood back in 1978.
                             He has been a priest for 46 years and is a builder, responsible for constructing the beautiful church of 
                             Sto. Niño de Taguig Parish. He is the first priest to initiate the construction of the church and is the founder 
                             of Sto. Niño de Taguig Catholic Church. 
                        </p>
                    </div>
                </div>
            </section>
            <section class="main-content-map">
                <div class = "content-map">
                    <div>
                        <h2> Map (Google Maps)</h2>
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3861.952147477856!2d121.05812207465668!3d14.544729178442969!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397c893b4f02ca1%3A0x571d8fe4a87168cf!2s9%20Sampaguita%20St%2C%20Taguig%2C%201218%20Metro%20Manila!5e0!3m2!1sen!2sph!4v1700128810775!5m2!1sen!2sph" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
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
    <script src="jsABOUTUS.js"></script>
</body>

</html>