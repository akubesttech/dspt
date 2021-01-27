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

<script type="text/javascript">   

</script>

<?php
								$query_staff = mysqli_query($condb,"select * from staff_details where staff_id='".safee($condb,$get_RegNo)."' ")or die(mysqli_error($condb));
								$row_staff = mysqli_fetch_array($query_staff);   
                                $picget = $row_staff['image']; $signimg = $row_staff['sign_img'];
								 $exists = imgExists($picget); $exists_sign = imgExists($signimg);
								?>
<?php
if(isset($_POST['addStaff'])){
$sname = ucfirst($_POST['sname']) ; $mname = $_POST['mname'] ; $oname = $_POST['oname'] ; $sex = $_POST['sex'];
$Mstatus = $_POST['Mstatus'] ; $dob = $_POST['dob'] ; $hobbies = $_POST['hobbies'] ; $sheight = $_POST['shight'];
$eaddress = $_POST['eaddress'] ; $paddress = $_POST['paddress'] ; $caddress = $_POST['caddress'] ;$phone = $_POST['phone'] ;
$stown = $_POST['stown'] ; $lga = $_POST['lga'] ; $state = $_POST['state'] ; $nation = ucfirst($_POST['nation']);
$jdesc = $_POST['jdesc'] ; $addjob = $_POST['addjob'] ; $heq = $_POST['heq'] ; $Cstudy = $_POST['cstudy'];
$doe = $_POST['doe'] ; $acctnum = $_POST['acctnum'] ; $fac1 = $_POST['fac2'] ; $dept1 = $_POST['dept1'];
$moe = $_POST['moe'] ; $bname = $_POST['bname'] ;$acctname = $_POST['acctname'] ; $scode = $_POST['scode'] ; $sid = $_POST['sid'];
 $o_qual = $_POST['o_qual'] ; $title = $_POST['stitle']; $s_posi = $_POST['s_posi'] ;
 $Cverify = $_POST['Cverify'] ; $time=date('l jS \of F Y h:i:s A');
$webaddress=$_SERVER['HTTP_HOST'];
if($jdesc=="Others"){ $jobn = $addjob;}else{$jobn = $jdesc;}

//$from = "support@edu.smartdelta.ng";
$query = mysqli_query($condb,"select * from staff_details where usern_id = '$sid' ")or die(mysqli_error($condb));
$count = mysqli_num_rows($query);
$config = mysqli_fetch_array(mysqli_query($condb,"SELECT * FROM schoolsetuptd "));
	$sql_email_check = mysqli_query($condb,"SELECT * FROM staff_details WHERE email='$eaddress' LIMIT 1");
	$email_check = mysqli_num_rows($sql_email_check);
	
	$sql_phone_check = mysqli_query($condb,"SELECT * FROM staff_details WHERE phone='$phone' LIMIT 1");
	$phone_check = mysqli_num_rows($sql_phone_check);
	


	
if ($count > 1){ 
	message("ERROR: This Employee Username Already Exist,Try Again!", "error");
		       redirect('add_Staff.php?id='.$get_RegNo);
}elseif(!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/", $eaddress)){
		message("ERROR: Please! Provide a valid Email Address!", "error");
		      redirect('add_Staff.php?id='.$get_RegNo);
			}elseif ($email_check > 1){ 
				message("ERROR:  This Email Address is already in use inside our system. Please try another!", "error");
		      redirect('add_Staff.php?view=editStaff&id='.$get_RegNo);
			}	elseif ($phone_check > 1){ 
		message("ERROR:  This Phone Number is already in use inside our system. Please try another.!", "error");
		        redirect('add_Staff.php?view=editStaff&id='.$get_RegNo);
}else{
$ppic     = $_FILES['pic']['name'];
$spic     = $_FILES['signimg']['name'];
$extn = strtolower(pathinfo($ppic, PATHINFO_EXTENSION));
$extn2 = strtolower(pathinfo($spic, PATHINFO_EXTENSION));
if ($exists > 0){
if($_FILES['pic']['size'] == Null){ $thumbnail = $picget; }else{
unlink($picget);
$images = uploadProductImage('pic','./uploads/');
$thumbnail = "uploads/".$images['thumbnail'];}
}else{
if($_FILES['pic']['size'] == Null){ $thumbnail = ''; }else{
$images = uploadProductImage('pic','./uploads/');
$thumbnail = "uploads/".$images['thumbnail'];
} }
// sign image remove 
if ($exists_sign > 0){
if($_FILES['signimg']['size'] == Null){ $thumbnail2 = $signimg; }else{
unlink($signimg);
$images2 = uploadProductImage('signimg','./signimg/');
$thumbnail2 = "signimg/".$images2['thumbnail'];}
}else{
if($_FILES['signimg']['size'] == Null){ $thumbnail2 = ''; }else{
$images2 = uploadProductImage('signimg','./signimg/');
$thumbnail2 = "signimg/".$images2['thumbnail'];
} }



if($ev_actives == '1'){

$msg2 = nl2br("Dear $title $sname $mname $oname,.\n
	This Message was Sent  From " .$schoolNe ." @ ".$_SERVER['HTTP_HOST']." dated ".date('d-m-Y').".\n
	..................................................................\n
	Your Information was Successfuly Updated !.\n
	User Name:   ".$sid."\n
	User Status: No Access \n
	Date: ".$time."\n
	
	..................................................................\n
	For inquiry and complaint please email ".$infomail." \n
	Thank You Admin!\n\n");
    
//$random_hash = md5(date('r', time()));
$subject="Staff Information Update "; 
 
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
		        redirect('add_Staff.php?view=editStaff&id='.$get_RegNo);
                	}elseif(!in_array($extn2, array('jpg','jpeg','png','gif'))  && $_FILES['signimg']['tmp_name']!=''){
message("Invalid sign file type. Only  JPG, GIF and PNG types are accepted", "error");
		        redirect('add_Staff.php?view=editStaff&id='.$get_RegNo);
}else{
//@mail($eaddress, $subject, $msg, $headers);
$mail_data = array('to' => $eaddress, 'sub' => $subject, 'msg' => 'Notify','body' => $msg2, 'srname' => $comn);
	send_email($mail_data);
mysqli_query($condb,"update staff_details  set title='".safee($condb,$title)."',position='".safee($condb,$s_posi)."',oder_quali='".safee($condb,$o_qual)."',sname='".safee($condb,$sname)."',mname='".safee($condb,$mname)."',oname='".safee($condb,$oname)."',mstatus='".safee($condb,$Mstatus)."',Gender='".safee($condb,$sex)."',dob='".safee($condb,$dob)."',hobbies='".safee($condb,$hobbies)."',height='".safee($condb,$sheight)."',phone='".safee($condb,$phone)."',email='".safee($condb,$eaddress)."',paddress='".safee($condb,$paddress)."',caddress='".safee($condb,$caddress)."',town='".safee($condb,$stown)."',lga='".safee($condb,$lga)."',state='".safee($condb,$state)."',nation='".safee($condb,$nation)."',job_desc='".safee($condb,$jobn)."',heq='".safee($condb,$heq)."',cos='".safee($condb,$Cstudy)."',s_fac='".safee($condb,$fac1)."',s_dept='".safee($condb,$dept1)."',doe='".safee($condb,$doe)."',e_mode='".safee($condb,$moe)."',b_name='".safee($condb,$bname)."',b_acct_name='".safee($condb,$acctname)."',b_acct_num='".safee($condb,$acctnum)."',b_sort='".safee($condb,$scode)."',usern_id='".safee($condb,$sid)."',r_status='".safee($condb,$Cverify)."',image ='".safee($condb,$thumbnail)."',sign_img ='".safee($condb,$thumbnail2)."' where staff_id='".safee($condb,$get_RegNo)."'")or die(mysqli_error($condb));
mysqli_query($condb,"insert into activity_log (date,username,action) values(NOW(),'$admin_username','Staff Details of $sname $oname with staff id $sid  was Updated')")or die(mysqli_error($condb)); 
// ob_start();
	message("Staff Record of [$title $sname $mname $oname ] was Successfully Updated !"." a".$thumbnail." b".$thumbnail2, "success");
		        redirect('add_Staff.php?view=Employeelist');
}
				}else{
if(!in_array($extn, array('jpg','jpeg','png','gif'))&& $_FILES['pic']['tmp_name']!='' ){
 	message("Invalid Pics file type. Only  JPG, GIF and PNG types are accepted", "error");
		        redirect('add_Staff.php?view=editStaff&id='.$get_RegNo);
                	}elseif(!in_array($extn2, array('jpg','jpeg','png','gif'))&& $_FILES['signimg']['tmp_name']!=''){
message("Invalid sign file type. Only  JPG, GIF and PNG types are accepted", "error");
		        redirect('add_Staff.php?view=editStaff&id='.$get_RegNo);
}else{
mysqli_query($condb,"update staff_details  set title='".safee($condb,$title)."',position='".safee($condb,$s_posi)."',oder_quali='".safee($condb,$o_qual)."',sname='".safee($condb,$sname)."',mname='".safee($condb,$mname)."',oname='".safee($condb,$oname)."',mstatus='".safee($condb,$Mstatus)."',Gender='".safee($condb,$sex)."',dob='".safee($condb,$dob)."',hobbies='".safee($condb,$hobbies)."',height='".safee($condb,$sheight)."',phone='".safee($condb,$phone)."',email='".safee($condb,$eaddress)."',paddress='".safee($condb,$paddress)."',caddress='".safee($condb,$caddress)."',town='".safee($condb,$stown)."',lga='".safee($condb,$lga)."',state='".safee($condb,$state)."',nation='".safee($condb,$nation)."',job_desc='".safee($condb,$jobn)."',heq='".safee($condb,$heq)."',cos='".safee($condb,$Cstudy)."',s_fac='".safee($condb,$fac1)."',s_dept='".safee($condb,$dept1)."',doe='".safee($condb,$doe)."',e_mode='".safee($condb,$moe)."',b_name='".safee($condb,$bname)."',b_acct_name='".safee($condb,$acctname)."',b_acct_num='".safee($condb,$acctnum)."',b_sort='".safee($condb,$scode)."',usern_id='".safee($condb,$sid)."',r_status='".safee($condb,$Cverify)."',image ='".safee($condb,$thumbnail)."',sign_img ='".safee($condb,$thumbnail2)."' where staff_id='".safee($condb,$get_RegNo)."'")or die(mysqli_error($condb));
mysqli_query($condb,"insert into activity_log (date,username,action) values(NOW(),'$admin_username','Staff Details of $sname $oname with staff id $sid  was Updated')")or die(mysqli_error($condb)); 
// ob_start();
	message("Staff Record of [$title $sname $mname $oname ] was Successfully Updated !"." ".$thumbnail." ".$thumbnail2, "success");
		        redirect('add_Staff.php?view=Employeelist');
}}


}

}
?>

