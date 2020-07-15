<script type="text/javascript">   
$(document).ready(function() {   
$('#paytype').change(function(){   
if($('#paytype').val() === 'Paycard')   
   {   
   $('#pin').show();   $('#pin2').show();    $('#pin3').show(); $('#pin4').show(); 
   }   
else 
   {   
   $('#pin').hide();    $('#pin2').hide();    $('#pin3').hide();  $('#pin4').hide();  
   }   
});   
});   
</script>
<script type='text/javascript'>
function preview_image(event) 
{
 var reader = new FileReader();
 reader.onload = function()
 {
  var output = document.getElementById('output_image');
  output.src = reader.result;
 }
 reader.readAsDataURL(event.target.files[0]);
}
</script>
<script>

function sync(){
var sname = document.getElementById('nappNo21');
var sname1 = sname.value;
var userID = document.getElementById('userID');
//var number = Math.floor(Math.random() * 100) +4;

userID.value = sname1+number;
//userID.value.changeToUpperCase();
}


</script>
<?php

	function createRandomPassword() {
$chars = "abcdefghijkmnopqrstuvwxyz023456789";
srand((double)microtime()*1000000);$i = 0;$pass = '' ;while ($i <= 7) {
$num = rand() % 33;$tmp = substr($chars, $num, 1);$pass = $pass . $tmp;$i++;}
return $pass;}

