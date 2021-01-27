
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
$d_group = ucfirst($_POST['d_group']);
$Dcode = $_POST['Dcode'];
$Demail = $_POST['Demail'];
$Dphone = $_POST['Dphone'];
$Dhod = ucfirst($_POST['Dhod']);
$Dfac = $_POST['Dfac'];


$query = mysqli_query($condb,"select * from dept where d_name = '".safee($condb,$Dname)."' and d_code  = '".safee($condb,$Dcode)."' ")or die(mysqli_error($condb));
//$row = mysql_fetch_array($query);
$row_course = mysqli_num_rows($query);
if ($row_course>1){
 message("The Department Entered  Already Exist Try Again", "success");
		        redirect('add_Dept.php?id='.$get_RegNo);
//}elseif(!ctype_digit($Dcode)){
 //message("Incorrect Format For Department Code it should be a Digit", "error");
		        //redirect('add_Dept.php?id='.$get_RegNo);
			
}elseif(!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/", $Demail)){
	 message("Please! Provide a valid Email Address.", "error");
		        redirect('add_Dept.php?id='.$get_RegNo);
}else{
//if($level=="Others"){
mysqli_query($condb,"update dept set d_name='".safee($condb,$Dname)."',d_group ='".safee($condb,$d_group)."',d_email='".safee($condb,$Demail)."',d_phone='".safee($condb,$Dphone)."',d_code='".safee($condb,$Dcode)."',d_faculty='".safee($condb,getfacultyc($Dfac))."',fac_did='".safee($condb,$Dfac)."',d_hod='".safee($condb,$Dhod)."' where dept_id='".safee($condb,$get_RegNo)."' ")or die(mysqli_error($condb));

mysqli_query($condb,"insert into activity_log (date,username,action) values(NOW(),'$admin_username','Department Titled $Dname was Updated!')")or die(mysqli_error($condb)); 
 ob_start();
 	 message("$Dname has Updated successfully!", "success");
		        redirect('add_Dept.php');

}
}
?>

<div class="x_panel">
                
             
                <div class="x_content">
<?php
								$query_d = mysqli_query($condb,"select * from dept where dept_id='".safee($condb,$get_RegNo)."' ")or die(mysqli_error($condb));
								$row_d = mysqli_fetch_array($query_d);
								?>
                    		<form name="dept" method="post" enctype="multipart/form-data" id="dept">
<input type="hidden" name="insidd" value="<?php echo $_SESSION['insidd'];?> " />
                      
                      <span class="section">Edit <?php echo $SGdept1; ?> </span>


 <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Department Name</label>
                            	  <input type="text" class="form-control " name='Dname' id="Dname" value="<?php echo $row_d['d_name']; ?>"  required="required">
                      </div>
                      
                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
						  	  <label for="heard"><?php echo $SGdept1; ?> Code </label>
                            	  <input type="text" class="form-control " name='Dcode' id="Dcode" maxlength="3" value="<?php echo $row_d['d_code']; ?>"  required="required">
                      </div>
                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
						  	  <label for="heard"><?php echo $SGdept1; ?> Group </label>
                            	  <input type="text" class="form-control " name='d_group' id="d_group" value="<?php echo $row_d['d_group']; ?>" >
                      </div>
                      
                     <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
						  	  <label for="heard"><?php echo $SGdept1; ?> Email Address </label>
                            	  <input type="text" class="form-control " name='Demail' id="Demail" value="<?php echo $row_d['d_email']; ?>"  required="required">
                      </div>
 
 <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
						  	  <label for="heard"><?php echo $SGdept1; ?> Office Phone </label>
                            	  <input type="text" class="form-control " name='Dphone' id="Dphone" onkeypress="return isNumber(event);" value="<?php echo $row_d['d_phone']; ?>"  required="required">
                      </div>
                      
                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
					  <label for="heard">Head Of <?php echo $SGdept1; ?> </label>
                      
                          <select name='Dhod' id="Dhod" class="form-control" required>
                            <option value="<?php echo $row_d['d_hod']; ?>"><?php echo gethod($row_d['d_hod']); ?></option>
                                            <?php  
$resulthod = mysqli_query($condb,"SELECT * FROM staff_details where access_level2 = '6' ORDER BY staff_id  ASC");
while($rshod = mysqli_fetch_array($resulthod))
{
echo "<option value='$rshod[staff_id]'>$rshod[sname] $rshod[mname] $rshod[oname]</option>";	
}
?>
                          
                          </select> </div>
                      
                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
					  <label for="heard"><?php echo $SCategory; ?> </label>
                      
                          <select name='Dfac' id="Dfac" class="form-control" required>
                            <option value="<?php echo $row_d['fac_did']; ?>"><?php echo getfacultyc($row_d['fac_did']); ?></option>
                            
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
                          <?php   if (authorize($_SESSION["access3"]["sConfig"]["adep"]["edit"])){ ?>
                        <button  name="adddept"  id="adddept"  class="btn btn-primary" title="Click Here to Save <?php echo $SGdept1; ?> Details" ><i class="fa fa-pencil"></i> Edit <?php echo $SGdept1; ?></button><?php } ?>
                      
                        	<script type="text/javascript">
	                                            $(document).ready(function(){
	                                            $('#adddept').tooltip('show');
	                                            $('#adddept').tooltip('hide');
	                                            });
	                                            </script>
                        </div>
                        
                        	
									
                        </form>
                       </div> </div>
                                             	<?php
//function for getting member status

  
?>
                 