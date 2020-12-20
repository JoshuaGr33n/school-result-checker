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


?>


<?php
if($_SESSION['Adminusername'] =="")
{
header("Location: index.php" );
exit;
}

if($_SESSION['studentResultSession']=="")
{
header("Location: dashboard.php" );
exit;
}


//database connection
include('include/db.php');







?>
<?php 


$studentsExpand="";
$ExpandAdmin="";
$ExpandResults="";
$ExpandSiteManager="";
$ExpandPinManager="";




$pinGeneratorCurrentPageTag="active";
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
// side bar and header
include('include/privilege-restrictions.php');


?>



<?php 

if($studentManagement!="YES")
{
  header("Location: index.php" );
  exit;
}

if($resultManagement!="YES")
{
  header("Location: index.php" );
  exit;
}
?>





<?php

//search results table
        $searchresultQuery = "SELECT * FROM results where StudentID ='". $_SESSION['studentResultID']."' and school_session ='". $_SESSION['studentResultSession']."'and class ='". $_SESSION['studentResultClass']."'and Term ='".$_SESSION['studentResultTerm'] ."'";
        $searchresultResult = mysqli_query($con, $searchresultQuery);
	
	




?>





<?php

//output all from admin table
        $allAdminQuery = "SELECT * FROM administration";
        $allAdminResult = mysqli_query($con,  $allAdminQuery);
?>


<?php

	
	
$studentDetailQuery = "SELECT * FROM students where student_id= '".$_SESSION['studentResultID']."'";
$studentDetailResult = mysqli_query($con, $studentDetailQuery);




// Loop through each row, outputting the login and password
while ($studentDetailrow = mysqli_fetch_array($studentDetailResult))
{
$student_id = $studentDetailrow['student_id'];
$fname = $studentDetailrow['FirstName'];
$mName = $studentDetailrow['MiddleName'];
$lname = $studentDetailrow['LastName'];
$email = $studentDetailrow['Email'];
$dob = $studentDetailrow['DOB'];
$fone = $studentDetailrow['Phone'];
$term = $studentDetailrow['Term'];
$session = $studentDetailrow['session'];
$class = $studentDetailrow['Class'];
$sportHouse = $studentDetailrow['SportHouse'];
$state = $studentDetailrow['State_Of_Origin'];
$lga = $studentDetailrow['LGA'];
$address = $studentDetailrow['Address'];
$profilePic = $studentDetailrow['ProfilePic'];
$regNum = $studentDetailrow['RegNum'];
$gender = $studentDetailrow['Gender'];




}			



?>


<?php
 


if(isset($_POST["save"])) {
$rowCount = count($_POST["users"]);
for($i=0;$i<$rowCount;$i++) {

  if($_POST["publish"]!="")
          {
mysqli_query($con, "UPDATE results set Publish='" . $_POST["publish"] . "' WHERE Sno='" .  $_POST["users"][$i]. "'");
          }
}
header("Location:student-result-view.php");
exit;


}
?>






<?php
 //teacher's remark


if(isset($_POST["t_remark_button"])) {


 

           
            $ck_row=mysqli_query($con, "SELECT  name, session, term, class, StudentID FROM  remark WHERE name ='Teacher' AND session ='".$_SESSION['studentResultSession']."' AND class='".$_SESSION['studentResultClass']."' AND term='".$_SESSION['studentResultTerm']."' AND StudentID='".$student_id."'  ");
            
            if(mysqli_num_rows($ck_row) < 1){
mysqli_query($con, "INSERT INTO `remark`( `name`, `remark`, `session`,`class`, `term`,`StudentID` ) VALUES ('Teacher','".$_POST['t_remark']."','".$_SESSION['studentResultSession']."','".$_SESSION['studentResultClass']."', '".$_SESSION['studentResultTerm']."','".$student_id."') ");
            }
            
            

            if(mysqli_num_rows($ck_row) == 1) {

              mysqli_query($con, "UPDATE remark set  remark='" . $_POST["t_remark"] . "' WHERE name ='Teacher' AND session ='".$_SESSION['studentResultSession']."' AND StudentID='".$student_id."' AND class='".$_SESSION['studentResultClass']."'AND class='".$_SESSION['studentResultClass']."' AND term='".$_SESSION['studentResultTerm']."'");


            }





header("Location:student-result-view.php");
exit;


}




	

	
$t_remarkQuery = "SELECT * FROM remark WHERE name ='Teacher' AND session ='".$_SESSION['studentResultSession']."' AND class='".$_SESSION['studentResultClass']."' AND term='".$_SESSION['studentResultTerm']."' AND StudentID='".$student_id."'";
$t_remarkResult = mysqli_query($con, $t_remarkQuery);

