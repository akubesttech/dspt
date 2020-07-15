
<?php
if(isset($_POST['uprof'])){
$sname = ucfirst($_POST['sname']) ; $mname = $_POST['mname'] ; $oname = $_POST['oname'] ;// $sex = $_POST['sex'];
$Mstatus = $_POST['Mstatus'] ; $dob = $_POST['dob'] ; $hobbies = $_POST['hobbies'] ; $sheight = $_POST['shight'];
$eaddress = $_POST['eaddress'] ; $paddress = $_POST['paddress'] ; $caddress = $_POST['caddress'] ;$phone = $_POST['phone'] ;
$stown = $_POST['stown'] ; $lga = $_POST['lga'] ; $state = $_POST['state'] ; $nation = ucfirst($_POST['nation']);
$jdesc = $_POST['jdesc'] ; $addjob = $_POST['addjob'] ; $heq = $_POST['heq'] ; $Cstudy = $_POST['cstudy'];
 $acctnum = $_POST['acctnum'] ;  $dept1 = $_POST['dept1'];
$moe = $_POST['moe'] ; $bname = $_POST['bname'] ;$acctname = $_POST['acctname'] ; $scode = $_POST['scode'] ; //$sid = $_POST['sid'];
//$image_find = $_POST['pic'] ; $Cverify = $_POST['Cverify'] ; $time=date('l jS \of F Y h:i:s A');
//$webaddress=$_SERVER['HTTP_HOST'];

//$query = mysqli_query($condb,"select * from staff_details where usern_id = '$sid' ")or die(mysqli_error($condb));
//$count = mysqli_num_rows($query);
$config = mysqli_fetch_array(mysqli_query($condb,"SELECT * FROM schoolsetuptd "));
	$sql_email_check = mysqli_query($condb,"SELECT * FROM staff_details WHERE email='$eaddress' LIMIT 1");
	$email_check = mysqli_num_rows($sql_email_check);
	
	$sql_phone_check = mysqli_query($condb,"SELECT * FROM staff_details WHERE phone='$phone' LIMIT 1");
	$phone_check = mysqli_num_rows($sql_phone_check);
	


	
//if ($count > 1){ 

//$res="<font color='red'><strong>This Staff Record Already Exist,Try Again!</strong></font><br>";
			//	$resi=1;
				//echo "<script>alert('Applicationform record inserted sucessfully..');</script>";
		if(!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/", $eaddress)){
	message("Please! Provide a valid Email Address.", "error");
		        redirect('staff_Private.php?view=SPRO');
		//$res="<font color='Red'><strong>Please! Provide a valid Email Address...</strong></font><br>";
				//$resi=1;
				
}elseif ($email_check > 1){ 
		message("ERROR:  This Email Address is already in use inside our system. Please try another.", "error");
		        redirect('staff_Private.php?view=SPRO');
			}	elseif ($phone_check > 1){ 
			message("ERROR:  This Phone Number is already in use inside our system. Please try another.", "error");
		        redirect('staff_Private.php?view=SPRO');
}else{
mysqli_query($condb,"update staff_details  set sname='$sname',mname='$mname',oname='$oname',mstatus='$Mstatus',hobbies='$hobbies',phone='$phone',email='$eaddress',paddress='$paddress',caddress='$caddress',town='$stown',lga='$lga',state='$state',nation='$nation',b_name='$bname',b_acct_name='$acctname',b_acct_num='$acctnum',b_sort='$scode' where usern_id='$staff_id'")or die(mysqli_error($condb));
//mysqli_query($condb,"update admin  set firstname ='$sname',lastname='$mname',phone='$phone',email='$eaddress' where username ='$admin_username'")or die(mysqli_error($condb));
		message("Your Profile was Successfully Updated", "success");
		        redirect('staff_Private.php');
}
}
?>

