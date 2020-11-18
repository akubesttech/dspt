

<?php

if(isset($_POST['suprof'])){
//$sname = ucfirst($_POST['sname']) ; $mname = $_POST['mname'] ; $oname = $_POST['oname'] ;// $sex = $_POST['sex'];
$Gender = $_POST['Gender'] ;  $hobbies = $_POST['hobbies'] ;
$eaddress = $_POST['eaddress'] ; $paddress = $_POST['p_address'] ; $caddress = $_POST['caddress'] ;$phone = $_POST['phone'] ;
$stown = $_POST['stown'] ; $lga = $_POST['lga'] ; $state = $_POST['state'] ; $nation = ucfirst($_POST['nation']);
//$jdesc = $_POST['jdesc'] ; $addjob = $_POST['addjob'] ; $heq = $_POST['heq'] ; $Cstudy = $_POST['cstudy'];
 //$acctnum = $_POST['acctnum'] ;  $dept1 = $_POST['dept1'];
//$moe = $_POST['moe'] ; $bname = $_POST['bname'] ;$acctname = $_POST['acctname'] ; $scode = $_POST['scode'] ; //$sid = $_POST['sid'];
//$image_find = $_POST['pic'] ; $Cverify = $_POST['Cverify'] ; $time=date('l jS \of F Y h:i:s A');
//$webaddress=$_SERVER['HTTP_HOST'];

$config = mysqli_fetch_array(mysqli_query($condb,"SELECT * FROM schoolsetuptd "));
	$sql_email_check = mysqli_query($condb,"SELECT * FROM student_tb WHERE e_address='$eaddress' LIMIT 1");
	$email_check = mysqli_num_rows($sql_email_check);
	
	$sql_phone_check = mysqli_query($condb,"SELECT * FROM student_tb WHERE phone='$phone' LIMIT 1");
	$phone_check = mysqli_num_rows($sql_phone_check);
	


	
//if ($count > 1){ 

//$res="<font color='red'><strong>This Staff Record Already Exist,Try Again!</strong></font><br>";
			//	$resi=1;
				//echo "<script>alert('Applicationform record inserted sucessfully..');</script>";
		if(!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/", $eaddress)){
	message("Please! Provide a valid Email Address!", "error");
		        redirect('student_Private.php?view=SPRO');
		}elseif ($email_check > 1){ 
		message("ERROR:  This Email Address is already in use inside our system. Please try another!", "error");
		        redirect('student_Private.php?view=SPRO');
		
				}	elseif ($phone_check > 1){ 
			message("ERROR:  This Phone Number is already in use inside our system. Please try another!", "error");
		        redirect('student_Private.php?view=SPRO');}

else{
		
mysqli_query($condb,"update student_tb  set hobbies='$hobbies',phone='$phone',e_address='$eaddress',postal_address='$paddress',address='$caddress',lga='$lga',state='$state',nation='$nation' where stud_id = '$session_id'")or die(mysqli_error($condb));
//mysqli_query($condb,"update admin  set firstname ='$sname',lastname='$mname',phone='$phone',email='$eaddress' where username ='$admin_username'")or die(mysqli_error($condb));

//mysqli_query($condb,"insert into activity_log (date,username,action) values(NOW(),'$admin_username','Staff Details of $sname $oname with staff id $sid  was Updated')")or die(mysqli_error($condb)); 
// ob_start();
	message("Your Bio Data / Profile was Successfully Updated", "success");
		        redirect('student_Private.php?view=SPRO');


}
}
?>

<div class="x_panel">
                
             
                <div class="x_content">
	<?php
$query_changes = mysqli_query($condb,"select * from student_tb where stud_id = '$session_id'")or die(mysqli_error($condb));$row_changes = mysqli_fetch_array($query_changes); $user_names = $row_changes['RegNo']; $stpro = $row_changes['app_type'];
$existll = imgExists($row_changes['images']);
								?>
                    		<form name="addFee1" method="post" enctype="multipart/form-data" id="addFee1">