$t_remarkRow = mysqli_fetch_array($t_remarkResult);

$teacherCustomRemark = $t_remarkRow['remark'];










?>





<?php

//principal's remark
 


if(isset($_POST["p_remark_button"])) {


 

           
            $ck_row=mysqli_query($con, "SELECT  name, session, term, class, StudentID FROM  remark WHERE name ='Principal' AND session ='".$_SESSION['studentResultSession']."' AND class='".$_SESSION['studentResultClass']."' AND term='".$_SESSION['studentResultTerm']."' AND StudentID='".$student_id."'  ");
            
            if(mysqli_num_rows($ck_row) < 1){
mysqli_query($con, "INSERT INTO `remark`( `name`, `remark`, `session`,`class`, `term`,`StudentID` ) VALUES ('Principal','".$_POST['p_remark']."','".$_SESSION['studentResultSession']."','".$_SESSION['studentResultClass']."', '".$_SESSION['studentResultTerm']."','".$student_id."') ");
            }
            
            

            if(mysqli_num_rows($ck_row) == 1) {

              mysqli_query($con, "UPDATE remark set  remark='" . $_POST["p_remark"] . "' WHERE name ='Principal' AND session ='".$_SESSION['studentResultSession']."' AND StudentID='".$student_id."' AND class='".$_SESSION['studentResultClass']."' AND term='".$_SESSION['studentResultTerm']."'");


            }





header("Location:student-result-view.php");
exit;


}




	

	
$p_remarkQuery = "SELECT * FROM remark WHERE name ='Principal' AND session ='".$_SESSION['studentResultSession']."' AND class='".$_SESSION['studentResultClass']."' AND term='".$_SESSION['studentResultTerm']."' AND StudentID='".$student_id."'";
$p_remarkResult = mysqli_query($con, $p_remarkQuery);

$p_remarkRow = mysqli_fetch_array($p_remarkResult);

$principalCustomRemark = $p_remarkRow['remark'];










?>















<?php

//total average


        $Query = "SELECT StudentReg, SUM(Total) AS TotalTotal, SUM(Average) AS totalaverage FROM results WHERE Class ='".$_SESSION['studentResultClass']."' AND school_session ='".$_SESSION['studentResultSession']."' AND Term ='".$_SESSION['studentResultTerm']."' AND StudentReg ='".$regNum."'
        GROUP BY StudentReg   ORDER BY totalaverage DESC";
        $Result = mysqli_query($con, $Query);
          $Row = mysqli_fetch_array($Result); 

          $totalAverage=$Row['TotalTotal']/4;
  



      

        
        
?>




<?php 

//summation of  total


$totalQuery = "SELECT StudentReg, SUM(Total) AS totalsummation FROM results  WHERE Class ='".$_SESSION['studentResultClass']."' AND school_session ='".$_SESSION['studentResultSession']."' AND Term ='".$_SESSION['studentResultTerm']."' AND StudentReg ='".$regNum."'
GROUP BY StudentReg   ORDER BY totalsummation DESC";
$totalResult = mysqli_query($con, $totalQuery);

$totalRow = mysqli_fetch_array($totalResult); 
?>

<?php 

$student_score=mysqli_query($con, "SELECT SUM(Average) AS Average, StudentID FROM `results` WHERE Class ='".$_SESSION['studentResultClass']."' AND school_session = '".$_SESSION['studentResultSession']."' AND Term = '".$_SESSION['studentResultTerm']."' GROUP BY StudentID ");
foreach ($student_score as $key => $value) {
    $student_data[]= round($value['Average']);
}





$sql="SELECT COUNT(countable.StudentReg) as totalClass FROM (SELECT DISTINCT StudentReg FROM `results` WHERE Class ='".$_SESSION['studentResultClass']."' AND school_session = '".$_SESSION['studentResultSession']."' AND Term = '".$_SESSION['studentResultTerm']."') as countable";
$countresult = mysqli_query($con, $sql) or die ("Query error!");

while ($erow = mysqli_fetch_array($countresult)) {

  $var = $erow['totalClass'];

  $classNumber=$var;

}

?>




<?php 


$formTeacherQuery = "SELECT * FROM classes WHERE className ='".$_SESSION['studentResultClass']."'";
$formTeacherResult = mysqli_query($con, $formTeacherQuery);

