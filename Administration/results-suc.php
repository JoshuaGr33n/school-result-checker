<?php session_start();?>
<?php
if( $_SESSION['Adminusername'] =="")
{
header("Location: index.php" );
exit;
}

if( $_SESSION['searchSubject'] =="")
{
header("Location: search-results.php" );
exit;
}


//database connection
include('include/db.php');






?>
<?php

//If a link in the nav bar is active


$pageActiveTag3="Results";
$currentPageTag="search result";


if($pageActiveTag3="Results"){

  $studentsExpand="";
  $ExpandAdmin="";
  $ExpandResults="is-expanded";
  $ExpandSiteManager="";
  $ExpandPinManager="";

    


}

if($currentPageTag="search result"){
  $allPinCurrentPageTag="";
  $pinGeneratorCurrentPageTag="";
  $resultPageManagerCurrentPageTag="";
  $frontPageManagerCurrentPageTag="";
  $downloadResultClassCurrentPageTag="";
  $importResultClassCurrentPageTag="";
  $searchResultClassCurrentPageTag="active";
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



}






?>
<?php 
// side bar and header
include('include/privilege-restrictions.php');


?>



<?php 

if($resultManagement!="YES")
{
  header("Location: index.php" );
  exit;
}
?>





<?php

//search results table
        $searchresultQuery = "SELECT * FROM results where subject ='".$_SESSION['searchSubject']."' and school_session ='".$_SESSION['searchSession']."'and class ='". $_SESSION['searchClass']."'and Term ='".$_SESSION['searchTerm']."'";
        $searchresultResult = mysqli_query($con, $searchresultQuery);
	
	




?>

<?php 



	

	
$studentDetailQuery = "SELECT Teacher FROM results where subject ='".$_SESSION['searchSubject']."' and school_session ='".$_SESSION['searchSession']."'and class ='". $_SESSION['searchClass']."'and Term ='".$_SESSION['searchTerm']."'";
$studentDetailResult = mysqli_query($con, $studentDetailQuery);

$studentDetailrow = mysqli_fetch_array($studentDetailResult);

$teacher = $studentDetailrow['Teacher'];









?>





<?php

//output all from admin table
        $allAdminQuery = "SELECT * FROM administration";
        $allAdminResult = mysqli_query($con,  $allAdminQuery);
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
header("Location:results-suc.php");
exit;


}
?>


<?php

//output all from admin table
        $allAdminQuery = "SELECT * FROM administration";
        $allAdminResult = mysqli_query($con,  $allAdminQuery);
?>




<?php
 


if(isset($_POST["submitbutton"])) {


 

           
           
            
            

           

              mysqli_query($con, "UPDATE results set  Teacher='" . $_POST["uploadedby"] . "' where subject ='".$_SESSION['searchSubject']."' and school_session ='".$_SESSION['searchSession']."'and class ='". $_SESSION['searchClass']."'and Term ='".$_SESSION['searchTerm']."'");


            





header("Location:results-suc.php");
exit;


}
?>

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
    <title>Result</title>
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

<script language="javascript" src="formjs/results-suc.js" type="text/javascript"></script>
<!--edit and delete form script-->