<input type="hidden" name="insids" value="<?php echo $_SESSION['insids'];?> " />
<input type="hidden" name="oldme" value="<?php echo $row_changes['password'];?>" />
                      
                      <span class="section">Student Profile
 </span>

    <div class="col-md-3 col-sm-3 col-xs-12 profile_left">
                      <div class="profile_img">
                        <div id="crop-avatar">
                          <!-- Current avatar -->
                           <img class="img-responsive avatar-view" src="<?php  
//if ($user_row['images']==NULL ){print "./uploads/NO-IMAGE-AVAILABLE.jpg";}else{ print $user_row['images'];}
	if ($existll > 0 ){ echo $row_changes['images'];}else{ echo "./uploads/NO-IMAGE-AVAILABLE.jpg";} 
				  
				 // echo $row['adminthumbnails'];  ?>" alt="" style="width:250px;height:180px">
                         
                        </div>
                      </div>
                      <h3><?php echo "Reg No :".$row['RegNo'];  ?></h3>
	<?php
								$query_userrecord = mysqli_query($condb,"select * from student_tb where RegNo = '$student_RegNo'")or die(mysqli_error($condb));
								$row_userrecord = mysqli_fetch_array($query_userrecord);
								?>
                      <ul class="list-unstyled user_data">
                      <li>
                          <i class="fa fa-signal user-profile-icon"></i><strong> <?php echo getlevel($row_userrecord['p_level'],$stpro);?> Level</strong>
                        </li>
                        <li><i class="fa fa-map-marker user-profile-icon"></i>
						<?php echo $row_userrecord['address'].", ".$row_userrecord['lga'].", ".$row_userrecord['state'];  ?>
					
                        </li>
                        <li>
                          <i class="fa fa-calendar user-profile-icon"></i> <?php echo $row_userrecord['dob'];?>
                        </li>
                        <li>
                          <i class="fa fa-briefcase user-profile-icon"></i> <?php echo getfacultyc($row_userrecord['Faculty']);?>
                        </li>
                          <li>
                          <i class="fa fa-briefcase user-profile-icon"></i> <?php echo getdeptc($row_userrecord['Department']);?>
                        </li>
                        <li class="m-top-xs">
                          <i class="fa fa-envelope user-profile-icon"></i>
                          <a href="#" target="_blank"><?php echo $row_userrecord['e_address'];?></a>
                          <li class="m-top-xs">
                          <i class="fa fa-phone user-profile-icon"></i>
                          <a href="#" target="_blank"><?php echo $row_userrecord['phone'];?></a>
                        </li>
                        </li>
                        <hr>
                      </ul>
<!--
                      <a class="btn btn-success"><i class="fa fa-edit m-right-xs"></i>Edit Profile</a>
                      <br /> --!>

                      <!-- start skills -->
                      <!--
                      <h4>Skills</h4>
                      <ul class="list-unstyled user_data">
                        <li>
                          <p>Web Applications</p>
                          <div class="progress progress_sm">
                            <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="50"></div>
                          </div>
                        </li>
                      
                      </ul>
                      <!-- end of skills -->

                    </div>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                     <div class="profile_title">
                        <div class="col-md-6">
                          <h2>Update Your Profile</h2>
                        </div>
                       
                      </div>
<div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
					  <label for="heard">Surname </label>
                      
                          <input type="text" class="form-control "  name='sname' id="sname"  value="<?php echo $row_userrecord['FirstName']; ?>"  readonly> </div>
                          
                          