$formTeacherRow = mysqli_fetch_array($formTeacherResult);

$formTeacher = $formTeacherRow['FormTeacher'];


$principalQuery = "SELECT * FROM administration WHERE privileged_Status	 ='Principal'";
$principalResult = mysqli_query($con, $principalQuery);

$principalRow = mysqli_fetch_array($principalResult);

$principal = $principalRow['First_Name'].' '.$principalRow['Last_Name'];


?>







<?php include('include/term-results-grading.php');?>

<!DOCTYPE html>
<html lang="en">
  <head>
  <meta name="description" content="">
    <!-- Twitter meta-->
    <meta property="twitter:card" content="">
    <meta property="twitter:site" content="">
    <meta property="twitter:creator" content="">
    <!-- Open Graph Meta-->
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="">
    <meta property="og:title" content="">
    <meta property="og:url" content="">
    <meta property="og:image" content="">
    <meta property="og:description" content="">
    <title>Result:: <?php echo $regNum;?></title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--begin::Global Theme Styles(used by all pages)-->
    
		<link href="other.css?v=7.0.8" rel="stylesheet" type="text/css" />
		<!--end::Global Theme Styles-->



    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <!-- Main CSS-->



<!--edit and delete form script-->

<script language="javascript" src="formjs/student-result-view.js" type="text/javascript"></script>
<!--edit and delete form script-->




<!--checkbox select all-->
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
    
		<SCRIPT language="javascript">

    $(function () {

        // add multiple select / deselect functionality

        $("#selectall").click(function () {

            $('.name').attr('checked', this.checked);

        });

 

        // if all checkbox are selected, then check the select all checkbox

        // and viceversa

        $(".name").click(function () {

 

            if ($(".name").length == $(".name:checked").length) {

                $("#selectall").attr("checked", "checked");

            } else {

                $("#selectall").removeAttr("checked");

            }

 

        });

    });

</SCRIPT>
  <!--checkbox select all-->  


    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  </head>
  <body class="app sidebar-mini">
    

          <?php 
