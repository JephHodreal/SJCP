<?php

session_start();
require 'dbconnect.php';

if (isset($_POST['submit'])) {
    $user = $_POST['username'];
    $pass = hash("sha256", $_POST['admin_pass']);
    $query = "SELECT * FROM login_admininfo WHERE adminUsern='$user'";
    if ($result = $conn->query($query)) {
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if ($row['adminPass'] != $pass) { ?>
                <script>alert("Invalid Password!");</script>
            <?php } else {
                header('Location: admin_DASHBOARD.php');
            }
        } else { ?>
            <script>alert("Invalid Username!");</script>
        <?php }
    } else { ?>
        <script>alert("Login Error, try again!");</script>
    <?php }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styleADMINLOGIN.css">
    <script src="https://kit.fontawesome.com/678a3c402d.js" crossorigin="anonymous"></script>
    <title>The SJCP - Admin Login</title>
	<link rel="icon" type="image/png" href="tabicon.png">
</head>

<body>
    <form action="" method="post">
        <div class="login-card">
            <div class="icon-cont">
                <i class="fa-regular fa-user" style="font-size: 4rem; color: black"></i>
            </div>
            <div class="login-info">
                <span>Username:</span>
                <div class="form-input">
                    <input type="text" name="username" id="" required>
                </div>
            </div>
            <div class="login-info">
                <span>Password: </span>
                <div class="form-input">
                    <input type="password" name="admin_pass" id="pass" required>
                    <i class="fa-solid fa-eye" id="icon" onclick="toggle(pass,icon)"></i>
                </div>
            </div>

            <div class="button-cont">
                <button type="submit" name="submit">Log-in</button>
            </div>
        </div>

    </form>
    <script>
        function toggle(input, icon) {
            var pass = document.getElementById(input.id);
            var eye = document.getElementById(icon.id);
            if (pass.type == "password") {
                pass.type = "text";
                eye.className = "fa-solid fa-eye-slash";
            } else {
                pass.type = "password";
                eye.className = "fa-solid fa-eye";
            }
        }
    </script>
</body>

</html>