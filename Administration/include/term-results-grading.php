






<?php
 $teacherComment="";

                      if($teacherCustomRemark=="")



                      {





                      
                      
                      if($totalRow['totalsummation']<=560)
                      {

                        $teacherComment="Fail";




                      }
                      

                      if($totalRow['totalsummation']>=561)
                      {

                        $teacherComment="Pass";




                      }



                      if($totalRow['totalsummation']>=757)
                      {

                        $teacherComment="Good";




                      }


                      if($totalRow['totalsummation']>=827)
                      {

                        $teacherComment="Very Good";




                      }


                      if($totalRow['totalsummation']>=966)
                      {

                        $teacherComment="Excellent";




                      }

                      else if($totalRow['totalsummation']=="")
                      {

                       

                        $teacherComment="No Comment";
                      




                      }







                      




                    }



                    else if($totalRow['totalsummation']=="")
                      {

                        $teacherCustomRemark="No Comment";

                       
                      




                      }

                    else{

                       $teacherCustomRemark;

                       $teacherComment="";

                   }



                      
                      
                      
                      ?>









<?php


if($principalCustomRemark=="")



{



function principal_comment($teacherComment){
  if($teacherComment == "Fail"){
      return array("principalComment" => "Poor result, work harder");
  }else if($teacherComment =="Pass"){
      return array("principalComment" => "A lot of effort is needed to improve your performance");
  }else if($teacherComment =="Good"){
      return array("principalComment" => "Good result but more effort is needed");
  }else if($teacherComment =="Very Good"){
      return array("principalComment" => "Your effort is commendable");
  }else if($teacherComment =="Excellent"){
    return array("principalComment" => "Very Good, keep it up!");
  }
  else if($teacherComment ="No Comment"){
    return array("principalComment" => "No Comment");
  }

 



} 

$p_comment=principal_comment($teacherComment);

}

else if($totalRow['totalsummation']==""){

    $principalCustomRemark="No Comment";
    $p_comment['principalComment']="";
    
  }

  
else{

    

    $p_comment['principalComment']="";

    $principalCustomRemark;

   

  

}



?>









                      