<?php 

@$cat=$_GET['fac1']; // Use this line or below line if register_global is off
//if(strlen($cat) > 0 and !is_numeric($cat)){ // to check if $cat is numeric data or not. 
//echo "Data Error";
//exit;
//}
						if(isset($cat) and strlen($cat) > 0){
$resultdep = mysqli_query($condb,"SELECT DISTINCT d_name FROM dept where fac_did=$cat ORDER BY d_name  ASC"); 
 }
?>
<?php
//$myreturn=explode(";",$_COOKIE['return']);
?>


                    <form id="form_name"   method="post" enctype="multipart/form-data" data-parsley-validate >
<input type="hidden" name="insidf" value="<?php echo $_SESSION['insidf'];?> " />
                      
                      
<div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
					  <label for="heard">Title:</label>
                      
                          <select name='stitle' id="stitle" class="form-control" required>
                            <option value="<?php echo $row_staff['title']; ?>"><?php echo $row_staff['title']; ?></option>
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
                            	  <input type="text" class="form-control " name='sname' id="sname" value="<?php echo $row_staff['sname']; ?>" required="required">
                      </div>
                      
                      <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
						  	  <label for="heard">First Name </label>
                            	  <input type="text" class="form-control " name='mname' id="mname"  required="required" value="<?php echo $row_staff['mname']; ?>">
                      </div>
                      
                      <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Other Name </label>
                            	  <input type="text" class="form-control " name='oname' id="oname" value="<?php echo $row_staff['oname']; ?>"  >
                      </div>
                      
                      <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
					  <label for="heard">Gender</label>
                      
                          <select name='sex' id="sex" class="form-control" required>
                            <option value="<?php echo $row_staff['Gender']; ?>"><?php if ($row_staff['Gender']='M'){
						
						echo 'Male';}else{echo 'Female';}
						 ?></option>
                            <option value="M">Male</option>
                            <option value="F">Female</option>
                          
                          </select> </div>
                             <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
					  <label for="heard">Marital Status</label>
                      
                          <select name='Mstatus' id="Mstatus" class="form-control" required>
                            <option value="<?php echo $row_staff['mstatus']; ?>"><?php echo $row_staff['mstatus']; ?></option>
                            <option value="Single">Single</option>
                            <option value="Married">Married</option>
                              <option value="Widow">Widow</option>
                            <option value="Widower">Widower</option>
                            <option value="Divorcy">Divorcy</option>
                          
                          </select> </div>
                          
                          <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Date Of Birth</label>
                            	 
                            	  <input  type="text" name="dob" size="30"   class="w8em format-d-m-y highlight-days-67 range-middle-today" id="ed" value="<?php echo $row_staff['dob']; ?>" style="height:32px;"   readonly="readonly">
                      </div>
                       <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Hobbies</label>
                            	  <input type="text" class="form-control " name='hobbies' id="hobbies" value="<?php echo $row_staff['hobbies']; ?>" >
                      </div>
                      <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Staff Height</label>
                            	  <input type="text" class="form-control " name='shight' id="hobbies" value="<?php echo $row_staff['height']; ?>"  >
                      </div>
                     
                          <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Mobile Number</label>
                            	  <input type="text" class="form-control " name='phone' id="phone"  required="required" value="<?php echo $row_staff['phone']; ?>" onkeypress="return isNumber(event);">
                      </div>
                       <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Email Address</label>
                            	  <input type="text" class="form-control " name='eaddress' id="eaddress" value="<?php echo $row_staff['email']; ?>" required>
                      </div>
                      <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Postal Address</label>
                            	  <input type="text" class="form-control " name='paddress' id="paddress" value="<?php echo $row_staff['paddress']; ?>"  >
                      </div>
                     <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Contact Address</label>
                            	  <input type="text" class="form-control " name='caddress' id="caddress" value="<?php echo $row_staff['caddress']; ?>"  >
                      </div>
                    <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Town/City</label>
                            	  <input type="text" class="form-control " name='stown' id="stown" value="<?php echo $row_staff['town']; ?>" required >
                      </div>
