
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
$query_find= mysqli_query($condb,"select * from staff_details where md5(staff_id) = '".safee($condb,$get_staff)."'")or die(mysqli_error($condb));
							  $row_find = mysqli_fetch_array($query_find);
							  $staff_username =$row_find['usern_id']; $staff_sname =$row_find['sname']; $staff_oname =$row_find['oname'];$staff_email =$row_find['email']; $staff_phone =$row_find['phone']; $staff_pass = generateRandompass(); $staff_image =$row_find['image'];
//if($_SESSION['insidd']==$_POST['insidd'])
//{



//echo $hash;" <br>";
//$dbSalt = substr($user['password'],0,14);
//$dbPass = substr($user['password'],14);
//if (md5($dbSalt . $password) == $dbPass) { /* CORRECT PASSWORD */ }

if(isset($_POST['adduser'])){
$s_name = $_POST['s_name'];
$f_name = $_POST['f_name'];
$staff_uid = $_POST['staff_uid'];
$s_email = $_POST['s_email'];
$s_mobile = $_POST['s_mobile'];
//$s_pass = $_POST['s_pass'];
$hashpass = $_POST['s_pass'];
$s_pass2 = $_POST['s_pass2'];
$s_moe = $_POST['moe'];
$Rorder = getrorder($s_moe);
$time=date('l jS \of F Y h:i:s A');
$s_pass = substr(md5($hashpass.SUDO_M),14);
//$from = "support@edu.smartdelta.ng";
  //$replyto = "akubesttech@gmail.com";
 $urllogin = host();

//SELECT s.usern_id, s.email, s.r_status, s.image,s.staff_id,
			//a.username, a.email FROM staff_details s, admin a
		//	WHERE s.staff_id = '$get_staff' AND s.usern_id = '$staff_uid' 
			//AND s.r_status = '1'
$query_add_user = mysqli_query($condb,"select * from admin where username = '".safee($condb,$staff_uid)."' ")or die(mysqli_error($condb));

$row_add_user = mysqli_num_rows($query_add_user);

$row_checksuper = mysqli_query($condb,"select * from admin where access_level = '1'")or die(mysqli_error($condb));
$check_s = mysqli_fetch_array($row_checksuper);
$check_s2 = $check_s['access_level'];
if ($row_add_user>0){
message("This User  Already Exist Try Again", "error");
		        redirect('add_Users.php');	

				//echo "<script>alert('Applicationform record inserted sucessfully..');</script>";
				}elseif($hashpass !== $s_pass2 ){
				message("The Two Password did Not Match Try Again", "error");
		        redirect('add_Users.php');
				//$res="<font color='red'><strong>The Two Password did Not Match Try Again.</strong></font><br>";
				//$resi=1;
				
}elseif(substr_count($staff_uid," ")){
		message("Spaces Are not Allowed in Username", "error");
		        redirect('add_Users.php');
		//$res="<font color='Red'><strong>Spaces Are not Allowed in Username.</strong></font><br>";
				//$resi=1;
				//}elseif($check_s2==$s_moe){
	//message("Your are Not Allowed To Add Super Admin because Super Admin already Exist.", "error");
		        //redirect('add_Users.php');
		//$res="<font color='Red'><strong>Your are Not Allowed To Add Super Admin because Super Admin already Exist.</strong></font><br>";
			//	$resi=1;
}else{
if($ev_actives == '1') {
//if($s_moe=="1"){
mysqli_query($condb,"insert into admin (firstname,lastname,username,password,adminthumbnails,validate,access_level,roleorder,email,phone) values('".safee($condb,$s_name)."','".safee($condb,$f_name)."','".safee($condb,$staff_uid)."','".safee($condb,$s_pass)."','".safee($condb,$staff_image)."',1,'".safee($condb,$s_moe)."','".safee($condb,$Rorder)."','".safee($condb,$s_email)."','".safee($condb,$s_moblie)."')")or die(mysqli_error($condb));
/*}elseif($s_moe=="2"){
mysqli_query($condb,"insert into admin (firstname,lastname,username,password,adminthumbnails,validate,access_level,email,phone) values('".safee($condb,$s_name)."','".safee($condb,$f_name)."','".safee($condb,$staff_uid)."','".safee($condb,$s_pass)."','".safee($condb,$staff_image)."',1,'".safee($condb,$s_moe)."','".safee($condb,$s_email)."','".safee($condb,$s_mobile)."')")or die(mysqli_error($condb));
}elseif($s_moe=="6"){
mysqli_query($condb,"insert into admin (firstname,lastname,username,password,adminthumbnails,validate,access_level,email,phone) values('".safee($condb,$s_name)."','".safee($condb,$f_name)."','".safee($condb,$staff_uid)."','".safee($condb,$s_pass)."','$staff_image',1,'".safee($condb,$s_moe)."','".safee($condb,$s_email)."','".safee($condb,$s_mobile)."')")or die(mysqli_error($condb));
}else{
mysqli_query($condb,"update  staff_details set password='$s_pass',access_level2='".safee($condb,$s_moe)."',usern_id='".safee($condb,$staff_uid)."',r_status='2' where md5(staff_id) = '".safee($condb,$get_staff)."' ")or die(mysqli_error($condb));
}*/

$msg = nl2br("Dear $sname $f_name,.\n
	This Message was Sent From " .$schoolNe ." @ ".$_SERVER['HTTP_HOST']." dated ".date('d-m-Y').".\n
	..................................................................\n
	The Following is Your Login Information:.\n
	User Name:   ".$staff_uid."\n
	User Password: ".$hashpass."\n
	Date: ".$time."\n
	Login: ".$urllogin."Userlogin.php"."\n
	..................................................................\n
    Please remember to Change Your Password and keep your password secret!\n
    
    Please also note that passwords are case-sensitive. \n
    For inquiry and complaint please email admin@smartdelta.com.ng \n
	
	Thank You Admin!\n\n");
	
	
	
//$random_hash = md5(date('r', time()));
$subject="User Login Information "; 
//define the headers we want passed. Note that they are separated with \r\n
/*$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers      .= "From:Message From School Admin\r\n <$from>\r\n".
                   'Reply-To: '.$replyto ."\r\n" .
                   'Return-Path: The Sender: '. $from ."\r\n" .
                   'X-Priority: 3\r\n'.
                   //'Reply-To: '.$replyto."\r\n" .
                   'X-Mailer: PHP/' . phpversion(); */
                   
 //define the body of the message.
ob_start(); //Turn on output buffering
//@mail($s_email, $subject, $msg, $headers);
$mail_data = array('to' => $s_email, 'sub' => $subject, 'msg' => 'Notify','body' => $msg, 'srname' => $comn);
	send_email($mail_data);
}else{

//if($s_moe=="1"){

mysqli_query($condb,"insert into admin (firstname,lastname,username,password,adminthumbnails,validate,access_level,roleorder,email,phone) values('".safee($condb,$s_name)."','".safee($condb,$f_name)."','".safee($condb,$staff_uid)."','$s_pass','".safee($condb,$staff_image)."',1,'".safee($condb,$s_moe)."','".safee($condb,$Rorder)."','".safee($condb,$s_email)."','".safee($condb,$s_moblie)."')")or die(mysqli_error($condb));
/*
}elseif($s_moe=="2"){
mysqli_query($condb,"insert into admin (firstname,lastname,username,password,adminthumbnails,validate,access_level,email,phone) values('".safee($condb,$s_name)."','".safee($condb,$f_name)."','".safee($condb,$staff_uid)."','$s_pass','".safee($condb,$staff_image)."',1,'".safee($condb,$s_moe)."','".safee($condb,$s_email)."','".safee($condb,$s_mobile)."')")or die(mysqli_error($condb));

}elseif($s_moe=="6"){
mysqli_query($condb,"insert into admin (firstname,lastname,username,password,adminthumbnails,validate,access_level,email,phone) values('".safee($condb,$s_name)."','".safee($condb,$f_name)."','".safee($condb,$staff_uid)."','".safee($condb,$s_pass)."','$staff_image',1,'".safee($condb,$s_moe)."','".safee($condb,$s_email)."','".safee($condb,$s_mobile)."')")or die(mysqli_error($condb));

}else{
mysqli_query($condb,"update  staff_details set password='$s_pass',access_level2='".safee($condb,$s_moe)."',usern_id='".safee($condb,$staff_uid)."',r_status='2' where md5(staff_id) = '".safee($condb,$get_staff)."' ")or die(mysqli_error($condb));
}*/

}

mysqli_query($condb,"insert into activity_log (date,username,action) values(NOW(),'".safee($condb,$admin_username)."','User Account of $staff_uid was Add')")or die(mysqli_error($condb)); 
 ob_start();
 message("New User Account was Successfully Added.", "success");
		        redirect('add_Users.php');
//$res="<font color='green'><strong>New User Account was Successfully Added</strong></font><br>";
				//$resi=1;
			



}
}//}$_SESSION['insidd'] = rand();
?>
<?php

$s=3;
	while($s>0){
	$AppNo .= rand(0,9);

		$s-=1;
	}
	

?>
<div class="x_panel">
                
             
                <div class="x_content">

                    		<form name="user" method="post" enctype="multipart/form-data" id="user">
<input type="hidden" name="insidd" value="<?php echo $_SESSION['insidd'];?> " />
                      
                      <span class="section">Add New User <?php //echo generateRandompass(); ?></span>

  <div class="col-md-4 col-sm-4 col-xs-12 input-group has-feedback">
  <?php if (authorize($_SESSION["access3"]["sMan"]["asu"]["edit"])){//if($admin_accesscheck == '1'){?>
                            <input type="text" class="form-control" name='staff_uid' placeholder="Staff Username"  value="<?php echo $staff_username; ?>"><?php }else{?>
                                <input type="text" class="form-control" name='staff_uid' placeholder="Staff Username" readonly value="<?php echo $staff_username; ?>">
                            
                            <?php } ?>
                            <span class="input-group-btn">
                                              <a href="#myModal4" data-placement="right" data-toggle="modal" class="btn btn-primary" title="Click to Load Staff" id="s_userid" ><i class="fa fa-reply-all"></i> Find!</a>
                                          </span>
                                        <script type="text/javascript">
									 $(document).ready(function(){
									 $('#s_userid').tooltip('show');
									 $('#s_userid').tooltip('hide');
									 });
									</script>  
                          </div>
 
                     
                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Surname Name </label>
						  	  <?php if (authorize($_SESSION["access3"]["sMan"]["asu"]["edit"])){//if($admin_accesscheck == '1'){?>
                            	  <input type="text" class="form-control " name='s_name' id="acc_name" value="<?php echo $staff_sname;?>"   required="required"><?php }else{?>
                            	  	  <input type="text" class="form-control " name='s_name' id="acc_name" value="<?php echo $staff_sname;?>" readonly  required="required">
                            	  <?php }?>
                      </div>
                      
                     <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
						  	  <label for="heard">First Name</label>
						  	  <?php if (authorize($_SESSION["access3"]["sMan"]["asu"]["edit"])){//if($admin_accesscheck == '1'){?>
                            	  <input type="text" class="form-control " name='f_name' id="f_name"  value="<?php echo $staff_oname;?>"  ><?php }else{?>
                            	  	  <input type="text" class="form-control " name='f_name' id="f_name" readonly value="<?php echo $staff_oname;?>"  >  <?php }?>
                      </div>
 <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Email Address</label>
                            	  <input type="text" class="form-control " name='s_email' id="s_email" readonly value="<?php echo $staff_email;?>"  >
                      </div>
                       <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Mobile Number</label>
                            	  <input type="text" class="form-control " name='s_mobile' id="s_mobile" readonly value="<?php echo $staff_phone;?>" onkeypress="return isNumber(event);"  >
                      </div>
 <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Password </label>
                            	  <input type="password" class="form-control " name='s_pass' id="s_pass"  value="<?php echo $staff_pass;?>"   >
                      </div>
                       <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Comfirm Password </label>
                            	  <input type="password" class="form-control " name='s_pass2' id="s_pass2" value="<?php echo $staff_pass;?>"  >
                      </div>
                      
                      <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
						  	  <label for="heard">User Role</label>
                            	  <select name='moe' id="moe" class="form-control" >
                            <option value="">Select User Role</option>
    <?php if($Rorder == "1"){ $resultfee = mysqli_query($condb,"SELECT * FROM role   ORDER BY role_rolename  ASC");   }else{ 
	$resultfee = mysqli_query($condb,"SELECT * FROM role where roleorder > 1 ORDER BY role_rolename  ASC");        }
while($rsfee = mysqli_fetch_array($resultfee)){ echo "<option value='$rsfee[role_rolecode]'>$rsfee[role_rolename]</option>";}?>
                            <?php //if($admin_accesscheck == '1'){?>
                          <!--  <option value="1">Super Admin</option>
                            <?php  //}?>
                            <option value="2">Administartor</option>
                            <option value="3">Registrar</option>
                            <option value="4">Academic Staff</option>
                            <option value="5">Non Academic Staff</option>
                            <option value="6">Bursary</option> --!>
                           
                          
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
                         <?php   if (authorize($_SESSION["access3"]["sMan"]["asu"]["create"])){ ?> 
                        <button  name="adduser"  id="adduser"  class="btn btn-primary col-md-4" title="Click Here to Save User Details" ><i class="fa fa-sign-in"></i> Add User</button><?php } ?>
                      
                        	<script type="text/javascript">
	                                            $(document).ready(function(){
	                                            $('#adduser').tooltip('show');
	                                            $('#adduser').tooltip('hide');
	                                            });
	                                            </script>
                        </div>
                        
                        	
									
                        </form>
                       </div> </div>
                 
                  