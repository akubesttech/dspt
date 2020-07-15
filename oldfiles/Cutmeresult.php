<?php
//session_start();

//ini_set('display_errors', 1);
if($_SESSION['insid']==$_POST['insid'])
{
if(isset($_POST['Login_Reprint'])){
 $Session_checker = $_POST["session"];
$serial = $_POST["serial"];
$nappNo21 = $_POST["nappNo21"];
	$_SESSION['temppin']=$Pin;

	$sql_pinr="SELECT * FROM new_apply1 WHERE Asession ='$Session_checker' AND appNo ='$nappNo21' or JambNo ='$nappNo21' and verify_apply='TRUE'";
$result_pinr = mysql_query($sql_pinr);
$num_pinr = mysql_num_rows($result_pinr);

$num_serialr = mysql_fetch_array($result_pinr);
$num_serialNo = $num_serialr['SerialNo'];


$sql_appNo_check = mysql_query("SELECT * FROM new_apply1 WHERE appNo='$nappNo21' or JambNo='$nappNo21' LIMIT 1");
$appNo_check = mysql_num_rows($sql_appNo_check);
//$sql_JambNo_check = mysql_query("SELECT * FROM new_apply1 WHERE JambNo='$nappNo21' LIMIT 1");
//$JambNo_check = mysql_num_rows($sql_JambNo_check);
$sql_session_check = mysql_query("SELECT Asession FROM new_apply1 WHERE  appNo='$nappNo21' and Asession ='$Session_checker' or JambNo ='$nappNo21'");
$session_check = mysql_num_rows($sql_session_check);
//$sub_user = $num_pinn2['reg_status'];
	$_SESSION['tempserial']=$num_serialNo;
		if ($appNo_check < 1){ 
	
		$res="<font color='Red'><strong>ERROR:  Your $nappNo21 Number is Incorrect please Comfirm and try Again.</strong></font><br>";
				$resi=1;
}elseif(strpos($nappNo21," ")){
		$res="<font color='Red'><strong>Please! Application Id can not Contain a Space..</strong></font><br>";
				$resi=1;
}elseif($session_check < 1){ 
$res="<font color='Red'><strong>ERROR:  Examination Session is Incorrect please Comfirm and try Again.</strong></font><br>";
				$resi=1;
}elseif($num_pinr < 1){
        $res="<font color='Red'><strong>Incorrect Applicant Examination Details, Please Try Again.</strong></font><br>";
				$resi=1;
}else{
			//	header("location:apply_b.php?view=N_1");
				//echo "<script>alert('Your Application was Sucessfully Submited!');</script>";
		echo "<script>window.location.assign('studentresultprint.php?applyid=".md5($nappNo21)."');</script>";
			}

}}$_SESSION['insid'] = rand();
?>

  <div class="container">
   <br><br>
    <h1 class="shadowed" style="color:black;text-shadow:-1px 1px 1px #000;"> Post UTME EXAM RESULT CHECKER </h1>
    
   
    <div class="boxes-holder" style="background-color:#D9F7FD;font-size:14px;font-family:'Open Sans','Helvetica Neue','Helvetica',Arial,Verdana,sans-serif;color:#666666;max-width:980px;min-width:150px">
   
       <div class="entry products">
       <h3 style="color:orange;text-shadow:0 2px 1px black;">This page will Enable You To Check Your Post UTME Result and Admission  Status.</h3><br>
       
       
       	<div id="center">

		<div class="inner_right_demo">
		<form name="register2" action="" method="post" enctype="multipart/form-data" id="register2">
			<input type="hidden" name="insid" value="<?php echo $_SESSION['insid'];?> " />
			<input type="hidden" name="MAX_FILE_SIZE" value="300000" />
			<div class="form_box">
			 <div class="clear">
        <table width="300" height="100" >
        <tr style="">
    <td colspan="4" height="36" width="69%"><center><?php
if($resi == 1)
{

echo " <div class=\"alert alert-info\"><i class=\"icon-info-sign\"></i> $res </div> ";
					//echo " $res";
}
?></center></td>
    </tr>
		 <tr style="background-color:lightblue;box-shadow: 2px 2px gray;">
    <td colspan="5" height="39" style="text-shadow: 2px 2px white;"><strong>&nbsp;Applicant Examination Details:</strong></td>
    
    </tr>

  <tr>
  <td width="19%">Application ID:</td>
    <td width="31%"><input type="text" name="nappNo21" id="nappNo21" placeholder="Enter your Application No or UTME Reg No" required="required"></td>
    <td width="19%">Session:</td>
    <td width="31%"><select class="input-medium"   name="session" id="session"  required="required">
  <option value="">Select Session</option>
  
<?php  
$resultsec = mysql_query("SELECT * FROM session_tb where action = '1' ORDER BY session_name ASC");
while($rssec = mysql_fetch_array($resultsec))
{
echo "<option value='$rssec[session_name]'>$rssec[session_name]</option>";	
}
?>
</select></td>
    
    
  </tr>
   <tr >
    <td width="19%" height="20"></td>
    
  </tr>
		
		<tr >
          <td height="10"></td>
          <td  height="10">
          
          <button name="Login_Reprint" class="Button1" id="button1" data-placement="right" type="submit" title="Click to Check  Your Result and Admission Status"><i class="icon-plus-sign icon-large">Check</i></button>
          
												<script type="text/javascript">
	                                            $(document).ready(function(){
	                                            $('#Button1').tooltip('show');
	                                            $('#Button1').tooltip('hide');
	                                            });
	                                            </script>
           
            
											
          </td>
          
          
        </tr>
		</table>
            
      </div>
	
			</div>
			</form>
		</div></div>
    
      
      
      <div class="cl">&nbsp;</div>
    </div>
    
    </div>
    
    <br><br>
  </div>
</div>
