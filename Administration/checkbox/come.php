<?php
               $check_res  = "
               SELECT subjectName, subjectID, StudentID, StudentReg, student_name, School, current_class
               FROM `registered_subjects` 
               WHERE school_session = ? 
                   AND Term = ? 
                   AND class = ? 
                   AND subjectID = ?
               ORDER BY Average DESC
               ";


                $list_subjects = $con->query("SELECT * FROM `registered_subjects` WHERE School='senior secondary school' Group By subjectID Order By subjectID ASC");
                echo '<table class="table table-hover table-bordered table-striped" id="sampleTable">';
                $head = "<thead><tr>";
                $body = "<tbody><tr>";
               

               while($row_subjects = $list_subjects->fetch_array()){
               
               
               $head.="<th>$row_subjects[subjectName]</th>";


               $result = mysqli_query($con, "SELECT * FROM `results` WHERE school_session='2019/2020' AND Term='Second' AND class='SSS 1' AND  subjectID='$row_subjects[subjectID]' ");
               
                $row_results = $result->fetch_array();

               
               
               $body.= "<td>$row_results[Total]</td>";
               
               }
              
             
               echo $head."</tr></thead>";
              
               
               echo $body. "</tr></tbody>";
               echo "</table>";

               
               ?>














$session2="2019/2020";
                $term2="Second";
                $class2="SSS 1";

                $query_results = "
                SELECT Total
                FROM `results` 
                WHERE school_session = ?
                Term = ?
                class = ?
                subjectID = ?
                   
                
                ";
                $query2 = $con->prepare($query_results);                                   
                $query2->bind_param("s", $total); 
                $query2->execute();                           
                $query2->Store_result();                      
                $query2->bind_result($session2, $term2, $class2, $subjectID); 

                $query2->fetch();
               
               $body.= "<td>$total</td>";


































               <?php
               $school="Senior Secondary School";
               $list_subjects = "
               SELECT subjectName, subjectID, StudentID, StudentReg, current_class
               FROM `registered_subjects` 
               WHERE School = ? 
                  
               Group By subjectID Order By subjectID ASC
               ";
               $query  = $con->prepare($list_subjects);                                   
               $query->bind_param("i", $school); 
               $query->execute();                           
               $query->Store_result();                      
               $query->bind_result($subjectName, $subjectID, $studentID, $student_Reg, $current_class);   


              
                echo '<table class="table table-hover table-bordered table-striped" id="sampleTable">';
                $head = "<thead><tr>";
                $body = "<tbody><tr>";
               

               while($query->fetch()){
               
               
               $head.="<th>$subjectName</th>";


               $result = mysqli_query($con, "SELECT * FROM `results` WHERE school_session='2019/2020' AND Term='Second' AND class='SSS 1' AND  subjectID=' $subjectID' ");
               
                $row_results = $result->fetch_array();

               
                
               $body.= "<td>$row_results[Total]</td>";
               
               }
              
             
               echo $head."</tr></thead>";
              
               
               echo $body. "</tr></tbody>";
               echo "</table>";

               
               ?>









<?php
                
                //output all from students table
                $subject =$row_subjects['subjectName']; 
                $sno =$row_results['Sno']; 
                 $student_id =$row_results['StudentID'];
                 $RegNum =$row_results['StudentReg']; 
                

               
               
                 $studentDetailQuery = "SELECT * FROM students where student_id= '".$row_results['StudentID']."'";
                 $studentDetailResult = mysqli_query($con, $studentDetailQuery);
                 
                 $studentDetailrow = mysqli_fetch_array($studentDetailResult);
                
                 $fname = $studentDetailrow['FirstName'];
                 $mName = $studentDetailrow['MiddleName'];
                 $lname = $studentDetailrow['LastName'];
                 $RegNum = $studentDetailrow['RegNum'];
              

                
                
                
                
                
         
                
                            
                
                  ?>
                 <tr>
                
             <td class="column100 column1" data-column="column1"><b><?php echo $fname;?></b></td>
                
             


             <td class="column100 column2" data-column="column2"><?php echo  $row_results['Totaal'];?></td>
                             <td class="column100 column2" data-column="column2"></td>
             <td class="column100 column2" data-column="column2"></td>
             <td class="column100 column2" data-column="column2"></td>
             <td class="column100 column2" data-column="column2"></strong></td>
            
              



             
            



<?php 











?>
       
             



             



 
                   
                 </tr>
                <?php }?>