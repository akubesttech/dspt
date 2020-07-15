
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

if(isset($_POST['adddept'])){
$Dname= ucwords($_POST['Dname']);
$Dcode = $_POST['Dcode'];
$d_group = ucfirst($_POST['d_group']);
$Demail = $_POST['Demail'];
$Dphone = $_POST['Dphone'];
$Dhod = ucfirst($_POST['Dhod']);
$Dfac = $_POST['Dfac'];
$query = mysqli_query($condb,"select * from dept where d_name = '$Dname' and d_code  = '$Dcode' ")or die(mysqli_error($condb));
//$row = mysql_fetch_array($query);
$row_course = mysqli_num_rows($query);
if ($row_course>0){
	message("The Department Entered  Already Exist Try Again.", "error");
		        redirect('add_Dept.php');

				//echo "<script>alert('Applicationform record inserted sucessfully..');</script>";
				}elseif(!ctype_digit($Dcode)){
				message("Incorrect Format For Department Code it should be a Digit.", "error");
		        redirect('add_Dept.php');

}elseif(!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/", $Demail)){
	message("Please! Provide a valid Email Address", "error");
		        redirect('add_Dept.php');
	
}else{
//if($level=="Others"){
//mysql_query("insert into dept (d_name,d_group,d_email,d_phone,d_code,d_faculty,d_hod) values('$Dname','$d_group','$Demail','$Dphone','$Dcode','$Dfac','$Dhod')")or die(mysql_error());
mysqli_query($condb,"insert into dept (d_name,d_group,d_email,d_phone,d_code,d_faculty,fac_did,d_hod) values('$Dname','$d_group','$Demail','$Dphone','$Dcode','".getfacultyc($Dfac)."','$Dfac','$Dhod')")or die(mysqli_error($condb));

mysqli_query($condb,"insert into activity_log (date,username,action) values(NOW(),'$admin_username','Department Titled $Dname was Add')")or die(mysqli_error($condb)); 
 ob_start();
 	message("New Department was Successfully Added", "success");
		        redirect('add_Dept.php');

}
}
?>
<?php $s=3;while($s>0){ $AppNo .= rand(0,9); $s-=1;}?>
<div class="x_panel">
                
             
                <div class="x_content">

                    		<form name="dept" method="post" enctype="multipart/form-data" id="dept">
<input type="hidden" name="insidd" value="<?php echo $_SESSION['insidd'];?> " />
                      
                      <span class="section">Add New <?php echo $SGdept1; ?> <?php
                                          if($resi == 1)
{


					echo " 
		
			    <center><label class=\"control-label\" for=\"inputEmail\"><font color=\"red\">$res</font></label></center>
			 
			  ";
}
?> </span>


 <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
						  	  <label for="heard"><?php echo $SGdept1; ?> Name</label>
                            	  <input type="text" class="form-control " name='Dname' id="Dname"  required="required">
                      </div>
                      
                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
						  	  <label for="heard"><?php echo $SGdept1; ?> Code </label>
                            	  <input type="text" class="form-control " name='Dcode' id="Dcode" onkeypress="return isNumber(event);" value="<?php echo $AppNo; ?>"  required="required">
                      </div>
                      
                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
						  	  <label for="heard"><?php echo $SGdept1; ?> Group </label>
                            	  <input type="text" class="form-control " name='d_group' id="d_group"  >
                      </div>
                      
                     <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
						  	  <label for="heard"><?php echo $SGdept1; ?> Email Address </label>
                            	  <input type="text" class="form-control " name='Demail' id="Demail"  required="required">
                      </div>
 
 <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
						  	  <label for="heard"><?php echo $SGdept1; ?> Office Phone </label>
                            	  <input type="text" class="form-control " name='Dphone' id="Dphone" onkeypress="return isNumber(event);"  required="required">
                      </div>
                      
                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
					  <label for="heard">Head Of <?php echo $SGdept1; ?> </label>
                      
                          <select name='Dhod' id="Dhod" class="form-control" required>
                            <option value="">Select Hod</option>
                            <?php  
$resulthod = mysqli_query($condb,"SELECT * FROM staff_details where position ='HOD' ORDER BY staff_id  ASC");
while($rshod = mysqli_fetch_array($resulthod))
{
echo "<option value='$rshod[staff_id]'>$rshod[sname] $rshod[mname] $rshod[oname]</option>";	
}
?>
                          
                          </select> </div>
                      
                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
					  <label for="heard"><?php echo $SCategory; ?> </label>
                      
                          <select name='Dfac' id="Dfac" class="form-control" required>
                            <option value="">Select <?php echo $SCategory; ?></option>
                          <?php  
$resultcourse = mysqli_query($condb,"SELECT * FROM faculty  ORDER BY fac_name  ASC");
while($rscourse = mysqli_fetch_array($resultcourse))
{
//echo "<option value='$rscourse[fac_name]'>$rscourse[fac_name]</option>";	
echo "<option value='$rscourse[fac_id]'>$rscourse[fac_name]</option>";
}
?>
                            
                       
                          
                          </select> </div>
                    
                     
               
                      <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                        
                        </div>
                      </div>
                      <div class="form-group">
                      <div class="col-md-6 col-md-offset-3">
                                        
                                        </div>  </div>
                      <div  class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback>
                        <div class="col-md-6 col-md-offset-3">
                         <?php   if (authorize($_SESSION["access3"]["sConfig"]["adep"]["create"])){ ?>
                        <button  name="adddept"  id="adddept"  class="btn btn-primary col-md-4" title="Click Here to Save <?php echo $SGdept1; ?> Details" ><i class="fa fa-sign-in"></i> Add <?php echo $SGdept1; ?></button><?php }?>
                      
                        	<script type="text/javascript">
	                                            $(document).ready(function(){
	                                            $('#adddept').tooltip('show');
	                                            $('#adddept').tooltip('hide');
	                                            });
	                                            </script>
                        </div>
                        
                        	
									
                        </form>
                       </div> </div>
                 