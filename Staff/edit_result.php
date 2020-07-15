

<script>

function checkText(textBox)
      {
        var alphaExp = /^[a-zA-Z]+$/;
        while (textBox.value.length > 0 && !textBox.value.match(alphaExp)) {
          textBox.value = textBox.value.substring(0, textBox.value.length - 1)
        }
        textBox.value = trim(textBox.value);
      }
 function checkNumber(textBox){
        while (textBox.value.length > 0 && isNaN(textBox.value)) {
          textBox.value = textBox.value.substring(0, textBox.value.length - 1)
        }
        textBox.value = trim(textBox.value);
      }
      function calculate(){     
     var grade1 = document.getElementById('u_score').value; 
     var grade2 = document.getElementById('p_score').value;  
  //var grade3 = parseFloat(grade2*4);
    var totalVal = parseFloat(grade1) + parseFloat(grade2);
   document.getElementById('totalscore2').value = parseFloat(totalVal);
   //var newGP = (parseFloat(totalVal/2));
    //var newGP = (parseFloat(totalVal/2)-1);
   //document.getElementById('totalscore2').value = newGP.toFixed(0);  
        }



</script>

<?php 
//$queryx30 = mysqli_query($condb,"select * from results where student_id ='$get_RegNo'")or die(mysqli_error($condb));
								//$row_admit30 = mysqli_fetch_array($queryx30); $get_RegNo

if(isset($_POST['Load'])){ 
$appnocheck=$_POST['appnocheck'];
$conti_score=$_POST['u_score'];$exam_score=$_POST['p_score'];$total_score=$_POST['totalscore2'];//$totalscore2=$_POST['totalscore2'];
$credit_unit=$_POST['c_unitr'];  //$p_utmes=$_POST['p_utmes'];
if (empty($conti_score) or $conti_score == "0"){ 
	message("ERROR:  Student Continous Assessment Score cannot be Empty, Try Again.", "error");
		        redirect('Result_m.php?view=e_res&userId='.$get_RegNo);
				
				 }elseif($exam_score == "" ){
				 message("ERROR:  Exam Score cannot be Empty, Try Againn", "error");
		        redirect('Result_m.php?view=e_res&userId='.$get_RegNo);
									}elseif($conti_score + $exam_score > 100 ){
message("ERROR: The Sum of Exam Score and Continous Assessment score cannot be more than 100%, Try Again", "error");
		        redirect('Result_m.php?view=e_res&userId='.$get_RegNo);

					}else{
		
	//	mysqli_query($condb,"update results set assessment ='$conti_score',exam ='$exam_score',total ='$total_score',grade='".getgrade($total_score)."',gpoint='".getgp($total_score)."',qpoint='".getgp($total_score) * $credit_unit ."' where student_id='$get_RegNo'") 
//or die(mysqli_error($condb));

	mysqli_query($condb,"update results set assessment ='$conti_score',exam ='$exam_score',total ='$total_score',grade='".getgrade($total_score)."',gpoint='".getgp($total_score)."',qpoint='".getgp($total_score) * $credit_unit ."' where student_id='".safee($condb,$get_RegNo)."' and course_code = '".safee($condb,$_GET['cos_id'])."' and level = '".safee($condb,$_GET['lev_id'])."' and session = '".safee($condb,$_GET['ses_id'])."' and semester = '".safee($condb,$_GET['sem_id'])."'") 
or die(mysqli_error($condb));
		
			}
			message("Student result was Successfully Updated !", "success");
		        redirect('Result_m.php?view=e_res&userId='.$get_RegNo);
		
				}
?>

