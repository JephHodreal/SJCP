<?php
session_start();
require 'dbconnect.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styleedit_ANNOUNCEMENTS.css">
    <!-- Font Awesome Icon Script -->
    <script src="https://kit.fontawesome.com/678a3c402d.js" crossorigin="anonymous"></script>
    <title>The SJCP - Edit Announcement</title>
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
                <div><i class="fa-solid fa-chart-line"></i>&nbspDashboard</div>
                <div class="active-btn"><i class="fa-solid fa-newspaper"></i>&nbspAnnouncements</div>
                <div><i class="fa-solid fa-file-pen"></i>&nbspRecords</div>
                <div><i class="fa-solid fa-calendar-check"></i>&nbspAppointments</div>
                <div><i class="fa-solid fa-arrow-right-from-bracket"></i>&nbspLog-out</div>
            </div>
        </div>
        <!-- Main Content Wrapper -->
        <div class="main-content">
            <div class="record-heading">
                <div class="internal-heading" onclick="openNav()" id="openNav"><i class="fa-solid fa-bars"></i></div>
                <div class="internal-heading"><span id="sjcp"><i class="fa-solid fa-church"></i>&nbspSJCP</span> Edit Announcements</div>
            </div>
            <div class="form-wrapper">
                <div class="form-card">
                    <button class="backbtn" onclick="openForm(cancel)">
                        <i class="fa-solid fa-arrow-left"></i>
                    </button>
                    <div id="cancel">
                        <div class="popupForm">
                            <div class="message-area">
                                <div class="icon-box">
                                    <i class="fa-solid fa-circle-exclamation"></i>
                                </div>
                                <div class="headertext-box">
                                    <h3>Discard changes?</h3>
                                    <p>Any edits that you made will not be saved.</p>
                                </div>
                            </div>
                            <div class="form-btnarea">
                                <button type="button" onclick="openForm(cancel)">No</button>
                                <button type="button" onclick="location.href = 'admin_ANNOUNCEMENT.php'">Yes</button>
                            </div>
                        </div>
                    </div>
                    <?php
                    if(isset($_SESSION['opensuccess'])){?>
                        <div class="success">
                            <div class="popupForm">
                                <div class="message-area">
                                    <div class="icon-box-success">
                                        <i class="fas fa-check-circle"></i>
                                    </div>
                                    <div class="headertext-box">
                                        <h3>Edits saved!</h3>
                                        <p>The event details have been updated.</p>
                                    </div>
                                </div>
                                <div class="form-btnarea">
                                    <button type="button" class="backtoPE" onclick="location.href = 'admin_ANNOUNCEMENT.php'">Back to Announcements</button>
                                    <?php unset($_SESSION['opensuccess'])?>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                    <?php
                        if(isset($_SESSION['toEdit'])){
                            $id = $_SESSION['id'];
                        } 
                            $query = "SELECT * FROM announcement_details WHERE post_id=$id";
                            $result = mysqli_query($conn, $query);
                            while ($row = mysqli_fetch_assoc($result)) {
                    
                    ?>
                    <div class="form-heading">Edit Announcement</div>
                        <form action="editPOST.php" method="post" enctype="multipart/form-data">
                            <span>Add Image:</span>
                            <input type="hidden" name="old_filename" value="<?php echo $row['announce_image']?>">
                            <input type="hidden" name="id" value="<?php echo $row['post_id']?>">
                            <input type="file" name="image" id="" accept="image/*" >
                            <?php
                            if (isset($_SESSION['invalidImage']) && $_SESSION['invalidImage'] == true) {
                                echo '<strong style="color:red">Invalid image!</strong>';
                            }
                            ?>
                            <div>
                                <div><span>Announcement Title:</span>
                                    <input type="text" name="title" id="" maxlength="40" placeholder="Max 40 Characters" value="<?php echo $row['event_name']?>">
                                </div>
                                <div>
                                    <span>Date:</span>
                                    <input type="date" name="date" id="" value="<?php echo $row['event_date']?>">
                                </div>
                            </div>
                            <span>Description:</span>
                            <textarea name="desc" id="text" rows="3" maxlength="200" onkeyup="checkChar()"> <?php echo $row['description']?> </textarea>
                            <small id="count">0 / 200</small>
                            <div class="btn-area">
                                <button type="reset" id="clear">Clear</button>
                                <button type="button" name="save" onclick="openForm(submitForm)">Save</button>
                            </div>
                            <?php
                            //closing tag of while($row)
                            }
                            ?>
                            <div id="submitForm">
                                <div class="popupForm">
                                    <div class="message-area">
                                        <div class="icon-box">
                                            <i class="fa-solid fa-circle-exclamation"></i>
                                        </div>
                                        <div class="headertext-box">
                                            <h3>Are you sure you want to save changes?</h3>
                                            <p>Please double-check your edits before saving.</p>
                                        </div>
                                    </div>
                                    <div class="form-btnarea">
                                        <button type="button" onclick="openForm(submitForm)">No</button>
                                        <button type="submit" name="submitReg" value="submit">Yes</button>
                                    </div>
                                </div>
                            </div>
                        </form>`
                    </div>
                </div>
            </div>
        </div>
        <script src="jsEDIT.js"></script>
    </div>
</body>

</html>