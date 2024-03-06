session_start();
require 'dbconnect.php';
$_SESSION['isLoggedIn'] = true;
$id = $_POST['id'];

// Query the database for profile datae
$sql = "SELECT * FROM appointment_details WHERE appointment_id='$id'";
$result = $conn->query($sql);
$row = mysqli_fetch_array($result);

$app_type = $row["appointment_type"];

<div class="events-select-container" id="events-select-container">
	<label for="ddEvent"><strong> Select to Appoint: </strong></label>
	<select class="dropdown" id="ddEvent" name="ddEvent" style="pointer-events: none;">
		<option value="default" hidden></option>
		<option value="Special Event" <?php echo ($isSpecial = ($app_type == "Wedding" || $app_type == "Baptism" || $app_type == "Funeral Mass/Blessing") ? "selected" : "hidden")  ?>>Special Event</option>											
		<option value="Mass Intention" <?php echo ($isMass = ($app_type == "Mass Intention") ? "selected" : "hidden") ?>>Mass Intention</option>
		<option value="Blessing" <?php echo ($isBless = ($app_type == "House Blessing" || $app_type == "Car Blessing" || $app_type == "Motorcycle Blessing" || $app_type == "Store Blessing") ? "selected" : "hidden") ?>>Blessing</option>
		<option value="Document Request" <?php echo ($isDoc = ($app_type == "Baptismal Certificate" || $app_type == "Wedding Certificate" || $app_type == "Confirmation Certificate" || $app_type == "Good Moral Certificate" || $app_type == "Permit and No Record") ? "selected" : "hidden") ?>>Document Request</option>
	</select>
</div> 
<div class="events-select-container" id="specificSpecial" style=<?php echo ($isSpecial = ($app_type == "Wedding" || $app_type == "Baptism" || $app_type == "Funeral Mass/Blessing") ? "display:block" : "display:none") ?>>
	<label for="ddSpecialEvent"><strong>Select Special Event:</strong></label>
	<select class="dropdown" id="ddSpecialEvent" name="Event" style="pointer-events: none;">
		<option value="" hidden>Special Events</option>
		<option value="Wedding" <?php echo ($isWed = ($app_type == "Wedding") ? "selected" : "hidden") ?> >Private Wedding</option>
		<option value="Baptism" <?php echo ($isBap =($app_type == "Baptism") ? "selected" : "hidden") ?>>Private Baptism</option>
		<option value="Funeral Mass/Blessing" <?php echo ($isFun = ($app_type == "Funeral Mass/Blessing") ? "selected" : "hidden") ?> >Funeral Mass/Blessing</option>
	</select>
</div>
<div class="events-select-container" id="specificDocument" style=<?php echo ($isDoc = ($app_type == "Baptismal Certificate" || $app_type == "Wedding Certificate" || $app_type == "Confirmation Certificate" || $app_type == "Good Moral Certificate" || $app_type == "Permit and No Record") ? "display:flex" : "display:none") ?>>
	<label for="ddDocument"><strong>Select Document </strong></label>
	<select class="dropdown" id="ddDocument" name="Event" style="pointer-events: none;">
		<option value="defaultDoc" hidden>Documents</option>
		<option value="Baptismal Certificate" <?php echo ($isBC = ($app_type == "Baptismal Certificate") ? "selected" : "hidden") ?>>Baptismal Certificate</option>
		<option value="Wedding Certificate" <?php echo ($isWC = ($app_type == "Wedding Certificate") ? "selected" : "hidden") ?>>Wedding Certificate</option>
		<option value="Confirmation Certificate" <?php echo ($isCC = ($app_type == "Confirmation Certificate") ? "selected" : "hidden") ?>>Confirmation Certificate</option>
		<option value="Good Moral Certificate" <?php echo ($isGMC = ($app_type == "Good Moral Certificate") ? "selected" : "hidden") ?>>Good Moral Certificate</option>
		<option value="Permit and No Record" <?php echo ($isPNR = ($app_type == "Permit and No Record") ? "selected" : "hidden") ?>>Permit and No Record</option>
	</select>
</div>
<div class="events-select-container" id="chooseCalWed" style=<?php echo ($dateWed = ($app_type == "Wedding") ? "display:block" : "display:none") ?>>
	<div class="cal-container">
		<label for="calDateWed"><strong>Select Date:</strong></label>
		<input type="date" id="calDateWed" name="calDateWed" title="You must schedule your wedding 1-6 months in advance." min="<?= date('Y-m-d', strtotime('+1 month')); ?>" max="<?= date('Y-m-d', strtotime('+6 months')); ?>" required>
	</div>
</div>
<div class="events-select-container" id="chooseCalBap" style=<?php echo ($dateBap = ($app_type == "Baptism") ? "display:block" : "display:none") ?>>
	<div class="cal-container">
		<label for="calDateBap"><strong>Select Date:</strong></label>
		<input type="date" id="calDateBap" name="calDateBap" title="You must schedule your baptism at least 1 week before the event." min="<?= date('Y-m-d', strtotime('+1 week')); ?>" max="<?= date('Y-m-d', strtotime('+6 months')); ?>" required>
	</div>
</div>
<div class="events-select-container" id="chooseCalFuner" style=<?php echo ($dateFun = ($app_type == "Funeral Mass/Blessing") ? "display:block" : "display:none") ?>>
	<div class="cal-container">
		<label for="calDateFuner"><strong>Select Date:</strong></label>
		<input type="date" id="calDateFuner" name="calDateFuner" title="You must schedule the funeral mass or blessing at least three days before the event." min="<?= date('Y-m-d', strtotime('+3 days')); ?>" max="<?= date('Y-m-d', strtotime('+6 weeks')); ?>" required>
	</div>
</div>
<div class="events-select-container" id="chooseCalIntBless" style=<?php echo ($dateNotSpec = ($app_type != "Wedding" && $app_type != "Baptism" && $app_type != "Funeral Mass/Blessing") ? "display:block" : "display:none") ?>>
	<div class="cal-container">
		<label for="calDateIntBless"><strong>Select Date:</strong></label>
		<input type="date" id="calDateIntBless" name="calDateIntBless" min="<?= date('Y-m-d', strtotime('+1 day')); ?>" max="<?= date('Y-m-d', strtotime('+6 months')); ?>" required>
	</div>
</div>
<?php