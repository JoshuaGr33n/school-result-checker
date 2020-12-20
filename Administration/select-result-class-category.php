<?php session_start();?>
<?php
if( $_SESSION['Adminusername'] =="")
{
header("Location: index.php" );
exit;
}


//database connection
include('include/db.php');




?>
<?php

//If a link in the nav bar is active


$pageActiveTag3="Results";
$currentPageTag="search result by Class";


if($pageActiveTag3="Results"){

  $studentsExpand="";
  $ExpandAdmin="";
  $ExpandResults="is-expanded";
  $ExpandSiteManager="";
  $ExpandPinManager="";

    


}

if($currentPageTag="search result by Class"){
  
  $searchResultByClassCurrentPageTag="active";
  $allPinCurrentPageTag="";
  $pinGeneratorCurrentPageTag="";
  $resultPageManagerCurrentPageTag="";
  $frontPageManagerCurrentPageTag="";
  $downloadResultClassCurrentPageTag="";
  $importResultClassCurrentPageTag="";
  $searchResultClassCurrentPageTag="";
  $allStudentResultClassCurrentPageTag="";
  
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

//output all from students table
        $allClassesQuery = "SELECT * FROM classes WHERE className NOT IN('GRADUATED STUDENT')";
        $allClassesResult = mysqli_query($con, $allClassesQuery);
?>

<?php

//output all from students table
        $allSubjectQuery = "SELECT * FROM subjects";
        $allSubjectResult = mysqli_query($con, $allSubjectQuery);
?>

<?php

//output all from students table
        $allSessionQuery = "SELECT * FROM school_session";
        $allSessionResult = mysqli_query($con, $allSessionQuery);
?>



<?php
$err="";

if(isset($_POST['search']))
{

    
	
	
	
	
	//$username = $_POST['username'];
	//$password= $_POST['password'];
	
	$query1 = "SELECT * FROM results where  school_session ='".$_POST['session']."'and class ='".$_POST['class']."'and Term ='".$_POST['term']."'";
	$query = mysqli_query($con, $query1);
     $result = mysqli_num_rows($query);
if($result == 0)
{
	
	$err = "<div class='btn btn-light-danger font-weight-bold'>No Students in this Class</div>";
}
while($c = mysqli_fetch_array( $query ))
{
	
    $_SESSION['classResultSession']= $c['school_session'];
    $_SESSION['classResultClass'] = $c['class'];
    $_SESSION['classResultTerm'] = $c['Term'];
   
    $_SESSION['classResultRegNum'] = $c['StudentReg'];
   
    
    

    


        header("Location: select-students.php");
        exit;
    
	 
	

       
        
    

	
}
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
    <title>Search Results by Class</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
       <!--begin::Global Theme Styles(used by all pages)-->
       <link href="external/plugins/global/plugins.bundle526f.css?v=7.0.8" rel="stylesheet" type="text/css" />
		
        <link href="external/css/style.bundle526f.css?v=7.0.8" rel="stylesheet" type="text/css" />
        
		<!--end::Global Theme Styles-->



    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <!-- Main CSS-->


    
		
    


    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
    div#response.display-block {
	display: block;
}
</style>
  </head>
  <body class="app sidebar-mini">
    

          <?php 
// side bar and header
           include('include/nav_header.php');


        ?>


    <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-th-list"></i> Select Class</h1>
          <p></p>
        </div>
        <ul class="app-breadcrumb breadcrumb side">
          <!--<li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>-->
          <!--<li class="breadcrumb-item"></li>-->
         
        </ul>
      </div>
      <!--begin::Card-->
     
									<div class="col-lg-6" style="margin-left:20%;">
										<!--begin::Card-->
										<div class="card card-custom example example-compact">
											<div class="card-header">
												<h3 class="card-title">
                                                    <?php echo $err;?>
                                                   
                                            </h3>
												<div class="card-toolbar">
													<div class="example-tools justify-content-center">
													
													</div>
												</div>
											</div>
											<!--begin::Form-->
											<form class="form" id="kt_form_1" method="post">
												<div class="card-body">
																						<div class="alert alert-custom alert-light-danger d-none" role="alert" id="kt_form_1_msg">
														<div class="alert-icon">
															<i class="flaticon2-information"></i>
														</div>
														<div class="alert-text font-weight-bold"></div>
														<div class="alert-close">
															<button type="button" class="close" data-dismiss="alert" aria-label="Close">
																<span>
																	<i class="ki ki-close"></i>
																</span>
															</button>
														</div>
													</div>
													
													
													
													
													
												
                                                        



                                                    <div class="form-group row">
														<label class="col-form-label text-right col-lg-3 col-sm-12">Class *</label>
														<div class="col-lg-9 col-md-9 col-sm-12">
															<select  class="form-control form-control-lg form-control-solid" name="class">
                                      <option value="">Select</option>
                                        <?php   while ($allClassesRow = mysqli_fetch_array($allClassesResult))
                                         {
                                            //output all from classes table
                                           $class_id =$allClassesRow['classID'];
                                           $class_name =$allClassesRow['className'];
                                             ?>
                                                                  
                                                                  
                                                                  
                                                

                                                                
																<option value="<?php echo $class_name;?>"><?php echo $class_name;?></option>
																<?php }?>
															</select>
															<span class="form-text text-muted">Please select an option.</span>
														</div>
                                                    </div>
                                                    <div class="form-group row">
														<label class="col-form-label text-right col-lg-3 col-sm-12">School Year *</label>
														<div class="col-lg-9 col-md-9 col-sm-12">
															<select  class="form-control form-control-lg form-control-solid" name="session">
                                  <option value="">Select</option>
                                      <?php   while ($allSessionRow = mysqli_fetch_array($allSessionResult))
                                                {
                                                //output all from classes table
                                                $session_id =$allSessionRow['sessionID'];
                                                  $session_name =$allSessionRow['sessionName'];
                                                  ?>
                                                                  
                                                                  
                                                                  
                                                

                                                                
																<option value="<?php echo $session_name;?>"><?php echo $session_name;?></option>
																<?php }?>
																
															</select>
															<span class="form-text text-muted">Please select an option.</span>
														</div>
													</div>
													<div class="form-group row">
														<label class="col-form-label text-right col-lg-3 col-sm-12" >Term *</label>
														<div class="col-lg-9 col-md-9 col-sm-12">
															<select  class="form-control form-control-lg form-control-solid" name="term">
																<option value="">Select</option>
																<option value="First">First Term</option>
																<option value="Second">Second Term</option>
																<option value="Third">Third Term</option>
																
															</select>
															<span class="form-text text-muted">Please select an option.</span>
														</div>
                                                     </div>
													
													
												
                                                </div>
                                                
												<div class="card-footer">
													<div class="row">
														<div class="col-lg-9 ml-lg-auto">
															<input type="submit" class="btn btn-success font-weight-bold mr-2" name="search" value="Search"/>
															<button type="reset" class="btn btn-light-success font-weight-bold">Reset</button>
														</div>
													</div>
												</div>
											</form>
											<!--end::Form-->
										
										<!--end::Card-->
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
   
  




		<!--begin::Global Theme Bundle(used by all pages)-->
		<script src="external/plugins/global/plugins.bundle526f.js?v=7.0.8"></script>
		<script src="external/plugins/custom/prismjs/prismjs.bundle526f.js?v=7.0.8"></script>
		<script src="external/js/scripts.bundle526f.js?v=7.0.8"></script>
		<!--end::Global Theme Bundle-->
		<!--begin::Page Scripts(used by this page)-->
		<script src="external/js/pages/widgets526f.js?v=7.0.8"></script>
		<script src="external/js/pages/custom/profile/profile526f.js?v=7.0.8"></script>
        <!--end::Page Scripts-->

        <!--begin::Page Scripts(used by this page)-->
		<!--<script src="external/js/pages/custom/contacts/add-contact526f.js"></script>-->
        <!--end::Page Scripts-->
        

        <!--begin::Page Scripts(used by this page) for all form validation-->
	      	<script src="external/js/form-controlsForUploadResult526f.js"></script>
        <!--end::Page Scripts-->
        
        <!--begin::Page Scripts(used by this page) For input-masks(Date of Birth field)-->
        <script src="external/js/pages/crud/forms/widgets/input-mask526f.js?v=7.0.8"></script>
        <!--begin::Page Scripts(used by this page) For input-masks-->
        
        <!--script for state and LGA drop down list-->
        <script src="jsForStateDropList/lga.min.js"></script>
       <!--script for state and LGA drop down list-->

  </body>
</html>


<?php unset($_SESSION["classResultSession"]);?>
<?php unset($_SESSION["classResultClass"]);?>
<?php unset($_SESSION['classResultStudentID']);?>

<?php unset($_SESSION["studentResultSession"]);?>