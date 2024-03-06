<?php
session_start();
require 'dbconnect.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styleVIEWANNOUNCEMENTS.css">
    <!-- Font Awesome Icon Script -->
    <script src="https://kit.fontawesome.com/678a3c402d.js" crossorigin="anonymous"></script>
    <title>The SJCP - Announcements</title>
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
                        <div onclick="window.location.href='page_VIEWANNOUNCEMENT.php'" class="nav-item active">Announcements</div>
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

    <div class="main-body-wrapper">
        <section class="main-header"> 
            <div class="main-header-title"> 
                <h1> View Announcements </h1>
            </div> 
        </section>
        <section class="main-content">
        <?php
            $queryview = "SELECT * FROM announcement_details ORDER BY event_date ASC";
            $resultview = mysqli_query($conn, $queryview);
        ?>
            <div class="view-cont"> 
                <div class="view-header">

                </div>
                <div class="view-grid">
                    <?php
                    if(mysqli_num_rows($resultview) != 0) {
                        while ($row = mysqli_fetch_array($resultview)) { ?>
                            <div class="view-box">
                                <div class="image-cont">
                                    <img src="Photos/<?php echo $row[1]?>" alt="announcementImage.jpg">
                                </div>
                                <div class="desc-cont">
                                    <div class="date-cont">
                                        <?php 
                                            $formateddate = date("F", strtotime($row[3]));
                                            $formatedDay = date("d", strtotime($row[3]));
                                            $formatedYear = date("Y", strtotime($row[3]));
                                        ?>
                                        <span><?php echo $formateddate; ?></span>
                                        <span><?php echo $formatedDay; ?></span>
                                        <span><?php echo $formatedYear; ?></span>
                                    </div>
                                    <div class="details-cont">
                                        <b><?php echo $row[2]?></b>
                                        <p><?php echo $row[5]?></p>
                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                    } else { ?>
                        <div class="view-box">
                            
                        </div>
                        <div class="view-box" style="align-items: center">
                            <h2>No Announcements</h2>
                        </div>
                        <div class="view-box">
                            
                        </div>
                        <?php
                    }
                    ?>
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
    <script src="jsVIEWANNOUNCEMENTS.js"></script>
</body>
</html>