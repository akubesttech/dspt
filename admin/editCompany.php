<div class="x_panel">
                
              <?php
								$query = mysqli_query($condb,"select * from schoolsetuptd ")or die(mysqli_error($condb));
								$row = mysqli_fetch_array($query);
								
								?>
								<?php
		
if (isset($_POST['update'])){
$Cname = $_POST['Cname'];$initial=$_POST['initial'];$SchoolAddess = $_POST['Caddress'];$Motto = $_POST['Cslogan'];
$OfficeEmail = $_POST['Cemail'];$OfficePhone = $_POST['Onumber'];$State = $_POST['Cstate'];$City= $_POST['Ccity'];
$Provience= $_POST['Cprov'];$Pcode = $_POST['Cpaddress'];$Remark = $_POST['message'];$WebAddress = $_POST['Waddress'];
$captcha = $_POST['Ccaptcha'];$everify = $_POST['Cverify'];$p_utmev= $_POST['p_utme'];$Snoti = $_POST['Snoti'];
$exam_date = $_POST['exam_date'];$set_time = $_POST['set_time']; $smatview = $_POST['smat2'];
if ($_FILES['image']['size'] == Null){
mysqli_query($condb,"update schoolsetuptd set smat = '".safee($condb,$smatview)."', SchoolName = '".safee($condb,$Cname)."',initial= '".safee($condb,$initial)."',Address ='".safee($condb,$SchoolAddess)."',Motto='".safee($condb,$Motto)."',SEmail='".safee($condb,$OfficeEmail)."',OfficePhone='".safee($condb,$OfficePhone)."',State='".safee($condb,$State)."',City='".safee($condb,$City)."',Pro='".safee($condb,$Provience)."',PCode='".safee($condb,$Pcode)."',Remark='".safee($condb,$Remark)."',WebAddress='".safee($condb,$WebAddress)."',DateCreated=NOW(),captcha='".safee($condb,$captcha)."',emailver='".safee($condb,$everify)."',Snoti='".safee($condb,$Snoti)."',p_utme='".safee($condb,$p_utmev)."',e_date='".safee($condb,$exam_date)."',e_time='".safee($condb,$set_time)."',Createdby='".safee($condb,$admin_username)."' where id='".safee($condb,$get_RegNo)."'") 
or die(mysqli_error($condb));
message("Company Configuration Information Successfully Updated", "success");
		        redirect('Create_New_Org.php');
}else{

   $name4     = $_FILES['image']['name'];
    $tmpName  = $_FILES['image']['tmp_name'];
    $ext = strtolower(pathinfo($name4, PATHINFO_EXTENSION));
    $maxsize  = 400000;
    if(!in_array($ext, array('jpg','jpeg','png','gif')) ){
    message("Invalid file type. Only  JPG, GIF and PNG types are accepted.", "error");
		        redirect('Create_New_Org.php?id='.$get_RegNo);

	}elseif(getimagesize($_FILES['image']['tmp_name']) < $maxsize){
	   message("File size should be less than 400kb.", "error");
		        redirect('Create_New_Org.php?id='.$get_RegNo);
}else{
mysqli_query($condb,"update schoolsetuptd SET smat = '".safee($condb,$smatview)."',SchoolName = '".safee($condb,$Cname)."',initial= '".safee($condb,$initial)."',Address ='".safee($condb,$SchoolAddess)."',Motto='".safee($condb,$Motto)."',SEmail='".safee($condb,$OfficeEmail)."',OfficePhone='".safee($condb,$OfficePhone)."',State='".safee($condb,$State)."',City='".safee($condb,$City)."',Pro='".safee($condb,$Provience)."',PCode='".safee($condb,$Pcode)."',Remark='".safee($condb,$Remark)."',WebAddress='".safee($condb,$WebAddress)."',DateCreated=NOW(),captcha='".safee($condb,$captcha)."',emailver='".safee($condb,$everify)."',Snoti='".safee($condb,$Snoti)."',p_utme='".safee($condb,$p_utmev)."',e_date='".safee($condb,$exam_date)."',e_time='".safee($condb,$set_time)."',Createdby='".safee($condb,$admin_username)."' where id='".safee($condb,$get_RegNo)."'") 
or die(mysqli_error($condb));

if ($_FILES['image']['size'] != Null){

 

	                                while($r < 8){
								   $dig .=rand(3,9);
                                    $r+=1;
                                          }
                                         $newname=$dig . ".gif";
                                          $uploadfile = $newname;

		
 $image = addslashes(file_get_contents($_FILES['image']['tmp_name']));
                                $image_name = addslashes($_FILES['image']['name']);
                                $image_size = getimagesize($_FILES['image']['tmp_name']);

                                
                                  move_uploaded_file($_FILES["image"]["tmp_name"], "uploads/$uploadfile");
                                $adminthumbnails = "uploads/" .$newname;
                                
								mysqli_query($condb,"update schoolsetuptd SET Logo = '".safee($condb,$adminthumbnails)."' where id='".safee($condb,$get_RegNo)."' ");
								unset($dig);
$r=0;
unlink("$row[Logo]");
//}
	   message("Company Configuration Information Successfully Updated", "success");
		        redirect('Create_New_Org.php');

}


}

}
 

}
?>
                <div class="x_content">

                    <form id="demo-form"  method="post" enctype="multipart/form-data" >
                    <input type="hidden" name="insidf" value="<?php echo $_SESSION['insidf'];?> " />
                    <input type="hidden" name="MAX_FILE_SIZE" value="400000" />

                      
                      <span class="section">Update School Configuration of  <?php echo $row['SchoolName']; ?></span>
                      <span class="section"></span>

                     <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                        <input type="text" class="form-control has-feedback-left" value="<?php echo $row['SchoolName']; ?>" name='Cname' id="Cname" placeholder="Name Of The Organization i.e Akubest Solutions" required>
                        <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                      </div>

                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                        <input type="text" class="form-control" value="<?php echo $row['Address']; ?>" name='Caddress' id="Caddress" placeholder="Company Address" required>
                        <span class="fa fa-contact form-control-feedback right" aria-hidden="true"></span>
                      </div>

                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                        <input type="text" class="form-control has-feedback-left" value="<?php echo $row['SEmail']; ?>" name='Cemail' id="Cemail" placeholder="Company Email"required>
                        <span class="fa fa-envelope form-control-feedback left" aria-hidden="true"></span>
                      </div>
                      
