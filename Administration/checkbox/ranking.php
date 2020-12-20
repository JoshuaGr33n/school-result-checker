<?php 

//same score, different rank
                  $check_res = $con->query("SELECT * FROM `results` WHERE school_session='$session' AND Term='$term' AND class='$class' AND  subjectID='$subjectID' ORDER BY Average DESC ");
                  $score_ends = array(1 => "st", 2 => "nd", 3 => "rd", 4 => "th");

                 
                  $key_counter=1;
                 
                  foreach ($check_res as $value) {
                    $key_counters=$key_counter++;
                    if($RegNum == $value['StudentReg']){
                      if($key_counters < 4){
                         echo $key_counters.$score_ends[$key_counters];
                      }else{
                        echo $key_counters.$score_ends[4];
                      }
                    }
                  }
                  ?>









<?php 

//ranking system:same score, same rank but eg:32-1st, 32-1st and then skips to 33-3rd instead of 2nd.
                  $check_res = $con->query("SELECT  * FROM `results` WHERE school_session='$session' AND Term='$term' AND class='$class' AND  subjectID='$subjectID' Order by Average DESC ");
                  $counter = 1; // init absolute counter
                  $rank = 1; // init rank counter
                  $score_ends = array(1 => "st", 2 => "nd", 3 => "rd", 4 => "th");
                  // initial "previous" score:
                  $prevScore = 0;
                  
                foreach($check_res as $value){
                      // get "current" score
                      $score = $value['Average'];
                  
                      if ($prevScore != $score) // if previous & current scores differ
                          $rank = $counter;
                      // else //same // do nothing

                      if($row_resultss['StudentReg'] == $studentreg){
                      if($rank < 4){
                      echo $rank.$score_ends[$rank];
                      }

                         
                    else{
                      echo $rank.$score_ends[4];
                     
                    }
                  }
                      $counter ++; // always increment absolute counter
                      
                      //current score becomes previous score for next loop iteration
                      $prevScore = $score;
                  
                }
                  ?>












<?php
//Prepare Statement method :: ranking system:same score, same rank but eg:32-1st, 32-1st and then skips to 33-3rd instead of 2nd.
// SQL query to SELECT "Average" and "StudentReg" from "results"
                  // ?s are a place holder for values we'll bind later
                  $check_res  = "
                      SELECT StudentReg, Average
                      FROM `results` 
                      WHERE school_session = ? 
                          AND Term = ? 
                          AND class = ? 
                          AND subjectID = ?
                      ORDER BY Average DESC
                  ";
                  
                  $query  = $con->prepare($check_res);                                    // Prepare the query
                  $query->bind_param("iiii", $session, $term, $class, $subjectID); // Bind search values to parameters ("iiii" : one "i" for each variable, set's data type to "int")
                  $query->execute();                            // Run the query
                  $query->Store_result();                       // Store the result set
                  $query->bind_result($studentreg, $student_average);   // Bind returned rows to variables
                  
                  $score_ends = array(1 => "st", 2 => "nd", 3 => "rd", 4 => "th");
                  $last_value = false;     // Initialise last value of result set
                  $counter    = 0;         // Initialise the counter
                  while($query->fetch()){  // Loop through the result set
                      $counter++;          // Increment the counter
                  
                     
                      // "if" statement using ternary logic
                      // Sets the rank as either the counter OR the previous rank if it's the same
                      $rank = ($last_value == false || $last_value <> $student_average) ? $counter : $rank;
                      
                      $end = ($rank > 3) ? $score_ends[4] : $score_ends[$rank];
                     // Sets the suffix to the rank using ternary logic
                     if($RegNum == $studentreg){
                     echo "{$rank}{$end}";  
                               // Prints the result; e.g. 1st 2 {2 == the StudentReg, presumably you'll update that to be a name or something}

                     }
                      $last_value = $student_average;                                    // Sets current average as last value ready for next loop
                  
                }
?>













<?php
//Prepare Statement method :: ranking system:same score, same rank but does not skip eg:32-1st, 32-1st, 33-2nd.
$session   = '2019/2020';
$term      = 'Second';
$class     = 'SSS 1';
$subjectID = '1';
// SQL query to SELECT "Average" and "StudentReg" from "results"
// ?s are a place holder for values we'll bind later
$check_res   = "
SELECT StudentReg, Average
FROM `results` 
WHERE school_session = ? 
    AND Term = ? 
    AND class = ? 
    AND subjectID = ?
ORDER BY Average DESC
";

$query  = $con->prepare($check_res);                                    // Prepare the query
$query->bind_param("iiii", $session, $term, $class, $subjectID); // Bind search values to parameters ("iiii" : one "i" for each variable, set's data type to "int")
$query->execute();                            // Run the query
$query->Store_result();                       // Store the result set
$query->bind_result($studentreg, $average);   // Bind returned rows to variables

$score_ends = array(1 => "st", 2 => "nd", 3 => "rd", 4 => "th");
$last_value = false;     // Initialise last value of result set
### $counter    = 0;     // Initialise the counter
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
echo "{$rank}{$end} {$average}<br>";                     // Prints the result; e.g. 1st 2 {2 == the StudentReg, presumably you'll update that to be a name or something}
$last_value = $average;                                    // Sets current average as last value ready for next loop
}
?>



if($row_resultss['StudentReg'] == $studentreg){
                     echo "{$rank}{$end}";  
                               // Prints the result; e.g. 1st 2 {2 == the StudentReg, presumably you'll update that to be a name or something}
                             //  $last_value = $row_resultss['AveTotal'];   
                     }