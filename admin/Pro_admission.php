

<script type="text/javascript">
var xmlhttp

function loadDept(str)
{var a=document.getElementById(str)[document.getElementById(str).selectedIndex].innerHTML;
if(a=='Select <?php echo $SCategory; ?>'){ return;}
else{
var e=document.getElementById('imgHolder2');
e.style.visibility='visible';
xmlhttp=GetXmlHttpObject();

setTimeout(function(){if (xmlhttp==null)
  {
  alert ("Your browser does not support AJAX!");
  return;
  }

var d=document.getElementById(str)[document.getElementById(str).selectedIndex].innerHTML;
var url="loadDept.php";
url=url+"?loadfac="+d;
url=url+"&sid="+Math.random();
xmlhttp.onreadystatechange=stateChanged;
xmlhttp.open("GET",url,true);
xmlhttp.send(null);},1000);
}
}

function stateChanged()
{
if (xmlhttp.readyState==4)
  {
  document.getElementById("dept_load").innerHTML=xmlhttp.responseText;
  var f=document.getElementById('imgHolder2');
  f.style.visibility='hidden';
  }
}

function GetXmlHttpObject()
{
if (window.XMLHttpRequest)
  {
  // code for IE7+, Firefox, Chrome, Opera, Safari
  return new XMLHttpRequest();
  }
if (window.ActiveXObject)
  {
  // code for IE6, IE5
  return new ActiveXObject("Microsoft.XMLHTTP");
  }
return null;
}

</script>

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
     /* function calculate(){     
     var grade1 = document.getElementById('u_score').value; 
     var grade2 = document.getElementById('p_score').value;  
  var grade3 = parseFloat(grade2*4);
    var totalVal = parseFloat(grade1) + parseFloat(grade3);
   document.getElementById('a_score').value = parseFloat(totalVal);
   var newGP = (parseFloat(totalVal/2));
    //var newGP = (parseFloat(totalVal/2)-1);
   document.getElementById('totalscore2').value = newGP.toFixed(0);  
        }*/
        function calculate(){     
     var grade1 = document.getElementById('u_score').value; 
     var grade2 = document.getElementById('p_score').value; 
	  var gradeutme = parseFloat(grade1/8); 
  var grade3 = parseFloat(grade2/2); 
  if(grade1 < 1){ var totalVal =  parseFloat(grade2);}else{ var totalVal =  parseFloat(gradeutme) + parseFloat(grade3); }
    //var totalVal = parseFloat(gradeutme) + parseFloat(grade3);
   document.getElementById('a_score').value = parseFloat(totalVal);
   var newGP = (parseFloat(totalVal));
    //var newGP = (parseFloat(totalVal/2)-1);
   document.getElementById('totalscore2').value = newGP.toFixed(0);  
        }



</script>
  <?php $queryx = mysqli_query($condb,"select * from new_apply1 where stud_id ='".safee($condb,$get_RegNo)."'")or die(mysqli_error($condb));
