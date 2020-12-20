<?php
//database connection
$conn = mysqli_connect('localhost','ResultChecker','ResultChecker') or die('cant connect');
//mysql_select_db('projectTest') or die('cant select'); PHP 5
mysqli_select_db($conn, 'schoolresultchecker') or die(mysqli_error($conn));
if(isset($_POST["Import"])){


    



    $subject = $_POST['subject'];
    $class = $_POST['class'];
    $session = $_POST['session'];
    $term = $_POST['term'];
    $publish = $_POST['publish'];
    $uploaded_by = $_POST['uploadedby'];
		

		echo $filename=$_FILES["file"]["tmp_name"];
		

		 if($_FILES["file"]["size"] > 0)
		 {

			$flag = true;

		  	$file = fopen($filename, "r");
	         while (($emapData = fgetcsv($file, 10000, ",")) !== FALSE)
	         {

                if($flag) { $flag = false; continue; }





    $total = ((int)$emapData[7]+(int)$emapData[8]+(int)$emapData[9]+(int)$emapData[10]);
    $average= $total/4;


    if ($total<= 100 && $total>= 70 ) {

        $grade="A";
        
        }
        
        

    else  if ($total < 70 && $total>= 60 ) {

            $grade="B";
            
            }



     else  if ($total < 60 && $total>= 50 ) {

     $grade="C";
                
                }
            

    else  if ($total < 50 && $total>= 45 ) {

     $grade="D";
                               
        }
                                 
    else  if ($total < 45 && $total >= 39 ) {

    $grade="E";
                
                }

    else  if ($total<= 39 ) {

     $grade="F";
                               
             }


if($grade=="A")

{

$remark="Excellent";

}

else if($grade=="B")

{

$remark="Good";

}



else if($grade=="C")

{

$remark="Credit";

}


else if($grade=="D")

{

$remark="Pass";

}

else if($grade=="E")

{

$remark="Fair";

}

else if($grade=="F")

{

$remark="Fail";

}
                









	    
	          //It wiil insert a row to our subject table from our csv file`
	           $sql = "INSERT into results (`StudentID`, `subjectID`, `CA1`, `CA2`,`CA3`,`Exam`, `subject`, `school_session`,`Term`, `class`,`Total`, `Average`,`Grade`,`Remark`, `Teacher`,`Publish`) 
	            	values('$emapData[0]','$emapData[4]','$emapData[7]','$emapData[8]','$emapData[9]','$emapData[10]','$subject','$session','$term', '$class','$total','$average', '$remark','$uploaded_by','$publish')";
	         //we are using mysql_query function. it returns a resource on true else False on error
	          $result = mysqli_query( $conn, $sql );
				if(! $result )
				{
					echo "<script type=\"text/javascript\">
							alert(\"Invalid File:Please Upload CSV File.\");
							window.location = \"import-result.php\"
						</script>";
				
				}

	         }
	         fclose($file);
	         //throws a message if data successfully imported to mysql database from excel file
	         echo "<script type=\"text/javascript\">
						alert(\"CSV File has been successfully Imported.\");
						window.location = \"import-result.php\"
					</script>";
	        
			 

			 //close of connection
			mysqli_close($conn); 
				
		 	
			
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
    <title>Import Result</title>
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
           //include('include/nav_header.php');


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
                      <th>Student Reg Number</th>
                      <th>Class</th>
                      <th>Term</th>
                      <th>Session</th>
                      <th>CA 1</th>
                      
                     
                    </tr>
                  </thead>
<?php
	$SQLSELECT = "SELECT * FROM results where subject='".$subject."' and Term ='".$term."'and school_session ='".$session."'and class ='".$class."' ";
	$result_set =  mysqli_query( $conn, $SQLSELECT);
	while($outRow = mysqli_fetch_array($result_set))
	{
	?>

		<tr>
                     <td><a href="student-details.php?studentID=<?php //echo $student_id;?>" style="text-decoration:none"><?php// echo $student_id;?></a></td>
                      <td><?php echo $outRow['class'];;?></td>
                      <td><?php echo $outRow['Term'];?></td>
                      <td><?php echo $outRow['school_session'];?></td>
                      <td><?php echo $outRow['CA1'];?></td>
		

		</tr>
	<?php
	}
?>
</table>









              </div>
            </div>
          </div>
        </div>
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

     <!--begin::Global Theme Bundle(used by all pages)-->
     <script src="external/plugins/global/plugins.bundle526f.js?v=7.0.8"></script>
       
       <script src="external/plugins/custom/prismjs/prismjs.bundle526f.js?v=7.0.8"></script>
       <script src="external/js/scripts.bundle526f.js?v=7.0.8"></script>
       
       <!--end::Global Theme Bundle-->
       



<!--begin::Page Vendors(used by this page)-->
<script src="external/plugins/custom/datatables/datatables.bundle526f.js?v=7.0.8"></script>
<!--end::Page Vendors-->
<!--begin::Page Scripts(used by this page)-->
<script src="external/js/pages/crud/datatables/extensions/buttons526f.js?v=7.0.8"></script>
<!--end::Page Scripts-->
  </body>
</html>