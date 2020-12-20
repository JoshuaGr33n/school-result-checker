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

if($_SESSION['annualResult']=="Annual Result")
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

//class position query

$student_score=mysqli_query($con, "SELECT SUM(Average) AS Average, StudentID FROM `results` where class ='".$_SESSION['class']."' and school_session = '".$_SESSION['school_session']."' and Term = '".$_SESSION['term']."' GROUP BY StudentID ");
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

//summation of average


        $Query = "SELECT StudentReg, SUM(Total) AS TotalTotal, SUM(Average) AS totalaverage FROM results where Class ='".$_SESSION['class']."' And school_session ='".$_SESSION['school_session']."' AND Term ='".$_SESSION['term']."' AND StudentReg ='".$_SESSION['RegNum']."'
        AND Publish ='Yes'
        GROUP BY StudentReg   ORDER BY totalaverage DESC";
        $Result = mysqli_query($con, $Query);
          $Row = mysqli_fetch_array($Result); 
          $totalAverage=$Row['TotalTotal']/4;
  
        
        
?>

<?php

//summation of  total


        $totalQuery = "SELECT StudentReg, SUM(Total) AS totalsummation FROM results where Class ='".$_SESSION['class']."' And school_session ='".$_SESSION['school_session']."' AND Term ='".$_SESSION['term']."' AND StudentReg ='".$_SESSION['RegNum']."'
        AND Publish ='Yes'
        GROUP BY StudentReg   ORDER BY totalsummation DESC";
        $totalResult = mysqli_query($con, $totalQuery);

        $totalRow = mysqli_fetch_array($totalResult); 
  
        
        
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
$sql="SELECT COUNT(countable.StudentReg) as totalClass FROM (SELECT DISTINCT StudentReg FROM `results` WHERE class ='".$_SESSION['class']."' and school_session = '".$_SESSION['school_session']."' and Term = '".$_SESSION['term']."') as countable";
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

$resumptionDateQuery = "SELECT * FROM resumption_date WHERE term='$_SESSION[term]' AND session='$_SESSION[school_session]'";
$resumptionDateResult = mysqli_query($con, $resumptionDateQuery);

$resumptionDaterow = mysqli_fetch_array($resumptionDateResult);
$r_date = $resumptionDaterow['date'];
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



	

	
$t_remarkQuery = "SELECT * FROM remark WHERE name ='Teacher' AND session ='".$_SESSION['school_session']."' AND class='".$_SESSION['class']."' AND term='".$_SESSION['term']."' AND StudentID='".$_SESSION['studentID'] ."'";
$t_remarkResult = mysqli_query($con, $t_remarkQuery);

$t_remarkRow = mysqli_fetch_array($t_remarkResult);

$teacherCustomRemark = $t_remarkRow['remark'];



$p_remarkQuery = "SELECT * FROM remark WHERE name ='Principal' AND session ='".$_SESSION['school_session']."' AND class='".$_SESSION['class']."' AND term='".$_SESSION['term']."' AND StudentID='".$_SESSION['studentID'] ."'";
$p_remarkResult = mysqli_query($con, $p_remarkQuery);


$p_remarkRow = mysqli_fetch_array($p_remarkResult);

$principalCustomRemark = $p_remarkRow['remark'];









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





<?php include('Administration/include/term-results-grading.php');?>


<!DOCTYPE html>
<html lang="en">

<head>
	<title>Results:: <?php echo  $_SESSION['FName'];?> <?php echo $_SESSION['LName'] ;?></title>
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

.container-table100{
  width:100%; margin-right:20%;
}
.align{font-size:10px}