// side bar and header
           include('include/nav_header.php');


        ?>


    <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-th-list"></i> Results For: <?php echo $fname;?> <?php echo $mName;?> <?php echo $lname;?></h3> <?php echo $_SESSION['studentResultClass'];?>-<?php echo $_SESSION['studentResultTerm'];?> Term-<?php echo $_SESSION['studentResultSession'];?></h3>
          <p>Total Summation: <strong><?php echo $totalRow['totalsummation'];?></strong></p>
          <p>Total Average: <strong><?php echo round( $totalAverage, 2);?></strong></p>
          <p>Position in Class: <strong><?php echo get_position(implode(",",$student_data), round($Row['totalaverage']));?></strong></p>
          <p>Number in Class: <strong><?php echo $classNumber;?></strong></p>
          <p>Form Teacher's Comment (<?php echo $formTeacher;?>): <strong><?php echo $teacherComment;?></strong><strong><?php echo $teacherCustomRemark;?></strong></p>
          <p>Principal's Comment (<?php echo $principal;?>): <strong><?php echo  $p_comment['principalComment'];?> <?php echo  $principalCustomRemark;?></strong></p>
        
        
        </div>
        <ul class="app-breadcrumb breadcrumb side">
          <!--<li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>-->
          <li></li>
          <li><a href="select-student-result-category.php?studentID=<?php echo $student_id;?>" class="btn btn-sm btn-primary font-weight-bold py-2 px-3 px-xxl-5 my-1" style="margin-right:10px;">Back</a></li>
         <!-- <li class="breadcrumb-item active"><a href="uploadresult.php" class="btn btn-sm btn-primary font-weight-bold py-2 px-3 px-xxl-5 my-1" style="margin-right:10px;">Upload Results</a></li>-->
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">
              <div class="table-responsive">

              <form name="frmUser" method="post" action="">
              <div class="row">
              <div class="col-xl-6">
              <div class="form-group row">
								<label class="col-xl-3 col-lg-3 col-form-label"></label>
										<div class="col-lg-9 col-xl-9">
                       <select class="form-control form-control-lg form-control-solid" name="publish">
                            <option value=""> --Publish-- </option>
                            <option value="Yes"> Yes </option>
                            <option value="No"> No </option>
                           
                      
                   
                                                                            
                                                                            
                   </select>
                                                                            
																		</div>
                                  </div>
                   </div>

                  

                   


                  


                   

                   
                   


                   
                   <div class="row">
                   <div class="col-xl-6">
                   <div class="form-group row">
																<input type="submit" name="save" class="btn btn-sm btn-primary font-weight-bold py-2 px-3 px-xxl-5 my-" style=" margin-left:20%"  value="Save"/>
																
                    </div>
                    </div>
                   </div>
                   
                   </div>

                  



            
                <table class="table table-hover table-bordered table-striped" id="sampleTable">
                
                  <thead>
                    <tr>
                    <th><input type="checkbox" id="selectall"/> Select all</th>
                      <th>Student Reg Number</th>
                      <th>Subject</th>
                      <th>Class</th>
                      <th>Term</th>
                      <th>Session</th>
                      <th>CA 1</th>
                      <th>CA 2</th>
                      <th>CA 3</th>
                      <th>Exam</th>
                      <th>Total</th>
                      <th>Average</th>
                      <th>Grade</th>
                      <th>Remark</th>
                      <th>Subject Position</th>
                      <th>Published</th>
                      <th>Published By</th>
                    </tr>
                  </thead>
                  <tbody>
                   <?php
                   while ($searchresultRow = mysqli_fetch_array($searchresultResult))
                   {
                   //output all from students table
                   $sno =$searchresultRow['Sno']; 
                    $student_id =$searchresultRow['StudentID'];
                    $RegNum =$searchresultRow['StudentReg']; 
                    $subject =$searchresultRow['subject']; 
                    $subjectID =$searchresultRow['subjectID']; 

                  
                  
                   $class = $searchresultRow['class'];
                   $session = $searchresultRow['school_session'];
                   $term = $searchresultRow['Term'];
                   $ca1 = $searchresultRow['CA1'];
                   $ca2 = $searchresultRow['CA2'];
                   $ca3 = $searchresultRow['CA3'];
                   $exam = $searchresultRow['Exam'];
                   $total = $searchresultRow['Total'];
                   $average = $searchresultRow['Average'];
                   $grade = $searchresultRow['Grade'];
                   $remark = $searchresultRow['Remark'];
                   $publish = $searchresultRow['Publish'];
                   $teacher = $searchresultRow['Teacher'];


                   $studentDetailQuery = "SELECT * FROM students where student_id= '". $student_id."'";
                   $studentDetailResult = mysqli_query($con, $studentDetailQuery);
                   
                   $studentDetailrow = mysqli_fetch_array($studentDetailResult);
                  
                   $fname = $studentDetailrow['FirstName'];
                   $mName = $studentDetailrow['MiddleName'];
                   $lname = $studentDetailrow['LastName'];
                   $RegNum = $studentDetailrow['RegNum'];

                   
                   
                   
                   
                   
            
                   $ave=$total/4;
                   			
                   
                     ?>
                    <tr>
                    <td><input type="checkbox" name="users[]" value="<?php echo $searchresultRow['Sno']; ?>" class="name" /></td>
                      <td><a href="student-details.php?studentID=<?php echo $student_id;?>" style="text-decoration:none"><?php echo $RegNum;?></a></td>
                      <td><?php echo $subject;?></td>
                      <td><?php echo $class;?></td>
                      <td><?php echo $term;?></td>
                      <td><?php echo $session;?></td>
                      <td><?php echo $ca1;?></td>
                      <td><?php echo $ca2;?></td>
                      <td><?php echo $ca3;?></td>
                      <td><?php echo $exam;?></td>
                      <td><?php echo $total;?></td>
                      <td><?php echo round($ave, 2);?></td>
                      <td><?php echo $grade;?></td>
                      <td><?php echo $remark;?></td>

                      <td>
                      <?php 
                  $check_res = $con->query("SELECT * FROM `results` WHERE school_session='$session' AND Term='$term' AND class='$class' AND  subjectID='$subjectID'  ORDER BY Average DESC ");
                  $counter = 1; 
                  $rank = 1; 
                  
                
                  $prevScore = 0;
                  
                foreach( $check_res as $value){
                     
                      $score = $value['Average'];
                  
                      if ($prevScore != $score) 
                          $rank = $counter;
                         
                          
                     

                      if($RegNum == $value['StudentReg']){
                        include('include/end.php');
                     
                      echo $rank.$end;
                      

                         
                   
                  }
                      $counter ++;
                      
                      
                      $prevScore = $score;
                  
                }
                  ?></td>


                      <td><?php echo $publish;?></td>
                      <td><?php echo $teacher;?></td>
                    </tr>
                   <?php }?>

                   

                    
                    
                  </tbody>
                   
                </table>


                <ul class="app-breadcrumb breadcrumb side">
        
          <li><button name="delete" onClick="setDeleteAction();"  class="btn btn-sm btn-danger  font-weight-bold py-2 px-3 px-xxl-5 my-1" style="margin-right:10px;">Delete</button></li>
          <li><button name="update" onClick="setUpdateAction();"  class="btn btn-sm btn-primary font-weight-bold py-2 px-3 px-xxl-5 my-1" style="margin-right:10px;">Update</button></li>
          
        </ul>

                   </form>

                   
              </div>


              

              
            </div>
          </div>


           <!--begin::Card-->
           <div class="card card-custom gutter-b example example-compact"  style="width:70%; margin-left:15%">
											<div class="card-header">
												<h3 class="card-title"> </h3>
												<div class="card-toolbar">
													<div class="example-tools justify-content-center">
                                                   
                                                    
													</div>
												</div>
											</div>

                      <form method="post">
											<div class="card-body">
												<table class="table table-striped">
                        <div class="form-group row">
																		<label class="col-xl-3 col-lg-3 col-form-label">Form Teacher's Custom Remark Here:</label>
																		<div class="col-lg-6 col-xl-6">
																			<div class="input-group input-group-lg input-group-solid">
																				<div class="input-group-prepend">
																					<span class="input-group-text">
																						<i class="la la-at"></i>
																					</span>
																				</div>
                                        <textarea class="form-control form-control-lg form-control-solid" name="t_remark"><?php echo $teacherCustomRemark;?></textarea> 
                                                                                
                                                                              
                                                                            
                            
                                                                            </div>
                                                                            <span class="form-text text-muted"></span>
																		</div>
																	</div>
                                                
                                               



                                  <div>
															
															<div>
																<input type="submit" name="t_remark_button" class="btn btn-primary font-weight-bold py-2 px-3 px-xxl-5 my-1" style="margin-left:25%; width:50%" value="Submit"/>
																
															</div>
														</div>   


                            </form>





                            <form method="post">
											<div class="card-body">
												<table class="table table-striped">
                        <div class="form-group row">
																		<label class="col-xl-3 col-lg-3 col-form-label">Principal's Custom Remark Here:</label>
																		<div class="col-lg-6 col-xl-6">
																			<div class="input-group input-group-lg input-group-solid">
																				<div class="input-group-prepend">
																					<span class="input-group-text">
																						<i class="la la-at"></i>
																					</span>
																				</div>
                                        <textarea class="form-control form-control-lg form-control-solid" name="p_remark"><?php echo $principalCustomRemark;?></textarea> 
                                                                                
                                                                              
                                                                            
                            
                                                                            </div>
                                                                            <span class="form-text text-muted"></span>
																		</div>
																	</div>
                                                
                                               



                                  <div>
															
															<div>
																<input type="submit" name="p_remark_button" class="btn btn-primary font-weight-bold py-2 px-3 px-xxl-5 my-1" style="margin-left:25%; width:50%" value="Submit"/>
																
															</div>
														</div>   


                            </form>
                                               
                                               
                                                 

                                                

                                               
                                                
                                                 

                                                
                                                
                                                
                                                
                                                
                                                
                                                
                                                
                                                
                                                
                                                
                                                
                                                
                                                
                                                
                                                
                                               </table>
												 
											</div>
										</div>
										<!--end::Card-->
        </div>
      </div>
    </main>
    <!--handle conflict-->
    <script src='js/jquery-3.3.1.min.js'></script>
<script>
var jq132 = jQuery.noConflict();
</script>
<script src='external/plugins/global/plugins.bundle526f.js?v=7.0.8'></script>
<script>
var jq142 = jQuery.noConflict();
</script>
<!--handle conflict-->
    <!-- Essential javascripts for application to work-->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
    <!-- The javascript plugin to display page loading on top-->
    <script src="js/plugins/pace.min.js"></script>
    <!-- Page specific javascripts-->
    <!-- Data table plugin-->
    <script type="text/javascript" src="js/plugins/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="js/plugins/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript">$('#sampleTable').DataTable();</script>
    <!-- Google analytics script-->
    <script type="text/javascript">
      if(document.location.hostname == 'pratikborsadiya.in') {
      	(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      	(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      	m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      	})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
      	ga('create', 'UA-72504830-1', 'auto');
      	ga('send', 'pageview');
      }
    </script>
  </body>
</html>


<?php unset($_SESSION["classResultSession"]);?>