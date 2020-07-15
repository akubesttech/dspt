<script>

function sync(){
var sname = document.getElementById('sregNo');
var sname1 = sname.value;
var userID = document.getElementById('pass_word');
var number = Math.floor(Math.random() * 100) +4;

userID.value = sname1+number;
userID.value.changeToUpperCase();
}
</script>


<script type="text/javascript">   
$(document).ready(function() {   
$('#jdesc').change(function(){   
if($('#jdesc').val() === 'Others')   
   {   
   $('#addjob0').show(); 
      $('#addjob').show();    
   }   
else 
   {   
   $('#addjob0').hide(); 
      $('#addjob').hide();      
   }   
});   
});   
</script>

<?php
//if($_SESSION['insidf']==$_POST['insidf'])
//{
if(isset($_POST['editstudentdata'])){
$sname = ucfirst($_POST['sname']) ; $mname = $_POST['mname'] ; $oname = $_POST['oname'] ; $sex = $_POST['sex'];
$Mstatus = $_POST['Mstatus'] ; $dob = $_POST['dob'] ; $hobbies = $_POST['hobbies'] ; $sheight = $_POST['shight'];
$eaddress = $_POST['eaddress'] ; $paddress = $_POST['paddress'] ; $caddress = $_POST['caddress'] ;$phone = $_POST['phone'] ;
 $lga = $_POST['lga'] ; $state = $_POST['state'] ; $nation = ucfirst($_POST['nation']);
$moe = $_POST['moe'] ; $yoe = $_POST['yoe'] ; $prog_dura = $_POST['prog_dura'] ; $los = $_POST['los']; $progn = $_POST['prog'];
$civ = $_POST['civ'] ; $pass_word2 = $_POST['pass_word'] ; $pass_word = substr(md5($pass_word2.SUDO_M),14); $fac1 = $_POST['fac2'] ; $dept1 = $_POST['dept1'];
$sstatus = $_POST['sstatus'] ; $sid = $_POST['sregNo']; $yearofgrag = $_POST['yoe']+ $_POST['prog_dura']; $time=date('l jS \of F Y h:i:s A');$webaddress=$_SERVER['HTTP_HOST'];
$image_find = $_POST['pic'] ;  


$query = mysqli_query($condb,"select * from student_tb where RegNo = '".safee($condb,$sid)."' ")or die(mysqli_error($condb));
$count = mysqli_num_rows($query);
$config = mysqli_fetch_array(mysqli_query($condb,"SELECT * FROM schoolsetuptd "));
	$sql_email_check = mysqli_query($condb,"SELECT * FROM student_tb WHERE e_address='".safee($condb,$eaddress)."' LIMIT 1");
	$email_check = mysqli_num_rows($sql_email_check);
	
	$sql_phone_check = mysqli_query($condb,"SELECT * FROM student_tb WHERE phone='".safee($condb,$phone)."' LIMIT 1");
	$phone_check = mysqli_num_rows($sql_phone_check);

if ($count > 1){ 
	message("ERROR:This Student Record Already Exist,Try Again!", "error");
		       redirect('Student_Record.php?view=e_stud&userId='.$get_RegNo);
}elseif(!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/", $eaddress)){
	message("ERROR:Provide a valid Email Address!", "error");
		       redirect('Student_Record.php?view=e_stud&userId='.$get_RegNo);
		}elseif ($email_check > 1){ 
			message("ERROR:This Email Address is already in use inside our system. Please try another!", "error");
		       redirect('Student_Record.php?view=e_stud&userId='.$get_RegNo);
			}	elseif ($phone_check > 1){ 
			message("ERROR:This Phone Number is already in use inside our system. Please try another!", "error");
		       redirect('Student_Record.php?view=e_stud&userId='.$get_RegNo);
			}

else{

//$images = uploadProductImage('pic','./uploads/');
//$thumbnail = $images['thumbnail'];


if($config['emailver'] == '1') {

$msg = nl2br("Dear $sname $mname,.\n
	This Message was Sent From ".$_SERVER['HTTP_HOST']." dated ".date('d-m-Y').".\n
	..................................................................\n
	The Following is Your Login Information Update:.\n
	User Name:   ".$sid."\n
	User Password: ".$sid."\n
	Date: ".$time."\n
	
	..................................................................\n
	
	Thank You Admin!\n\n");
	
	
	
//$random_hash = md5(date('r', time()));
$subject="Student Login Information Update "; 
//define the headers we want passed. Note that they are separated with \r\n
//$headers  = 'MIME-Version: 1.0' . "\r\n";
//$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
 //$headers      .= "From:Message From Admin\r\n $subject <$webaddress>\r\n";
 //define the body of the message.
ob_start(); //Turn on output buffering
//mail($eaddress, $subject, $msg, $headers);
$mail_data = array('to' => $eaddress, 'sub' => $subject, 'msg' => 'Notify','body' => $msg, 'srname' => $comn);
	send_email($mail_data);
mysqli_query($condb,"update student_tb  set FirstName='".safee($condb,$sname)."',SecondName='".safee($condb,$mname)."',Othername='".safee($condb,$oname)."',Gender='".safee($condb,$sex)."',dob='".safee($condb,$dob)."',hobbies='".safee($condb,$hobbies)."',phone='".safee($condb,$phone)."',e_address='".safee($condb,$eaddress)."',postal_address='".safee($condb,$paddress)."',address='".safee($condb,$caddress)."',lga='".safee($condb,$lga)."',state='".safee($condb,$state)."',nation='".safee($condb,$nation)."',Faculty='".safee($condb,$fac1)."',Department='".safee($condb,$dept1)."',Moe='".safee($condb,$moe)."',yoe='".safee($condb,$yoe)."',app_type='".safee($condb,$progn)."',prog_dura='".safee($condb,$prog_dura)."',p_level='".safee($condb,$los)."',Cert_inview='".safee($condb,$progn)."',yog='".safee($condb,$yearofgrag)."',password='".safee($condb,$pass_word)."',verify_Data='".safee($condb,$sstatus)."' where stud_id='".safee($condb,$get_RegNo)."'")or die(mysqli_error($condb));
}else{
mysqli_query($condb,"update student_tb  set FirstName='".safee($condb,$sname)."',SecondName='".safee($condb,$mname)."',Othername='".safee($condb,$oname)."',Gender='".safee($condb,$sex)."',dob='".safee($condb,$dob)."',hobbies='".safee($condb,$hobbies)."',phone='".safee($condb,$phone)."',e_address='".safee($condb,$eaddress)."',postal_address='".safee($condb,$paddress)."',address='".safee($condb,$caddress)."',lga='".safee($condb,$lga)."',state='".safee($condb,$state)."',nation='".safee($condb,$nation)."',Faculty='".safee($condb,$fac1)."',Department='".safee($condb,$dept1)."',Moe='".safee($condb,$moe)."',yoe='".safee($condb,$yoe)."',app_type='".safee($condb,$progn)."',prog_dura='".safee($condb,$prog_dura)."',p_level='".safee($condb,$los)."',Cert_inview='".safee($condb,$progn)."',yog='".safee($condb,$yearofgrag)."',password='".safee($condb,$pass_word)."',verify_Data='".safee($condb,$sstatus)."' where stud_id='".safee($condb,$get_RegNo)."'")or die(mysqli_error($condb));
}
mysqli_query($condb,"insert into activity_log (date,username,action) values(NOW(),'$admin_username','Student Details of $sname $oname with Registration Number $sid  was Updated')")or die(mysqli_error($condb)); 
// ob_start();
message("Student Record of [$sname $oname] was Successfully Updated", "success");
		       redirect('Student_Record.php?view=e_stud&userId='.$get_RegNo);
//$res="<font color='green'><strong>Student Record of [$sname $oname] was Successfully Updated !</strong></font><br>";
				//$resi=1;
}

}//}$_SESSION['insidf'] = rand();
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
$myreturn=explode(";",$_COOKIE['return']);
?>
<div class="x_panel">
                
             
                <div class="x_content">
<?php
								$query_staff = mysqli_query($condb,"select * from student_tb where stud_id='".safee($condb,$get_RegNo)."' ")or die(mysqli_error($condb));
								$row_staff = mysqli_fetch_array($query_staff);
								?>
                    <form id="form_name"   method="post" enctype="multipart/form-data" data-parsley-validate >
<input type="hidden" name="insidf" value="<?php echo $_SESSION['insidf'];?> " />
                      
                      <span class="section">Edit Student Information </span>
<div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Registration Number </label>
                            	  <input type="text" class="form-control " name='sregNo' id="sregNo"  value="<?php echo $row_staff['RegNo']; ?>" readonly>
                      </div>
                      
                     <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Surname </label>
                            	  <input type="text" class="form-control " name='sname' id="sname" value="<?php echo $row_staff['FirstName']; ?>" required="required">
                      </div>
                      
                      <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Middle Name </label>
                            	  <input type="text" class="form-control " name='mname' id="mname"  required="required" value="<?php echo $row_staff['SecondName']; ?>">
                      </div>
                      
                      <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Other Name </label>
                            	  <input type="text" class="form-control " name='oname' id="oname" value="<?php echo $row_staff['Othername']; ?>"  required="required">
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
						  	  <label for="heard">Date Of Birth</label>
                            	 
                            	  <input  type="text" name="dob" size="28" class="w8em format-d-m-y highlight-days-67 range-middle-today" id="ed" value="<?php echo $row_staff['dob']; ?>" style="height:32px;"   readonly="readonly">
                      </div>
                       <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Hobbies</label>
                            	  <input type="text" class="form-control " name='hobbies' id="hobbies" value="<?php echo $row_staff['hobbies']; ?>" >
                      </div>
                     
                     
                          <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Mobile Number</label>
                            	  <input type="text" class="form-control " name='phone' id="phone"  required="required" value="<?php echo $row_staff['phone']; ?>" onkeypress="return isNumber(event);">
                      </div>
                       <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Email Address</label>
                            	  <input type="text" class="form-control " name='eaddress' id="eaddress" value="<?php echo $row_staff['e_address']; ?>" required>
                      </div>
                      <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Postal Address</label>
                            	  <input type="text" class="form-control " name='paddress' id="paddress" value="<?php echo $row_staff['postal_address']; ?>"  >
                      </div>
                     <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Contact Address</label>
                            	  <input type="text" class="form-control " name='caddress' id="caddress" value="<?php echo $row_staff['address']; ?>"  >
                      </div>
     
                      <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Nationality</label>
                            	  <input type="text" class="form-control " name='nation' id="nation" value="<?php echo $row_staff['nation']; ?>"  >
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
                            	<option value="<?php echo $row_staff['lga']; ?>"><?php echo $row_staff['lga']; ?></option></select>
                      </div>
                     
                       
                      	<?php
//function for getting member status

  
?>
					    <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
						  	  <label for="heard"><?php echo $SCategory; ?></label>
						  	  <select name='fac2' id="fac2" onchange='loadDept(this.name);return false;' class="form-control" >
             <option value="<?php echo $row_staff['Faculty']; ?>"><?php echo getfacultyc($row_staff['Faculty']); ?></option>
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
                           <option value="<?php echo $row_staff['Department']; ?>"><?php echo getdeptc($row_staff['Department']); ?></option>
                          </select>
                      </div>
                      
                       <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Mode of Entry</label>
                            	  
                            	    <select class="form-control"   name="moe" id="moe"  required="required">
  <option value="<?php echo $row_staff['Moe']; ?>"><?php echo getamoe($row_staff['Moe']); ?></option>
  <!-- <option value="01">UTME</option>
    <option value="02">Pre_Science</option>
   <option value="03">Direct Entry</option>
   <option value="04">Undergraguate(Cep)</option> --!>
  <?php
$resultsec2 = mysqli_query($condb,"SELECT * FROM mode_tb  ORDER BY id ASC");
while($rssec2 = mysqli_fetch_array($resultsec2)){echo "<option value='$rssec2[id]'>$rssec2[entrymode]</option>";	}?>
</select>
                            	  
                      </div>
                      
                      <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Year of Entry</label>
                             <select class="form-control" name="yoe" id="yoe"  required="required">
<option value="<?php echo $row_staff['yoe']; ?>"><?php echo $row_staff['yoe']; ?></option>
<?php for($x=2010;$x<2025;$x++){
	echo '<option value="'.$x.'">'.$x.'</option>';
	} ?>
    </select>
                      </div>
                       <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Programme Duration</label>
                            	  
                            	    <select class="form-control"   name="prog_dura" id="prog_dura"  required="required">
  <option value="<?php echo $row_staff['prog_dura']; ?>"><?php echo getyear($row_staff['prog_dura']); ?></option>
   <option value="1">One Year</option>
    <option value="2">Two Years</option>
   <option value="3">Three Years</option>
   <option value="4">Four Years</option>
    <option value="5">Five Years</option>
   <option value="6">Six Years</option>
  

</select>
                            	  
                      </div>
                         <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Level</label>
                            	  
                            	    <select class="form-control"   name="los" id="los"  required="required">

<option value="<?php echo $row_staff['p_level']; ?>"><?php echo getlevel($row_staff['p_level'],$class_ID); ?></option>
                  <?php 
//include('lib/dbcon.php'); 
//dbcon(); 
$resultsec2 = mysqli_query($condb,"SELECT * FROM level_db where prog = '$class_ID'  ORDER BY level_order ASC");
while($rssec2 = mysqli_fetch_array($resultsec2))
{
echo "<option value='$rssec2[level_order]'>$rssec2[level_name]</option>";	
}
?>


    </select>
                            	  
                      </div>
                      <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Certificate In View</label>
 <input type="text" class="form-control " name='civ' id="civ" value="<?php echo getcertinview($row_staff['Cert_inview']); ?>"  readonly>
 </div>
<div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Password</label>
   <input type="text" class="form-control " name='pass_word' id="pass_word" value="<?php echo $row_staff['RegNo']; ?>"  >
                      </div>
                      
						  
					
                      
                     <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
					  <label for="heard">Student Status</label>
                      
                          <select name='sstatus' id="sstatus" class="form-control" required>
                            <option value="<?php echo $row_staff['verify_Data']; ?>"><?php if ($row_staff['verify_Data']=='TRUE'){
						
						echo 'Verified';}else{echo 'Not Verified';}
						 ?></option>
                            <option value="TRUE">Verified</option>
                            <option value="FALSE">Not Verified</option>
                          
                          </select> </div>
                          
             <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Program </label>
                            	  <select name='prog' id="prog" class="form-control" >
                            <option value="<?php echo $row_staff['app_type']; ?>"><?php echo getprog($row_staff['app_type']); ?></option>
                                                   <?php  
$resultproe = mysqli_query($condb,"SELECT * FROM prog_tb  ORDER BY Pro_name  ASC");
while($rsproe = mysqli_fetch_array($resultproe))
{
echo "<option value='$rsproe[pro_id]'>$rsproe[Pro_name]</option>";	
}
?></select>
                      </div>
                      
                      <div  class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback>
                        <div class="col-md-6 col-md-offset-3">
                         <br> <?php   if (authorize($_SESSION["access3"]["stMan"]["srv"]["edit"])){ ?> 
                        <button type="submit" name="editstudentdata"  id="save" data-placement="right" class="btn btn-primary col-md-4" title="Click Here to Update Details" ><i class="fa fa-sign-in"></i> Update</button><?php } ?>
                        
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
                  <?php

                  ?>