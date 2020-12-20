


<?php
function annual_grade($allTotalScoreAverage){
    if($allTotalScoreAverage >= 70){
        return array("grade" => "<span class='text-success font-weight-bold'>A</span>", "remark" => "<span class='text-success font-weight-bold'>Excellent</span>");
    }else if($allTotalScoreAverage >= 60){
        return array("grade" => "<span class='text-primary font-weight-bold'>B</span>", "remark" => "<span class='text-primary font-weight-bold'>Very Good</span>");
    }else if($allTotalScoreAverage >= 50){
        return array("grade" => "<span class='text-info font-weight-bold'>C</span>", "remark" => "<span class='text-info font-weight-bold'>Credit</span>");
    }else if($allTotalScoreAverage >= 45){
        return array("grade" => "<span class='text-secondary font-weight-bold'>D</span>", "remark" => "<span class='text-secondary font-weight-bold'>Pass</span>");
    }else if($allTotalScoreAverage >= 39){
      return array("grade" => "<span class='text-warning font-weight-bold'>E</span>", "remark" => "<span class='text-warning font-weight-bold'>Poor</span>");
    }else if($allTotalScoreAverage < 39){
      return array("grade" => "<span class='text-danger font-weight-bold'>F</span>", "remark" => "<span class='text-danger font-weight-bold'>Fail</span>");
    }
  
  } 
?>











<?php
 $teacherComment="";

                      if($teacherCustomRemark=="")



                      {





                      
                      
                      if($totalAverageSummation<=560)
                      {

                        $teacherComment="Fail";




                      }
                      

                      if($totalAverageSummation>=561)
                      {

                        $teacherComment="Pass";




                      }



                      if($totalAverageSummation>=757)
                      {

                        $teacherComment="Good";




                      }


                      if($totalAverageSummation>=827)
                      {

                        $teacherComment="Very Good";




                      }


                      if($totalAverageSummation>=966)
                      {

                        $teacherComment="Excellent";




                      }

                      else if($totalAverageSummation=="")
                      {

                       

                        $teacherComment="No Comment";
                        $principal_promotion_comment="No Comment";
                      




                      }







                      




                    }



                    else if($totalAverageSummation=="")
                      {

                        $teacherCustomRemark="No Comment";
                       

                       
                      




                      }

                    else{

                       $teacherCustomRemark;

                       $teacherComment="";

                   }



                      
                      
                      
                      ?>














                      