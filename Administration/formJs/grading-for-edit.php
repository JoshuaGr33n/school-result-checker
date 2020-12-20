<?php
$total = ((int)$_POST["ca1"][$i]+(int)$_POST["ca2"][$i]+(int)$_POST["ca3"][$i]+(int)$_POST["exam"][$i]);
$average= $total/4;
$average=number_format($average, 2);





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


         else   {

          $grade="";
                                    
                  }
     
     
     











if($grade=="A")

{

$remark="Excellent";

}

else if($grade=="B")

{

$remark="Very Good";

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

$remark="Poor";

}

else if($grade=="F")

{

$remark="Fail";

}


?>