$row_admit = mysqli_fetch_array($queryx); $e_address = $row_admit['e_address']; $app_type = $row_admit['app_type'];
$subject= getprog($app_type)." Admission Notification"; $fulname = $row_admit['FirstName']." ". $row_admit['SecondName']." ".$row_admit['Othername'];  ?>
<?php 
$return_url2 	= base64_decode($_GET["loc"]);
$urllogin = host();
//error_reporting(E_ALL);
//ini_set('display_errors', 1);
if(isset($_POST['Load'])){ 
$appnocheck=$_POST['appnocheck'];
$J_score=$_POST['u_score'];$p_score=$_POST['p_score'];$a_score=$_POST['a_score'];$totalscore2=$_POST['totalscore2'];
$adminstatus=$_POST['adminstatus'];  $p_choice=$_POST['aprovechoice'];
if($p_choice == "1"){ $adfac = $row_admit['fact_1']; $addept = $row_admit['first_Choice']; }else{ $adfac = $row_admit['fact_2']; $addept = $row_admit['Second_Choice']; }
$sql_email_check2 = mysqli_query($condb,"SELECT * FROM new_apply1 where verify_apply='TRUE'");
	//$email_check2 = mysql_num_rows($sql_email_check2);
	$email_check2 = mysqli_fetch_array($sql_email_check2); $appnum2 = $email_check2['appNo'];
	
 	if (empty($p_score) or $p_score == "0"){ 
	message("ERROR:  Post UTME Exam Score cannot be Empty, Try Again.", "error");
		        redirect('new_apply.php?view=P_admin&userId='.$get_RegNo);
				}elseif($p_score > 100 ){
				message("ERROR:  Post UTME Exam Score Exceed The Maximum score of 100%, Try Again.", "error");
		        redirect('new_apply.php?view=P_admin&userId='.$get_RegNo);
				}else{
	if(empty($J_score) or $J_score =="0"){ mysqli_query($condb,"update new_apply1 set post_uscore ='".safee($condb,$p_score)."',average_score ='".safee($condb,$a_score)."',adminstatus='".entranceStatus($a_score,$class_ID)."',course_choice ='".safee($condb,$p_choice)."',afac = '".safee($condb,$adfac)."' ,adept='".safee($condb,$addept)."' where stud_id='".safee($condb,$get_RegNo)."'") 
or die(mysqli_error($condb));
			}else{
				if($adminstatus == '3' and $s_utme=='0'){
					mysqli_query($condb,"update new_apply1 set post_uscore ='".safee($condb,$p_score)."',average_score ='".safee($condb,$totalscore2)."',adminstatus='".safee($condb,$adminstatus)."',course_choice ='".safee($condb,$p_choice)."' where stud_id='".safee($condb,$get_RegNo)."'") 
or die(mysqli_error($condb));
}elseif($adminstatus == '1' and $s_utme=='0'){
mysqli_query($condb,"update new_apply1 set post_uscore ='".safee($condb,$p_score)."',average_score ='".safee($condb,$totalscore2)."',adminstatus='".safee($condb,$adminstatus)."',course_choice ='".safee($condb,$p_choice)."',afac = '".safee($condb,$adfac)."' ,adept='".safee($condb,$addept)."' where stud_id='".safee($condb,$get_RegNo)."'") 
or die(mysqli_error($condb));
}else{
mysqli_query($condb,"update new_apply1 set post_uscore ='".safee($condb,$p_score)."',average_score ='".safee($condb,$totalscore2)."',adminstatus='".entranceStatus($totalscore2,$class_ID)."',course_choice ='".safee($condb,$p_choice)."' where stud_id='".safee($condb,$get_RegNo)."'") 
or die(mysqli_error($condb));
				
}}
if($adminstatus == '1'){
$msg = nl2br("Congratulations! ".$fulname.",.\n
	
	This is To Inform you that you have been giving admission into ".getdeptc($addept)." in ".$schoolNe.",\n
	Kindly Login to: ".$urllogin."apply_b.php?view=C_R"." with you Application Number and password to Comfirm \n
    To Comfirm your Admission your required to make payment @: ".$urllogin."apply_b.php?view=M_P"." with you Application Number \n
	..................................................................\n
    Note That This Admission will be withdrawn if you Violate The Terms and Condition of your Admission!\n
    
    This Message was Sent From " .$schoolNe ." @ ".$_SERVER['HTTP_HOST']." dated ".date('d-m-Y').".\n
    For inquiry and complaint please email info@smartdelta.com.ng \n
	
	Thank You Admin!\n\n");
    ob_start(); //Turn on output buffering
$mail_data = array('to' => $e_address, 'sub' => $subject, 'msg' => 'Notify','body' => $msg, 'srname' => $comn);
	send_email($mail_data);}
				message("Student Post UTME result was Successfully Processed !", "success");
		        //redirect('new_apply.php?view=P_admin&userId='.$get_RegNo.'&loc='.$return_url2);
		        redirect($return_url2);
	//echo "<script>window.location.assign('studentappprint.php?applicationid=".$appnumber."');</script>";
				}
				}
?>

<div class="x_panel">
                
             
                <div class="x_content">
               
	                <form method="post" class="form-horizontal"  action="" enctype="multipart/form-data">
                    <input type="hidden" name="insidresult" value="<?php echo $_SESSION['insidresult'];?> " />
              
                    
                      
                      <span class="section">Processing Record Of <?php echo ucwords($row_admit['FirstName']." ". $row_admit['SecondName']); ?> <?php
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
                    <?php if($s_utme == '1'){ ?>
          Note: This Form will enable You to process individual result of Selected Student Automatically.
		  <?php }else{ ?> 
		    Note: This Form will enable You to process individual result of Selected Student Manually by selecting Admission Status Type of Your Choice
		  <?php } ?>
                  </div>
                  
                     <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Jamb Reg Number </label>
                            	  <input type="text" class="form-control " name='j_no' id="j_no" value="<?php echo $row_admit['appNo']; ?>"  required="required" readonly>
                      </div>
                       <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
						  	  <label for="heard">First Choice </label>
                            	  <input type="text" class="form-control " name='f_choice' id="f_choice" value="<?php echo getdeptc($row_admit['first_Choice']); ?>"  required="required" readonly>
                      </div>
                       <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Second Choice </label>
<input type="text" class="form-control " name='s_choice' id="s_choice" value="<?php echo getdeptc($row_admit['Second_Choice']); ?>"  required="required"  readonly>
                      </div>
      <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Academic Session </label>
<input type="text" class="form-control " name='a_session' id="a_session" value="<?php echo $row_admit['Asession']; ?>"   required="required" readonly>
                      </div>
			
                      <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
						  	  <label for="heard">UTME Score</label>
<input type="text" class="form-control " name='u_score' id="u_score" onkeyup="calculate();javascript:checkNumber(this); " onkeypress="return isNumber(event);" value="<?php echo $row_admit['J_score']; ?>"  required="required" readonly>
                      </div>
                       <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Post UME Score</label>
<input type="text" class="form-control " name='p_score' id="p_score" value="<?php echo $row_admit['post_uscore']; ?>" onkeypress="return isNumber(event);" onkeyup="calculate();javascript:checkNumber(this);"   required="required" >
                      </div>
                      <input type="hidden" class="form-control" name='a_score' id="a_score" onkeypress="return isNumber(event);" onkeyup="calculate();javascript:checkNumber(this);"   >
                      
                      
                      <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Average Score</label>
<input  name='totalscore2' type="text" id="totalscore2"  value="<?php echo $row_admit['average_score']; ?>" onkeypress="return isNumber(event);" onkeyup="calculate();javascript:checkNumber(this);" class="form-control">
                      </div>
                      
                      <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Approved  Choice</label>
<select    name="aprovechoice" id="aprovechoice" class="form-control" >
<option value="<?php echo $row_admit['course_choice']; ?>"><?php 
if($row_admit['course_choice']=='1'){
echo 'First Choice';}else{ echo 'Second Choice';} ?></option>
<option  value="1">First Choice</option>
<option value="2">Second Choice</option>
<option  value="">None</option>
</select>
                      </div>
                      
                    <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Admission Status</label>
<select    name="adminstatus" id="adminstatus" class="form-control" >
<option value="<?php echo $row_admit['adminstatus']; ?>"><?php echo getappstatus($row_admit['adminstatus']); ?></option>
<option value="0">Not Verified</option>
<option  value="1">Admitted</option>
<option value="2">Pending</option>
<option value="3">Not Admitted</option>
</select>
                      </div>
                      <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                       </div>
             
                     
                        <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                         <button type="submit" name="Load"  id="save" data-placement="right" class="btn btn-primary col-md-2" title="Click to Save Result" ><i class="fa fa-gears"></i> Process Result</button>
                        <a href="javascript:void(0);" 	onclick="window.open('<?php echo $return_url2; ?>','_self')" class="btn btn-info"  id="delete2" data-placement="right" title="Click to go back to search record" ><i class="fa fa-arrow-left icon-large"></i> Go Back</a>
                        <script type="text/javascript">
	                                            $(document).ready(function(){
	                                            $('#save').tooltip('show');
	                                            $('#save').tooltip('hide');
	                                            });
	                                            </script>
	                                            <div class='imgHolder2' id='imgHolder2'><img src='uploads/tabLoad.gif'></div>
                        </div>
                        
                      
                    </form>
                  </div>
                  