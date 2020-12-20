<?php session_start();?>
<?php 
//database connection
include('include/db.php');





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

//If a link in the nav bar is active


$pageActiveTag="All Students";

$dashboardActiveTag="";
$studentsActiveTag="";

if($pageActiveTag=="All Students"){

     $studentsActiveTag="active";


}

if($pageActiveTag=="Dashboard"){

    $dashboardActiveTag="active";


}






?>
<?php





use Phppot\DataSource;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

require_once 'resultupload/DataSource.php';
$db = new DataSource();
$con = $db->getConnection();
require_once ('resultupload/vendor/autoload.php');
$numErr="";
if (isset($_POST['upload'])) {
    

    $allowedFileType = [
        'application/vnd.ms-excel',
        'text/xls',
        'text/xlsx',
        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
    ];

    if (in_array($_FILES["file"]["type"], $allowedFileType)) {

        $targetPath = 'resultupload/uploads/' . $_FILES['file']['name'];
        move_uploaded_file($_FILES['file']['tmp_name'], $targetPath);

        $Reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();

        $spreadSheet = $Reader->load($targetPath);
        $excelSheet = $spreadSheet->getActiveSheet();
        $spreadSheetAry = $excelSheet->toArray();
        $sheetCount = count($spreadSheetAry);

        for ($i = 1; $i <= $sheetCount; $i ++) {
            $pinSerial = "";
            if (isset($spreadSheetAry[$i][0])) {
                $pinSerial = mysqli_real_escape_string($con, $spreadSheetAry[$i][0]);
            }

            $pinCode = "";
            if (isset($spreadSheetAry[$i][1])) {
                $pinCode = mysqli_real_escape_string($con, $spreadSheetAry[$i][1]);
            }
            
            
   



 
       
            

           

            if (! is_numeric($pinSerial)) { 
                
                
                $numErr="Not Number";
             }

             if (! is_numeric($pinCode)) { 
                
                
                $numErr="Not Number";
             }

            

                  



             
             $pinResult="";


             

           

            if (! empty($pinSerial) || ! empty($pinCode)) {
                $query = "insert into pinlogin( PinCode, PinSerial, StudentID, Class, Session, Term, LoginCount) 
                                      values(?,?,?,?,?,?,?)";
                $paramType = "sssssss";
                $paramArray = array(
                    $pinCode,
                    $pinSerial,
                    '',
                    '',
                    '',
                    '',
                    ''
                );
                $insertId = $db->insert($query, $paramType, $paramArray);
                // $query = "insert into tbl_info(name,description) values('" . $name . "','" . $description . "')";
                // $result = mysqli_query($con, $query);

                if (! empty($insertId)) {

                    
                   //output  uploaded pin
        $pinQuery = "SELECT * FROM pinlogin";
        $pinResult = mysqli_query($con, $pinQuery);
        //$pinResult = mysqli_query($db, $sql) or die( mysqli_error($db));
                    
                    
                    
                } else {
                    
                    $type = "error";
                    $message = " <div class='btn btn-light-danger font-weight-bold'>Problem in Importing Excel Data</div>";
                }
            }
        }
    } else {
        $type = "error";
        $message = "<div class='btn btn-light-danger font-weight-bold'>Invalid File Type. Upload Excel File.</div>";
    }
}
?>



<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="description" content="Vali is a responsive and free admin theme built with Bootstrap 4, SASS and PUG.js. It's fully customizable and modular.">
    <!-- Twitter meta-->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:site" content="@pratikborsadiya">
    <meta property="twitter:creator" content="@pratikborsadiya">
    <!-- Open Graph Meta-->
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Vali Admin">
    <meta property="og:title" content="Vali - Free Bootstrap 4 admin theme">
    <meta property="og:url" content="http://pratikborsadiya.in/blog/vali-admin">
    <meta property="og:image" content="http://pratikborsadiya.in/blog/vali-admin/hero-social.png">
    <meta property="og:description" content="Vali is a responsive and free admin theme built with Bootstrap 4, SASS and PUG.js. It's fully customizable and modular.">
    <title>Vali Admin - Free Bootstrap 4 Admin Template</title>
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
          <h1><i class="fa fa-th-list"></i>Upload Results</h1>
          <p></p>
        </div>
        <ul class="app-breadcrumb breadcrumb side">
          <!--<li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>-->
          <!--<li class="breadcrumb-item"></li>-->
         <!-- <li><a href="view-results.php" class="btn btn-success font-weight-bold py-2 px-3 px-xxl-5 my-1" style="margin-right:10px;">View Results</a></li>-->
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">
              <div class="table-responsive">
                <table class="table table-hover table-bordered" id="sampleTable">
                
                  <thead>
                    <tr>
                      <th>Pin</th>
                      
                     
                    </tr>
                  </thead>
                  <tbody>
                   <?php
                   while($pinRow = mysqli_fetch_array($pinResult))
                   {
                   //output all from the pin table
                    $pinC = $pinRow['PinCode']; 

                  
                  
                   
                  

                   
                   
                   
                   
                   
            
                   
                   			
                   
                     ?>
                    <tr>
                      
                      <td><?php echo $pinRow['PinCode'];?></td>
                      
                      
                     
                    </tr>
                   <?php }?>

                   

                    
                    
                  </tbody>
                   
                </table>
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


