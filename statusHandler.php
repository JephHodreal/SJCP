<?php
//for admin status filter
session_start();
if (isset($_POST['statusAdmin'])) {
    $_SESSION['statusAdmin'] = $_POST['statusAdmin'];
    header('Location: admin_APPOINTMENTLIST.php');
} 

if (isset($_POST['order'])) {
    $_SESSION['orderAdmin'] = $_POST['order'];
    header('Location: admin_APPOINTMENTLIST.php');
}

?>