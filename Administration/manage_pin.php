<?php session_start();?>
<?php
if( $_SESSION['Adminusername'] =="")
{
header("Location: index.php" );
exit;
}








//database connection
include('include/db.php');



//fetch details from privileges table
$fetchPrivilegesQuery = "SELECT * FROM privileges where AdminUsername = '".$_SESSION['Adminusername']."'";
$fetchPrivilegesResult = mysqli_query($con, $fetchPrivilegesQuery);

// Loop through each row, outputting the login and password


while ($privilegesRow = @mysqli_fetch_assoc($fetchPrivilegesResult))
{

$pinManagement = $privilegesRow['PinManagement'];



}







if($pinManagement!="YES")
{
    header("Location: index.php" );
    exit;
}






?>



<html>
<head>
<title>Manage Students</title>
</head>

<body>
Other Admin
<br/><a tabindex="-1" href="logout.php?logout=1">Sign Out</a>
</body>


</html>
