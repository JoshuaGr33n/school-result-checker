<?php
//database connection
include('include/db.php');
if($_REQUEST['empid']) {
	$sql = "SELECT  StudentID, Total FROM results WHERE StudentID='3' AND class='SSS 1' AND school_session='2019/2020'";
	$resultset = mysqli_query($con, $sql) or die("database error:". mysqli_error($con));	
	$data = array();
	while($rows = mysqli_fetch_assoc($resultset)) {
		$data = $rows;
	}
	echo json_encode($data);
} else {
	echo 0;	
}
?>
