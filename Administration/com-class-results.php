<?php session_start();?>
<?php
if( $_SESSION['Adminusername'] =="")
{
header("Location: index.php" );
exit;
}


if( $_SESSION['classResultSession']=="")
{
header("Location: dashboard.php" );
exit;
}

//database connection
include('include/db.php');






?>
<?php

//If a link in the nav bar is active


$pageActiveTag3="Results";
$currentPageTag="all student result";


if($pageActiveTag3="Results"){

  $studentsExpand="";
  $ExpandAdmin="";
  $ExpandResults="is-expanded";
  $ExpandSiteManager="";
  $ExpandPinManager="";

    


}

if($currentPageTag="all student result"){
  $allPinCurrentPageTag="";
  $pinGeneratorCurrentPageTag="";
  $resultPageManagerCurrentPageTag="";
  $frontPageManagerCurrentPageTag="";
  $downloadResultClassCurrentPageTag="";
  $importResultClassCurrentPageTag="";
  $searchResultClassCurrentPageTag="";
  $allStudentResultClassCurrentPageTag="active";
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
$class = $_SESSION['classResultClass'];
$session = $_SESSION['classResultSession'];
$term = $_SESSION['classResultTerm'];

?>

<?php








    
  $sub_class = substr($class, 0, 3);
    
    if($sub_class =="JSS")
    {
     $school="Junior Secondary School";
    
    }
    
    else if ($sub_class =="SSS"){
    
    $school="Senior Secondary School";
    
    }

    else{
      header("Location: select-students.php");
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
    <title>Comprehensive Result::<?php echo $class;?>-<?php echo $session;?>-<?php echo $term;?> Term</title>
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

<script language="javascript" src="formjs/view-all-results.js" type="text/javascript"></script>
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
  <header class="app-header"><a class="app-header__logo" href="dashboard.php">Administration</a>
      <!-- Sidebar toggle button--><a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>
      <!-- Navbar Right Menu-->
      <ul class="app-nav">
       
        <!-- User Menu-->
        <li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Open Profile Menu"><i class="fa fa-user fa-lg"></i></a>
          <ul class="dropdown-menu settings-menu dropdown-menu-right">
            <li><a class="dropdown-item" href="edit-my-profile.php"><i class="fa fa-cog fa-lg"></i> Settings</a></li>
            <li><a class="dropdown-item" href="my-profile.php"><i class="fa fa-user fa-lg"></i> My Profile</a></li>
            <li><a class="dropdown-item" href="logout.php?logout=1"><i class="fa fa-sign-out fa-lg"></i> Logout</a></li>
          </ul>
        </li>
      </ul>
    </header>

        


    <main style="width:100%; padding:20px">
      <div class="app-title" style="margin-top:20px">
        <div>
        <h1><i class="fa fa-th-list"></i> Comprehensive Result For:</h3> <?php echo $class;?>-<?php echo $session;?>-<?php echo $term;?> Term </h3>
          <p></p>
        </div>
        <ul class="app-breadcrumb breadcrumb side">
          <!--<li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>-->
          <!--<li class="breadcrumb-item"></li>-->
          <li class="breadcrumb-item active"><a href="select-students.php" class="btn btn-sm btn-primary font-weight-bold py-2 px-3 px-xxl-5 my-1" style="margin-right:10px;">Back</a></li>
         
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">
              <div class="table-responsive">

              

                  



            
                  
                
              
                                
                  

              


                  

                  
              
                  <table class="table table-hover table-bordered table-striped" id="sampleTable2">
                    <thead>
                      <tr>
                      <th scope="col">Name</th>
                      <?php
               
               $list_subjects = "
               SELECT subjectName, subjectID, StudentID, StudentReg, current_class
               FROM `registered_subjects` 
               WHERE School = '$school'
                  
               Group By subjectID Order By subjectID ASC
               ";
               $query  = $con->prepare($list_subjects);                                   
              // $query->bind_param("i", $school); 
               $query->execute();                           
               $query->Store_result();                      
               $query->bind_result($subjectName, $subjectID, $studentID, $student_Reg, $current_class);  
               $count =  $query->num_rows; ?>

                      <?php while($query->fetch()){ $conditions[] = $subjectID; ?>
                      <th scope="col"><?php echo $subjectName; ?></th>
                      <?php } ?>
                      <th scope="col">Total</th>
                      <th scope="col">Average</th>
                      <th scope="col">Position</th>
                   
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                    $results = mysqli_query($con, "SELECT *, SUM(Total) as sTotal, AVG(Total) as AveTotal FROM `results` WHERE school_session='$session' AND Term='$term' AND class='$class' AND  subjectID IN (".implode(',',$conditions).") GROUP BY StudentID ");
                  
                    while($row_resultss = $results->fetch_array()){ 
                    
                     $ave=$row_resultss['sTotal']/$count;
                     $ave=number_format($ave, 2);?>
                     
                   
                      <tr>
                      <td> <?php 
                    $reg = $row_resultss['StudentReg'];
                    $students_name_query = "
                     SELECT FirstName, LastName 
                     FROM `students` 
                     WHERE RegNum = '$row_resultss[StudentReg]'
                     Order By student_id DESC
                    
                       
                    
                     ";
                     $students_name  = $con->prepare($students_name_query);                                   
                   
                     $students_name->execute();                           
                     $students_name->Store_result();                      
                     $students_name->bind_result($firstName, $lastName);
                     $students_name->fetch();
                    
                    ?>
                    <?php echo $firstName;?> <?php echo $lastName;?>
                    </td>
                        <?php 
                        $list_subjects = "
                        SELECT subjectName, subjectID, StudentID, StudentReg, current_class
                        FROM `registered_subjects` 
                        WHERE School = '$school'
                          
                        Group By subjectID Order By subjectID ASC
                        ";
                        $querys  = $con->prepare($list_subjects);                                   
                       // $querys->bind_param("i", $school); 
                        $querys->execute();                           
                        $querys->Store_result();                      
                        $querys->bind_result($subjectName, $subjectID, $studentID, $student_Reg, $current_class);
                        while($querys->fetch()){  

                            $result = mysqli_query($con, "SELECT * FROM `results` WHERE school_session='$session' AND Term='$term' AND class='$class' AND  subjectID='$subjectID' AND  StudentID=' $row_resultss[StudentID]' ");
                  
                            $row_results = $result->fetch_array(); ?>
                        
                        <td><?php echo $row_results['Total'];?></td>
                        <?php } ?>
                        <td><strong><?php echo $row_resultss['sTotal'];?></strong></td>
                        <td><strong><?php echo $ave;?></strong></td>









                        <td><strong><?php
 
                  $check_res  = "
                      SELECT StudentReg, Average, SUM(Total) as SUM_Total
                      FROM `results` 
                      WHERE school_session = '$session'
                          AND Term = '$term'
                          AND class = '$class' 
                          AND  subjectID IN (".implode(',',$conditions).") GROUP BY StudentID
                          order by SUM_Total DESC
                          
                         
                         
                        
                  ";
                  
                  $queryPos  = $con->prepare($check_res);                                   
               
                 $queryPos->execute();                           
                 $queryPos->Store_result();                       
                 $queryPos->bind_result($studentreg, $student_average, $sum_total);   
                  
                 $counter = 1; 
                 $rank = 1; 
               
                
                 $prevScore = 0;
                 
             
                 while($queryPos->fetch()){
                   
                     $score = $sum_total;
                 
                     if ($prevScore != $score) 
                         $rank = $counter;
                         include('include/end.php');
                   

                     if($row_resultss['StudentReg'] == $studentreg){
                    
                     echo $rank.$end;
                     

                        
                  
                 }
                     $counter ++; 
                     
                     
                     $prevScore = $score;
                 
               }
?></strong></td>






                      </tr>
                        <?php } ?>
                    </tbody>
                  </table>
               

               
               
               
              












                

                 

                  
                  
                </tbody>
                 
              </table>
            


              

                   </form>

                   
              </div>

             
              
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
   




<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
	<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/buttons/1.4.2/js/dataTables.buttons.js"></script>
	<script src="https://cdn.datatables.net/buttons/1.4.2/js/buttons.print.js"></script>



<script>
			$(document).ready(function() {
    $('#sampleTable2').DataTable( {
        dom: 'Bfrtip',		
        buttons:[
        'print'
    ]
    } );
} );
			</script>
  </body>
</html>


