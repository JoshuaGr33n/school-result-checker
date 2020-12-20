<?php session_start();?>

<?php
if( $_SESSION['Adminusername'] =="")
{
header("Location: ../index.php" );
exit;
}

if( $_SESSION['regSubject'] =="")
{
header("Location: ../download-result.php" );
exit;
}

?>
<?php  
include('../include/db.php');
include('../include/grading.php');
?>

<?php
$input = filter_input_array(INPUT_POST);

$ca1 = mysqli_real_escape_string($con, $input["ca1"]);
$ca2 = mysqli_real_escape_string($con, $input["ca2"]);
$ca3 = mysqli_real_escape_string($con, $input["ca3"]);
$exam = mysqli_real_escape_string($con, $input["exam"]);
$reg_num = mysqli_real_escape_string($con, $input["reg"]);


$total=$ca1+$ca2+$ca3+$exam;
$average=$total/4;
$average=number_format($average, 2);

$student_id_query= $con->prepare("SELECT student_id FROM students  WHERE RegNum = '$reg_num' ");
$student_id_query->execute();                          
$student_id_query->Store_result();                      
$student_id_query->bind_result($student_id);  
$student_id_query->fetch();
$student_id_query->close();

$subject_query= $con->prepare("SELECT subjectID FROM subjects  WHERE subjectName = '$_SESSION[regSubject]' ");
$subject_query->execute();                          
$subject_query->Store_result();                      
$subject_query->bind_result($subjectID);  
$subject_query->fetch();
$subject_query->close();



$current_term_query= $con->prepare("SELECT Term FROM term WHERE Status= 'Current' ");
$current_term_query->execute();                          
$current_term_query->Store_result();                      
$current_term_query->bind_result($current_term);  
$current_term_query->fetch();
$current_term_query->close();




   

$current_session_query= $con->prepare("SELECT sessionName FROM school_session WHERE Status= 'Current' ");
$current_session_query->execute();                          
$current_session_query->Store_result();                      
$current_session_query->bind_result($current_session);  
$current_session_query->fetch();
$current_session_query->close();

























  

$check_num_rows = $con->prepare("SELECT StudentID, StudentReg, subject, subjectID, school_session, class, Term FROM  `results` WHERE StudentID='$student_id' AND StudentReg='$reg_num'AND subject='$_SESSION[regSubject]' AND subjectID='$subjectID' AND school_session='$current_session' AND Term='$current_term' AND class='$_SESSION[regClass]' ");
$check_num_rows->execute();                           
$check_num_rows->Store_result();

$count = $check_num_rows->num_rows;

$sch_grade=get_grade($total);

if($input["id"] =="")
{
   
        $insert_query = $con->prepare("INSERT INTO `results`(`Sno`, `StudentID`, `StudentReg`, `subject`, `subjectID`, `school_session`, `Term`, `class`, `CA1`, `CA2`, `CA3`, `Exam`, `Total`, `Average`, `Grade`, `Remark`, `Teacher`, `Publish`, `Promotion_Status` ) VALUES (NULL, '$student_id','$reg_num','$_SESSION[regSubject]','$subjectID','$current_session','$current_term','$_SESSION[regClass]','$ca1','$ca2','$ca3','$exam','$total','$average','$sch_grade[grade]','$sch_grade[remark]',' ','Yes',' ') ");
    
    if($count < 1){

    if($ca1<=20 && $ca2<=10 && $ca3<=10 && $exam<=60){ 

        $insert_query->execute(); 
           }
       } 
   
}

else if($input["action"] === 'edit')
{
    $sql="UPDATE results 
    SET 
    CA1 = '".$ca1."', 
    CA2 = '".$ca2."' , 
    CA3 = '".$ca3."' ,
    Exam = '".$exam."',
    Total = '".$total."',
    Average = '".$average."',
    Grade = '".$sch_grade['grade']."',
    Remark = '".$sch_grade['remark']."'
    
    WHERE Sno = '".$input["id"]."'";


    $updateQuery = $con->prepare($sql); 
     
     
    
   
   
 if($ca1<=20 && $ca2<=10 && $ca3<=10 && $exam<=60){ 
     $updateQuery->execute(); 
}

 

}
if($input["action"] === 'delete')
{
 $query = "
 DELETE FROM results 
 WHERE Sno = '".$input["id"]."'
 ";

 $deleteQuery = $con->prepare($query);
 $deleteQuery->execute();
}

echo json_encode($input);


?>