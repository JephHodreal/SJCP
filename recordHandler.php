<?php

session_start();
require 'dbconnect.php';

if (isset($_POST['recordSub'])) {
    $_SESSION['recordFilter'] = $_POST['recordSub'];
    header('Location: admin_RECORDS.php');
}

if (isset($_POST['filterSub'])) {
    $filter = $_POST['searchFilter'];
    if ($filter == 'name') {
        $ln = $_POST['findLn'];
        $fn = $_POST['findFn'];
        $_SESSION['searchFilter'] = "byName";
        $_SESSION['findVal'] = array($ln, $fn);
        header('Location: admin_RECORDS.php');
    } else if ($filter == 'bday') {
        $day = $_POST['findBday'];
        $_SESSION['searchFilter'] = "byBday";
        $_SESSION['findVal'] = $day;
        header('Location: admin_RECORDS.php');
    } else if ($filter == 'eday') {
        $day = $_POST['findEday'];
        $_SESSION['searchFilter'] = "byEday";
        $_SESSION['findVal'] = $day;
        header('Location: admin_RECORDS.php');
    }
}

if (isset($_POST['editSub']) || isset($_POST['addSub'])) {
    $event = $_POST['event'];

    if ($event == "Baptism") {
        $ln = ucwords(strtolower($_POST['LName']));
        $fn = ucwords(strtolower($_POST['FName']));
        $mn = ucwords(strtolower($_POST['MName']));
        $gend = $_POST['Gender'];
        $BapDob = $_POST['BapDob'];
        $BapPob = ucwords(strtolower($_POST['BapPob']));
        $Addr = ucwords(strtolower($_POST['Address']));
        $BapDad = ucwords(strtolower($_POST['BapDad']));
        $DadPob = ucwords(strtolower($_POST['DadPob']));
        $BapMom = ucwords(strtolower($_POST['BapMom']));
        $MomPob = ucwords(strtolower($_POST['MomPob']));
        $cont = "+63" . $_POST['ContNum'];
        $mType = $_POST['MarType'];
        $godFName = ucwords(strtolower($_POST['GfName']));
        $godFAdd = ucwords(strtolower($_POST['GfAdd']));
        $godMName = ucwords(strtolower($_POST['GmName']));
        $godMAdd = ucwords(strtolower($_POST['GmAdd']));
        if (isset($_POST['editSub'])) {
            $id = $_POST['id'];
            $query = "UPDATE record_baptism_detaIls SET lastName='$ln', firstName='$fn', middleName='$mn', gender='$gend', dob='$BapDob', pob='$BapPob', address='$Addr', contactNum='$cont', fatherName='$BapDad', 
            father_pob='$DadPob', motherName='$BapMom', mother_pob='$MomPob', marriage_type='$mType', godfatherName='$godFName', godfather_address='$godFAdd', godmotherName='$godMName', godmother_address='$godMAdd' 
            WHERE baptism_id='$id'";
        } else {
            $date = $_POST['eventDate'];
            $time = $_POST['eventTime'];
            $query = "INSERT INTO record_baptism_details 
            VALUES (0, '$date', '$time', '$ln', '$fn', '$mn', '$gend', '$BapDob', '$BapPob', '$Addr', '$cont', '$BapDad', '$DadPob', '$BapMom', '$MomPob', '$mType', '$godFName', '$godFAdd', '$godMName', '$godMAdd')";
        }
    } else if ($event == "Confirmation") {
        $ln = ucwords(strtolower($_POST['LName']));
        $fn = ucwords(strtolower($_POST['FName']));
        $mn = ucwords(strtolower($_POST['MName']));
        $dob = $_POST['ConfDob'];
        $age = $_POST['ConfAge'];
        $pob = ucwords(strtolower($_POST['ConfPob']));
        $gend = $_POST['Gender'];
        $bapDate = $_POST['BapDate'];
        $bapPlace = ucwords(strtolower($_POST['BapPlace']));
        $confDad = ucwords(strtolower($_POST['ConfDad']));
        $confMom = ucwords(strtolower($_POST['ConfMom']));
        $cont = "+63" . $_POST['ContNum'];
        $address = ucwords(strtolower($_POST['Address']));
        $godFName = ucwords(strtolower($_POST['GfName']));
        $godMName = ucwords(strtolower($_POST['GmName']));
        if (isset($_POST['editSub'])) {
            $id = $_POST['id'];
            $query = "UPDATE record_confirmation_detaIls SET lastName='$ln', firstName='$fn', middleName='$mn', gender='$gend', dob='$dob', age='$age', pob='$pob', placeof_baptism='$bapPlace', 
            dateof_baptism='$bapDate', fatherName='$confDad', motherName='$confMom', contactNum='$cont', address='$address', godfatherName='$godFName', godmotherName='$godMName'
            WHERE confirmation_id='$id'";
        } else {
            $date = $_POST['eventDate'];
            $time = $_POST['eventTime'];
            $query = "INSERT INTO record_confirmation_details VALUES (0, '$date', '$time', '$ln', '$fn', '$mn', '$gend', '$dob', '$age', '$pob', '$bapPlace', '$bapDate', '$confDad', '$confMom', '$cont', '$address', '$godFName', '$godMName')";
        }
    } else if ($event == "Wedding") {
        $gln = ucwords(strtolower($_POST['GLastN']));
        $gfn = ucwords(strtolower($_POST['GFirstN']));
        $gmn = ucwords(strtolower($_POST['GMidN']));
        $gcont = "+63" . $_POST['ContNum'];
        $grel = $_POST['GRel'];
        $gdob = $_POST['GDob'];
        $gpob = ucwords(strtolower($_POST['GPob']));
        $gadd = ucwords(strtolower($_POST['GAdd']));
        $gDad = ucwords(strtolower($_POST['GDad']));
        $gMom = ucwords(strtolower($_POST['GMom']));
        $bln = ucwords(strtolower($_POST['BLastN']));
        $bfn = ucwords(strtolower($_POST['BFirstN']));
        $bmn = ucwords(strtolower($_POST['BMidN']));
        $bcont = "+63" . $_POST['ContNum'];
        $brel = $_POST['BRel'];
        $bdob = $_POST['BDob'];
        $bpob = ucwords(strtolower($_POST['BPob']));
        $badd = ucwords(strtolower($_POST['BAdd']));
        $bDad = ucwords(strtolower($_POST['BDad']));
        $bMom = ucwords(strtolower($_POST['BMom']));
        if (isset($_POST['editSub'])) {
            $id = $_POST['id'];
            $query = "UPDATE record_wedding_detaIls SET groom_lastName='$gln', groom_firstName='$gfn', groom_middleName='$gmn', groom_contactNum='$gcont', groom_dob='$gdob', groom_pob='$gpob', 
            groom_address='$gadd', groom_fatherName='$gDad', groom_motherName='$gMom', groom_religion='$grel', bride_lastName='$bln', bride_firstName='$bfn', bride_middleName='$bmn', bride_contactNum='$bcont', 
            bride_dob='$bdob', bride_pob='$bpob', bride_address='$badd', bride_fatherName='$bDad', bride_motherName='$bMom', bride_religion='$brel'
            WHERE wedding_id='$id'";
        } else {
            $date = $_POST['eventDate'];
            $time = $_POST['eventTime'];
            $query = "INSERT INTO record_wedding_details VALUES (0, '$date', '$time', '$gln', '$gfn', '$gmn', '$gcont', '$gdob', '$gpob', '$gadd', '$gDad', '$gMom', '$grel', '$bln', '$bfn', '$bmn', '$bcont', '$bdob', '$bpob', '$badd', '$bDad', '$bMom', '$brel')";
        }
    } else if ($event == "Funeral") {
        $dln = ucwords(strtolower($_POST['DLast']));
        $dfn = ucwords(strtolower($_POST['DFirst']));
        $dmn = ucwords(strtolower($_POST['DMid']));
        $dAge = $_POST['DAge'];
        $gend =$_POST['Gender'];
        $dCause = ucwords(strtolower($_POST['DCause']));
        $dDate = $_POST['DeathD'];
        $int = $_POST['Interm'];
        $cem = ucwords(strtolower($_POST['Cemet']));
        $sac = $_POST['Sacram'];
        $bur = $_POST['Burial'];
        $iln = ucwords(strtolower($_POST['InfLN']));
        $ifn = ucwords(strtolower($_POST['InfFN']));
        $imn = ucwords(strtolower($_POST['InfMN']));
        $icont = "+63" . $_POST['ContNum'];
        $iadd = ucwords(strtolower($_POST['Address']));
        if (isset($_POST['editSub'])) {
            $id = $_POST['id'];
            $query = "UPDATE record_funeral_detaIls SET lastName='$dln', firstName='$dfn', middleName='$dmn', gender='$gend', date_of_death='$dDate', age='$dAge', cause_of_death='$dCause', date_of_interment='$int',
            place_of_cemetery='$cem', informLast='$iln', informFirst='$ifn', informMid='$imn', contactNum='$icont', address='$iadd', sacrament='$sac', burial='$bur'
             WHERE funeral_id='$id'";
        } else {
            $date = $_POST['eventDate'];
            $time = $_POST['eventTime'];
        $dmn = ucwords(strtolower($_POST['DMid']));
            $query = "INSERT INTO record_funeral_details VALUES (0, '$date', '$time', '$dln', '$dfn', '$dmn', '$gend', '$dDate', '$dAge', '$dCause', '$int', '$cem', '$iln', '$ifn', '$imn', '$icont', '$iadd', '$sac', '$bur')";
        }
    }
    $result = $conn->query($query);
    header('Location: admin_RECORDS.php?popup=1');
}
?>