<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                        <input type="text" class="form-control has-feedback-left" value="<?php echo $row['initial']; ?>" name='initial' id="initial"  placeholder="School Initial i.e Mark Ben University(MBU) " required>
                        <span class="fa fa-book form-control-feedback left" aria-hidden="true"></span>
                      </div>
                      
                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                        <input type="text" class="form-control" name='Onumber' id="Onumber" value="<?php echo $row['OfficePhone']; ?>" placeholder="Office Contact Number" required>
                        <span class="fa fa-phone form-control-feedback right" aria-hidden="true"></span>
                      </div>
                      
                      
                       <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                        <input type="text" class="form-control has-feedback-left" value="<?php echo $row['WebAddress']; ?>" name='Waddress' id="Waddress" placeholder="Web Address" required>
                        <span class="fa fa-globe form-control-feedback left" aria-hidden="true"></span>
                      </div>

                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                        <input type="text" class="form-control" value="<?php echo $row['Motto']; ?>" name='Cslogan' id="Cslogan" placeholder="Company Slogan i.e 'We set The Standard Other Follow'">
                        <span class="fa fa-contact form-control-feedback right" aria-hidden="true"></span>
                      </div>

                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                        <input type="text" class="form-control has-feedback-left" value="<?php echo $row['State']; ?>" name='Cstate' id="Cstate" placeholder="State">
                        <span class="fa fa-envelope1 form-control-feedback left" aria-hidden="true"></span>
                      </div>

                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                        <input type="text" class="form-control" value="<?php echo $row['City']; ?>" name='Ccity' id="Ccity" placeholder="City/Municipality ">
                        <span class="fa fa-phone1 form-control-feedback right" aria-hidden="true"></span>
                      </div>
                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                        <input type="text" class="form-control has-feedback-left" value="<?php echo $row['Pro']; ?>" name='Cprov' id="Cprov" placeholder="Province ">
                        <span class="fa fa-envelope1 form-control-feedback left" aria-hidden="true"></span>
                      </div>

                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                        <input type="text" class="form-control" value="<?php echo $row['Pcode']; ?>" name='Cpaddress' id="Cpaddress" placeholder="Postal Code ">
                        <span class="fa fa-envelope form-control-feedback right" aria-hidden="true"></span>
                      </div>
                      
                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
					  <label for="heard">Captcha Activated ? </label>
                      
                          <select name='Ccaptcha' id="Ccaptcha" class="form-control" required>
                            <option value="<?php echo $row['captcha']; ?>"><?php 
