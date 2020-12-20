<?php session_start();?>
<?php
include('administration/include/db.php');

$studentLoginLinkQuery = "SELECT * FROM sitemanager where tag='Student_Login'";
 $studentLoginLinkResult = mysqli_query($con, $studentLoginLinkQuery);

 $studentLoginLinkRow = mysqli_fetch_array($studentLoginLinkResult);
 $studentLoginLinkStatus = $studentLoginLinkRow['Content'];

if ($studentLoginLinkStatus!="Activated"){
       
	header("Location: index.php" );
    exit;   

}



$err1="";
$err3="";




if(isset($_POST['login']))
{
    $updateQuery="";
    $ID = $_POST['ID'];
    $password = $_POST['password'];
    
    
	
	
	








$check = "SELECT * FROM students where RegNum = '".$ID."'";
$rs = mysqli_query($con, $check);
//$data = mysqli_fetch_array($rs, MYSQLI_NUM);
$num_rows =mysqli_num_rows($rs);
$data=mysqli_fetch_array($rs);

$IDupperCase=strtoupper($ID);

//checking if students info truly exist
if($IDupperCase != $data['RegNum'])
   {
	 $err1= " <p>Registration Number does not exist</p>";
	
	


   }


   





                                





















    

    $query1 = "SELECT * FROM students where RegNum ='".$ID."' and LastName ='".$password."'";


	
    
    
    $query = mysqli_query($con, $query1);
     $result = mysqli_num_rows($query);
       if($result == 0)
{
	
$err3 =" <p>ERROR!!</p>";


}

//if login is successful start a session
while($c = mysqli_fetch_array( $query ))
{
    $_SESSION['studentLoginName'] = $c['FirstName'];
    $_SESSION['studentLoginMName'] = $c['MiddleName'];
    $_SESSION['studentLoginLName'] = $c['LastName'];
    $_SESSION['studentLoginclass']= $c['Class'];
    $_SESSION['studentLoginschool_session'] = $c['Session'];
    $_SESSION['studentLoginterm'] = $c['Term'];
    $_SESSION['studentLoginSHouse'] = $c['SportHouse'];
    $_SESSION['studentLoginProfilePic'] = $c['ProfilePic'];
    $_SESSION['studentLogingender'] = $c['Gender'];
	$_SESSION['studentLoginDOB'] = $c['DOB'];
	$_SESSION['studentLoginstudentID'] = $c['student_id'];
	$_SESSION['studentLoginStatus'] = $c['status'];
    $_SESSION['studentLoginRegNum'] = $c['RegNum'];




    
	
	

	
    
	 

	header("Location: upload-passport.php");
	exit;

	
	

	






}

}











?>







<?php
  



 $frontpageQuery = "SELECT * FROM sitemanager where tag='Heading'";
 $frontpageResult = mysqli_query($con, $frontpageQuery);

$row = mysqli_fetch_array($frontpageResult);
$heading = $row['Content'];
?>



<?php
  



 $frontpageQuery = "SELECT * FROM sitemanager where tag='Annoucement'";
 $frontpageResult = mysqli_query($con, $frontpageQuery);

$row = mysqli_fetch_array($frontpageResult);
$annoucement = $row['Content'];
?>

<?php
  



 $frontpageQuery = "SELECT * FROM sitemanager where tag='Front_Page_Background'";
 $frontpageResult = mysqli_query($con, $frontpageQuery);

$row = mysqli_fetch_array($frontpageResult);
$bg = $row['Content'];
?>

<?php
  



 $faviconQuery = "SELECT * FROM sitemanager where tag='favicon'";
 $faviconResult = mysqli_query($con, $faviconQuery);

$row = mysqli_fetch_array($faviconResult);
$favicon = $row['Content'];
?>


<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from demo.w3layouts.com/demos_new/template_demo/15-12-2017/course_register_form-demo_Free/1876413846/web/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 31 Aug 2020 19:34:07 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>
<title>Student Login</title>
<!-- custom-theme -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
		function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- //custom-theme -->
<!-- css files -->
<link href="http://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&amp;subset=devanagari,latin-ext" rel="stylesheet">
<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&amp;subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese" rel="stylesheet">
<link href="css/style.css" type="text/css" rel="stylesheet" media="all">  
<link rel="stylesheet" type="text/css" href="css/style.php" /> 
<!-- //css files -->

<link rel="stylesheet" href="css/font-awesome.css"> <!-- Font-Awesome-Icons-CSS -->


<link rel="icon" type="image/png" href="images/<?php echo $favicon;?>" sizes="16x16">

</head>
<!-- body starts -->
<body style=" background: url(images/<?php echo $bg;?>);  padding: 3em 0;
   
   background-attachment:fixed;
   background-size:cover;">
<script src='../../../../../../../ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js'></script><script src="../../../../../../../m.servedby-buysellads.com/monetization.js" type="text/javascript"></script>



<!-- section -->
<section class="register">
	<div class="register-full">
		<div class="register-left">
			<div class="register">
				<div class="logo">
					<a href="#"><span class="fa fa-graduation-cap" aria-hidden="true"></span></a>
				</div>
				<h1><?php echo $heading;?></h1>
				<p><?php echo $annoucement;?></p>
				<div class="content3">
					<!--<ul>
						<li><a class="" href="#"> Know More</a></li>
						<li><a class="read" href="#"> Get Started</a></li>
					</ul>-->
				</div>
			</div>
		</div>
		<div class="register-right">
			<div class="register-in">
				<h2><span class="fa fa-pencil"></span> Student Login</h2>
				<div class="register-form">
					<form action="#" method="post">
						<div class="fields-grid">
							<div class="styled-input agile-styled-input-top">
								<input type="text" name="ID" required value=""/> 
								<label>Student Registration Number*</label>
								<span></span>
							</div>
							<div class="styled-input">
								<input type="password" name="password" required />
								<label>Password*</label>
								<span></span>
							</div>
                            





							
						<input type="submit" value="login" name="login">
					</form>
					
				</div>
				
			</div>
			
			<div class="clear"> </div>
			<span style="color:#fff"><?php echo $err3;?></span><br/>
			<span style="color:#fff"><?php echo $err1;?></span>
			<span style="color:#fff"></span>

			


			 

			 
		

			

			
		</div>
		
		
	
	</div>

    <div class="clear"> </div>
	

	<div style="color:#FFF; margin-top:30px; margin-left:60%"><a href="index.php" style="color:#FFF;">Back</div></a>

	
	<!---728x90--->
	<!-- copyright -->
	
	<!-- //copyright -->
	<!---728x90--->
</section>
<!-- //section -->
</body>	
<!-- //body ends -->

<!-- Mirrored from demo.w3layouts.com/demos_new/template_demo/15-12-2017/course_register_form-demo_Free/1876413846/web/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 31 Aug 2020 19:34:13 GMT -->
</html>








<?php unset($_SESSION['studentLoginstudentID']);?>
<?php unset($_SESSION['studentID']);?>