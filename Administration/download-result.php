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
$currentPageTag="download result";


if($pageActiveTag3="Results"){

    $studentsExpand="";
    $ExpandAdmin="";
    $ExpandResults="is-expanded";
    $ExpandSiteManager="";
    $ExpandPinManager="";

    


}

if($currentPageTag="download result"){
  $allPinCurrentPageTag="";
  $pinGeneratorCurrentPageTag="";
  $resultPageManagerCurrentPageTag="";
  $frontPageManagerCurrentPageTag="";
  $downloadResultClassCurrentPageTag="active";
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
$err="";

if(isset($_POST['search']))
{

    
	
	
	
	
	
	$query1 = "SELECT * FROM registered_subjects where subjectName ='".$_POST['subject']."' and current_class ='".$_POST['class']."'";
	$query = mysqli_query($con, $query1);
  $result = mysqli_num_rows($query);
if($result == 0)
{
	
	$err = '<div class="btn btn-light-danger font-weight-bold">No Registered Students for this</div>';
}
while($c = mysqli_fetch_array( $query ))
{
	$_SESSION['regSubject'] = $c['subjectName'];
   
    $_SESSION['regClass'] = $c['current_class'];
   
    $_SESSION['RregNum'] = $c['StudentID'];

    
    

    


        header("Location: download-result-suc.php");
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
    <title>Download Result Template</title>
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
          <h1><i class="fa fa-th-list"></i> Download in Editable Format</h1>
          <p></p>
        </div>
        <ul class="app-breadcrumb breadcrumb side">
          <!--<li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>-->
          <!--<li class="breadcrumb-item"></li>-->
          <li><a href="search-results.php" class="btn btn-success font-weight-bold py-2 px-3 px-xxl-5 my-1" style="margin-right:10px;">Search Results</a></li>
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
														<label class="col-form-label text-right col-lg-3 col-sm-12">Subject *</label>
														<div class="col-lg-9 col-md-9 col-sm-12">
															<select  class="form-control form-control-lg form-control-solid" name="subject">
                                            <option value="">Select</option>
                                              <?php   $subject_query = $con->prepare("SELECT  subjectName FROM subjects");
                                                      $subject_query->execute(); 
                                                      $subject_query->Store_result();                      
                                                      $subject_query->bind_result($subject_name); 
                                                      while ($subject_query->fetch())
                                                      {
                                                    ?>
                                                                  
                                                                  
                                                                  
                                                

                                                                
																<option value="<?php echo $subject_name;?>"><?php echo $subject_name;?></option>
																<?php }?>
																
															</select>
															<span class="form-text text-muted">Select an option.</span>
														</div>
                                                    </div>
                                                    
                                                        



                                                    <div class="form-group row">
														<label class="col-form-label text-right col-lg-3 col-sm-12">Class *</label>
														<div class="col-lg-9 col-md-9 col-sm-12">
															<select  class="form-control form-control-lg form-control-solid" name="class">
                                      <option value="">Select</option>
                                        <?php   
                                          $class_query = $con->prepare("SELECT  className FROM classes WHERE className NOT IN('GRADUATED STUDENT')");
                                          $class_query->execute(); 
                                          $class_query->Store_result();                      
                                          $class_query->bind_result($class_name); 
                                          while ($class_query->fetch())
                                          {
                                             ?>
                                                                  
                                                                  
                                                                  
                                                

                                                                
																<option value="<?php echo $class_name;?>"><?php echo $class_name;?></option>
																<?php }?>
															</select>
															<span class="form-text text-muted">Select an option.</span>
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




<!--begin::Global Config(global config for global JS scripts)-->
<script>var KTAppSettings = { "breakpoints": { "sm": 576, "md": 768, "lg": 992, "xl": 1200, "xxl": 1400 }, "colors": { "theme": { "base": { "white": "#ffffff", "primary": "#3699FF", "secondary": "#E5EAEE", "success": "#1BC5BD", "info": "#8950FC", "warning": "#FFA800", "danger": "#F64E60", "light": "#E4E6EF", "dark": "#181C32" }, "light": { "white": "#ffffff", "primary": "#E1F0FF", "secondary": "#EBEDF3", "success": "#C9F7F5", "info": "#EEE5FF", "warning": "#FFF4DE", "danger": "#FFE2E5", "light": "#F3F6F9", "dark": "#D6D6E0" }, "inverse": { "white": "#ffffff", "primary": "#ffffff", "secondary": "#3F4254", "success": "#ffffff", "info": "#ffffff", "warning": "#ffffff", "danger": "#ffffff", "light": "#464E5F", "dark": "#ffffff" } }, "gray": { "gray-100": "#F3F6F9", "gray-200": "#EBEDF3", "gray-300": "#E4E6EF", "gray-400": "#D1D3E0", "gray-500": "#B5B5C3", "gray-600": "#7E8299", "gray-700": "#5E6278", "gray-800": "#3F4254", "gray-900": "#181C32" } }, "font-family": "Poppins" };</script>
		<!--end::Global Config-->
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

<?php unset($_SESSION['regSubject']);?>

<?php unset($_SESSION['regClass']);?>