<div class="x_panel">
                
             
                <div class="x_content">
	<?php
								$query_change = mysqli_query($condb,"select * from staff_details where staff_id = '".safee($condb,$session_id)."'")or die(mysqli_error($condb));
								$row_change = mysqli_fetch_array($query_change);
								$user_name = $row_change['usern_id'];
								?>
                    		<form name="addFee1" method="post" enctype="multipart/form-data" id="addFee1">
<input type="hidden" name="insidf" value="<?php echo $_SESSION['insidf'];?> " />
<input type="hidden" name="oldme" value="<?php echo $row_change['password'];?>" />
                      
                      <span class="section">User Profile</span>

    <div class="col-md-3 col-sm-3 col-xs-12 profile_left">
                      <div class="profile_img">
                        <div id="crop-avatar">
                          <!-- Current avatar -->
                           <img class="img-responsive avatar-view" src="<?php  
				  //if ($row['image']==NULL ){print "uploads/NO-IMAGE-AVAILABLE.jpg";}else{print $row['image'];}
			if ($existo > 0 ){print "../admin/".$row['image']; }else{ print "../admin/uploads/NO-IMAGE-AVAILABLE.jpg";}		  
				  
				 // echo $row['adminthumbnails']; ?>" alt="">
                         
                        </div>
                      </div>
                      <h3><?php echo $row['firstname']." ".$row['lastname'];  ?></h3>
	<?php
								$query_userrecord = mysqli_query($condb,"select * from staff_details where staff_id = '$session_id'")or die(mysqli_error($condb));
								$row_userrecord = mysqli_fetch_array($query_userrecord);
								?>
                      <ul class="list-unstyled user_data">
                        <li><i class="fa fa-map-marker user-profile-icon"></i>
						<?php echo $row_userrecord['caddress'].", ".$row_userrecord['town'].", ".$row_userrecord['state'];  ?>
					
                        </li>
                        <li>
                          <i class="fa fa-calendar user-profile-icon"></i> <?php echo $row_userrecord['dob'];?>
                        </li>
                        <li>
                          <i class="fa fa-briefcase user-profile-icon"></i> <?php echo $row_userrecord['job_desc'];?>
                        </li>
                          <li>
                          <i class="fa fa-briefcase user-profile-icon"></i> <?php echo getdeptc($row_userrecord['s_dept']);?>
                        </li>
                        <li class="m-top-xs">
                          <i class="fa fa-envelope user-profile-icon"></i>
                          <a href="#" target="_blank"><?php echo $row_userrecord['email'];?></a>
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
                      
                          <input type="text" class="form-control "  name='sname' id="sname"  value="<?php echo $row_userrecord['sname']; ?>"  readonly> </div>
                          
                          
