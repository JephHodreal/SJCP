<?php
session_start();
require 'dbconnect.php';

if(isset($_POST['submitReg'])){
    $old_filename = $_POST['old_filename'];
    $id = $_SESSION['id'] =$_POST['id'];
    $title = $_SESSION['title'] = $_POST['title'];
    $date = $_SESSION['date'] = $_POST['date'];
    $desc = $_SESSION['desc'] = $_POST['desc'];

    $dir = "Photos/";


    if (empty($_FILES['image']['name'])) {
        $query = "UPDATE announcement_details SET event_name ='$title', event_date='$date', event_time=time(NOW()), descr='$desc' WHERE post_id = '$id'";
        $res = mysqli_query($conn, $query);
        $_SESSION['opensuccess'] = true;
        header('Location: edit_ANNOUNCEMENTS.php');
    } else {

        if($old_filename == "default.jpg"){
            //hindi idedelete yung file
        } else {
            $dirhandler = opendir($dir);
            $file_to_delete = $dir.$old_filename;
            unlink($file_to_delete);
            closedir($dirhandler);
        }
        $fileName = basename($_FILES['image']['name']);
        $targetFilePath = $dir . $fileName;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
        $allowTypes = array('jpg', 'png', 'jpeg', 'gif', 'jfif');
        if (!in_array($fileType, $allowTypes)) {
            $_SESSION['invalidImage'] = true;
            header('Location: edit_ANNOUNCEMENTS.php');
        } else {
            move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath);
            $query = "UPDATE announcement_details SET announce_image='$fileName', event_name ='$title', event_date='$date', event_time=time(NOW()), description='$desc' WHERE post_id = '$id'";
            $res = mysqli_query($conn, $query);
            $_SESSION['opensuccess'] = true;
            header('Location: edit_ANNOUNCEMENTS.php');
        }
    }

} 

if(isset($_POST['editPost'])){
    $id = $_SESSION['id'] = $_POST['toDelete'];
    $_SESSION['toEdit'] = "true";
    header('Location: edit_ANNOUNCEMENTS.php');
}

?>
