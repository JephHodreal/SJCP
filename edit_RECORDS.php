<?php

session_start();
require 'dbconnect.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="styleEDITREC.css">
	<!-- Font Awesome Icon Script -->
	<script src="https://kit.fontawesome.com/678a3c402d.js" crossorigin="anonymous">
	</script>
	<title>The SJCP - Records</title>
	<link rel="icon" type="image/png" href="tabicon.png">
</head>

<body>
	<div class="content-wrapper">
		<div class="main-content">
			<button type="button" onclick="location.href='admin_RECORDS.php'" class="backbtn"><i class="fa-solid fa-arrow-left"></i>&nbspBack</button>
			<?php
			if (isset($_GET['event'])) {
				$id = $_GET['id'];
				echo '<form action="recordHandler.php" method="post">'; ?>
				<input type="hidden" name="event" value="<?php echo $_GET['event'] ?>">
				<input type="hidden" name="id" value="<?php echo $id ?>">
				<?php echo '<h3>Edit&nbsp<i class="fa-solid fa-pen"></i></h3>';
				if ($_GET['event'] == 'Baptism') {
					$query = "SELECT * FROM record_baptism_details WHERE baptism_id='$id'";
					$sql = $conn->query($query);
					if ($sql->num_rows > 0) {
						while ($row = $sql->fetch_assoc()) { ?>
							<div class="by2">
								<small>Event Date:</small>
								<small>Event Time:</small>
							</div>
							<div class="by2">
								<input type="date" name="eventDate" value="<?php echo $row['event_date'] ?>" id="" disabled>
								<input type="time" name="eventTime" value="<?php echo $row['event_time'] ?>" id="" disabled>
							</div>
							<div class="form-heading">
								Baptized's Information
							</div>
							<div>Name</div>
							<div class="by3">
								<small>Last Name</small>
								<small>First Name</small>
								<small>Middle Name</small>
							</div>
							<div class="by3">
								<input type="text" name="LName" id="" maxlength="40" value="<?php echo $row['lastName'] ?>" pattern="[A-Za-zÀ-ÖØ-öø-ÿ.\s\-]*" required>
								<input type="text" name="FName" id="" maxlength="40" value="<?php echo $row['firstName'] ?>" pattern="[A-Za-zÀ-ÖØ-öø-ÿ.\s\-]*" required>
								<input type="text" name="MName" id="" maxlength="40" value="<?php echo $row['middleName'] ?>" pattern="[A-Za-zÀ-ÖØ-öø-ÿ.\s\-]*">
							</div>
							<div class="by3">
								<small>Gender</small>
								<small>Date of Birth</small>
								<small>Place of Birth</small>
							</div>
							<div class="by3">
								<div>
									<label for="">Male</label>
									<input type="radio" name="Gender" id="" value="Male" <?php if ($row['gender'] == "Male") {
																								echo "checked";
																							} ?> required>
									<label for="">Female</label>
									<input type="radio" name="Gender" id="" value="Female" <?php if ($row['gender'] == "Female") {
																								echo "checked";
																							} ?> required>
								</div>
								<input type="date" name="BapDob" id="" value="<?php echo $row['dob'] ?>" required>
								<input type="text" name="BapPob" id="" value="<?php echo $row['pob'] ?>" maxlength="120" required>
							</div>
							<div class="by1">
								<small>Address</small>
							</div>
							<div class="by1">
								<input type="text" name="Address" id="" value="<?php echo $row['address'] ?>" maxlength=" 120" required>
							</div>
							<div class="by2">
								<small>Father's Name</small>
								<small>Father's Place of Birth</small>
							</div>
							<div class="by2">
								<input type="text" name="BapDad" id="" maxlength="100" value="<?php echo $row['fatherName'] ?>" pattern="[A-Za-zÀ-ÖØ-öø-ÿ.\s\-]*" required>
								<input type="text" name="DadPob" id="" maxlength="120" value="<?php echo $row['father_pob'] ?>" required>
							</div>
							<div class="by2">
								<small>Mother's Name</small>
								<small>Mother's Place of Birth</small>
							</div>
							<div class="by2">
								<input type="text" name="BapMom" id="" maxlength="100" value="<?php echo $row['motherName'] ?>" pattern="[A-Za-zÀ-ÖØ-öø-ÿ.\s\-]*" required>
								<input type="text" name="MomPob" id="" maxlength="120" value="<?php echo $row['mother_pob'] ?>" required>
							</div>
							<div class="by2">
								<small>Parent/Guardian's Contact Number</small>
								<small>Parent's Type of Marriage</small>
							</div>
							<div class="by2">
								<div class="contact">
									<input type="text" name="NumStart" id="" value="+63" readonly>
									<input type="tel" name="ContNum" id="" value="<?php echo trim($row['contactNum'], "+63") ?>" onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57" maxlength="10" pattern="[9]{1}[0-9]{9}" required>
								</div>
								<select name="MarType" id="" required>
									<option value="<?php echo $row['marriage_type'] ?>" selected hidden><?php echo $row['marriage_type'] ?></option>
									<option value="Civil Marriage">Civil Marriage</option>
									<option value="Church Marriage">Church Marriage</option>
								</select>
							</div>
							<div class="by2">
								<small>Godfather's Name</small>
								<small>Godfather's Address</small>
							</div>
							<div class="by2">
								<input type="text" name="GfName" id="" maxlength="100" value="<?php echo $row['godfatherName'] ?>" pattern="[A-Za-zÀ-ÖØ-öø-ÿ.\s\-]*" required>
								<input type="text" name="GfAdd" id="" maxlength="120" value="<?php echo $row['godfather_address'] ?>" required>
							</div>
							<div class="by2">
								<small>Godmother's Name</small>
								<small>Godmother's Address</small>
							</div>
							<div class="by2">
								<input type="text" name="GmName" id="" maxlength="100" value="<?php echo $row['godmotherName'] ?>" pattern="[A-Za-zÀ-ÖØ-öø-ÿ.\s\-]*" required>
								<input type="text" name="GmAdd" id="" maxlength="120" value="<?php echo $row['godmother_address'] ?>" required>
							</div>
						<?php }
					} else {
						echo "Details to this Record cannot be found or unavailable!";
					}
				} else if ($_GET['event'] == 'Confirmation') {
					$query = "SELECT * FROM record_confirmation_details WHERE confirmation_id='$id'";
					$sql = $conn->query($query);
					if ($sql->num_rows > 0) {
						while ($row = $sql->fetch_assoc()) { ?>
							<div class="by2">
								<small>Event Date:</small>
								<small>Event Time:</small>
							</div>
							<div class="by2">
								<input type="date" name="eventDate" value="<?php echo $row['confirmation_date'] ?>" id="" disabled>
								<input type="time" name="eventTime" value="<?php echo $row['confirmation_time'] ?>" id="" disabled>
							</div>
							<div class="form-heading">
								Confirmand's Information
							</div>
							<div>Name</div>
							<div class="by3">
								<small>Last Name</small>
								<small>First Name</small>
								<small>Middle Name</small>
							</div>
							<div class="by3">
								<input type="text" name="LName" id="" maxlength="40" value="<?php echo $row['lastName'] ?>" pattern="[A-Za-zÀ-ÖØ-öø-ÿ.\s\-]*" required>
								<input type="text" name="FName" id="" maxlength="40" value="<?php echo $row['firstName'] ?>" pattern="[A-Za-zÀ-ÖØ-öø-ÿ.\s\-]*" required>
								<input type="text" name="MName" id="" maxlength="40" value="<?php echo $row['middleName'] ?>" pattern="[A-Za-zÀ-ÖØ-öø-ÿ.\s\-]*">
							</div>
							<div class="by3">
								<small>Date of Birth</small>
								<small>Age</small>
								<small>Place of Birth</small>
							</div>
							<div class="by3">
								<input type="date" name="ConfDob" id="" value="<?php echo $row['dob'] ?>" required>
								<input type="num" name="ConfAge" id="" value="<?php echo $row['age'] ?>" required>
								<input type="text" name="ConfPob" id="" value="<?php echo $row['pob'] ?>" maxlength="120" required>
							</div>
							<div class="by3">
								<small>Gender</small>
								<small>Date of Baptism</small>
								<small>Place of Baptism</small>
							</div>
							<div class="by3">
								<div>
									<label for="">Male</label>
									<input type="radio" name="Gender" id="" value="Male" <?php if ($row['gender'] == "Male") {
																								echo "checked";
																							} ?> required>
									<label for="">Female</label>
									<input type="radio" name="Gender" id="" value="Female" <?php if ($row['gender'] == "Female") {
																								echo "checked";
																							} ?> required>
								</div>
								<input type="date" name="BapDate" id="" value="<?php echo $row['dateof_baptism'] ?>" required>
								<input type="text" name="BapPlace" id="" value="<?php echo $row['placeof_baptism'] ?>" maxlength="120" required>
							</div>
							<div class="by3">
								<small>Father's Name</small>
								<small>Mother's Maiden Name</small>
								<small>Guardian's Contact Number</small>
							</div>
							<div class="by3">
								<input type="text" name="ConfDad" id="" maxlength="100" value="<?php echo $row['fatherName'] ?>" pattern="[A-Za-zÀ-ÖØ-öø-ÿ.\s\-]*" required>
								<input type="text" name="ConfMom" id="" maxlength="100" value="<?php echo $row['motherName'] ?>" pattern="[A-Za-zÀ-ÖØ-öø-ÿ.\s\-]*" required>
								<div class="contact">
									<input type="text" name="NumStart" id="" value="+63" readonly>
									<input type="tel" name="ContNum" id="" value="<?php echo trim($row['contactNum'], "+63") ?>" onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57" maxlength="10" pattern="[9]{1}[0-9]{9}" required>
								</div>
							</div>
							<div class="by1">
								<small>Present Address</small>
							</div>
							<div class="by1">
								<input type="text" name="Address" id="" value="<?php echo $row['address'] ?>" maxlength="120" required>
							</div>
							<div class="by2">
								<small>Godfather's Name</small>
								<small>Godmother's Name</small>
							</div>
							<div class="by2">
								<input type="text" name="GfName" id="" maxlength="100" value="<?php echo $row['godfatherName'] ?>" pattern="[A-Za-zÀ-ÖØ-öø-ÿ.\s\-]*" required>
								<input type="text" name="GmName" id="" maxlength="100" value="<?php echo $row['godmotherName'] ?>" pattern="[A-Za-zÀ-ÖØ-öø-ÿ.\s\-]*" required>
							</div>
						<?php }
					} else {
						echo "Details to this Record cannot be found or unavailable!";
					}
				} else if ($_GET['event'] == 'Wedding') {
					$query = "SELECT * FROM record_wedding_details WHERE wedding_id='$id'";
					$sql = $conn->query($query);
					if ($sql->num_rows > 0) {
						while ($row = $sql->fetch_assoc()) { ?>
							<div class="by2">
								<small>Event Date:</small>
								<small>Event Time:</small>
							</div>
							<div class="by2">
								<input type="date" name="eventDate" id="" value="<?php echo $row['event_date'] ?>" disabled>
								<input type="time" name="eventTime" id="" value="<?php echo $row['event_time'] ?>" disabled>
							</div>
							<div class="form-heading">
								Groom's Information
							</div>
							<div>Name</div>
							<div class="by3">
								<small>Last Name</small>
								<small>First Name</small>
								<small>Middle Name</small>
							</div>
							<div class="by3">
								<input type="text" name="GLastN" id="" maxlength="40" value="<?php echo $row['groom_lastName'] ?>" pattern="[A-Za-zÀ-ÖØ-öø-ÿ.\s\-]*" required>
								<input type="text" name="GFirstN" id="" maxlength="40" value="<?php echo $row['groom_firstName'] ?>" pattern="[A-Za-zÀ-ÖØ-öø-ÿ.\s\-]*" required>
								<input type="text" name="GMidN" id="" maxlength="40" value="<?php echo $row['groom_middleName'] ?>" pattern="[A-Za-zÀ-ÖØ-öø-ÿ.\s\-]*">
							</div>
							<div class="by2">
								<small>Contact Number</small>
								<small>Religion</small>
							</div>
							<div class="by2">
								<div class="contact">
									<input type="text" name="NumStart" id="" value="+63" readonly>
									<input type="tel" name="ContNum" id="" value="<?php echo trim($row['groom_contactNum'], "+63") ?>" onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57" maxlength="10" pattern="[9]{1}[0-9]{9}" required>
								</div>
								<select name="GRel" id="" required>
									<option value="<?php echo $row['groom_religion'] ?>" selected hidden><?php echo $row['groom_religion'] ?></option>
									<option value="Roman Catholic">Roman Catholic</option>
									<option value="Catholic">Catholic</option>
									<option value="Protestant">Protestant</option>
									<option value="Iglesia ni Cristo">Iglesia ni Cristo</option>
									<option value="Jehovah&lsquo;s Witness">Jehovah&lsquo;s Witness</option>
									<option value="Seventh Day Adventist">Seventh Day Adventist</option>
									<option value="Islam">Islam</option>
								</select>
							</div>
							<div class="by2">
								<small>Date of Birth</small>
								<small>Place of Birth</small>
							</div>
							<div class="by2">
								<input type="date" name="GDob" id="" value="<?php echo $row['groom_dob'] ?>" required>
								<input type="text" name="GPob" id="" value="<?php echo $row['groom_pob'] ?>" maxlength="120" required>
							</div>
							<div class="by1">
								<small>Present Address</small>
							</div>
							<div class="by1">
								<input type="text" name="GAdd" id="" value="<?php echo $row['groom_address'] ?>" maxlength="120" required>
							</div>
							<div class="by2">
								<small>Father's Name</small>
								<small>Mother's Maiden Name</small>
							</div>
							<div class="by2">
								<input type="text" name="GDad" id="" value="<?php echo $row['groom_fatherName'] ?>" maxlength="100" pattern="[A-Za-zÀ-ÖØ-öø-ÿ.\s\-]*" required>
								<input type="text" name="GMom" id="" value="<?php echo $row['groom_motherName'] ?>" maxlength="100" pattern="[A-Za-zÀ-ÖØ-öø-ÿ.\s\-]*" required>
							</div>

							<div class="form-heading">
								Bride's Information
							</div>
							<div>Name</div>
							<div class="by3">
								<small>Last Name</small>
								<small>First Name</small>
								<small>Middle Name</small>
							</div>
							<div class="by3">
								<input type="text" name="BLastN" id="" value="<?php echo $row['bride_lastName'] ?>" maxlength="40" pattern="[A-Za-zÀ-ÖØ-öø-ÿ.\s\-]*" required>
								<input type="text" name="BFirstN" id="" value="<?php echo $row['bride_firstName'] ?>" maxlength="40" pattern="[A-Za-zÀ-ÖØ-öø-ÿ.\s\-]*" required>
								<input type="text" name="BMidN" id="" value="<?php echo $row['bride_middleName'] ?>" maxlength="40" pattern="[A-Za-zÀ-ÖØ-öø-ÿ.\s\-]*">
							</div>
							<div class="by2">
								<small>Contact Number</small>
								<small>Religion</small>
							</div>
							<div class="by2">
								<div class="contact">
									<input type="text" name="NumStart" id="" value="+63" readonly>
									<input type="tel" name="ContNum" id="" value="<?php echo trim($row['bride_contactNum'], "+63") ?>" onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57" maxlength="10" pattern="[9]{1}[0-9]{9}" required>
								</div>
								<select name="BRel" id="" required>
									<option value="<?php echo $row['bride_religion'] ?>" selected hidden><?php echo $row['bride_religion'] ?></option>
									<option value="Roman Catholic">Roman Catholic</option>
									<option value="Catholic">Catholic</option>
									<option value="Protestant">Protestant</option>
									<option value="Iglesia ni Cristo">Iglesia ni Cristo</option>
									<option value="Jehovah&lsquo;s Witness">Jehovah&lsquo;s Witness</option>
									<option value="Seventh Day Adventist">Seventh Day Adventist</option>
									<option value="Islam">Islam</option>
								</select>
							</div>
							<div class="by2">
								<small>Date of Birth</small>
								<small>Place of Birth</small>
							</div>
							<div class="by2">
								<input type="date" name="BDob" id="" value="<?php echo $row['bride_dob'] ?>" required>
								<input type="text" name="BPob" id="" value="<?php echo $row['bride_pob'] ?>" maxlength="120" required>
							</div>
							<div class="by1">
								<small>Present Address</small>
							</div>
							<div class="by1">
								<input type="text" name="BAdd" id="" value="<?php echo $row['bride_address'] ?>" maxlength="120" required>
							</div>
							<div class="by2">
								<small>Father's Name</small>
								<small>Mother's Maiden Name</small>
							</div>
							<div class="by2">
								<input type="text" name="BDad" id="" value="<?php echo $row['bride_fatherName'] ?>" maxlength="100" pattern="[A-Za-zÀ-ÖØ-öø-ÿ.\s\-]*" required>
								<input type="text" name="BMom" id="" value="<?php echo $row['bride_motherName'] ?>" maxlength="100" pattern="[A-Za-zÀ-ÖØ-öø-ÿ.\s\-]*" required>
							</div>
						<?php }
					} else {
						echo "Details to this Record cannot be found or unavailable!";
					}
				} else if ($_GET['event'] == 'Funeral') {
					$query = "SELECT * FROM record_funeral_details WHERE funeral_id='$id'";
					$sql = $conn->query($query);
					if ($sql->num_rows > 0) {
						while ($row = $sql->fetch_assoc()) { ?>
							<div class="by2">
								<small>Event Date:</small>
								<small>Event Time:</small>
							</div>
							<div class="by2">
								<input type="date" name="eventDate" value="<?php echo $row['event_date'] ?>" id="" disabled>
								<input type="time" name="eventTime" value="<?php echo $row['event_time'] ?>" id="" disabled>
							</div>
							<div class="form-heading">
								Deceased's Information
							</div>
							<div>Name</div>
							<div class="by3">
								<small>Last Name</small>
								<small>First Name</small>
								<small>Middle Name</small>
							</div>
							<div class="by3">
								<input type="text" name="DLast" id="" value="<?php echo $row['lastName'] ?>" maxlength="40" pattern="[A-Za-zÀ-ÖØ-öø-ÿ.\s\-]*" required>
								<input type="text" name="DFirst" id="" value="<?php echo $row['firstName'] ?>" maxlength="40" pattern="[A-Za-zÀ-ÖØ-öø-ÿ.\s\-]*" required>
								<input type="text" name="DMid" id="" value="<?php echo $row['middleName	'] ?>" maxlength="40" pattern="[A-Za-zÀ-ÖØ-öø-ÿ.\s\-]*">
							</div>
							<div class="by2">
								<small>Age</small>
								<small>Gender</small>
							</div>
							<div class="by2">
								<input type="num" name="DAge" value="<?php echo $row['age'] ?>" id="">
								<div>
									<label for="">Male</label>
									<input type="radio" name="Gender" id="" value="Male" <?php if ($row['gender'] == "Male") { echo "checked"; } ?> required>
									<label for="">Female</label>
									<input type="radio" name="Gender" id="" value="Female" <?php if ($row['gender'] == "Female") { echo "checked"; } ?> required>
								</div>
							</div>
							<div class="by2">
								<small>Cause of Death</small>
								<small>Date of Death</small>
							</div>
							<div class="by2">
								<input type="text" name="DCause" id="" value="<?php echo $row['cause_of_death'] ?>" maxlength="120" required>
								<input type="date" name="DeathD" id="" value="<?php echo $row['date_of_death'] ?>" required>
							</div>
							<div class="by2">
								<small>Date of Interment</small>
								<small>Place of Cemetery</small>
							</div>
							<div class="by2">
								<input type="date" name="Interm" id="" value="<?php echo $row['date_of_interment'] ?>" required>
								<input type="text" name="Cemet" id="" value="<?php echo $row['place_of_cemetery'] ?>" maxlength="120" required>
							</div>
							<div class="by2">
								<small>Sacrament Received</small>
								<small>Casket or Urn</small>
							</div>
							<div class="by2">
								<div>
									<label for="">Yes</label>
									<input type="radio" name="Sacram" id="" value="Yes" <?php if ($row['sacrament'] == "Yes") { echo "checked"; } ?> required>
									<label for="">No</label>
									<input type="radio" name="Sacram" id="" value="No" <?php if ($row['sacrament'] == "No") { echo "checked"; } ?> required>
								</div>
								<div>
									<label for="">Casket</label>
									<input type="radio" name="Burial" id="" value="Casket" <?php if ($row['burial'] == "Casket") { echo "checked"; } ?> required>
									<label for="">Urn</label>
									<input type="radio" name="Burial" id="" value="Urn" <?php if ($row['burial'] == "Urn") { echo "checked"; } ?> required>
								</div>
							</div>
							<div class="form-heading">
								Informant's Information
							</div>
							<div>Name</div>
							<div class="by3">
								<small>Last Name</small>
								<small>First Name</small>
								<small>Middle Name</small>
							</div>
							<div class="by3">
								<input type="text" name="InfLN" id="" value="<?php echo $row['informLast'] ?>" maxlength="40" pattern="[A-Za-zÀ-ÖØ-öø-ÿ.\s\-]*" required>
								<input type="text" name="InfFN" id="" value="<?php echo $row['informFirst'] ?>" maxlength="40" pattern="[A-Za-zÀ-ÖØ-öø-ÿ.\s\-]*" required>
								<input type="text" name="InfMN" id="" value="<?php echo $row['informMid'] ?>" maxlength="40" pattern="[A-Za-zÀ-ÖØ-öø-ÿ.\s\-]*">
							</div>
							<div class="by2">
								<small>Contact Number</small>
								<small>Present Address</small>
							</div>
							<div class="by2">
								<div class="contact">
									<input type="text" name="NumStart" id="" value="+63" readonly>
									<input type="tel" name="ContNum" id="" value="<?php echo trim($row['contactNum'], "+63") ?>" onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57" maxlength="10" pattern="[9]{1}[0-9]{9}" required>
								</div>
								<input type="text" name="Address" id="" value="<?php echo $row['address'] ?>" maxlength="120" required>
							</div>
				<?php }
					} else {
						echo "Details to this Record cannot be found or unavailable!";
					}
				} ?>
				<div class="button-area">
					<button type="button" onclick="openForm(clearForm)" id="clear">Cancel</button>
					<button type="button" onclick="openForm(submitForm)" id="submit">Save</button>
				</div>
				<div id="clearForm">
					<div class="popupForm">
						<div class="icon-box"></div>
						<div class="headertext-box">
							Discard changes made?
						</div>
						<div class="form-btnarea">
							<button type="button" onclick="openForm(clearForm)">No</button>
							<button type="reset" onclick="openForm(clearForm)">Yes</button>
						</div>
					</div>
				</div>
				<div id="submitForm">
					<div class="popupForm">
						<div class="icon-box"></div>
						<div class="headertext-box">
							Save changes?
						</div>
						<div class="form-btnarea">
							<button type="button" onclick="openForm(submitForm)">No</button>
							<button type="submit" name="editSub" value="change">Yes</button>
						</div>
					</div>
				</div>
			<?php echo '</form>';
			}
			?>
		</div>
	</div>
	<script src="jsRECORDS.js"></script>
</body>

</html>