<div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
					  <label for="heard">Middle Name</label>
                      
                          <input type="text" class="form-control " name="mname" id="mname" maxlength="20"  value="<?php echo $row_userrecord['mname']; ?>"   readonly > </div>

                          
                          
 <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Other Name</label>
                                         <input type="text" class="form-control " name="oname" id="oname" maxlength="20"  value="<?php echo $row_userrecord['oname']; ?>" readonly   required="required">
                      </div>
                    
                     
                    
                      <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
					  <label for="heard">Marital Status</label>
                      
                          <select name='Mstatus' id="Mstatus" class="form-control" required>
                            <option value="<?php echo $row_userrecord['mstatus']; ?>"><?php echo $row_userrecord['mstatus']; ?></option>
                            <option value="Single">Single</option>
                            <option value="Married">Married</option>
                              <option value="Widow">Widow</option>
                            <option value="Widower">Widower</option>
                            <option value="Divorcy">Divorcy</option>
                          
                          </select> </div>
                            <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Hobbies</label>
                            	  <input type="text" class="form-control " name='hobbies' id="hobbies" value="<?php echo $row_userrecord['hobbies']; ?>" >
                      </div>
                      <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Postal Address</label>
                            	  <input type="text" class="form-control " name='paddress' id="paddress" value="<?php echo $row_userrecord['paddress']; ?>"  >
                      </div>
                      <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Contact Address</label>
                            	  <input type="text" class="form-control " name='caddress' id="caddress" value="<?php echo $row_userrecord['caddress']; ?>"  >
                      </div>
                        <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Mobile Number</label>
                            	  <input type="text" class="form-control " name='phone' id="phone"  required="required" value="<?php echo $row_userrecord['phone']; ?>" onkeypress="return isNumber(event);">
                      </div>
                       <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Email Address</label>
                            	  <input type="text" class="form-control " name='eaddress' id="eaddress" value="<?php echo $row_userrecord['email']; ?>" required>
                      </div>
              
                      
                       <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
						  	  <label for="heard">State</label>
                        <select name="state" id="state" onchange='loadlga(this.name);return false;' class="form-control " required>
                           <!-- 	  <select name="state" id="state" class="form-control " required> --!>
              <option value="<?php echo $row_userrecord['state']; ?>" selected="selected"><?php echo $row_userrecord['state']; ?></option>
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
						  	   <select class="form-control"  name="lga" id="lga"  required>
            <option value="<?php echo $row_userrecord['lga']; ?>" selected="selected" ><?php echo $row_userrecord['lga']; ?></option></select>
        <!--    <input type="text" class="form-control " name='lga' id="lga" value="<?php echo $row_userrecord['lga']; ?>" required > --!>
                      </div>
                       <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Town/City</label>
                            	  <input type="text" class="form-control " name='stown' id="stown" value="<?php echo $row_userrecord['town']; ?>" required >
                      </div>
                      <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Nationality</label>
                            	  <input type="text" class="form-control " name='nation' id="nation" value="<?php echo $row_userrecord['nation']; ?>"  >
                      </div>
                   
                       <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Highest Education Qualification</label>
                            	  <select name='heq' id="heq" class="form-control" disabled="disabled"  >
                            <option value="<?php echo $row_userrecord['heq']; ?>"><?php echo $row_userrecord['heq']; ?></option>
                            <option value="Olevel">Olevel</option>
                            <option value="OND">OND</option>
                            <option value="HND">HND</option>
                            <option value="BSC">BSC</option>
                              <option value="MSC">MSC</option>
                                <option value="PHD">PHD</option>
                                 <option value="Others">Others</option>
                          
                          </select>
                      </div>
                       <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Course Studied</label>
                            	  <input type="text" class="form-control " name='cstudy' id="cstudy" value="<?php echo $row_userrecord['cos']; ?>" readonly >
                      </div>
                      
                      <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Employee Bank Name </label>
                            	  <input type="text" class="form-control " name='bname' id="bname" value="<?php echo $row_userrecord['b_name']; ?>"  >
                      </div>
                      <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Employee Account Name </label>
                            	  <input type="text" class="form-control " name='acctname' id="acctname" value="<?php echo $row_userrecord['b_acct_name']; ?>"  >
                      </div>
                      <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Employee Account Number </label>
                            	  <input type="text" class="form-control " name='acctnum' id="acctnum" value="<?php echo $row_userrecord['b_acct_num']; ?>" onkeypress="return isNumber(event);"  >
                      </div>
                      <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Bank Sort Code </label>
                            	  <input type="text" class="form-control " name='scode' id="scode" value="<?php echo $row_userrecord['b_sort']; ?>" onkeypress="return isNumber(event);"  >
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
                         
                        <button  name="uprof"  id="uprof"  class="btn btn-primary col-md-4" title="Click Here to Save Details" ><i class="fa fa-save"></i> Save</button>
                      
                        	<script type="text/javascript">
	                                            $(document).ready(function(){
	                                            $('#uprof').tooltip('show');
	                                            $('#uprof').tooltip('hide');
	                                            });
	                                            </script>
	                                            <div class='imgHolder2' id='imgHolder2'><img src='../admin/uploads/tabLoad.gif'></div>
                        </div>
                        
                        	
									
                        </form>
                       </div> </div></div>
                 