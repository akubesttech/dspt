<div class="x_panel">
                
             
                <div class="x_content">

                    <form id="demo-form"   method="post" enctype="multipart/form-data" data-parsley-validate >

                      
                      <span class="section">School Setup Information</span>

                     <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                        <input type="text" class="form-control has-feedback-left" name='Cname' id="Cname" placeholder="Name Of The Institution i.e Mark Ben University" required="required">
                        <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                      </div>

                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                        <input type="text" class="form-control" name='Caddress' id="Caddress" placeholder="School Address" required>
                        
                        <span class="fa fa-contact form-control-feedback right" aria-hidden="true"></span>
                      </div>

                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                        <input type="text" class="form-control has-feedback-left" name='Cemail' id="Cemail" placeholder="School Email"required>
                        <span class="fa fa-envelope form-control-feedback left" aria-hidden="true"></span>
                      </div>
                      
<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                        <input type="text" class="form-control has-feedback-left" name='initial' id="initial" placeholder="School Initial i.e Mark Ben University(MBU) " required>
                        <span class="fa fa-book form-control-feedback left" aria-hidden="true"></span>
                      </div>
                      
                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                        <input type="text" class="form-control" name='Onumber' id="Onumber" placeholder="Office Contact Number" required>
                        <span class="fa fa-phone form-control-feedback right" aria-hidden="true"></span>
                      </div>
                      
                      
                       <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                        <input type="text" class="form-control has-feedback-left" name='Waddress' id="Waddress" placeholder="Web Address" required>
                        <span class="fa fa-globe form-control-feedback left" aria-hidden="true"></span>
                      </div>

                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                        <input type="text" class="form-control" name='Cslogan' id="Cslogan" placeholder="School Slogan i.e 'We set The Standard Other Follow'">
                        <span class="fa fa-contact form-control-feedback right" aria-hidden="true"></span>
                      </div>

                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                        <input type="text" class="form-control has-feedback-left" name='Cstate' id="Cstate" placeholder="State">
                        <span class="fa fa-envelope1 form-control-feedback left" aria-hidden="true"></span>
                      </div>

                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                        <input type="text" class="form-control" name='Ccity' id="Ccity" placeholder="City/Municipality ">
                        <span class="fa fa-phone1 form-control-feedback right" aria-hidden="true"></span>
                      </div>
                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                        <input type="text" class="form-control has-feedback-left" name='Cprov' id="Cprov" placeholder="Province ">
                        <span class="fa fa-envelope1 form-control-feedback left" aria-hidden="true"></span>
                      </div>

                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                        <input type="text" class="form-control" name='Cpaddress' id="Cpaddress" placeholder="Postal Code ">
                        <span class="fa fa-envelope form-control-feedback right" aria-hidden="true"></span>
                      </div>
                      
                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
					  <label for="heard">Captcha Activated ? </label>
                      
                          <select name='Ccaptcha' id="Ccaptcha" class="form-control" required>
                            <option value="">Select..</option>
                            <option value="1">On</option>
                            <option value="0">Off</option>
                          
                          </select> </div>
                      
                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
					  <label for="heard">User Email Verification ? </label>
                      
                          <select name='Cverify' id="Cverify" class="form-control" required>
                            <option value="">Select..</option>
                            <option value="1">On</option>
                            <option value="0">Off</option>
                          
                          </select> </div>
						  
						  <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Upload School Logo ? </label>
                            	<input name="image" class="input-file uniform_on" id="fileInput" type="file" >
                      </div>
                      
                        <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                      <label for="message">Remarks (20 chars min, 100 max) :</label>
                          <textarea id="message" required="required" class="form-control" name="message" data-parsley-trigger="keyup" data-parsley-minlength="20" data-parsley-maxlength="100" data-parsley-minlength-message="Come on! You need to enter at least a 20 caracters long comment.."
                            data-parsley-validation-threshold="10"></textarea></div>
                     
               <div class="ln_solid"></div>
                      <div  class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback>
                        <div class="col-md-6 col-md-offset-3">
                          <?php   if (authorize($_SESSION["access3"]["sConfig"]["asi"]["create"])){ ?>
                        <button type="submit" name="save"  id="save" data-placement="right" class="btn btn-primary col-md-4" title="Click Here to Save Details" id="signin"><i class="fa fa-sign-in"></i> Save</button> <?php } ?>
                        </div>
                      </div>
                    </form>
                  </div>
                  <?php
