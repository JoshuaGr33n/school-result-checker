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

//output all from admin table
        $allAdminQuery = "SELECT * FROM administration";
        $allAdminResult = mysqli_query($con,  $allAdminQuery);
?>
<?php

//output all from students table
        $allClassesQuery = "SELECT * FROM classes";
        $allClassesResult = mysqli_query($con, $allClassesQuery);
?>

<?php

//output all from subjects table
        $allSubjectQuery = "SELECT * FROM subjects";
        $allSubjectResult = mysqli_query($con, $allSubjectQuery);
?>

<?php

//output all from session table
        $allSessionQuery = "SELECT * FROM school_session";
        $allSessionResult = mysqli_query($con, $allSessionQuery);
?>


<?php
use Phppot\DataSource;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

require_once 'resultupload/DataSource.php';
$db = new DataSource();
$con = $db->getConnection();
require_once ('resultupload/vendor/autoload.php');
$numErr="";
if (isset($_POST['import'])) {
    

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
            $regnum = "";
            if (isset($spreadSheetAry[$i][0])) {
                $regnum = mysqli_real_escape_string($con, $spreadSheetAry[$i][0]);
            }

            $subjectID = "";
            if (isset($spreadSheetAry[$i][4])) {
                $subjectID = mysqli_real_escape_string($con, $spreadSheetAry[$i][4]);
            }
            
            $CA1 = "";
            if (isset($spreadSheetAry[$i][7])) {
                $CA1 = mysqli_real_escape_string($con, $spreadSheetAry[$i][7]);
            }
            $CA2 = "";
            if (isset($spreadSheetAry[$i][8])) {
                $CA2 = mysqli_real_escape_string($con, $spreadSheetAry[$i][8]);
            }
            $CA3 = "";
            if (isset($spreadSheetAry[$i][9])) {
                $CA3 = mysqli_real_escape_string($con, $spreadSheetAry[$i][9]);
            }
            $exam = "";
            if (isset($spreadSheetAry[$i][10])) {
                $exam = mysqli_real_escape_string($con, $spreadSheetAry[$i][10]);
            }
    $subject = $_POST['subject'];
    $class = $_POST['class'];
    $session = $_POST['session'];
    $term = $_POST['term'];
    $publish = $_POST['publish'];
    $uploaded_by = $_POST['uploadedby'];
    //$subjectID = $_POST['subjectID'];



 
       
            

             //$plus= +;
            $space=" ";
            $total = ((int)$CA1+(int)$CA2+(int)$CA3+(int)$exam);
            $average= $total/4;

            $teacher= $uploaded_by;

            if (! is_numeric($CA1)) { 
                
                
                $numErr="Not Number";
             }

             if (! is_numeric($CA2)) { 
                
                
                $numErr="Not Number";
             }

             if (! is_numeric($CA3)) { 
                
                
                $numErr="Not Number";
             }

                  



            


             

           

            if (! empty($regnum) || ! empty($subjectID)|| ! empty($CA1)||! empty($CA2) || ! empty($CA3)|| ! empty($exam) &&  is_numeric($CA1)&&  is_numeric($CA2)&&  is_numeric($CA3)&&  mysqli_num_rows($results) <1) {
                $query = "insert into results(StudentID,subject,subjectID,school_session,term,class,CA1,CA2,CA3,Exam,Total,Average,Grade,Teacher,Publish) 
                                      values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
                $paramType = "sssssssssssssss";
                $paramArray = array(
                    $regnum,
                    $subject,
                    $subjectID,
                    $session,
                    $term,
                    $class,
                    $CA1,
                    $CA2,
                    $CA3,
                    $exam,
                    $total,
                    $average,
                    "A",
                    $teacher,
                    $publish
                );
                $insertId = $db->insert($query, $paramType, $paramArray);
                // $query = "insert into tbl_info(name,description) values('" . $name . "','" . $description . "')";
                // $result = mysqli_query($con, $query);

                if (! empty($insertId)) {
                   //output  uploaded result
        $outQuery = "SELECT * FROM results where subject='".$subject."' and subjectID ='".$subjectID."'and Term ='".$term."'and school_session ='".$session."'and class ='".$class."'";
        $outResult = mysqli_query($con, $outQuery);
                    
                    
                    
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