<div class="x_panel">
                
             
                <div class="x_content">
                 <?php
							$queryx = mysqli_query($condb,"select * from results where student_id ='".safee($condb,$get_RegNo)."' and course_code = '".safee($condb,$_GET['cos_id'])."' and level = '".safee($condb,$_GET['lev_id'])."' and session = '".safee($condb,$_GET['ses_id'])."' and semester = '".safee($condb,$_GET['sem_id'])."'")or die(mysqli_error($condb));
							
								//$queryx = mysqli_query($condb,"select * from results where student_id ='$get_RegNo'")or die(mysqli_error($condb));
								$row_admit = mysqli_fetch_array($queryx);
								
								?>
	                <form method="post" class="form-horizontal"  action="" enctype="multipart/form-data">
                    <input type="hidden" name="insidresult" value="<?php echo $_SESSION['insidresult'];?> " />
              
                    
                      
                      <span class="section">Updating Result Of <?php echo ucwords(getname($row_admit['student_id'])); ?> <?php
                                          if($resi20 == 1)
{


					echo " 
		
			    <center><label class=\"control-label\" for=\"inputEmail\"><font color=\"red\">$res20</font></label></center>
			 
			  ";
}
?></span>
<div class="alert alert-info alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">x</span>
                    </button>
            Note: This Form will enable You to update individual result of Selected Student Manually .
                  </div>
                  
                     <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Registration Number : </label>
                            	  <input type="text" class="form-control " name='s_regno' id="s_regno" value="<?php echo $row_admit['student_id']; ?>"  required="required" readonly>
                      </div>
                       <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Student Name :</label>
                            	  <input type="text" class="form-control " name='s_namer' id="s_namer" value="<?php echo getname($row_admit['student_id']); ?>"  required="required" readonly>
                      </div>
                       <div class="col-md-2 col-sm-2 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Course Code </label>
<input type="text" class="form-control " name='c_coder' id="c_coder" value="<?php echo $row_admit['course_code']; ?>"  required="required"  readonly>
                      </div>
      <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Academic Session </label>
<input type="text" class="form-control " name='a_session' id="a_session" value="<?php echo $row_admit['session']; ?>"   required="required" readonly>
                      </div>
			<div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Credit Unit</label>
<input type="text" class="form-control " name='c_unitr' id="c_unitr" onkeyup="calculate();javascript:checkNumber(this); " onkeypress="return isNumber(event);" value="<?php echo $row_admit['c_unit']; ?>"  readonly >
                      </div>
                      <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Continuous Assessment</label>
<input type="text" class="form-control " name='u_score' id="u_score" onkeyup="calculate();javascript:checkNumber(this); " onkeypress="return isNumber(event);" value="<?php echo $row_admit['assessment']; ?>"  required="required" >
                      </div>
                       <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Exam</label>
<input type="text" class="form-control " name='p_score' id="p_score" value="<?php echo $row_admit['exam']; ?>" onkeypress="return isNumber(event);" onkeyup="calculate();javascript:checkNumber(this);"   required="required" >
                      </div>
                      <input type="hidden" class="form-control" name='a_score' id="a_score" onkeypress="return isNumber(event);" onkeyup="calculate();javascript:checkNumber(this);"   >
                      
                      
                      <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Total Score</label>
<input  name='totalscore2' type="text" id="totalscore2"  value="<?php echo $row_admit['total']; ?>" onkeypress="return isNumber(event);" onkeyup="calculate();javascript:checkNumber(this);" class="form-control" readonly>
                      </div>
                      
              <!--      <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Admission Status</label>
<select    name="adminstatus" id="adminstatus" class="form-control" >
<option value="<?php //echo $row_admit['adminstatus']; ?>"><?php 
//if($row_admit['adminstatus']=='1'){
//echo 'Admitted';}elseif($row_admit['adminstatus']=='2'){ echo 'Pending';}elseif($row_admit['adminstatus']=='3'){ echo 'Not Admitted';}else{ echo 'Not Verified';} ?></option>
<option value="0">Not Verified</option>
<option  value="1">Admitted</option>
<option value="2">Pending</option>
<option value="3">Not Admitted</option>
</select>
                      </div>--!>
             
                      <div  class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback>
                        <div class="col-md-6 col-md-offset-3">
                         <button type="submit" name="Load"  id="save" data-placement="right" class="btn btn-primary col-md-4" title="Click to Update Result" ><i class="fa fa-pencil"></i> Update Result</button>
                        
                        <script type="text/javascript">
	                                            $(document).ready(function(){
	                                            $('#save').tooltip('show');
	                                            $('#save').tooltip('hide');
	                                            });
	                                            </script>
	                                            <div class='imgHolder2' id='imgHolder2'><img src='uploads/tabLoad.gif'></div>
                        </div>
                        
                      </div>
                    </form>
                  </div>
                  