<div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
					  <label for="heard">Middle Name</label>
                      
                          <input type="text" class="form-control " name="mname" id="mname" maxlength="20"  value="<?php echo $row_userrecord['SecondName']; ?>"   readonly > </div>

                          
                          
 <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Other Name</label>
                                         <input type="text" class="form-control " name="oname" id="oname" maxlength="20"  value="<?php echo $row_userrecord['Othername']; ?>" readonly   required="required">
                      </div>
                    
                     
                    
                      <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
					  <label for="heard">Marital Status</label>
                      
                          <select name='gender' id="gender" class="form-control"  disabled="disabled">
                            <option value="<?php echo $row_userrecord['Gender']; ?>"><?php echo $row_userrecord['Gender']; ?></option>
                           
                            <option value="Male">Male</option>
                              <option value="Female">Female</option>
                            
                            
                          
                          </select> </div>
                            <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Hobbies</label>
                            	  <input type="text" class="form-control " name='hobbies' id="hobbies" value="<?php echo $row_userrecord['hobbies']; ?>" >
                      </div>
                      <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Blood Group</label>
                            	  <input type="text" class="form-control " name='bloodgroup' id="bloodgroup" value="<?php echo $row_userrecord['bloodgroup']; ?>"  readonly>
                      </div>
                       <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Postal Address</label>
                            	  <input type="text" class="form-control " name='p_address' id="p_address" value="<?php echo $row_userrecord['postal_address']; ?>" required >
                      </div>
                      <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Contact Address</label>
                            	  <input type="text" class="form-control " name='caddress' id="caddress" value="<?php echo $row_userrecord['address']; ?>"  >
                      </div>
                        <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Mobile Number</label>
                            	  <input type="text" class="form-control " name='phone' id="phone"  required="required" value="<?php echo $row_userrecord['phone']; ?>" onkeypress="return isNumber(event);">
                      </div>
                       <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Email Address</label>
                            	  <input type="text" class="form-control " name='eaddress' id="eaddress" value="<?php echo $row_userrecord['e_address']; ?>" required>
                      </div>
              
                       <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
						  	  <label for="heard">State</label>
                        
                            	  <select name="state" id="state" class="form-control " onchange='loadlga(this.name);return false;'  required>
              <option value="<?php echo $row_userrecord['state']; ?>" selected="selected" ><?php echo $row_userrecord['state']; ?></option>
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
                      
                      <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Local Government </label>
                            <select class="form-control"  name="lga" id="lga"  >
<option value="<?php echo $row_userrecord['lga']; ?>" selected="selected" ><?php echo $row_userrecord['lga']; ?></option> </select>
                      </div>
                    
			    				
                      <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Nationality</label>
        <select class="form-control"  name="nation" id="nation"  >
<option value="<?php echo $row_userrecord['nation']; ?>" selected="selected" ><?php echo $row_userrecord['nation']; ?></option>
<option  value="Nigeria">Nigeria</option>
<option value="Others">Others</option>

</select>
                      </div>
                   
                       <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Year of Admission</label>
                            <input type="text" class="form-control " name='yoe' id="yoe" value="<?php echo $row_userrecord['yoe']; ?>" readonly >
                      </div>
                       <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Year of Graduation</label>
                            	  <input type="text" class="form-control " name='yog' id="yog" value="<?php echo $row_userrecord['yog']; ?>" readonly >
                      </div>
                      
                      <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Mode of Entry</label>
                            	  <input type="text" class="form-control " name='moe' id="moe" value="<?php echo getamoe($row_userrecord['Moe']); ?>" readonly >
                      </div>
                      <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Programme Duration</label>
                            	  <input type="text" class="form-control " name='acctname' id="acctname" value="<?php echo $row_userrecord['prog_dura']." Years"; ?>" readonly >
                      </div>
                      <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Certificate inview </label>
<input type="text" class="form-control " name='acctnum' id="acctnum" value="<?php echo getcertinview($row_userrecord['Cert_inview']); ?>" onkeypress="return isNumber(event);"  readonly>
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
                         
                        <button  name="suprof"  id="suprof"  class="btn btn-primary col-md-4" title="Click Here to Save Details" ><i class="fa fa-save"></i> Save</button>
                      <div class='imgHolder2' id='imgHolder2'><img src='../css/images/tabLoad.gif'></div>
                        	<script type="text/javascript">
	                                            $(document).ready(function(){
	                                            $('#suprof').tooltip('show');
	                                            $('#suprof').tooltip('hide');
	                                            });
	                                            </script>
                        </div>
                        
                        	<?php     function getamoe2($statnum20)
{
  if ($statnum20==01)
  {
     return "UTME";
  }
  else if($statnum20==02)
  {
     return "Pre_Science";
  }
   else if($statnum20==03)
  {
     return "Direct Entry";
  }
  else if($statnum20==04)
  {
    return "Undergraguate(Cep)";
  }
  
} ?>
									
                        </form>
                       </div> </div></div>
                 