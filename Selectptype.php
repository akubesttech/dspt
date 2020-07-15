<script type="text/javascript">   
$(document).ready(function() {   
$('#paytype').change(function(){   
if($('#paytype').val() === 'Paycard')   
   {   
   $('#pin').show();   $('#pin2').show();    $('#pin3').show(); $('#pin4').show(); $('#pin5').show();$('#pin1').show();
   }   
else 
   {   
   $('#pin').hide();    $('#pin2').hide();    $('#pin3').hide();  $('#pin4').hide();  $('#pin5').hide();  $('#pin1').hide();
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

	//function createRandomPassword() {
//$chars = "abcdefghijkmnopqrstuvwxyz023456789";
//srand((double)microtime()*1000000);$i = 0;$pass = '' ;while ($i <= 7) {
//$num = rand() % 33;$tmp = substr($chars, $num, 1);$pass = $pass . $tmp;$i++;}
//return $pass;}


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
	//$_SESSION['sessionpay']=$Session_checker1;

	$sql_load="SELECT * FROM new_apply1 WHERE Asession ='".safee($condb,$Session_checker1)."' AND appNo ='".safee($condb,$nappNo21)."' or JambNo ='".safee($condb,$nappNo21)."' and adminstatus ='1'";$result_load = mysqli_query($condb,$sql_load);
$num_pinr = mysqli_num_rows($result_load);
$find_student = mysqli_fetch_array($result_load);
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
$sql2="SELECT * FROM pin_fee WHERE pinnumber='".safee($condb,$Pin)."' AND status='NOTUSED'";
$result10=mysqli_query($condb,$sql2);
$numPin=mysqli_num_rows($result10);
$loadfeeamount=mysqli_query($condb,"SELECT * FROM fee_db WHERE f_dept ='".safee($condb,$pdepart)."'  AND feetype ='School fee' AND program ='".safee($condb,$programs)."'");
$find_amountp = mysqli_fetch_array($loadfeeamount); $payamount2 = $find_amountp['f_amount'];
$paystatus1=mysqli_query($condb,"SELECT * FROM payment_tb WHERE app_no ='$nappNo21'  AND session='".safee($condb,$Session_checker1)."' AND level ='".safee($condb,$level)."'");
$paystatus12=mysqli_num_rows($paystatus1);$paystatus13=mysqli_fetch_array($paystatus1); $appnop =$paystatus13['app_no'];
$paystatuspin=mysqli_query($condb,"SELECT * FROM payment_tb WHERE pin ='$Pin' and app_no ='".safee($condb,$nappNo21)."' AND session='".safee($condb,$Session_checker1)."' AND level ='".safee($condb,$level)."'  ");
$paystatus13 =mysqli_num_rows($paystatuspin);
$sql_appNo_check = mysqli_query($condb,"SELECT * FROM new_apply1 WHERE appNo='".safee($condb,$nappNo21)."' and adminstatus ='1' or JambNo='".safee($condb,$nappNo21)."' ");
$appNo_check = mysqli_num_rows($sql_appNo_check);
$sql_session_check = mysqli_query($condb,"SELECT Asession FROM new_apply1 WHERE  appNo='".safee($condb,$nappNo21)."' and Asession ='".safee($condb,$Session_checker1)."' or JambNo ='".safee($condb,$nappNo21)."'");
$session_check = mysqli_num_rows($sql_session_check);
$_SESSION['tempserial']=$num_serialNo;
		if ($appNo_check < 1){ 
		message("ERROR: Your ".$nappNo21." Number is Incorrect or Not Admitted please Comfirm and try Again", "error");
		        redirect('apply_b.php?view=M_P');
}elseif(strpos($nappNo21," ")){
message("Please! Application Id can not Contain a Space", "error");
		        redirect('apply_b.php?view=M_P');
}elseif($session_check < 1){
				message("ERROR:  This Student Record was Not Found in ".$Session_checker1." Session", "error");
		        redirect('apply_b.php?view=M_P');
//}elseif($paystatus12 > 0 ){
//message("The Student with ".$nappNo21."  Has Paid For $Session_checker1 Session", "error");
		        //redirect('apply_b.php?view=M_P');
}else{

//$_SESSION['paydepart'] = $pdepart;
$_SESSION['spayid'] = $nappNo21;
//$_SESSION['Fnamep'] = $payeefullname;
//$_SESSION['mobile'] = $phonepay;
//$_SESSION['emailp'] = $payemail;
//$_SESSION['sfee'] = "School fee";
//$_SESSION['amount'] = $payamount2;
		echo "<script>window.location.assign('apply_b.php?view=lpay&p_id=".md5($nappNo21)."');</script>";
	}}
	
?>
   <section id="content" role="document">
        <main style="min-height: 168px;">
                    <div class="container">
                        

<div class="row">
    <div class="col-xs-12">
        <div id="breadcrumbs-share">
            <section id="breadcrumbs">
                <ul class="breadcrumb">
                                <li><a href="<?php echo host(); ?>">Home</a> </li>

                </ul>
            </section>
        </div>
    </div>
</div>
                    </div>

<div class="container">
    <div class="row">
        <div class="col-xs-12 col-md-9 link-icons">
            <div class="row">
                <div class="col-xs-12">
            <h3>Payment Panel For Newly Admitted Students </h3>
        </div>
        <div class="col-xs-12 primary-content link-icons">
<p class="first-paragraph">This page will Enable New student(s) To Make payment of Fee (s) and also Reprint Payment Receipt .</p>
                </div>
                
        <div class="margin-md-top row cards section-cards">
           <div class="col-xs-12">
           
            <div class="row nopadding nomargin" id="cards">
            
					<!-- form window  --!>	
	
        	<div class="panel panel-default">
        		<div class="panel-heading">
			    		<!-- <h3 class="panel-title">Please sign up for Bootsnipp <small>It's free!</small></h3> --!>
			    		<h4 class="panel-title">Student Payment Details   </h4>
			 			</div>
			 			
			 			<div class="panel-body">
			    	<form name="register2" action="" method="post" enctype="multipart/form-data" id="register2">
			    			<div class="row">
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<label class="head">Application No<span class="w3l-star"> * </span></label>
			    					<div class="form-group">
			        
			                <input type="text" name="nappNo21" id="nappNo21" required="required" autocomplete="off" class="form-control input-sm">
			    					</div>
			    				</div>
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<label class="head">Session<span class="w3l-star"> * </span></label>
			    					<div class="form-group">
			    					<select class="form-control input-sm"   name="session" id="session"  required="required">
  <option value="">Select Session</option>
  
<?php  
$resultsec = mysqli_query($condb,"SELECT * FROM session_tb  ORDER BY session_name ASC");
while($rssec = mysqli_fetch_array($resultsec))
{
echo "<option value='$rssec[session_name]'>$rssec[session_name]</option>";	
}
?>
</select>
			    					</div>
			    				</div>
			    			</div>

			    		<!--	<div class="row">
			    				
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    				<label class="head">Level<span class="w3l-star"> * </span></label>
			    					<div class="form-group">
			    					<select class="form-control input-sm"   name="plevel" id="plevel"  required="required">
  <option value="">Select Level</option>
<?php 
$resultsec2 = mysqli_query($condb,"SELECT * FROM level_db where level_order='100' ORDER BY level_order ASC");
while($rssec2 = mysqli_fetch_array($resultsec2))
{ echo "<option value='$rssec2[level_order]'>$rssec2[level_name]</option>";	}
?>	
</select>
			    					</div>
			    				</div>
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    				<label class="head">Mode of Payment<span class="w3l-star"> * </span></label>
			    					<div class="form-group">
			    			<select name="paytype" id="paytype"  required="required" class="form-control input-sm">
    
  <option value="">Select</option>
    <option value="Paycard">E-Paycard</option>
    <option value="Online">Online Payment</option>
  </select>
			    					</div>
			    				</div>
			    			</div>--!>
			    			<div class="row" style="display: none;" id="pin">
			    				<div class="col-xs-6 col-sm-6 col-md-6" >
			    				<label class="head">Card Pin<span class="w3l-star"> * </span></label>
			    					<div class="form-group">
		<input type="text" name="pin" onkeypress="return isNumber(event);" id="pin"  class="form-control input-sm"></div>
			    				</div>
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    				<label class="head">Bank Name<span class="w3l-star"> * </span></label>
			    					<div class="form-group">
			    					<div  id="txtroomno" >
			  <?php $query2 = "SELECT * FROM bank";
 $result2 = mysqli_query($condb,$query2); 
 ?> 
<select   name="bank" class="form-control input-sm" ><option selected="selected" value="" disabled="disabled">--- Select  Bank---</option>
<?php while ($line2 = mysqli_fetch_array($result2, MYSQLI_ASSOC))
  { 
  ?>
  
  <option value="<?php echo $line2['b_name'];?>"> <?php echo $line2['b_name'];?> </option>

<?php } 
?>  
    </select>
			 </div>
			    					</div>
			    				</div>
			    			</div>
			    			
			    				<div class="row" style="display: none;" id="pin5">
			    				<div class="col-xs-6 col-sm-6 col-md-6" >
			    				<label class="head">Teller No</label>
			    					<div class="form-group">
		<input type="text" name="tellerno" id="tellerno"  class="form-control input-sm"></div>
			    				</div>
			    				
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    				<label class="head">Date of Payment</label>
			    					<div class="form-group">
			    				<input  type="text" name="end_date" style='width:190px;' class="input-file uniform_on w8em format-d-m-y highlight-days-67 range-middle-today " id="ed"   readonly="readonly" ></div>
			    				</div></div>
			    					<div class="row">
			    				<div class="col-xs-6 col-sm-6 col-md-6" style="display: none;" id="pin4">
			    				<label class="head">Amount</label>
			    					<div class="form-group">
		<input type="text" name="paidamt" id="paidamt" class="form-control input-sm" onkeypress="return isNumber(event);" >
			    				</div>
			    			</div>
							<div class="col-xs-6 col-sm-6 col-md-6" style="display: none;" id="pin3">
			    				<label class="head">Upload Teller</label>
			    					<div class="form-group">
		<input name="image_name" class="input-file uniform_on" id="fileInput" type="file" accept="image/*" onchange="preview_image(event)" style="width:200px;">
			    				</div>
			    		</div>
			    			
							</div>
								<div class="row">
									<div class="col-xs-6 col-sm-6 col-md-6" style="display: none;" id="pin1">
									<div class="otherinputs">
<div class="fileinput-new thumbnail" style="width: 200px; height: 120px; border: 1px solid #0080e5;">
<img src='' alt='Note : File size should not be Greater than 300kb' id='output_image' style='width:200px;height: 120px;'>
 </div> </div> </div></div>
 
	<button name="Login_Reprint" class="btn btn-primary" data-placement="right" type="submit" title="Click to Continue">Continue</button>
	
            <button name="Reprint" class="btn btn-primary" data-placement="right" type="button"  title="Click  To Exit " onClick="window.location.href='<?php echo host(); ?>';">Close</button>
			    			
			    		
			    		</form>
			    	</div>
	    		</div>
    	
    	
    
    	
    	
						
                </div>
                
                
            </div>
        </div>



            </div>
            
        </div>
        <div class="col-xs-12 col-md-3 sidebar-right margin-lg-bottom">
           
 <?php include("sidenews.php"); ?>
</div>
            
        </div>
    </div>
</div>


        </main>
    </section>
    
  