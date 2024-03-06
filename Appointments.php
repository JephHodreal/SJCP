<?php
session_start();
$_SESSION['isLoggedIn'] = true;
require 'dbconnect.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styleAppointments.css">
    <!-- Font Awesome Icon Script -->
    <script src="https://kit.fontawesome.com/678a3c402d.js" crossorigin="anonymous"></script>
    <script src="jsAppointment.js"></script>
    <title>View Appointments</title>
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
                <div class="nav-item active" onclick="window.location.href='page_HOME.php'">Home</div>
                <div class="nav-item" onclick="window.location.href='page_FAQ.php'">FAQs</div>
                <div class="nav-item dropdown">
                    <span class="dp-title">Services <i class="fa-solid fa-angle-down"></i></span>
                    <div class="dropdown-content">
                        <div class="nav-item" onclick="window.location.href='Services.php'">
                            View Services
                        </div>
                        <div class="nav-item" <?php if (!isset($_SESSION['isLoggedIn']) || $_SESSION['isLoggedIn'] == false) {
                                                    echo 'onclick="openLogin()"';
                                                } else {
                                                } ?> onclick="window.location.href='page_SCHEDULEEVENT.php'">
                            Set Appointment
                        </div>
                        <div class="nav-item" <?php if (!isset($_SESSION['isLoggedIn']) || $_SESSION['isLoggedIn'] == false) {
                                                    echo 'onclick="openLogin()"';
                                                } else { ?>
                                                    onclick="location.href='Appointments.php'";
                                                <?php } ?> >
                            View Appointment
                        </div>
                        <div class="nav-item" <?php if (!isset($_SESSION['isLoggedIn']) || $_SESSION['isLoggedIn'] == false) {
                                                    echo 'onclick="openLogin()"';
                                                } else {
                                                    echo 'onclick="location.href=page_SEARCH.php"';
                                                } ?>>
                            Search Record
                        </div>
                    </div>
                </div>
                <div class="nav-item dropdown">
                    <span class="dp-title">Events <i class="fa-solid fa-angle-down"></i></span>
                    <div class="dropdown-content">
                        <div class="nav-item" onclick="window.location.href='page_VIEWANNOUNCEMENT.php'">Announcements</div>
                        <div class="nav-item" onclick="window.location.href='page_VIEWSCHEDULES.php'">Calendar</div>
                    </div>
                </div>
                <div class="nav-item" onclick="window.location.href='Aboutus.php'">About Us</div>
                <?php
                if (!isset($_SESSION['isLoggedIn']) || $_SESSION['isLoggedIn'] == false) {
                    echo '<div class="nav-item" onclick="openLogin()">Login</div>';
                } else if ($_SESSION['isLoggedIn'] == true) { ?>
                    <div class="nav-item dropdown">
                        <span class="dp-title">Profile <i class="fa-solid fa-angle-down"></i></span>
                        <div class="dropdown-content">
                            <div class="nav-item" onclick="location.href='page_PROFILE.php'" ;>Profile</div>
                            <div class="nav-item" onclick="openForm(logoutForm)">Log-Out</div>
                        </div>
                    </div>
                <?php
                }
                ?>
                <div id="logoutForm">
                    <form action="logoutCall.php" method="post">
                        <div class="popupForm">
                            <div class="icon-box"></div>
                            <div class="headertext-box">
                                Confirm Logout?
                            </div>
                            <div class="form-btnarea">
                                <button type="button" onclick="openForm(logoutForm)">No</button>
                                <button type="submit" name="submit" value="delete">Yes</button>
                            </div>
                    </form>
                </div>
            </div>
        </nav>
        
        <!-- Filler Body - No need to Copy -->
        <div class="main-body-wrapper">
            <section class="main-content"> 
                <div class="main-content-title"> 
                    <h1> View Appointments </h1>
                </div> 
            </section>
            <section class = "content-container">
                <div class="body-content">
                    <form action="page_LANDING.php" method="post">
                        <button type="submit" name="status" value="Pending">PENDING</button>
                        <button type="submit" name="status" value="Accepted">ACCEPTED</button>
                        <button type="submit" name="status" value="Completed">COMPLETED</button>
                        <button type="submit" name="status" value="Rejected">REJECTED</button>
                        <button type="submit" name="status" value="Canceled">CANCELED</button>
                    </form>
                    <div class="details">
                            <?php 
                                if (!isset($_SESSION['status'])){
                                    $status = "Pending";
                                } else {
                                    $status = $_SESSION['status'];
                                }
                                
                                        // Number of Record per Page
                                        $recordsPerPage = 10;


                                        // Current page number
                                        if (isset($_GET['page'])) {
                                            $currentPage = $_GET['page'];
                                        } else {
                                            $currentPage = 1;
                                        }

                                        // Calculate the starting record index
                                        $startFrom = ($currentPage - 1) * $recordsPerPage;

                                $query = "SELECT * FROM appointment_details WHERE appointment_status = '$status' LIMIT $startFrom, $recordsPerPage";
                                $sql = "SELECT COUNT(*) AS total FROM appointment_details WHERE appointment_status = '$status'"; ?>
                                        <div class="details-container">
                                <?php $result = mysqli_query($conn, $query);
                                    while($row = mysqli_fetch_array($result)) {
                                        $id = $row[0];
                                        $forReason = "again".$id;
                                        $idseemore = "try".$id;
                                        $cancelconf = "cancel".$id;
                                        $resched = "resched".$id;
                                        $fixedtime = date("h:i:s A", strtotime($row[4]));
                                        ?>
                                        
                                            <div class="indiv-cont">
                                                <div>
                                                    <table>
                                                        <tr>    
                                                            <td class="th"><h2><?php echo $row[1] ?></h2> <p class="<?php echo $row[10]?>"> <?php echo $row[10] ?></p></td>
                                                            <td></td>
                                                            <td>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;</td>
                                                            <td><p>Date of Event:</p></td>
                                                        </tr>
                                                        <tr>
                                                            <td><p><?php echo $row[9] ?></p></td>
                                                            <td></td>
                                                            <td>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;</td>
                                                            <td><p><?php echo date('F d, Y', strtotime($row[6]))?></p></td>
                                                        </tr>
                                                        <?php if($row[10] == "Rejected" || $row[10] == "Canceled" ){ ?>
                                                        <tr>
                                                            <td><p> Reason: <?php echo $row[11] ?></p></td>
                                                            <td></td>
                                                            <td>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;</td>
                                                            <td><p>Time: <?php echo date('h:m:s A', strtotime($row[7]))?></p></td>
                                                        </tr>
                                                        <?php } ?>
                                                        
                                                            <td>
                                                            <?php 
                                                                $view = $row[0];
                                                                $type = $row[9];
                                                            ?>
                                                                <button type="button" class="viewmore" name="viewmore" onclick="location.href='<?php echo '?view=' . $view. '&event='.$type. '&page='. $currentPage?>'"> View more</button>
                                                            </td>
                                                            <td></td>
                                                            <td></td>
                                                            <td>
                                                        <form action="page_LANDING.php" method="post">
                                                            <?php if($status == "Completed"){ ?>
                                                                <!-- no button to show-->
                                                            <?php } else if($status == "Rejected" || $status == "Canceled"){ ?>
                                                                <button type="button" class="buttonresched" onclick="openForm('<?php echo $resched?>')"> Reschedule </button>
                                                            <?php } else { ?>
                                                                <button type="button" class="buttoncancel" onclick="openForm('<?php echo $cancelconf?>')"> Cancel </button>
                                                            <?php } ?>
                                                            <input type="hidden" name="id" value="<?php echo $row[0]?>">
                                                            <div class="popupCover" id="<?php echo $cancelconf?>">
                                                                <div class="popupForm">
                                                                    <div class="headertext-box">
                                                                        <div class="icon-box">
                                                                            <i class="fa fa-question-circle" style="font-size: 4rem"></i>
                                                                        </div>
                                                                        <div>
                                                                            <h3> Are you sure you want to cancel your event? <?php echo $row[0]?></h3>
                                                                            <p>You will lose your place in the queue and will have to reschedule your event.</p>
                                                                        </div>
                                                                    </div> 
                                                                    <div class="form-btnarea">
                                                                        <button class="buttonno" type="button" onclick="closeForm('<?php echo $cancelconf?>')">No</button>
                                                                        <button class="buttonyes" type="button" onclick="closeForm('<?php echo $cancelconf?>'), openForm('<?php echo $row[0]?>')" name="sure">Yes</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="popupCover" id="<?php echo $resched?>">
                                                                <div class="popupForm">
                                                                    <div class="headertext-box">
                                                                        <div class="icon-box">
                                                                            <i class="fa fa-question-circle" style="font-size: 4rem"></i>
                                                                        </div>
                                                                        <div>
                                                                            <h3> Are you sure you want to reschedule this event?</h3>
                                                                            <p>Please consider the reason for rejection/cancellation before rescheduling your event to avoid further rejections/cancellations</p>
                                                                        </div>
                                                                    </div> 
                                                                    <div class="form-btnarea">
                                                                        <button class="buttonno" type="button" onclick="closeForm('<?php echo $resched?>')">No</button>
                                                                        <button class="buttonyes" type="Submit" name="reschedYes">Yes</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="popupCover-reason" id="<?php echo $row[0]?>">
                                                                <div class="popupForm-reason">
                                                                    <div  class="form-area">
                                                                        <h2> Reason/s </h2>
                                                                        <p>Please provide a reason for the cancellation of your appointment</p>
                                                                    </div>
                                                                    <div class="form-area">
                                                                        <div class="reason-container">
                                                                            <div class="form-reason">
                                                                                <div>
                                                                                    <input type="radio" name="reason" id="cop" value="Change of Plans" onclick="hideinput(otherinput)" required> 
                                                                                    <label for="cop">Change of Plans</label><br>
                                                                                </div>
                                                                                <div>
                                                                                    <input type="radio" name="reason" id="lop" value="Lack of Preparetion" onclick="hideinput(otherinput)" required>
                                                                                    <label for="lop">Lack of Preparetion</label><br>
                                                                                </div>
                                                                                <div>
                                                                                    <input type="radio" name="reason" id="uta" value="Unable to attend" onclick="hideinput(otherinput)" required>
                                                                                    <label for="uta">Unable to attend</label><br>
                                                                                </div>
                                                                                <div>
                                                                                    <input type="radio" name="reason" id="emerg" value="Emergency" onclick="hideinput(otherinput)" required>
                                                                                    <label for="emerg">Emergency</label><br>
                                                                                </div>
                                                                                <div>
                                                                                    <input type="radio" name="reason" id="cs" value="Conflicting Schedule" onclick="hideinput(otherinput)" required>
                                                                                    <label for="cs">Conflicting Schedule</label><br>
                                                                                </div>
                                                                                <div>
                                                                                    <input type="radio" name="reason" id="ps" value="Personal Stuff" onclick="hideinput(otherinput)" required>
                                                                                    <label for="ps">Personal Stuff</label><br>
                                                                                </div>  
                                                                                <div>
                                                                                    <input type="radio" name="reason"id="other" value="other" onclick="showinput(otherinput)" required>
                                                                                    <label for="other">Other</label><br>
                                                                                    <input type="text" class="othertext" name="others" id="otherinput">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-btnarea">
                                                                            <button type="button" class="buttonno" onclick="closeForm('<?php echo $row[0]?>')"> Cancel</button>
                                                                            <button type="submit" class="buttonresched" name="reasonsubmit">Submit</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </table>
                                                </div>
                                            </div>
                                            <?php
                                    }
                            ?>
                            </div>
                        </div>

                        <div>
                        <!-- Pagination Link Creation -->
                        <?php

                            // Pagination links
                            $result = $conn->query($sql);
                            $row = $result->fetch_assoc();
                            $totalRecords = $row["total"];
                            $totalPages = ceil($totalRecords / $recordsPerPage);

                            echo "<div class='pagination'>";

                            if ($totalPages > 1) {
                                for ($i = 1; $i <= $totalPages; $i++) {
                                    if ($i == $currentPage) {
                                        echo "<a class='active' href='?page=$i'>$i</a> ";
                                    } else {
                                        echo "<a href='?page=$i'>$i</a> ";
                                    }
                                }
                            }

                            echo "</div>";
                        ?>
                        </div>
                        <?php if (isset($_GET['view'])) { ?>
                            <div class="view-container">
                                <div class="view-card">
                                    <script>
                                        document.body.style.height = "100%";
                                        document.body.style.overflow = "hidden";
                                    </script>
                                    <?php
                                    $queryId = $_GET['view'];
                                    $event = $_GET['event'];
                                    if ($event == 'Baptism') {
                                        $viewQuery = "SELECT * FROM baptism_details WHERE foreign_id='$queryId'";
                                    } else if ($event == 'Confirmation') {
                                        $viewQuery = "SELECT * FROM confirmation_details WHERE foreign_id='$queryId'";
                                    } else if ($event == 'Wedding') {
                                        $viewQuery = "SELECT * FROM wedding_details WHERE foreign_id='$queryId'";
                                    } else if ($event == 'Funeral Mass/Blessing') {
                                        $viewQuery = "SELECT * FROM funeral_details WHERE foreign_id='$queryId'";
                                    } else if ($event == 'Mass Intention'){
                                        $viewQuery = "SELECT * FROM mass_intention_details WHERE foreign_id='$queryId'";
                                    } else if ($event == 'House Blessing' || $event == 'Car Blessing' || $event == 'Store Blessing' || $event == 'Motorcycle Blessing'){
                                        $viewQuery = "SELECT * FROM blessing_details WHERE foreign_id='$queryId'";
                                    } else if ($event == 'Baptismal Certificate'|| $event == 'Permit and No Record' || $event == 'Good Moral Certificate' || $event == 'Wedding Certificate' || $event == 'Confirmation Certificate'){
                                        $viewQuery = "SELECT * FROM document_request_details WHERE foreign_id='$queryId'";
                                    }
                                    $res = $conn->query($viewQuery);
                                    if ($res->num_rows > 0) {
                                        while ($viewRow = $res->fetch_assoc()) {
                                            if ($event == 'Baptism') { ?>
                                                <!-- For Baptism -->
                                                <div class="view-heading">Baptism Record Details</div>
                                                <div class="inner-view-heading1">
                                                    <span>Baptism Date</span>
                                                    <span>Baptism Time</span>
                                                </div>
                                                <div class="inner-view-content1">
                                                    <span><?php echo date('F d, Y', strtotime($viewRow['event_date'])) ?></span>
                                                    <span><?php echo date("h:i:s A", strtotime($viewRow['event_timeStart'])) ?></span>
                                                </div>
                                                <div class="inner-view-heading2">
                                                    <span>Name</span>
                                                    <span>Birthdate</span>
                                                    <span>Gender</span>
                                                </div>
                                                <div class="inner-view-content2">
                                                    <span><?php echo $viewRow['lastName'] . ", " . $viewRow['firstName'] . " " . $viewRow['midName']  ?></span>
                                                    <span><?php echo date('F d, Y', strtotime($viewRow['dob'])) ?></span>
                                                    <span><?php echo $viewRow['gender'] ?></span>
                                                </div>
                                                <div class="inner-view-heading2">
                                                    <span>Place of Birth</span>
                                                    <span>Address</span>
                                                    <span>Contact Number</span>
                                                </div>
                                                <div class="inner-view-content2">
                                                    <span><?php echo $viewRow['pob'] ?></span>
                                                    <span><?php echo $viewRow['address'] ?></span>
                                                    <span><?php echo $viewRow['contNum'] ?></span>
                                                </div>
                                                <div class="inner-view-heading1">
                                                    <span>Father's Name</span>
                                                    <span>Father's Place of Birth</span>
                                                </div>
                                                <div class="inner-view-content1">
                                                    <span><?php echo $viewRow['fatherName'] ?></span>
                                                    <span><?php echo $viewRow['fatherPob'] ?></span>
                                                </div>
                                                <div class="inner-view-heading1">
                                                    <span>Mother's Name</span>
                                                    <span>Mother's Place of Birth</span>
                                                </div>
                                                <div class="inner-view-content1">
                                                    <span><?php echo $viewRow['motherName'] ?></span>
                                                    <span><?php echo $viewRow['motherPob'] ?></span>
                                                </div>
                                                <div class="inner-view-heading1">
                                                    <span>Marriage Type</span>
                                                </div>
                                                <div class="inner-view-content1">
                                                    <span><?php echo $viewRow['marriage_type'] ?></span>
                                                </div>
                                                <div class="inner-view-heading1">
                                                    <span>Godfather's Name</span>
                                                    <span>Godfather's Address</span>
                                                </div>
                                                <div class="inner-view-content1">
                                                    <span><?php echo $viewRow['godfathName'] ?></span>
                                                    <span><?php echo $viewRow['godfathAddress'] ?></span>
                                                </div>
                                                <div class="inner-view-heading1">
                                                    <span>Godmother's Name</span>
                                                    <span>Godmother's Address</span>
                                                </div>
                                                <div class="inner-view-content1">
                                                    <span><?php echo $viewRow['godmothName'] ?></span>
                                                    <span><?php echo $viewRow['godmothAddress'] ?></span>
                                                </div>
                                            <?php } else if ($event == 'Wedding') { ?>
                                                <!-- For Wedding -->
                                                <div class="view-heading">Wedding Record Details</div>
                                                <div class="inner-view-heading1">
                                                    <span>Wedding Date</span>
                                                    <span>Wedding Time</span>
                                                </div>
                                                <div class="inner-view-content1">
                                                    <span><?php echo date('F d, Y', strtotime($viewRow['event_date'])) ?></span>
                                                    <span><?php echo date("h:i:s A", strtotime($viewRow['event_timeStart'])) ?></span>
                                                </div>
                                                <div class="view-heading">Groom</div>
                                                <div class="inner-view-heading2">
                                                    <span>Name</span>
                                                    <span>Date of Birth</span>
                                                    <span>Place of Birth</span>
                                                </div>
                                                <div class="inner-view-content2">
                                                    <span><?php echo $viewRow['groom_lName'] . ", " . $viewRow['groom_fName'] . " " . $viewRow['groom_midName']  ?></span>
                                                    <span><?php echo $viewRow['groom_dob'] ?></span>
                                                    <span><?php echo $viewRow['groom_pob'] ?></span>
                                                </div>
                                                <div class="inner-view-heading2">
                                                    <span>Contact Number</span>
                                                    <span>Religion</span>
                                                    <span>Address</span>
                                                </div>
                                                <div class="inner-view-content2">
                                                    <span><?php echo $viewRow['groom_conNum'] ?></span>
                                                    <span><?php echo $viewRow['groom_religion'] ?></span>
                                                    <span><?php echo $viewRow['groom_address'] ?></span>
                                                </div>
                                                <div class="inner-view-heading1">
                                                    <span>Father's Name</span>
                                                    <span>Mother's Name</span>
                                                </div>
                                                <div class="inner-view-content1">
                                                    <span><?php echo $viewRow['groom_father'] ?></span>
                                                    <span><?php echo $viewRow['groom_mother'] ?></span>
                                                </div>
                                                <div class="view-heading">Bride</div>
                                                <div class="inner-view-heading2">
                                                    <span>Name</span>
                                                    <span>Date of Birth</span>
                                                    <span>Place of Birth</span>
                                                </div>
                                                <div class="inner-view-content2">
                                                    <span><?php echo $viewRow['bride_lName'] . ", " . $viewRow['bride_fName'] . " " . $viewRow['bride_midName']  ?></span>
                                                    <span><?php echo $viewRow['bride_dob'] ?></span>
                                                    <span><?php echo $viewRow['bride_pob'] ?></span>
                                                </div>
                                                <div class="inner-view-heading2">
                                                    <span>Contact Number</span>
                                                    <span>Religion</span>
                                                    <span>Address</span>
                                                </div>
                                                <div class="inner-view-content2">
                                                    <span><?php echo $viewRow['bride_conNum'] ?></span>
                                                    <span><?php echo $viewRow['bride_religion'] ?></span>
                                                    <span><?php echo $viewRow['bride_address'] ?></span>
                                                </div>
                                                <div class="inner-view-heading1">
                                                    <span>Father's Name</span>
                                                    <span>Mother's Name</span>
                                                </div>
                                                <div class="inner-view-content1">
                                                    <span><?php echo $viewRow['bride_father'] ?></span>
                                                    <span><?php echo $viewRow['bride_mother'] ?></span>
                                                </div>
                                            <?php } else if ($event == 'Funeral Mass/Blessing') { ?>
                                                <!-- For Funeral -->
                                                <div class="view-heading">Funeral Mass Record Details</div>
                                                <div class="inner-view-heading1">
                                                    <span>Funeral Mass Date</span>
                                                    <span>Funeral Mass Time</span>
                                                </div>
                                                <div class="inner-view-content1">
                                                    <span><?php echo date('F d, Y', strtotime($viewRow['event_date'])) ?></span>
                                                    <span><?php echo date("h:i:s A", strtotime($viewRow['event_timeStart'])) ?></span>
                                                </div>
                                                <div class="view-heading">Deceased</div>
                                                <div class="inner-view-heading2">
                                                    <span>Name</span>
                                                    <span>Gender</span>
                                                    <span>Age</span>
                                                </div>
                                                <div class="inner-view-content2">
                                                    <span><?php echo $viewRow['lastName'] . ", " . $viewRow['firstName'] . " " . $viewRow['middleName']  ?></span>
                                                    <span><?php echo $viewRow['gender'] ?></span>
                                                    <span><?php echo $viewRow['age'] ?></span>
                                                </div>
                                                <div class="inner-view-heading2">
                                                    <span>Date of Death</span>
                                                    <span>Cause of Death</span>
                                                    <span>Date of Internment</span>
                                                </div>
                                                <div class="inner-view-content2">
                                                    <span><?php echo date('F d, Y', strtotime($viewRow['deathDate'])) ?></span>
                                                    <span><?php echo $viewRow['deathCause'] ?></span>
                                                    <span><?php echo date('F d, Y', strtotime($viewRow['internmentDate'])) ?></span>
                                                </div>
                                                <div class="inner-view-heading2">
                                                    <span>Place of Cemetery</span>
                                                    <span>Sacrament Received</span>
                                                    <span>Burial</span>
                                                </div>
                                                <div class="inner-view-content2">
                                                    <span><?php echo $viewRow['cemeteryPlace'] ?></span>
                                                    <span><?php echo $viewRow['sacrament'] ?></span>
                                                    <span><?php echo $viewRow['burial'] ?></span>
                                                </div>
                                                <div class="view-heading">Informant</div>
                                                <div class="inner-view-heading2">
                                                    <span>Name</span>
                                                    <span>Contact Number</span>
                                                    <span>Address</span>
                                                </div>
                                                <div class="inner-view-content2">
                                                    <span><?php echo $viewRow['informLast'] . ", " . $viewRow['informFirst'] . " " . $viewRow['informMid']  ?></span>
                                                    <span><?php echo $viewRow['contNum'] ?></span>
                                                    <span><?php echo date('F d, Y', strtotime($viewRow['address'])) ?></span>
                                                </div>
                                            <?php } else if($event == 'Mass Intention'){ ?>
                                                <div class="view-heading">Mass Inention Details</div>
                                                <div class="inner-view-heading1">
                                                    <span>Mass Intention Date</span>
                                                    <span>Mass Intention Time</span>
                                                </div>
                                                <div class="inner-view-content1">
                                                    <span><?php echo date('F d, Y', strtotime($viewRow['event_date'])) ?></span>
                                                    <span><?php echo date("h:i:s A", strtotime($viewRow['event_time'])) ?></span>
                                                </div>
                                                <div class="inner-view-heading2">
                                                    <span>Contact Number</span>
                                                    <span>Purpose</span>
                                                    <span>Name/s</span>
                                                </div>
                                                <div class="inner-view-content2">
                                                    <span><?php echo $viewRow['contactNum']?></span>
                                                    <span><?php echo $viewRow['purpose'] ?></span>
                                                    <span><?php echo $viewRow['name'] ?></span>
                                                </div>
                                            <?php } else if($event == 'Wedding Certificate' || $event == 'Baptismal Certificate' || $event == 'Confirmation Certificate' || $event == 'Permit and No Record' || $event == 'Good Moral Certificate'){ ?>
                                                <div class="view-heading">Document Request Details</div>
                                                <div class="inner-view-heading2">
                                                    <span>Document Type</span>
                                                    <span>Claiming Date</span>
                                                    <span>Purpose</span>
                                                </div>
                                                <div class="inner-view-content2">
                                                    <span><?php echo $event ?></span>
                                                    <span><?php echo date('F d, Y', strtotime($viewRow['claim_date'])) ?></span>
                                                    <span><?php echo $viewRow['purpose'] ?></span>
                                                </div>
                                                <div class="inner-view-heading2">
                                                    <span>Name</span>
                                                    <span>Birthday</span>
                                                    <span>Contact Number</span>
                                                </div>
                                                <div class="inner-view-content2">
                                                    <span><?php echo $viewRow['lastName'] . ", " . $viewRow['firstName'] . " " . $viewRow['middleName']  ?></span>
                                                    <span><?php echo $viewRow['dob'] ?></span>
                                                    <span><?php echo $viewRow['contactNum'] ?></span>
                                                </div>
                                                <div class="inner-view-heading2">
                                                    <?php if($event == 'Wedding Certificate' || $event == 'Baptismal Certificate' || $event == 'Confirmation Certificate'){?>
                                                        <span>Father's Name</span>
                                                        <span>Mother's Name</span>
                                                    <?php } ?>
                                                    <?php if($event == 'Permit and No Record') {?>
                                                        <span>Address</span>
                                                    <?php } ?>
                                                </div>
                                                <div class="inner-view-content2">
                                                    <?php if($event == 'Wedding Certificate' || $event == 'Baptismal Certificate' || $event == 'Confirmation Certificate'){?>
                                                        <span><?php echo $viewRow['fatherName']?></span>
                                                        <span><?php echo $viewRow['motherName'] ?></span>
                                                    <?php } 
                                                    if($event == 'Permit and No Record') {?>
                                                        <span><?php echo $viewRow['address'] ?></span>
                                                    <?php } ?>
                                                </div>
                                            <?php } else { ?>
                                                <div class="view-heading">Blessing Details</div>
                                                <div class="inner-view-heading1">
                                                    <span>Blessing Type</span>
                                                    <span>Blessing Date</span>
                                                </div>
                                                <div class="inner-view-content2">
                                                    <span><?php echo $event ?></span>
                                                    <span><?php echo date('F d, Y', strtotime($viewRow['event_date'])) ?></span>
                                                </div>
                                                <div class="inner-view-heading2">
                                                    <span>Contact Number</span>
                                                    <?php if($event == 'House Blessing' || $event == 'Store Blessing'){ ?>
                                                        <span>Address</span>
                                                    <?php } ?>
                                                </div>
                                                <div class="inner-view-content2">
                                                    <span><?php echo $viewRow['contact_num'] ?></span>
                                                    <?php if($event == 'House Blessing' || $event == 'Store Blessing'){ ?>
                                                        <span><?php echo $viewRow['address'] ?></span>
                                                    <?php } ?>
                                                </div>
            
                                            <?php }
                                        }
                                    } else {
                                        echo 'No Appointements';
                                    }
                                    ?>
                                    <button class="closeme" onclick="location.href='?page=<?php echo $currentPage?>'"><i class="fa-solid fa-xmark"></i></button>
                                </div>
                            </div>
                            <?php unset($_SESSION['view']);
                        } 
            
                        if(isset($_SESSION['updated'])){
                            $message1 = $_SESSION['m1'];
                            $message2 = $_SESSION['m2'];
                        ?>
                         <div class="popupCover-message" id="message">
                            <div class="popupMessage">
                                <div> <i class="fa fa-check-circle" style="font-size: 4rem"></i> </div>
                                <div class="title-cont"> <h2><?php echo $message1?></h2> </div>
                                <div class="desc-cont"><?php echo $message2?> </div>
                                <div class="button-cont">  <button type="button" onclick="location.href='Appointments.php'"> <b>Back to Appointment List</b></button> </div>
                                <?php unset($_SESSION['updated']) ?>
                            </div>
                        </div>
                       <?php } ?>
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
    <script src="reuse.js"></script>
</body>

</html>