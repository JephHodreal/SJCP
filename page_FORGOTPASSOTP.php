<?php
session_start();

$_SESSION['OTPFor'] = 1;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styleFORGOTPASSOTP.css">
    <!-- Font Awesome Icon Script -->
    <script src="https://kit.fontawesome.com/678a3c402d.js" crossorigin="anonymous"></script>
    <title>The SJCP - Forgot Password</title>
	<link rel="icon" type="image/png" href="tabicon.png">
</head>

<body>
    <!-- To update for validation and patterns -->
    <div class="registration-wrapper">
        <!-- Left Section -->
        <section class="left-content">
            <div class="content-wrapper">
                <div class="heading-wrapper">
                    <span><i class="fa-solid fa-church"></i></span>
                    <span>&nbsp&nbspSt. John of the Cross Parish</span>
                </div>
                <div class="direction-wrapper">
                    <strong><span style="font-size: 1.3rem;">Forgot Password?</span></strong>
                    <p>Here's a step-by-step guide to recovering access to your account if you've forgotten your password:</p>
                    <ol>
                        <li>Please enter the email address linked with your account.</li>
                        <li>Check your inbox for the OTP.</li>
                        <li>In the forgot password page, enter the OTP you received.</li>
						<li>Create a new strong and unique password after the OTP verification.</li>
                    </ol>
                    <span>Already Registered? <a href="page_HOME.php" style="color: blue;">Login</a></span>
                </div>
            </div>
        </section>

        <!-- Right/ Form Section -->
        <section class="right-content">
            <div class="registration-part">
                <span><i class="fa-solid fa-church"></i> Finish Forgot Password</span>
            </div>
            <div class="otp-card">
                <button class="backbtn" onclick="history.back()">
                    <i class="fa-solid fa-arrow-left"></i>
                </button>
                 <div class="progress-wrapper">
                    <div class="progress"></div>
                    <hr>
                    <div class="progress"></div>
                </div>
                <div class="form-heading">
                    <span>Verify Account</span>
                </div>
                <div class="info-content">
                    <p style="text-align: center;">
                        Please enter the verification code that was sent to
                        your email <strong><?php //echo $_SESSION['email'] ?></strong>. The code is
                        valid for 30 minutes.
                    </p>
                </div>
                <form action="validationForgotpass.php" method="post">
                    <div class="otp-input">
                        <span>Enter your OTP here</span>
                        <input type="text" name="userOTP" id="">
                        <?php
                        if (!isset($_SESSION['isValidOTP'])) {
                        } else if (!$_SESSION['isValidOTP']) {
                            echo '<span>Invalid OTP</span>';
                        }
                        ?>
                        <br>
                        <div class="form-input">
                            <span>New Password</span>
                            <div class="password-space">
                                <input type="password" name="password" id="password" onkeyup="checkPass(),checkReq(),checkConfirm();" required>
                                <i class="fa-solid fa-eye" id="viewPass" onclick="toggle(password,viewPass)"></i>
                            </div>
                        </div>
                        <div class="form-input">
                            <span>Confirm New Password</span>
                            <div class="password-space">
                                <input type="password" name="conpassword" id="cpass" onkeyup="checkPass(),checkReq(),checkConfirm();" required>
                                <i class="fa-solid fa-eye" id="viewCPass" onclick="toggle(cpass,viewCPass)"></i>
                            </div>
                        </div>
						<div class="error pass" id="errorPass">Passwords do not match</div>
						<div class="pass-requirements">
                            <span>Password Requirements:</span>
                            <div class="requirement">
                                <span class="req1"><i class="fa-solid fa-circle-exclamation req1"></i> At least 8 characters long</span>
                            </div>
                            <div class="requirement">
                                <span class="req2"><i class="fa-solid fa-circle-exclamation req2"></i> A combination of uppercase and lowercase letters</span>
                            </div>
                            <div class="requirement">
                                <span class="req3"><i class="fa-solid fa-circle-exclamation req3"></i> Must contain at least one special character</span>
                            </div>
                        </div>
                    </div>
                    <div class="option-wrapper">
                        <button type="submit" id="regSub" name="submitOTP">Submit</button>
                </form>
                <form action="sendOTP.php" method="post">
                    <span id="resend"><input type="submit" name="submit" value="Resend OTP"></span>
                </form>
            </div>
            </div>
        </section>
    </div>
   
    <?php
        unset($_SESSION['isValidOTP']);
    ?>
    <script>
        const resend = document.getElementById('resend');
        window.addEventListener("DOMContentLoaded", () => {
            let count = 30;
            const update = () => {
                resend.innerText = 'Resend OTP in ' + count;
            }

            const countdown = () => {
                update();
                if (count > 0) {
                    count--;
                    setTimeout(countdown, 1000);
                } else {
                    resend.innerHTML = '<input type="submit" name="submit" value="Resend OTP">';
                }
            }

            countdown();
        });
        
        function toggle(input,icon) {
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
        
        const req1 = document.getElementsByClassName("req1");
        const req2 = document.getElementsByClassName("req2");
        const req3 = document.getElementsByClassName("req3");
        
        const passReq2 = /^(?=.*[A-Z])(?=.*[a-z])/;
        const passReq3 = /^(?=.*[!@#$%^&*])/;
        
        const checkPass = () => {
            const password = document.getElementById("password");
            if (password.value != null && password.value.length >= 8) {
                for (var index = 0; index < req1.length; index++)
                    req1[index].style.color = "green";
                if (req1[1].className == "fa-solid fa-circle-exclamation req1" || req1[1].className == "fa-solid fa-xmark req1") {
                    req1[1].className = "fa-solid fa-check req1"
                }
            } else if (password.value.length != 0 && password.value.length < 8) {
                for (var index = 0; index < req1.length; index++)
                    req1[index].style.color = "red";
                if (req1[1].className == "fa-solid fa-circle-exclamation req1" || req1[1].className == "fa-solid fa-check req1") {
                    req1[1].className = "fa-solid fa-xmark req1"
                }
            } else if (password.value.length == 0) {
                for (var index = 0; index < req1.length; index++)
                    req1[index].style.color = "var(--black)";
                req1[1].className = "fa-solid fa-circle-exclamation req1";
                for (var index = 0; index < req2.length; index++)
                    req2[index].style.color = "var(--black)";
                req2[1].className = "fa-solid fa-circle-exclamation req2";
                for (var index = 0; index < req3.length; index++)
                    req3[index].style.color = "var(--black)";
                req3[1].className = "fa-solid fa-circle-exclamation req3";
            }
            
        
            // password requirement 2
            if(password.value.match(passReq2)) {
                for (var index = 0; index < req2.length; index++)
                    req2[index].style.color = "green";
                if (req2[1].className == "fa-solid fa-circle-exclamation req2" || req2[1].className == "fa-solid fa-xmark req2") {
                    req2[1].className = "fa-solid fa-check req2"
                }
            } else if (!password.value.match(passReq2) && password.value.length > 0) {
                for (var index = 0; index < req2.length; index++)
                    req2[index].style.color = "red";
                if (req2[1].className == "fa-solid fa-circle-exclamation req2" || req2[1].className == "fa-solid fa-check req2") {
                    req2[1].className = "fa-solid fa-xmark req2"
                }
            }
        
            // pass req 3
            if(password.value.match(passReq3)) {
                for (var index = 0; index < req3.length; index++)
                    req3[index].style.color = "green";
                if (req3[1].className == "fa-solid fa-circle-exclamation req3" || req3[1].className == "fa-solid fa-xmark req3") {
                    req3[1].className = "fa-solid fa-check req3"
                }
            } else if (!password.value.match(passReq3) && password.value.length > 0) {
                for (var index = 0; index < req2.length; index++)
                    req3[index].style.color = "red";
                if (req3[1].className == "fa-solid fa-circle-exclamation req3" || req3[1].className == "fa-solid fa-check req3") {
                    req3[1].className = "fa-solid fa-xmark req3"
                }
            }
        }
        
        function checkReq() {
            var password = document.getElementById('password');
            var submitReg = document.getElementById('regSub');
            var cpass = document.getElementById('cpass');
            if (password.value.length >= 8 && password.value.match(passReq2) && password.value.match(passReq3)) {
                submitReg.disabled = false;
                submitReg.style.backgroundColor = "lightgreen";
                submitReg.style.color = "green";
            } else if (password.value !== cpass.value) {
                submitReg.disabled = true;
                submitReg.style.backgroundColor = "gray";
                submitReg.style.color = "white";
            }
        }
		
		const checkConfirm = () => {
			const password = document.getElementById("password");
			const cpass = document.getElementById('cpass');

			if (password.value != cpass.value && cpass.value.length != 0) {
				document.getElementById("errorPass").style.display = "block";
			} else if (password.value == cpass.value || cpass.value.length == 0) {
				document.getElementById("errorPass").style.display = "none";
			}
		}
    </script>
</body>

</html>