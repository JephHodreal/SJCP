<?php
	session_start();
	require 'dbconnect.php';
	if(isset($_POST["submitform"])){
        $email = $_SESSION['login_email'];
        $queryname = "SELECT * FROM login_userinfo WHERE email = '$email'";
        $resultname = mysqli_query($conn, $queryname);
        while($row = mysqli_fetch_assoc($resultname)) {
            $name = $row['firstName']. " ". $row['lastName'];
        }

		$Eventtype = $_SESSION['type'];
		$Eventdate = $_SESSION['date'];
        date_default_timezone_set('Asia/Manila');
        $dateappointed = date("Y-m-d");
        $timeappointed = date("h:i:s");
        $reference = "SJCP".substr(str_shuffle("0123456789"),0, 8);
		if($Eventtype == "Special Event"){
            $rdtime =  $_POST["rdtime"];
            $time = explode(" ", $rdtime);
			$Event = $_SESSION['event'];
			
			if($Event == "Wedding"){
                $gLastName = $_POST["groom_lastName"];
                $gFirstName = $_POST["groom_firstName"];
                $gMiddleName = $_POST["groom_middleName"];
                $gContactNum = $_POST["groom_contactNum"];
                $gDob = $_POST["groom_dob"];
                $gPob = $_POST["groom_pob"];
                $gAddress = $_POST["groom_address"];
                $gFather = $_POST["groom_fatherName"];
                $gMother = $_POST["groom_motherName"];
                $gReligion = $_POST["groom_religion"];
                $gid = basename($_FILES['groom_idpic']['name']);
                $gpsa = basename($_FILES['groom_psa']['name']);
                $gcenomar = basename($_FILES['groom_cenomar']['name']);
                $gbaptismal = basename($_FILES['groom_baptismal']['name']);
                $gconfirmation = basename($_FILES['groom_confirmation']['name']);

                $bLastName = $_POST["bride_lastName"];
                $bFirstName = $_POST["bride_firstName"];
                $bMiddleName = $_POST["bride_middleName"];
                $bContactNum = $_POST["bride_contactNum"];
                $bDob = $_POST["bride_dob"];
                $bPob = $_POST["bride_pob"];
                $bAddress = $_POST["bride_address"];
                $bFather = $_POST["bride_fatherName"];
                $bMother = $_POST["bride_motherName"];
                $bReligion = $_POST["bride_religion"];
                $bid = basename($_FILES['bride_idpic']['name']);
                $bpsa = basename($_FILES['bride_psa']['name']);
                $bcenomar = basename($_FILES['bride_cenomar']['name']);
                $bbaptismal = basename($_FILES['bride_baptismal']['name']);
                $bconfirmation = basename($_FILES['bride_confirmation']['name']);
				
                $ccontract = basename($_FILES['couple_contract']['name']);

                $queryappointment = "INSERT INTO appointment_details VALUE(0,'$reference', '$name', '$email', '$dateappointed', '$timeappointed', '$Eventdate', '$time[0]', '$time[1]', '$Event', 'Pending', '', 'no')";
			    $resultappointment = mysqli_query($conn, $queryappointment);
                //getting the appointments id to save as foreign key in wedding details
                $Id = 0;
                $queryid = "SELECT appointment_id FROM appointment_details WHERE appointment_id = LAST_INSERT_ID()";
                $resultid = mysqli_query($conn, $queryid);
                while($row = mysqli_fetch_array($resultid)) {
                    $Id = $row[0];
                }
				
				$folder = "uploads/";
				
				$subFolder = $gLastName . $bLastName . $Event . $Eventdate;
				if (!file_exists($folder.$subFolder)) {
					mkdir($folder.$subFolder, 0777, true);  //create directory if not exist
				}
				
				$array = array($gid,$gpsa,$gcenomar,$gbaptismal,$gconfirmation,$bid,$bpsa,$bcenomar,$bbaptismal,$bconfirmation,$ccontract);
				$array2 = array($_FILES["groom_idpic"]["tmp_name"],$_FILES["groom_psa"]["tmp_name"],$_FILES["groom_cenomar"]["tmp_name"],$_FILES["groom_baptismal"]["tmp_name"],
						$_FILES["groom_confirmation"]["tmp_name"],$_FILES["bride_idpic"]["tmp_name"],$_FILES["bride_psa"]["tmp_name"],$_FILES["bride_cenomar"]["tmp_name"],
						$_FILES["bride_baptismal"]["tmp_name"],$_FILES["bride_confirmation"]["tmp_name"],$_FILES["couple_contract"]["tmp_name"]);
				$allowTypes = array('jpg','png','jpeg','gif','jfif','tiff','svg','tif');
				for($a=0; $a<count($array); $a++){
					$targetFilePath = $folder . $subFolder . "/" . $array[$a];
					$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
					
					if(in_array($fileType, $allowTypes)){
						move_uploaded_file($array2[$a], $targetFilePath);
					}
				}
                
                $queryWedding = "INSERT INTO wedding_details VALUE(0,'$Id','$Eventdate', '$time[0]', '$time[1]', '$gLastName', '$gFirstName', '$gMiddleName', '+63$gContactNum', '$gDob', '$gPob', '$gAddress', '$gFather', '$gMother', '$gReligion','$gid','$gpsa', '$gcenomar','$gbaptismal','$gconfirmation','$bLastName', '$bFirstName', '$bMiddleName', '+63$bContactNum', '$bDob', '$bPob', '$bAddress', '$bFather', '$bMother', '$bReligion','$bid','$bpsa', '$bcenomar','$bbaptismal','$bconfirmation','$ccontract')";
			    $resultWedding = mysqli_query($conn, $queryWedding);
                //echo "Please wait 1 to 2 days for schedule approval in ". $Eventtype ;
                
			} else if($Event == "Baptism"){
				
                //echo $time[0].", ".$time[1];

                $bapLastName = $_POST["lastName"];
                $bapFirstName = $_POST["firstName"];
                $bapMiddleName = $_POST["middleName"];
                $bapGender = $_POST["gender"];
                $bapDob = $_POST["dob"];
                $bapPob = $_POST["pob"];
                $bapAddress = $_POST["address"];
                $bapContactNum = $_POST["contactNum"];
                $bapFather = $_POST["fatherName"];
                $bapFatherPob = $_POST["fatherPob"];
                $bapMother = $_POST["motherName"];
                $bapMotherPob = $_POST["motherPob"];
                $bapMarriage = $_POST["marriage_type"];
                $bapGodf = $_POST["godfatherName"];
                $bapGodfAddress = $_POST["godfatherAddress"];
                $bapGodm = $_POST["godmotherName"];
                $bapGodmAddress = $_POST["godmotherAddress"];
				$bappsa = basename($_FILES['psa']['name']);
                $bapcontract = basename($_FILES['marriage_contract']['name']);

                $queryappointment = "INSERT INTO appointment_details VALUE(0,'$reference', '$name', '$email', '$dateappointed', '$timeappointed', '$Eventdate', '$time[0]', '$time[1]', '$Event', 'Pending', '', 'no' )";
			    $resultappointment = mysqli_query($conn, $queryappointment);
                //getting the appointments id to save as foreign key in wedding details
                $foreignId = 0;
                $queryid = "SELECT appointment_id FROM appointment_details WHERE appointment_id = LAST_INSERT_ID()";
                $resultid = mysqli_query($conn, $queryid);
                while($row = mysqli_fetch_array($resultid)) {
                    $foreignId = $row[0];
                }
				
				$folder = "uploads/";
				
				$subFolder = $bapFirstName . $bapLastName . $Event . $Eventdate;
				if (!file_exists($folder.$subFolder)) {
					mkdir($folder.$subFolder, 0777, true);  //create directory if not exist
				}
				
				$array = array($bappsa,$bapcontract);
				$array2 = array($_FILES["psa"]["tmp_name"],$_FILES["marriage_contract"]["tmp_name"]);
				$allowTypes = array('jpg','png','jpeg','gif','jfif','tiff','svg','tif');
				for($a=0; $a<count($array); $a++){
					$targetFilePath = $folder . $subFolder . "/" . $array[$a];
					$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
					
					if(in_array($fileType, $allowTypes)){
						move_uploaded_file($array2[$a], $targetFilePath);
					}
				}
    
                $queryBaptism = "INSERT INTO baptism_details VALUE(0,'$foreignId','$Eventdate', '$time[0]', '$time[1]','$bapLastName','$bapFirstName','$bapMiddleName','$bapGender','$bapDob','$bapPob','$bapAddress','+63$bapContactNum','$bapFather','$bapFatherPob','$bapMother','$bapMotherPob','$bapMarriage','$bapGodf','$bapGodfAddress','$bapGodm','$bapGodmAddress', '$bappsa', '$bapcontract')";
			    $resultBaptism = mysqli_query($conn, $queryBaptism);
                //echo "Please wait 1 to 2 days for schedule approval in ". $Eventtype ;
                
			} else if($Event == "Funeral Mass/Blessing"){

                //echo $time[0];

                $deadLastName = $_POST["lastName"];
                $deadFirstName = $_POST["firstName"];
                $deadMiddleName = $_POST["middleName"];
                $deadAge = $_POST["age"];
                $deadGender = $_POST["gender"];
                $deadDod = $_POST["date_of_death"];
                $deadDoi = $_POST["date_of_internment"];
                $deadCemetery = $_POST["place_of_cemetery"];
                $deadCause = $_POST["cause_of_death"];
                $deadSacrament = $_POST["sacrament"];
                $deadBurial = $_POST["burial"];
				$deathcert = basename($_FILES['deathcert']['name']);
				
				if ($deadBurial == "Casket") {
					$finalType = "Funeral Mass";
				} else {
					$finalType = "Funeral Blessing";
				}

                $infLast = $_POST["informantLastName"];
                $infFirst = $_POST["informantFirstName"];
                $infMid = $_POST["informantMiddleName"];
                $infContactNum = $_POST["informantContactNum"];
                $infAddress = $_POST["informantAddress"];

                $queryappointment = "INSERT INTO appointment_details VALUE(0,'$reference', '$name', '$email', '$dateappointed', '$timeappointed', '$Eventdate', '$time[0]', '00:00:00', '$Event', 'Pending', '', 'no' )";
			    $resultappointment = mysqli_query($conn, $queryappointment);
                //getting the appointments id to save as foreign key in wedding details
                $foreignId = 0;
                $queryid = "SELECT appointment_id FROM appointment_details WHERE appointment_id = LAST_INSERT_ID()";
                $resultid = mysqli_query($conn, $queryid);
                while($row = mysqli_fetch_array($resultid)) {
                    $foreignId = $row[0];
                }
				
				$folder = "uploads/";
				
				$subFolder = $deadFirstName . $deadLastName . $finalType . $Eventdate;
				if (!file_exists($folder.$subFolder)) {
					mkdir($folder.$subFolder, 0777, true);  //create directory if not exist
				}
				
				$allowTypes = array('jpg','png','jpeg','gif','jfif','tiff','svg','tif');
				$targetFilePath = $folder . $subFolder . "/" . $deathcert;
				$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
				if(in_array($fileType, $allowTypes)){
					move_uploaded_file($_FILES["deathcert"]["tmp_name"], $targetFilePath);
				}

                $queryFuneral = "INSERT INTO funeral_details VALUE(0,'$foreignId','$Eventdate', '$time[0]', '00:00:00','$deadLastName','$deadFirstName','$deadMiddleName','$deadGender','$deadDod','$deadAge','$deadCause','$deadDoi','$deadCemetery','$infLast','$infFirst','$infMid','+63$infContactNum','$infAddress','$deadSacrament','$deadBurial', '$deathcert')";
			    $resultFuneral= mysqli_query($conn, $queryFuneral);

                //echo "Please wait 1 to 2 days for schedule approval in ". $Eventtype ;

			} else {
                //do nothing
			}
		} else if($Eventtype == "Mass Intention"){
            $rdtime =  $_POST["rdtime"];
            $time = explode(" ", $rdtime);
            $contactnum = $_POST["contactNum"];
            $rdpurpose = $_POST["purposes"];
            $names = $_POST["names"];
            $queryappointment = "INSERT INTO appointment_details VALUE(0,'$reference', '$name', '$email', '$dateappointed', '$timeappointed', '$Eventdate', '$time[0]', '', 'Mass Intention', 'Pending', '', 'no' )";
			$resultappointment = mysqli_query($conn, $queryappointment);
            //getting the appointments id to save as foreign key in wedding details
            $foreignId = 0;
            $queryid = "SELECT appointment_id FROM appointment_details WHERE appointment_id = LAST_INSERT_ID()";
            $resultid = mysqli_query($conn, $queryid);
            while($row = mysqli_fetch_array($resultid)) {
                $foreignId = $row[0];
            }

            $queryIntention = "INSERT INTO mass_intention_details VALUE(0,'$foreignId','+63$contactnum','$Eventdate', '$time[0]', '$rdpurpose', '$names')";
			$resultIntention = mysqli_query($conn, $queryIntention);
           // echo "Please wait 1 to 2 days for schedule approval in ". $Eventtype ;

		} else if($Eventtype == "Blessing"){
			$contactnum = $_POST["contactNum"];
			$blessingtype = $_POST["blessingType"];
            $blessAdd = $_POST["address"];
			$queryappointment = "INSERT INTO appointment_details VALUE(0,'$reference', '$name', '$email', '$dateappointed', '$timeappointed', '$Eventdate', '', '', '$blessingtype', 'Pending', '', 'no' )";
			$resultappointment = mysqli_query($conn, $queryappointment);
            //getting the appointments id to save as foreign key in wedding details
            $foreignId = 0;
            $queryid = "SELECT appointment_id FROM appointment_details WHERE appointment_id = LAST_INSERT_ID()";
            $resultid = mysqli_query($conn, $queryid);
            while($row = mysqli_fetch_array($resultid)) {
                $foreignId = $row[0];
            }
			$queryblessing = "INSERT INTO blessing_details VALUE(0,'$foreignId','+63$contactnum','$Eventdate', '', '$blessingtype', '$blessAdd')";
			$resultblessing = mysqli_query($conn, $queryblessing);
            //echo "Please wait 1 to 2 days for schedule approval in ". $Eventtype ;
		} else if($Eventtype == "Document Request"){
            $Event = $_SESSION['event'];
			//common inputs
            $lname = $_POST["lastName"];
            $fname = $_POST["firstName"];
            $mname = $_POST["middleName"];
            $contactnum = $_POST["ContactNum"];
			$birthcert = basename($_FILES['birthcert']['name']);
            if($Event == "Baptismal Certificate" || $Event == "Wedding Certificate" || $Event == "Confirmation Certificate"){
                $dob = $_POST["dob"];
                $fathersname = $_POST["fname"];
                $mothersname = $_POST["mname"];
                $purpose = $_POST["purpose"];

                $queryappointment = "INSERT INTO appointment_details VALUE(0,'$reference', '$name', '$email', '$dateappointed', '$timeappointed', '$Eventdate', '00:00:00', '00:00:00', '$Event', 'Pending', '', 'no')";
                $resultappointment = mysqli_query($conn, $queryappointment);
                //getting the appointments id to save as foreign key in wedding details
                $foreignId = 0;
                $queryid = "SELECT appointment_id FROM appointment_details WHERE appointment_id = LAST_INSERT_ID()";
                $resultid = mysqli_query($conn, $queryid);
                while($row = mysqli_fetch_array($resultid)) {
                    $foreignId = $row[0];
                }
				
				$folder = "uploads/";
				
				$subFolder = $fname . $lname . $Event . $Eventdate;
				if (!file_exists($folder.$subFolder)) {
					mkdir($folder.$subFolder, 0777, true);  //create directory if not exist
				}
				
				$allowTypes = array('jpg','png','jpeg','gif','jfif','tiff','svg','tif');
				$targetFilePath = $folder . $subFolder . "/" . $birthcert;
				$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
				if(in_array($fileType, $allowTypes)){
					move_uploaded_file($_FILES["birthcert"]["tmp_name"], $targetFilePath);
				}
				
                $queryDocument = "INSERT INTO document_request_details VALUE(0,'$foreignId','$Eventdate','$Event', '$fname', '$mname', '$lname', '$dob', '$fathersname', '$mothersname', '+63$contactnum', '$purpose', '', '$birthcert', '', '')";
                $resultDocument = mysqli_query($conn, $queryDocument);
                //echo "Please wait 1 to 2 days for schedule approval in ". $Eventtype ;
            } else if($Event == "Good Moral Certificate"){
                $dob = $_POST["dob"];
                $purpose = $_POST["purpose"];
				$barangaycert = basename($_FILES['barangaycert']['name']);
				$kawancert = basename($_FILES['kawancert']['name']);
				
                $queryappointment = "INSERT INTO appointment_details VALUE(0,'$reference', '$name', '$email', '$dateappointed', '$timeappointed', '$Eventdate', ' ', '', '$Event', 'Pending', '', 'no' )";
                $resultappointment = mysqli_query($conn, $queryappointment);
                //getting the appointments id to save as foreign key in wedding details
                $foreignId = 0;
                $queryid = "SELECT appointment_id FROM appointment_details WHERE appointment_id = LAST_INSERT_ID()";
                $resultid = mysqli_query($conn, $queryid);
                while($row = mysqli_fetch_array($resultid)) {
                    $foreignId = $row[0];
                }
				
				$folder = "uploads/";
				
				$subFolder = $fname . $lname . $Event . $Eventdate;
				if (!file_exists($folder.$subFolder)) {
					mkdir($folder.$subFolder, 0777, true);  //create directory if not exist
				}
				
				$array = array($birthcert,$barangaycert,$kawancert);
				$array2 = array($_FILES["birthcert"]["tmp_name"],$_FILES["barangaycert"]["tmp_name"],$_FILES["kawancert"]["tmp_name"]);
				$allowTypes = array('jpg','png','jpeg','gif','jfif','tiff','svg','tif');
				for($a=0; $a<count($array); $a++){
					$targetFilePath = $folder . $subFolder . "/" . $array[$a];
					$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
					
					if(in_array($fileType, $allowTypes)){
						move_uploaded_file($array2[$a], $targetFilePath);
					}
				}
				
                $queryDocument = "INSERT INTO document_request_details VALUE(0,'$foreignId','$Eventdate','$Event', '$fname', '$mname', '$lname', '$dob', '', '', '+63$contactnum', '$purpose', '', '$birthcert', '$barangaycert', '$kawancert')";
                $resultDocument = mysqli_query($conn, $queryDocument);
                //echo "Please wait 1 to 2 days for schedule approval in ". $Eventtype ;
            } else if($Event == "Permit and No Record") {
                $dob = $_POST["dob"];
                $purpose = $_POST["purpose"];
                $address = $_POST["address"];
                $queryappointment = "INSERT INTO appointment_details VALUE(0,'$reference', '$name', '$email', '$dateappointed', '$timeappointed', '$Eventdate', ' ', '', '$Event', 'Pending', '', 'no' )";
                $resultappointment = mysqli_query($conn, $queryappointment);
                //getting the appointments id to save as foreign key in wedding details
                $foreignId = 0;
                $queryid = "SELECT appointment_id FROM appointment_details WHERE appointment_id = LAST_INSERT_ID()";
                $resultid = mysqli_query($conn, $queryid);
                while($row = mysqli_fetch_array($resultid)) {
                    $foreignId = $row[0];
                }
				
				$folder = "uploads/";
				
				$subFolder = $fname . $lname . $Event . $Eventdate;
				if (!file_exists($folder.$subFolder)) {
					mkdir($folder.$subFolder, 0777, true);  //create directory if not exist
				}
				
				$allowTypes = array('jpg','png','jpeg','gif','jfif','tiff','svg','tif');
				$targetFilePath = $folder . $subFolder . "/" . $birthcert;
				$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
				if(in_array($fileType, $allowTypes)){
					move_uploaded_file($_FILES["birthcert"]["tmp_name"], $targetFilePath);
				}
				
                $queryDocument = "INSERT INTO document_request_details VALUE(0,'$foreignId','$Eventdate','$Event', '$fname', '$mname', '$lname', '$dob', '', '', '+63$contactnum', '$purpose', '$address', '$birthcert', '', '')";
                $resultDocument = mysqli_query($conn, $queryDocument);
                //echo "Please wait 1 to 2 days for schedule approval in ". $Eventtype ;
            }
		}
		$_SESSION['m1'] = $message1 ="Your Request has been submitted"; 
        $_SESSION['m2'] = $message2 = "Please wait 1 to 2 days for schedule approval";
        $_SESSION['inserted'] = "true";
        header("Location: page_SCHEDULEEVENT.php");

    } else if(isset($_POST["reasonsubmit"])){
        $id = $_POST["id"];
        $reason = $_POST["reason"];
        if($reason == "other"){
            $reason = $_POST["others"];
        }
        $querycancel = "UPDATE appointment_details SET appointment_status = 'Canceled', reason = '$reason' WHERE appointment_id = $id";
        $resultcancel = mysqli_query($conn, $querycancel);
        $_SESSION['m1'] = $message1 = "Appointment has been canceled";
        $_SESSION['m2'] = $message2 = "Please check the canceled tab if you want to reschedule your appointment.";
        $_SESSION['updated'] = "true";
        header("Location: page_APPOINTMENTS.php");
    } else if(isset($_POST["reschedYes"])){

        $_SESSION["id"] = $_POST['id'];
		header("Location: page_RESCHEDULE.php");

    } else if(isset($_POST["submitlog"])) {

		$type = $_POST["ddEvent"]; // name ng select to appoint
        $date = $_POST["cal"]; // name ng calendar=
		if ($type == "Special Event" || $type == "Document Request") {
			$event = $_POST["Event"]; // name ng specific Special Event/Document Request
		} else {
            $event = $type;
        }
        $_SESSION['event'] = $event;
		$_SESSION['type'] = $type;
		$_SESSION['date'] = $date;
		$_SESSION['abcde'] = true;
		header("Location: page_RESCHEDULE.php");
    }else if(isset($_POST["viewmore"])){
        //get the hidden input id then query the value in table
        $_SESSION['id'] = $id = $_POST['id'];
        $_SESSION['type'] = $type = $_POST['type'];
        $_SESSION['view'] = $view = "true";

        header("Location: page_APPOINTMENTS.php");
    } else if(isset($_POST['status'])){
    //for user status filter
       $_SESSION['status'] = $_POST['status'];
        header('Location: page_APPOINTMENTS.php');
        
    }else if(isset($_POST["updateform"])){
        //change insert query into update querey
        $id = $_SESSION['id'];
        $Eventtype = $_SESSION['type'];
		$Eventdate = $_SESSION['date'];
        date_default_timezone_set('Asia/Manila');
        $dateappointed = date("Y-m-d");
        $timeappointed = date("h:i:s A");
        $reference = "SJCP".substr(str_shuffle("0123456789"),0, 8);
		if($Eventtype == "Special Event"){
            $rdtime =  $_POST["rdtime"];
            $time = explode(" ", $rdtime);
			$Event = $_SESSION['event'];
			
			if($Event == "Wedding"){
                $gLastName = $_POST["groom_lastName"];
                $gFirstName = $_POST["groom_firstName"];
                $gMiddleName = $_POST["groom_middleName"];
                $gContactNum = $_POST["groom_contactNum"];
                $gDob = $_POST["groom_dob"];
                $gPob = $_POST["groom_pob"];
                $gAddress = $_POST["groom_address"];
                $gFather = $_POST["groom_fatherName"];
                $gMother = $_POST["groom_motherName"];
                $gReligion = $_POST["groom_religion"];
                $gid = basename($_FILES['groom_idpic']['name']);
                $gpsa = basename($_FILES['groom_psa']['name']);
                $gcenomar = basename($_FILES['groom_cenomar']['name']);
                $gbaptismal = basename($_FILES['groom_baptismal']['name']);
                $gconfirmation = basename($_FILES['groom_confirmation']['name']);

                $bLastName = $_POST["bride_lastName"];
                $bFirstName = $_POST["bride_firstName"];
                $bMiddleName = $_POST["bride_middleName"];
                $bContactNum = $_POST["bride_contactNum"];
                $bDob = $_POST["bride_dob"];
                $bPob = $_POST["bride_pob"];
                $bAddress = $_POST["bride_address"];
                $bFather = $_POST["bride_fatherName"];
                $bMother = $_POST["bride_motherName"];
                $bReligion = $_POST["bride_religion"];
                $bid = basename($_FILES['bride_idpic']['name']);
                $bpsa = basename($_FILES['bride_psa']['name']);
                $bcenomar = basename($_FILES['bride_cenomar']['name']);
                $bbaptismal = basename($_FILES['bride_baptismal']['name']);
                $bconfirmation = basename($_FILES['bride_confirmation']['name']);
				
                $ccontract = basename($_FILES['couple_contract']['name']);

                $queryappointment = "UPDATE appointment_details SET referenceNum='$reference', date_appointed='$dateappointed', time_appointed='$timeappointed', event_date='$Eventdate', event_timeStart='$time[0]', event_timeEnd='$time[1]', appointment_type='$Event', appointment_status='Pending', reason='', recorded='no' WHERE appointment_id='$id'";
			    $resultappointment = mysqli_query($conn, $queryappointment);
                
				$folder = "uploads/";
				
				$subFolder = $gLastName . $bLastName . $Event . $Eventdate;
				if (!file_exists($folder.$subFolder)) {
					mkdir($folder.$subFolder, 0777, true);  //create directory if not exist
				}
				
				$array = array($gid,$gpsa,$gcenomar,$gbaptismal,$gconfirmation,$bid,$bpsa,$bcenomar,$bbaptismal,$bconfirmation,$ccontract);
				$array2 = array($_FILES["groom_idpic"]["tmp_name"],$_FILES["groom_psa"]["tmp_name"],$_FILES["groom_cenomar"]["tmp_name"],$_FILES["groom_baptismal"]["tmp_name"],$_FILES["groom_confirmation"]["tmp_name"],$_FILES["bride_idpic"]["tmp_name"],$_FILES["bride_psa"]["tmp_name"],$_FILES["bride_cenomar"]["tmp_name"],$_FILES["bride_baptismal"]["tmp_name"],$_FILES["bride_confirmation"]["tmp_name"],$_FILES["couple_contract"]["tmp_name"]);
				$allowTypes = array('jpg','png','jpeg','gif','jfif','tiff','svg','tif');
				for($a=0; $a<count($array); $a++){
					$targetFilePath = $folder . $subFolder . "/" . $array[$a];
					$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
					
					if(in_array($fileType, $allowTypes)){
						move_uploaded_file($array2[$a], $targetFilePath);
					}
				}
                
                $queryWedding = "UPDATE wedding_details SET foreign_id='$id', event_date='$Eventdate', event_timeStart='$time[0]', event_timeEnd='$time[1]', groom_lName='$gLastName', groom_fName='$gFirstName', groom_midName='$gMiddleName', groom_conNum='$gContactNum', groom_dob='$gDob', groom_pob='$gPob', groom_address='$gAddress', groom_father='$gFather', groom_mother='$gMother', groom_religion='$gReligion', groom_idpic='$gid', groom_psa='$gpsa', groom_cenomar='$gcenomar', groom_baptism='$gbaptismal', groom_confirm='$gconfirmation', bride_lName='$bLastName', bride_fName='$bFirstName', bride_midName='$bMiddleName', bride_conNum='$bContactNum', bride_dob='$bDob', bride_pob='$bPob', bride_address='$bAddress', bride_father='$bFather', bride_mother='$bMother', bride_religion='$bReligion', bride_idpic='$bid', bride_psa='$bpsa', bride_cenomar='$bcenomar', bride_baptism='$bbaptismal', bride_confirm='$bconfirmation', couples_contract='$ccontract' WHERE foreign_id='$id'";
			    $resultWedding = mysqli_query($conn, $queryWedding);

                //echo "Please wait 1 to 2 days for schedule approval in ". $Eventtype ;
                
			} else if($Event == "Baptism"){
				
                //echo $time[0].", ".$time[1];

                $bapLastName = $_POST["lastName"];
                $bapFirstName = $_POST["firstName"];
                $bapMiddleName = $_POST["middleName"];
                $bapGender = $_POST["gender"];
                $bapDob = $_POST["dob"];
                $bapPob = $_POST["pob"];
                $bapAddress = $_POST["address"];
                $bapContactNum = $_POST["contactNum"];
                $bapFather = $_POST["fatherName"];
                $bapFatherPob = $_POST["fatherPob"];
                $bapMother = $_POST["motherName"];
                $bapMotherPob = $_POST["motherPob"];
                $bapMarriage = $_POST["marriage_type"];
                $bapGodf = $_POST["godfatherName"];
                $bapGodfAddress = $_POST["godfatherAddress"];
                $bapGodm = $_POST["godmotherName"];
                $bapGodmAddress = $_POST["godmotherAddress"];
				$bappsa = basename($_FILES['psa']['name']);
                $bapcontract = basename($_FILES['marriage_contract']['name']);

                $queryappointment = "UPDATE appointment_details SET referenceNum='$reference', date_appointed='$dateappointed', time_appointed='$timeappointed', event_date='$Eventdate', event_timeStart='$time[0]', event_timeEnd='$time[1]', appointment_type='$Event', appointment_status='Pending', reason='', recorded='no' WHERE appointment_id='$id'";
			    $resultappointment = mysqli_query($conn, $queryappointment);
                
				$folder = "uploads/";
				
				$subFolder = $bapFirstName . $bapLastName . $Event . $Eventdate;
				if (!file_exists($folder.$subFolder)) {
					mkdir($folder.$subFolder, 0777, true);  //create directory if not exist
				}
				
				$array = array($bappsa,$bapcontract);
				$array2 = array($_FILES["psa"]["tmp_name"],$_FILES["marriage_contract"]["tmp_name"]);
				$allowTypes = array('jpg','png','jpeg','gif','jfif','tiff','svg','tif');
				for($a=0; $a<count($array); $a++){
					$targetFilePath = $folder . $subFolder . "/" . $array[$a];
					$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
					
					if(in_array($fileType, $allowTypes)){
						move_uploaded_file($array2[$a], $targetFilePath);
					}
				}
    
                $queryBaptism = "UPDATE baptism_details SET foreign_id='$id', event_date='$Eventdate', event_timeStart='$time[0]', event_timeEnd='$time[1]', lastName='$bapLastName', firstName='$bapFirstName', midName='$bapMiddleName', gender='$bapGender', dob='$bapDob', pob='$bapPob', address='$bapAddress', contNum='$bapContactNum', fatherName='$bapFather', fatherPob='$bapFatherPob', motherName='$bapMother', motherPob='$bapMotherPob', marriage_type='$bapMarriage', godfathName='$bapGodf', godfathAddress='$bapGodfAddress', godmothName='$bapGodm', godmothAddress='$bapGodmAddress', bapPsa='$bappsa', bapContract='$bapcontract' WHERE foreign_id='$id'";
			    $resultBaptism = mysqli_query($conn, $queryBaptism);
                //echo "Please wait 1 to 2 days for schedule approval in ". $Eventtype ;
                
			} else if($Event == "Funeral Mass/Blessing"){

                //echo $time[0];

                $deadLastName = $_POST["lastName"];
                $deadFirstName = $_POST["firstName"];
                $deadMiddleName = $_POST["middleName"];
                $deadAge = $_POST["age"];
                $deadGender = $_POST["gender"];
                $deadDod = $_POST["date_of_death"];
                $deadDoi = $_POST["date_of_internment"];
                $deadCemetery = $_POST["place_of_cemetery"];
                $deadCause = $_POST["cause_of_death"];
                $deadSacrament = $_POST["sacrament"];
                $deadBurial = $_POST["burial"];
				$deathcert = basename($_FILES['deathcert']['name']);
				
				if ($deadBurial == "Casket") {
					$finalType = "Funeral Mass";
				} else {
					$finalType = "Funeral Blessing";
				}

                $infLast = $_POST["informantLastName"];
                $infFirst = $_POST["informantFirstName"];
                $infMid = $_POST["informantMiddleName"];
                $infContactNum = $_POST["informantContactNum"];
                $infAddress = $_POST["informantAddress"];

                $queryappointment = "UPDATE appointment_details SET referenceNum='$reference', date_appointed='$dateappointed', time_appointed='$timeappointed', event_date='$Eventdate', event_timeStart='$time[0]', appointment_type='$Event', appointment_status='Pending', reason='', recorded='no' WHERE appointment_id='$id'";
			    $resultappointment = mysqli_query($conn, $queryappointment);
               
				$folder = "uploads/";
				
				$subFolder = $deadFirstName . $deadLastName . $finalType . $Eventdate;
				if (!file_exists($folder.$subFolder)) {
					mkdir($folder.$subFolder, 0777, true);  //create directory if not exist
				}
				
				$allowTypes = array('jpg','png','jpeg','gif','jfif','tiff','svg','tif');
				$targetFilePath = $folder . $subFolder . "/" . $deathcert;
				$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
				if(in_array($fileType, $allowTypes)){
					move_uploaded_file($_FILES["deathcert"]["tmp_name"], $targetFilePath);
				}

                $queryFuneral = "UPDATE funeral_details SET foreign_id='$id', event_date='$Eventdate', event_timeStart='$time[0]', lastName='$deadLastName', firstName='$deadFirstName', middleName='$deadMiddleName', gender='$deadGender', deathDate='$deadDod', age='$deadAge', deathCause='$deadCause', internmentDate='$deadDoi', cemeteryPlace='$deadCemetery', informLast='$infLast', informFirst='$infFirst', informMid='$infMid', contNum='$infContactNum', address='$infAddress', sacrament='$deadSacrament', burial='$deadBurial', deathCert='$deathcert' WHERE foreign_id='$id'";
			    $resultFuneral= mysqli_query($conn, $queryFuneral);

                //echo "Please wait 1 to 2 days for schedule approval in ". $Eventtype ;

			} else {
                //do nothing
			}
		} else if($Eventtype == "Mass Intention"){
            $rdtime =  $_POST["rdtime"];
            $time = explode(" ", $rdtime);
            $contactnum = $_POST["contactNum"];
            $rdpurpose = $_POST["purposes"];
            $names = $_POST["names"];
            $queryappointment = "UPDATE appointment_details SET referenceNum='$reference', date_appointed='$dateappointed', time_appointed='$timeappointed', event_date='$Eventdate', event_timeStart='$time[0]', appointment_type='$Event', appointment_status='Pending', reason='', reason='', recorded='no' WHERE appointment_id='$id'";
			$resultappointment = mysqli_query($conn, $queryappointment);
            //getting the appointments id to save as foreign key in wedding details
            $foreignId = 0;
            $queryid = "SELECT appointment_id FROM appointment_details WHERE appointment_id = LAST_INSERT_ID()";
            $resultid = mysqli_query($conn, $queryid);
            while($row = mysqli_fetch_array($resultid)) {
                $foreignId = $row[0];
            }

            $queryIntention = "UPDATE mass_intention_details SET foreign_id='$id', event_date='$Eventdate', event_time='$time[0]', contactNum='$contactnum', purpose='$rdpurpose', name='$names' WHERE foreign_id='$id'";
			$resultIntention = mysqli_query($conn, $queryIntention);
           // echo "Please wait 1 to 2 days for schedule approval in ". $Eventtype ;

		} else if($Eventtype == "Blessing"){
			$contactnum = $_POST["contactNum"];
			$blessingtype = $_POST["blessingType"];
            $blessAdd = $_POST["address"];
			$queryappointment = "UPDATE appointment_details SET date_appointed='$dateappointed', time_appointed='$timeappointed', event_date='$Eventdate', appointment_type='$blessingtype', appointment_status='Pending', reason='', recorded='no' WHERE appointment_id='$id'";
			$resultappointment = mysqli_query($conn, $queryappointment);
            
			$queryblessing = "UPDATE blessing_details SET foreign_id='$id', event_date='$Eventdate', contact_num='$contactnum', blessing_type='$blessingtype', address='$blessAdd' WHERE foreign_id='$id'";
			$resultblessing = mysqli_query($conn, $queryblessing);
            //echo "Please wait 1 to 2 days for schedule approval in ". $Eventtype ;
		} else if($Eventtype == "Document Request"){
            $Event = $_SESSION['event'];
			//common inputs
            $lname = $_POST["lastName"];
            $fname = $_POST["firstName"];
            $mname = $_POST["middleName"];
            $contactnum = $_POST["ContactNum"];
			$birthcert = basename($_FILES['birthcert']['name']);
            if($Event == "Baptismal Certificate" || $Event == "Wedding Certificate" || $Event == "Confirmation Certificate"){
                $dob = $_POST["dob"];
                $fathersname = $_POST["fname"];
                $mothersname = $_POST["mname"];
                $purpose = $_POST["purpose"];

                $queryappointment = "UPDATE appointment_details SET referenceNum='$reference', date_appointed='$dateappointed', time_appointed='$timeappointed', event_date='$Eventdate', appointment_type='$Event', appointment_status='Pending', reason='', recorded='no' WHERE appointment_id='$id'";
                $resultappointment = mysqli_query($conn, $queryappointment);
                //getting the appointments id to save as foreign key in wedding details
                $foreignId = 0;
                $queryid = "SELECT appointment_id FROM appointment_details WHERE appointment_id = LAST_INSERT_ID()";
                $resultid = mysqli_query($conn, $queryid);
                while($row = mysqli_fetch_array($resultid)) {
                    $foreignId = $row[0];
                }
				
				$folder = "uploads/";
				
				$subFolder = $fname . $lname . $Event . $Eventdate;
				if (!file_exists($folder.$subFolder)) {
					mkdir($folder.$subFolder, 0777, true);  //create directory if not exist
				}
				
				$allowTypes = array('jpg','png','jpeg','gif','jfif','tiff','svg','tif');
				$targetFilePath = $folder . $subFolder . "/" . $birthcert;
				$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
				if(in_array($fileType, $allowTypes)){
					move_uploaded_file($_FILES["birthcert"]["tmp_name"], $targetFilePath);
				}
				
                $queryDocument = "UPDATE document_request_details SET foreign_id='$id', claim_date='$Eventdate', documentType='$Event', firstName='$fname', middleName='$mname', lastName='$lname', dob='$dob', fatherName='$fathersname', motherName='$mothersname', contactNum='$contactnum', purpose='$purpose', birthcert='$birthcert' WHERE foreign_id='$id'";
                $resultDocument = mysqli_query($conn, $queryDocument);
                //echo "Please wait 1 to 2 days for schedule approval in ". $Eventtype ;
            } else if($Event == "Good Moral Certificate"){
                $dob = $_POST["dob"];
                $purpose = $_POST["purpose"];
				$barangaycert = basename($_FILES['barangaycert']['name']);
				$kawancert = basename($_FILES['kawancert']['name']);
				
                $queryappointment = "UPDATE appointment_details SET referenceNum='$reference', date_appointed='$dateappointed', time_appointed='$timeappointed', event_date='$Eventdate', appointment_type='$Event', appointment_status='Pending', reason='', recorded='no' WHERE appointment_id='$id'";
                $resultappointment = mysqli_query($conn, $queryappointment);
                //getting the appointments id to save as foreign key in wedding details
                $foreignId = 0;
                $queryid = "SELECT appointment_id FROM appointment_details WHERE appointment_id = LAST_INSERT_ID()";
                $resultid = mysqli_query($conn, $queryid);
                while($row = mysqli_fetch_array($resultid)) {
                    $foreignId = $row[0];
                }
				
				$folder = "uploads/";
				
				$subFolder = $fname . $lname . $Event . $Eventdate;
				if (!file_exists($folder.$subFolder)) {
					mkdir($folder.$subFolder, 0777, true);  //create directory if not exist
				}
				
				$array = array($birthcert,$barangaycert,$kawancert);
				$array2 = array($_FILES["birthcert"]["tmp_name"],$_FILES["barangaycert"]["tmp_name"],$_FILES["kawancert"]["tmp_name"]);
				$allowTypes = array('jpg','png','jpeg','gif','jfif','tiff','svg','tif');
				for($a=0; $a<count($array); $a++){
					$targetFilePath = $folder . $subFolder . "/" . $array[$a];
					$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
					
					if(in_array($fileType, $allowTypes)){
						move_uploaded_file($array2[$a], $targetFilePath);
					}
				}
				
                $queryDocument = "UPDATE document_request_details SET foreign_id='$id', claim_date='$Eventdate', documentType='$Event', firstName='$fname', middleName='$mname', lastName='$lname', dob='$dob', contactNum='$contactnum', purpose='$purpose', birthcert='$birthcert', barangaycert='$barangaycert', kawancert='$kawancert' WHERE foreign_id='$id'";
                $resultDocument = mysqli_query($conn, $queryDocument);
                //echo "Please wait 1 to 2 days for schedule approval in ". $Eventtype ;
            } else if($Event == "Permit and No Record") {
                $dob = $_POST["dob"];
                $purpose = $_POST["purpose"];
                $address = $_POST["address"];
                $queryappointment = "UPDATE appointment_details SET referenceNum='$reference', date_appointed='$dateappointed', time_appointed='$timeappointed', event_date='$Eventdate', appointment_type='$Event', appointment_status='Pending', reason='', recorded='no' WHERE appointment_id='$id'";
                $resultappointment = mysqli_query($conn, $queryappointment);
                
				$folder = "uploads/";
				
				$subFolder = $fname . $lname . $Event . $Eventdate;
				if (!file_exists($folder.$subFolder)) {
					mkdir($folder.$subFolder, 0777, true);  //create directory if not exist
				}
				
				$allowTypes = array('jpg','png','jpeg','gif','jfif','tiff','svg','tif');
				$targetFilePath = $folder . $subFolder . "/" . $birthcert;
				$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
				if(in_array($fileType, $allowTypes)){
					move_uploaded_file($_FILES["birthcert"]["tmp_name"], $targetFilePath);
				}
				
                $queryDocument = "UPDATE document_request_details SET foreign_id='$id', claim_date='$Eventdate', documentType='$Event', firstName='$fname', middleName='$mname', lastName='$lname', dob='$dob', contactNum='$contactnum', purpose='$purpose', address='$address', birthcert='$birthcert' WHERE foreign_id='$id'";
                $resultDocument = mysqli_query($conn, $queryDocument);
                //echo "Please wait 1 to 2 days for schedule approval in ". $Eventtype ;
            }
		}
		$_SESSION['m1'] = $message1 ="Your Request has been submitted"; 
        $_SESSION['m2'] = $message2 = "Please wait 1 to 2 days for schedule approval";
        $_SESSION['inserted'] = "true";
        header("Location: page_SCHEDULEEVENT.php");
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styleLANDING.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>The SJCP - Event Scheduled</title>
	<link rel="icon" type="image/png" href="tabicon.png">
</head>
<body>
    <div class="popupCover">
        <div class="popupMessage">
                <div> <i class="fa fa-check-circle" style="font-size: 4rem"></i> </div>
                <div class="title-cont"> <h2><?php echo $message1?></h2> </div>
                <div class="desc-cont"><?php echo $message2?> </div>
                <div class="button-cont">  <button type="button" onclick="location.href='page_APPOINTMENTS.php'"> <b>View Appointments</b></button> </div>
        </div>
    </div>
</body>
</html>