if(isset($_POST['save'])){
$Cname = $_POST['Cname'];
$initial=$_POST['initial'];
$SchoolAddess = $_POST['Caddress'];
$Motto = $_POST['Cslogan'];
$OfficeEmail = $_POST['Cemail'];
$OfficePhone = $_POST['Onumber'];
$State = $_POST['Cstate'];
$City= $_POST['Ccity'];
$Provience= $_POST['Cprov'];
$Pcode = $_POST['Cpaddress'];
$Remark = $_POST['mesage'];
$WebAddress = $_POST['Waddress'];
$captcha = $_POST['Ccaptcha'];
$everify = $_POST['Cverify'];
//$Logo= $_POST['logo'];


$query = @mysqli_query($condb,"select * from schoolsetuptd ")or die(mysqli_error($condb));
$count = mysqli_num_rows($query);

								
if($count > 0){ ?>
<script>
alert('School Details Has Already Being Created');
$.jGrowl("School Details Has Already Being Created", { header: 'School Setup' });
</script>
<?php

}else{
mysqli_query($condb,"insert into setup (SchoolName,initial,Address,Motto,SEmail,OfficePhone,State,City,Pro,PCode,Remark,WebAddress,DateCreated,Createdby,captcha,emailver,p_utme,Snoti) 
values('".safee($condb,$Cname)."','".safee($condb,$initial)."','".safee($condb,$SchoolAddess)."','".safee($condb,$Motto)."','".safee($condb,$OfficeEmail)."','".safee($condb,$OfficePhone)."','".safee($condb,$State)."','".safee($condb,$City)."','".safee($condb,$Provience)."','".safee($condb,$Pcode)."','".safee($condb,$Remark)."','".safee($condb,$WebAddress)."',NOW(),'".safee($condb,$admin_username)."','".safee($condb,$captcha)."','".safee($condb,$everify)."','0','0')")or die(mysqli_error());
if ($_FILES['image']['size'] !== 0){

	                                while($r < 8){
								   $dig .=rand(3,9);
                                    $r+=1;
                                          }
                                         $newname=$dig . ".gif";
                                          $uploadfile = $newname;

		
 $image = addslashes(file_get_contents($_FILES['image']['tmp_name']));
                                $image_name = addslashes($_FILES['image']['name']);
                                $image_size = getimagesize($_FILES['image']['tmp_name']);

                                //move_uploaded_file($_FILES["image"]["tmp_name"], "uploads/" . $serial_number . '_' . $_FILES["image"]["name"]);
                                //$adminthumbnails = "uploads/" .$serial_number . '_'. $_FILES["image"]["name"];
                                  move_uploaded_file($_FILES["image"]["tmp_name"], "uploads/$uploadfile");
                                $adminthumbnails = "uploads/" .$newname;
                                
								mysqli_query($condb,"update schoolsetuptd set Logo = '".mysql_real_escape_string($adminthumbnails)."' where Createdby  = '$Cname' ");
								unset($dig);
$r=0;
}


 //$image = addslashes(file_get_contents($_FILES['image']['tmp_name']));
                                //$image_name = addslashes($_FILES['image']['name']);
                                //$image_size = getimagesize($_FILES['image']['tmp_name']);

                               // move_uploaded_file($_FILES["image"]["tmp_name"], "uploads/" . $_FILES["image"]["name"]);
                                //$adminthumbnails = "uploads/" . $_FILES["image"]["name"];
                                
								//mysql_query("update schoolsetuptd set Logo = '$adminthumbnails' where Createdby  = '$admin_username' ");
mysqli_query($condb,"insert into activity_log (date,username,action) values(NOW(),'".safee($condb,$admin_username)."','Added School Detail of $SchoolName')")or die(mysqli_error($condb));
?>
<script>
alert('School Details was  Successfully added');
$.jGrowl("School Details was  Successfully added", { header: 'School Setup' });
var delay = 2000;
	setTimeout(function(){ window.location = 'Create_New_Org.php'  }, delay); 
</script>
<?php
}
}
?>