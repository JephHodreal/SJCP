<?php
session_start();
require 'dbconnect.php';

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

if ($_POST["submit"]) {
    if ($_POST["submit"] == "accept") {
        //do when button in popup accept is clicked
        $id = $_POST["acceptid"];
        $queryaccept = "UPDATE appointment_details SET appointment_status = 'Accepted' WHERE appointment_id = $id";
        $getmail = "SELECT email FROM appointment_details WHERE appointment_id='$id'";
        if ($found = $conn->query($getmail)) {
            $email = $found->fetch_assoc();
        }
        if ($resultaccept = mysqli_query($conn, $queryaccept)) {
            sendMail("Accepted", $email['email'], 0);
            $_SESSION['m1'] = $message1 = "Appointment has been Accepted";
            $_SESSION['m2'] = $message2 = "Please check the Accepted tab to see Accepted appointments";
            $_SESSION['updated'] = "true";
        }
        header('Location: admin_APPOINTMENTLIST.php');
    } else if ($_POST["submit"] == "complete") {
        //do when button in popup Complete is clicked
        $id = $_POST["completeid"];
        $queryaccept = "UPDATE appointment_details SET appointment_status = 'Completed' WHERE appointment_id = $id";
        $getmail = "SELECT email FROM appointment_details WHERE appointment_id='$id'";
        if ($found = $conn->query($getmail)) {
            $email = $found->fetch_assoc();
        }
        if ($resultaccept = mysqli_query($conn, $queryaccept)) {
            sendMail("Completed", $email['email'], 0);
            $_SESSION['m1'] = $message1 = "Appointment is Completed";
            $_SESSION['m2'] = $message2 = "Please check the Complete tab to see Completed appointments";
            $_SESSION['updated'] = "true";
        }
        header('Location: admin_APPOINTMENTLIST.php');
    } else if ($_POST["submit"] == "rejected") {
        //do when button in popup rejected is clicked
        $id = $_POST["reasonid"];
        $reason = $_POST["reason"];
        if ($reason == "other") {
            $reason = $_POST["others"];
        }
        $querycancel = "UPDATE appointment_details SET appointment_status = 'Rejected', reason = '$reason' WHERE appointment_id = $id";
        $getmail = "SELECT email FROM appointment_details WHERE appointment_id='$id'";
        if ($found = $conn->query($getmail)) {
            $email = $found->fetch_assoc();
        }
        if ($resultcancel = mysqli_query($conn, $querycancel)) {
            sendMail("Rejected", $email['email'], $reason);
            $_SESSION['m1'] = $message1 = "Appointment has been Rejected";
            $_SESSION['m2'] = $message2 = "Please check the Rejected tab to see Rejected appointment";
            $_SESSION['updated'] = "true";
        }
        header('Location: admin_APPOINTMENTLIST.php');
    } else if ($_POST["submit"] == "canceled") {
        //do when button in popup pending is clicked
        $id = $_POST["reasonid"];
        $reason = $_POST["reason"];
        if ($reason == "other") {
            $reason = $_POST["others"];
        }
        $querycancel = "UPDATE appointment_details SET appointment_status = 'Canceled', reason = '$reason' WHERE appointment_id = $id";
        $getmail = "SELECT email FROM appointment_details WHERE appointment_id='$id'";
        if ($found = $conn->query($getmail)) {
            $email = $found->fetch_assoc();
        }
        if ($resultcancel = mysqli_query($conn, $querycancel)) {
            sendMail("Canceled", $email['email'], $reason);
            $_SESSION['m1'] = $message1 = "Appointment has been Canceled";
            $_SESSION['m2'] = $message2 = "Please check the canceled tab to see Canceled appointment";
            $_SESSION['updated'] = "true";
        }
        header('Location: admin_APPOINTMENTLIST.php');
    } else if ($_POST["submit"] == "add") {
        $id = $_POST["addid"];
        echo $id;
        $query = "SELECT * FROM appointment_details WHERE appointment_id = $id ";
        $result = mysqli_query($conn, $query);
        while ($row = mysqli_fetch_array($result)) {
            $type = $row[9];
            echo $type;
            if ($type == "Wedding") {
                $details = "SELECT * FROM wedding_details WHERE foreign_id = $id";
                $resultdetails = mysqli_query($conn, $details);

                while ($det = mysqli_fetch_array($resultdetails)) {
                    $queryWedding = "INSERT INTO record_wedding_details VALUE(' ','$det[2]','$det[3]','$det[5]', '$det[6]', '$det[7]', '$det[8]', '$det[9]', '$det[10]', '$det[11]', '$det[12]', '$det[13]', '$det[14]', '$det[20]','$det[21]','$det[22]','$det[23]', '$det[24]', '$det[25]', '$det[26]', '$det[27]', '$det[28]', '$det[29]')";
                    $resultWedding = mysqli_query($conn, $queryWedding);
                }
                $updateRecorded = "UPDATE appointment_details SET recorded='Yes' WHERE appointment_id = $id";
                $resultupdate = mysqli_query($conn, $updateRecorded);
                $_SESSION['m1'] = $message1 = "Appointment has been Added to the Records";
                $_SESSION['m2'] = $message2 = "Please check the Records Page to see Records Details";
                $_SESSION['updated'] = "true";
                header('Location: admin_APPOINTMENTLIST.php');
            } else if ($type == "Baptism") {
                $details = "SELECT * FROM baptism_details WHERE foreign_id = $id";
                $resultdetails = mysqli_query($conn, $details);

                while ($det = mysqli_fetch_array($resultdetails)) {
                    $queryBaptism = "INSERT INTO record_baptism_details VALUE(' ','$det[2]','$det[3]','$det[5]', '$det[6]', '$det[7]', '$det[8]', '$det[9]', '$det[10]', '$det[11]', '$det[12]', '$det[13]', '$det[14]', '$det[15]', '$det[16]', '$det[17]','$det[18]','$det[19]', '$det[20]','$det[21]')";
                    $resultBaptism = mysqli_query($conn, $queryBaptism);
                }
                $updateRecorded = "UPDATE appointment_details SET recorded='Yes' WHERE appointment_id = $id";
                $resultupdate = mysqli_query($conn, $updateRecorded);
                $_SESSION['m1'] = $message1 = "Appointment has been Added to the Records";
                $_SESSION['m2'] = $message2 = "Please check the Records Page to see Records Details";
                $_SESSION['updated'] = "true";
                header('Location: admin_APPOINTMENTLIST.php');
            } else if ($type == "Funeral Mass/Blessing") {
                $details = "SELECT * FROM funeral_details WHERE foreign_id = $id";
                $resultdetails = mysqli_query($conn, $details);
                // $_SESSION['updated'] = "true";
                //header('Location: admin_APPOINTMENTLIST.php');
                while ($det = mysqli_fetch_array($resultdetails)) {
                    $queryFuneral = "INSERT INTO record_funeral_details VALUE(' ','$det[2]','$det[3]','$det[5]', '$det[6]', '$det[7]', '$det[8]', '$det[9]', '$det[10]', '$det[11]', '$det[12]', '$det[13]', '$det[14],$det[15] $det[16]', '$det[17]','$det[18]','$det[19]', '$det[20]')";
                    $resultFuneral = mysqli_query($conn, $queryFuneral);
                }
                $updateRecorded = "UPDATE appointment_details SET recorded='Yes' WHERE appointment_id = $id";
                $resultupdate = mysqli_query($conn, $updateRecorded);
                $_SESSION['m1'] = $message1 = "Appointment has been Added to the Records";
                $_SESSION['m2'] = $message2 = "Please check the Records Page to see Records Details";
                $_SESSION['updated'] = "true";
                header('Location: admin_APPOINTMENTLIST.php');
            }
        }
    }
}

