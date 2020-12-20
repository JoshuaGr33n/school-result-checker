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
// side bar and header
           include('include/privilege-restrictions.php');


?>



<?php if($studentManagement!="YES")
{
    header("Location: index.php" );
exit;
}
?>

<?php

$updateLink="";
$deleteLink="";
$addNewLink="";
$exportLink="";
$importLink="";
if($addEditStudentM=="YES" && $studentManagement=="YES")
{
 $updateLink='<li class="breadcrumb-item active"><button name="update" onClick="setUpdateAction();"  class="btn btn-sm btn-primary font-weight-bold py-2 px-3 px-xxl-5 my-1" style="margin-right:10px;">Update</button></li>';
 $deleteLink='<li class="breadcrumb-item active"><button name="delete" onClick="setDeleteAction();"  class="btn btn-sm btn-danger  font-weight-bold py-2 px-3 px-xxl-5 my-1" style="margin-right:10px;">Delete</button></li>';
 $addNewLink='<button type="button"  class="btn btn-sm btn-primary font-weight-bold py-2 px-3 px-xxl-5 my-1" style="margin-right:10px;" data-toggle="modal" data-target="#myModal">Add New Subject</button>';
 $exportLink='<li class="breadcrumb-item"> <form method="post" action="exports/all-subjects-export.php">
 <button name="export" class="btn btn-sm btn-primary font-weight-bold py-2 px-3 px-xxl-5 my-1" style="margin-right:10px;">Export in Excel</button>
 </form></li>';
 $importLink='<li class="breadcrumb-item"><a href="import-subjects.php" class="btn btn-sm btn-warning font-weight-bold py-2 px-3 px-xxl-5 my-1"  style="margin-right:10px;">Import</a></li>';
 }

?>

<?php

//output all from classes table


        ///$allSubjectsQuery = "SELECT StudentReg, class, SUM(Average) AS totalaverage FROM results where  school_session ='2019/2020' 
       // GROUP BY StudentReg   ORDER BY totalaverage DESC";
        //$allSubjectsResult = mysqli_query($con, $allSubjectsQuery);
	
?>



<?php

//output all from classes table


        $allSubjectsQuery = "SELECT StudentReg, class, Average AS subaverage, subject FROM results where  school_session ='2019/2020'  and   class ='SSS 1' and Term ='Second' and subject ='Geography' 
        GROUP BY StudentReg   ORDER BY subaverage DESC";
        $allSubjectsResult = mysqli_query($con, $allSubjectsQuery);
	
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
<?php// if(isset($_POST['subupdate']))
//{

    //$updateClass="Update classes set className ='".$_POST['fname']."'
    //where student_id='".$student_id."'";

//}
  ?> 
  <?php 

$insertQuery="";

if(isset($_POST['submit']))


{

  $addNew = $_POST['addNew'];




  $check = "SELECT * FROM subjects where subjectName = '".$addNew."'";
  $rs = mysqli_query($con, $check);
  //$data = mysqli_fetch_array($rs, MYSQLI_NUM);
  $num_rows =mysqli_num_rows($rs);
  $data=mysqli_fetch_array($rs);
  
  
  
  




  if( $addNew != $data['subjectName'])
  {
  $insertQuery = "INSERT INTO subjects (subjectName) VALUES
  ('".$addNew."')";
  }
  
    
  
 



  
 $insertResult ="";
  
 if($insertQuery)
 
 
 {
 
     $insertResult = mysqli_query($con, $insertQuery);

     
 }
 
 if( $insertResult)
   {
       
    
    header("Location:all-subjects.php" );
    exit;

   }
   else{

   
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
    <title>All Subjects</title>
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





    



<!--edit and delete form script-->

<script language="javascript" src="formjs/all-subjects.js" type="text/javascript"></script>
<!--edit and delete form script-->







<!--check all boxes script-->

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




<!--modal-->


  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<!--modal-->




      </head>
  <body class="app sidebar-mini">
    

          <?php 
// side bar and header
           include('include/nav_header.php');


        ?>


    <main class="app-content">
      <div class="app-title">
      <div>
          <h1><i class="fa fa-th-list"></i> All Subject</h1>
          <p></p>
        </div>


        <ul class="app-breadcrumb breadcrumb side">
          
          <?php echo  $exportLink;?>

         <?php echo $importLink;?>



          <!-- Trigger the modal with a button -->
           <?php echo $addNewLink;?>
           <!-- Trigger the modal with a button -->
           <!-- Modal -->
           <form method="post">
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add New Subjects</h4>
        </div>
        <div class="modal-body">
          <p>Subject Name</p>
          <p><input type="text" name="addNew"  class="form-control form-control-lg form-control-solid" value=""/></p>
          <p><input type="submit" name="submit" class="btn btn-primary " style="margin-left:25%; width:50%; margin-top:20px;" value="Submit"/></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</div>
  </form>
 <!-- Modal -->
          
        </ul>



      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">
              <div class="table-responsive">
              
              <form name="frmUser" method="post" action="">
                <table class="table table-bordered  table-striped" id="sampleTable" style="width:60%; margin-left:18%">
                
                  <thead>
                    <tr>
                      <th><input type="checkbox" id="selectall"/> Select all</th>
                      <th>Subject ID</th>
                      <th>Subject Name</th>
                      
                    </tr>
                  </thead>
                  <tbody>
                   <?php
                   while ($allSubjectsRow = mysqli_fetch_array($allSubjectsResult))
                   {
                   //output all from students table
                   
                   

                     if (isset($_POST['promote'])) { 





                        if ($allSubjectsRow['totalaverage'] >110){


                            if ( $allSubjectsRow['class']=="SSS 1"){



                                mysqli_query($con, "UPDATE students set Class='SSS 1' WHERE Class='SSS 3'");










                            }







                        }
















                     }




                        ?>
                    <tr>


                    <td><?php echo $allSubjectsRow['StudentReg']; ?></td>
                   
                      <td><?php echo $allSubjectsRow['subaverage']; ?></td>
                      <td><?php echo $allSubjectsRow['subject']; ?></td>
                      
                      

                      
                      
                    </tr>
                   <?php }?>

                   

                    
                    
                  </tbody>
                   
                </table>
                <tr>
                       
                    </tr>
                </form>
                <ul class="app-breadcrumb breadcrumb side">
          <!--<li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>-->
          <!--<li class="breadcrumb-item"></li>-->

          <form method="post">


          <input type="submit" value="promote"   name="promote"/>





          </form>







          <?php echo $updateLink;?>  
        <?php echo $deleteLink;?>
        </ul>
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
    
  </body>
</html>


<script src="js/classedit/bootstable.js"></script>
<script src="js/classedit/editable.js"></script>