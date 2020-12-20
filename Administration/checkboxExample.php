<?php
//database connection
$con = mysqli_connect('localhost','ResultChecker','ResultChecker') or die('cant connect');
//mysql_select_db('projectTest') or die('cant select'); PHP 5
mysqli_select_db($con, 'schoolresultchecker') or die(mysqli_error($con));

if(isset($_POST['save']))
{
   $checkbox = $_POST['check'];         
        for($i=0;$i<count($checkbox);$i++){
        $check_id = $checkbox[$i];
        mysqli_query($con,"insert into classes (className) values ('".$check_id."')") or die(mysqli_error());
            echo "Data added success fully!";
       }
}

$YY="IF  EXISTS (SELECT * FROM sys.columns 
WHERE OBJECT_ID = OBJECT_ID('tableName')
AND( Name = 'columnName1' OR Name = 'columnName2' OR Name = 'columnName3')
)
BEGIN
PRINT 'Your Columns Exist'
END " 





?>
    <!DOCTYPE html>
    <html>
    <head>
    </head>
    <body>
        <form method="post" action="">
        <input type="checkbox" id="checkItem" name="check[]" value="1">
        <input type="checkbox" id="checkItem" name="check[]" value="2">
        <input type="checkbox" id="checkItem" name="check[]" value="3">
        <input type="checkbox" id="checkItem" name="check[]" value="4">
        <button type="submit" class="btn btn-primary" style="width:200px" name="save">Submit</button>
        </form>
    </body>
    </html>
    