<?php session_start();?>

<?php
function get_position($data, $score){
  $score_ends = array(1 => "st", 2 => "nd", 3 => "rd", 4 => "th");
  $data = explode(',', $data);
  arsort($data);
  $student_position = array_search($score, array_values($data))+1;
  if($student_position < 4){
      echo $student_position.$score_ends[$student_position];
  }else{
      echo $student_position.$score_ends[4];
  }
}














if($_SESSION['studentID'] =="")
{
header("Location: index.php" );
exit;
}
?>
<?php
if($_SESSION['status'] =="Deactivated")
{
header("Location: index.php" );
exit;
}


if($_SESSION['term'] !="Third" && $_SESSION['annualResult']!="Annual Result")
{
header("Location: index.php" );
exit;
}



?>




<?php

//check if number of logins exceeds 3 times
if($_SESSION['count'] >= 3)
{
    session_destroy();
    header("Location: index.php?message=This Pin Is no longer valid");
}
?>

<?php


//echo 'hello '.  $_SESSION['FName']. ' '. $_SESSION['LName'];


?>



<?php 



include('Administration/include/db.php');



$student_score=mysqli_query($con, "SELECT SUM(Average) AS Average, StudentID FROM `results` where class ='".$_SESSION['class']."' and school_session = '".$_SESSION['school_session']."'  GROUP BY StudentID ");
foreach ($student_score as $key => $value) {
    $student_data[]= round($value['Average']);

}







//$query = "SELECT * FROM registered_subjects INNER JOIN results ON registered_subjects.subjectID = results.subjectID

 //where results.StudentReg = '".$_SESSION['RegNum']."' 
//and results.class = '".$_SESSION['class']."' and results.school_session = '".$_SESSION['school_session']."' and results.Publish = 'Yes' 
//and results.Term = '".$_SESSION['term']."' GROUP BY results.subjectID ORDER BY results.subjectID DESC";
//$result = mysqli_query($con, $query);



//print_r($score_data);
// $key_counter=1;
// foreach ($data as $key => $value) {
//   $key_counters=$key_counter++;
//   if($key_counters < 4){
//       echo array_keys($value).' Is '.$key_counters.$score_ends[$key_counters];
//   }else{
//       echo array_keys($value).' Is '.$key_counters.$score_ends[4];
//   }
// }




?>


<?php

//total average


        $Query = "SELECT StudentReg, SUM(Total) AS TotalTotal, SUM(Average) AS totalaverage FROM results where Class ='".$_SESSION['class']."' And school_session ='".$_SESSION['school_session']."'  AND StudentReg ='".$_SESSION['RegNum']."'
        GROUP BY StudentReg   ORDER BY totalaverage DESC";
        $Result = mysqli_query($con, $Query);
        $Row = mysqli_fetch_array($Result);
        $totalAverage=$Row['TotalTotal']/4;
	
?>



<?php