<!--checkbox select all-->
<script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
    
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
          <h1><i class="fa fa-th-list"></i> Results For:</h3> <?php echo $_SESSION['searchSession'];?>-<?php echo $_SESSION['searchClass'];?>-<?php echo $_SESSION['searchTerm'];?> Term -<?php echo $_SESSION['searchSubject'];?></h3>
          <p></p>
        </div>
        <ul class="app-breadcrumb breadcrumb side">
         

          <form method="post" action="exports/resuc-suc-export.php">
          <li><button name="export" class="btn btn-sm btn-warning font-weight-bold py-2 px-3 px-xxl-5 my-1" style="margin-right:30px;">Export into Excel</button></li>
            </form>


          
          <li><a href="uploadresult.php" class="btn btn-sm btn-primary font-weight-bold py-2 px-3 px-xxl-5 my-1" style="margin-right:10px;">Import Results</a></li>
          <li><a href="search-results.php" class="btn btn-sm btn-danger font-weight-bold py-2 px-3 px-xxl-5 my-1" style="margin-right:10px;">Back</a></li>
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
                      <th>Name</th>
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
                    $student_reg =$searchresultRow['StudentReg']; 
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
                   
                   



		

                   
                   
                   
                   
                   
            
                   
                   			
                   
                     ?>
                    <tr>
                    <td><input type="checkbox" name="users[]" value="<?php echo $searchresultRow['Sno']; ?>" class="name" /></td>
                      <td><a href="student-details.php?studentID=<?php echo $student_id;?>" style="text-decoration:none"><?php echo $student_reg;?></a></td>
                      <td><font size="2"><?php echo strtoupper($fname);?> <?php echo strtoupper($lname);?></font></td>
                      <td><?php echo $subject;?></td>
                      <td><?php echo $class;?></td>
                      <td><?php echo $term;?></td>
                      <td><?php echo $session;?></td>
                      <td><?php echo $ca1;?></td>
                      <td><?php echo $ca2;?></td>
                      <td><?php echo $ca3;?></td>
                      <td><?php echo $exam;?></td>
                      <td><?php echo $total;?></td>
                      <td><?php echo $average;?></td>
                      <td><?php echo $grade;?></td>
                      <td><?php echo $remark;?></td>
                      <td>
                      <?php 
                  
                
 $check_res  = "
 SELECT StudentReg, Average
 FROM `results` 
 WHERE school_session = '$session' 
     AND Term = '$term' 
     AND class = '$class'
     AND subjectID = '$subjectID'
 ORDER BY Average DESC
 ";
 
 $query  = $con->prepare($check_res);                                  
 
 $query->execute();                          
 $query->Store_result();                     
 $query->bind_result($studentreg, $student_average);   
 
 
 $last_value = false;     
 $counter    = 0;       
 while($query->fetch()){  
 $counter++;         
 
 
 
 $rank = ($last_value == false || $last_value <> $student_average) ? $counter : $rank;
 
 
 
 
 
 include('include/end.php');
 
 if($RegNum == $studentreg){
   
 echo "{$rank}{$end}";  
        
 
 }
 $last_value = $student_average;                                  
 
 }
                   ?>
</td>
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

              <form method="post">
											<div class="card-body">
												<table class="table table-striped">
                        <div class="form-group row">
																		<label class="col-xl-3 col-lg-3 col-form-label">Teacher:</label>
																		<div class="col-lg-6 col-xl-6">
																			<div class="input-group input-group-lg input-group-solid">
																				<div class="input-group-prepend">
																					<span class="input-group-text">
																						<i class="la la-at"></i>
																					</span>
																				</div>
                                        <select required class="form-control form-control-lg form-control-solid" name="uploadedby">
                                                            <option value="<?php echo $teacher; ?>"><?php echo $teacher; ?></option>
                                                             <?php   while ($allAdminRow = mysqli_fetch_array($allAdminResult))
                                                                 {
                                                                   //output all from classes table
                                                                  $first_name =$allAdminRow['First_Name'];
                                                                  $last_name =$allAdminRow['Last_Name'];
                                                                  ?>
                                                                  
                                                                  
                                                                  
                                                

                                                                
																<option value="<?php echo  $first_name;?> <?php echo  $last_name;?>"><?php echo  $first_name;?> <?php echo  $last_name;?></option>
																<?php }?>
																
															</select>
                                                                                
                                                                              
                                                                            
                            
                                                                            </div>
                                                                            <span class="form-text text-muted"></span>
																		</div>
																	</div>
                                                
                                               



                                  <div>
															
															<div>
																<input type="submit" name="submitbutton" class="btn btn-primary font-weight-bold py-2 px-3 px-xxl-5 my-1" style="margin-left:25%; width:50%" value="Change"/>
																
															</div>
														</div>   


                            </form>

              
            </div>
          </div>
          
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