.logo{font-family: Impact, Charcoal, sans-serif; font-size:25px; margin-left:30%; display:block }
.logo2{font-family: Impact, Charcoal, sans-serif; font-size:10px; margin-left:40%; display:block }
 
 .print{font-family: Impact, Charcoal, sans-serif; width:10%; padding-left:20%; }
 .column100 {font-family: Impact, Charcoal, sans-serif; width:50%; padding:10px; color:#000}
 .row100 {font-family: Impact, Charcoal, sans-serif; width:10%; padding:5%; }
 .carduse{padding-left:20px;}
 .text-justify{padding-left:20px; font-size:5%;}
 .appear {display:none; }
 .head{color:#000;}
 .printText{color:#000; font-size:10px; text-decoration:none}





 .table{
       
       width:100%;
      
       margin-top:30px;
       border:solid 2px;

   }
  
   th:first-child{width:15%; }
   .table  th{width:15%;background-color:#000; color:#fff; font-size:10px }
   .table  td{padding:5px 5px 9px 10px }

   .bottomTable th{width:5%;background-color:#000; color:#fff; }



 #container{
 margin:auto;
  width:100%;
 }





}
@media screen {


 .logo{font-family: Impact, Charcoal, sans-serif; font-size:300%; margin-left:20%;}
 .text-justify{padding-left:120px;font-size:12px;}
 .logo2{font-family: Impact, Charcoal, sans-serif;  display:block;font-size:120%; margin-left:36% }



 .table-striped > tbody > tr:nth-child(2n+1) > td, .table-striped > tbody > tr:nth-child(2n+1) > th{background-color:	#E7FFE7}


 .table{
        
        width:100%;
        margin-top:30px;
        border:solid 5px;

    }
    th:first-child{width:15%; }
    th{width:5%;background-color:#000; color:#fff}



    #container{
  margin:auto;
   width:80%;
}
.keyGrades{ 
   width:100%;margin-top:200px;}


.bottomTable{
       
        width:100%;
       margin-top:30px;
      
}
.bottomTable th:first-child{width:5%;}

}











  

@media only screen and (max-width: 800px) {
  .logo{font-family: Impact, Charcoal, sans-serif; font-size:25px; margin-left:30%; display:block }
.logo2{font-family: Impact, Charcoal, sans-serif; font-size:10px; margin-left:40%; display:block }
.printbutton{margin-left:20px}
.carduse{margin-left:20px}


.table{
       
       width:100%;
      
       margin-top:30px;
       border:solid 2px;
       margin-right:300px;

   }
  
   


 #container{
 margin:auto;
  width:100%;
 }
 



  
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

<table  style="border-bottom:2px solid #000; font-family: Times New Roman, Times, serif; font-size:13px; height:20px; width:100%">



  <tr> 
  
  <td rowspan="2" style="width:20%"><img src="images/<?php echo $school_logo; ?>" height="100" width="100" style="margin-left:50%; margin-bottom:3%"/></td>
  <td><span class="logo">HERALD COLLEGE ODORU, NSUKKA</span><br/><span class="logo2"><i>...Unravel the Mystery</i></span></td>
    <td  rowspan="2"><img src="Administration/images/student-passport/<?php echo $passport;?>" height="60" width="60" style="margin-left:20%;border:2px solid #000" class="rounded"/></td>
    <td class="carduse"><li class="breadcrumb-item active"><button onclick="window.print()" class="btn btn-sm btn-success appear printbutton">Print</button></li></td>
   
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
<td><b>Position in Class:</b> 
<?php 
 if($Row['totalaverage']!=""){

echo get_position(implode(",",$student_data), round($Row['totalaverage'])); 

$resultNotReady="";
 }

 else{
    echo'No Results Yet';
    $resultNotReady="Results Not Yet Ready. Contact School Admin";

 }
?>
</td>





</tr>
<tr>
    <td><div class="align" style="padding-left:20px"><b>Student's Name: </b> <?php echo  $_SESSION['FName'];?> <?php echo  $_SESSION['MName'];?> <?php echo $_SESSION['LName'] ;?></div></td>
    <td><b>Term: </b> <?php echo $_SESSION['term'];?> Term</td>
    <td><b>Date of Birth: </b><?php echo $_SESSION['DOB'] ;?>  </td>
    <td><b>Number in Class: </b> <?php echo  $classNumber;?></td>
    
    
    
    
    </tr>
    <tr>
        <td><div style="padding-left:20px"><b>Gender: </b> <?php echo $_SESSION['gender'];?></div></td>
        <td><b>Class:</b> <?php echo $_SESSION['class'];?></td>
        <td><b>All Students: </b><?php echo $allStudentNumber;?></td>
        <td><b>Total Average:</b>  <?php echo round($totalAverage, 2); 





                  
               
                   ?>
                   

                   
                   
                      
                      
                      

                      
                      
                    
                  </td>
        
        
        
        
        
        </tr>




        
            
    </table>










	

<div id="container">
	

      


					<table class="print table table-hover  table-striped table-bordered">
						<thead>
							<tr class="row100 head">
								<th class="2"1"><span class="printText">Subjects</span></th>
								<th class="2" data-column="column2"><span class="printText">CA 1</span></th>
								<th class="3" data-column="column3"><span class="printText">CA 2</span></th>
								<th class="4" data-column="column4"><span class="printText">CA 3</span></th>
								<th class="5" data-column="column5"><span class="printText">Exam Score</span></th>
								<th class="6" data-column="column6"><span class="printText">Total</span></th>
								<th class="7" data-column="column7"><span class="printText">Average</span></th>
                <th class="8" data-column="column8"><span class="printText">Grade</span></th>
                <th class="7" data-column="column7"><span class="printText">Remark</span></th>
                <th class="7" data-column="column7"><span class="printText">Subject Position</span></th>
								<th class="8" data-column="column8"><span class="printText">Teacher</span></th>
							</tr>
						</thead>
						<tbody>
							


             

        <?php 
        

        $list_sub = $con->query("SELECT * FROM `registered_subjects` WHERE  School='$School' AND StudentReg ='$_SESSION[RegNum]' Order By subjectID ASC");
        while($row_subjects = $list_sub->fetch_array()){

         




        $result = mysqli_query($con, "SELECT * FROM `results` WHERE school_session='$_SESSION[school_session]' AND Term='$_SESSION[term]' AND class='$_SESSION[class]' AND  subjectID='$row_subjects[subjectID]' AND StudentReg ='$_SESSION[RegNum]' AND Publish ='YES' ");
        $row_results = $result->fetch_array();


        



          if($row_results['Grade']=="A"){


            $row_results['Grade']='<span class="text-success font-weight-bold">' .$row_results['Grade']. '</span>';
            
            
            
            
            $row_results['Remark']='<span class="text-success font-weight-bold">' .$row_results['Remark']. '</span>';
            
            
            
            
            }
            if($row_results['Grade']=="B"){
            
              $row_results['Grade']='<span class="text-primary font-weight-bold">' .$row_results['Grade']. '</span>';
            
            
              $row_results['Remark']='<span class="text-primary font-weight-bold">' .$row_results['Remark']. '</span>';
            
            
            
            
            }
            if($row_results['Grade']=="C"){
            
            
            
              $row_results['Grade']='<span class="text-info font-weight-bold">' .$row_results['Grade']. '</span>';
            
            
              $row_results['Remark']='<span class="text-info font-weight-bold">' .$row_results['Remark']. '</span>';
            
            
            
            
            }
            
            
            
            
            if($row_results['Grade']=="D"){
            
              $row_results['Grade']='<span class="text-secondary font-weight-bold">' .$row_results['Grade']. '</span>';
            
            
              $row_results['Remark']='<span class="text-secondary font-weight-bold">' .$row_results['Remark']. '</span>';
            
            
            
            
            }
            
            if($row_results['Grade']=="E"){
            
              $row_results['Grade']='<span class="text-warning font-weight-bold">' .$row_results['Grade']. '</span>';
            
            
              $row_results['Remark']='<span class="text-warning font-weight-bold">' .$row_results['Remark']. '</span>';
            
            
            
            
            }
            
            if($row_results['Grade']=="F"){
              $row_results['Grade']='<span class="text-danger font-weight-bold">' .$row_results['Grade']. '</span>';
            
            
              $row_results['Remark']='<span class="text-danger font-weight-bold">' .$row_results['Remark']. '</span>';
            
            
            
            
            }


            $ave=$row_results['Total']/4;
          
        ?>
<tr class="row100">






								<td class="1" data-column="column1"><b><?php echo $row_subjects['subjectName'];?></b></td>
								<td class="2" data-column="column2"><span class="printText"><?php echo  $row_results['CA1'];?></span></td>
								<td class="3" data-column="column3"><span class="printText"><?php echo  $row_results['CA2'];?></span></td>
								<td class="4" data-column="column4"><span class="printText"><?php echo  $row_results['CA3'];?></span></td>
								<td class="5" data-column="column5"><span class="printText"><?php echo  $row_results['Exam'];?></span></td>
								<td class="6" data-column="column6"><span class="printText"><?php echo  $row_results['Total'];?></span></td>
								<td class="7" data-column="column7"><span class="printText"><?php echo round($ave, 2);?></span></td>
                <td class="8" data-column="column8"><?php echo  $row_results['Grade'];?></td>
                <td class="8" data-column="column8"><?php echo  $row_results['Remark'];?></td>
                <td class="8" data-column="column8"><span class="printText"><?php 
                  $check_res = $con->query("SELECT * FROM `results` WHERE school_session='$_SESSION[school_session]' AND Term='$_SESSION[term]' AND class='$_SESSION[class]' AND  subjectID='$row_subjects[subjectID]' AND Publish ='Yes' ORDER BY Average DESC ");
                 
                  $counter = 1; 
                  $rank = 1; 
                  
                
                  $prevScore = 0;
                  
                foreach( $check_res as $value){
                     
                      $score = $value['Average'];
                  
                      if ($prevScore != $score) 
                          $rank = $counter;
                         
                          
                     

                      if($_SESSION['RegNum'] == $value['StudentReg']){
                        include('Administration/include/end.php');
                     
                      echo $rank.$end;
                      

                         
                   
                  }
                      $counter ++;
                      
                      
                      $prevScore = $score;
                  
                }
                  ?></span>
                </td>
                <td class="8" data-column="column8"><span class="printText"><?php echo  $row_results['Teacher'];?></span></td>
              </tr>



             
              
              <?php
            
               



         }

       echo $resultNotReady;
    ?>
							


              <tr class="row100">




<td class="1" data-column="column1"><strong>Total</strong></td>
<td class="2" data-column="column2"></td>
<td class="3" data-column="column3"></td>
<td class="4" data-column="column4"></td>
<td class="5" data-column="column5"></td>
<td class="6" data-column="column6"><strong><?php echo $totalRow['totalsummation'];?></strong></td>
<td class="7" data-column="column7"><strong><?php echo round($totalAverage, 2)?></strong></td>
<td class="8" data-column="column8"></td>
<td class="8" data-column="column8"></td>
<td class="8" data-column="column8"></td>
<td class="8" data-column="column8"></td>
</tr>
              
              
            </tbody>
            

          
          </table>
          


         
       
        
        <table height="" style="border-top:1px solid #000; font-family: Times New Roman, Times, serif; font-size:5px; margin-top:20px" class="rounded">

<tr>
<td class="text-justify" >
  <b>Key to grades: </b>
  <span class="text-success font-weight-bold" style="margin-right:10px;"><i>A (Excellent)70% and Above</i></span>
  <span class="text-primary font-weight-bold" style="margin-right:10px;"><i>B (Very Good)60% - 69%</i></span>
  <span class="text-info font-weight-bold" style="margin-right:10px;"><i>C (Credit)50% - 59%</i></span>
  <span class="text-secondary font-weight-bold" style="margin-right:10px;"><i>D(Pass)45% - 49%</i></span>
  <span class="text-warning font-weight-bold" style="margin-right:10px;"><i>E (Poor)40% - 44%</i></span>
  <span class="text-danger font-weight-bold" style="margin-right:10px;"><i>F (Fail)39% and Below</i></span>

</td>
</table>




  <table height="100" class="bottomTable" style="border:2px solid #000; font-family: Times New Roman, Times, serif; font-size:15px; padding-bottom:20px; ">

<tr>
  <th  style="padding-left:20px;"><span class="printText"> Form Teacher's Remark</span></th>
  <th><span class="printText">Form Teacher's Signature:</span></th>

  <th><span class="printText">Principal's Comment:</span></th>

  <th><span class="printText">Stamp:</span></th>

</tr>
<tr>
    <td  style="padding-left:20px;"><b> Name:</b> <span class="font-weight-bold"><?php echo $teacher;?></span></td>
    <td><img src="Administration/images/signatures/<?php echo $signature; ?>" height="70" width="70" style=" margin-bottom:3%; margin-top:1%" class="rounded"/></td>
    <td><b>Name: </b><span class="font-weight-bold"> <?php echo $principalname;?>  </span> </td>
    <td><img src="images/<?php echo $school_stamp; ?>" height="70" width="70" style=" margin-bottom:3%" class="rounded"/></td>
    
    
    
    
    </tr>
    <tr>
        <td  style="padding-left:20px;"><b>Comments:</b> <strong><?php echo $teacherComment;?></strong><strong><?php echo $teacherCustomRemark;?></strong></td>
        <td></td>
        <td><b>Comments: </b><span class="font-weight-bold"><?php echo  $p_comment['principalComment'];?> <?php echo  $principalCustomRemark;?>  </span></td>
        <td><span class="font-weight-bold">Date:</span> <b><?php echo date("l-Y-m-d");?></b> </td>
        
        
        
        
        
        </tr>




        
            
    </table>
      
    
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