//summation of term total
        $firstTermTotalQuery = "SELECT StudentReg, SUM(Total) AS firstTermTotalSummation FROM results where Class ='".$_SESSION['class']."' And school_session ='".$_SESSION['school_session']."' AND Term ='First' AND StudentReg ='".$_SESSION['RegNum']."'
        AND Publish ='Yes'
        GROUP BY StudentReg   ORDER BY firstTermTotalSummation DESC";
        $firstTermTotalResult = mysqli_query($con, $firstTermTotalQuery);
        $firstTermTotalRow = mysqli_fetch_array($firstTermTotalResult); 
        $firstTermTotalRow['firstTermTotalSummation'];
  


        $secondTermTotalQuery = "SELECT StudentReg, SUM(Total) AS secondTermTotalSummation FROM results where Class ='".$_SESSION['class']."' And school_session ='".$_SESSION['school_session']."' AND Term ='Second' AND StudentReg ='".$_SESSION['RegNum']."'
        AND Publish ='Yes'
        GROUP BY StudentReg   ORDER BY secondTermTotalSummation DESC";
        $secondTermTotalResult = mysqli_query($con, $secondTermTotalQuery);
        $secondTermTotalRow = mysqli_fetch_array($secondTermTotalResult); 
        $secondTermTotalRow['secondTermTotalSummation'];


        $thirdTermTotalQuery = "SELECT StudentReg, SUM(Total) AS thirdTermTotalSummation FROM results where Class ='".$_SESSION['class']."' And school_session ='".$_SESSION['school_session']."' AND Term ='Third' AND StudentReg ='".$_SESSION['RegNum']."'
        AND Publish ='Yes'
        GROUP BY StudentReg   ORDER BY thirdTermTotalSummation DESC";
        $thirdTermTotalResult = mysqli_query($con, $thirdTermTotalQuery);
        $thirdTermTotalRow = mysqli_fetch_array($thirdTermTotalResult); 
        $thirdTermTotalRow['thirdTermTotalSummation'];




        //summation of total average

        $termTotalSummation = $firstTermTotalRow['firstTermTotalSummation'] + $secondTermTotalRow['secondTermTotalSummation'] + $thirdTermTotalRow['thirdTermTotalSummation'];
        $totalAverageSummation = $termTotalSummation/3;
  
        
        
?>





<?php 
//display number of login sessions
$LoginCountQuery = "SELECT * FROM pinlogin where PinCode = '".$_SESSION['pinCode']."'  ";
$LoginCountResult = mysqli_query($con, $LoginCountQuery);

// Loop through each row, outputting the login and password
//while ($test = @mysqli_fetch_array($result, MYSQL_ASSOC)) PHP 5

while ($LoginCountRow = @mysqli_fetch_assoc($LoginCountResult))
{
$LoginCount = $LoginCountRow['LoginCount'];





}			




//$sql = "select COUNT(StudentID) class from results where class ='".$_SESSION['class']."' and school_session = '".$_SESSION['school_session']."' and Term = '".$_SESSION['term']."'
//GROUP BY  subjectID";
$sql="SELECT COUNT(countable.StudentReg) as totalClass FROM (SELECT DISTINCT StudentReg FROM `results` WHERE class ='".$_SESSION['class']."' and school_session = '".$_SESSION['school_session']."') as countable";
$countresult = mysqli_query($con, $sql) or die ("Query error!");

while ($erow = mysqli_fetch_array($countresult)) {

  $var = $erow['totalClass'];

  $classNumber=$var;

}








$allStudentcountSql = "select COUNT(student_id) RegNum from students";
$allStudentcountResult = mysqli_query($con, $allStudentcountSql) or die ("Query error!");

while ($cRow = mysqli_fetch_array($allStudentcountResult)) {

  $var = $cRow['RegNum'];

  $allStudentNumber=$var;

}


?>



<?php 



	

	
$studentDetailQuery = "SELECT * FROM students where student_id= '".$_SESSION['studentID']."'";
$studentDetailResult = mysqli_query($con, $studentDetailQuery);

$studentDetailrow = mysqli_fetch_array($studentDetailResult);

$passport = $studentDetailrow['ProfilePic'];






if($passport=="")
{

  $passport="blank.png";
}




?>







<?php
  



 $resultpageQuery = "SELECT * FROM sitemanager where tag='school_logo'";
 $resultpageResult = mysqli_query($con, $resultpageQuery);

$row = mysqli_fetch_array($resultpageResult);
$school_logo = $row['Content'];
?>




<?php
  



 $resultpageQuery = "SELECT * FROM sitemanager where tag='school_stamp'";
 $resultpageResult = mysqli_query($con, $resultpageQuery);

$row = mysqli_fetch_array($resultpageResult);
$school_stamp = $row['Content'];
?>








<?php

$resumptionDateQuery = "SELECT * FROM resumption_date WHERE term='Third' AND session='$_SESSION[school_session]'";
$resumptionDateResult = mysqli_query($con, $resumptionDateQuery);

