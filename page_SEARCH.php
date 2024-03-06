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
    <link rel="stylesheet" href="styleSEARCH.css">
    <!-- Font Awesome Icon Script -->
    <script src="https://kit.fontawesome.com/678a3c402d.js" crossorigin="anonymous"></script>
    <title>The SJCP - Search Records</title>
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
                        <div onclick="window.location.href='page_SEARCH.php'" class="nav-item active" <?php if (!isset($_SESSION['isLoggedIn']) || $_SESSION['isLoggedIn'] == false) {
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
                <div onclick="window.location.href='Aboutus.php'" class="nav-item">About Us</div>
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

        <!-- SEARCH content -->
        <div class="main-body-wrapper">
            <section class="main-content">
                <div class="left-cont">
                    <div class="left-heading">Search Record</div>
                    <div class="form-cont">
                        <form action="" method="post">
                            <div class="inner">
                                <span>Last Name&nbsp<small>(Required)</small></span>
                                <input type="text" name="findln" id="" required>
                            </div>
                            <div class="inner">
                                <span>First Name&nbsp<small>(Required)</small></span>
                                <input type="text" name="findfn" id="" required>
                            </div>
                            <div class="inner">
                                <span>Middle Name</span>
                                <input type="text" name="findmn" id="">
                            </div>
                            <div class="inner">
                                <span>Birthdate</span>
                                <input type="date" name="findday" id="">
                            </div>
                            <button type="submit" name="searchREC"><i class="fa-solid fa-magnifying-glass"></i>&nbspFind</button>
                        </form>
                    </div>
                </div>
                <div class="right-cont">
                    <?php
                    $fn = "";
                    $ln = "";
                    $mn = "";
                    $day = "";
                    ?>
                    <?php if (!isset($_POST['searchREC'])) { ?>
                        <div class="no-res">
                            <i class="fa-solid fa-magnifying-glass"></i>
                            <span>It looks like you haven't made a search yet!</span>
                        </div>
                    <?php } else if (isset($_POST['searchREC'])) {
                        $fn = $_POST['findfn'];
                        $ln = $_POST['findln'];
                        if (strlen($_POST['findmn']) == 0 && strlen($_POST['findday']) == 0) {
                            $bapsql = "SELECT COUNT(*) as total FROM record_baptism_details WHERE lastName='$ln' AND firstName='$fn'";
                            $consql = "SELECT COUNT(*) as total FROM record_confirmation_details WHERE lastName = '$ln' AND firstName = '$fn'";
                            $wedsql = "SELECT COUNT(*) as total FROM record_wedding_details WHERE groom_lastName = '$ln' AND groom_firstName = '$fn' OR bride_lastName = '$ln' AND bride_firstName = '$fn'";
                            $funsql = "SELECT COUNT(*) as total FROM record_funeral_details WHERE lastName = '$ln' AND firstName = '$fn'";
                        } else if (strlen($_POST['findmn']) > 0) {
                            $mn = $_POST['findmn'];
                            if (strlen($_POST['findday']) > 0) {
                                $day = $_POST['findday'];
                                $age = (date('Y') - date('Y', strtotime($day)));
                                $bapsql = "SELECT COUNT(*) as total FROM record_baptism_details WHERE lastName = '$ln' AND firstName = '$fn' AND middleName = '$mn' AND dob = '$day'";
                                $consql = "SELECT COUNT(*) as total FROM record_confirmation_details WHERE lastName = '$ln' AND firstName = '$fn' AND middleName = '$mn' AND dob = '$day'";
                                $wedsql = "SELECT COUNT(*) as total FROM record_wedding_details WHERE groom_lastName = '$ln' AND groom_firstName = '$fn' AND groom_middleName = '$mn' AND groom_dob = '$day' OR bride_lastName = '$ln' AND bride_firstName = '$fn' AND bride_middleName = '$mn' AND bride_dob = '$day'";
                                $funsql = "SELECT COUNT(*) as total FROM record_funeral_details WHERE lastName = '$ln' AND firstName = '$fn' AND middleName = '$mn' AND age = '$age'";
                            } else {
                                $bapsql = "SELECT COUNT(*) as total FROM record_baptism_details WHERE lastName = '$ln' AND firstName = '$fn' AND middleName = '$mn'";
                                $consql = "SELECT COUNT(*) as total FROM record_confirmation_details WHERE lastName = '$ln' AND firstName = '$fn' AND middleName = '$mn'";
                                $wedsql = "SELECT COUNT(*) as total FROM record_wedding_details WHERE groom_lastName = '$ln' AND groom_firstName = '$fn' AND groom_middleName = '$mn' OR bride_lastName = '$ln' AND bride_firstName = '$fn' AND bride_middleName = '$mn'";
                                $funsql = "SELECT COUNT(*) as total FROM record_funeral_details WHERE lastName = '$ln' AND firstName = '$fn' AND middleName = '$mn'";
                            }
                        } else if (strlen($_POST['findday']) > 0) {
                            $day = $_POST['findday'];
                            $age = (date('Y') - date('Y', strtotime($day)));
                            if (strlen($_POST['findmn']) > 0) {
                                $mn = $_POST['findmn'];
                                $bapsql = "SELECT COUNT(*) as total FROM record_baptism_details WHERE lastName = '$ln' AND firstName = '$fn' AND middleName = '$mn' AND dob = '$day'";
                                $consql = "SELECT COUNT(*) as total FROM record_confirmation_details WHERE lastName = '$ln' AND firstName = '$fn' AND middleName = '$mn' AND dob = '$day'";
                                $wedsql = "SELECT COUNT(*) as total FROM record_wedding_details WHERE groom_lastName = '$ln' AND groom_firstName = '$fn' AND groom_middleName = '$mn' AND groom_dob = '$day' OR bride_lastName = '$ln' AND bride_firstName = '$fn' AND bride_middleName = '$mn' AND bride_dob = '$day'";
                                $funsql = "SELECT COUNT(*) as total FROM record_funeral_details WHERE lastName = '$ln' AND firstName = '$fn' AND middleName = '$mn' AND age = '$age'";
                            } else {
                                $bapsql = "SELECT COUNT(*) as total FROM record_baptism_details WHERE lastName = '$ln' AND firstName = '$fn' AND dob = '$day'";
                                $consql = "SELECT COUNT(*) as total FROM record_confirmation_details WHERE lastName = '$ln' AND firstName = '$fn' AND dob = '$day'";
                                $wedsql = "SELECT COUNT(*) as total FROM record_wedding_details WHERE groom_lastName = '$ln' AND groom_firstName = '$fn' AND groom_dob = '$day' OR bride_lastName = '$ln' AND bride_firstName = '$fn' AND bride_dob = '$day'";
                                $funsql = "SELECT COUNT(*) as total FROM record_funeral_details WHERE lastName = '$ln' AND firstName = '$fn' AND age = '$age'";
                            }
                        }
                        $bapres = $conn->query($bapsql);
                        $conres = $conn->query($consql);
                        $wedres = $conn->query($wedsql);
                        $funres = $conn->query($funsql);
                        $row1 = $bapres->fetch_assoc();
                        $row2 = $conres->fetch_assoc();
                        $row3 = $wedres->fetch_assoc();
                        $row4 = $funres->fetch_assoc();
                    ?>
                        <div class="result-cont">
                            <div class="center-heading">
                                Record/s Available
                            </div>
                            <div class="inner-rec">
                                <div>
                                    <span><strong>Baptism</strong></span>
                                    <span><?php echo $row1['total'] ?> Record/s Available</span>
                                </div>
                                <div>
                                    <span><strong>Confirmation</strong></span>
                                    <span><?php echo $row2['total'] ?> Record/s Available</span>
                                </div>
                                <div>
                                    <span><strong>Wedding</strong></span>
                                    <span><?php echo $row3['total'] ?> Record/s Available</span>
                                </div>
                                <div>
                                    <span><strong>Funeral</strong></span>
                                    <span><?php echo $row4['total'] ?> Record/s Available</span>
                                </div>
                            </div>
                        </div>
                    <?php }
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
    <script src="jsPROFILE.js"></script>
</body>

</html>