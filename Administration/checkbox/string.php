<?php

//database connection
$con = mysqli_connect('localhost','ResultChecker','ResultChecker') or die('cant connect');
//mysql_select_db('projectTest') or die('cant select'); PHP 5
mysqli_select_db($con, 'schoolresultchecker') or die(mysqli_error($con));


?>

<?php 

$myStr="SSS 1A";
// singlebyte strings
$result = substr($myStr, 0, 3);
// multibyte strings
//$result = mb_substr($myStr, 0, 5);


//echo $result;

if($result=="JSS")
{
//echo $result="Junior";

}

else if ($result=="SSS"){

//echo $result="Senior";

}
?>






<div style="height:100px"></div>

<?php
//ranking system:same score, same rank but eg:32-1st, 32-1st and then skips to 33-3rd instead of 2nd.
$avg = $con->query("SELECT  * FROM `results` WHERE school_session='2019/2020' AND Term='Second' AND class='SSS 1' AND  subjectID='4' Order by Average DESC ");
$counter = 1; // init absolute counter
$rank = 1; // init rank counter

// initial "previous" score:
$prevScore = 0;
while ($go = mysqli_fetch_array($avg))
{
    // get "current" score
    $score = $go['Average'];
    $id = $go['StudentID'];

    if ($prevScore != $score) // if previous & current scores differ
        $rank = $counter;
    // else //same // do nothing

    echo "Rank: {$rank}, Score: {$score}, ID: {$id} <br>";
    $counter ++; // always increment absolute counter

    //current score becomes previous score for next loop iteration
    $prevScore = $score;
}

?>





<div style="height:100px"></div>



<?php
//Prepare Statement method :: ranking system:same score, same rank but eg:32-1st, 32-1st and then skips to 33-3rd instead of 2nd.
$session   = '2019/2020';
$term      = 'Second';
$class     = 'SSS 1';
$subjectID = '1';
// SQL query to SELECT "Average" and "StudentReg" from "results"
// ?s are a place holder for values we'll bind later
$sql   = "
    SELECT StudentReg, Average
    FROM `results` 
    WHERE school_session = ? 
        AND Term = ? 
        AND class = ? 
        AND subjectID = ?
    ORDER BY Average DESC
";

$query  = $con->prepare($sql);                                    // Prepare the query
$query->bind_param("iiii", $session, $term, $class, $subjectID); // Bind search values to parameters ("iiii" : one "i" for each variable, set's data type to "int")
$query->execute();                            // Run the query
$query->Store_result();                       // Store the result set
$query->bind_result($studentreg, $average);   // Bind returned rows to variables

$score_ends = array(1 => "st", 2 => "nd", 3 => "rd", 4 => "th");
$last_value = false;     // Initialise last value of result set
$counter    = 0;         // Initialise the counter
while($query->fetch()){  // Loop through the result set
    $counter++;          // Increment the counter

    // "if" statement using ternary logic
    // Sets the rank as either the counter OR the previous rank if it's the same
    $rank = ($last_value == false || $last_value <> $average) ? $counter : $rank;

    $end = ($rank > 3) ? $score_ends[4] : $score_ends[$rank];  // Sets the suffix to the rank using ternary logic
    echo "{$rank}{$end} {$average}<br>";                     // Prints the result; e.g. 1st 2 {2 == the StudentReg, presumably you'll update that to be a name or something}
    $last_value = $average;                                    // Sets current average as last value ready for next loop
}
?>






<div style="height:100px"></div>







<?php
//Prepare Statement method :: ranking system:same score, same rank but does not skip eg:32-1st, 32-1st, 33-2nd.
$session   = '2019/2020';
$term      = 'Second';
$class     = 'SSS 1';
$subjectID = '1';
// SQL query to SELECT "Average" and "StudentReg" from "results"
// ?s are a place holder for values we'll bind later
$sql   = "
SELECT StudentReg, Average
FROM `results` 
WHERE 
    school_session = ?
    AND Term = ?
    AND class = ? 
    AND subjectID = ?
ORDER BY Average DESC
";

$query  = $con->prepare($sql);                                    // Prepare the query
$query->bind_param("iiii", $session, $term, $class, $subjectID); // Bind search values to parameters ("iiii" : one "i" for each variable, set's data type to "int")
$query->execute();                            // Run the query
$query->Store_result();                       // Store the result set
$query->bind_result($studentreg, $average);   // Bind returned rows to variables

$score_ends = array(1 => "st", 2 => "nd", 3 => "rd", 4 => "th");
$last_value = false;     // Initialise last value of result set
### $counter    = 0;     // Initialise the counter
$rank = 0;
while($query->fetch()){  // Loop through the result set
### $counter++;      // Increment the counter

### // "if" statement using ternary logic
### // Sets the rank as either the counter OR the previous rank if it's the same
### $rank = ($last_value == false || $last_value <> $average) ? $counter : $rank;

// "if" statement using ternary logic
// Pre-increments (++ before variable) rank if the Average is not the same as previous
// ...or leaves as is if it is the same
$rank = ($last_value == false || $last_value <> $average) ? ++$rank: $rank;
$end = ($rank > 3) ? $score_ends[4] : $score_ends[$rank];  // Sets the suffix to the rank using ternary logic

echo "{$rank}{$end} {$average}<br>";   
                // Prints the result; e.g. 1st 2 {2 == the StudentReg, presumably you'll update that to be a name or something}
$last_value = $average; 
                                   // Sets current average as last value ready for next loop
                                  
}



//$a = 'Hello WOrld';
echo var_dump($query->fetch()) . "<br>";
?>