$resumptionDaterow = mysqli_fetch_array($resumptionDateResult);
$r_date = $resumptionDaterow['date'];
?>



<?php 



	

	
$teacherQuery = "SELECT FormTeacher FROM classes where className ='".$_SESSION['class']."'";
$teacherResult = mysqli_query($con, $teacherQuery);

$teacherRow = mysqli_fetch_array($teacherResult);

$teacher = $teacherRow['FormTeacher'];









?>


<?php
  



 $principalnameQuery = "SELECT * FROM administration where privileged_Status ='Principal'";
 $principalnameResult = mysqli_query($con, $principalnameQuery);

 $principalnameRow = mysqli_fetch_array($principalnameResult);
$principalname = $principalnameRow['First_Name'] .' ' .$principalnameRow['Last_Name'] ;
?>






<?php 



	

	
$teacherUsernameQuery = "SELECT FormTeacher FROM classes where className ='".$_SESSION['class']."'";
$teacherUsernameResult = mysqli_query($con, $teacherUsernameQuery);

$teacherUsernameRow = mysqli_fetch_array($teacherUsernameResult);

$teacherUsername = $teacherUsernameRow['FormTeacher'];





$teacherQuery = "SELECT * FROM administration where Username ='".$teacherUsername."'";
$teacherResult = mysqli_query($con, $teacherQuery);

$teacherRow = mysqli_fetch_array($teacherResult);

$teacher = $teacherRow['First_Name'].' '.$teacherRow['Last_Name'];
$signature = $teacherRow['Signature'];









?>


<?php
  



 $principalnameQuery = "SELECT * FROM administration where privileged_Status ='Principal'";
 $principalnameResult = mysqli_query($con, $principalnameQuery);

 $principalnameRow = mysqli_fetch_array($principalnameResult);
$principalname = $principalnameRow['First_Name'] .' ' .$principalnameRow['Last_Name'] ;
?>


<?php 



	

	
$t_remarkQuery = "SELECT * FROM remark WHERE name ='Teacher' AND session ='".$_SESSION['school_session']."' AND class='".$_SESSION['class']."' AND term='Annual' AND StudentID='".$_SESSION['studentID'] ."'";
$t_remarkResult = mysqli_query($con, $t_remarkQuery);

$t_remarkRow = mysqli_fetch_array($t_remarkResult);

$teacherCustomRemark = $t_remarkRow['remark'];













?>

<?php 


$classPromotionQuery = "SELECT * FROM class_promotion WHERE Promote_From= '".$_SESSION['class']."'";
$classPromotionResult = mysqli_query($con, $classPromotionQuery);

$classPromotionrow = mysqli_fetch_array($classPromotionResult);




$promote_from = $classPromotionrow['Promote_From'];
$promote_to = $classPromotionrow['Promote_To'];






	

	
$promotionQuery = "SELECT Promotion_Status FROM results where Class ='".$_SESSION['class']."' And school_session ='".$_SESSION['school_session']."' AND StudentReg ='".$_SESSION['RegNum']."'
AND Publish ='Yes'
GROUP BY StudentReg ";
$promotionResult = mysqli_query($con, $promotionQuery);
$promotionRow = mysqli_fetch_array($promotionResult); 
$principal_promotion_comment = $promotionRow['Promotion_Status'];


if($principal_promotion_comment=="Promoted")
{


  $principal_promotion_comment="<span class='text-success font-weight-bold'>Promoted To $promote_to</span>";

}

else if($principal_promotion_comment!="Promoted")
{


  $principal_promotion_comment="<span class='text-danger font-weight-bold'>No Promotion</span>";

}


























?>

<?php


$current_class = substr($_SESSION['class'], 0, 3);
// multibyte strings
//$current_class = mb_substr($Class, 0, 5);




if($current_class=="JSS")
{
 $School="Junior Secondary School";

}

else if ($current_class=="SSS"){

$School="Senior Secondary School";

}