if (isset($_POST['viewmore'])) {
    $_SESSION['id'] = $id = $_POST['id'];
    $_SESSION['type'] = $type = $_POST['type'];
    $_SESSION['view'] = $view = "true";

    header("Location: admin_APPOINTMENTLIST.php");
}

function sendMail($status, $email, $reason)
{
    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 465;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->SMTPAuth = true;
    $mail->IsHTML(true);
    $mail->Username = 'stjohn.automatedmail@gmail.com';
    $mail->Password = 'imhx wzyz vlts uwck';
    $mail->setFrom('stjohn.automatedmail@gmail.com', 'Saint John of the Cross Parish');
    $mail->addReplyTo('stjohn.automatedmail@gmail.com', 'Saint John of the Cross Parish');
    $mail->addAddress($email,  "Receiver");
    $mail->Subject = 'SJCP Status ' . $status;
    if ($reason == 0) {
        $mail->Body    = 'Your Appointment Status is now <b>' . $status . '</b>. Visit the SJCP page to view further details.';
        $mail->AltBody = 'Your Appointment Status is now ' . $status . '. Visit the SJCP page to view further details.';
    } else {
        $mail->Body    = 'Your Appointment Status is now <b>' . $status . '</b>. Reason: ' . $reason . '<br>Visit the SJCP page to view further details.';
        $mail->AltBody = 'Your Appointment Status is now ' . $status . ' Reason: ' . $reason . '. Visit the SJCP page to view further details.';
    }

    if (!$mail->send()) {
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
    }
}