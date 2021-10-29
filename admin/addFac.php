
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
if(isset($_POST['addfac'])){
$fac_name= ucwords($_POST['fac_name']);
$fac_desc = $_POST['fac_desc'];
$fac_email = $_POST['fac_email'];
$fac_phone = $_POST['fac_phone'];
$fac_dean = ucfirst($_POST['fac_dean']);
$fcode = strtoupper($_POST['fcode']);
$query_fac = mysqli_query($condb,"select * from faculty where fac_name = '$fac_name' AND fcode = '$fcode'")or die(mysqli_error($condb));
//$row = mysql_fetch_array($query);
$row_fac = mysqli_num_rows($query_fac);
if ($row_fac>0){
	message("ERROR:The Faculty Entered  Already Exist Try Again", "error");
		       redirect('add_Faculty.php');
//echo "<script>alert('Applicationform record inserted sucessfully..');</script>";
				}elseif(!ctype_digit($fac_phone)){
					message("ERROR:Incorrect Format For Phone Number it should be a Digit", "error");
		       redirect('add_Faculty.php');
			}elseif(!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/", $fac_email)){
	message("Please! Provide a valid Email Address.", "error");
		       redirect('add_Faculty.php');
	
}else{
//if($level=="Others"){
mysqli_query($condb,"insert into faculty (fac_name,fac_desc,fcode,fac_email,fac_phone,fac_dean) values('$fac_name','$fac_desc','$fcode','$fac_email','$fac_phone','$fac_dean')")or die(mysqli_error($condb));

mysqli_query($condb,"insert into activity_log (date,username,action) values(NOW(),'$admin_username','Faculty Titled $fac_name was Add')")or die(mysqli_error($condb)); 
 ob_start();
 	message("New ".$SCategory." was Successfully Added.", "success");
		       redirect('add_Faculty.php');

}
}
?>

<div class="x_panel">
                
             
                <div class="x_content">

                    		<form name="dept" method="post" enctype="multipart/form-data" id="dept">
<input type="hidden" name="insidd" value="<?php echo $_SESSION['insidd'];?> " />
                      
                      <span class="section">Add New <?php echo $SCategory; ?> <?php
//if($resi == 1){ echo "<center><label class=\"control-label\" for=\"inputEmail\"><font color=\"red\">$res</font></label></center>";}
?> </span>


 <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
						  	  <label for="heard"><?php echo $SCategory; ?> Name</label>
                            	  <input type="text" class="form-control " name='fac_name' id="fac_name"  required="required">
                      </div>
                      
                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
						  	  <label for="heard"><?php echo $SCategory; ?> Description </label>
                            	  <input type="text" class="form-control " name='fac_desc' id="fac_desc"  required="required">
                      </div>
                        <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
						  	  <label for="heard"><?php echo $SCategory; ?> Short Code </label>
                            	  <input type="text" class="form-control " name='fcode' id="fcode" maxlength="3"  value="<?php echo $AppNo; ?>" placeholder="i.e SOE"  required="required">
                      </div>
                      
                     <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
						  	  <label for="heard"><?php echo $SCategory; ?> Email Address </label>
                            	  <input type="text" class="form-control " name='fac_email' id="fac_email"  >
                      </div>
 
 <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
						  	  <label for="heard"><?php echo $SCategory; ?> Office Phone </label>
                            	  <input type="text" class="form-control " name='fac_phone' id="fac_phone" onkeypress="return isNumber(event);"  >
                      </div>
                      
                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
					  <label for="heard">Dean of The <?php echo $SCategory; ?> </label>
                      
                          <select name='fac_dean' id="fac_dean" class="form-control" >
                            <option value="">Select Dean</option>
                                                        <?php  
$resulthod = mysqli_query($condb,"SELECT * FROM staff_details where position ='Dean of Studies' ORDER BY staff_id  ASC");
while($rshod = mysqli_fetch_array($resulthod))
{
echo "<option value='$rshod[staff_id]'>$rshod[sname] $rshod[mname] $rshod[oname]</option>";	
}
?>
                          
                          </select> </div>
                      
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
                         <?php   if (authorize($_SESSION["access3"]["sConfig"]["afac"]["create"])){ ?>
                        <button  name="addfac"  id="addfac"  class="btn btn-primary col-md-4" title="Click Here to Save <?php echo $SCategory; ?> Details" ><i class="fa fa-sign-in"></i> Add <?php echo $SCategory; ?></button> <?php } ?>
                      
                        	<script type="text/javascript">
	                                            $(document).ready(function(){
	                                            $('#addfac').tooltip('show');
	                                            $('#addfac').tooltip('hide');
	                                            });
	                                            </script>
                        </div>
                        
                        	
									
                        </form>
                       </div> </div>
                 