//ini_set('display_errors', 1);
if($_SESSION['insid']==$_POST['insid'])
{
if(isset($_POST['Login_Reprint'])){
 $Session_checker1 = $_POST["session"];
$level = $_POST["plevel"];
$paytype = $_POST['paytype'];
$nappNo21 = $_POST["nappNo21"];
$Pin = $_POST["pin"];
$transid = createRandomPassword();
$paidamt = $_POST["paidamt"];
$date = $_POST["end_date"];
$bank = $_POST["bank"];
	$_SESSION['sessionpay']=$Session_checker1;

	$sql_load="SELECT * FROM new_apply1 WHERE Asession ='$Session_checker1' AND appNo ='$nappNo21' or JambNo ='$nappNo21' and adminstatus ='1'";$result_load = mysql_query($sql_load);
$num_pinr = mysql_num_rows($result_load);
$find_student = mysql_fetch_array($result_load);
$c_cho= $find_student['course_choice'];
$deep1= $find_student['first_Choice'];
$deep2= $find_student['Second_Choice']; $payemail = $find_student['e_address']; $phonepay = $find_student['phone']; 
$programs = $find_student['app_type'];
$payeefullname = $find_student['FirstName']." ".$find_student['SecondName']." ".$find_student['Othername'];
//$num_serialNo = $num_serialr['SerialNo'];
 if($c_cho==1){
							$pdepart = $deep1;
							}else{
							$pdepart = $deep2;}
$sql2="SELECT * FROM pin_fee WHERE pinnumber='$Pin' AND status='NOTUSED'";
$result10=mysql_query($sql2);
$numPin=mysql_num_rows($result10);
$loadfeeamount=mysql_query("SELECT * FROM fee_db WHERE f_dept ='$pdepart'  AND feetype ='School fee' AND program ='$programs'");
$find_amountp = mysql_fetch_array($loadfeeamount); $payamount2 = $find_amountp['f_amount'];
$paystatus1=mysql_query("SELECT * FROM payment_tb WHERE app_no ='$nappNo21'  AND session='$Session_checker1' AND level ='$level'");
$paystatus12=mysql_num_rows($paystatus1);$paystatus13=mysql_fetch_array($paystatus1); $appnop =$paystatus13['app_no'];
$paystatuspin=mysql_query("SELECT * FROM payment_tb WHERE pin ='$Pin' and app_no ='$nappNo21' AND session='$Session_checker1' AND level ='$level'  ");
$paystatus13 =mysql_num_rows($paystatuspin);
$sql_appNo_check = mysql_query("SELECT * FROM new_apply1 WHERE appNo='$nappNo21' and adminstatus ='1' or JambNo='$nappNo21' ");
$appNo_check = mysql_num_rows($sql_appNo_check);
$sql_session_check = mysql_query("SELECT Asession FROM new_apply1 WHERE  appNo='$nappNo21' and Asession ='$Session_checker1' or JambNo ='$nappNo21'");
$session_check = mysql_num_rows($sql_session_check);
$_SESSION['tempserial']=$num_serialNo;
		if ($appNo_check < 1){ 
$res="<font color='Red'><strong>ERROR: Your $nappNo21 Number is Incorrect or Not Admitted please Comfirm and try Again.</strong></font><br>"; $resi=1;
}elseif(strpos($nappNo21," ")){ $res="<font color='Red'><strong>Please! Application Id can not Contain a Space..</strong></font><br>";
$resi=1;
}elseif($session_check < 1){ 
$res="<font color='Red'><strong>ERROR:  This Student Record is Not Found in this Session.</strong></font><br>";
				$resi=1;
}elseif($paystatus12 > 0 ){
$res="<font color='Red'><strong>The Student with $nappNo21  Has Paid For $Session_checker1 Session.</strong></font><br>"; $resi=1;
}else{
if($paytype == 'Paycard'){
$name4     = $_FILES['image_name']['name'];
$tmpName  = $_FILES['image_name']['tmp_name'];
 $ext = strtolower(pathinfo($name4, PATHINFO_EXTENSION));
$maxsize = 300000;
if($numPin < 1 ){
	$res="<font color='Red'><strong>Incorrect Payment Pin Number..</strong></font><br>";
				$resi=1;  }elseif($paystatus13 > 0 ){
	$res="<font color='Red'><strong>This Pin Has Already Been Used For Payment..</strong></font><br>";
				$resi=1;}
				elseif($_FILES['image_name']['size'] == Null)  {
	$res="<font color='Red'><strong>Please Attach your payment Teller Before You Submit This Payment.</strong></font><br>";
				$resi=1;
				}elseif(getimagesize($_FILES['image_name']['tmp_name']) < $maxsize){
	$res="<font color='Red'><strong>File size should be less than 300kb.</strong></font><br>";
				$resi=1;}elseif(!in_array($ext, array('jpg','jpeg','png','gif')) ){
 	$res="<font color='Red'><strong>Invalid file type. Only  JPG, GIF and PNG types are accepted.</strong></font><br>";
				$resi=1;}
				elseif(empty($paidamt))  {
	$res="<font color='Red'><strong>Please Amount Paid In Is Requried.</strong></font><br>";
				$resi=1;}else{
				   while($r < 6){
								   $dig .=rand(3,9);
                                    $r+=1;
                                          }
                                         $newname=$dig . ".gif";
$recordimage = move_uploaded_file($_FILES["image_name"]["tmp_name"], "admin/payimg/$newname");
                                $adminthumbnails = "payimg/" .$newname;
                                if($c_cho==1){
							$pdepart = $deep1;
							}else{
							$pdepart = $deep2;
						}
 $result = mysql_query("insert into payment_tb(app_no,trans_id,pay_mode,fee_type,pin,bank_name,teller_no,teller_img,paid_amount,pay_date,session,level,department,pay_status) 
			values('$nappNo21','$transid','$paytype','School fee','$Pin','$bank','$_POST[tellerno]','".mysql_real_escape_string($adminthumbnails)."','$paidamt','$date','$Session_checker1','$level','$pdepart','0')")or die(mysql_error());
			
			$sql2=	mysql_query("UPDATE pin_fee SET status='USED' WHERE pinnumber='$Pin'")or die(mysql_error());
	//$find_d_load = mysql_fetch_array(mysql_query(" SELECT * FROM dept where d_name='$num_dep'"));
			echo "<script>alert('Your Fee Payment was Sucessfully Submited!');</script>";
			echo "<script>window.location.assign('paymentslip.php?p_id=".md5($transid)."');</script>";
                                }

}else{
   
$_SESSION['paydepart'] = $pdepart;
$_SESSION['spayid'] = $nappNo21;
$_SESSION['Fnamep'] = $payeefullname;
$_SESSION['mobile'] = $phonepay;
$_SESSION['emailp'] = $payemail;
$_SESSION['sfee'] = "School fee";
$_SESSION['amount'] = $payamount2;
		echo "<script>window.location.assign('apply_b.php?view=e_view&p_id=".md5($nappNo21)."');</script>";
	


}
			//	header("location:apply_b.php?view=N_1");
				//echo "<script>alert('Your Application was Sucessfully Submited!');</script>";
	
		//echo "<script>window.location.assign('studentresultprint.php?applyid=".md5($nappNo21)."');</script>";
			}
	
}}$_SESSION['insid'] = rand();
?>

  <div class="container">
   <br><br>
    <h1 class="shadowed" style="color:black;text-shadow:-1px 1px 1px #000;"> Payment Panel For New Student</h1>
    
   
    <div class="boxes-holder" style="background-color:#D9F7FD;font-size:14px;font-family:'Open Sans','Helvetica Neue','Helvetica',Arial,Verdana,sans-serif;color:#666666;max-width:980px;min-width:150px">
   
       <div class="entry products">
       <h3 style="color:orange;text-shadow:0 2px 1px black;">This page will Enable Year one student To Make payment of Fees .</h3><br>
       
       
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
    <td colspan="5" height="39" style="text-shadow: 2px 2px white;"><strong>&nbsp;Student Payment Details:</strong></td>
    
    </tr>

  <tr>
  <td width="19%">Application ID:</td>
    <td width="31%"><input type="text" name="nappNo21" id="nappNo21" placeholder="Enter your Application No or UTME Reg No" required="required" ></td>
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
   <tr>
  
    <td width="19%">Level:</td>
    <td width="31%"><select class="input-medium"   name="plevel" id="plevel"  required="required">
  <option value="">Select Level</option>
<option value='100'>100</option>	
</select></td>
     <td>Mode of Payment</td>
  <td><select name="paytype" id="paytype"  required="required">
    
  <option value="">Select</option>
    <option value="Paycard">E-Paycard</option>
    <option value="Online">Online Payment</option>
  </select>
</td></tr>
<tr style="display: none;" id="pin"><td>Card Pin </td><td><input type="text" name="pin" onkeypress="return isNumber(event);" id="pin" style='width:180px;' ></td>
<td>Bank Name</td><td><?php $query2 = "SELECT * FROM bank";
 $result2 = mysql_query($query2); 
 ?> 
<select   name="bank" ><option selected="selected" value="" disabled="disabled">--- Select  Bank---</option>
<?php while ($line2 = mysql_fetch_array($result2, MYSQL_ASSOC))
  { 
  ?>
  
  <option value="<?php echo $line2['b_name'];?>"> <?php echo $line2['b_name'];?> </option>

<?php } 
?>  
    </select></td>

</tr>
<tr style="display: none;" id="pin2"><td>Teller No</td><td><input type="text" name="tellerno" id="tellerno" style='width:180px;'></td>
<td>Date of Payment:</td><td><input  type="text" name="end_date" class="input-file uniform_on w8em format-d-m-y highlight-days-67 range-low-today " id="ed"   readonly="readonly" style='width:180px;'></td>
</tr>
<tr style="display: none;" id="pin4">
<td>Amount </td><td><input type="text" name="paidamt" id="paidamt" style='width:180px;' onkeypress="return isNumber(event);" ></td></tr>
    
	<tr style="display: none;" id="pin3">
        <td>Upload Teller:</td>
          <td >	<input name="image_name" class="input-file uniform_on" id="fileInput" type="file" accept="image/*" onchange="preview_image(event)" style="width:200px;"></td>
           <td height="30"></td>
            <td> 
<div class="otherinputs">
<div class="fileinput-new thumbnail" style="width: 200px; height: 50px; border: 1px solid #0080e5;">
<img src='' alt='Note : File size should not be Greater than 300kb' id='output_image' style='width:200px;height: 50px;'>
 </div> </div>
	
</td> </tr>
    
   <tr>
    <td width="19%" height="20"></td>
    </tr>
		
		<tr >
          <td height="10"></td>
          <td  height="10">
          
          <button name="Login_Reprint" class="Button1" id="button1" data-placement="right" type="submit" title="Click to Add Payment"><i class="icon-plus-sign icon-large">Pay</i></button>
          
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