<div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
						  	  <label for="heard">State</label>
                        
                            	  <select name="state" id="state" onchange='loadlga(this.name);return false;' class="form-control " required>
              <option value="<?php echo $row_staff['state']; ?>" selected="selected"><?php echo $row_staff['state']; ?></option>
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
                            	  <option value="<?php echo $row_staff['lga']; ?>" selected="selected" ><?php echo $row_staff['lga']; ?></option></select>
                      </div>
                    <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Nationality</label>
                            	  <input type="text" class="form-control " name='nation' id="nation" value="<?php echo $row_staff['nation']; ?>"  >
                      </div>
                      
                       <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Job Description </label>
                            	 <select name='jdesc' id="jdesc" class="form-control" onchange="showjobedit(this.value)" required>
                            <option value="<?php echo $row_staff['job_desc']; ?>"><?php echo $row_staff['job_desc']; ?></option>
<?php  $resultpro = mysqli_query($condb,"SELECT DISTINCT job_desc FROM staff_details where job_desc <> ''   ORDER BY job_desc  ASC");
while($rspro = mysqli_fetch_array($resultpro)){ echo "<option value='$rspro[job_desc]'>$rspro[job_desc]</option>";	}?>
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
                            <option value="<?php echo $row_staff['heq']; ?>"><?php echo $row_staff['heq']; ?></option>
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
                            	  <input type="text" class="form-control " name='cstudy' id="cstudy" value="<?php echo $row_staff['cos']; ?>"  >
                      </div>
    
					    <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
						  	  <label for="heard"><?php echo $SCategory; ?></label>
						  	  <select name='fac2' id="fac2" onchange='loadDept(this.name);return false;' class="form-control" >
             <option value="<?php echo $row_staff['s_fac']; ?>"><?php echo getfacultyc($row_staff['s_fac']); ?></option>
                            <?php  

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
						  	  <label for="heard">Department</label>
                            <select name='dept1' id="dept1" class="form-control"  >
                           <option value="<?php echo $row_staff['s_dept']; ?>"><?php echo getdeptc($row_staff['s_dept']); ?></option>
                          </select>
                      </div>
                      
                       <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Date Of Employement</label>
                            	    <input  type="text" name="doe" size="30"   class="w8em format-d-m-y highlight-days-67 range-middle-today" id="ed1" value="<?php echo $row_staff['doe']; ?>" style="height:32px;" readonly="readonly">
                            	  
                      </div>
                      
                      <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Mode Of Employment</label>
                            	  <select name='moe' id="moe" class="form-control" >
                            <option value="<?php echo $row_staff['e_mode']; ?>"><?php echo $row_staff['e_mode']; ?></option>
                            <option value="FulL Time">FulL Time</option>
                            <option value="Part Time">Part Time</option>
                            <option value="Contract Staff">Contract Staff</option>
                          
                          </select>
                      </div>
                      <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Employee Bank Name </label>
                            	  <input type="text" class="form-control " name='bname' id="bname" value="<?php echo $row_staff['b_name']; ?>"  >
                      </div>
                      <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Employee Account Name </label>
                            	  <input type="text" class="form-control " name='acctname' id="acctname" value="<?php echo $row_staff['b_acct_name']; ?>"  >
                      </div>
                      <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Employee Account Number </label>
                            	  <input type="text" class="form-control " name='acctnum' id="acctnum" value="<?php echo $row_staff['b_acct_num']; ?>" onkeypress="return isNumber(event);"  >
                      </div>
                      <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Bank Sort Code </label>
                            	  <input type="text" class="form-control " name='scode' id="scode" value="<?php echo $row_staff['b_sort']; ?>" onkeypress="return isNumber(event);"  >
                      </div>
					 
                       <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Other Qualification</label>
                            	  <input type="text" class="form-control " name='o_qual' id="o_qual" value="<?php echo $row_staff['oder_quali']; ?>"  >
                      </div>
                      
                       <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Staff Position <font color="red">(For Key Officers Only)</font></label>
                            	  <select name='s_posi' id="s_posi" class="form-control" >
                            <option value="<?php echo $row_staff['position']; ?>"><?php echo $row_staff['position']; ?></option>
                            <option value="Vice Chancellor">Vice Chancellor</option>
                            <option value="Deputy Vice Chancellor">Deputy Vice Chancellor</option>
                            <option value="Rector">Rector</option>
                            <option value="Provost">Provost</option>
                            <option value="Registrar">Registrar</option>
                            <option value="HOD">Head of Department</option>
                            <option value="Dean of Studies">Dean of Studies</option>
                            <option value="Senior Lecturer">Senior Lecturer</option>
                             <option value="Lecturer I">Lecturer I</option>
                             <option value="Lecturer II">Lecturer II</option>
                          
                          </select>
                      </div>
                      
                          <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Employee Username</label>
                            	  <input type="text" class="form-control " name='sid' id="sid" value="<?php echo $row_staff['usern_id']; ?>" required >
                      </div>
						  
					
                      
                     <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
					  <label for="heard">Record Status</label>
                      
                          <select name='Cverify' id="Cverify" class="form-control" required>
                            <option value="<?php echo $row_staff['r_status']; ?>"><?php if ($row_staff['r_status']='2'){
						
						echo 'Verified';}else{echo 'Not Verified';}
						 ?></option>
                            <option value="2">Verified</option>
                            <option value="0">Not Verified</option>
                          
                          </select> </div>
                          
               <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Upload Staff Photo </label>
                            	<input name="pic" class="input-file uniform_on" id="fileInput" type="file" >
                      </div>
                      <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Upload Employee Signature </label>
                            	<input name="signimg" class="input-file uniform_on" id="fileInput" type="file" >
                      </div>
                      <div  class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback>
                        <div class="col-md-6 col-md-offset-3">
                         <br> <?php   if (authorize($_SESSION["access3"]["sMan"]["aes"]["edit"])){ ?> 
                        <button type="submit" name="addStaff"  id="save" data-placement="right" class="btn btn-primary col-md-4" title="Click Here to Update Details" ><i class="fa fa-sign-in"></i> Update</button>
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
                  
                  