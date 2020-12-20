<?php
//database connection
include('include/db.php');

$rowCount = count($_POST["users"]);
for($i=0;$i<$rowCount;$i++) {
mysqli_query($conn, "DELETE FROM classes WHERE classID='" . $_POST["users"][$i] . "'");
}
header("Location:../allclasses.php");
?>