else{
  $School="";
}


?>

<?php include('Administration/include/annual-results-grading.php');?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Annual Result <?php echo $_SESSION['school_session'];?>:: <?php echo  $_SESSION['FName'];?> <?php echo $_SESSION['LName'] ;?></title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	


<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="external/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="external/external/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="external/external/vendor/animate/animate.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="external/vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="external/vendor/perfect-scrollbar/perfect-scrollbar.css">
<!--===============================================================================================-->

	<link rel="stylesheet" type="text/css" href="external/css/main.css">
<!--===============================================================================================-->



<link rel="icon" type="image/png" href="images/<?php echo $favicon;?>" sizes="16x16">


<style type="text/css">
@media print {




.logo{font-family: Impact, Charcoal, sans-serif; font-size:295%; margin-left:5%; }
.logo2{font-family: Impact, Charcoal, sans-serif;  display:block;font-size:120%; margin-left:25% }
.print{font-family: Impact, Charcoal, sans-serif; width:20%; padding-left:20%; }
 
 .column100 {font-family: Impact, Charcoal, sans-serif; width:10%; padding:7px; color:#000}
 .row100 {font-family: Impact, Charcoal, sans-serif; width:10%; padding:50%; }
 .appear {display:none; }
 .commentTable{border:2px solid #000; font-family: Times New Roman, Times, serif; }
 .commentTable2{border-top:1px solid #000; font-family: Times New Roman, Times, serif;}
 .printText{color:#000;}
 .printText2{color:#000;  font-size:100%;}

}
@media screen {


 .logo{font-family: Impact, Charcoal, sans-serif; font-size:300%; margin-left:20%;}
 .logo2{font-family: Impact, Charcoal, sans-serif;  display:block;font-size:120%; margin-left:36% }
 .commentTable{border:2px solid #000; font-family: Times New Roman, Times, serif; font-size:3px; padding-bottom:20px; margin-top:10px}
 .commentTable2{border-top:1px solid #000; font-family: Times New Roman, Times, serif; font-size:5px; margin-top:10px}

}

/* If the screen size is 600px wide or less, set the font-size of <div> to 30px */
@media screen and (max-width: 600px) {


.logo{font-family: Impact, Charcoal, sans-serif; font-size:12px; margin-left:30%; display:block }
.logo2{font-family: Impact, Charcoal, sans-serif; font-size:10px; margin-left:30%; display:block }



div.example {
  font-size: 30px;
  
}
}
/** mark**/

@media only screen and (max-width: 800px) {
  .logo{font-family: Impact, Charcoal, sans-serif; font-size:25px; margin-left:30%; display:block }
.logo2{font-family: Impact, Charcoal, sans-serif; font-size:10px; margin-left:30%; display:block }
.printbutton{margin-left:20px}
.carduse{margin-left:20px}


  
}
 
@media only screen and (max-width: 640px) {
	
.logo{font-family: Impact, Charcoal, sans-serif; font-size:25px; margin-left:30%; display:block }
.logo2{font-family: Impact, Charcoal, sans-serif; font-size:10px; margin-left:30%; display:block }
.printbutton{margin-left:20px}
.carduse{margin-left:20px}

  
}
</style>



</head>
<body>

<table  style="border-bottom:2px solid #000; font-family: Times New Roman, Times, serif; font-size:13px; height:20px">


  
  <tr> 
  
  <td rowspan="2" style="width:20%"><img src="images/<?php echo $school_logo; ?>" height="100" width="100" style="margin-left:50%; margin-bottom:3%"/></td>
  <td><span class="logo">HERALD COLLEGE ODORU, NSUKKA</span><br/><span style="font-size:120%; margin-left:36%"  class="logo2"><i>...Unravel the Mystery</i></span></td>
    <td  rowspan="2"><img src="Administration/images/student-passport/<?php echo $passport;?>" height="60" width="60" style="margin-left:20%;border:2px solid #000" class="rounded"/></td>
    <td><li class="breadcrumb-item active"><button onclick="window.print()" class="btn btn-sm btn-success appear printbutton">Print</button></li></td>
   
  </tr>

  <tr>
    <td style="width:50%"></td>
   
    <td><span class="carduse">Card Use: <strong><?php echo $LoginCount;?>/3</strong></span><br/> <span class="carduse">Resumption Date: </span><span class="carduse"> <strong><?php echo $r_date;?></strong><br/> <a class="text-danger appear" href="logout.php?logout=1" style="margin-left:60%;"> <strong>Logout</strong></a></span></td>
    
  </tr>
</table>

<table height="100" style="border-bottom:2px solid #000; font-family: Times New Roman, Times, serif; font-size:13px">

<tr>
<td>
   <div style="padding-left:20px"><b>Reg Number: </b> <?php echo $_SESSION['RegNum'];?></div>
</td>
<td><b>Session: </b> <?php echo $_SESSION['school_session'];?></td>
<td><b>Sport House: </b> <?php echo $_SESSION['sHouse'];?></td>
<td><b>Annual Position in Class:</b> <?php if($Row['totalaverage']!=""){

echo get_position(implode(",",$student_data), round($Row['totalaverage'])); 

$resultNotReady="";
 }

 else{
    echo'No Results Yet';
    $resultNotReady="Results Not Yet Ready. Contact School Admin";

 }
  ?></td>





</tr>
<tr>
    <td><div style="padding-left:20px"><b>Student's Name: </b> <?php echo  $_SESSION['FName'];?> <?php echo  $_SESSION['MName'];?> <?php echo $_SESSION['LName'] ;?></div></td>
    <td><b>Annual Result for: </b>  <strong><?php echo $_SESSION['school_session'];?></strong></td>
    <td><b>Date of Birth: </b><?php echo $_SESSION['DOB'] ;?>  </td>
    <td><b>Number in Class: </b> <?php echo  $classNumber;?></td>
    
    
    
    
    </tr>
    <tr>
        <td><div style="padding-left:20px"><b>Gender: </b> <?php echo $_SESSION['gender'];?></div></td>
        <td><b>Class:</b> <?php echo $_SESSION['class'];?></td>
        <td><b>All Students: </b><?php echo $allStudentNumber;?></td>
        <td><b>Total Average:</b> <?php echo round($Row['totalaverage'], 2); 

                     

                      
                      
                      
                      ?>
                      
                      

                      
                      
                    
                   </td>
        
        
        
        
        
        </tr>




        
            
    </table>











<div class="limiter">
		<div class="container-table100">
			
				<div class="table100 ver1 m-b-110">

      

<div class="table100 ver5 m-b-110"  >
					<table data-vertable="ver2"  class="print">
						<thead>
							<tr class="row100 head">
								<th class="column100 column2" data-column="column1" rowspan="2"><span class="printText2">Subjects</span></th>
                 <th class="column100 column2" data-column="column2" colspan="5"><span class="printText2">First Term</span></th>
								<th class="column100 column2" data-column="column2" colspan="5"><span class="printText2">Second Term</span></th>
                 <th class="column100 column3" data-column="column3" colspan="5"><span class="printText2">Third Term</span></th>
                <th class="column100 column3" data-column="column3" rowspan="2"><span class="printText2">Annual Result</span></th>
                <th class="column100 column3" data-column="column3"  rowspan="2"><span class="printText2">Subject Position</span></th>
                <th class="column100 column3" data-column="column3" rowspan="2"><span class="printText2">Grade</span></th>
                <th class="column100 column3" data-column="column3" rowspan="2"><span class="printText2">Remark</span></th>

              </tr>

								
                <tr>
                  <th class="column100 column2" data-column="column2"><span class="printText2">CA1</span></th>
                  <th class="column100 column2" data-column="column2"><span class="printText2">CA2</span></th>
                  <th class="column100 column2" data-column="column2"><span class="printText2">CA3</span></th>
                  <th class="column100 column2" data-column="column2"><span class="printText2">Exam</span></th>
                  <th class="column100 column2" data-column="column2"><span class="printText2">Total</span></th>

                  <th class="column100 column2" data-column="column2"><span class="printText2">CA1</span></th>
                  <th class="column100 column2" data-column="column2"><span class="printText2">CA2</span></th>
                  <th class="column100 column2" data-column="column2"><span class="printText2">CA3</span></th>
                  <th class="column100 column2" data-column="column2"><span class="printText2">Exam</span></th>
                  <th class="column100 column2" data-column="column2"><span class="printText2">Total</span></th>

                  <th class="column100 column2" data-column="column2"><span class="printText2">CA1</span></th>
                  <th class="column100 column2" data-column="column2"><span class="printText2">CA2</span></th>
                  <th class="column100 column2" data-column="column2"><span class="printText2">CA3</span></th>
                  <th class="column100 column2" data-column="column2"><span class="printText2">Exam</span></th>
                  <th class="column100 column2" data-column="column2"><span class="printText2">Total</span></th>
      
        
                </tr>
							
						</thead>
						<tbody>
							

               
             

        <?php 
        

        $list_sub = $con->query("SELECT * FROM `registered_subjects` WHERE School='$School' AND StudentReg ='$_SESSION[RegNum]' Group By subjectID Order By subjectID ASC");
        while($row_subjects = $list_sub->fetch_array()){
        $result = mysqli_query($con, "SELECT *,
        MAX(CASE WHEN results.Term = 'First' THEN results.CA1 END) 'FirstTermCA1',
        MAX(CASE WHEN results.Term = 'First' THEN results.CA2 END) 'FirstTermCA2',
        MAX(CASE WHEN results.Term = 'First' THEN results.CA3 END) 'FirstTermCA3',
        MAX(CASE WHEN results.Term = 'First' THEN results.Exam END) 'FirstTermExam',
        MAX(CASE WHEN results.Term = 'First' THEN results.Total END) 'FirstTermTotal',
       
        MAX(CASE WHEN results.Term = 'Second' THEN results.CA1 END) 'SecondTermCA1',
        MAX(CASE WHEN results.Term = 'Second' THEN results.CA2 END) 'SecondTermCA2',
        MAX(CASE WHEN results.Term = 'Second' THEN results.CA3 END) 'SecondTermCA3',
        MAX(CASE WHEN results.Term = 'Second' THEN results.Exam END) 'SecondTermExam',
        MAX(CASE WHEN results.Term = 'Second' THEN results.Total END) 'SecondTermTotal',

        MAX(CASE WHEN results.Term = 'Third' THEN results.CA1 END) 'ThirdTermCA1',
        MAX(CASE WHEN results.Term = 'Third' THEN results.CA2 END) 'ThirdTermCA2',
        MAX(CASE WHEN results.Term = 'Third' THEN results.CA3 END) 'ThirdTermCA3',
        MAX(CASE WHEN results.Term = 'Third' THEN results.Exam END) 'ThirdTermExam',
        MAX(CASE WHEN results.Term = 'Third' THEN results.Total END) 'ThirdTermTotal',
        SUM(results.Total) AS allTermScoreTotal
        
        
        FROM results WHERE school_session='$_SESSION[school_session]'  AND class='$_SESSION[class]' AND  subjectID='$row_subjects[subjectID]'AND StudentReg ='$_SESSION[RegNum]' AND Publish='Yes'
       
        ORDER BY results.Sno, results.StudentID DESC");
        $row_results = $result->fetch_array();
        $allTotalScoreAverage=$row_results['allTermScoreTotal']/3;


       



          ?>
<tr class="row100">




                <td class="column100 column1" data-column="column1"><b><?php echo $row_subjects['subjectName'];?></b></td>
                


                <td class="column100 column2" data-column="column2"><span class="printText"><?php echo  $row_results['FirstTermCA1'];?></span></td>
								<td class="column100 column2" data-column="column2"><span class="printText"><?php echo  $row_results['FirstTermCA2'];?></span></td>
                <td class="column100 column2" data-column="column2"><span class="printText"><?php echo  $row_results['FirstTermCA3'];?></span></td>
                <td class="column100 column2" data-column="column2"><span class="printText"><?php echo  $row_results['FirstTermExam'];?></span></td>
                <td class="column100 column2" data-column="column2"><strong><?php echo  $row_results['FirstTermTotal'];?></strong></td>
               
                 



                
                <td class="column100 column2" data-column="column2"><span class="printText2"><?php echo  $row_results['SecondTermCA1'];?></span></td>
								<td class="column100 column2" data-column="column2"><span class="printText2"><?php echo  $row_results['SecondTermCA2'];?></span></td>
                <td class="column100 column2" data-column="column2"><span class="printText2"><?php echo  $row_results['SecondTermCA3'];?></span></td>
                <td class="column100 column2" data-column="column2"><span class="printText2"><?php echo  $row_results['SecondTermExam'];?></span></td>
                <td class="column100 column2" data-column="column2"><strong><?php echo  $row_results['SecondTermTotal'];?></strong></td>
               
                


                
                <td class="column100 column2" data-column="column2"><span class="printText"><?php echo  $row_results['ThirdTermCA1'];?></span></td>
								<td class="column100 column2" data-column="column2"><span class="printText"><?php echo  $row_results['ThirdTermCA2'];?></span></td>
                <td class="column100 column2" data-column="column2"><span class="printText"><?php echo  $row_results['ThirdTermCA3'];?></span></td>
                <td class="column100 column2" data-column="column2"><span class="printText"><?php echo  $row_results['ThirdTermExam'];?></span></td>
                <td class="column100 column2" data-column="column2"><strong><?php echo  $row_results['ThirdTermTotal'];?></strong></td>



 <?php 










$sch_grade=annual_grade($allTotalScoreAverage);
?>
          
                



                 <td class="column100 column3" data-column="column3"><span class="printText"><?php echo  round($allTotalScoreAverage, 2);?></span></td>
                 <td class="column100 column3" data-column="column3"><span class="printText"> <?php 
                  $check_res = $con->query("SELECT *, SUM(Average) AS Sum_Average FROM `results` WHERE school_session='$_SESSION[school_session]' AND class='$_SESSION[class]' AND  subjectID='$row_subjects[subjectID]' AND Publish ='Yes'  GROUP BY StudentReg ORDER BY  Sum_Average DESC ");
               
                  $counter = 1; 
                  $rank = 1;
                  
                  
                  $prevScore = 0;
                  
                foreach( $check_res as $value){
                      
                      $score = $value['Sum_Average'];
                  
                      if ($prevScore != $score) 
                          $rank = $counter;
                          include('Administration/include/end.php');
                      

                      if($_SESSION['RegNum'] == $value['StudentReg']){
                    
                      echo $rank.$end;
                     
                  }
                      $counter ++; 
                      
                     
                      $prevScore = $score;
                  
                }
                  ?></span></td>
                 <td class="column100 column3" data-column="column3"><?php echo $sch_grade['grade'];?></td>
                 <td class="column100 column3" data-column="column3"><?php echo $sch_grade['remark'];?></td>




		</tr>
              
              <?php
            
        }

        echo $resultNotReady;

        

    ?>
						

            <tr class="row100">




<td class="column100 column1" data-column="column1"><b>Total</b></td>



<td class="column100 column2" data-column="column2"></td>
<td class="column100 column2" data-column="column2"></td>
<td class="column100 column2" data-column="column2"></td>
<td class="column100 column2" data-column="column2"></td>
<td class="column100 column2" data-column="column2"><strong><?php echo $firstTermTotalRow['firstTermTotalSummation'];?></strong></td>

 




<td class="column100 column2" data-column="column2"></td>
<td class="column100 column2" data-column="column2"></td>
<td class="column100 column2" data-column="column2"></td>
<td class="column100 column2" data-column="column2"></td>
<td class="column100 column2" data-column="column2"><strong><?php echo $secondTermTotalRow['secondTermTotalSummation'];?></strong></td>





<td class="column100 column2" data-column="column2"></td>
<td class="column100 column2" data-column="column2"></td>
<td class="column100 column2" data-column="column2"></td>
<td class="column100 column2" data-column="column2"></td>
<td class="column100 column2" data-column="column2"><strong><?php echo $thirdTermTotalRow['thirdTermTotalSummation'];?></strong></td>








 <td class="column100 column3" data-column="column3"><strong><?php echo round($totalAverageSummation, 2);?></strong></td>
 <td class="column100 column3" data-column="column3"></td>
 <td class="column100 column3" data-column="column3"></td>




</tr>
              
            </tbody>
            

          
          </table>
          


         
        </div>
        
        <table height=""  class="commentTable2 rounded">

<tr>
<td style="padding-left:120px;font-size:12px; " class="text-justify">
  <b>Key to grades: </b>
  <span class="text-success font-weight-bold" style="margin-right:10px;"><i>A (Excellent)70% and Above</i></span>
  <span class="text-primary font-weight-bold" style="margin-right:10px;"><i>B (Very Good)60% - 69%</i></span>
  <span class="text-info font-weight-bold" style="margin-right:10px;"><i>C (Credit)50% - 59%</i></span>
  <span class="text-secondary font-weight-bold" style="margin-right:10px;"><i>D(Pass)45% - 49%</i></span>
  <span class="text-warning font-weight-bold" style="margin-right:10px;"><i>E (Poor)40% - 44%</i></span>
  <span class="text-danger font-weight-bold" style="margin-right:10px;"><i>F (Fail)39% and Below</i></span>

</td>
</table>




  <table height="100" class="commentTable">

  <tr>
  <th  style="padding-left:20px;"> <span class="printText2">Form Teacher's Remark:</span></th>
  <th><span class="printText2">Form Teacher's Signature:</span></th>

  <th><span class="printText2">Principal's Comment:</span></th>

  <th><span class="printText2">Stamp:</span></th>

</tr>
<tr>
    <td  style="padding-left:20px;"><span class="font-weight-bold printText2"><b> Name:</b> <?php echo $teacher;?></span></td>
    <td><img src="Administration/images/signatures/<?php echo $signature; ?>" height="70" width="70" style=" margin-bottom:3%; margin-top:1%" class="rounded"/></td>
    <td><span class="font-weight-bold printText2"> <b>Name: </b><?php echo $principalname;?>  </span> </td>
    <td><img src="images/<?php echo $school_stamp; ?>" height="70" width="70" style=" margin-bottom:3%" class="rounded"/></td>
    
    
    
    
    </tr>
    <tr>
        <td  style="padding-left:20px;"><span class="font-weight-bold printText2"><b>Comments:</b> <strong><?php echo $teacherComment;?></strong><strong><?php echo $teacherCustomRemark;?></strong></span></td>
        <td></td>
        <td><span class="font-weight-bold printText2"><b>Comments: </b><?php echo  $principal_promotion_comment;?> <?php //echo  $principalCustomRemark;?>  </span></td>
        <td><span class="font-weight-bold printText2">Date: <b><?php echo date("l-Y-m-d");?></b> </span></td>
        
        
        
        
        
        </tr>



        
            
    </table>
        </div>
			</div>
    
    
  </div>
  

  


	

<!--===============================================================================================-->	
	<script src="external/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="external/vendor/bootstrap/js/popper.js"></script>
	<script src="external/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="external/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
  <script src="external/js/main.js"></script>
  


  

</body>
</html>

<?php unset($_SESSION['studentLoginstudentID']);?>

