<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styleHOME.css">
    <!-- Font Awesome Icon Script -->
    <script src="https://kit.fontawesome.com/678a3c402d.js" crossorigin="anonymous"></script>
    <title>The SJCP - Home</title>
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
                    if (isset($_SESSION['isValidEmail']) && $_SESSION['isValidEmail'] == false) {
                        echo '<span class="error-dialogue"> This email address is not connected to an account! Please double-check or register first.</span>';
                        echo "<script>openLogin();</script>";
                        unset($_SESSION['isValidEmail']);
                    } else if (isset($_SESSION['isValidPass']) && $_SESSION['isValidPass'] == false) {
                        echo '<span class="error-dialogue"> Your password is incorrect! Please try again.</span>';
                        unset($_SESSION['isValidPass']);
                        echo "<script>openLogin();</script>";
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
                <div onclick="window.location.href='page_HOME.php'" class="nav-item active">Home</div>
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
                <div class="nav-item dropdown">
                    <span class="dp-title">Events <i class="fa-solid fa-angle-down"></i></span>
                    <div class="dropdown-content">
                        <div onclick="window.location.href='page_VIEWANNOUNCEMENT.php'" class="nav-item">Announcements</div>
                        <div onclick="window.location.href='page_VIEWSCHEDULES.php'" class="nav-item">Available Time Slots</div>
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

        <!-- HOME content -->
        <div class="main-body-wrapper">
            <!-- slideshow wrapper -->
            <section class="slideshow-wrapper">
                <div class="img-slide img1 fade">
                    <div class="content">
                        <span>Welcome to St. John of the Cross Parish</span>
                        <p></p>
                    </div>
                </div>
                <div class="img-slide img2 fade">
                    <div class="content">
                        <h2>Resolve your concerns by viewing answers to frequently asked questions.</h2>
                        <button class="slidebtn" onclick="window.location.href='page_FAQ.php'">FAQs</button>
                    </div>
                </div>
                <div class="img-slide img3 fade">
                    <div class="content">
                        <h2>Looking for a church to hold your events? Learn more about what services we offer and more.</h2>
                        <button class="slidebtn" onclick="window.location.href='Services.php'">Services</button>
                    </div>
                </div>
                <div class="img-slide img4 fade">
                    <div class="content">
                        <h2>Stay updated about our events and available schedules.</h2>
                        <button class="slidebtn" onclick="window.location.href='page_VIEWANNOUNCEMENT.php'">Events</button>
                    </div>
                </div>
                <div class="img-slide img5 fade">
                    <div class="content">
                        <h2>Learn about our history and understand who our Reverend Father is.</h2>
                        <button class="slidebtn" onclick="window.location.href='Aboutus.php'">About Us</button>
                    </div>
                </div>
                <div class="dot-container">
                    <span class="dot"></span>
                    <span class="dot"></span>
                    <span class="dot"></span>
                    <span class="dot"></span>
                    <span class="dot"></span>
                </div>
                <span class="left" onclick="prevSlide()">
                    <i class="fa-solid fa-angle-left"></i>
                </span>
                <span class="right" onclick="showSlides()">
                    <i class="fa-solid fa-angle-right"></i>
                </span>
            </section>

            <!-- Address and anticipated mass schedule section -->
            <section class="detail-wrapper">
                <div class="detail-card">
                    <div class="sched-left">
                        <div>
                            <span><strong>Mass Schedule</strong></span>
                        </div>
                        <div class="sched-container">
                            <div class="infirst">
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
                            <div class="insecond">
                                <span><strong>Anticipated Masses</strong></span>
                                <span>Saturday:</span>
                                <span>5:00 PM - San Pancratio Chapel</span>
                                <span>6:10 PM - Fatima Chapel</span>
                                <span>7:15 PM - San Isidro Chapel</span>
                                <span>Sunday:</span>
                                <span>5:00 PM - Sto. Niño Chapel</span>
                            </div>
                        </div>
                        <button onclick="window.location.href='https://www.facebook.com/SJCPOfficial'">
                            View Live
                        </button>
                    </div>
                    <div class="location-right">
                        <span><strong>Location</strong></span>
                        <span>Catholic Rectory, 9 Sampaguita St, Taguig, 1218 Kalakhang Maynila</span>
                        <span><i class="fa-solid fa-location-dot" style="color: red;"></i></span>
                    </div>
                </div>
            </section>

            <!-- saint info section -->
            <section class="saintinfo-wrapper">
                <div class="saint-card">
                    <div class="saint-img">
                        <img src="Photos/delacruz.png" style="width: 100%; height: 100%;" alt="" srcset="">
                    </div>
                    <div class="saint-desc">
                        <span><strong>St. John of the Cross</strong></span>
                        <p>
                            St. John of the Cross, born as Juan de Yepes y Álvarez, was a Roman Catholic saint who
                            was a major figure of the Counter-Reformation. He was also a renowned mystic and a Carmelite
                            friar who is considered, along with Saint Teresa of Ávila, as a founder of the Discalced Carmelites.
                            Born into a family of descendents of Jewish converts to Christianity, John endured a very difficult
                            childhood. He lost his father early on in his life and grew up in abject poverty. John was sent to
                            a school for poor children where he studied Christian doctrine and also served as acolyte at a nearby
                            monastery of Augustinian nuns. On growing up he studied the humanities at a Jesuit school and went on
                            to enter the Carmelite Order, adopting the name John of St. Matthias. He was eventually ordained a
                            priest. The celebrated mystic, St. Teresa of Ávila solicited his help in the restoration of Carmelite
                            life to its original observance of austerity, and together they became the founders of the Discalced
                            Carmelites. St. John was also a poet and holds an important position in Spanish literature.
                        </p>
                    </div>
                </div>
            </section>

            <!-- church mission vision -->
            <section class="vismis-wrapper">
                <div class="mission-container">
                    <span><strong>Mission of the Parish:</strong></span>
                    <div class="contents">
                        <span>People of faith who received God’s calling to the Parish of St. John of the Cross, serve to achieve the following:</span>
                        <ol>
                            <li>Continuous study of the Word of God, live it and spread it in modern evangelization to be an example to others towards the kingdom of God in the context of the Small Christian Community. </li>
                            <li>Let the will of God be fulfilled to all by proper teaching, doing, administering and promoting all the parish programs.</li>
                            <li>Strengthen the good relationship between the Church, the community, and various Organizations in society in order to provide proper service, and meet the needs of the people, especially the poor.</li>
                            <li>Continue the renovation and upgrading of the church and chapels by having modern facilities that are tailored to the needs of the members of the Parish of St. John of the Cross.</li>
                        </ol>
                    </div>
                </div>
                <div class="vision-container">
                    <span><strong>Vision of the Archdiocese:</strong></span>
                    <div class="contents">
                        <p>
                            A country called by the Father to Jesus Christ to be a community of people with life events. Witnessing the reign of God living the Paschal Mystery in the power of the Holy Spirit along with the Blessed Mother, the Virgin Mary.
                        </p>
                    </div>
                    <span><strong>Vision of the Parish:</strong></span>
                    <div class="contents">
                        <p>
                            A faithful Christian community called by the Father, in communion with Jesus Christ and guided by the Holy Spirit to become a model of love for the word and deed rooted in deep faith, continually shaped by Christian wisdom,
                            and spreading the word of God in modern evangelization. A community thriving in all aspects of life, actively engaging with society towards the fulfillment of life with the help of Mother Mary and San Juan de la Cruz.
                        </p>
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
    <?php
    /*unset($_SESSION['isValidEmail']);
    unset($_SESSION['isValidPass']);*/
    ?>
    <script src="jsHOME.js"></script>
</body>

</html>