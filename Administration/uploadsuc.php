<?php session_start();?>
<?php
if( $_SESSION['Adminusername'] =="")
{
header("Location: index.php" );
exit;
}


//database connection
include('include/db.php');



//fetch details from privileges table
$fetchPrivilegesQuery = "SELECT * FROM privileges where AdminUsername = '".$_SESSION['Adminusername']."'";
$fetchPrivilegesResult = mysqli_query($con, $fetchPrivilegesQuery);

// Loop through each row, outputting the login and password


while ($privilegesRow = @mysqli_fetch_assoc($fetchPrivilegesResult))
{
$studentManagement = $privilegesRow['StudentManagement'];
$adminManagement = $privilegesRow['AdminManagement'];
$siteManagement = $privilegesRow['siteManagement'];
$pinManagement = $privilegesRow['PinManagement'];



}


$manageStudentLink="";
$manageAdminLink="";
$managePinLink="";
$manageSiteLink="";
    
    

if($studentManagement!="YES")
{
    header("Location: index.php" );
exit;
}





if( $_SESSION['status'] =="Super Administrator")
{
    $manageStudentLink='<li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-laptop"></i><span class="app-menu__label">Manage Students</span><i class="treeview-indicator fa fa-angle-right"></i></a>';
    $manageAdminLink='<li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-edit"></i><span class="app-menu__label">Manage Admins</span><i class="treeview-indicator fa fa-angle-right"></i></a>';
    $managePinLink='<li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-file-text"></i><span class="app-menu__label">Pin Management</span><i class="treeview-indicator fa fa-angle-right"></i></a>';
    $manageSiteLink='<li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-file-text"></i><span class="app-menu__label">Site Management</span><i class="treeview-indicator fa fa-angle-right"></i></a>';



    $studentManagement="";
    $adminManagement="";
    $pinManagement="";
    $siteManagement="";
}


if($studentManagement=="YES")
{
    $manageStudentLink='<li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-laptop"></i><span class="app-menu__label">Manage Students</span><i class="treeview-indicator fa fa-angle-right"></i></a>';
}



if($adminManagement=="YES")
{
    $manageAdminLink='<li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-edit"></i><span class="app-menu__label">Manage Admins</span><i class="treeview-indicator fa fa-angle-right"></i></a>';
}


if($siteManagement=="YES")
{
    $manageSiteLink='<li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-file-text"></i><span class="app-menu__label">Site Management</span><i class="treeview-indicator fa fa-angle-right"></i></a>';
}



if($pinManagement=="YES")
{
    $managePinLink= '<li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-file-text"></i><span class="app-menu__label">Pin Management</span><i class="treeview-indicator fa fa-angle-right"></i></a>';
}




?>



<?php

//output all from students table
        $allStudentQuery = "SELECT * FROM students";
        $allStudentResult = mysqli_query($con, $allStudentQuery);
	
	




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
    <title>Import Results</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--begin::Global Theme Styles(used by all pages)-->
    
		<link href="other.css?v=7.0.8" rel="stylesheet" type="text/css" />
		<!--end::Global Theme Styles-->



    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <!-- Main CSS-->


    
		
    


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
          <h1><i class="fa fa-th-list"></i> All Students </h1>
          <p></p>
        </div>
        <ul class="app-breadcrumb breadcrumb side">
          <!--<li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>-->
          <!--<li class="breadcrumb-item"></li>-->
          <li class="breadcrumb-item active"><a href="add-new-student.php" class="btn btn-sm btn-primary font-weight-bold py-2 px-3 px-xxl-5 my-1" style="margin-right:10px;">Add New Student +</a></li>
        </ul>
      </div>
      <div class="row">
        SUCCESS
      </div>
    </main>
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


<?php
unset($_SESSION["insertFirstname"]);
unset($_SESSION["insertLastname"]);
unset($_SESSION["insertGender"]);
unset($_SESSION["insertAddress"]);
unset($_SESSION["insertDOB"]);
unset($_SESSION["insertGender"]);
unset($_SESSION["insertState"]);
unset($_SESSION["insertLGA"]);
unset($_SESSION["insertGender"]);
unset($_SESSION["insertClass"]);
unset($_SESSION["insertSession"]);
unset($_SESSION["insertTerm"]);
?>