<script>
function sync(){
var sname = document.getElementById('sname');
var sname1 = sname.value;
var userID = document.getElementById('sid');
var number = Math.floor(Math.random() * 100) +4;
userID.value = sname1+number;
userID.value.changeToUpperCase();
}
</script>

<?php

if(isset($_POST['addStaff'])){ 
$title = $_POST['stitle'] ; $sname = ucfirst($_POST['sname']) ; $mname = $_POST['mname'] ; $oname = $_POST['oname'] ; $sex = $_POST['sex'];
$Mstatus = $_POST['Mstatus'] ; $dob = $_POST['dob'] ; $hobbies = $_POST['hobbies'] ; $sheight = $_POST['shight'];
$eaddress = $_POST['eaddress'] ; $paddress = $_POST['paddress'] ; $caddress = $_POST['caddress'] ;$phone = $_POST['phone'] ;
$stown = $_POST['stown'] ; $lga = $_POST['lga'] ; $state = $_POST['state'] ; $nation = ucfirst($_POST['nation']);
$jdesc = $_POST['jdesc'] ; $addjob = $_POST['addjob'] ; $heq = $_POST['heq'] ; $Cstudy = $_POST['cstudy'];
$doe = $_POST['doe'] ; $acctnum = $_POST['acctnum'] ; $fac1 = $_POST['fac1'] ; $dept1 = $_POST['dept1'];
$moe = $_POST['moe'] ; $bname = $_POST['bname'] ;$acctname = $_POST['acctname'] ; $scode = $_POST['scode'] ; $sid = $_POST['sid'];
$image_find = $_POST['pic'] ; $Cverify = $_POST['Cverify'] ; $time=date('l jS \of F Y h:i:s A');
$webaddress=$_SERVER['HTTP_HOST'];  $exists = imgExists($image_find);
if($jdesc=="Others"){ $jobn = $addjob;}else{$jobn = $jdesc;}
 $hashpass = substr(md5($sid.SUDO_M),14);
$query = mysqli_query($condb,"select * from staff_details where usern_id = '$sid' ")or die(mysqli_error($condb));
$count = mysqli_num_rows($query);
$config = mysqli_fetch_array(mysqli_query($condb,"SELECT * FROM schoolsetuptd "));
	$sql_email_check = mysqli_query($condb,"SELECT * FROM staff_details WHERE email='$eaddress' LIMIT 1");
	$email_check = mysqli_num_rows($sql_email_check);
	
	$sql_phone_check = mysqli_query($condb,"SELECT * FROM staff_details WHERE phone='$phone' LIMIT 1");
	$phone_check = mysqli_num_rows($sql_phone_check);

if ($count > 0){ 
	message("ERROR:This Employee Username Already Exist,Try Again!", "error");
		       redirect('add_Staff.php?view=addStaff');
}elseif(!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/", $eaddress)){
		message("ERROR:Please! Provide a valid Email Address!", "error");
		       redirect('add_Staff.php?view=addStaff');
				
}elseif ($email_check > 0){ 
		message("ERROR:  This Email Address is already in use inside our system. Please try another!", "error");
		       redirect('add_Staff.php?view=addStaff');
			
				}	elseif ($phone_check > 0){ 
		message("ERROR:  This Phone Number is already in use inside our system. Please try another!", "error");
		       redirect('add_Staff.php?view=addStaff');}

else{
$ppic     = $_FILES['pic']['name'];
$spic     = $_FILES['signimg']['name'];
$extn = strtolower(pathinfo($ppic, PATHINFO_EXTENSION));
$extn2 = strtolower(pathinfo($spic, PATHINFO_EXTENSION));
$images = uploadProductImage('pic','./uploads/');
$thumbnail = "uploads/".$images['thumbnail'];
$images2 = uploadProductImage('signimg','./signimg/');
$thumbnail2 = "signimg/".$images2['thumbnail'];


//if($jdesc=="Others"){
    
if($ev_actives == '1') {

$msg = nl2br("Dear $title $sname $mname $oname,.\n
	This Message was Sent From " .$schoolNe ." @ ".$_SERVER['HTTP_HOST']." dated ".date('d-m-Y').".\n
	..................................................................\n
	Your Information was Successfuly Added !.\n
	User Name:   ".$sid."\n
	User Status: No Access \n
	Date: ".$time."\n
	..................................................................\n
	For inquiry and complaint please email ".$infomail." \n
	Thank You Admin!\n\n");
	$subject="Staff Account Information  "; 
//define the headers we want passed. Note that they are separated with \r\n
/* $headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
 $headers      .= "From:Message From Admin\r\n $subject <$from>\r\n";
 'Reply-To: '.$replyto ."\r\n" .
                   'Return-Path: The Sender: '. $from ."\r\n" .
                   'X-Priority: 3\r\n'.
                   //'Reply-To: '.$from."\r\n" .
                   'X-Mailer: PHP/' . phpversion(); */

 //define the body of the message.
ob_start(); //Turn on output buffering

				    if(!in_array($extn, array('jpg','jpeg','png','gif')) && $_FILES['pic']['tmp_name']!='' ){
 	message("Invalid Pics file type. Only  JPG, GIF and PNG types are accepted", "error");
		        redirect('add_Staff.php?view=addStaff');
                	}elseif(!in_array($extn2, array('jpg','jpeg','png','gif'))  && $_FILES['signimg']['tmp_name']!=''){
message("Invalid sign file type. Only  JPG, GIF and PNG types are accepted", "error");
		        redirect('add_Staff.php?view=addStaff');
}else{
//@mail($eaddress, $subject, $msg, $headers);
$mail_data = array('to' => $eaddress, 'sub' => $subject, 'msg' => 'Notify','body' => $msg, 'srname' => $comn);
	send_email($mail_data);
mysqli_query($condb,"insert into staff_details (title,sname,mname,oname,mstatus,Gender,dob,hobbies,height,phone,email,paddress,caddress,town,lga,state,nation,job_desc,heq,cos,s_fac,s_dept,doe,e_mode,b_name,b_acct_name,b_acct_num,b_sort,usern_id,image,sign_img,r_status) values('".safee($condb,$title)."','".safee($condb,$sname)."','".safee($condb,$mname)."','".safee($condb,$oname)."','".safee($condb,$Mstatus)."','".safee($condb,$sex)."','".safee($condb,$dob)."','".safee($condb,$hobbies)."','".safee($condb,$sheight)."','".safee($condb,$phone)."','".safee($condb,$eaddress)."','".safee($condb,$paddress)."','".safee($condb,$caddress)."','".safee($condb,$stown)."','".safee($condb,$lga)."','".safee($condb,$state)."','".safee($condb,$nation)."','".safee($condb,$jobn)."','".safee($condb,$heq)."','".safee($condb,$Cstudy)."','".safee($condb,$fac1)."','".safee($condb,$dept1)."','".safee($condb,$doe)."','".safee($condb,$moe)."','".safee($condb,$bname)."','".safee($condb,$acctname)."','".safee($condb,$acctnum)."','".safee($condb,$scode)."','".safee($condb,$sid)."','".safee($condb,$thumbnail)."','".safee($condb,$thumbnail2)."','".safee($condb,$Cverify)."')")or die(mysqli_error($condb));
	message("New Staff [$sname $oname $oname] was Successfully Added", "success");
		       redirect('add_Staff.php?view=Employeelist');
		       mysqli_query($condb,"insert into activity_log (date,username,action) values(NOW(),'$admin_username','Staff Details of $sname $oname with staff id $sid  was Add')")or die(mysqli_error($condb));
 }

				}else{if(!in_array($extn, array('jpg','jpeg','png','gif'))&& $_FILES['pic']['tmp_name']!='' ){
 	message("Invalid Pics file type. Only  JPG, GIF and PNG types are accepted", "error");
		        redirect('add_Staff.php?view=addStaff');
                	}elseif(!in_array($extn2, array('jpg','jpeg','png','gif'))&& $_FILES['signimg']['tmp_name']!=''){
message("Invalid sign file type. Only  JPG, GIF and PNG types are accepted", "error");
		        redirect('add_Staff.php?view=addStaff');
}else{ 
    mysqli_query($condb,"insert into staff_details (title,sname,mname,oname,mstatus,Gender,dob,hobbies,height,phone,email,paddress,caddress,town,lga,state,nation,job_desc,heq,cos,s_fac,s_dept,doe,e_mode,b_name,b_acct_name,b_acct_num,b_sort,usern_id,image,sign_img,r_status) values('".safee($condb,$title)."','".safee($condb,$sname)."','".safee($condb,$mname)."','".safee($condb,$oname)."','".safee($condb,$Mstatus)."','".safee($condb,$sex)."','".safee($condb,$dob)."','".safee($condb,$hobbies)."','".safee($condb,$sheight)."','".safee($condb,$phone)."','".safee($condb,$eaddress)."','".safee($condb,$paddress)."','".safee($condb,$caddress)."','".safee($condb,$stown)."','".safee($condb,$lga)."','".safee($condb,$state)."','".safee($condb,$nation)."','".safee($condb,$jobn)."','".safee($condb,$heq)."','".safee($condb,$Cstudy)."','".safee($condb,$fac1)."','".safee($condb,$dept1)."','".safee($condb,$doe)."','".safee($condb,$moe)."','".safee($condb,$bname)."','".safee($condb,$acctname)."','".safee($condb,$acctnum)."','".safee($condb,$scode)."','".safee($condb,$sid)."','".safee($condb,$thumbnail)."','".safee($condb,$thumbnail2)."','".safee($condb,$Cverify)."')")or die(mysqli_error($condb));
	message("New Staff [$sname $oname $oname] was Successfully Added".$images['thumbnail'].' '.$images2['thumbnail'], "success");
		       redirect('add_Staff.php?view=Employeelist');
		       mysqli_query($condb,"insert into activity_log (date,username,action) values(NOW(),'$admin_username','Staff Details of $sname $oname with staff id $sid  was Add')")or die(mysqli_error($condb));
 }
}


 
// ob_start();

}

}
?>

<?php 

//@$cat=$_GET['fac1']; 
					//if(isset($cat) and strlen($cat) > 0){
//$resultdep = mysqli_query($condb,"SELECT DISTINCT d_name FROM dept where fac_did=$cat ORDER BY d_name  ASC"); 
 //}
 
?>
<?php
//$myreturn=explode(";",$_COOKIE['return']);
?>

                    <form id="form_name"   method="post" enctype="multipart/form-data" data-parsley-validate >
<input type="hidden" name="insidf" value="<?php echo $_SESSION['insidf'];?> " />
               
<div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
					  <label for="heard">Title:</label>
                      
                          <select name='stitle' id="stitle" class="form-control" required>
                            <option value="">Select Title</option>
                            <option value="Prof">Professor</option>
                             <option value="Dr">Doctor</option>
                            <option value="Mr">Mr</option>
                            <option value="Mrs">Mrs</option>
                            <option value="Miss">Miss</option>
                            <option value="Engr">Engineer</option>
                            <option value="Arch">Architect</option>
                            <option value="Amb">Ambassador</option><option value="Bar">Barrister</option><option value="Bishop">Bishop</option><option value="Dame">Dame</option><option value="Rev">Reverend</option><option value="Senator">Senator</option>
                           
                          
                          </select> </div>
                          
                     <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Surname </label>
                            	  <input type="text" class="form-control " name='sname' id="sname" onkeyup="sync()" onchange="sync()"  required="required">
                      </div>
                      
                      <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
						  	  <label for="heard">First Name </label>
                            	  <input type="text" class="form-control " name='mname' id="mname"  required="required" >
                      </div>
                      
                      <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Other Name </label>
                            	  <input type="text" class="form-control " name='oname' id="oname"  >
                      </div>
                      
                      <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
					  <label for="heard">Gender</label>
                      
                          <select name='sex' id="sex" class="form-control" required>
                            <option value="">Select..</option>
                            <option value="M">Male</option>
                            <option value="F">Female</option>
                          
                          </select> </div>
                             <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
					  <label for="heard">Marital Status</label>
                      
                          <select name='Mstatus' id="Mstatus" class="form-control" required>
                            <option value="">Select Marital Status</option>
                            <option value="Single">Single</option>
                            <option value="Married">Married</option>
                              <option value="Widow">Widow</option>
                            <option value="Widower">Widower</option>
                            <option value="Divorcy">Divorcy</option>
                          
                          </select> </div>
                          
                        <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Date Of Birth</label>
<input  type="text" name="dob" size="29"   class="w8em format-d-m-y highlight-days-67 range-middle-today" id="ed"   readonly="readonly" style="height:32px;"></div>
<!--  <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
                              	  <label for="heard">Date Of Birth</label>
  <input type="text" name="dob" size="28"  class="w8em format-d-m-y highlight-days-67 range-middle-today" id="ed"  aria-describedby="inputSuccess2Status4"> </div> --!>
                            <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Hobbies</label>
                            	  <input type="text" class="form-control " name='hobbies' id="hobbies"  >
                      </div>
                      <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Staff Height</label>
                            	  <input type="text" class="form-control " name='shight' id="hobbies"  >
                      </div>
                     
                          <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Mobile Number</label>
                            	  <input type="text" class="form-control " name='phone' id="phone"  required="required" onkeypress="return isNumber(event);">
                      </div>
                       <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Email Address</label>
                            	  <input type="text" class="form-control " name='eaddress' id="eaddress" required>
                      </div>
                      <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Postal Address</label>
                            	  <input type="text" class="form-control " name='paddress' id="paddress"  >
                      </div>
                     <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Contact Address</label>
                            	  <input type="text" class="form-control " name='caddress' id="caddress"  >
                      </div>
                    <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Town/City</label>
                            	  <input type="text" class="form-control " name='stown' id="stown" required >
                      </div>
<div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
						  	  <label for="heard">State</label>
                        <select name="state" id="state" onchange='loadlga(this.name);return false;' class="form-control " required>
              <option value="" selected="selected">- Select -</option>
              <option value="Abuja FCT">Abuja FCT</option>
              <option value="Abia">Abia</option>
              <option value="Adamawa">Adamawa</option>
              <option value="Akwa Ibom">Akwa Ibom</option>
              <option value="Anambra">Anambra</option>
              <option value="Bauchi">Bauchi</option>
              <option value="Bayelsa">Bayelsa</option>
              <option value="Benue">Benue</option>
              <option value="Borno">Borno</option>
              <option value="Cross River">Cross River</option>
              <option value="Delta">Delta</option>
              <option value="Ebonyi">Ebonyi</option>
              <option value="Edo">Edo</option>
              <option value="Ekiti">Ekiti</option>
              <option value="Enugu">Enugu</option>
              <option value="Gombe">Gombe</option>
              <option value="Imo">Imo</option>
              <option value="Jigawa">Jigawa</option>
              <option value="Kaduna">Kaduna</option>
              <option value="Kano">Kano</option>
              <option value="Katsina">Katsina</option>
              <option value="Kebbi">Kebbi</option>
              <option value="Kogi">Kogi</option>
              <option value="Kwara">Kwara</option>
              <option value="Lagos">Lagos</option>
              <option value="Nassarawa">Nassarawa</option>
              <option value="Niger">Niger</option>
              <option value="Ogun">Ogun</option>
              <option value="Ondo">Ondo</option>
              <option value="Osun">Osun</option>
              <option value="Oyo">Oyo</option>
              <option value="Plateau">Plateau</option>
              <option value="Rivers">Rivers</option>
              <option value="Sokoto">Sokoto</option>
              <option value="Taraba">Taraba</option>
              <option value="Yobe">Yobe</option>
              <option value="Zamfara">Zamfara</option>
     <option value="Outside Nigeria">Outside Nigeria</option>
            </select>
                      </div>
                      <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Local Government </label>
                            <select class="form-control"  name="lga" id="lga"  required>
                            	  <option value="" selected="selected" >Select LGA</option></select>
                      </div>
                      <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Nationality</label>
                            	  <input type="text" class="form-control " name='nation' id="nation"  >
                      </div>
                      
                       <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Job Description </label>
                            	 <select name='jdesc' id="jdesc" class="form-control" required>
                            <option value="">Select..</option>
<?php  
$resultpro = mysqli_query($condb,"SELECT DISTINCT job_desc FROM  staff_details where job_desc <> ''  ORDER BY job_desc  ASC");
while($rspro = mysqli_fetch_array($resultpro))
{ echo "<option value='$rspro[job_desc]'>$rspro[job_desc]</option>";	}
?>
                            <option value="Others">Add Job Description</option>
                          
                          </select> 
                      </div>
                      
                      <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback" style="display: none;" id="addjob0" >
						  	  <label for="heard" >Add Job Description</label>
                            	  <input type="text" class="form-control " name='addjob' id="addjob" style="display: none;"  >
                            	  
                      </div>
					  <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Highest Education Qualification</label>
                            	  <select name='heq' id="heq" class="form-control" >
                            <option value="">Select..</option>
                            <option value="Olevel">Olevel</option>
                            <option value="OND">OND</option>
                            <option value="HND">HND</option>
                            <option value="BSC">BSC</option>
                              <option value="MSC">MSC</option>
                                <option value="PHD">PHD</option>
                                 <option value="Others">Others</option>
                          
                          </select>
                      </div>
                       <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Course Studied</label>
                            	  <input type="text" class="form-control " name='cstudy' id="cstudy"  >
                      </div>
					    <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback" >
					    
						  	  <label for="heard"><?php echo $SCategory; ?> </label>
						  	  
                            	  <select name='fac1' id="fac1" onchange='loadDept(this.name);return false;' class="form-control" >
                            <option value="">Select <?php echo $SCategory; ?></option>
                            <?php  
//$resultfac = mysqli_query($condb,"SELECT DISTINCT fac_name,fac_id FROM faculty ORDER BY fac_name ASC");
//while($rsfac = mysqli_fetch_array($resultfac))
//{  
//if($rsfac['fac_id']==@$cat){echo "<option selected value='$rsfac[fac_id]'>$rsfac[fac_name]</option>"."<BR>";}
//else{echo "<option value='$rsfac[fac_id]'>$rsfac[fac_name]</option>";}
//}

$resultblocks = mysqli_query($condb,"SELECT DISTINCT fac_name,fac_id FROM faculty ORDER BY fac_name ASC");
//$counter=1;
while($rsblocks = mysqli_fetch_array($resultblocks))
{
	if($_GET['loadfac'] ==$rsblocks['fac_id'] )
	{
	echo "<option value='$rsblocks[fac_id]' selected>$rsblocks[fac_name]</option>";
//	$counter=$counter+1;
	}
	else
	{
	echo "<option value='$rsblocks[fac_id]'>$rsblocks[fac_name]</option>";
	//$counter=$counter+1;
	}
}
?>
                            
                          
                          </select>
                      </div>
                     
                      
                      <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
                       
						  	  <label for="heard"><?php echo $SGdept1; ?></label>
                            	  <select name='dept1' id="dept1" class="form-control"  >
                           <option value=''>Select <?php echo $SGdept1; ?></option>
                          </select>
                      </div>
                      
                       <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Date Of Employement</label>
                            	    <input  type="text" name="doe" size="29"   class="w8em format-d-m-y highlight-days-67 range-middle-today" id="ed1"   readonly="readonly" style="height:32px;">
                            	  
                      </div>
                      
                      <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Mode Of Employment</label>
                            	  <select name='moe' id="moe" class="form-control" >
                            <option value="">Select..</option>
                            <option value="FulL Time">FulL Time</option>
                            <option value="Part Time">Part Time</option>
                            <option value="Contract Staff">Contract Staff</option>
                          
                          </select>
                      </div>
                      <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Employee Bank Name </label>
                            	  <input type="text" class="form-control " name='bname' id="bname"  >
                      </div>
                      <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Employee Account Name </label>
                            	  <input type="text" class="form-control " name='acctname' id="acctname"  >
                      </div>
                      <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Employee Account Number </label>
                            	  <input type="text" class="form-control " name='acctnum' id="acctnum" onkeypress="return isNumber(event);"  >
                      </div>
                      <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Bank Sort Code </label>
                            	  <input type="text" class="form-control " name='scode' id="scode" onkeypress="return isNumber(event);"  >
                      </div>
					 
                      
                      
                          <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Employee Username</label>
                            	  <input type="text" class="form-control " name='sid' id="sid" required >
                      </div>
						  
						  
                      
                      
                     <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
					  <label for="heard">Record Status</label>
                      
                          <select name='Cverify' id="Cverify" class="form-control" required>
                            <option value="">Select..</option>
                            <option value="2">Verified</option>
                            <option value="0">Not Verified</option>
                          
                          </select> </div>
                          
                          <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Upload Employee Photo </label>
                            	<input name="pic" class="input-file uniform_on" id="fileInput" type="file" >
                      </div>
             <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Upload Employee Signature </label>
                            	<input name="signimg" class="input-file uniform_on" id="fileInput" type="file" >
                      </div>
                      <div  class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback"><?php   if (authorize($_SESSION["access3"]["sMan"]["aes"]["create"])){ ?> 
                      <button type="submit" name="addStaff"  id="save" data-placement="right" class="btn btn-primary " title="Click Here to Save Details" ><i class="fa fa-sign-in"></i> Save</button>
                        
                        <script type="text/javascript">
	                                            $(document).ready(function(){
	                                            $('#save').tooltip('show');
	                                            $('#save').tooltip('hide');
	                                            });
	                                            </script> <?php } ?>
                                                <a href="#" onclick="window.open('add_Staff.php?view=Employeelist','_self')" class="btn btn-info"  id="delete2" data-placement="right" title="Click to Go back" ><i class="fa fa-backward icon-large"></i> Go back</a>
						
	                                            <div class='imgHolder2' id='imgHolder2'><img src='uploads/tabLoad.gif'></div>
                        </div>
                        
             
                    </form>
             
                  