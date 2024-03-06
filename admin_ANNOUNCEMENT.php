<?php
session_start();
require 'dbconnect.php';
unset($_SESSION['statusAdmin']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styleANNOUNCEMENT.css">
    <!-- Font Awesome Icon Script -->
    <script src="https://kit.fontawesome.com/678a3c402d.js" crossorigin="anonymous"></script>
    <title>The SJCP - Announcement</title>
    <link rel="icon" type="image/png" href="tabicon.png">
</head>

<body>
    <div class="content-wrapper">
        <!-- Nav Wrapper -->
        <!-- Add active class on active button of current page -->
        <div class="nav-wrapper" id="sideNav">
            <i class="fa-solid fa-angles-left close-nav" onclick="openNav()"></i>
            <div class="icon-wrapper">
                <i class="fa-solid fa-church"></i> SJCP
            </div>
            <div class="nav-items">
            <div onclick="window.location.href='admin_DASHBOARD.php'"><i class="fa-solid fa-chart-line"></i>&nbspDashboard</div>
                <div onclick="window.location.href='admin_ANNOUNCEMENT.php'" class="active-btn"><i class="fa-solid fa-newspaper"></i>&nbspAnnouncements</div>
                <div onclick="window.location.href='admin_RECORDS.php'"><i class="fa-solid fa-file-pen"></i>&nbspRecords</div>
                <div onclick="window.location.href='admin_APPOINTMENTLIST.php'"><i class="fa-solid fa-calendar-check"></i>&nbspAppointments</div>
                <div onclick="openclose(logoutForm)"><i class="fa-solid fa-arrow-right-from-bracket"></i>&nbspLog-out</div>
            </div>
        </div>
        <div id="logoutForm">
            <form action="adminlogoutCall.php" method="post">
                <div class="popupFormLogout">
                    <div class="header-cont">
                        <div class="icon-box">
                            <i class="fa-solid fa-right-from-bracket" style="font-size: 4rem; background-color: transparent"></i>
                        </div>
                        <div class="headertext-logout">
                            <h3>Confirm Logout?</h3>
                            <p>Are you sure you want to log-out?</p>
                        </div>
                    </div>
                    <div class="form-btnarea">
                        <button class="buttonno" type="button" onclick="openclose(logoutForm)">No</button>
                        <button class="buttonyes" type="submit" name="submit" value="delete">Yes</button>
                    </div>
                    </div>
            </form>
        </div>

        <!-- Main Content Wrapper -->
        <div class="main-content">
            <div class="record-heading">
                <div class="internal-heading" onclick="openNav()" id="openNav"><i class="fa-solid fa-bars"></i></div>
                <div class="internal-heading"><span id="sjcp"><i class="fa-solid fa-church"></i>&nbspSJCP </span> Announcements</div>
            </div>
            <div class="post-cont">
                <button class="floating-btn" onclick="location.href = 'add_ANNOUNCEMENT.php'"><i class="fa-solid fa-plus"></i>&nbspAdd Post</button>
                <?php
                $query = "SELECT * FROM announcement_details";
                $result = mysqli_query($conn, $query);
                if (mysqli_num_rows($result) != 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $dir = "Photos/" . $row['announce_image']; 
                        $popupDel = "del".$row['post_id'];
                        ?>
                        <div class="post-card">
                            <div class="image-wrapper">
                                <img src="<?php echo $dir ?>" alt="thisimg.jpg">
                            </div>
                            <div class="main-wrapper">
                                <div class="title-box">
                                    <div class="title-heading">Title: <?php echo $row['event_name'] ?></div>
                                    <div class="title-heading">Date: <?php echo date('F d, Y', strtotime($row['event_date']))?></div>
                                </div>
                                <div class="desc-box">
                                    <strong>Description:</strong> <br>
                                    <div class="para"><?php echo $row['description'] ?></div>
                                </div>
                            </div>
                            <div class="option-wrapper">
                                <form action="" method="post">
                                    <input type="hidden" name="toDelete" value="<?php echo $row['post_id'] ?>">
                                    <button type="submit" formaction="editPOST.php" name="editPost"><i class="fa-solid fa-pencil"></i>&nbspEdit</button>
                                    <button type="button" name="delete" onclick="openForm('<?php echo $popupDel ?>')"><i class="fa-solid fa-trash-can"></i>&nbspDelete</button>
                            </div>
                        </div>
                        <div class="popupCover" id="<?php echo $popupDel?>">
                            <div class="popupForm">
                                <div class="headertext-box">
                                    <div class="icon-box">
                                        <i class="fa fa-question-circle" style="font-size: 4rem"></i>
                                    </div>
                                    <div>
                                        <h3> Are you sure you want to Delete this event?</h3>
                                        <p>This event will no longer be seen by the people</p>
                                    </div>
                                </div> 
                                <div class="form-btnarea">
                                    <button class="buttonno" type="button" onclick="closeForm('<?php echo $popupDel?>')">No</button>
                                    <button class="buttonyes" type="submit" formaction="addPOST.php" name="delPost">Yes</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    <?php }
                } else {
                    ?> <div class="empty-post">
                        <i class="fa-solid fa-circle-exclamation"></i>
                        <span>No Announcements to show.</span>
                    </div>
                <?php }
                ?>
            </div>
        </div>
        <script src="jsANNOUNCEMENT.js"></script>
    </div>
</body>

</html>
