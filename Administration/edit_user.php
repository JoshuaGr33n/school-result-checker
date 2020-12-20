



<?php session_start();?>
<?php
if( $_SESSION['Adminusername'] =="")
{
header("Location: index.php" );
exit;
}
//database connection
include('include/db.php');





if(isset($_POST["submit"]) && $_POST["submit"]!="") {
$usersCount = count($_POST["className"]);
for($i=0;$i<$usersCount;$i++) {
mysqli_query($con, "UPDATE classes set className='" . $_POST["className"][$i] . "' WHERE classID='" . $_POST["classID"][$i] . "'");
}
header("Location:allclasses.php");
}
?>
<html>
<head>
<title>Edit Multiple User</title>
<link rel="stylesheet" type="text/css" href="styles.css" />
</head>
<body>
<form name="frmUser" method="post" action="">
<div style="width:500px;">
<table border="0" cellpadding="10" cellspacing="0" width="500" align="center">
<tr class="tableheader">
<td>Edit User</td>
</tr>
<?php
$rowCount = count($_POST["users"]);
for($i=0;$i<$rowCount;$i++) {
$result = mysqli_query($con, "SELECT * FROM classes WHERE classID='" . $_POST["users"][$i] . "'");
$row[$i]= mysqli_fetch_array($result);
?>
<tr>
<td>
<table border="0" cellpadding="10" cellspacing="0" width="500" align="center" class="tblSaveForm">
<tr>
<td><label>Username</label></td>
<td><input type="hidden" name="userId[]" class="txtField" value="<?php echo $row[$i]['classID']; ?>"><input type="text" name="className[]" class="txtField" value="<?php echo $row[$i]['className']; ?>"></td>
</tr>

</table>
</td>
</tr>
<?php
}
?>
<tr>
<td colspan="2"><input type="submit" name="submit" value="Submit" class="btnSubmit"></td>
</tr>
</table>
</div>
</form>
</body></html>