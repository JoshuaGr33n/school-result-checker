<?php
//database connection
$con = mysqli_connect('localhost','ResultChecker','ResultChecker') or die('cant connect');
//mysql_select_db('projectTest') or die('cant select'); PHP 5
mysqli_select_db($con, 'schoolresultchecker') or die(mysqli_error($con));

if ($_POST['action'] == 'edit' && $_POST['classID']) {	
	$updateField='';
	if(isset($_POST['name'])) {
		$updateField.= "name='".$_POST['className']."'";
	} 
	if($updateField && $_POST['classID']) {
		$sqlQuery = "UPDATE classes SET $updateField WHERE classID='" . $_POST['classID'] . "'";	
		mysqli_query($con, $sqlQuery) or die("database error:". mysqli_error($conn));	
		$data = array(
			"message"	=> "Record Updated",	
			"status" => 1
		);
		echo json_encode($data);		
	}
}
if ($_POST['action'] == 'delete' && $_POST['classID']) {
	$sqlQuery = "DELETE FROM classes WHERE classID='" . $_POST['classID'] . "'";	
	mysqli_query($con, $sqlQuery) or die("database error:". mysqli_error($conn));	
	$data = array(
		"message"	=> "Record Deleted",	
		"status" => 1
	);
	echo json_encode($data);	
}