if($row['captcha']=='1'){
echo 'On';}elseif($row['captcha']=='0'){ echo 'Off';} ?>.</option>
                            <option value="1">On</option>
                            <option value="0">Off</option>
                          
                          </select> </div>
                          
                          <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
					  <label for="heard">User Email Verification ? </label>
                      
                          <select name='Cverify' id="Cverify" class="form-control" required>
                            <option value="<?php echo $row['emailver']; ?>"><?php 
if($row['emailver']=='1'){
echo 'On';}elseif($row['emailver']=='0'){ echo 'Off';} ?></option>
                            <option value="1">On</option>
                            <option value="0">Off</option>
                          
                          </select> </div>
                         <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Set Date For Entrance Exam</label>
                            	 
                            	  <input  type="text" name="exam_date" size="30"   class="w8em format-d-m-y highlight-days-67 range-middle-today" id="ed" value="<?php echo $row['e_date']; ?>" style="height:33px;"  readonly="readonly">
                      </div>
                       <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Set Time (eg 12:00pm)</label>
                            	  <input type="text" class="form-control " name='set_time' maxlength="7" id="set_time" value='<?php echo $row['e_time']; ?>' >
                      </div>
                      <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
					  <label for="heard">User Account Block Notification ? </label>
                      
                          <select name='Snoti' id="Snoti" class="form-control" required>
                            <option value="<?php echo $row['Snoti']; ?>"><?php 
if($row['Snoti']=='1'){
echo 'On';}elseif($row['Snoti']=='0'){ echo 'Off';} ?></option>
                            <option value="1">On</option>
                            <option value="0">Off</option>
                          
                          </select> </div>
                           
						   <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
					  <label for="heard">Set Post UTME Result Processing ? </label>
                      
                          <select name='p_utme' id="p_utme" class="form-control" required>
                            <option value="<?php echo $row['p_utme']; ?>"><?php 
if($row['p_utme']=='1'){
echo 'Auto';}elseif($row['p_utme']=='0'){ echo 'Manual';} ?></option>
                            <option value="1">Auto</option>
                            <option value="0">Manual</option>
                          
                          </select> </div>
                     <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
					  <label for="heard">Set Mat No Issuance</label>
                      <select name='smat2' id="smat2" class="form-control" >
                            <option value="<?php echo $row['smat']; ?>"><?php if($row['smat']=='0'){
echo 'Manual';}elseif($row['smat']=='1'){ echo 'Auto';} ?></option>
                            <option value="1">Auto</option>
                            <option value="0">Manual</option>
                            </select> </div>
                     <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Upload Company Logo ? </label>
                            	<input name="image" class="input-file uniform_on" id="fileInput" type="file"  dir="<?php echo $row['Logo']; ?>"   style="width:200px;" >
                      </div>
           <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                      <label for="message">Remarks (20 chars min, 100 max) :</label>
                          <textarea id="message" required="required" class="form-control" name="message" data-parsley-trigger="keyup" data-parsley-minlength="20" data-parsley-maxlength="100" data-parsley-minlength-message ="Come on! You need to enter at least a 20 caracters long comment.."
                            data-parsley-validation-threshold="10"><?php echo $row['Remark']; ?></textarea></div>
                     
 <div  class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
              <?php   if (authorize($_SESSION["access3"]["sConfig"]["asi"]["edit"])){ ?>
                        <button type="submit"  name="update"  id="update" data-placement="right" class="btn btn-primary" title="Click Here to Update Details" ><i class="fa fa-sign-in"></i> Update</button><?php } ?>
                        </div>
                       
                         

                      </div>
                    </form>
                  </div>



