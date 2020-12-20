<?php

//database connection
$con = mysqli_connect('localhost','ResultChecker','ResultChecker') or die('cant connect');
//mysql_select_db('projectTest') or die('cant select'); PHP 5
mysqli_select_db($con, 'schoolresultchecker') or die(mysqli_error($con));






function get_grade($total){
    if($total >= 70){
        return array("grade" => "A", "remark" => "Excellent");
    }else if($total >= 60){
        return array("grade" => "B", "remark" => "Very Good");
    }else if($total >= 50){
        return array("grade" => "C", "remark" => "Credit");
    }else if($total >= 45){
        return array("grade" => "D", "remark" => "Pass");
    }else if($total >= 39){
      return array("grade" => "E", "remark" => "Poor");
    }else if($total < 38){
      return array("grade" => "F", "remark" => "Fail");
    }
  
  } 
?>







<!--favicon-->
<?php
  



 $faviconQuery = "SELECT * FROM sitemanager where tag='favicon'";
 $faviconResult = mysqli_query($con, $faviconQuery);

$row = mysqli_fetch_array($faviconResult);
$favicon = $row['Content'];
?>

<link rel="icon" type="image/png" href="../images/<?php echo $favicon;?>" sizes="16x16">
<link rel="icon" type="image/png" href="../../images/<?php echo $favicon;?>" sizes="16x16">

<!--favicon-->