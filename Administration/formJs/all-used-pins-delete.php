<?php session_start();?>
<?php
include('../include/db.php');

 ?>
 <?php 


$studentsExpand="";
$ExpandAdmin="";
$ExpandResults="";
$ExpandSiteManager="";
$ExpandPinManager="";




$pinGeneratorCurrentPageTag="";
  $allPinCurrentPageTag="";
  $resultPageManagerCurrentPageTag="";
  $frontPageManagerCurrentPageTag="";
  $downloadResultClassCurrentPageTag="";
  $importResultClassCurrentPageTag="";
  $searchResultClassCurrentPageTag="";
  $allStudentResultClassCurrentPageTag="";
  $searchResultByClassCurrentPageTag="";
  $addNewAdminsCurrentPageTag="";
  $allAdminsCurrentPageTag="";
  $addnewStudentsCurrentPageTag="";
  $promoteStudentsCurrentPageTag="";
  $classPositionCurrentPageTag="";
  $updateSchoolDetailsCurrentPageTag="";
  $importRegSubjectCurrentPageTag="";
  $allSubjectCurrentPageTag="";
  $allSessionCurrentPageTag="";
  $sportHouseCurrentPageTag="";
  $allClassesCurrentPageTag="";
  $studentsActiveTag="";
  $dashboardActiveTag="";
?>
 <?php

 include('../include/privilege-restrictions.php');


?>

 <?php
 

 include('../include/privilege-restrictions.php');


?>



<?php if($pinManagement!="YES")
{
    header("Location: ../index.php" );
exit;
}
?>



<?php











    mysqli_query($con, "DELETE FROM pinlogin WHERE LoginCount='3' AND Status='Used'");
    header("Location:../all-pins.php");
    exit;



?>