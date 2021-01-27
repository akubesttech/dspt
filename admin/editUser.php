
<script type="text/javascript">   
$(document).ready(function() {   
$('#level').change(function(){   
if($('#level').val() === 'Others')   
   {   
   $('#otherl').show(); 
      $('#other2').show();    
   }   
else 
   {   
   $('#otherl').hide(); 
      $('#other2').hide();      
   }   
});   
});   
</script>

<?php
$get_RegNo2 = isset($_GET['id']) ? $_GET['idu'] : ''; 
								$query_usera = mysqli_query($condb,"select * from admin where md5(admin_id)='".safee($condb,$get_RegNo)."' ")or die(mysqli_error($condb));
								$row_usera = mysqli_fetch_array($query_usera);
                                	$id = $row_usera['admin_id']; $idu = $row_usera['username'];
$newpassword = generateRandompass();
if(isset($_POST['edituser'])){
$s_name = $_POST['s_name'];
$f_name = $_POST['f_name'];
$staff_uid = $_POST['staff_uid'];
//$staff_uid2 = $_POST['userid_hide'];
$s_email = $_POST['s_email'];
$s_mobile = $_POST['s_mobile'];
//$s_pass = $_POST['s_pass'];
$hashpass = $_POST['s_pass'];
$s_pass2 = $_POST['s_pass2'];
$s_moe = $_POST['moe'];
$Rorder = getrorder($s_moe);
$sview = getAuthview($Rorder);
 $time=date('l jS \of F Y h:i:s A');
 $s_pass = substr(md5($hashpass.SUDO_M),14);
//$from = "support@edu.smartdelta.ng";
  //$tome = "akubesttech@gmail.com";
 $urllogin = host();

//SELECT s.usern_id, s.email, s.r_status, s.image,s.staff_id,
			//a.username, a.email FROM staff_details s, admin a
		//	WHERE s.staff_id = '$get_staff' AND s.usern_id = '$staff_uid' 
			//AND s.r_status = '1'
$query_add_user = mysqli_query($condb,"select * from admin where username = '".safee($condb,$staff_uid)."' ")or die(mysqli_error($condb));
$row_add_user = mysqli_num_rows($query_add_user);
$query = mysqli_query($condb,"select * from staff_details where usern_id = '".safee($condb,$staff_uid)."' ")or die(mysqli_error($condb));
$count = mysqli_num_rows($query);

$sql_email_check = mysqli_query($condb,"SELECT * FROM staff_details WHERE email='$s_email' LIMIT 1");
$email_check = mysqli_num_rows($sql_email_check);
$sql_phone_check = mysqli_query($condb,"SELECT * FROM staff_details WHERE phone='$s_mobile' LIMIT 1");
$phone_check = mysqli_num_rows($sql_phone_check);

$sql_email_a = mysqli_query($condb,"SELECT * FROM admin WHERE email='$s_email' LIMIT 1");
$email_a = mysqli_num_rows($sql_email_a);
$sql_phone_a = mysqli_query($condb,"SELECT * FROM admin WHERE phone='$s_mobile' LIMIT 1");
$phone_a = mysqli_num_rows($sql_phone_a);

$row_checksuper = mysqli_query($condb,"select * from admin where access_level = '1'")or die(mysqli_error($condb));
$check_s = mysqli_fetch_array($row_checksuper);
$check_s2 = $check_s['access_level'];
if ($row_add_user>1){
message("This User  Already Exist Try Again", "error");
		        redirect('add_Users.php?view=editUser&id='.md5($id).'&idu='.md5($idu));
             
                //redirect('add_Users.php?view=editUser&id='.$get_RegNo);
                }elseif($count > 1){
				message("This User Name has  Already Existed as Staff id please Try Again", "error");
		        redirect('add_Users.php?view=editUser&id='.md5($id).'&idu='.md5($idu));
	}elseif ($email_check > 1 or $email_a > 1){ 
		message("ERROR:  This Email Address is already in use inside our system. Please try another!", "error");
		       redirect('add_Users.php?view=editUser&id='.md5($id).'&idu='.md5($idu));
			}elseif ($phone_check > 1 or $phone_a > 1){ 
		message("ERROR:  This Phone Number is already in use inside our system. Please try another!", "error");
		     redirect('add_Users.php?view=editUser&id='.md5($id).'&idu='.md5($idu));
				}elseif($hashpass !== $s_pass2 ){
				message("The Two Password did Not Match Try Again", "error");
		        redirect('add_Users.php?view=editUser&id='.md5($id).'&idu='.md5($idu));
				//$res="<font color='red'><strong>The Two Password did Not Match Try Again.</strong></font><br>";
				//$resi=1;
				
}elseif(substr_count($staff_uid," ")){
	message("Spaces Are not Allowed in Username.", "error");
		        redirect('add_Users.php?view=editUser&id='.md5($id).'&idu='.md5($idu));
		//$res="<font color='Red'><strong>Spaces Are not Allowed in Username.</strong></font><br>";
				//$resi=1;
				//}elseif($check_s2==$s_moe){
	//message("Your are Not Allowed To Add Super Admin because Super Admin already Exist.", "error");
		        //redirect('add_Users.php');
		//$res="<font color='Red'><strong>Your are Not Allowed To Add Super Admin because Super Admin already Exist.</strong></font><br>";
				//$resi=1;
}else{
if($ev_actives == '1') {
//if($s_moe=="1"){
mysqli_query($condb,"update  admin set firstname='".safee($condb,$s_name)."',lastname='".safee($condb,$f_name)."',username='".safee($condb,$staff_uid)."',password='".safee($condb,$s_pass)."',access_level='".safee($condb,$s_moe)."',roleorder = '".safee($condb,$Rorder)."',email='".safee($condb,$s_email)."',phone='".safee($condb,$s_mobile)."' where md5(admin_id)= '".safee($condb,$get_RegNo)."'")or die(mysqli_error($condb));
if($Rorder  > 1){
mysqli_query($condb,"update  staff_details set sname='".safee($condb,$s_name)."',mname='".safee($condb,$f_name)."',phone='".safee($condb,$s_mobile)."',email='".safee($condb,$s_email)."',access_level2='".safee($condb,$s_moe)."',usern_id='".safee($condb,$staff_uid)."',u_display='".safee($condb,$sview)."',r_status='2' where md5(usern_id)= '".safee($condb,$get_RegNo2)."' ")or die(mysqli_error($condb));
}
/*
}elseif($s_moe=="2"){
mysqli_query($condb,"update  admin set firstname='".safee($condb,$s_name)."',lastname='".safee($condb,$f_name)."',username='".safee($condb,$staff_uid)."',password='".safee($condb,$s_pass)."',access_level='".safee($condb,$s_moe)."',email='".safee($condb,$s_email)."',phone='".safee($condb,$s_mobile)."' where md5(admin_id)='".safee($condb,$get_RegNo)."'")or die(mysqli_error($condb));

mysqli_query($condb,"update  staff_details set password='".safee($condb,$s_pass)."',phone='".safee($condb,$s_mobile)."',email='".safee($condb,$s_email)."',access_level2='".safee($condb,$s_moe)."',usern_id='".safee($condb,$staff_uid)."',r_status='2' where md5(usern_id)= '".safee($condb,$get_RegNo2)."' ")or die(mysqli_error($condb));
}elseif($s_moe=="6"){
mysqli_query($condb,"update  admin set firstname='".safee($condb,$s_name)."',lastname='".safee($condb,$f_name)."',username='".safee($condb,$staff_uid)."',password='".safee($condb,$s_pass)."',access_level='".safee($condb,$s_moe)."',email='".safee($condb,$s_email)."',phone='".safee($condb,$s_mobile)."' where md5(admin_id)='".safee($condb,$get_RegNo)."'")or die(mysqli_error($condb));

mysqli_query($condb,"update  staff_details set password='".safee($condb,$s_pass)."',phone='".safee($condb,$s_mobile)."',email='".safee($condb,$s_email)."',access_level2='".safee($condb,$s_moe)."',usern_id='".safee($condb,$staff_uid)."',r_status='2' where md5(usern_id)= '".safee($condb,$get_RegNo2)."' ")or die(mysqli_error($condb));
}else{
mysqli_query($condb,"update staff_details set password='".safee($condb,$s_pass)."',phone='".safee($condb,$s_mobile)."',email='".safee($condb,$s_email)."',access_level2='".safee($condb,$s_moe)."',usern_id='".safee($condb,$staff_uid)."',r_status='2' where md5(usern_id)= '".safee($condb,$get_RegNo2)."' ")or die(mysqli_error($condb));
$result = mysqli_query($condb,"DELETE FROM admin where md5(admin_id)='".safee($condb,$get_RegNo)."'");
	echo "<script>alert('[$s_name $f_name] Record was Updated successfully !');</script>";
		echo "<script>window.location.assign('add_Users.php');</script>";
}*/

$msg = nl2br("Dear $s_name $f_name,.\n
	This Message was Sent From " .$schoolNe ." @ ".$_SERVER['HTTP_HOST']." dated ".date('d-m-Y').".\n
	..................................................................\n
	The Following is Your Login Information Update:.\n
	User Name:   ".$staff_uid."\n
	User Password: ".$hashpass."\n
    Date: ".$time."\n
	Login: ".$urllogin."Userlogin.php"."\n
	..................................................................\n
    Please remember to Change Your Password and keep your password secret!\n
    
    Please also note that passwords are case-sensitive. \n
    For inquiry and complaint please email ".$infomail." \n
	
	Thank You Admin!\n\n");
	
	
	
//$random_hash = md5(date('r', time()));
$subject="User Login Information Update "; 
//define the headers we want passed. Note that they are separated with \r\n
/*$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers      .= "From:Message From School Admin\r\n <$from>\r\n".
                   'Reply-To: '.$replyto ."\r\n" .
                   'Return-Path: The Sender: '. $from ."\r\n" .
                   'X-Priority: 3\r\n'.
                   //'Reply-To: '.$replyto."\r\n" .
                   'X-Mailer: PHP/' . phpversion();*/
 
 //define the body of the message.
//ob_start(); //Turn on output buffering
$mail_data = array('to' => $s_email, 'sub' => $subject, 'msg' => 'Notify','body' => $msg, 'srname' => $comn);
if(send_email($mail_data)=== 'success'){
mysqli_query($condb,"insert into activity_log (date,username,action) values(NOW(),'".safee($condb,$admin_username)."','User Account of $staff_uid was Updated')")or die(mysqli_error($condb)); 
//mysql_close();
 message("[$s_name $f_name] Record was Updated successfully with an Email Comfirmation!", "success");
		        redirect('add_Users.php?view=Users');
		        }else{
		        message("[$s_name $f_name] Record was Updated successfully !", "success");
		        redirect('add_Users.php?view=Users');
		        }
//$res="<font color='green'><strong> [$s_name $f_name] Record was Updated successfully with an Email Comfirmation!</strong></font><br>";
				//$resi=1;
}else{
//if($s_moe=="1"){
mysqli_query($condb,"update  admin set firstname='$s_name',lastname='".safee($condb,$f_name)."',username='".safee($condb,$staff_uid)."',password='".safee($condb,$s_pass)."',access_level='".safee($condb,$s_moe)."',roleorder = '".safee($condb,$Rorder)."',email='".safee($condb,$s_email)."',phone='".safee($condb,$s_mobile)."' where md5(admin_id)='".safee($condb,$get_RegNo)."'")or die(mysqli_error($condb));
if($Rorder  > 1){
mysqli_query($condb,"update  staff_details set sname='".safee($condb,$s_name)."',mname='".safee($condb,$f_name)."', phone='".safee($condb,$s_mobile)."',email='".safee($condb,$s_email)."',access_level2='".safee($condb,$s_moe)."',usern_id='".safee($condb,$staff_uid)."',u_display='".safee($condb,$sview)."',r_status='2' where md5(usern_id)= '".safee($condb,$get_RegNo2)."' ")or die(mysqli_error($condb));
}
/*}elseif($s_moe=="2"){
mysqli_query($condb,"update  admin set firstname='".safee($condb,$s_name)."',lastname='".safee($condb,$f_name)."',username='".safee($condb,$staff_uid)."',password='".safee($condb,$s_pass)."',access_level='".safee($condb,$s_moe)."',email='".safee($condb,$s_email)."',phone='".safee($condb,$s_mobile)."' where md5(admin_id)='".safee($condb,$get_RegNo)."'")or die(mysqli_error($condb));
mysqli_query($condb,"update  staff_details set password='".safee($condb,$s_pass)."',phone='".safee($condb,$s_mobile)."',email='".safee($condb,$s_email)."',access_level2='".safee($condb,$s_moe)."',usern_id='".safee($condb,$staff_uid)."',r_status='2' where md5(usern_id)= '".safee($condb,$get_RegNo2)."' ")or die(mysqli_error($condb));
}elseif($s_moe=="6"){
mysqli_query($condb,"update  admin set firstname='".safee($condb,$s_name)."',lastname='".safee($condb,$f_name)."',username='".safee($condb,$staff_uid)."',password='".safee($condb,$s_pass)."',access_level='".safee($condb,$s_moe)."',email='".safee($condb,$s_email)."',phone='".safee($condb,$s_mobile)."' where md5(admin_id)='".safee($condb,$get_RegNo)."'")or die(mysqli_error($condb));
mysqli_query($condb,"update  staff_details set password='".safee($condb,$s_pass)."',phone='".safee($condb,$s_mobile)."',email='".safee($condb,$s_email)."',access_level2='".safee($condb,$s_moe)."',usern_id='".safee($condb,$staff_uid)."',r_status='2' where md5(usern_id)= '".safee($condb,$get_RegNo2)."' ")or die(mysqli_error($condb));
}else{
mysqli_query($condb,"update staff_details set password='".safee($condb,$s_pass)."',phone='".safee($condb,$s_mobile)."',email='".safee($condb,$s_email)."',access_level2='".safee($condb,$s_moe)."',usern_id='".safee($condb,$staff_uid)."',r_status='2' where md5(usern_id)= '".safee($condb,$get_RegNo2)."' ")or die(mysqli_error($condb));
$result = mysqli_query($condb,"DELETE FROM admin where md5(admin_id)='".safee($condb,$get_RegNo)."'");
	echo "<script>alert('[$s_name $f_name] Record was Updated successfully !');</script>";
		echo "<script>window.location.assign('add_Users.php');</script>";
}*/
mysqli_query($condb,"insert into activity_log (date,username,action) values(NOW(),'$admin_username','User Account of $staff_uid was Updated')")or die(mysqli_error($condb)); 
 ob_start();
 	message(" [$s_name $f_name] Record was Updated successfully!", "success");
		        redirect('add_Users.php?view=Users');
//$res="<font color='green'><strong> [$s_name $f_name] Record was Updated successfully!</strong></font><br>";
				//$resi=1;
}


}
}
?>
<?php

 
	

?>
<!--<div class="x_panel">
<div class="x_content">--!>

                    		<form name="user" method="post" enctype="multipart/form-data" id="user">
                    		
<input type="hidden" name="insidd" value="<?php echo $_SESSION['insidd'];?> " />
                      <!--<span class="section">Edit User Records  </span> --!>
<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Username </label>
                            	  <input type="text" class="form-control " name='staff_uid' id="staff_uid" placeholder="Staff Username" readonly value="<?php echo $row_usera['username'];?>"  required="required">
                      </div>
                      
                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Surname Name </label>
                            	  <input type="text" class="form-control " name='s_name' id="acc_name" value="<?php echo $row_usera['firstname'];?>"   required="required">
                            	 
                      </div>
                      
                     <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
						  	  <label for="heard">First Name</label>
                            	  <input type="text" class="form-control " name='f_name' id="f_name"  value="<?php echo $row_usera['lastname'];?>"  >
                      </div>
 <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Email Address</label>
                            	  <input type="text" class="form-control " name='s_email' id="s_email"  value="<?php echo $row_usera['email'];?>"  >
                      </div>
                       <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Mobile Number</label>
                            	  <input type="text" class="form-control " name='s_mobile' id="s_mobile"  value="<?php echo $row_usera['phone'];?>" onkeypress="return isNumber(event);"  >
                      </div>
 <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Password </label>
                            	  <input type="password" class="form-control " name='s_pass' id="s_pass"  value="<?php echo $newpassword;?>"   >
                      </div>
                       <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Comfirm Password </label>
                            	  <input type="password" class="form-control " name='s_pass2' id="s_pass2" value="<?php echo $newpassword ;?>"  >
                      </div>
                      
                      <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
						  	  <label for="heard">User Role</label>
                            	  <select name='moe' id="moe" class="form-control" >
                <option value="<?php echo $row_usera['access_level'];?>"><?php echo getstatus($row_usera['access_level']);?></option>
    <?php if($Rorder == "1"){ $resultfee = mysqli_query($condb,"SELECT * FROM role   ORDER BY role_rolename  ASC");   }else{ 
	$resultfee = mysqli_query($condb,"SELECT * FROM role where roleorder > 1 ORDER BY role_rolename  ASC");        }
while($rsfee = mysqli_fetch_array($resultfee)){ echo "<option value='$rsfee[role_rolecode]'>$rsfee[role_rolename]</option>";}?>
<!--<option value="">Select User Role</option> --!>
                           <?php 
//$resultfee = mysqli_query($condb,"SELECT * FROM role   ORDER BY role_rolename  ASC");
//while($rsfee = mysqli_fetch_array($resultfee)){ echo "<option value='$rsfee[role_rolecode]'>$rsfee[role_rolename]</option>";}?>
                            <?php //if($admin_accesscheck  == '1'){?>
                           <!-- <option value="1">Super Admin</option>
                            <?php // }?>
                            <option value="2">Administartor</option>
                            <option value="3">Registrar</option>
                            <option value="4">Academic Staff</option>
                            <option value="5">Non Academic Staff</option>
                            <option value="6">Bursary</option>
                            <option value="0">No Access</option> --!>
                           
                          
                          </select>
                      </div>
                      
                    
                      
                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
					  
                           </div>
                    
                     
               
                      <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                        
                        </div>
                      </div>
                      <div class="form-group">
                      <div class="col-md-6 col-md-offset-3">
                                        
                                        </div>  </div>
                      <div  class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback>
                        <div class="col-md-6 col-md-offset-3">
                         
                        <button  name="edituser"  id="adduser"  class="btn btn-primary col-md-4" title="Click Here to Save User Details" ><i class="fa fa-sign-in"></i> Edit User</button>
                       <a href="#" onclick="window.open('add_Users.php?view=Users','_self')" class="btn btn-info"  id="delete2" data-placement="right" title="Click to Go back" ><i class="fa fa-backward icon-large"></i> Go back</a>
						
                        	<script type="text/javascript">
	                                            $(document).ready(function(){
	                                            $('#adduser').tooltip('show');
	                                            $('#adduser').tooltip('hide');
	                                            });
	                                            </script>
                        </div>
                        
                        	
									
                        </form>
                     <!--  </div> </div> --!>
                 
                  